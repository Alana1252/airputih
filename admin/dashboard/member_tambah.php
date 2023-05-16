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
<!DOCTYPE html>
<html>
<head>
  <title>Contoh Form Upload</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
  <div class="container">
    <h2>Form Upload</h2>
    <!-- Form upload dan elemen pesan -->
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data">
      <!-- Form input fields -->
      <div class="form-group">
        <label for="nama">Nama:</label>
        <input type="text" class="form-control" id="nama" name="nama">
      </div>

      <!-- ... -->

      <!-- File input field -->
      <div class="form-group">
        <label for="photo">Photo:</label>
        <input type="file" class="form-control" id="photo" name="photo">
      </div>

      <!-- Submit button -->
      <button type="submit" class="btn btn-primary" name="submit">Upload</button>
    </form>

    <!-- Elemen pesan -->
    <div id="message" class="alert alert-dismissible fade show" style="position: fixed; top: 20px; right: 20px; display: none;">
      <button type="button" class="close" data-dismiss="alert">&times;</button>
      <span id="message-text"></span>
    </div>
  </div>

  <!-- Script untuk menampilkan pesan fade in dan fade out -->
  <script>
    $(document).ready(function() {
      // Fade in pesan
      function showMessage(message, className) {
        $('#message-text').text(message);
        $('#message').addClass(className).fadeIn();

        // Menghilangkan pesan setelah 5 detik
        setTimeout(function() {
          $('#message').fadeOut();
        }, 5000);
      }

      // Validasi file size dan format
      $('#photo').change(function() {
        var file = this.files[0];
        var fileSize = file.size;
        var fileType = file.type;
        var validFormats = ['image/jpeg', 'image/jpg', 'image/png'];

        if (fileSize > 500000) {
          showMessage('Sorry, your file is too large.', 'alert-danger');
          $(this).val('');
        } else if (!validFormats.includes(fileType)) {
          showMessage('Sorry, only JPG, JPEG, and PNG files are allowed.', 'alert-danger');
          $(this).val('');
        }
      });
    });
  </script>
</body>
</html>
