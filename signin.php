<?php
// Database connection
$db = new mysqli('localhost:3307', 'root', '', 'travel');

// Check connection
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

// Initialize variables
$username = isset($_POST["user"]) ? $_POST["user"] : '';
$password = isset($_POST["pass"]) ? $_POST["pass"] : '';
$d = date("Y-m-d h:i:sa");
$i = 0;
$usern = "";
$passd = "";

if (isset($_POST['submit'])) {
    // Check if the user is admin
    if ($username == 'admin' && $password == 'ad123') {
        $stmt = $db->prepare("INSERT INTO `login` (`user`, `pass`, `date_time`) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $password, $d);
        $stmt->execute();
        header('Location: admin.php');
        exit();
    } else {
        // Prepare statement to prevent SQL injection
        $stmt = $db->prepare("SELECT fname, password FROM `customer` WHERE fname = ? AND password = ?");
        $stmt->bind_param("ss", $username, $password);
        $stmt->execute();
        $stmt->store_result();

        // Check if user exists
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($usern, $passd);
            $stmt->fetch();

            // Verify the fetched credentials
            if ($usern == $username && $passd == $password) {
                $stmt = $db->prepare("INSERT INTO `login` (`user`, `pass`, `date_time`) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $username, $password, $d);
                $stmt->execute();
                header("Location: mainPage.html");
                exit();
            }
        }

        // Invalid login
        echo "<script>alert('Invalid username or password');</script>";
    }
}
?>
