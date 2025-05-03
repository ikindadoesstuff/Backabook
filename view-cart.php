<html lang="en">

<?php require "head.php" ?>

<body>
    <!-- Header Section, Nav and Search -->
    <?php
    require "header.php";
    ?>

    <!-- Main Content -->
    <main>
        <div class="container">

            <!-- Search Results -->
            <div id="list">
                <?php

                    require 'databaseConnection.php';
                    
                    $shoppingCart = $_COOKIE["shopping_cart"];
                    $cartItems = json_decode($shoppingCart,true);
                    $cartItems = $cartItems["items"];
                    
                    $totalPrice = 0; // Initialize total price
                    ?>
                    <div class="list-item list-header"> <!--style="height: 15px;"-->
                        <div class="list-item-left">
                            <p class="additional-info"> You have <b><? echo count($cartItems) ?> item<? echo count($cartItems) > 1 ? "s" : "" ?> </b> in your cart: </p>
                        </div>
                        <div class="list-item-right">
                            <button onclick="checkout()">Clear <span class="material-symbols-outlined">remove_shopping_cart</span> </button>
                        </div>
                    </div> <?
                                        
                    foreach ($cartItems as $item) {
                        $isbn = $item["isbn"];
                        alert("Cart Item " . $isbn);
                        $sqlQuery = "SELECT * FROM `book_infos` WHERE ISBN = ?";

                        $statement = queryDB($sqlQuery);
                        alert($sqlQuery. "(".$isbn.")");
                        
                        $statement->bind_param(
                            "s",
                            $isbn,
                        );
                        $statement->execute();
                        $result = $statement->get_result();
                        alert($result ? $result: "No Result");

                        if ($result) {
                            while ($book = $result->fetch_assoc()) {
                                $totalPrice += $book["PRICE"] * $item["quantity"]; // Add item price * quantity to total
                                ?>
                                <div class="list-item">
                                    <div class="list-item-left">
                                        <h2><? echo htmlspecialchars($book["TITLE"]); ?></h2>
                                        <h3><? echo htmlspecialchars($book["AUTHOR"]); ?>
                                            (<?php echo htmlspecialchars($book["PUBLICATION_YEAR"]); ?>)</h3>
                                        <p class="additional-info"><? echo htmlspecialchars($book["DESCRIPTION"]); ?></p>
                                    </div>
                                    <div class="list-item-right">
                                        <div>
                                            <h2 class="price-format">
                                                $<? echo htmlspecialchars(number_format($book["PRICE"], 2)); ?> BZD x 
                                                <? echo htmlspecialchars($item["quantity"], 2); ?> 
                                            </h2>
                                        </div>
                                        <div>
                                            <a href="book-details.php?isbn=<? echo urlencode($book["ISBN"]); ?>"
                                                class="view-details-button">
                                                <button>View Details</button>
                                            </a>
                                            <div class="quantity-spinner">
                                                <button onclick="removeFromCart('<? echo ($book["ISBN"]) . "', '" . htmlspecialchars($book["TITLE"]); ?>', false)"> <span class="material-symbols-outlined">remove</span> </button>
                                                <button onclick="addToCart('<? echo ($book["ISBN"]) . "', '" . htmlspecialchars($book["TITLE"]); ?>')">
                                                    <span class="material-symbols-outlined">add</span>
                                                </button>
                                            </div>
                                            <button onclick="checkout()"> <span class="material-symbols-outlined">close</span> </button>
                                        </div>
                                    </div>
                                </div>
                            <?
                            }
                        }
                    }
                    ?>
                    <div class="list-item list-header"> <!--style="height: 15px;"-->
                        <div class="list-item-left">
                            <!-- <p class="additional-info"> You have <b><? echo count($cartItems) ?> item<? echo count($cartItems) > 1 ? "s" : "" ?> </b> in your cart: </p> -->
                        </div>
                        <div class="list-item-right">
                            <h2>Total: </h2>
                            <h2 class="price-format">$<? echo htmlspecialchars(number_format($totalPrice, 2)); ?> BZD</h2>
                            <button onclick="checkout()">Checkout <span class="material-symbols-outlined">shopping_cart</span> </button>
                        </div>
                    </div>
                <?

                // just for testing
                function alert($msg)
                {
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