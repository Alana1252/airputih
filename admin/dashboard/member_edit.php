<?php
// Connect to database
include_once '../../koneksi.php';

// Get member data by ID
$id = $_GET['id'];
$sql = "SELECT * FROM member WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

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
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
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
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
  && $imageFileType != "webm" ) {
    echo "Sorry, only JPG, JPEG, & PNG files are allowed.";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
      // Update member data
      $sql = "UPDATE member
      SET nama = '$nama', asal = '$asal', umur = '$umur', gender = '$gender', hobi = '$hobi', jabatan = '$jabatan', discord = '$discord', username = '$username', anggota = '$anggota', photo = '".basename($_FILES["photo"]["name"])."'
      WHERE id = '$id';";
      $conn->query($sql);

      // Redirect to member list page
      header("Location: member.php");
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
    <?php
    include("../navbar.php");?>
	</head>
  <body>
<form method="post" enctype="multipart/form-data" class="align-content-xl-center">
<!---ATAS-->
   <!-- Nama, Username, Discord Tag -->
  <div class="form-row ml-5 mt-1 justify-content-center">
    <div class="col-md-2 mb-3 my-1">
      <label for="nama">Nama :</label>
      <input type="text" class="form-control" id="nama" name="nama" required placeholder="Masukkan nama..." value="<?php echo $row['nama']; ?>">
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="username">Username :</label>
      <input type="text" class="form-control" id="username" placeholder="Nama dalam game..." name="username" required value="<?php echo $row['username']; ?>">
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="discord">Discord tag :</label>
      <input type="text" class="form-control" id="discord" placeholder="Velskude#6969" name="discord" required value="<?php echo $row['discord']; ?>">
    </div>
  </div>
<?php include ("css/script.php")?>
  <!-- Tengah -->
  <div class="form-row ml-5 mt-1 justify-content-center">
    <div class="col-md-2 mb-3 my-1">
      <label for="asal">Asal :</label>
      <input type="text" class="form-control" id="asal" placeholder="Masukkan asal daerah..." name="asal" required value="<?php echo $row['asal']; ?>">
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="umur">Umur :</label>
      <input type="number" class="form-control" id="umur" placeholder="Masukkan umur..." name="umur" required value="<?php echo $row['umur']; ?>">
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="hobi">Hobi :</label>
      <input type="text" class="form-control" id="hobi" placeholder="Masukkan hobi..." name="hobi" required value="<?php echo $row['hobi']; ?>">
    </div>
  </div>

  <!-- Bawah -->
  <div class="form-row ml-5 mt-1 justify-content-center">
    <div class="col-md-2 mb-3">
      <label class="sr-only" for="gender">Gender</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Gender</div>
        </div></div>
        <select class="custom-select mr-sm-5" id="gender" name="gender">
          <option value="Laki-Laki" <?php if($row['gender'] == 'Laki-Laki') echo 'selected'; ?>>Laki-Laki</option>
          <option value="Perempuan" <?php if($row['gender'] == 'Perempuan') echo 'selected'; ?>>Perempuan</option>
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
        <option value="Staff" <?php if($row['jabatan'] == 'Staff') echo 'selected'; ?>>Staff</option>
        <option value="Donatur" <?php if($row['jabatan'] == 'Donatur') echo 'selected'; ?>>Donatur</option>
        <option value="Veteran" <?php if($row['jabatan'] == 'Veteran') echo 'selected'; ?>>Veteran</option>
        <option value="Ameteur" <?php if($row['jabatan'] == 'Ameteur') echo 'selected'; ?>>Ameteur</option>
        <option value="Novice" <?php if($row['jabatan'] == 'Novice') echo 'selected'; ?>>Novice</option>
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
        <option value="iya" <?php if($row['anggota'] == 'iya') echo 'selected'; ?>>iya</option>
        <option value="tidak" <?php if($row['anggota'] == 'tidak') echo 'selected'; ?>>tidak</option>
      </select>
    </div>
  </div>

  <div class="form-row row justify-content-center">
    <div class="form-group col-md-4 ml-2 mr-1 mt-2">






    <div class="form-group col-md-1 ml-5 mt-4">
      <button type="submit" class="btn btn-primary">Submit</button>
    </div>
  </div>
</form>


