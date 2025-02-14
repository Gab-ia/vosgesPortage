<?php
function getJsonVillesVosges()
{
    global $conn;
    try {
        $getJsonVillesVosges = $conn->prepare('SELECT * FROM villes_vosges');
        $getJsonVillesVosges->execute();
        $villes_vosges = $getJsonVillesVosges->fetchAll(PDO::FETCH_ASSOC);

        // Envoi de l'en-tête HTTP pour JSON
        header('Content-Type: application/json');
        return json_encode(['data' => $villes_vosges]);
    } catch (PDOException $e) {
        // Journalisation de l'erreur dans les logs du serveur
        error_log('Erreur PDO: ' . $e->getMessage());

        // Envoi de l'en-tête HTTP pour erreur serveur
        header('Content-Type: application/json', true, 500);

        // Retour d'un message d'erreur JSON avec le message de l'exception
        return json_encode(['error' => 'Erreur lors de la récupération des villes des vosges.', 'details' => $e->getMessage()]);
    }
}

function getIdVilleVosgesByName($nom_ville_vosges)
{
    global $conn;
    try {
        $getIdVille = $conn->prepare('SELECT ville_id FROM villes_vosges WHERE nom_ville_vosges = :nom_ville_vosges');
        $getIdVille->bindValue(":nom_ville_vosges", $nom_ville_vosges, PDO::PARAM_STR);
        $getIdVille->execute();

        // Récupère directement l'identifiant de la ville
        $villeId = $getIdVille->fetchColumn();
        return $villeId !== false ? $villeId : null;
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
        return false;
    }
}

function getNomVilleVosgesByContactId($id_contact) {
    global $conn;
    try {
        $query = $conn->prepare('
            SELECT v.nom_ville_vosges
            FROM contacts_autres_villes cv
            JOIN villes_vosges v ON cv.id_ville_vosges = v.ville_id
            WHERE cv.id_contact = :id_contact
        ');
        $query->bindParam(':id_contact', $id_contact, PDO::PARAM_INT);
        $query->execute();
        
        return $query->fetchColumn(); // Retourne le nom de la ville
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
        return false; // Ou gérer l'erreur comme tu le souhaites
    }
}
