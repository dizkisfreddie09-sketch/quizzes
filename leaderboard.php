<?php

// Database configuration
$host = 'your_host';
$user = 'your_user';
$password = 'your_password';
database = 'your_database';

// Create connection
$conn = new mysqli($host, $user, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch quiz scores from the database
$sql = "SELECT name, section, score, percentage, date FROM quiz_scores ORDER BY score DESC";
$result = $conn->query($sql);

// Display scores in a table format
if ($result->num_rows > 0) {
    echo '<table border="1">';
    echo '<tr><th>Rank</th><th>Medal</th><th>Name</th><th>Section</th><th>Score</th><th>Percentage</th><th>Date</th></tr>';    
    $rank = 1;
    while($row = $result->fetch_assoc()) {
        $medal = '';
        if ($rank == 1) {
            $medal = '🥇';
        } elseif ($rank == 2) {
            $medal = '🥈';
        } elseif ($rank == 3) {
            $medal = '🥉';
        }
        echo "<tr><td>" . $rank . "</td><td>" . $medal . "</td><td>" . $row['name'] . "</td><td>" . $row['section'] . "</td><td>" . $row['score'] . "</td><td>" . $row['percentage'] . "%</td><td>" . $row['date'] . "</td></tr>";
        $rank++;
    }
    echo '</table>';    
} else {
    echo "No records found.";
}

// Close connection
$conn->close();
?>