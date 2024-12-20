<?php
// Gére les inscriptions
$requests = $pdo->query("SELECT * FROM demande_inscription")->fetchAll(PDO::FETCH_ASSOC);

class gererRequetes
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function getAllRequests()
    {
        $stmt = $this->pdo->query("SELECT * FROM demande_inscription");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
