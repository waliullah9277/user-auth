<?php
// Include the database connection
require 'db.php';

$searchResults = ""; // To store search results
$error = ""; // To store any error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['query'])) {
    $query = trim($_POST['query']); // Remove extra spaces from input

    // Check if the search query is empty
    if (empty($query)) {
        $error = "Please enter a username to search.";
    } else {
        // Perform a simple SQL query to search for the username
        $sql = "SELECT id, username, name, email FROM users WHERE username LIKE ?";
        $stmt = $conn->prepare($sql);
        $likeQuery = "%" . $query . "%"; // Add wildcard for partial matching
        $stmt->bind_param("s", $likeQuery);
        $stmt->execute();
        $result = $stmt->get_result();

        // Check if any results are found
        if ($result->num_rows > 0) {
            $searchResults .= "<h2>Search Results:</h2>";
            while ($row = $result->fetch_assoc()) {
                // $searchResults .= "<div style='border: 1px solid #ccc; padding: 10px; margin: 5px;'>";
                $searchResults .= "<p><strong>Username:</strong> " . htmlspecialchars($row['username']) . "</p>";
                $searchResults .= "<p><strong>Name:</strong> " . htmlspecialchars($row['name']) . "</p>";
                $searchResults .= "<p><strong>Email:</strong> " . htmlspecialchars($row['email']) . "</p>";
                $searchResults .= "</div>";
            }
        } else {
            $error = "No users found with that username.";
        }
    }
}
?>