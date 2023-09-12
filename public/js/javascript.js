// Active
document
    .querySelectorAll(".header-links .dropdown .header-link")
    .forEach((link) => {
        link.addEventListener("click", function () {
            this.classList.add("active");
            const siblings =
                this.parentElement.querySelectorAll(".header-link");
            siblings.forEach((sibling) => {
                if (sibling !== this) {
                    sibling.classList.remove("active");
                }
            });
        });
    });

// Dropdown
document.addEventListener("click", (e) => {
    const currentDropdown = e.target.closest(".dropdown");
    const isDropdownButton = e.target.matches(".header-link");
    const activeDropdowns = document.querySelectorAll(".dropdown.active");

    const searchBtn = document.querySelector(".searchBtn");
    const searchBox = document.querySelector(".searchBox");

    const notifBtn = document.querySelector(".notifBtn");
    const notifBox = document.querySelector(".notifBox");

    const formBtn = document.querySelector(".formBtn");
    const formBox = document.querySelector(".formBox");

    const userBtn = document.querySelector(".userBtn");
    const profileBox = document.querySelector(".profile");

    const menuToggle = document.querySelector(".menuToggle");
    const header = document.querySelector(".header");

    // Close all active dropdowns if the click is outside a dropdown button or any open dropdown
    if (!isDropdownButton && currentDropdown === null) {
        activeDropdowns.forEach((dropdown) => {
            dropdown.classList.remove("active");
        });
    }

    // Close other open dropdowns except for the current one (if it's a dropdown button)
    activeDropdowns.forEach((dropdown) => {
        if (dropdown !== currentDropdown) {
            dropdown.classList.remove("active");
        }
    });

    // Toggle the "active" class on the current dropdown if it's a dropdown button
    if (isDropdownButton && currentDropdown) {
        currentDropdown.classList.toggle("active");
    }

    // Handle the search box visibility
    if (searchBtn && searchBox) {
        if (!searchBtn.contains(e.target) && !searchBox.contains(e.target)) {
            searchBox.classList.remove("active");

            searchBtn.classList.remove("active");
            searchBtn.setAttribute("name", "search-outline");
        } else {
            if (searchBox.classList.contains("active")) {
                searchBox.classList.remove("active");
                searchBtn.classList.remove("active");
                searchBtn.setAttribute("name", "search-outline");
            } else {
                searchBox.classList.add("active");
                searchBtn.classList.add("active");
                searchBtn.setAttribute("name", "close-outline");
            }
        }
    }

    // Handle the notif box visibility
    if (notifBtn && notifBox) {
        if (!notifBtn.contains(e.target) && !notifBox.contains(e.target)) {
            notifBox.classList.remove("active");

            notifBtn.classList.remove("active");
            notifBtn.setAttribute("name", "notifications-outline");
        } else {
            if (notifBox.classList.contains("active")) {
                notifBox.classList.remove("active");
                notifBtn.classList.remove("active");
                notifBtn.setAttribute("name", "notifications-outline");
            } else {
                notifBox.classList.add("active");
                notifBtn.classList.add("active");
                notifBtn.setAttribute("name", "close-outline");
            }
        }
    }

    // Handle the form box visibility
    if (formBtn && formBox) {
        if (!formBtn.contains(e.target) && !formBox.contains(e.target)) {
            formBox.classList.remove("active");
            formBtn.classList.remove("active");
        } else {
            if (formBox.classList.contains("active")) {
                formBox.classList.remove("active");
                formBtn.classList.remove("active");
            } else {
                formBox.classList.add("active");
                formBtn.classList.add("active");
            }
        }
    }

    // Handle the user box visibility
    if (userBtn && profileBox) {
        if (!userBtn.contains(e.target) && !profileBox.contains(e.target)) {
            profileBox.classList.remove("active");
            userBtn.classList.remove("active");
        } else {
            if (profileBox.classList.contains("active")) {
                profileBox.classList.remove("active");
                userBtn.classList.remove("active");
            } else {
                profileBox.classList.add("active");
                userBtn.classList.add("active");
            }
        }
    }

    // Handle the toggle visibility
    if (menuToggle && header) {
        if (!menuToggle.contains(e.target) && !header.contains(e.target)) {
            menuToggle.classList.remove("active");
            header.classList.remove("active");
        }

        menuToggle.onclick = function () {
            menuToggle.classList.toggle("active");
            header.classList.toggle("active");
        };
    }

    if (menuToggle && header) {
        if (!menuToggle.contains(e.target) && !header.contains(e.target)) {
            menuToggle.classList.remove("active");
            header.classList.remove("active");
        }

        menuToggle.onclick = function () {
            menuToggle.classList.toggle("active");
            header.classList.toggle("active");
        };
    }
});

// Prevent the click event on the search input from bubbling up to its parent elements
document.querySelector(".searchInput").addEventListener("click", (e) => {
    e.stopPropagation();
});

// JavaScript Function
function toggle() {
    var popup = document.getElementById("popup");
    popup.classList.toggle("active");

    // Add an event listener to the document to handle clicks outside the popup
    document.addEventListener("click", function (e) {
        if (!popup.contains(e.target) && !e.target.matches("button")) {
            popup.classList.remove("active");
        }
    });
}

function toggleDetail() {
    var popupDetail = document.getElementById("popup-chitiet");
    popupDetail.classList.toggle("active");
}

function enableHoverVideo() {
    let cards = document.querySelectorAll(".card .movie");

    cards.forEach((card) => {
        let videoElement = card.querySelector("video");

        if (videoElement) {
            // Add a flag to track if the video is currently playing
            let isPlaying = false;

            // Listen for the 'playing' event to set the 'isPlaying' flag
            videoElement.addEventListener("playing", () => {
                isPlaying = true;
            });

            card.addEventListener("mouseenter", () => {
                // Check if the video is already playing to avoid restarting it
                if (!isPlaying) {
                    // Use a Promise to handle any play errors (e.g., autoplay policies)
                    const playPromise = videoElement.play();

                    if (playPromise) {
                        playPromise.catch((error) => {
                            console.error("Error playing video:", error);
                        });
                    }
                }
            });

            card.addEventListener("mouseleave", () => {
                // Pause the video only if it is currently playing
                if (isPlaying) {
                    videoElement.pause();
                    isPlaying = false; // Reset the 'isPlaying' flag
                }
            });
        }
    });
}

// Call the enableHoverVideo() function after the DOM content is loaded
document.addEventListener("DOMContentLoaded", function () {
    enableHoverVideo();
});
