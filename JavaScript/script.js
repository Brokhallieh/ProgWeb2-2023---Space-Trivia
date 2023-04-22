let loadMoreBtn = document.getElementById("load-more");
let projectContainer = document.getElementById("questions-container");
let string_language = document.getElementById("string_language").value;
let data = {string_language : string_language};

function clearElement(element) {
    element.innerHTML = "";
}

loadMoreBtn.addEventListener("click", () => {
    clearElement(projectContainer);
    fetch("../PHP/get_question.php", {method: 'POST',
    headers: {
        "Content-Type": "application/json",
    },
    body: JSON.stringify(data)})
        .then(response => response.json()
        .then(data => {
            //console.log(JSON.stringify(data)); // debug
            data.forEach(project => {
                let projectElement = document.createElement("div");
                projectElement.classList.add("question");
                projectElement.innerHTML = "<h2>" + project.question + "</h2><p>"
                    + project.answer_a + "</p><p>" + project.answer_b + "</p><p>"
                    + project.answer_c + "</p><p>" + project.answer_d + "</p>";
                projectContainer.appendChild(projectElement);
            });
        }))
        .catch(error => console.log(error));
});


//stary backgroud
const starsContainer = document.getElementById("stars_container");

let maxWidth = 0;
let maxHeight = 0;

function createStar(starwidth, fromX, width, fromY, height) {
    const star = document.createElement("span");
    const x = fromX + Math.floor(Math.random() * width);
    const y = fromY + Math.floor(Math.random() * height);

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

window.onload = function () { generateStars(); };

window.onresize = function () { generateStars(); };
