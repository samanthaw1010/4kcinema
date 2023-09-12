let vidContents = document.querySelectorAll(".vid");
vidContents.forEach((vidContent) => {
    vidContent.addEventListener("click", handler);
});

function handler(e) {
    e.preventDefault();

    // Get the episode title from the clicked video's content
    let episodeTitle = this.querySelector(".vid-content").textContent;

    // Update the episode title in the DOM
    let episodeTitleElement = document.querySelector(".ep-title");
    episodeTitleElement.textContent = episodeTitle;

    let videoElement = this.querySelector("video");
    let sourceElements = videoElement.querySelectorAll("source");
    let sources = Array.from(sourceElements).map((source) =>
        source.getAttribute("src")
    );

    let video = document.querySelector(".main-video");
    let mainPoster = video.getAttribute("poster");
    video.setAttribute("poster", videoElement.getAttribute("poster"));

    let mainVideoSourceElements = video.querySelectorAll("source");
    mainVideoSourceElements.forEach((sourceElement, index) => {
        sourceElement.src = sources[index];
    });

    video.load();
}

function scrollToElement(elementId) {
    const element = document.getElementById(elementId);
    if (element) {
        element.scrollIntoView({ behavior: "smooth" });
    }
}

var swiper = new Swiper(".list-video", {
    slidesPerView: 2,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        640: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 6,
            spaceBetween: 10,
        },
    },
});

var swiper = new Swiper(".card-movie .container", {
    slidesPerView: 1.6,
    spaceBetween: 10,
    navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
    },
    breakpoints: {
        640: {
            slidesPerView: 3,
            spaceBetween: 10,
        },
        768: {
            slidesPerView: 4,
            spaceBetween: 10,
        },
        1024: {
            slidesPerView: 6.3,
            spaceBetween: 10,
        },
    },
});

// Select all elements with the "i" tag and store them in a NodeList called "stars"
const stars = document.querySelectorAll(".stars i");

// Loop through the "stars" NodeList
stars.forEach((star, index1) => {
    // Add an event listener that runs a function when the "click" event is triggered
    star.addEventListener("click", () => {
        // Loop through the "stars" NodeList Again
        stars.forEach((star, index2) => {
            // Add the "active" class to the clicked star and any stars with a lower index
            // and remove the "active" class from any stars with a higher index
            index1 >= index2
                ? star.classList.add("active")
                : star.classList.remove("active");
        });
    });
});
