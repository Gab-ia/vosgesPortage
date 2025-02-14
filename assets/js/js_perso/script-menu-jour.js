let menus = [];
let currentIndex = 0;

// Animation de chargement des menus

document.addEventListener("DOMContentLoaded", () => {

    const loadingContainer = document.getElementById("loading-animation");
    const testContainer = document.querySelector(".test");
    const carouselInner = document.getElementById("carouselInner");

    const animation = bodymovin.loadAnimation({
        container: loadingContainer,
        path: "./assets/animations/cooking.json",
        renderer: "svg",
        loop: true,
        autoplay: true
    });

    async function getMenus() {
        await new Promise(resolve => setTimeout(resolve, 3000));
        const response = await fetch('/api/menus', { method: 'GET' });
        const allMenus = await response.json();

        // Obtenir la date du jour
        const today = new Date();

        // Calculer les dates limites (7 jours avant et 7 jours après)
        const startDate = new Date();
        startDate.setDate(today.getDate() - 7);

        const endDate = new Date();
        endDate.setDate(today.getDate() + 7);

        // Filtrer les menus dans cette plage de dates
        menus = allMenus.filter(menu => {
            const menuDate = new Date(menu.date);
            return menuDate >= startDate && menuDate <= endDate;
        });

        // Trouver l'index du menu du jour
        currentIndex = menus.findIndex(menu => new Date(menu.date).toDateString() === today.toDateString());
        if (currentIndex === -1) currentIndex = 0;

        renderCards();
    }

    getMenus();
    
});

function formatDate(dateStr) {
    const date = new Date(dateStr);
    const options = {
        weekday: 'long',
        year: 'numeric',
        month: 'long',
        day: 'numeric'
    };
    return date.toLocaleDateString('fr-FR', options);
}


function renderCards() {
    const carouselInner = document.getElementById('carouselInner');
    carouselInner.innerHTML = '';

    menus.forEach((menu, index) => {
        const card = document.createElement('div');
        card.className = 'card-menu-jour';
        if (index === currentIndex) {
            card.classList.add('zoomed');
        }
        card.innerHTML = `
            <h3 class="card-title-menu-jour">${formatDate(menu.date)}</h3>
            <div class="card-content-menu-jour">
                <div class="card-content1-menu-jour">
                    <p class="card-text-menu-jour"><b>Entrée</b></p><p class="menu-text-jour"> ${menu.entree}</p>
                </div>
                <div class="card-content2-menu-jour">
                    <p class="card-text-menu-jour"><b>Plat</b></p><p class="menu-text-jour"> ${menu.plat}</p>
                </div>
                <div class="card-content3-menu-jour"> 
                    <p class="card-text-menu-jour"><b>Dessert</b></p><p class="menu-text-jour"> ${menu.dessert}</p>
                </div>
            </div> 
        `;
        carouselInner.appendChild(card);
    });

    updateButtons();
    centerCard();
}

function centerCard() {
    const carouselWidth = document.querySelector('.carousel').offsetWidth;
    const cardWidth = document.querySelector('.card-menu-jour').offsetWidth;
    const cardMargin = parseInt(getComputedStyle(document.querySelector('.card-menu-jour')).marginLeft) +
        parseInt(getComputedStyle(document.querySelector('.card-menu-jour')).marginRight);
    const totalCardWidth = cardWidth + cardMargin;
    const offset = (carouselWidth - totalCardWidth) / 2;
    document.getElementById('carouselInner').style.transform = `translateX(${-currentIndex * totalCardWidth + offset}px)`;
}

function updateButtons() {
    document.getElementById('prevButton').disabled = currentIndex === 0;
    document.getElementById('nextButton').disabled = currentIndex === menus.length - 1;
}

function prevCard() {
    if (currentIndex > 0) {
        currentIndex--;
        updateZoomedCard();
        updateButtons();
        centerCard();
    }
}

function nextCard() {
    if (currentIndex < menus.length - 1) {
        currentIndex++;
        updateZoomedCard();
        updateButtons();
        centerCard();
    }
}

function updateZoomedCard() {
    const cards = document.querySelectorAll('.card-menu-jour');
    cards.forEach(card => card.classList.remove('zoomed'));
    if (cards[currentIndex]) {
        cards[currentIndex].classList.add('zoomed');
    }
}

window.onresize = centerCard;