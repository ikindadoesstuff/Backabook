<html lang="en">

<?php require "head.php"?>

<body>
    <!-- Header Section, Nav and Search -->
    <?php
        require "header.php";
    ?>

    <!-- Main Content -->
    <main>
        <div id = "landing">
            <div class="container">
                <h1>Welcome to Backabook</h1>
                <p>Your one-stop shop for books, CDs, and audiobooks!</p>
                <div>
                <div></div>
                    <h2>Browse Books</h2>
                    <p>Explore our extensive collection of books across various genres.</p>
                    <a href="search.php?sort=&order=&searchInput=">
                        <button>Browse Now</button>
                    </a>
                </div>
                <div>
                    <h2>Purchase CDs</h2>
                    <p>Find your favorite music albums and soundtracks on CD.</p>
                    <a href="search.php?sort=&order=&searchInput=CD">
                        <button>Shop CDs</button>
                    </a>
                </div>
                <div>
                    <h2>Audiobooks</h2>
                    <p>Listen to captivating audiobooks anytime, anywhere.</p>
                    <a href="search.php?sort=&order=&searchInput=Audiobook">
                        <button>Shop Audiobooks</button>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer with Welcome Message -->
    <?php
        require "footer.php";
    ?>
</body>
</html>