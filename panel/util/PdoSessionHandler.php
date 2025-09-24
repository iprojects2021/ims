<?php

class PdoSessionHandler implements SessionHandlerInterface
{
    private $pdo;
    private $table = 'sessions';

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function open($savePath, $sessionName): bool
    {
        // No action necessary
        return true;
    }

    public function close(): bool
    {
        // No action necessary
        return true;
    }

    public function read($id): string
    {
        $stmt = $this->pdo->prepare("SELECT data FROM {$this->table} WHERE id = :id");
        $stmt->execute(['id' => $id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row ? $row['data'] : '';
    }

    public function write($id, $data): bool
    {
        $stmt = $this->pdo->prepare("
            INSERT INTO {$this->table} (id, data) VALUES (:id, :data)
            ON DUPLICATE KEY UPDATE data = :data
        ");

        return $stmt->execute([
            'id' => $id,
            'data' => $data
        ]);
    }

    public function destroy($id): bool
    {
        $stmt = $this->pdo->prepare("DELETE FROM {$this->table} WHERE id = :id");
        return $stmt->execute(['id' => $id]);
    }

    public function gc($maxLifetime): bool
    {
        $stmt = $this->pdo->prepare("
            DELETE FROM {$this->table} 
            WHERE last_updated < DATE_SUB(NOW(), INTERVAL :maxl SECOND)
        ");
        return $stmt->execute(['maxl' => $maxLifetime]);
    }
}
            
?>