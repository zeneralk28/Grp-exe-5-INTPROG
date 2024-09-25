<?php

$host = 'localhost'; 
$dbname = 'dbpersonal'; 
$username = 'root';
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Validation
    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    // Check if form data is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = test_input($_POST['name']);
        $email = test_input($_POST['email']);
        $recipient = test_input($_POST['recipient']);
        $message = test_input($_POST['message']);

        $stmt = $pdo->prepare("INSERT INTO messages (name, email, recipient, message) VALUES (:name, :email, :recipient, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':recipient', $recipient);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            // Redirect to message_receipt.php with the form data in the URL (GET method)
            header("Location: message_receipt.php?name=$name&email=$email&recipient=$recipient&message=$message");
            exit();
        } else {
            echo "Failed to send the message.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
