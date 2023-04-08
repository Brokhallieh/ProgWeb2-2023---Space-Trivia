const starsContainer = document.querySelector(".stars");

let resizeTimer = null;
const resizeDelay = 50; // milliseconds, time before the stars in the background regenerate after re-sizing the window

function createStar(starwidth) {
    const star = document.createElement("span");
    const x = Math.floor(Math.random() * window.innerWidth);
    const y = Math.floor(Math.random() * window.innerHeight);

    star.style.left = `${x}px`;
    star.style.top = `${y}px`;
    star.style.width = `${starwidth}px`;
    star.style.height = `${starwidth}px`;
    starsContainer.appendChild(star);
}

function generateStars() {
    const width = window.innerWidth;
    const height = window.innerHeight;
    const littlestarsCount = Math.floor((width * height) / 3000); // adjust divisor to change density

    for (let i = 0; i < littlestarsCount; i++) {
        createStar(1);
        if (i < littlestarsCount/3) //for three little stars, generate 1 medium star
            createStar(2);
        if (i < littlestarsCount / 10) //for ten little stars, generate 1 big star
            createStar(3);
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
        deleteStars();
        generateStars();
    }, resizeDelay);
};
