<?php

$host = 'localhost'; 
$dbname = 'dbpersonal'; 
$username = 'root';
$password = ''; 

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  echo "Connected successfully";

  //POST request and form validation
  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = test_input($_POST['name']);
    $email = test_input($_POST['email']);
    $recipient = test_input($_POST['recipient']);
    $message = test_input($_POST['message']);

    $stmt = $conn->prepare("INSERT INTO messages (name, email, recipient, message) VALUES (?, ?, ?, ?)");

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
      }

    $stmt->bind_Param("ssss", $name, $email, $recipient, $message);

    if ($stmt->execute()) {

        header("Location: message_receipt.php?name=$name&email=$email&recipient=$recipient&message=$message");
        exit();
    } else {
        echo "Failed to send the message.";
    }

  }

$stmt->close();
$conn->close();
?>
