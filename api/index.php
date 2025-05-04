<?php
$request = $_SERVER['REQUEST_URI'];
$request = str_replace('/api/', '', $request);
$apiPath = __DIR__ . '/' . $request;

if ($request != '' && file_exists($apiPath)) {
    require_once $apiPath;
    exit();
}
?>

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
                    <h2>Browse Books</h2>
                    <p>Explore our extensive collection of books across various genres.</p>
                    <a href="search.php?sort=&order=&searchInput=">
                        <button>Browse Now</button>
                    </a><br>
                    Try: <hr>
                    <ul>
                        <li><a href="search.php?sort=&order=&searchInput=&genres[]=Historical%20Fiction">Historical Fiction</a></li>
                        <li><a href="search.php?sort=&order=&searchInput=&genres[]=Fantasy%20%26%20Supernatural">Fantasy & Supernatural</a></li>
                        <li><a href="search.php?sort=&order=&searchInput=&genres[]=Science%20Fiction">Science Fiction</a></li>
                    </ul>
                </div>
                <div>
                    <h2>Purchase CDs</h2>
                    <p>Find your favorite books recorded in Audio on CD.</p>
                    <a href="search.php?sort=&order=&searchInput=CD">
                        <button>Shop CDs</button>
                    </a>
                </div>
                <div>
                    <h2>Audiobooks</h2>
                    <p>Find captivating audiobooks for anytime, anywhere.</p>
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