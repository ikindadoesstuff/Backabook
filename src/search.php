<html lang="en">

<?php require "head.php" ?>

<body>
    <!-- Header Section, Nav and Search -->
    <?php
    require "header.php";
    ?>

    <!-- Main Content -->
    <main>
        <div id="search">

            <!-- Sort Filters  -->
            <div id="search-options-container">
                <form class="options-menu" method="get" action="search.php">
                    <h1>Sort</h1>
                    <button type="submit">Apply</button>

                    <!-- this just makes sure the search text stays when a sort is used.  -->
                    <input type="hidden" name="searchInput"
                        value="<?php echo isset($_GET['searchInput']) ? htmlspecialchars($_GET['searchInput']) : ''; ?>" />
                    <label>
                        <input type="radio" name="sort" value="title" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'title') ? 'checked' : ''; ?> />
                        By Title
                    </label>
                    <label>
                        <input type="radio" name="sort" value="price" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'price') ? 'checked' : ''; ?> />
                        By Price
                    </label>
                    <label>
                        <input type="radio" name="sort" value="year" <?php echo (isset($_GET['sort']) && $_GET['sort'] === 'year') ? 'checked' : ''; ?> />
                        By Year
                    </label>
                    <label>
                        Order:
                        <select name="order">
                            <option value="ASC" <?php echo (isset($_GET['order']) && $_GET['order'] === 'ASC') ? 'selected' : ''; ?>>Ascending</option>
                            <option value="DESC" <?php echo (isset($_GET['order']) && $_GET['order'] === 'DESC') ? 'selected' : ''; ?>>Descending</option>
                        </select>
                    </label>
                </form>

                <form class="options-menu" method="get" action="search.php">
                    <h1>Filter</h1>
                    <button type="submit">Apply</button>
                    <button type="reset"><span class="material-symbols-outlined">close</span></button>

                    <!-- this just makes sure the search text stays when a filter is used. -->
                    <input type="hidden" name="searchInput"
                        value="<?php echo isset($_GET['searchInput']) ? htmlspecialchars($_GET['searchInput']) : ''; ?>" />

                    <label>
                        <h2>Genre:</h2>
                        <div class="checkbox-group">
                            <?php
                            // all the genres in the book info table
                            // got this using SELECT DISTINCT GENRE FROM book_infos
                            $genres = [
                                "Historical Fiction",
                                "Classic Fiction",
                                "Contemporary Fiction",
                                "Fantasy & Supernatural",
                                "Science Fiction",
                                "Mystery & Thriller",
                                "Young Adult",
                                "Computers & Technology",
                                "Psychology & Self-Help",
                                "Social Sciences & History",
                                "Horror",
                                "Graphic Novel"
                            ];
                            foreach ($genres as $genre) {
                                $checked = (
                                    isset($_GET['genres']) && 
                                    is_array($_GET['genres']) && 
                                    in_array($genre, $_GET['genres'])) ? 'checked' : '';
                                ?>
                                <label>
                                    <input type="checkbox" name="genres[]" value="<?php echo htmlspecialchars($genre); ?>" <?php echo $checked; ?> >
                                    <?php echo htmlspecialchars($genre); ?>
                                </label>
                                <br>
                                <?
                            }
                            ?>
                        </div>
                    </label>
                </form>
            </div>

            <!-- Search Results -->
            <div id="list">
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
                        <div class="list-item list-header" style="height: 15px;">
                            <p class="additional-info"> <b> Results: </b> <i> <? echo $result->num_rows ?> books found... </i> </p>
                        </div>
                        <?
                        while ($book = $result->fetch_assoc()) {
                            ?>
                            <div class="list-item">
                                <div class="list-item-left">
                                    <h2><? echo htmlspecialchars($book["TITLE"]); ?></h2>
                                    <h3><? echo htmlspecialchars($book["AUTHOR"]); ?>
                                        (<?php echo htmlspecialchars($book["PUBLICATION_YEAR"]); ?>)</h3>
                                    <p class="additional-info"><? echo htmlspecialchars($book["DESCRIPTION"]); ?></p>
                                </div>
                                <div class="list-item-right">
                                    <h2 class="price-format">$<? echo htmlspecialchars(number_format($book["PRICE"], 2)); ?> BZD
                                    </h2>
                                    <div>
                                        <? if ($book["STOCK"] > 0) { ?>
                                            <button onclick="addToCart('<? echo ($book["ISBN"]) . "', '" . htmlspecialchars($book["TITLE"]); ?>')">
                                                <span class="material-symbols-outlined">add</span>
                                            </button>
                                        <? } else { ?>
                                            <button disabled> 
                                                <span class="material-symbols-outlined">production_quantity_limits</span> Out of Stock
                                            </button>
                                        <? } ?>
                                        <a href="book-details.php?isbn=<? echo urlencode($book["ISBN"]); ?>"
                                            class="view-details-button">
                                            <button>View Details</button>
                                        </a>
                                    </div>
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