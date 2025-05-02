<html lang="en">

<?php require "head.php" ?>

<body>
    <!-- Header Section, Nav and Search -->
    <?php
    require "header.php";
    ?>

    <!-- Main Content -->
    <main>
        <div id="list">

            <!-- Search Results -->
            <div id="result-list">
                <?php

                require 'databaseConnection.php';

                if (isset($_GET['searchInput'])) {
                    performSearch($_GET['searchInput']);
                }

                function performSearch(string $searchInput)
                {
                    $searchValue = "%" . $searchInput . "%";
                    $sortColumn = "TITLE"; 
                    $sortOrder = "ASC"; 
                
                    if (isset($_GET['sort']) && isset($_GET['order'])) {
                        if ($_GET['sort'] === 'price') {
                            $sortColumn = "PRICE";
                        } elseif ($_GET['sort'] === 'title') {
                            $sortColumn = "TITLE";
                        } elseif ($_GET['sort'] === 'year') {
                            $sortColumn = "PUBLICATION_YEAR";
                        }

                        if ($_GET['order'] === 'DESC') {
                            $sortOrder = "DESC";
                        } else {
                            $sortOrder = "ASC";
                        }
                    }

                    $sqlQuery = "SELECT * FROM `book_infos`";

                    if (!empty($searchInput)) {
                        $sqlQuery = $sqlQuery . " WHERE".
                                    "(CAST(ISBN AS CHAR) LIKE ? OR ".
                                    "TITLE LIKE ? OR ".
                                    "AUTHOR LIKE ? OR ".
                                    "CAST(PUBLICATION_YEAR AS CHAR) LIKE ? OR ".
                                    "DESCRIPTION LIKE ? OR ".
                                    "PUBLISHER LIKE ? OR ".
                                    "GENRE LIKE ?)";
                    }

                    if (isset($_GET['genres']) && is_array($_GET['genres']) && !empty($_GET['genres'])) {
                        $genres = $_GET['genres'];
                        $where_condition = !empty($searchInput) ? " NULL=?" : " 0=1"; // so that the OR can be on the left of each added OR clause in the loop
                        foreach ($genres as $genre) {
                            $where_condition = $where_condition . ' OR GENRE = "' . $genre . '"';
                        }
                        if (!empty($searchInput)) {
                            $sqlQuery = str_replace("OR GENRE LIKE ?", ") AND (".$where_condition, $sqlQuery);
                        } else {
                            $where_condition = " WHERE" . $where_condition;
                            $sqlQuery = $sqlQuery . $where_condition;
                        }
                    }

                    if (!empty($sortColumn) && !empty($sortOrder)) {
                        $sqlQuery = $sqlQuery . " ORDER BY " . $sortColumn . " " . $sortOrder;
                    }

                    alert($sqlQuery);

                    $statement = queryDB($sqlQuery);
                    // alert($statement);
                    if (!empty($searchInput)) {
                        $statement->bind_param(
                            "sssssss",
                            $searchValue,
                            $searchValue,
                            $searchValue,
                            $searchValue,
                            $searchValue,
                            $searchValue,
                            $searchValue
                        );
                    }
                    $statement->execute();
                    $result = $statement->get_result();

                    if ($result) {
                        ?>
                        <div class="search-item" style="height: 15px;">
                            <p class="additional-info"> <b> Results: </b> <i> <? echo $result->num_rows ?> books found... </i> </p>
                        </div>
                        <?
                        while ($book = $result->fetch_assoc()) {
                            ?>
                            <div class="search-item">
                                <div class="search-item-left">
                                    <h2><? echo htmlspecialchars($book["TITLE"]); ?></h2>
                                    <h3><? echo htmlspecialchars($book["AUTHOR"]); ?>
                                        (<?php echo htmlspecialchars($book["PUBLICATION_YEAR"]); ?>)</h3>
                                    <p class="additional-info"><? echo htmlspecialchars($book["DESCRIPTION"]); ?></p>
                                </div>
                                <div class="search-item-right">
                                    <h2 class="price-format">$<? echo htmlspecialchars(number_format($book["PRICE"], 2)); ?> BZD
                                    </h2>
                                    <a href="book-details.php?isbn=<? echo urlencode($book["ISBN"]); ?>"
                                        class="view-details-button">
                                        <button>View Details</button>
                                    </a>
                                </div>
                            </div>
                        <?
                        }
                    } else {
                        echo '<div class="error-info">No Books Found</div>';
                    }
                }

                // just for testing
                function alert($msg)
                {
                    // echo "<script type='text/javascript'>console.log('$msg');</script>";
                    echo '<pre class="PHP-ALERT" style="display: none">'; print_r($msg); echo '</pre>';
                    ?> <script>for (var x of document.getElementsByClassName("PHP-ALERT")) console.log(x.textContent)</script> <?
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