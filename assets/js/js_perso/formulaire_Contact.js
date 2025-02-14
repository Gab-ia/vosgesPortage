// Sélection des éléments du DOM
const submitButton = document.querySelector(".contact-2-button"); // Modification pour correspondre au nouveau bouton
const formElements = {
    nom: document.getElementById("nom"),
    prenom: document.getElementById("prenom"),
    tel: document.getElementById("tel"),
    mail: document.getElementById("email"),
    message: document.getElementById("message"),
    nb_repas: document.getElementById("rangSlider"),
    ville: document.getElementById("villes"),
    autreVille: document.getElementById("autre_ville"),
    formulaire: document.querySelector(".contact-2-formulaire")
};

const formElementsValue = {
    nom: '',
    prenom: '',
    tel: '',
    mail: '',
    message: '',
    nb_repas: 0,
    ville: '',
    autreVille: '',
    date: ''
};
let tabVillesVosges = [];
let isAutreVille = false;

// Association des fonctions de validation avec les champs de formulaire
const validators = {
    nom: checkTexte,
    prenom: checkTexte,
    tel: checkPhone,
    mail: checkMail,
    message: checkMessage,
    ville: checkVille,
    autreVille: checkAutreVille
};

// Ajout d'un écouteur d'événement pour le clic sur le bouton de soumission
submitButton.addEventListener("click", (event) => {
    // Empêcher le comportement par défaut du formulaire (soumission de la page)
    event.preventDefault();
    let isFormValid = true; // Indicateur de validation globale du formulaire

    // Parcourir chaque élément du formulaire
    for (const [key, element] of Object.entries(formElements)) {
        // Ignorer l'élément 'formulaire' lui-même
        if (key === 'formulaire' || key === 'nb_repas') continue;

        if (key === 'autreVille' && !isAutreVille) continue;

        // Validation de l'élément courant
        const isValid = validators[key](element.value);
        if (!isValid) {
            isFormValid = false; // Si une validation échoue, le formulaire est invalide
            highlightError(element);
        } else {
            formElementsValue[key] = element.value;
        }
    }

    // Si le formulaire contient des erreurs, déclencher l'animation de secousse
    if (!isFormValid) {
        shackerFormulaire();
    } else {

        formElementsValue.date = new Date().toISOString().split('T')[0];
        formElementsValue.nb_repas = formElements.nb_repas.value;
        console.log(formElementsValue);
        fetch('/user/add-contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(formElementsValue)
        })
            .then(response => response.json())
            .then(result => {
                if (result.redirect) {
                    window.location.href = result.redirect
                }
            })
            .catch(error => {
                console.error('Erreur lors de l\'envoi des données :', error);
            });


    }
});

// Fonction de validation pour les champs texte (nom, prénom)
function checkTexte(texte) {
    // Vérifie si le texte contient uniquement des lettres (a-z, A-Z)
    return /^[A-zÀ-ú]+$/.test(texte.trim());
}

// Fonction de validation pour les adresses e-mail
function checkMail(mail) {
    // Vérifie si l'adresse e-mail est valide
    return /^[a-z0-9._-]+@[a-z0-9._-]+\.[a-z0-9._-]+$/.test(mail.trim());
}

// Fonction de validation pour les numéros de téléphone
function checkPhone(numero) {
    // Vérifie si le numéro de téléphone contient exactement 10 chiffres
    return /^[0-9]{10}$/.test(numero.trim());
}

// Fonction de validation pour la ville
function checkVille(ville) {
    // Vérifie si une ville a bien été sélectionnée
    return ville.trim() !== '';
}

// Fonction de validation pour le message
function checkMessage(message) {
    // Vérifie si le message contient au moins 0 caractères et moins de 500 caractères
    return message.trim().length >= 0 && message.trim().length < 500;
}

function checkAutreVille(autreVille) {
    // Ne valider que si l'option "Autre" est sélectionnée
    if (isAutreVille) {
        // Vérifie si la ville saisie est dans la liste des villes des Vosges
        return tabVillesVosges.includes(autreVille.trim());
    }
    return true; // Retourne true si `autreVille` n'est pas visible ou n'est pas concerné
}

// Fonction pour animer le formulaire en cas d'erreur de validation
function shackerFormulaire() {
    // Ajouter la classe 'animer' pour déclencher l'animation CSS
    formElements.formulaire.classList.add("animer");
    // Retirer la classe 'animer' après 1 seconde pour arrêter l'animation
    setTimeout(() => {
        formElements.formulaire.classList.remove("animer");
    }, 1000);
}

