<?php
// global $db assure la connexion à la base de données, penser à configurer votre propre connexion $db


// Récupère toutes les villes de la table "Villes".
function getAllVilles()
{
    global $conn;
    $getVilles = $conn->prepare('SELECT * FROM villes ORDER BY priority ASC');
    $getVilles->execute();
    return $getVilles->fetchAll();
}

function getVilleById($ville_id)
{
    global $conn;

    try {
        // Préparation de la requête
        $getVille = $conn->prepare('SELECT nom_ville FROM villes WHERE id = :ville_id');

        // Liaison du paramètre ville_id
        $getVille->bindValue(':ville_id', $ville_id, PDO::PARAM_INT);

        // Exécution de la requête
        $getVille->execute();

        // Récupération du résultat (une seule ville)
        return $getVille->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
        return false; // Retourner false en cas d'erreur
    }
}

function getIdVilleByName($ville_name)
{
    global $conn;

    // Vérification de l'entrée
    if (empty($ville_name)) {
        error_log('getIdVilleByName: Le nom de la ville est vide ou non fourni.');
        return null; // Retourner null si le nom de la ville est vide
    }

    try {
        // Préparation de la requête
        $getVilleId = $conn->prepare('SELECT id FROM villes WHERE nom_ville = :ville_name');

        // Liaison du paramètre ville_name
        $getVilleId->bindValue(':ville_name', $ville_name, PDO::PARAM_STR);

        // Exécution de la requête
        if ($getVilleId->execute()) {
            // Récupération du résultat
            $villeGetByName = $getVilleId->fetch(PDO::FETCH_ASSOC);
            
            // Vérification si un résultat a été trouvé
            if ($villeGetByName && isset($villeGetByName['id'])) {
                return $villeGetByName['id']; // Retourner l'ID de la ville
            } else {
                error_log("getIdVilleByName: Aucun ID trouvé pour la ville '$ville_name'.");
                return null; // Retourner null si la ville n'est pas trouvée
            }
        } else {
            // Log de l'erreur si l'exécution de la requête a échoué
            error_log("getIdVilleByName: L'exécution de la requête a échoué pour la ville '$ville_name'.");
            return null;
        }
    } catch (PDOException $e) {
        // Gestion des exceptions PDO
        error_log('Erreur PDO dans getIdVilleByName: ' . $e->getMessage());
        return null; // Retourner null en cas d'erreur
    }
}


// Ajoute une nouvelle ville à la table "Villes".
function addVille($ville, $ordre_priorite, $ville_latitude, $ville_longitude, $liste, $carte)
{
    global $conn;
    $addVille = $conn->prepare('INSERT INTO villes (nom_ville, priority, latitude, longitude, liste, carte) VALUES (:ville_nom, :ordre_priorite, :ville_latitude, :ville_longitude, :liste, :carte)');
    $addVille->bindValue(':ville_nom', $ville, PDO::PARAM_STR);
    $addVille->bindValue(':ordre_priorite', $ordre_priorite, PDO::PARAM_INT);
    if ($ville_latitude !== "" && $ville_latitude !== null) {
        $addVille->bindValue(':ville_latitude', (float)$ville_latitude, PDO::PARAM_STR);
    } else {
        $addVille->bindValue(':ville_latitude', null, PDO::PARAM_NULL);
    }

    if ($ville_longitude !== "" && $ville_longitude !== null) {
        $addVille->bindValue(':ville_longitude', (float)$ville_longitude, PDO::PARAM_STR);
    } else {
        $addVille->bindValue(':ville_longitude', null, PDO::PARAM_NULL);
    }
    $addVille->bindValue(':liste', $liste, PDO::PARAM_INT);
    $addVille->bindValue(':carte', $carte, PDO::PARAM_INT);
    $addVille->execute();
}

// Supprime une ville de la table "Villes" par ID.
function deleteVille($ville_id)
{
    global $conn;

    try {
        $deleteVille = $conn->prepare('DELETE From villes WHERE id = :ville_id');
        $deleteVille->bindValue(':ville_id', $ville_id, PDO::PARAM_INT);
        $deleteVille->execute();
    } catch (PDOException $e) {
        error_log($e->getMessage());
        exit;
    }
}

// Met à jour le nom d'une ville dans la table "Villes" par ID.
function updateVille($nom_ville, $ville_id, $ordre_priorite, $ville_latitude, $ville_longitude, $liste, $carte)
{
    global $conn;
    $updateVille = $conn->prepare('UPDATE villes SET nom_ville = :ville_nom, priority = :ordre_priorite, latitude = :ville_latitude, longitude = :ville_longitude, liste = :liste, carte = :carte WHERE id = :ville_id');
    $updateVille->bindValue(':ville_nom', $nom_ville, PDO::PARAM_STR);
    $updateVille->bindValue(':ordre_priorite', $ordre_priorite, PDO::PARAM_INT);
    $updateVille->bindValue(':ville_id', $ville_id, PDO::PARAM_INT);
    $updateVille->bindValue(':ville_latitude', $ville_latitude, PDO::PARAM_STR);
    $updateVille->bindValue(':ville_longitude', $ville_longitude, PDO::PARAM_STR);
    $updateVille->bindValue(':liste', $liste, PDO::PARAM_INT);
    $updateVille->bindValue(':carte', $carte, PDO::PARAM_INT);
    $updateVille->execute();
}

// Récupère les villes pour la carte
function getVilleMap(){
    global $conn;
    try {
        $getVilleMap = $conn->query('SELECT * FROM villes WHERE carte = 1');
        return $getVilleMap->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
        return false;
    }
}

// Récupère les villes pour la liste
function getVilleListe(){
    global $conn;
    try {
        $getVilleListe = $conn->query('SELECT * FROM villes WHERE liste = 1 ORDER BY priority ASC');
        return $getVilleListe->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
        return false;
    }
}