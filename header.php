<?php

require 'databaseConnection.php';

if (!empty($_GET['searchInput'])) {
    performSearch($_GET['searchInput']);
}

function performSearch(string $searchInput) {
    alert($searchInput);
    $sqlQuery = "SELECT * FROM `book_infos` WHERE " .
        "CAST(ISBN AS CHAR) LIKE '%" . $searchInput . "%' OR " .
        "TITLE LIKE '%" . $searchInput . "%' OR " .
        "AUTHOR LIKE '%" . $searchInput . "%' OR " .
        "CAST(PUBLICATION_YEAR AS CHAR) LIKE '%" . $searchInput . "%' OR " .
        "DESCRIPTION LIKE '%" . $searchInput . "%' OR " .
        "PUBLISHER LIKE '%" . $searchInput . "%' OR " .
        "GENRE LIKE '%" . $searchInput . "%'";
    $result = queryDB($sqlQuery);
    for ($row = $result->fetch_array(); $row != null; $row = $result->fetch_array()) {
        echo "<p>".$row[1]." ".$row[2]." ".$row[3]." ".$row[4]." "."</p>";
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
            <input type="text" id="searchInput" name="searchInput" placeholder="Search Title, ISBN, Author, Year, etc...">
            <input type="submit" id="searchButton" value="Search">
        </form>
    </div>

    <!-- Right Section -->
    <div class="header-right">
        <button onclick="redirect('cart')">Cart</button>
        <button onclick="redirect('login')">Login/Sign Up</button>
    </div>
</header>