<?php

require 'databaseConnection.php';

if (!empty($_GET['searchInput'])) {
    performSearch($_GET['searchInput']);
}

function performSearch(string $searchInput) {
    alert($searchInput); 
    $result = queryDB("SELECT * FROM `book_infos`");
    for ($row = $result->fetch_array(); $row != null; $row = $result->fetch_array()) {
        echo "<p>".$row[1]."</p>";
    }
    // echo "<h2>".$searchInput."</h2>";
}

// just for testing
function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
}

?>

<header>
    <!-- Left Section -->
    <div class="header-left">
        <div class="bookstore-name">BACKABOOK</div>
        <div class="dropdown">
            <button id="menuButton" onclick="toggleMenu()"> ▼</button>
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
        <form method="get" id="searchForm">
            <input type="text" id="searchInput" name="searchInput" placeholder="Search ISBN, Title, Description or Author...">
            <input type="submit" id="searchButton" value="Search">
        </form>
    </div>

    <!-- Right Section -->
    <div class="header-right">
        <button onclick="redirect('wishlist')">Wishlist</button>
        <button onclick="redirect('login')">Login/Sign Up</button>
    </div>
</header>