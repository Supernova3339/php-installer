<?php

// Set the database connection details
$dbHost = '';
$dbName = '';
$dbUser = '';
$dbPass = '';

// Check if the form has been submitted
if (isset($_POST['submit'])) {
  // Set the database connection details from the form
  $dbHost = $_POST['db_host'];
  $dbName = $_POST['db_name'];
  $dbUser = $_POST['db_user'];
  $dbPass = $_POST['db_pass'];

  // Try to connect to the database
  try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbUser, $dbPass);
  } catch (PDOException $e) {
    die('Could not connect to the database: ' . $e->getMessage());
  }

  // If the connection was successful, create a user
  $pdo->query("INSERT INTO users (username, password) VALUES ('admin', 'password')");

  // Save the database connection details to a configuration file
  $config = "<?php\n";
  $config .= "\$dbHost = '$dbHost';\n";
  $config .= "\$dbName = '$dbName';\n";
  $config .= "\$dbUser = '$dbUser';\n";
  $config .= "\$dbPass = '$dbPass';\n";
  $config .= "?>";

file_put_contents('config.php', $config);
}

?>
<!DOCTYPE html>
<html>
<head>
  <title>PHP Application Installer</title>
</head>
<body>
  <h1>PHP Application Installer</h1>
  <form method="post" action="">
    <label for="db_host">Database Host:</label><br>
    <input type="text" name="db_host" value="<?php echo $dbHost; ?>"><br><br>
    <label for="db_name">Database Name:</label><br>
    <input type="text" name="db_name" value="<?php echo $dbName; ?>"><br><br>
    <label for="db_user">Database User:</label><br>
    <input type="text" name="db_user" value="<?php echo $dbUser; ?>"><br><br>
    <label for="db_pass">Database Password:</label><br>
    <input type="password" name="db_pass" value="<?php echo $dbPass; ?>"><br><br>
    <input type="submit" name="submit" value="Install">
  </form>
</body>
</html>
