<?php

// global $db assure la connexion à la base de données, penser à configurer votre propre connexion $db

// Récupère tous les menus de la table "Menus".
function getAllMenus()
{
    global $conn;
    $getMenus = $conn->prepare('SELECT * FROM menus ORDER BY date');
    $getMenus->execute();
    return $getMenus->fetchAll();
}

function isMenuInTable($dateMenu)
{
    global $conn;

    try {
        $requete = $conn->prepare('SELECT id FROM menus WHERE date = :dateMenu');
        $requete->bindValue(':dateMenu', $dateMenu, PDO::PARAM_STR);
        $requete->execute();

        // Récupérer l'ID du menu s'il existe
        $menu = $requete->fetch(PDO::FETCH_ASSOC);
        return $menu ? $menu['id'] : false;
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
        return false;
    }
}



// Ajoute un nouveau menu dans la table "Menus".
function addMenus($entree, $plat, $dessert, $date)
{
    global $conn;
    try {
        $addMenu = $conn->prepare('INSERT INTO menus (id, entree, plat, dessert, date) VALUES (NULL, :entree_menu, :plat_menu, :dessert_menu, :date_menu)');
        $addMenu->bindValue(':entree_menu', $entree, PDO::PARAM_STR);
        $addMenu->bindValue(':plat_menu', $plat, PDO::PARAM_STR);
        $addMenu->bindValue(':dessert_menu', $dessert, PDO::PARAM_STR);
        $addMenu->bindValue(':date_menu', $date, PDO::PARAM_STR);
        // Exécuter la requête
        if ($addMenu->execute()) {
            return true;  // Succès de l'insertion
        } else {
            return false; // Échec de l'insertion
        }
    } catch (PDOException $e) {
        error_log("Erreur lors de l'ajout du menu : " . $e->getMessage());
        return false;
    }
}

// Supprime un menu de la table "Menus" par ID.
function deleteMenus($menu_id)
{
    global $conn;
    try {
        $deleteMenu = $conn->prepare('DELETE FROM menus WHERE id = :menu_id');
        $deleteMenu->bindValue(':menu_id', $menu_id, PDO::PARAM_INT);
        $deleteMenu->execute();
    } catch (PDOException $e) {
        error_log($e->getMessage());
        exit;
    }
}

// Met à jour un menu dans la table "Menus" par ID.
function updateMenus($menu_id, $entree, $plat, $dessert, $date)
{
    global $conn;
    try {
        $updateVille = $conn->prepare('UPDATE menus SET entree = :entree, plat = :plat, dessert = :dessert, date = :date WHERE id = :menu_id');
        $updateVille->bindValue(':entree', $entree, PDO::PARAM_STR);
        $updateVille->bindValue(':plat', $plat, PDO::PARAM_STR);
        $updateVille->bindValue(':dessert', $dessert, PDO::PARAM_STR);
        $updateVille->bindValue(':date', $date, PDO::PARAM_STR);
        $updateVille->bindValue(':menu_id', $menu_id, PDO::PARAM_INT);

        if ($updateVille->execute()) {
            return true;
        } else {
            return false;
        }
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
        return false;
    }
}


function getJsonMenus()
{
    global $conn;
    $getJson = $conn->prepare('SELECT * FROM menus WHERE date > DATE_ADD(now(), INTERVAL -10 DAY) ORDER BY date ASC');
    $getJson->execute();
    $menus = $getJson->fetchAll(PDO::FETCH_ASSOC);
    return json_encode($menus);
}

function excelDateToPHPDate($excelDate)
{
    // Convertir le timestamp Excel en une date PHP (nombre de jours depuis 1er janvier 1900)
    $unixDate = ($excelDate - 25569) * 86400;  // 25569 correspond à la différence entre 1900-01-01 et 1970-01-01 en jours
    return date('Y-m-d', $unixDate);  // Retourner la date au format YYYY-MM-DD
}
