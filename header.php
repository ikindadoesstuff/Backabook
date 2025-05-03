<header>
    <script src="script.js"> </script>
    <!-- Left Section -->
    <div class="header-left">
        <div class="bookstore-name" id="home-button">BACKABOOK</div>
        <div class="dropdown">
            <button id="menuButton" onclick="toggleMenu()"> ☰ ▲ </button>
            <div id="menuDropdown" class="dropdown-content">
                <button onclick="redirect('search.php?sort=&order=&searchInput=')">Browse</button>
                <button onclick="redirect('about-us.php')">About Us</button>
                <!-- <button onclick="redirect('purchase')">Services</button> -->
            </div>
        </div>
    </div>

    <!-- Search Bar -->
    <div class="search-container">
        <form action="search.php" method="get" id="searchForm">

        <!-- hidden inputs to keep existing filter and sort -->
        <!-- Keep sort query -->
        <input type="hidden" name="sort"
        value="<?php echo isset($_GET['sort']) ? htmlspecialchars($_GET['sort']) : ''; ?>" />
        <!-- Keep order query -->
        <input type="hidden" name="order"
        value="<?php echo isset($_GET['order']) ? htmlspecialchars($_GET['order']) : ''; ?>" />
        <!-- Keep genres query -->
        <?php
        if (isset($_GET['genres']) && is_array($_GET['genres'])) {
            foreach ($_GET['genres'] as $genre) {
            echo '<input type="hidden" name="genres[]" value="' . htmlspecialchars($genre) . '">';
            }
        }
        ?>

        <input type="text" id="searchInput" name="searchInput" autocomplete="off"
            placeholder="Search Title, ISBN, Author, Year, etc..." <?php echo (isset($_GET['searchInput']) && !empty($_GET['searchInput']))
                ? 'value="' . htmlspecialchars($_GET['searchInput']) . '"'
                : ''; ?>>
        <button type="submit" id="searchButton">Search <span class="material-symbols-outlined">search</span> </button>
        </form>
    </div>

    <!-- Right Section -->
    <div class="header-right">
        <button type="submit" onclick="redirect('view-cart.php')">  <span class="material-symbols-outlined">shopping_cart</span> Cart</button>
        <!-- <button onclick="redirect('login')">Login/Sign Up</button> Removed Functionality -->
    </div>
</header>