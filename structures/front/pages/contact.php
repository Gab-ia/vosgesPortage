<!DOCTYPE html>
<html lang="fr" prefix="og: http://ogp.me/ns#">

<head>
    <?php
    include "structures/front/composants/tagManagerHead.php";
    ?>
    <title>Portage de repas à domicile dans les Vosges | Menu Portage par Croustillance</title>
    <meta name ="description" content ="Vous êtes intéressé par notre portage de repas à domicile ? Vous avez des questions quant à notre service de livraison? N'hésitez pas à nous contacter via ce formulaire, par mail ou par téléphone, nous serons ravis de vous conseiller et de vous fournir toutes les précisions dont vous avez besoin.">
    <meta name ="keywords" content="Contact,Contacter,Formulaire,Envoyer,Mail,Téléphone,Question,Portage,Livraison,Domicile,Semaine,Informations,Demande,Personnes âgées,Service,Remarque,Seniors,Santé,Message,Alimentaire,Troisième âge,Retraité,Vosges">
    <meta property="og:url" content ="http://vosges-portagefr/contact-vosges-portage" />
    <meta property="og:title" content="Contactez l’équipe Vosges Portage, livreur de repas à domicile">
    <meta property="og:description" content="Vous êtes intéressé par notre portage de repas à domicile ? Vous avez des questions quant à notre service de livraison? N'hésitez pas à nous contacter via ce formulaire, par mail ou par téléphone, nous serons ravis de vous conseiller et de vous fournir toutes les précisions dont vous avez besoin.">
    <meta property="og:image" content="http://vosges-portage.fr/assets/cards/contacter-vosges-portage.webp"/>
    <meta property="twitter:url" content ="http://vosges-portage.fr/contact-vosges-portage" />
    <meta property="twitter:title" content="Contactez l’équipe Vosges Portage, livreur de repas à domicile">
    <meta property="twitter:description" content="Vous êtes intéressé par notre portage de repas à domicile ? Vous avez des questions quant à notre service de livraison? N'hésitez pas à nous contacter via ce formulaire, par mail ou par téléphone, nous serons ravis de vous conseiller et de vous fournir toutes les précisions dont vous avez besoin.">
    <meta property="twitter:image" content="http://vosges-portage.fr/assets/cards/contacter-vosges-portage.webp"/>
    <?php
    include "structures/front/composants/head.php";
    ?>
        <style>
        .actif5 {
            color: #d66826ff !important;
        }
        .actif5 i {
            background-color: #d66826ff !important;
        }
    </style>
</head>

