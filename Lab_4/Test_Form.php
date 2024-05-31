<?php
require 'Text_Field.php';
require 'Email_Field.php';
require 'SubmitButton.php';

$textField = new TextField('name', 'Name');
$emailField = new EmailField('email', 'Email');
$submitButton = new SubmitButton('Submit');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Component-Based Form</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Register</h1>
        <form action="TestForm.php" method="post">
            <?php
            echo $textField->render();
            echo $emailField->render();
            echo $submitButton->render();
            ?>
        </form>
    </div>
</body>
</html>