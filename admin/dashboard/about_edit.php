<?php
// Connect to database
include_once '../znew/koneksi.php';
include_once 'session.php';

// Get member data by ID
$id = $_GET['id'];
$sql = "SELECT * FROM titles WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $bannertext1 = $_POST['bannertext1'];
  $bannertext2 = $_POST['bannertext2'];
  $bannertext3 = $_POST['bannertext3'];
  $bannertext4 = $_POST['bannertext4'];
  $detailed_description = $_POST['detailed_description'];

  // Upload photo
  $target_dir = "../blogadmin/images/";
  $target_file = $target_dir . basename($_FILES["icon"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["icon"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }
 
  // Check file size
  if ($_FILES["icon"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "ico" && $imageFileType != "png" && $imageFileType != "ico"
  && $imageFileType != "png" ) {
    echo "Hanya bisa upload dengan format ico dan png. ";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["icon"]["tmp_name"], $target_file)) {
      // Update member data
      $sql = "UPDATE titles SET bannertext1='$bannertext1', bannertext2='$bannertext2', bannertext3='$bannertext3', bannertext4='$bannertext4', detailed_description='$detailed_description', icon='".basename($_FILES["icon"]["name"])."' WHERE id='$id'";
      $conn->query($sql);

      // Redirect to member list page
      header("Location: about.php");
      exit();
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }
}

// Close database connection
$conn->close();
?>

<!-- HTML form with Bootstrap styling -->
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
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark sticky-top text-uppercase mb-5">
        <div class="container">
            <a href="about.php"> <img src="img/back.png" width="95" height="70" class="d-inline-block gambar" alt="back">
            <div class="collapse navbar-collapse" id="navbarNav">
               
                <ul class="navbar-nav ms-auto">
                    <a href="logout.php">
                    <button type="button" class="btn btn-outline-warning" >Logout</button>
                    </a>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Close Navbar -->
    <?php
    include("session.php");?>
	
<form method="post" enctype="multipart/form-data" class="align-content-xl-center">
<!---ATAS-->
  <div class="form-row align-items-center ml-5">
    <div class="col-sm-1 my-1">
      <label class="sr-only" for="id">Id</label>
      <input type="text" readonly class="form-control text-center" id="id" value="ID : <?php echo $row['id']; ?>">
    </div>

	  <div class="my-1 ml-2 col-md-3">

      <label for="detailed_description">About :</label>
      <textarea type="text" class="form-control" id="detailed_description" rows="3" placeholder="About" name="detailed_description" required><?php echo $row['detailed_description']; ?></textarea>
</div>
</div>
<!-- Tengah -->
<div class="form-row ml-5">

    <div class="col-md-2 mb-3 my-1">
      <label for="bannertext1 ">Text 1 :</label>
      <input type="text" class="form-control" id="bannertext1" placeholder="Text 1" name="bannertext1" required value="<?php echo $row['bannertext1']; ?>">
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
 <label for="bannertext1 ">Text 2 :</label>
      <input type="text" class="form-control" id="bannertext2" placeholder="Text 2" name="bannertext2" required value="<?php echo $row['bannertext2']; ?>">
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="bannertext3 ">Text 3 :</label>
      <input type="text" class="form-control" id="bannertext3" placeholder="Text 3" name="bannertext3" required value="<?php echo $row['bannertext3']; ?>">
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
 <label for="bannertext1 ">Text 4 :</label>
      <input type="text" class="form-control" id="bannertext4" placeholder="Text 4" name="bannertext4" required value="<?php echo $row['bannertext4']; ?>">
    </div>
  </div>
<div class="form-row ml-5">
    <div class="my-1 col-md-3">
    <label for="icon">Icon:</label>
    <input type="file" class="form-control-file" id="icon" name="icon">
  </div>
  <div class="my-4 col-md-auto">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
<?php include("footer.php");?>