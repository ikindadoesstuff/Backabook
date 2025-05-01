// Redirect function for buttons
function redirect(page) {
    alert(`Redirecting to ${page} page...`);
    // window.location.href = `${page}.html`;
}

// Search functionality
// function performSearch() {
//     const query = document.getElementById("searchInput").value;
//     if (query) {
//         alert(`Searching for: ${query}`);
//     }

// }

// Close dropdown when clicking outside
window.onclick = function (event) {
    if (!event.target.closest('.dropdown')) {
        const dropdowns = document.getElementsByClassName("dropdown-content");
        for (let dropdown of dropdowns) {
            dropdown.classList.remove("show");
        }
        document.getElementById("menuButton").innerHTML = "☰ ▼";
    }
}

// Toggle dropdown menu and change button text
function toggleMenu() {
    const dropdown = document.getElementById("menuDropdown");
    const menuButton = document.getElementById("menuButton");
    dropdown.classList.toggle("show");
    if (dropdown.classList.contains("show")) {
        menuButton.innerHTML = "☰ ▲";
    } else {
        menuButton.innerHTML = "☰ ▼";
    }
}