let displayWeek = 0;
const menuDisplay = document.getElementById("menusWeek");

function getDay(dateStr) {
    const date = new Date(dateStr);
    const options = { day: 'numeric' };
    return date.toLocaleDateString('fr-FR', options);
}

function getDayLong(dateStr) {
    const date = new Date(dateStr);
    const options = { weekday: 'long' };
    return date.toLocaleDateString('fr-FR', options);
}

function getFormattedDate(dateStr) {
    const date = new Date(dateStr);
    const day = date.toLocaleDateString('fr-FR', { weekday: 'long' });
    const monthDay = date.toLocaleDateString('fr-FR', { day: 'numeric', month: 'long' });
    
    // Mettre la première lettre du jour en majuscule
    const capitalizedDay = day.charAt(0).toUpperCase() + day.slice(1);
    
    return `${capitalizedDay} ${monthDay}`; // Format: "Lundi 30 septembre"
}

function getDayMonth(dateStr) {
    const date = new Date(dateStr);
    const options = { month: 'long', day: 'numeric' };
    return date.toLocaleDateString('fr-FR', options);
}

async function getMenus() {
    const response = await fetch('/api/menus', { method: 'GET' });
    const allMenus = await response.json();

    const menusByWeek = getMenusByWeek(allMenus);
    displayMenusByWeek(menusByWeek);
}

function getMenusByWeek(menus) {
    const menusArray = [];
    let weekArray = [];

    menus.forEach(menu => {
        const menuDate = new Date(menu.date);
        weekArray.push(menu);
        if (menuDate.getDay() == 0) { // Si c'est un dimanche (fin de semaine)
            menusArray.push(weekArray);
            weekArray = [];
        }
    });
    
    // Ajoute la dernière semaine si elle n'a pas été ajoutée
    if (weekArray.length > 0) {
        menusArray.push(weekArray);
    }

    return menusArray;
}

function displayMenusByWeek(menusByWeek) {
    let currentWeekIndex = 0;
    const today = new Date();
    const weeksToShow = []; // Stocker seulement la semaine précédente, actuelle et suivante

    menusByWeek.forEach((week, index) => {
        const firstMenuDate = new Date(week[0].date); // Date du premier jour de la semaine
        const diffInMs = firstMenuDate - today;
        const diffInDays = Math.floor(diffInMs / (1000 * 60 * 60 * 24));

        // On trouve la semaine actuelle, et on stocke la précédente, actuelle et suivante
        if (diffInDays >= -7 && diffInDays <= 0) {
            currentWeekIndex = index;
            weeksToShow.push(index - 1); // Semaine précédente
            weeksToShow.push(index);     // Semaine actuelle
            weeksToShow.push(index + 1); // Semaine suivante
        }
    });

    weeksToShow.forEach(index => {
        if (index >= 0 && index < menusByWeek.length) {
            const week = menusByWeek[index];
            const divWeek = document.createElement('div');
            const weekdate = document.createElement('h2');
            weekdate.textContent = "Menus du " + getDayMonth(week[0].date) + " au " + getDayMonth(week[week.length - 1].date);
            divWeek.appendChild(weekdate);
            divWeek.classList.add("spacerWeek");

            week.forEach(day => {
                const dayMenu = document.createElement('div');
                // Utiliser la nouvelle fonction pour afficher le jour avec la date
                const dayInfo = getFormattedDate(day.date);
                dayMenu.innerHTML = `<h3>${dayInfo}</h3><p>${day.entree}</p><p style="color:#2d698c !important;">${day.plat}</p><p>${day.dessert}</p>`;
                dayMenu.classList.add("menuSemaine");
                divWeek.appendChild(dayMenu);
            });

            menuDisplay.appendChild(divWeek); // Ajouter la semaine dans le carrousel
        }
    });

    // Centrer sur la semaine actuelle
    displayWeek = 1; // La semaine actuelle est la deuxième dans les trois semaines affichées
    updateCarouselPosition();
    updateButtonState();
}

function updateButtonState() {
    document.getElementById("prevWeek").disabled = displayWeek === 0;
    document.getElementById("nextWeek").disabled = displayWeek >= (menuDisplay.childElementCount - 1);
}

function updateCarouselPosition() {
    const offset = -displayWeek * 500; 
    menuDisplay.style.transform = `translateX(${offset}px)`;
}

document.getElementById('prevWeek').addEventListener('click', () => {
    if (displayWeek > 0) {
        displayWeek--;
        updateCarouselPosition();
        updateButtonState();
    }
});

document.getElementById('nextWeek').addEventListener('click', () => {
    if (displayWeek < (menuDisplay.childElementCount - 1)) {
        displayWeek++;
        updateCarouselPosition();
        updateButtonState();
    }
});

getMenus();
updateButtonState();
