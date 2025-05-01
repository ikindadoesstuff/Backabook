<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backabush Bookstore</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <!-- Header Section -->
    <header>
        <!-- Left Section -->
        <div class="header-left">
            <div class="bookstore-name">Backabush Bookstore</div>
            <div class="dropdown">
                <button id="menuButton" onclick="toggleMenu()">☰ ▼</button>
                <div id="menuDropdown" class="dropdown-content">
                    <button onclick="redirect('rent')">Rent</button>
                    <button onclick="redirect('purchase')">Purchase</button>
                    <button onclick="redirect('trade')">Trade</button>
                    <button onclick="redirect('auction')">Auction</button>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="search-container">
            <input type="text" id="searchInput" placeholder="Search books...">
            <button id="searchButton" onclick="performSearch()">Search</button>
        </div>

        <!-- Right Section -->
        <div class="header-right">
            <button onclick="redirect('wishlist')">Wishlist</button>
            <button onclick="redirect('login')">Login/Sign Up</button>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        <!-- Add your book content here -->
    </main>

    <!-- Footer with Welcome Message -->
    <footer>
        <h1>Welcome to Backabush Bookstore</h1>
    </footer>

    <script src="script.js"> </script>
</body>
</html>

<?php

function performSearch(string $searchQuery) {

}