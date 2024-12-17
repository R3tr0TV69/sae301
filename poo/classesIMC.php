<?php
require_once 'config/config.php';

class AdherentIMC
{
    private $pdo;
    private $id;
    private $poids;
    private $taille;
    private $imc;

    public function __construct($pdo, $id)
    {
        $this->pdo = $pdo;
        $this->id = $id;
        $this->loadAdherent();
    }

    private function loadAdherent()
    {
        $stmt = $this->pdo->prepare("SELECT poids, taille FROM adherents WHERE id = :id");
        $stmt->execute(['id' => $this->id]);
        $adherent = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($adherent) {
            $this->poids = $adherent['poids'];
            $this->taille = $adherent['taille'];
        } else {
            throw new Exception("Adhérent introuvable.");
        }
    }

    public function calculerIMC()
    {
        if ($this->poids > 0 && $this->taille > 0) {
            $this->imc = $this->poids / (($this->taille / 100) ** 2);
            return number_format($this->imc, 2);
        } else {
            return null;
        }
    }

    public function obtenirCommentaire()
    {
        if (!$this->imc) {
            return "Données invalides pour le calcul de l'IMC.";
        }

        if ($this->imc < 16) {
            return "Dénutrition sévère.";
        } elseif ($this->imc < 18.5) {
            return "Insuffisance pondérale.";
        } elseif ($this->imc < 25) {
            return "Corpulence normale.";
        } elseif ($this->imc < 30) {
            return "Surpoids.";
        } elseif ($this->imc < 35) {
            return "Obésité modérée.";
        } elseif ($this->imc < 40) {
            return "Obésité sévère.";
        } else {
            return "Obésité morbide.";
        }
    }

    public static function afficherIMC($pdo, $id)
    {
        $adherentIMC = new self($pdo, $id);
        $imc = $adherentIMC->calculerIMC();
        $commentaire = $adherentIMC->obtenirCommentaire();

        echo "<p><strong>IMC :</strong> " . htmlspecialchars($imc) . "</p>";
        echo "<p><strong>Commentaire :</strong> " . htmlspecialchars($commentaire) . "</p>";
    }
}
?>
