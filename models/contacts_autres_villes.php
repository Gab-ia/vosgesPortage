<?php

function createContactAutreVille($id_contact, $id_ville_vosges)
{
    global $conn;

    try {
        $create = $conn->prepare('INSERT INTO contacts_autres_villes (id_contact, id_ville_vosges) VALUES (:id_contact,:id_ville_vosges)');
        $create->bindValue(":id_contact", $id_contact, PDO::PARAM_INT);
        $create->bindValue(":id_ville_vosges", $id_ville_vosges, PDO::PARAM_INT);
        $create->execute();
        return true;
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
        return false;
    }
}
