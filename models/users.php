<?php
function check_login($user_data, $password) {
    global $conn;
    $edit = $conn->prepare('select * FROM users WHERE email = :user_data OR User_name = :user_data');
    $edit->bindValue(':user_data', $user_data, PDO::PARAM_STR);
    $edit->execute();
    $user = $edit->fetch();
    if ($edit->rowCount() && $password == $user['Password']) {
        $_SESSION['User'] = ["userId" => $user["ID"],"userName" => $user["User_name"],"isAdmin" => $user["Is_admin"]];
        setFlash('Bienvenue ' . $user["First_name"], 'success');
        header('Location: /admin/home');
    } else {
        setFlash('Désolé, il y a eu un problème !!', 'danger');
        header('Location: /login');
    }

    exit();
}

function logout() {
    // cleaning logout
        unset($_SESSION['User']);
        session_destroy();
        session_start();
        setFlash('Salut, à la prochaine !!', 'success');
        header('Location: /login');
    }

function security($role) {
    if(!isset($_SESSION["User"])) {
        header('Location: /login');
        exit();
    }
    if($role == "admin" && $_SESSION['User']["isAdmin"] == 0) {
        header('Location: /sorry');
        exit();
    }
}

function getJsonUsers() {
    global $conn;
    $getJson = $conn->prepare('SELECT ID AS id, First_name, Last_name, Is_admin, concat(first_name, " ", last_name) AS full_name, Phone, (CASE WHEN Is_admin = 0 THEN "Utilisateur" WHEN Is_admin = 1 THEN "Admin" END) as role,date_format(Registration_date,"%Y-%m-%d") AS creation_date, User_name as username, Email as email, (CASE WHEN (verification_email = 0 and (DATEDIFF(DATE(NOW()), Registration_date)) > 15) THEN 3 WHEN (verification_email = 0 and DATEDIFF(DATE(NOW()), Registration_date) < 15) THEN 1 WHEN verification_email = 1 THEN 2 END) as status, "" as avatar FROM users');
    $getJson->execute();
    $users = $getJson->fetchAll(PDO::FETCH_ASSOC);
    return "{\"data\": ".json_encode($users,JSON_NUMERIC_CHECK)."}";
}

function showAdminNav() {
    if($_SESSION['User']['isAdmin']) {
        return true;
    } else {
        return false;
    }
}

function getUserById($id) {
    global $conn;
    $edit = $conn->prepare('select * FROM users WHERE ID = :user_id');
    $edit->bindValue(':user_id', $id, PDO::PARAM_STR);
    $edit->execute();
    $user = $edit->fetch();
  return $user;
}

function changePassword($idUser, $newPassword) {
    global $conn;
    $changePassord = $conn->prepare('update users set Password = :newPassword where ID = :userID');
    $changePassord->bindValue(':userID', $idUser, PDO::PARAM_INT);
    $changePassord->bindValue(':newPassword', $newPassword, PDO::PARAM_STR);
    $changePassord->execute();
}

function updateUser($idUser, $pseudo,$nom, $prenom, $email, $telephone, $is_admin, $email_verified) {
    global $conn;
    $updateUser = $conn->prepare('update users set User_name = :pseudo, First_name = :prenom, Last_name = :nom, Email = :email, Phone= :telephone, Is_admin = :is_admin, Verification_email = :email_verified where ID = :idUser');
    $updateUser->bindValue(':idUser', $idUser, PDO::PARAM_INT);
    $updateUser->bindValue(':pseudo', $pseudo, PDO::PARAM_STR);
    $updateUser->bindValue(':nom', $nom, PDO::PARAM_STR);
    $updateUser->bindValue(':prenom', $prenom, PDO::PARAM_STR);
    $updateUser->bindValue(':email', $email, PDO::PARAM_STR);
    $updateUser->bindValue(':telephone', $telephone, PDO::PARAM_STR);
    $updateUser->bindValue(':is_admin', $is_admin, PDO::PARAM_INT);
    $updateUser->bindValue(':email_verified', $email_verified, PDO::PARAM_INT);
    $updateUser->execute();
}

function deleteUser($idUser) {
    global $conn;
    try {
    $deleteUser = $conn->prepare('delete from users where ID = :idUser');
    $deleteUser->bindValue(':idUser', $idUser, PDO::PARAM_INT);
    $deleteUser->execute();
} catch(PDOException $e) {
    setFlash('Désolé, impossible d\'effacer cet utilisateur', 'danger');
    header('Location: '.$_SERVER['HTTP_REFERER']);
    exit;
 } 
}






?>