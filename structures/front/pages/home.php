<!DOCTYPE html>
<html lang="fr" prefix="og: http://ogp.me/ns#">

<head>
    <?php
    include "structures/front/composants/tagManagerHead.php";
    ?>
    <title>Portage de repas à domicile dans les Vosges | par Croustillance Traiteur</title>
    <meta name="description" content="Chez Vosges Portage, nous vous cuisinons et livrons de bons petits plats à domicile, de la région de Charmes jusqu’à Chavelot. C’est la recette idéale pour aider les personnes âgées ou en perte d’autonomie à  mieux savourer la vie !">
    <meta name="keywords" content="Repas,Menu,Portage,Livraison,Domicile,Personnes âgées,Service,Equilibrés,Seniors,Santé,Plateaux,Alimentaire,Troisième âge,Retraité,Nutritif,Equilibrés,Savoureux">
    <meta property="og:url" content="https://vosges-portage.fr" />
    <meta property="og:title" content="Vosges Portage,pour savourer la vie jour après jour !">
    <meta property="og:description" content="Chez Vosges Portage, nous vous cuisinons et livrons de bons petits plats à domicile, de la région de Charmes jusqu’à Chavelot. C’est la recette idéale pour aider les personnes âgées ou en perte d’autonomie à  mieux savourer la vie !">
    <meta property="og:image" content="http://vosges-portage.fr/assets/cards/vosges-portage.webp" />
    <meta property="twitter:url" content="https://vosges-portage.fr" />
    <meta property="twitter:title" content="Vosges Portage,pour savourer la vie jour après jour !">
    <meta property="twitter:description" content="Chez Vosges Portage, nous vous cuisinons et livrons de bons petits plats à domicile, de la région de Charmes jusqu’à Chavelot. C’est la recette idéale pour aider les personnes âgées ou en perte d’autonomie à  mieux savourer la vie !">
    <meta property="twitter:image" content="http://vosges-portage.fr/assets/cards/vosges-portage.webp" />
    <?php
    include "structures/front/composants/head.php";
    ?>
    <style>
        .actif6 {
            color: #d66826ff !important;
        }
        .actif6 i {
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

    <section class="container accueil-1">
        <img src="/assets/images/logo-vosges-portage.svg" alt="Livraison de repas à domicile dans les vosges" width="340">
        <h1>SERVICE TRAITEUR ET LIVRAISON</h1>
    </section>

    <section class="container accueil-2">
        <h2>CE QUE L'ON VOUS PROPOSE</h2>
        <div>
            <div>
                <img src="/assets/images/entree-plat-dessert-3.webp" alt="Repas complet et équilibré" width="100%" height="auto">
                <h3>DES REPAS SAVOUREUX</h3>
                <p>Vos repas sont préparés par Marc, un cuisinier expérimenté avec plus de 45 ans d'expérience, qui veille scrupuleusement au respect des règles d’hygiène. Il propose une <b>cuisine familiale et équilibrée</b> avec des <b>produits de qualité</b>. Les repas peuvent être adaptés à vos goûts et aux consignes médicales, incluant des options sans chou ni épinards, sans poisson, sans viande, sans fibres, et avec des textures adaptées (hachés, moulinés).</p>
            </div>
            <div>
                <img src="/assets/images/preparation-barquette.webp" alt="Cuisinier en train de préparer un bon petit plat" width="100%" height="auto">
                <h3>DE QUALITÉ TRAITEUR</h3>
                <p>Croustillance, <b>traiteur dans les Vosges</b> depuis 10 ans, offre un service de livraison de repas à domicile pour les personnes âgées, handicapées ou en perte d’autonomie. <b>Le service est flexible</b>, avec plusieurs formules tarifaires ajustées, et s’adapte à vos besoins, que ce soit pour quelques jours après une hospitalisation ou plusieurs fois par semaine.</p>
            </div>
            <div>
                <img src="/assets/images/photo_livraison_2.webp" alt="Sabrina livrant son repas à un client" width="100%" height="auto">
                <h3>EN LIVRAISON À DOMICILE</h3>
                <p>Nos porteuses, Catherine, Sabrina et Sabrina, passent de <b>1 à 6 fois par semaine</b>, à heure fixe (le repas du dimanche est livré le samedi). En plus de livrer les repas, elles assurent un service de veille sociale, échangeant un mot, un sourire, et des informations avec les bénéficiaires. Elles peuvent ranger les plats au réfrigérateur et retirer ceux périmés si nécessaire. Elles gardent les numéros d’urgence à portée de main et informent la famille en cas d'absence imprévue. Ces attentions font partie intégrante de notre accompagnement.</p>
            </div>
        </div>
    </section>

    <section class="carousel-menu-jour">
        <div class="carousel-container">
                <div class="carousel">
                    <div class="test">
                        <div id="loading-animation" style="width: 100%; height: 200px; display: flex; align-items: center; justify-content: center;"></div>
                        <div class="carousel-inner" id="carouselInner"></div>
                    </div>
                </div>
                <div class="buttons-menu-jour">
                    <button class="button-menu-jour bLeft" id="prevButton" onclick="prevCard()">
                        <i class="fa-solid fa-arrow-left fa-2xl fleche-menu-jour"></i>
                    </button>
                    <button class="button-menu-jour bRight" id="nextButton" onclick="nextCard()">
                        <i class="fa-solid fa-arrow-right fa-2xl fleche-menu-jour"></i>
                    </button>
                </div>
        </div>
    </section>

    <section class="container accueil-3">
        <h2>DE BONS PETITS PLATS DE <b>QUALITÉ SUPÉRIEUR</b></h2>
        <img src="/assets/images/photo_groupe_ext.webp" alt="Photo de l'équipe Vosges Portage devant leur locaux" width="100%">
        <p><b>Traiteur et créateur de saveurs</b> dans les <b>Vosges</b> depuis 10 ans, propose un <b>service de livraison de repas à domicile</b> destiné aux personnes âgées, handicapées ou en perte d’autonomie. Vous n’avez pas le cœur à cuisiner pour vous tout seul ? Votre conjoint qui prépare habituellement les repas est absent pour quelques jours, parti en maison de retraite ou en EHPAD ? Grâce à notre service Menu Portage, faites-vous livrer à domicile <b>des plats gourmands et équilibrés</b>, concoctés dans notre laboratoire de Nomexy :</p>
        <div>
            <div>
                <img src="/assets/images/entree.png" alt="icône entrée" width="75">
                <p><b>Entrée</b></p>
            </div>
            <div>
                <img src="/assets/images/plat.png" alt="icône plat" width="75">
                <p><b>Plat</b></p>
            </div>
            <div>
                <img src="/assets/images/dessert.png" alt="icône dessert" width="75">
                <p><b>Dessert</b></p>
            </div>
            <div>
                <img src="/assets/images/fromage.png" alt="icône suppléments" width="75">
                <p><b>Fromage, pains frais, potage...</b></p>
            </div>
        </div>
        <p>Vous avez le choix entre <b>plusieurs formules tarifaires</b> très ajustées, et le service est d’une grande souplesse. Vous pouvez vous faire livrer durant quelques jours seulement, après une sortie d’hôpital par exemple, une ou plusieurs fois par semaine, etc.</p>
    </section>

    <section class="container-fluid accueil-4">
        <h2>DES REPAS SAVOUREUX ET ADAPTÉS</h2>
        <h3>À VOTRE ÉTAT DE SANTÉ</h3>
        <a href="/menus-portage-domicile"><b>DÉCOUVRIR NOS MENUS</b></a>
    </section>

    <section class="container accueil-5">
        <h2>NOS REPAS</h2>
        <img src="/assets/images/photo_groupe_int.webp" alt="Photo de l'équipe Vosges Portage dans leur locaux" width="100%">
        <p>Vos repas sont préparés par Marc, un cuisinier <b>très expérimenté</b>, puisqu’il s’active derrière les fourneaux depuis plus de 45 ans ! Méthodique et intraitable sur le respect des règles d’hygiène, Marc prépare une cuisine familiale et équilibrée avec des <b>produits de qualité</b>. Nos repas sont <b>adaptés à vos goûts</b>, et éventuellement <b>aux consignes des médecins</b>. Nous fournissons sur simple demande des plats :</p>
        <div>
            <div>
                <img src="/assets/images/epinard.png" alt="icône épinard" width="75">
                <p><b>Sans chou ni épinards pour les personnes traitées par AVK</b></p>
            </div>
            <div>
                <img src="/assets/images/poisson.png" alt="icône poisson" width="75">
                <p><b>Sans poisson</b></p>
            </div>
            <div>
                <img src="/assets/images/fibre.png" alt="icône fibre" width="75">
                <p><b>Sans fibres</b></p>
            </div>
            <div>
                <img src="/assets/images/viande.png" alt="icône viande" width="75">
                <p><b>Sans viande</b></p>
            </div>
            <div>
                <img src="/assets/images/hache.png" alt="icône nourriture adaptée" width="75">
                <p><b>Texture adaptées : repas hachés, moulinés, etc.</b></p>
            </div>
        </div>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lottie-web/5.9.6/lottie.min.js"></script>
    <script src="/assets/js/js_perso/script-menu-jour.js"></script>
</body>

</html>