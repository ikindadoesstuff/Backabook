<?php require "head.php" ?>

<body>
	<?php require "header.php" ?>

	<main>
		<div id="content-not-found">
			<div class="container" id="not-found-container">
				<h1>Error 404</h1>
				<h3>
					The item you were looking for
					<?php
					if (isset($_SERVER['HTTP_REFERER'])) {
						$link = htmlspecialchars($_SERVER['HTTP_REFERER']);
						echo ", <br><code>" . $link . "</code><br>";
					}
					?>
					could not be found.
				</h3>
			</div>
		</div>
	</main>

	<?php require "footer.php" ?>
</body>