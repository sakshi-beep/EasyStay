<?php
include('./admin/inc/db_config.php'); // your DB connection file

if (isset($_GET['query'])) {
  $search_term = $_GET['query'];
  $search_term_safe = htmlspecialchars($search_term);

  echo "<h3 class='mt-4'>Search results for '<strong>$search_term_safe</strong>'</h3>";

  // Example query - update table/columns as needed
  $stmt = $con->prepare("SELECT * FROM rooms WHERE name LIKE '$input%'");
  $like = "%$search_term%";
  $stmt->bind_param("ss", $input, $input);
  $stmt->execute(); 
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      echo "<div class='card mb-3 p-3'>";
      echo "<h5>" . htmlspecialchars($row['name']) . "</h5>";
      echo "<p>" . htmlspecialchars($row['location']) . "</p>";
      echo "</div>";
    }
  } else {
    echo "<p>No hostels found matching your search.</p>";
  }

  $stmt->close();
}
?>
