<!-- <?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $sql = "INSERT INTO users (email, password, firstname, lastname) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $email, $password, $firstname, $lastname);

    if ($stmt->execute()) {
        header("Location: ../login.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?> -->
<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];

    $sql = "INSERT INTO users (email, password, firstname, lastname) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $email, $password, $firstname, $lastname);

    if ($stmt->execute()) {
        header("Location: cruises.html");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $stmt->close();
    $conn->close();
}
?>
