<html lang="en">

<?php require "head.php"?>

<body>
    <!-- Header Section, Nav and Search -->
    <?php
    require "header.php";
    ?>

    <!-- Main Content -->
    <main>
        <div class="container">
            <?php

            require 'databaseConnection.php';
            if (isset($_GET['isbn']) && !empty($_GET['isbn'])) {
                $isbn = $_GET['isbn'];

                $sqlQuery = "SELECT * FROM `book_infos` WHERE ISBN=?";
                $statement = queryDB($sqlQuery);
                $statement->bind_param("s", $isbn);
                $statement->execute();
                $result = $statement->get_result();

                if ($result->num_rows > 0) {
                    $book = $result->fetch_assoc();
                    ?>
                    <div class="details-section">
                        <h1 id="book-title"><? echo htmlspecialchars($book["TITLE"]); ?></h1>
                        <h3 id="book-author"><? echo htmlspecialchars($book["AUTHOR"]); ?>
                            (<? echo htmlspecialchars($book["PUBLICATION_YEAR"]); ?>)</h3>
                        <div id="book-price" class="price">$<? echo htmlspecialchars(number_format($book["PRICE"], 2)); ?> BZD
                        </div>
                        <div class="buy-section">
                            <button id="buy-button" class="buy-btn" onclick="addToCart('<? echo htmlspecialchars($book["ISBN"]). ',' . htmlspecialchars($book["TITLE"]); ?>')">Add to Cart</button>
                        </div>
                        <div>
                            <div class="section-title">Description</div>
                            <p id="book-description" class="book-info"><? echo htmlspecialchars($book["DESCRIPTION"]); ?></p>
                        </div>
                        <div>
                            <div class="section-title">Details</div>
                            <p id="book-publisher" class="additional-info"><strong>Publisher:</strong>
                                <? echo htmlspecialchars($book["PUBLISHER"]); ?></p>
                            <p id="book-published-date" class="additional-info"><strong>Published Year:</strong>
                                <? echo htmlspecialchars($book["PUBLICATION_YEAR"]); ?></p>
                            <p id="book-isbn" class="additional-info"><strong>ISBN:</strong>
                                <? echo htmlspecialchars($book["ISBN"]); ?>
                            </p>
                            <p id="book-pages" class="additional-info"><strong>Pages:</strong>
                                <? echo htmlspecialchars($book["PAGE_COUNT"]); ?></p>
                            <p id="book-language" class="additional-info"><strong>Language:</strong>
                                <? echo htmlspecialchars($book["LANGUAGE"]); ?></p>
                            <p id="book-genre" class="additional-info"><strong>Genre:</strong>
                                <? echo htmlspecialchars($book["GENRE"]); ?></p>
                        </div>
                    </div>
                <?
                } else {
                    header("Location: error.php");
                }

                exit;
            }
            ?>
            <!-- <div class="cover-section">
                <img id="book-cover" class="cover-image" src="" alt="Book Cover" />
            </div> -->

        </div>
    </main>


    <!-- Footer with Welcome Message -->
    <?php
    require "footer.php";
    ?>
    <!-- 
    <script>
        const book = {
            id: 1,
            title: "Divergent",
            author: "Veronica Roth",
            price: 17.99,
            coverUrl:
                description: "In a dystopian society, a young girl discovers she is Divergent",
            publisher: "Katherine Tengen Books",
            publishedDate: "2011-05-15",
            isbn: "9780062073488",
            pages: 487,
            language: "English"
        };

        // On page load - load the book details
        loadBookDetails(book);

        // Add to cart button click handler (placeholder)
        document.getElementById('buy-button').addEventListener('click', () => {
            alert(Added "${book.title}" to your cart!);
        });
    </script> -->
</body>

</html>