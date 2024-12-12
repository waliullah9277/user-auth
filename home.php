<?php
require 'db.php';
require 'index.php';
require 'search.php';
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="search_container">
        <h1>User Search</h1>
        <form method="POST" action="">
            <label for="query">Enter a username:</label><br>
            <input type="text" id="query" name="query" placeholder="Search username" required>
            <button type="submit">Search</button>
        </form>
    </div>

    <?php if (!empty($error)): ?>
        <p class="error"><?= htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <div class="results">
        <?= $searchResults; ?>
    </div>

    <div class="home_container">
        <h1>Craft Unique Magazines & Blogs with Revision</h1>
        <p>Transform your magazine or blog with standout layouts and user-friendly navigation that draw in readers and keep them engaged.</p>
        <div class="button_container">
            <button class="styled_button">Buy Revision</button>
            <button class="styled_button">View Demos</button>
        </div>
    </div>
</body>

</html>