// Fonction pour surligner les erreurs dans le formulaire
function highlightError(element) {
    element.style.backgroundColor = 'lightcoral';
    setTimeout(() => {
        element.style.backgroundColor = "#f0eeee";
    }, 1000);

}

// Gestion du champ ville spécifique 'Autre ville...'
const villeAutre = document.querySelector(".villeAutre");
const adresseVille = document.getElementById("villes");

adresseVille.addEventListener("change", function (event) {
    isAutreVille = event.target.value === "Autre";
    villeAutre.classList.toggle("d-none", !isAutreVille);
    villeAutre.style.display = isAutreVille ? "block" : "none";
});


/*
    Fonction d'auto-complétion pour ville quand le user rentre Autre dans le select villes
*/
function autocomplete(inp, arr) {
    /*the autocomplete function takes two arguments,
    the text field element and an array of possible autocompleted values:*/
    var currentFocus;
    /*execute a function when someone writes in the text field:*/
    inp.addEventListener("input", function (e) {
        var a, b, i, val = this.value;
        /*close any already open lists of autocompleted values*/
        closeAllLists();
        if (!val) { return false; }
        currentFocus = -1;
        /*create a DIV element that will contain the items (values):*/
        a = document.createElement("DIV");
        a.setAttribute("id", this.id + "autocomplete-list");
        a.setAttribute("class", "autocomplete-items");
        /*append the DIV element as a child of the autocomplete container:*/
        this.parentNode.appendChild(a);
        /*for each item in the array...*/
        for (i = 0; i < arr.length; i++) {
            /*check if the item starts with the same letters as the text field value:*/
            if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
                b.innerHTML += arr[i].substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function (e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value = this.getElementsByTagName("input")[0].value;
                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
            }
        }
    });
    /*execute a function presses a key on the keyboard:*/
    inp.addEventListener("keydown", function (e) {
        var x = document.getElementById(this.id + "autocomplete-list");
        if (x) x = x.getElementsByTagName("div");
        if (e.keyCode == 40) {
            /*If the arrow DOWN key is pressed,
            increase the currentFocus variable:*/
            currentFocus++;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 38) { //up
            /*If the arrow UP key is pressed,
            decrease the currentFocus variable:*/
            currentFocus--;
            /*and and make the current item more visible:*/
            addActive(x);
        } else if (e.keyCode == 13) {
            /*If the ENTER key is pressed, prevent the form from being submitted,*/
            e.preventDefault();
            if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
            }
        }
    });
    function addActive(x) {
        /*a function to classify an item as "active":*/
        if (!x) return false;
        /*start by removing the "active" class on all items:*/
        removeActive(x);
        if (currentFocus >= x.length) currentFocus = 0;
        if (currentFocus < 0) currentFocus = (x.length - 1);
        /*add class "autocomplete-active":*/
        x[currentFocus].classList.add("autocomplete-active");
    }
    function removeActive(x) {
        /*a function to remove the "active" class from all autocomplete items:*/
        for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
        }
    }
    function closeAllLists(elmnt) {
        /*close all autocomplete lists in the document,
        except the one passed as an argument:*/
        var x = document.getElementsByClassName("autocomplete-items");
        for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
        }
    }
    /*execute a function when someone clicks in the document:*/
    document.addEventListener("click", function (e) {
        closeAllLists(e.target);
    });
}


async function getVillesVosges() {
    try {
        const response = await fetch('/api/villes_vosges', {
            method: 'GET'
        });

        // Vérifier si la réponse est OK (statut 200)
        if (!response.ok) {
            throw new Error(`Erreur: ${response.status} - ${response.statusText}`); // Gérer les erreurs HTTP
        }

        const villes_vosges = await response.json();

        // Vérifier s'il y a une clé 'error' dans la réponse
        if (villes_vosges.error) {
            throw new Error(villes_vosges.error + (villes_vosges.details ? ' - ' + villes_vosges.details : ''));
        }

        return villes_vosges; // La réponse complète

    } catch (error) {
        console.error("Erreur:", error); // Utiliser console.error pour des erreurs
        throw error; // Rejeter l'erreur pour une gestion ultérieure si nécessaire
    }
}

getVillesVosges()
    .then(villes_vosges => {
        if (villes_vosges && Array.isArray(villes_vosges.data)) {
            tabVillesVosges = villes_vosges.data.map(ville => ville.nom_ville_vosges);
            //console.log(tabVillesVosges); // Vérifier le tableau transformé
            autocomplete(document.getElementById('autre_ville'), tabVillesVosges);
        } else {
            console.error("Erreur : 'data' n'est pas un tableau ou est vide.");
        }
    })
    .catch(error => {
        console.error("Erreur lors de la récupération des villes :", error);
    });