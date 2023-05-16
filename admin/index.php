<?php
    $error = "";
    
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Start session
        session_start();

        // Establish connection to the database
        require_once "config.php";

        // Rename and sanitize post data
		$user = $con->real_escape_string($_POST['txtUser']);
        $pass = md5($con->real_escape_string($_POST['txtPass']));
        
        // Check if username and password match any record
        if ($stmt = $con->prepare("SELECT `username`, `name`, `date_created` FROM `accounts` WHERE `username` = ? AND `password` = ?")) {
            $stmt->bind_param("ss", $user, $pass);
            $stmt->execute();
            $stmt->store_result();

            if($stmt->num_rows > 0) {
                // If there is a match, store account details in session variables, redirect to page.php, and lastly close connection
                $stmt->bind_result($username, $name, $date);
                $stmt->fetch();
                $_SESSION['username'] = $username;
                $_SESSION['name']     = $name;
                $_SESSION['date']     = $date;
                $stmt->close();
                $con->close();
                header("Location: dashboard");
                exit();
            } else {
                // Show error message if nothing matched
                $error = '<div class="message">Password salah dek. Jangan ngasal napa!</div>';
            }
        } else {
            // Show error message incase there is something wrong with the sql statement
            $error = '<div class="message">Prepare failed: ('.$con->errno.') '.$stmt->error.'</div>';
        }
        // Close database connection
        $con->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
            <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">
    <!-- Data Tables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css">
    <!-- Font Google -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    <!-- Own CSS -->
    <link rel="stylesheet" href="css/style.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>NOB CLAN</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <main>
            <div class="container">
                <div class="title">
                    <h1>LOGIN</h1>
                    <h3>Gk bisa login? tanyak Alan!!</h3>
                </div>

                <div class="container-wrapper login">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                        <input type="text" class="txtbox" name="txtUser" id="txtUser" placeholder="Username" required>
                        <input type="password" class="txtbox" name="txtPass" id="txtPass" placeholder="Password" required>
                        
                        <div class="btnWrapper pt-3">
                            <button type="submit" class="btn btnLogin" name="btnLogin">Login</button>
                        </div>

                        <?php echo $error; ?>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>