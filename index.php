<?php
include("allInclude.php");

session_start();
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

switch ($page) {
        /* HOME */
    case 'home':
        include 'structures/front/pages/home.php';
        break;
        /*Aides financières*/
    case 'aides-financieres-repas-domicile':
        include 'structures/front/pages/aides.php';
        break;

        /*Contact*/
    case 'contact-vosges-portage':
        include 'structures/front/pages/contact.php';
        break;

    case 'user/add-contact':
        header('Content-Type: application/json');  // Définir le type de contenu JSON
        // Vérification de la méthode HTTP
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée. Seules les requêtes POST sont acceptées.']);
            http_response_code(405); // 405 Méthode non autorisée
            exit();
        }

        $data = json_decode(file_get_contents('php://input'), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['status' => 'error', 'message' => 'Données JSON invalides.']);
            http_response_code(400); // 400 Bad Request
            exit();
        }
        if (!empty($data)) {

            $requiredFields = ['nom', 'prenom', 'tel', 'mail', 'message', 'nb_repas', 'ville', 'date'];
            foreach ($requiredFields as $field) {
                if (empty($data[$field])) {
                    echo json_encode(['status' => 'error', 'message' => "Le champ $field est requis."]);
                    http_response_code(400); // 400 Bad Request
                    exit();
                }
            }

            $nom = $data['nom'];
            $prenom = $data['prenom'];
            $tel = $data['tel'];
            $mail = $data['mail'];
            $infos = $data['message'];
            $nb_repas = $data['nb_repas'];

            $id_ville = getIdVilleByName($data['ville']);
            if ($id_ville === null) {
                echo json_encode(['status' => 'error', 'message' => 'Ville non trouvée.']);
                http_response_code(400); // 400 Bad Request
                exit();
            }

            $date = $data['date'];

            $isAutreVilleSelection = false;
            if ($data['ville'] === 'Autre') {
                if (empty($data['autreVille'])) {
                    echo json_encode(['status' => 'error', 'message' => 'Veuillez spécifier une autre ville.']);
                    http_response_code(400); // 400 Bad Request
                    exit();
                }
                $autreVille = $data['autreVille'];
                $isAutreVilleSelection = true;
            }

            $ajoutContactSuccess = addContact($nom, $prenom, $tel, $mail, $infos, $nb_repas, $id_ville, $date);

            if ($isAutreVilleSelection && $ajoutContactSuccess) {
                $id_ville_vosges = getIdVilleVosgesByName($data['autreVille']);
                if ($id_ville_vosges === null) {
                    echo json_encode(['status' => 'error', 'message' => 'Autre ville non trouvée.']);
                    http_response_code(400); // 400 Bad Request
                    exit();
                }

                $id_contact = getIdContactByEmail($mail);
                if ($id_contact === null) {
                    echo json_encode(['status' => 'error', 'message' => 'Contact non trouvé.']);
                    http_response_code(400); // 400 Bad Request
                    exit();
                }

                $ajoutContactAutreVille = createContactAutreVille($id_contact, $id_ville_vosges);
                if (!$ajoutContactAutreVille) {
                    echo json_encode(['status' => 'error', 'message' => 'Échec de l\'ajout à une autre ville.']);
                    http_response_code(500); // 500 Internal Server Error
                    exit();
                }
                setFlash('Merci de votre message, nous vous contacterons au plus vite !', 'success');
                echo json_encode([
                    'status' => 'success',
                    'message' => "Merci de votre message, nous vous contacterons au plus vite !",
                    'redirect' => '/contact-vosges-portage'  // URL pour redirection
                ]);
            } else {
                if ($ajoutContactSuccess) {
                    setFlash('Merci de votre message, nous vous contacterons au plus vite !', 'success');
                    echo json_encode([
                        'status' => 'success',
                        'message' => "Merci de votre message, nous vous contacterons au plus vite !",
                        'redirect' => '/contact-vosges-portage'  // URL pour redirection
                    ]);
                } else {
                    setFlash('Un problème est survenu.', 'danger');
                    echo json_encode([
                        'status' => 'error',
                        'message' => "Un problème est survenu.",
                        'redirect' => '/contact-vosges-portage'  // URL pour redirection
                    ]);
                }
            }
        }

        exit();
        break;


        /*équipe*/
    case 'equipe-vosges-portage':
        include 'structures/front/pages/equipe.php';
        break;

        /*Les menus*/
    case 'menus-portage-domicile':
        include 'structures/front/pages/les-menus.php';
        break;
        /*Modalités*/
    case 'infos-portage-repas':
        include 'structures/front/pages/modalites.php';
        break;
        /*Mentions légales*/
    case 'mentions-legales':
        include 'structures/front/pages/mentionsLegales.php';
        break;

    case 'login':
        include 'structures/front/pages/login.php';
        break;

    case 'login-action':
        if (!empty($_POST['email-username']) and !empty($_POST['password'])) {
            check_login(trim($_POST['email-username']), trim($_POST['password']));
        } else {
            setFlash('Une erreur est survenue', 'danger');
            header('Location: /login');
        }
        break;

    case 'logout':
        logout();
        break;

    case 'admin/home':
        security("all");
        include 'structures/back/pages/home.php';
        break;

    case 'admin/users':
        security("admin");
        include 'structures/back/pages/users.php';
        break;

    case 'admin/users-password-change':
        security("admin");
        if (!empty($_POST['newPassword']) && !empty($_POST['user_id'])) {
            changePassword(trim($_POST['user_id']), trim($_POST['newPassword']));
            setFlash('Mot de passe modifié', 'success');
        } else {
            setFlash('Une erreur est survenue', 'danger');
        }
        header('Location: /admin/users');
        break;

    case 'admin/users-update':
        security("admin");
        if (!empty($_POST)) {
            if (!empty($_POST['is_admin'])) {
                $is_admin = 1;
            } else {
                $is_admin = 0;
            };
            if (!empty($_POST['email_verified'])) {
                $email_verified = 1;
            } else {
                $email_verified = 0;
            };
            updateUser(trim($_POST['userid']), trim($_POST['pseudo']), trim($_POST['nom']), trim($_POST['prenom']), trim($_POST['email']), trim($_POST['telephone']), $is_admin, $email_verified);

            setFlash('Utilisateur modifié', 'success');
        } else {
            setFlash('Une erreur est survenue', 'danger');
        }
        header('Location: /admin/users');
        break;

    case 'admin/users-delete':
        security("admin");
        if (!empty(trim($_POST['item_id']))) {
            deleteUser(trim($_POST['item_id']));
            setFlash('Utilisateur effacé', 'success');
        } else {
            setFlash('Une erreur est survenue', 'danger');
        }
        header('Location: /admin/users');
        break;

    case 'api/users':
        security("admin");
        echo getJsonUsers();
        break;

    case 'api/menus':
        header("Content-type: application/json; charset=utf-8");
        echo getJsonMenus();
        break;

    case 'api/contacts':
        echo getJsonContacts();
        break;

    case 'api/villes_vosges':
        echo getJsonVillesVosges();
        exit();  // S'assurer que rien d'autre n'est envoyé
        break;


    case 'api/getNomVilleVosgesFromIdContact':
        header('Content-Type: application/json');  // Définir le type de contenu JSON
        // Vérification de la méthode HTTP
        if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
            echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée. Seules les requêtes GET sont acceptées.']);
            http_response_code(405); // 405 Méthode non autorisée
            exit();
        }

        $data = json_decode(file_get_contents('php://input'), true);
        // Vérification si l'ID de contact est présent dans la requête
        if (isset($_GET['id_contact'])) {
            $id_contact = intval($_GET['id_contact']); // Convertir en entier pour plus de sécurité

            // Ici, tu peux appeler ta fonction pour récupérer le nom de la ville
            $nomVille = getNomVilleVosgesByContactId($id_contact); // Appelle la fonction que tu as définie

            if ($nomVille) {
                echo json_encode(['status' => 'success', 'nom_ville' => $nomVille]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Ville non trouvée pour cet ID de contact.']);
            }
        } else {
            // Si l'ID n'est pas fourni
            echo json_encode(['status' => 'error', 'message' => 'ID de contact manquant.']);
            http_response_code(400); // 400 Bad Request
        }

        exit();
        break;
    case 'admin/menus':
        security("all");
        include 'structures/back/pages/menus.php';
        break;

    case 'admin/menu-add':
        security("admin");
        if (!empty($_POST['newMenuDate']) and !empty($_POST['newMenuEntree']) and !empty($_POST['newMenuPlat']) and !empty($_POST['newMenuDessert'])) {

            // Vérifie si le menu existe déjà et récupère l'ID si oui
            $menuId = isMenuInTable($_POST['newMenuDate']);

            if (!$menuId) {
                // Le menu n'existe pas, on l'ajoute
                addMenus($_POST['newMenuEntree'], $_POST['newMenuPlat'], $_POST['newMenuDessert'], $_POST['newMenuDate']);
                setFlash('Menu ajouté avec succès', 'success');
            } else {
                // Le menu existe, on le met à jour avec l'ID récupéré
                updateMenus($menuId, $_POST['newMenuEntree'], $_POST['newMenuPlat'], $_POST['newMenuDessert'], $_POST['newMenuDate']);
                setFlash('Menu mis à jour avec succès (id = ' . $menuId . ')', 'success');
            }
        } else {
            setFlash('Une erreur est survenue', 'danger');
        }

        header('Location: /admin/menus');
        exit();
        break;


    case 'admin/menu-edit':
        security("admin");
        if (!empty($_POST['editMenuDate']) and !empty($_POST['editMenuEntree']) and !empty($_POST['editMenuPlat']) and !empty($_POST['editMenuDessert']) and !empty($_POST['hiddenMenuId'])) {
            updateMenus($_POST['hiddenMenuId'], $_POST['editMenuEntree'], $_POST['editMenuPlat'], $_POST['editMenuDessert'], $_POST['editMenuDate']);
            setFlash('Menu édité avec succès', 'success');
        } else {
            setFlash('Une erreur est survenue', 'danger');
        }
        header('Location: /admin/menus');
        exit();
        break;

    case 'admin/menu-delete':
        security("admin");
        if (!empty($_POST['item_id'])) {
            deleteMenus(trim($_POST['item_id']));
            setFlash("Menu supprimé avec succès", "success");
        } else {
            setFlash('Une erreur est survenue', 'danger');
        }
        header('Location: /admin/menus');
        exit();
        break;


    case 'admin/importExcelMenus':
        security("admin");
        include 'structures/back/pages/importExcelMenus.php';
        break;

    case 'admin/import-menu':
        header('Content-Type: application/json');  // Définir le type de contenu JSON
        // Vérification de la méthode HTTP
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            echo json_encode(['status' => 'error', 'message' => 'Méthode non autorisée. Seules les requêtes POST sont acceptées.']);
            http_response_code(405); // 405 Méthode non autorisée
            exit();
        }
        $data = json_decode(file_get_contents('php://input'), true);
        if (!empty($data)) {
            // Variable pour suivre le nombre d'insertions réussies
            $successfulInserts = 0;
            $successfulUpdate = 0;
            $echec = 0;

            for ($i = 0; $i < count($data); $i++) {
                $row = $data[$i];
                // Supposons que le fichier Excel a la structure suivante : Date | Entrée | Plat | Dessert
                $excelDate = $row[0];
                $entree = $row[1]; // Entrée
                $plat = $row[2]; // Plat
                $dessert = $row[3]; // Dessert

                // Convertir la date Excel en format PHP (YYYY-MM-DD)
                $date = is_numeric($excelDate) ? excelDateToPHPDate($excelDate) : date('Y-m-d', strtotime($excelDate));

                $menuId = isMenuInTable($date);

                if (!$menuId) {
                    if (addMenus($entree, $plat, $dessert, $date)) {
                        $successfulInserts++;
                    } else {
                        $echec++;
                    }
                } else {
                    if (updateMenus($menuId, $entree, $plat, $dessert, $date)) {
                        $successfulUpdate++;
                    } else {
                        $echec++;
                    }
                }
            }
            // Afficher un message en fonction du nombre d'insertions réussies
            if ($successfulInserts > 0 || $successfulUpdate > 0) {
                setFlash("Menu ajouté avec succès ({$successfulInserts} entrées), menu mis à jour avec succès ({$successfulUpdate} entées) et {$echec} échecs. ", 'success');
                echo json_encode([
                    'status' => 'success',
                    'message' => "Menu ajouté avec succès ({$successfulInserts} entrées) et menu mis à jour avec succès ({$successfulUpdate} entées).",
                    'redirect' => '/admin/menus'  // URL pour redirection
                ]);
            } else {
                echo json_encode(['status' => 'error', 'message' => 'Aucune donnée reçue ou une erreur est survenue.']);
            }
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Aucune donnée reçue ou une erreur est survenue.']);
        }
        exit();
        break;

    case 'admin/zone':
        security("all");
        include 'structures/back/pages/admin-zone.php';
        break;

    case 'admin/update-zone';
        security("all");

        if (!empty($_POST['updateVilleText']) and !empty($_POST['hiddenVilleId']) and !empty($_POST['updateOrdrePriorite'])) {
            $villeListe = isset($_POST['update_ville_liste']) ? 1 : 0;
            $villeCarte = isset($_POST['update_ville_carte']) ? 1 : 0;
            $updateLatitude = !empty($_POST['updateLatitude']) ? trim($_POST['updateLatitude']) : null;
            $updateLongitude = !empty($_POST['updateLongitude']) ? trim($_POST['updateLongitude']) : null;
            updateVille(trim($_POST['updateVilleText']), trim($_POST['hiddenVilleId']), trim($_POST['updateOrdrePriorite']), $updateLatitude, $updateLongitude, $villeListe, $villeCarte);
            setFlash('Zone modifiée avec succès', 'success');
        } else {
            setFlash('Une erreur est survenue' . $_POST['updateVilleText'] . $_POST['hiddenVilleId'] . $_POST['updateOrdrePriorite'] . $_POST['updateLatitude'] . $_POST['updateLongitude'], 'danger');
        }
        header('Location: /admin/zone');
        break;

    case 'admin/new-zone';
        security("all");

        if (!empty($_POST['ville_nom']) && !empty($_POST['ordre_priorite'])) {
            $villeListe = isset($_POST['ville_liste']) ? 1 : 0;
            $villeCarte = isset($_POST['ville_carte']) ? 1 : 0;
            $villeLatitude = isset($_POST['ville_latitude']) && $_POST['ville_latitude'] !== "" ? (float)$_POST['ville_latitude'] : null;
            $villeLongitude = isset($_POST['ville_longitude']) && $_POST['ville_longitude'] !== "" ? (float)$_POST['ville_longitude'] : null;
            addVille(trim($_POST['ville_nom']), trim($_POST['ordre_priorite']),$villeLatitude, $villeLongitude, $villeListe, $villeCarte);
            setFlash('Nouvelle condition ajoutée', 'success');
        } else {
            setFlash('Une erreur est survenue', 'danger');
        }
        header('Location: /admin/zone');
        break;

    case 'admin/delete-ville';
        security("all");
        if (!empty($_POST['item_id'])) {
            deleteVille(trim($_POST['item_id']));
            setFlash('Zone effacée avec succès', 'success');
        } else {
            setFlash('Une erreur est survenue', 'danger');
        }
        header('Location: /admin/zone');
        break;


    case 'admin/contacts':
        include 'structures/back/pages/contacts.php';
        break;

        /* 404 NOT FOUND */

    default:
        header("HTTP/1.1 404 Not Found");
        include 'structures/back/pages/page-404.html';
        break;
}
