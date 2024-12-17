<?php

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

class afficherRequetes
{
    public static function displayRequests($requests)
    {
        if (empty($requests)) {
            echo "<p>Aucune nouvelle requête d'adhésion pour le moment.</p>";
        } else {
            echo '
            <div class="table-responsive">
                <table>
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Sexe</th>
                            <th>Âge</th>
                            <th>Durée (mois)</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>';

            foreach ($requests as $request) {
                echo '
                    <tr>
                        <td>' . htmlspecialchars($request['nom']) . '</td>
                        <td>' . htmlspecialchars($request['prenom']) . '</td>
                        <td>' . htmlspecialchars($request['sexe']) . '</td>
                        <td>' . htmlspecialchars($request['age']) . '</td>
                        <td>' . htmlspecialchars($request['duree']) . '</td>
                        <td>
                            <button class="action-btn" data-id="' . $request['id'] . '" data-action="accept">Accepter</button>
                            <button class="action-btn" data-id="' . $request['id'] . '" data-action="reject">Refuser</button>
                        </td>
                    </tr>';
            }

            echo '
                    </tbody>
                </table>
            </div>';
        }
    }
}
?>
