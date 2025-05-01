<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backabush Bookstore</title>
    <link href="./style.css" rel="stylesheet" type="text/css">
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
</head>

<body>
    <!-- Header Section, Nav and Search -->
    <?php
    require "header.php";
    ?>
    <div class="container">
        <?php

        require 'databaseConnection.php';
        if (isset($_GET['isbn']) && !empty($_GET['isbn'])) {
            $isbn = $_GET['isbn'];
            
            $query = "SELECT * FROM `book_infos` WHERE ISBN=".$isbn;

            $result = queryDB($query);

            if ($result) {
                $book = $result->fetch_assoc();
                echo
                    '<div class="details-section">' .
                        '<h1 id="book-title">' . htmlspecialchars($book["TITLE"]) . '</h1>' . 
                        '<h3 id="book-author">' . htmlspecialchars($book["AUTHOR"]) . ' (' . htmlspecialchars($book["PUBLICATION_YEAR"]) . ')</h3>' . 
                        '<div id="book-price" class="price">$' . htmlspecialchars(number_format($book["PRICE"], 2)) . ' BZD</div>' .
                        '<div class="buy-section">' .
                            '<button id="buy-button" class="buy-btn">Add to Cart</button>' .
                        '</div>' .
                        '<div>' .
                            '<div class="section-title">Description</div>' .
                            '<p id="book-description" class="book-info">' . htmlspecialchars($book["DESCRIPTION"]) . '</p>' . 
                        '</div>' .
                        '<div>' .
                            '<div class="section-title">Details</div>' .
                            '<p id="book-publisher" class="additional-info"><strong>Publisher:</strong> ' . htmlspecialchars($book["PUBLISHER"]) . '</p>' . 
                            '<p id="book-published-date" class="additional-info"><strong>Published Year:</strong> ' . htmlspecialchars($book["PUBLICATION_YEAR"]) . '</p>' . 
                            '<p id="book-isbn" class="additional-info"><strong>ISBN:</strong> ' . htmlspecialchars($book["ISBN"]) . '</p>' . 
                            '<p id="book-pages" class="additional-info"><strong>Pages:</strong> ' . htmlspecialchars($book["PAGE_COUNT"]) . '</p>' .
                            '<p id="book-language" class="additional-info"><strong>Language:</strong> ' . htmlspecialchars($book["LANGUAGE"]) . '</p>' .
                             '<p id="book-genre" class="additional-info"><strong>Genre:</strong> ' . htmlspecialchars($book["GENRE"]) . '</p>' . 
                        '</div>' .
                    '</div>';
            }
        }


        ?>
        <!-- <div class="cover-section">
            <img id="book-cover" class="cover-image" src="" alt="Book Cover" />
        </div> -->

    </div>


    <!-- Footer with Welcome Message -->
    <?php
    require "footer.php";
    ?>

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


        function loadBookDetails(book) {
            document.getElementById('book-cover').src = book.coverUrl;
            document.getElementById('book-cover').alt = Cover of ${ book.title };
            document.getElementById('book-title').textContent = book.title;
            document.getElementById('book-author').textContent = by ${ book.author };
            document.getElementById('book-rating-count').textContent = (${ book.ratingCount } reviews);
            document.getElementById('book-price').textContent = $${ book.price.toFixed(2) };
            document.getElementById('book-description').textContent = book.description;
            document.getElementById('book-publisher').innerHTML = <strong>Publisher:</strong> ${ book.publisher };
            document.getElementById('book-published-date').innerHTML = <strong>Published Date:</strong> ${ new Date(book.publishedDate).toLocaleDateString() };
            document.getElementById('book-isbn').innerHTML = <strong>ISBN:</strong> ${ book.isbn };
            document.getElementById('book-pages').innerHTML = <strong>Pages:</strong> ${ book.pages };
            document.getElementById('book-language').innerHTML = <strong>Language:</strong> ${ book.language };
        }

        // On page load - load the book details
        loadBookDetails(book);

        // Add to cart button click handler (placeholder)
        document.getElementById('buy-button').addEventListener('click', () => {
            alert(Added "${book.title}" to your cart!);
        });
    </script>
</body>

</html>