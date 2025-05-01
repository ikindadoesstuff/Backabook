<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>book name</title>
    <link href="./style.css" rel="stylesheet" type="text/css">
    <!-- <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
            color: #333;
        }

        .container {
            max-width: 1000px;
            margin: auto;
            background: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            display: flex;
            gap: 40px;
        }

        .cover-section {
            flex: 1;
            max-width: 350px;
        }

        .cover-image {
            width: 100%;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .details-section {
            flex: 2;
            display: flex;
            flex-direction: column;
        }

        .title {
            font-size: 2em;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .author {
            font-size: 1.2em;
            color: #555;
            margin-bottom: 15px;
        }

        .rating {
            margin-bottom: 15px;
        }

        .rating .stars {
            color: #f5a623;
            font-size: 1.2em;
            margin-right: 8px;
        }

        .price {
            font-size: 1.8em;
            font-weight: bold;
            color: #b12704;
            margin-bottom: 20px;
        }

        .buy-section {
            margin-bottom: 20px;
        }

        button.buy-btn {
            background-color: #ffa41c;
            border: none;
            padding: 14px 30px;
            font-size: 1.1em;
            font-weight: 600;
            cursor: pointer;
            border-radius: 6px;
            color: #111;
            transition: background-color 0.3s ease;
        }

        button.buy-btn:hover {
            background-color: #cc8500;
        }

        .book-info {
            line-height: 1.5;
            font-size: 1em;
            color: #444;
        }

        .section-title {
            font-weight: bold;
            font-size: 1.3em;
            margin: 28px 0 10px 0;
        }

        .additional-info {
            font-size: 0.9em;
            color: #666;
            margin-top: 5px;
        }
    </style> -->
</head>

<body>
    <!-- Header Section, Nav and Search -->
    <?php
    require "header.php";
    ?>
    <div class="container">
        <div class="cover-section">
            <img id="book-cover" class="cover-image" src="" alt="Book Cover" />
        </div>
        <div class="details-section">
            <div id="book-title" class="title">Divergent</div>
            <div id="book-author" class="author">Veronica Roth</div>
            <div id="book-price" class="price">$17.99</div>
            <div class="buy-section">
                <button id="buy-button" class="buy-btn">Add to Cart</button>
            </div>
            <div>
                <div class="section-title"> 'In a dystopian society, a young girl discovers she is Divergent</div>

            </div>
            <div>
                <div class="section-title">Details</div>
                <p id="book-publisher" class="additional-info"><strong>Publisher:</strong> Katherin Tengen Books</p>
                <p id="book-published-date" class="additional-info"><strong>Published Date:</strong> 2011</p>
                <p id="book-isbn" class="additional-info"><strong>ISBN:</strong> 9780062073488</p>
                <p id="book-pages" class="additional-info"><strong>Pages:</strong> 487</p>
                <p id="book-language" class="additional-info"><strong>Language:</strong> English</p>
            </div>
        </div>
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