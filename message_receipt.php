<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message Receipt</title>
    <link rel="stylesheet" href="styles.css?v=<?php echo time(); ?>">
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body id="receipt">

    <div class="container-receipt">
        <h2>Your Submitted Message</h2>

        <?php
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
        //GET request
        if (isset($_GET['name']) && isset($_GET['email']) && isset($_GET['recipient']) && isset($_GET['message'])) {
            $name = test_input($_GET['name']);
            $email = test_input($_GET['email']);
            $recipient = test_input($_GET['recipient']);
            $message = test_input($_GET['message']);

            echo "<p><strong>Name:</strong> $name</p>";
            echo "<p><strong>Email:</strong> $email</p>";
            echo "<p><strong>Recipient:</strong> $recipient</p>";
            echo "<p><strong>Message:</strong> $message</p>";
        } else {
            echo "<p>No data received.</p>";
        }
        ?>

        <a href="index.php"><i class="fas fa-arrow-left"></i> Go Back to the Form</a>
    </div>

</body>
</html>
