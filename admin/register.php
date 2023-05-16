<?php
    // Start session
    session_start();

    // Declare variables
    $txtName = $txtUser = $name = $user = $msg = $temp = "";

    // Check if logged in (if logged in show back button, if not show login button)
    if (isset($_SESSION["name"])) {
        $button = '<a href="page.php" class="btn btnBack" name="btnBack">Back</a>';
    } else {
        $button = '<a href="index.php" class="btn btnLogin" name="btnLogin">Login</a>';
    }
    
    // Check if form was submitted
	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Establish connection to the database
        require_once "config.php";

        // Get and sanitize data
		$name = $con->real_escape_string($_POST['txtName']);
		$user = $con->real_escape_string($_POST['txtUser']);
        $pass = md5($con->real_escape_string($_POST['txtPass']));
        $conf = md5($con->real_escape_string($_POST['txtConfirm']));
        $checker = 0;
        
        // Check if username is alphanumeric and not less than 4 characters
        if (!ctype_alnum($user) || strlen($user)<4) {
            $checker = 1;
            $temp .= 'Username must be a minimum of 4 alphanumeric characters only.<br><br>';
        }
        
        // Check if password is alphanumeric and not less than 4 characters 
        if (!ctype_alnum($pass) || strlen($pass)<4) {
            $checker = 1;
            $temp .= 'Password must be a minimum of 4 alphanumeric characters only.<br><br>';
        }
        
        // check if password and confirm password matched
        if ($pass != $conf) {
            $checker = 1;
            $temp .= 'Passwords don\'t match.';
        }

        // Check if errors were found
        if($checker == 0) {
            // If there were no errors found, execute insert
            if ($stmt = $con->prepare("INSERT INTO `accounts`(`name`, `username`, `password`) VALUES (?, ?, ?)")) {
                $stmt->bind_param("sss", $name, $user, $pass);
                $stmt->execute();
                $msg = '<div class="message">Registered successfully! You may now login.</div>';
            } else {
                $msg = '<div class="message">Prepare failed: ('.$stmt->errno.') '.$con->error.'</div>';
            }

        } else {
            // If errors were found, show error message, name, and username
            $txtName = $name;
            $txtUser = $user;
            $msg = '<div class="message">'.$temp.'</div>';
        }

        // Close database connection
        $con->close();
    }
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Simple Login System in PHP</title>
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <main>
            <div class="container registration">
                <div class="title">
                    <h1>Registration Form</h1>
                    <h3>&#187; Jake R. Pomperada, MAED-IT, MIT &#171;</h3>
                </div>

                <div class="container-wrapper">
                    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" class="frmRegister">
                        <input type="text" class="txtbox" name="txtName" id="txtName" value="<?php echo $txtName; ?>" placeholder="Full Name" required>
                        <input type="text" class="txtbox" name="txtUser" id="txtUser" value="<?php echo $txtUser; ?>" placeholder="Username" required>
                        <input type="password" class="txtbox" name="txtPass" id="txtPass" placeholder="Password" required>
                        <input type="password" class="txtbox" name="txtConfirm" id="txtConfirm" placeholder="Confirm Password" required>
                        
                        <div class="btnWrapper">
                            <button type="submit" class="btn btnRegister" name="btnRegister">Register</button>
                            <?php echo $button; ?>
                        </div>
                        

                        <?php echo $msg; ?>
                    </form>
                </div>
            </div>
        </main>
    </body>
</html>