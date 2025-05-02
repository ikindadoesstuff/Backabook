<html lang="en">

<?php require "head.php"?>

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
                    $searchValue = "%".$searchInput."%";
                    $sqlQuery = "SELECT * FROM `book_infos` WHERE
                                CAST(ISBN AS CHAR) LIKE ? OR
                                TITLE LIKE ? OR
                                AUTHOR LIKE ? OR
                                CAST(PUBLICATION_YEAR AS CHAR) LIKE ? OR
                                DESCRIPTION LIKE ? OR
                                PUBLISHER LIKE ? OR
                                GENRE LIKE ?";
                    $statement = queryDB($sqlQuery);
                    $statement->bind_param(
                        "sssssss",
                        $searchValue,
                        $searchValue,
                        $searchValue,
                        $searchValue,
                        $searchValue,
                        $searchValue,
                        $searchValue,
                    );
                    $statement->execute();
                    $result = $statement->get_result();

                    // echo '<div class="search-result-list">';
                    if ($result) {
                        while ($book = $result->fetch_assoc()) {
                            ?> 
                            <div class="search-item">
                                <div class="search-item-left">
                                    <h2><?php echo htmlspecialchars($book["TITLE"]); ?></h2>
                                    <h3><?php echo htmlspecialchars($book["AUTHOR"]); ?> (<?php echo htmlspecialchars($book["PUBLICATION_YEAR"]); ?>)</h3>
                                    <p class="additional-info"><?php echo htmlspecialchars($book["DESCRIPTION"]); ?></p>
                                </div>
                                <div class="search-item-right">
                                    <h2 class="price-format">$<?php echo htmlspecialchars(number_format($book["PRICE"], 2)); ?> BZD</h2>
                                    <a href="book-details.php?isbn=<?php echo urlencode($book["ISBN"]); ?>" class="view-details-button">
                                        <button>View Details</button>
                                    </a>
                                </div>
                            </div>
                            <?
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