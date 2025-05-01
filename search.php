<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <link href="./style.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
</head>

<body>
    <!-- Header Section, Nav and Search -->
    <?php
    require "header.php";
    ?>

    <!-- Main Content -->
    <main>
        <div id="search">
            <!-- Filters  -->
            <div id="filter-container">
                <div>

                </div>
            </div>

            <!-- Search Results -->
            <div id="search-result-list">
                <?php

                require 'databaseConnection.php';

                if (isset($_GET['searchInput']) && !empty($_GET['searchInput'])) {
                    performSearch($_GET['searchInput']);
                }

                function performSearch(string $searchInput)
                {
                    // alert($searchInput);
                    $sqlQuery = "SELECT * FROM `book_infos` WHERE " .
                        "CAST(ISBN AS CHAR) LIKE '%" . $searchInput . "%' OR " .
                        "TITLE LIKE '%" . $searchInput . "%' OR " .
                        "AUTHOR LIKE '%" . $searchInput . "%' OR " .
                        "CAST(PUBLICATION_YEAR AS CHAR) LIKE '%" . $searchInput . "%' OR " .
                        "DESCRIPTION LIKE '%" . $searchInput . "%' OR " .
                        "PUBLISHER LIKE '%" . $searchInput . "%' OR " .
                        "GENRE LIKE '%" . $searchInput . "%'";
                    $result = queryDB($sqlQuery);

                    // echo '<div class="search-result-list">';
                    if ($result) {
                        while ($book = $result->fetch_assoc()) {
                            echo 
                                '
                                <div class="search-item">' .
                                    '<div class="search-item-left">' .
                                        '<h2>' . htmlspecialchars($book["TITLE"]) . '</h2>' .
                                        '<h3>' . $book["AUTHOR"] . ' (' . htmlspecialchars($book["PUBLICATION_YEAR"]) . ')</h3>' .
                                        '<p class="additional-info">' . htmlspecialchars($book["DESCRIPTION"]) . '</p>' .
                                    '</div>'.
                                    '<div class="search-item-right">' .
                                        '<h2>$'. htmlspecialchars(number_format($book["PRICE"],2) ).' BZD</h2>'.

                                        // view details button to go to details page
                                        '<a href="book-details.php?isbn=' . urlencode($book["ISBN"]) . '" class="view-details-button">' .
                                            '<button>View Details</button>' .
                                        '</a>' .
                                    '</div>'.
                                '</div>';
                        }
                    } else {
                        echo '<div class="error-info">No Books Found</div>';
                    }
                    // echo '</div>';
                    // echo "<h2>".$searchInput."</h2>";
                }

                // just for testing
                function alert($msg)
                {
                    echo "<script type='text/javascript'>alert('$msg');</script>";
                }

                ?>
            </div>
        </div>
    </main>

    <!-- Footer with Welcome Message -->
    <?php
    require "footer.php";
    ?>
</body>

</html>