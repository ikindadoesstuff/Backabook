<header>
    <script src="script.js"> </script>
    <!-- Left Section -->
    <div class="header-left">
        <div class="bookstore-name" id="home-button">BACKABOOK</div>
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
        <form action="search.php" method="get" id="searchForm">
            <input type="text" id="searchInput" name="searchInput" placeholder="Search Title, ISBN, Author, Year, etc...">
            <button type="submit" id="searchButton">Search <span class="material-symbols-outlined">search</span> </button>
        </form>
    </div>

    <!-- Right Section -->
    <div class="header-right">
        <button onclick="redirect('cart')">  <span class="material-symbols-outlined">shopping_cart</span> Cart</button>
        <button onclick="redirect('login')">Login/Sign Up</button>
    </div>
</header>