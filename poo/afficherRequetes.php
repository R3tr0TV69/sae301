<?php

$requests = $pdo->query("SELECT * FROM demande_inscription")->fetchAll(PDO::FETCH_ASSOC);

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
                            <button class="action-btn" data-id="' . $request['id'] . '" data-action="accept"><img src="images/oui.png" alt="oui"></button>
                            <button class="action-btn" data-id="' . $request['id'] . '" data-action="reject"><img src="images/non.png" alt="non"></button>
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
