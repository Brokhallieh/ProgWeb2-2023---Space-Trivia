const starsContainer = document.querySelector(".stars");

let resizeTimer = null;
const resizeDelay = 50; // milliseconds, time before the stars in the background regenerate after re-sizing the window
let maxWidth = 0;
let maxHeight = 0;

function createStar(starwidth, fromX, toX, fromY, toY) {
    const star = document.createElement("span");
    const x = fromX + Math.floor(Math.random() * toX);
    const y = fromY + Math.floor(Math.random() * toY);

    star.style.left = `${x}px`;
    star.style.top = `${y}px`;
    star.style.width = `${starwidth}px`;
    star.style.height = `${starwidth}px`;
    starsContainer.appendChild(star);
}

function generateStars() {
    const width = window.innerWidth;
    const height = window.innerHeight;
    if (width > maxWidth) {
        generateStars_in_area(maxWidth, width, 0, maxHeight);
        maxWidth = width;
    }
    if (height > maxHeight) {
        generateStars_in_area(0, maxWidth, maxHeight, height);
        maxHeight = height;
    }
}

function generateStars_in_area(fromX, toX, fromY, toY) {
    const width = toX - fromX;
    const height = toY - fromY;
    const littlestarsCount = Math.floor((width * height) / 3000); // adjust divisor to change density

    for (let i = 0; i < littlestarsCount; i++) {
        createStar(1, fromX, width, fromY, height);
        if (i < littlestarsCount / 3) //for three little stars, generate 1 medium star
            createStar(2, fromX, width, fromY, height);
        if (i < littlestarsCount / 10) //for ten little stars, generate 1 big star
            createStar(3, fromX, width, fromY, height);
    }
}

function clear_div(div) {
    // élimine tout le contenu html dans la division en argument
    while (div.firstChild) {
        div.removeChild(div.firstChild);
    }
}

function deleteStars() {
    clear_div(starsContainer);
}

window.onload = function () { generateStars(); };

window.onresize = function () {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(function () {
        generateStars();
    }, resizeDelay);
};
