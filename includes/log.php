<?php

class AdvancedLogger
{
    private $logFile;
    private $maxSize; // in bytes
    private $backupCount;
    private $lastRotationDate;
    
    public function __construct($logFile = '../logs/app.log', $maxSize = 10485760, $backupCount = 5)
    {
        $this->logFile = $logFile;
        $this->maxSize = $maxSize; // 10MB default
        $this->backupCount = $backupCount;
        $this->lastRotationDate = date('Y-m-d');
        
        // Create directory if needed
        $logDir = dirname($this->logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        // Initialize last rotation date from file if it exists
        $this->loadRotationState();
    }
    
    public function log($level, $message, array $context = [])
    {
        date_default_timezone_set("Asia/Calcutta");
        $this->rotateIfNeeded();
        $timezone = date_default_timezone_get();
        $timestamp = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'CLI';
        $uri = $_SERVER['REQUEST_URI'] ?? 'N/A';
        
        $message = $this->interpolate($message, $context);
        
        $logEntry = sprintf(
            "[%s] [%s] [%s] [%s] [%s] %s%s",
            $timezone,
            $timestamp,
            $level,
            $ip,
            $uri,
            $message,
            PHP_EOL
        );
        
        file_put_contents($this->logFile, $logEntry, FILE_APPEND | LOCK_EX);
    }
    
    private function rotateIfNeeded()
    {
        $currentDate = date('Y-m-d');
        $shouldRotateByDate = $currentDate !== $this->lastRotationDate;
        $shouldRotateBySize = file_exists($this->logFile) && filesize($this->logFile) >= $this->maxSize;
        
        if ($shouldRotateByDate || $shouldRotateBySize) {
            $this->rotate($shouldRotateByDate);
            $this->lastRotationDate = $currentDate;
            $this->saveRotationState();
        }
    }
    
    private function rotate($isDateRotation = false)
    {
        if (!file_exists($this->logFile)) {
            return;
        }
        
        if ($isDateRotation) {
            // Date-based rotation: use current date in filename
            $backupFile = $this->logFile . '.' . date('Y-m-d') . '.log';
            
            // Check if backup already exists for today and increment counter
            $counter = 0;
            while (file_exists($backupFile)) {
                $counter++;
                $backupFile = $this->logFile . '.' . date('Y-m-d') . '.' . $counter . '.log';
            }
            
            rename($this->logFile, $backupFile);
        } else {
            // Size-based rotation: use numeric sequence
            for ($i = $this->backupCount - 1; $i >= 0; $i--) {
                $rotateFile = $this->logFile . '.' . $i;
                if (file_exists($rotateFile)) {
                    if ($i === $this->backupCount - 1) {
                        unlink($rotateFile);
                    } else {
                        rename($rotateFile, $this->logFile . '.' . ($i + 1));
                    }
                }
            }
            rename($this->logFile, $this->logFile . '.0');
        }
        
        // Clean up old backups to maintain count limit
        $this->cleanupOldBackups();
    }
    
    private function cleanupOldBackups()
    {
        $files = glob($this->logFile . '.*');
        $backups = [];
        
        foreach ($files as $file) {
            // Match both numeric backups (app.log.0, app.log.1) and date backups (app.log.2024-01-15.log)
            if (preg_match('/\.(\d+)$/', $file) || preg_match('/\.(\d{4}-\d{2}-\d{2})(\.\d+)?\.log$/', $file)) {
                $backups[] = [
                    'file' => $file,
                    'mtime' => filemtime($file)
                ];
            }
        }
        
        // Sort by modification time, oldest first
        usort($backups, function($a, $b) {
            return $a['mtime'] - $b['mtime'];
        });
        
        // Remove oldest backups if we exceed the limit
        while (count($backups) > $this->backupCount) {
            $oldest = array_shift($backups);
            if (file_exists($oldest['file'])) {
                unlink($oldest['file']);
            }
        }
    }
    
    private function loadRotationState()
    {
        $stateFile = $this->logFile . '.state';
        if (file_exists($stateFile)) {
            $data = file_get_contents($stateFile);
            if ($data) {
                $state = json_decode($data, true);
                if (isset($state['lastRotationDate'])) {
                    $this->lastRotationDate = $state['lastRotationDate'];
                }
            }
        }
    }
    
    private function saveRotationState()
    {
        $stateFile = $this->logFile . '.state';
        $state = [
            'lastRotationDate' => $this->lastRotationDate,
            'lastUpdated' => date('Y-m-d H:i:s')
        ];
        file_put_contents($stateFile, json_encode($state), LOCK_EX);
    }
    
    private function interpolate($message, array $context = [])
    {
        $replace = [];
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }
        
        return strtr($message, $replace);
    }
    
    // Helper method to get all backup files
    public function getBackupFiles()
    {
        return glob($this->logFile . '.*');
    }
    
    // Helper method to get current rotation state
    public function getRotationState()
    {
        return [
            'lastRotationDate' => $this->lastRotationDate,
            'currentDate' => date('Y-m-d'),
            'shouldRotate' => date('Y-m-d') !== $this->lastRotationDate
        ];
    }
}
// Usage
// $logger = new AdvancedLogger();
// $logger->log('INFO', 'User {user} performed {action}', [
//     'user' => 'john_doe', 
//     'action' => 'login'
// ]);
// $logger->log('ERROR', 'Database error: {error}', ['error' => 'Connection timeout']);

?>
