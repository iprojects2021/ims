<?php

class AdvancedLogger
{
    private $logFile;
    private $maxSize; // in bytes
    private $backupCount;
    
    public function __construct($logFile = '../logs/app.log', $maxSize = 10485760, $backupCount = 5)
    {
        $this->logFile = $logFile;
        $this->maxSize = $maxSize; // 10MB default
        $this->backupCount = $backupCount;
        
        // Create directory if needed
        $logDir = dirname($this->logFile);
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
    }
    
    public function log($level, $message, array $context = [])
    {
        $this->rotateIfNeeded();
        
        $timestamp = date('Y-m-d H:i:s');
        $ip = $_SERVER['REMOTE_ADDR'] ?? 'CLI';
        $uri = $_SERVER['REQUEST_URI'] ?? 'N/A';
        
        $message = $this->interpolate($message, $context);
        
        $logEntry = sprintf(
            "[%s] [%s] [%s] [%s] %s%s",
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
        if (file_exists($this->logFile) && filesize($this->logFile) >= $this->maxSize) {
            $this->rotate();
        }
    }
    
    private function rotate()
    {
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
        
        if (file_exists($this->logFile)) {
            rename($this->logFile, $this->logFile . '.0');
        }
    }
    
    private function interpolate($message, array $context = [])
    {
        $replace = [];
        foreach ($context as $key => $val) {
            $replace['{' . $key . '}'] = $val;
        }
        
        return strtr($message, $replace);
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
