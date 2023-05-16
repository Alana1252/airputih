<?php
// Connect to database
include_once '../../koneksi.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $nama = $_POST['nama'];
  $asal = $_POST['asal'];
  $umur = $_POST['umur'];
  $gender = $_POST['gender'];
  $hobi = $_POST['hobi'];
  $jabatan = $_POST['jabatan'];
  $discord = $_POST['discord'];
  $username = $_POST['username'];
  $anggota = $_POST['anggota'];

  // Upload photo
  $target_dir = "../../images/img-member/";
  $target_file = $target_dir . basename($_FILES["photo"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
  // Check if image file is a actual image or fake image
  if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["photo"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      $error_message = "File is not an image.";
      $uploadOk = 0;
    }
  }
 
  // Check file size
  if ($_FILES["photo"]["size"] > 500000) {
    $error_message = "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $error_message = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $alert_type = "danger";
    $alert_message = "Gagal menambahkan data: " . $error_message;
  } else {
    // if everything is ok, try to upload file
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
      // Insert member data into database
      $sql = "INSERT INTO member (nama, asal, umur, gender, hobi, jabatan, discord, username, anggota, photo) VALUES ('$nama', '$asal', '$umur', '$gender', '$hobi', '$jabatan', '$discord', '$username', '$anggota', '".basename($_FILES["photo"]["name"])."')";
      if ($conn->query($sql) === TRUE) {
        $alert_type = "success";
        $alert_message = "Berhasil menambahkan data";
        // Redirect to member list page
        header("Location: member.php");
        exit();
      } else {
        $alert_type = "danger";
        $alert_message = "Gagal menambahkan data: " . $conn->error;
      }
    } else {
      $alert_type = "danger";
      $alert_message = "Gagal menambahkan data: Terjadi kesalahan saat mengunggah foto";
    }
  }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Formulir Member</title>
  <!-- CSS -->
  <link rel="stylesheet"href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <style>
    .alert {
      position: fixed;
      top: 10px;
      right: 10px;
      z-index: 9999;
      display: none;
    }
  </style>
</head>
<body>
  <!-- Alert -->
  <div id="alert" class="alert alert-<?php echo $alert_type; ?>" role="alert">
    <?php echo $alert_message; ?>
  </div>
  <!-- Form -->
  <form method="post" enctype="multipart/form-data" class="align-content-xl-center">
    <!-- Form fields here -->
    <?php include_once '../navbar.php'; ?>
    <div class="form-row ml-5 mt-1 justify-content-center">
      <!-- Form fields here -->
    </div>
    <div class="form-row ml-5 mt-1 justify-content-center">
      <!-- Form fields here -->
    </div>
    <div class="form-row ml-5 mt-1 justify-content-center">
      <!-- Form fields here -->
    </div>
    <div class="form-row row justify-content-center">
      <!-- Form fields here -->
    </div>
  </form>
  <!-- JavaScript -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <script>
    $(document).ready(function() {
      // Show the alert with fade in effect
      $(".alert").fadeIn();

      // Hide the alert with fade out effect after 3 seconds
      setTimeout(function() {
        $(".alert").fadeOut();
      }, 3000);
    });
  </script>












<!---ATAS-->
<div class="form-row ml-5 mt-1">
    <div class="col-md-2 mb-3 my-1">
      <label for="title">Title :</label>
      <input type="text" class="form-control" id="title" placeholder="Titile" name="title" required>
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="content">Content :</label>
      <input type="text" class="form-control" id="content" placeholder="Content" name="content" required>
    </div>
      <div class="col-md-2 mb-3 my-1 ml-2">
    <label for="posted">Posted :</label>
	<select class="custom-select mr-sm-5" id="posted" name="posted">
        <option selected>Choose</option>
        <option value="publish">Publish</option>
      	<option value="private">Private</option>
      </select>
		</div> 
</div>

<!-- Tengah -->
<div class="form-row ml-5 mt-1">
    <div class="col-md-2 mb-3 my-1">
      <label for="category">Category :</label>
      <input type="text" class="form-control" id="category" placeholder="Category" name="category" readonly required value="2">
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="tags">Tags :</label>
      <input type="text" class="form-control" id="tags" placeholder="Tags" name="tags" readonly required value="life">
    </div>
  </div>
<!-- Bawah -->

</div>
<div class="form-row ml-5 mt-1">
  <div class="form-group col-md-2 mt-2 ml-2">
    <label for="photo">Photo:</label>
    <input type="file" class="form-control-file" id="photo" name="photo">
  </div>
  <div class="form-group mt-4 ml-1">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
<?php include("footer.php");?>
<script>
  // Set default value for category input
  document.getElementById("category").value = "2";
  
  // Set default value for tags input
  document.getElementById("tags").value = "life";
</script>