<?php
// Connect to database
include_once '../../koneksi.php';
include_once 'css/script.php';

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
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }
 
  // Check file size
  if ($_FILES["photo"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  } else {
    // if everything is ok, try to upload file
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
      // Insert member data into database
      $sql = "INSERT INTO member (nama, asal, umur, gender, hobi, jabatan, discord, username, anggota, photo) VALUES ('$nama', '$asal', '$umur', '$gender', '$hobi', '$jabatan', '$discord', '$username', '$anggota', '".basename($_FILES["photo"]["name"])."')";
      if ($conn->query($sql) === TRUE) {
        // Redirect to member list page
        header("Location: member.php");
        exit();
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }g
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
<form method="post" enctype="multipart/form-data" class="align-content-xl-center">
<!---ATAS-->
<?php include_once '../navbar.php'; ?>
<div class="form-row ml-5 mt-1 justify-content-center">
    <div class="col-md-2 mb-3 my-1">
      <label for="nama">Nama :</label>
      <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukan nama...">
    </div>
	  <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="username">Username :</label>
      <input type="text" class="form-control" id="username" placeholder="Nama didalam game..." name="username" required>
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="discord">Discrod tag :</label>
      <input type="text" class="form-control" id="discord" placeholder="Velskude#6969" name="discord" required>
    </div>
  </div>
<!-- Tengah -->
<div class="form-row ml-5 mt-1 justify-content-center">
    <div class="col-md-2 mb-3 my-1">
      <label for="asal">Asal :</label>
      <input type="text" class="form-control" id="asal" placeholder="Masukan asal daerah..." name="asal" required>
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="umur">Umur :</label>
      <input type="number" class="form-control" id="umur" placeholder="Masukan Umur..." name="umur" required>
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="hobi">Hobi :</label>
      <input type="text" class="form-control" id="hobi" placeholder="Masukan Hobi..." name="hobi" required>
    </div>
  </div>
<!-- Bawah -->
<div class="form-row ml-5 mt-1 justify-content-center">
  <div class="col-md-2 mb-3">
    <label class="sr-only" for="gender">Gender</label>
	<div class="input-group">
        <div class="input-group-prepend">
        <div class="input-group-text">Gender</div>
        </div>
</div>
	<select class="custom-select mr-sm-5" id="gender" name="gender">
        <option selected>Choose</option>
        <option value="Laki-Laki">Laki-Laki</option>
      	<option value="Perempuan">Perempuan</option>
      </select>
		</div> 

  <div class="col-md-2 mb-3 ml-2">
    <label class="sr-only" for="jabatan">Jabatan</label>
	<div class="input-group">
        <div class="input-group-prepend">
        <div class="input-group-text">Jabatan</div>
        </div>
	</div>
	<select class="custom-select mr-sm-5" id="jabatan" name="jabatan">
        <option selected>Choose</option>
        <option value="Staff">Staff</option>
        <option value="Donatur">Donatur</option>
        <option value="Veteran">Veteran</option>
        <option value="Ameteur">Ameteur</option>
        <option value="Novice">Novice</option>
      </select>
	</div>
  
    <div class="col-md-2 mb-3 ml-2">
    <label class="sr-only" for="anggota">Anggota</label>
	<div class="input-group">
        <div class="input-group-prepend">
        <div class="input-group-text">Anggota</div>
        </div>
	</div>
	<select class="custom-select mr-sm-5" id="anggota" name="anggota">
        <option selected>Choose</option>
        <option value="iya">iya</option>
        <option value="tidak">tidak</option>
      </select>
	</div> 
</div>
 <div class="form-row row justify-content-center">
    <div class="form-group col-md-4 ml-2 mr-1 mt-2">
      <label for="photo">Photo:</label>
      <input type="file" class="form-control-file" id="photo" name="photo" onchange="uploadFile(this)">
  <progress class="upload-progress col-md-5 ml-1" id="progressbar" value="0" max="100"></progress>
  <span id="progress-label">0%</span>
    </div>

  <div class="form-group col-md-1 ml-5 mt-4">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</div>
</form>