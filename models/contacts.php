<?php
function getJsonContacts()
{
    global $conn;
    try {
        // Préparation de la requête SQL avec jointure
        $getJsonContacts = $conn->prepare('
            SELECT c.id, 
                   CONCAT(c.nom, " ", c.prenom) AS nom_complet, 
                   c.telephone, c.email, c.infos, c.nb_repas, v.nom_ville , c.date_inscription
            FROM contacts c
            INNER JOIN villes v ON c.id_ville = v.id
        ');

        // Exécution de la requête
        $getJsonContacts->execute();

        // Récupération des résultats
        $contacts = $getJsonContacts->fetchAll(PDO::FETCH_ASSOC);

        // Envoi de l'en-tête HTTP pour JSON
        header('Content-Type: application/json');

        // Encapsulation des données dans une clé "data"
        return json_encode(['data' => $contacts], JSON_NUMERIC_CHECK);
    } catch (PDOException $e) {
        // Journalisation de l'erreur dans les logs du serveur
        error_log('Erreur PDO: ' . $e->getMessage());

        // Envoi de l'en-tête HTTP pour erreur serveur
        header('Content-Type: application/json', true, 500);

        // Retour d'un message d'erreur JSON
        return json_encode(['error' => 'Erreur lors de la récupération des contacts.']);
    }
}


function getAllContacts()
{
    global $conn;
    try {
        $getContacts = $conn->prepare("SELECT * from contacts");
        $getContacts->execute();
        return $getContacts->fetchAll();
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
    }
}

function getIdContactByEmail($mail)
{
    global $conn;
    try {
        $getIdContact = $conn->prepare("SELECT id FROM contacts WHERE email = :email");
        $getIdContact->bindValue(":email", $mail, PDO::PARAM_STR);
        $getIdContact->execute();

        // Récupérer directement l'ID
        $idContact = $getIdContact->fetchColumn();

        // Si aucune ligne trouvée, retourne null
        return $idContact !== false ? $idContact : null;
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
        return false;
    }
}


function addContact($nom, $prenom, $tel, $email, $infos, $nb_repas, $id_ville, $date_inscription)
{
    global $conn;

    try {
        $addContact = $conn->prepare('INSERT INTO contacts (id,nom,prenom,telephone,email,infos,nb_repas,id_ville,date_inscription) VALUES (NULL,:nom,:prenom,:tel,:email,:infos,:nb_repas,:id_ville,:date_inscription)');
        $addContact->bindValue(":nom", $nom, PDO::PARAM_STR);
        $addContact->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $addContact->bindValue(":tel", $tel, PDO::PARAM_STR);
        $addContact->bindValue(":email", $email, PDO::PARAM_STR);
        $addContact->bindValue(":infos", $infos, PDO::PARAM_STR);
        $addContact->bindValue(":nb_repas", $nb_repas, PDO::PARAM_INT);
        $addContact->bindValue(":id_ville", $id_ville, PDO::PARAM_INT);
        $addContact->bindValue(":date_inscription", $date_inscription, PDO::PARAM_STR);
        $addContact->execute();
        // send mail
        $to = "julie@vosges-portage.fr";
        $subject = "Formulaire de contact Vosges-portage.fr";
        $message = "Nouveau message de : " . $prenom . " " . $nom . "\n" .
            "email : " . $email . "\n" .
            "telephone : " . $tel . "\n\n" .
            "Nombre repas : " . $nb_repas . "\n\n" .
            "Ville : " . getVilleById($id_ville)["nom_ville"] . "\n\n" .
            "Infos : " . $infos;

        $headers = "From: julie@vosges-portage.fr" . "\r\n" .
            "Reply-To: " . $email . "\r\n" .
            "Content-type: text/plain; charset= utf8\n";

        mail($to, $subject, $message, $headers);




        return true;
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
        return false;
    }
}

function updateContact($id_contact, $nom, $prenom, $tel, $email, $infos, $nb_repas, $id_ville)
{
    global $conn;

    try {
        $updateContact = $conn->prepare('UPDATE contacts SET nom = :nom, prenom = :prenom, telephone = :tel, email = :email, infos = :infos, nb_repas = :nb_repas, id_ville = :id_ville WHERE id = :id_contact');
        $updateContact->bindValue(":nom", $nom, PDO::PARAM_STR);
        $updateContact->bindValue(":prenom", $prenom, PDO::PARAM_STR);
        $updateContact->bindValue(":tel", $tel, PDO::PARAM_STR);
        $updateContact->bindValue(":email", $email, PDO::PARAM_STR);
        $updateContact->bindValue(":infos", $infos, PDO::PARAM_STR);
        $updateContact->bindValue(":nb_repas", $nb_repas, PDO::PARAM_INT);
        $updateContact->bindValue(":id_ville", $id_ville, PDO::PARAM_INT);
        $updateContact->bindValue(":id_contact", $id_contact, PDO::PARAM_INT);
        $updateContact->execute();
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
    }
}

function deleteContact($id_contact)
{
    global $conn;

    try {
        $deleteContact = $conn->prepare("DELETE FROM contacts where id = :id_contact");
        $deleteContact->bindValue(':id_contact', $id_contact, PDO::PARAM_INT);
        $deleteContact->execute();
    } catch (PDOException $e) {
        error_log('Erreur PDO: ' . $e->getMessage());
    }
}
