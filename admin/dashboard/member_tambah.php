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
    echo "<script>
      $(document).ready(function() {
        $('#message').addClass('alert-danger').text('Sorry, your file is too large.').fadeIn().delay(3000).fadeOut();
      });
    </script>";
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    echo "<script>
      $(document).ready(function() {
        $('#message').addClass('alert-danger').text('Sorry, only JPG, JPEG, PNG & GIF files are allowed.').fadeIn().delay(3000).fadeOut();
      });
    </script>";
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "<script>
      $(document).ready(function() {
        $('#message').addClass('alert-danger').text('Sorry, your file was not uploaded.').fadeIn().delay(3000).fadeOut();
      });
    </script>";
  } else {
    // if everything is ok, try to upload file
    if (move_uploaded_file($_FILES["photo"]["tmp_name"], $target_file)) {
      // Insert member data into database
      $sql = "INSERT INTO member (nama, asal, umur, gender, hobi, jabatan, discord, username, anggota, photo) VALUES ('$nama', '$asal', '$umur', '$gender', '$hobi', '$jabatan', '$discord', '$username', '$anggota', '".basename($_FILES["photo"]["name"])."')";
      if ($conn->query($sql) === TRUE) {
        // Redirect to member list page
        echo "<script>
          $(document).ready(function() {
            $('#message').addClass('alert-success').text('Data berhasil diupload.').fadeIn().delay(3000).fadeOut();
});
</script>";
header("Location: member.php");
exit();
} else {
echo "<script>
$(document).ready(function() {
$('#message').addClass('alert-danger').text('Error: " . $sql . "<br>" . $conn->error . "').fadeIn().delay(3000).fadeOut();
});
</script>";
}
} else {
echo "<script>
$(document).ready(function() {
$('#message').addClass('alert-danger').text('Sorry, there was an error uploading your file.').fadeIn().delay(3000).fadeOut();
});
</script>";
}
}
}

// Close database connection
$conn->close();
?>


<!-- HTML form with Bootstrap styling -->
    <html lang="en">

<head>
   <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<form method="POST" id="member-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" class="align-content-xl-center">
<!---ATAS-->
<?php include_once '../navbar.php'; ?>
<div class="form-row ml-5 mt-1 justify-content-center">
    <div class="col-md-2 mb-3 my-1">
      <label for="nama">Nama :</label>
      <input type="text" class="form-control" id="nama" name="nama"  placeholder="Masukan nama...">
    </div>
	  <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="username">Username :</label>
      <input type="text" class="form-control" id="username" placeholder="Nama didalam game..." name="username" >
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="discord">Discrod tag :</label>
      <input type="text" class="form-control" id="discord" placeholder="Velskude#6969" name="discord" >
    </div>
  </div>
<!-- Tengah -->
<div class="form-row ml-5 mt-1 justify-content-center">
    <div class="col-md-2 mb-3 my-1">
      <label for="asal">Asal :</label>
      <input type="text" class="form-control" id="asal" placeholder="Masukan asal daerah..." name="asal" >
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="umur">Umur :</label>
      <input type="number" class="form-control" id="umur" placeholder="Masukan Umur..." name="umur" >
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="hobi">Hobi :</label>
      <input type="text" class="form-control" id="hobi" placeholder="Masukan Hobi..." name="hobi" >
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
<button type="submit" class="btn btn-primary" name="submit">Upload</button>
  </form>

  <!-- Elemen pesan -->
  <div id="message" class="alert" style="position: fixed; top: 20px; right: 20px; display: none;"></div>

  <!-- Script untuk menampilkan pesan fade in dan fade out -->
  <script>
    $(document).ready(function() {
      // Fade in pesan
      function showSuccessMessage(message) {
        $('#message').removeClass('alert-danger').addClass('alert-success').text(message).fadeIn().delay(3000).fadeOut();
      }

      function showErrorMessage(message) {
        $('#message').removeClass('alert-success').addClass('alert-danger').text(message).fadeIn().delay(3000).fadeOut();
      }

      // Validasi file size dan format
      $('#photo').change(function() {
        var file = this.files[0];
        var fileSize = file.size;
        var fileType = file.type;
        var validFormats = ['image/jpeg', 'image/jpg', 'image/png'];

        if (fileSize > 500000) {
          showErrorMessage('Sorry, your file is too large.');
          $(this).val('');
        } else if (!validFormats.includes(fileType)) {
          showErrorMessage('Sorry, only JPG, JPEG, and PNG files are allowed.');
          $(this).val('');
        }
      });
    });
  </script>
</body>
</html>