<body>
    <?php
    include "structures/front/composants/tagManagerBody.php";
    ?>

    <?php
    include "structures/front/composants/header.php";
    ?>

    <section class="container contact-1">
    <img src="/assets/images/logo-vosges-portage.svg" alt="Livraison de repas à domicile dans les vosges" width="340">
        <h1>CONTACTEZ-NOUS POUR PLUS D'INFORMATIONS</h1>
    </section>

    <section class="container contact-2">
        <form action="" method="post">
            <div class="contact-2-formulaire">
                <div class="contact-2-column">
                    <div class="contact-2-element">
                        <label for="prenom" class="contact-2-titre">Prénom :</label>
                        <input class="contact-2-input" type="text" id="prenom" name="prenom" placeholder="Votre prénom" required>
                    </div>
                    <div class="contact-2-element">
                        <label for="nom" class="contact-2-titre">Nom :</label>
                        <input class="contact-2-input" type="text" id="nom" name="nom" placeholder="Votre nom" required>
                    </div>
                    <div class="contact-2-element">
                        <label for="email" class="contact-2-titre">Email :</label>
                        <input class="contact-2-input" type="email" id="email" name="email" placeholder="Votre email" required>
                    </div>
                    <div class="contact-2-element">
                        <label for="tel" class="contact-2-titre">Téléphone :</label>
                        <input class="contact-2-input" type="tel" id="tel" name="tel" pattern="[0-9]{10}" placeholder="01 23 45 67 89" required>
                    </div>
                </div>
                <div class="contact-2-column">
                    <div class="contact-2-element">
                        <label for="villes">Ville de livraison : </label>
                        <select class="contact-2-input" name="villes" id="villes">
                            <option value="" selected disabled>-- Choisir une ville --</option>
                            <?php foreach (getVilleListe() as $ville) : ?>
                                <option value="<?= $ville['nom_ville'] ?>"><?= $ville['nom_ville'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="contact-2-element villeAutre d-none autocomplete">
                        <label for="autre_ville" class="contact-2-titre">Villes dans les vosges :</label>
                        <input class="contact-2-input" type="text" id="autre_ville" name="autre_ville" placeholder="Votre ville" required>
                    </div>
                    <div class="contact-2-element">
                        <label for="nombre-repas-semaine" class="contact-2-titre">Nombre de repas par semaine:</label>
                        <range-slider min=1 max=7 step=1 value="3" id="rangSlider"></range-slider>
                    </div>
                    <div class="contact-2-element">
                        <label for="message" class="contact-2-titre">Informations complémentaires...</label>
                        <textarea class="contact-2-input" id="message" name="message" placeholder="Allergènes, autres villes, questions..."></textarea>
                    </div>
                </div>
            </div>
            <?php flash(); ?>
            <button class="contact-2-button" type="submit">ENVOYER MA DEMANDE</button>
        </form>
    </section>

    <section class="container-fluid contact-3">
        <div id="map"></div>

        <script>
            // Fonction pour ajuster le zoom en fonction de la taille de l'écran
            function getInitialZoom() {
                if (window.innerWidth < 600) {
                    return 12; // Petit écran
                } else if (window.innerWidth < 1200) {
                    return 12; // Écran moyen
                } else {
                    return 12.4; // Grand écran
                }
            }
            // Initialisation de la carte centrée sur une région englobant toutes les villes
            let map = L.map('map', {
                center: [48.32, 6.375],
                zoom: getInitialZoom(),
                zoomControl: true, // Désactive le contrôle du zoom
                scrollWheelZoom: false, // Désactive le zoom avec la molette de la souris
                doubleClickZoom: false, // Désactive le zoom avec le double-clic
                boxZoom: true, // Désactive le zoom par sélection de boîte
                keyboard: false // Désactive le zoom avec le clavier
            });

            // Ajouter la couche de tuiles OpenStreetMap
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                maxZoom: 18,
            }).addTo(map);

            let customIcon = L.icon({
                iconUrl: './assets/images/iconMapTest.svg', // URL de l'image de l'icône
                iconSize: [50, 50], // Taille de l'icône
                iconAnchor: [50, 55], // Point de l'icône correspondant à la position du marqueur
                popupAnchor: [-3, -76] // Point où la popup doit s'ouvrir par rapport à l'icône
            });

            // Ajouter des marqueurs pour chaque ville avec une étiquette
            <?php
                $villes = getVilleMap();
            ?>
            let villes = <?php echo json_encode($villes, JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE); ?>;
            villes.forEach(function(ville) {
                let marker = L.marker([ville.latitude, ville.longitude], {
                    icon: customIcon
                }).addTo(map);

                let label = L.divIcon({
                    className: 'city-label',
                    html: ville.nom_ville,
                    iconSize: [100, 40],
                    iconAnchor: [50, 15]
                });

                L.marker([ville.latitude, ville.longitude], {
                    icon: label
                }).addTo(map);
            });

            window.addEventListener('resize', function() {
                map.setZoom(getInitialZoom());
            });
        </script>
        <style>
            .city-label {color:black;width:82px!important; height: fit-content!important; background: white!important; border: 2px, solid, #2d698cff; padding: 5px; font-weight:bold;}
        </style>
    </section>
    <?php
    include "structures/front/composants/footer.php";
    ?>

    <script src="/assets/js/js_perso/script-slider-repas.js"></script>
    <script src="/assets/js/js_perso/formulaire_Contact.js"></script>
</body>

</html>