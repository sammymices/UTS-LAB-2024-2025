<?php
    session_start();
    include 'koneksi.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $login_sql = "SELECT id_user, username, password FROM userdata WHERE username = ?";
        $stmt = $conn->prepare($login_sql);

        if ($stmt) {
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows == 1) {
                $stmt->bind_result($user_id, $db_username, $db_password);
                $stmt->fetch();

                if (password_verify($password, $db_password)) {
                    $_SESSION['user_id'] = $user_id;
                    $_SESSION['username'] = $db_username;
                    header("Location: index.php");
                } else {
                    echo "Invalid password or username.";
                }
            } else {
                echo "Invalid password or username.";
            }

            $stmt->close();
        } else {
            echo "Error: " . $conn->error;
        }
    }

    $conn->close();
    ?>


<!DOCTYPE html>
<html>
<head>
    <title>Login - tudulis</title>
    <link rel="stylesheet" type="text/css" href="loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="path-to-sweetalert/sweetalert2.min.css">
</head>
<body style="background-color: #374151;">

</body>
</html>