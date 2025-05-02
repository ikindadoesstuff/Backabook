// Redirect function for buttons
function redirect(page) {
    // alert(`Redirecting to ${page} page...`);
    window.location.href = `${page}`;
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
        // document.getElementById("menuButton").innerHTML = "☰ ▼";
    }
    if (event.target == document.getElementById("home-button")) {
        window.location.href = `/`
    }
}

// Toggle dropdown menu and change button text
function toggleMenu() {
    const dropdown = document.getElementById("menuDropdown");
    const menuButton = document.getElementById("menuButton");
    dropdown.classList.toggle("show");
    if (dropdown.classList.contains("show")) {
        menuButton.innerHTML = "☰ ▼";
    } else {
        menuButton.innerHTML = "☰ ▲";
    }
}

function addToCart(isbn, title) {
    let cart = { items: [] };
    if (getCookie("cart")) {
        cart = JSON.parse(getCookie("cart"));
    }
    let existingItem = null;

    // console.log("Cart Items: ", cart.items);
    cart.items.forEach((item) => {
        if (item.isbn == isbn) {
            existingItem = item;
        }
    });

    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.items.push({ isbn: isbn, quantity: 1 });
    }

    setCookie("cart", JSON.stringify(cart), 7);
    alert(`Item ${title} added to cart!`);
}

function removeFromCart(isbn) {
    if (getCookie("shopping-cart")) {
        let cart = JSON.parse()
    }
    let existingItem = cart.find(item => item.isbn === isbn);

    if (existingItem) {
        existingItem.quantity -= 1;
        if(existingItem.quantity == 0) {
            Object.keys(cart).forEach(key => {
                if (cart[key].isbn == existingItem.isbn) {
                    delete cart[key];
                }
            });
        }
    }

    setCookie("cart", JSON.stringify(cart), 7);
    alert("Book added to cart!");
    console.log(document.cookie)
}

function setCookie(name, value, days) {
    const date = new Date();
    date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
    const expires = "expires=" + date.toUTCString();
    document.cookie = name + "=" + value + ";" + expires + ";path=/";
}

function getCookie(name) {
    const nameEQ = name + "=";
    const cookies = document.cookie.split(';');
    for (let i = 0; i < cookies.length; i++) {
        let c = cookies[i].trim();
        if (c.indexOf(nameEQ) === 0) return c.substring(nameEQ.length, c.length);
    }
    return null;
}

console.log("CART ITEMS: ", JSON.parse(getCookie("cart")).items);