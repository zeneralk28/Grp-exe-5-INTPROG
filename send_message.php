<?php

$host = 'localhost'; 
$dbname = 'dbpersonal'; 
$username = 'root';
$password = ''; 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $recipient = htmlspecialchars($_POST['recipient']);
        $message = htmlspecialchars($_POST['message']);

        $stmt = $pdo->prepare("INSERT INTO messages (name, email, recipient, message) VALUES (:name, :email, :recipient, :message)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':recipient', $recipient);
        $stmt->bindParam(':message', $message);

        if ($stmt->execute()) {
            echo "Message sent successfully!";
        } else {
            echo "Failed to send the message.";
        }
    }
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
