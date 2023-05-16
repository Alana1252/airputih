<?php
    // resume existing session
    session_start();

    // Check if session name exists
    if (!isset($_SESSION["name"])) {
        header("Location: ../logout.php");
        exit();
    }

    require_once "../config.php";
    if(isset($_FILES['txtUpload']['name'])){
        // file name
        $filename = $_FILES['txtUpload']['name'];
     
        // Location
        $location = 'img/'.$filename;
     
        // file extension
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
     
        // Valid extensions
        $valid_ext = array("jpg","png","jpeg");
     
        if(in_array($file_extension, $valid_ext)){
           // Upload file
            if(move_uploaded_file($_FILES['txtUpload']['tmp_name'], $location)){
                if ($stmt = $con->prepare("UPDATE `accounts` SET `image`=? WHERE `username` = ?")) {
                    // Bind parameters
                    $bp = $stmt->bind_param("ss", $location, $_SESSION["username"]);
                    if ($bp === false) {
                        die('bind_param() failed: ' . htmlspecialchars($stmt->error));
                    }
                    // Execute query
                    $ex = $stmt->execute();
                    if ($ex === false) {
                        die('execute() failed: ' . htmlspecialchars($stmt->error));
                    }
                    $stmt->close();
                } else {
                    die('prepare() failed: ' . htmlspecialchars($con->error));
                }
            }
        }
    }

    $image = "img/pria.jpg";
    if ($stmt = $con->prepare("SELECT `image`, `name`, `date_created` FROM `accounts` WHERE `username`=? LIMIT 1")) {
        // Bind parameters
        $bp = $stmt->bind_param("s", $_SESSION["username"]);
        if ($bp === false) {
            die('bind_param() failed: ' . htmlspecialchars($stmt->error));
        }
        // Execute query
        $ex = $stmt->execute();
        if ($ex === false) {
            die('execute() failed: ' . htmlspecialchars($stmt->error));
        }
        // Bind result
        $stmt->bind_result($img, $name, $date);
        $stmt->fetch();
        if ($img != "") {
            $image = $img;
        }
        $stmt->close();
    } else {
        die('prepare() failed: ' . htmlspecialchars($con->error));
    }

    $con->close();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Simple Login System in PHP</title>
    <link rel="stylesheet" href="../style.css">
</head>

<body>
    <main>
        <div class="container page">
            <div class="title">
                <h1>Simple Login System in PHP</h1>
                <h3>&#187; Jake R. Pomperada, MAED-IT, MIT &#171;</h3>
                <br>
                <br>
            </div>
            <div class="title page">
                <div class="img-block">
                    <img src="<?php echo $image; ?>" id="imgBlock" class="imgBlock" onclick="fileUpload()">
                    <form action="" method="post" id="frmUpload" enctype="multipart/form-data">
                        <input type="file" name="txtUpload" id="txtUpload" hidden>
                    </form>
                    <button type="button" id="btnUpdate" class="btn" onclick="fileUpload()">Update Profile Picture</button>
                </div>
                <h1>Welcome <span class="name"><?php echo $_SESSION["name"]; ?></span>!</h1>
                <h2>Date Created: <?php echo date("F j, Y, g:i A", strtotime($_SESSION["date"]));?></h2>

                <div class="btnWrapper btn-page">
                    <a href="register.php" class="btn btnRegister">Creat New Account</a>
                    <a href="index.php" class="btn btnLogout">Back</a>
                </div>
            </div>
        </div>
    </main>

    <script>
    var img = document.getElementById("txtUpload");

    function fileUpload() {
        document.getElementById("txtUpload").click();
    }

    img.onchange = function() {
        document.getElementById("frmUpload").submit();
    };
    </script>
</body>

</html>