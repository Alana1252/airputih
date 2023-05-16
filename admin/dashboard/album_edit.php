<?php
include_once '../../koneksi.php';

// Get member data by ID
$id = $_GET['id'];
$sql = "SELECT * FROM blogs WHERE id='$id'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $title = $_POST['title'];
  $content = $_POST['content'];
  $posted = $_POST['posted'];
  $date = $_POST['date'];


  // Upload photo
  $target_dir = "../../images/img-album/";
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
      $sql = "UPDATE blogs SET title='$title', content='$content', posted='$posted', date='$date', photo='".basename($_FILES["photo"]["name"])."' WHERE id='$id'";
      $conn->query($sql);

      // Redirect to member list page
      header("Location: album.php");
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
	
<form method="post" enctype="multipart/form-data" class="align-content-xl-center">
<!---ATAS-->
  <div class="form-row align-items-center ml-5">
    <div class="col-sm-1 my-1">
      <label class="sr-only" for="id">Id</label>
      <input type="text" readonly class="form-control text-center" id="id" value="ID : <?php echo $row['id']; ?>">
    </div>
    <div class="col-sm-3 my-1 ml-1 col-md-3 ml-2">
      <label class="sr-only" for="title">Title</label>
      <div class="input-group">
        <div class="input-group-prepend">
          <div class="input-group-text">Title : </div>
        </div>
        <input type="text" class="form-control" id="title" placeholder="title" name="title" required value="<?php echo $row['title']; ?>">
      </div>
	</div>
	  <div class="my-1 ml-2 col-md-3">
     <label for="content">Content :</label>
      <textarea type="text" class="form-control" id="content" rows="3" placeholder="content" name="content" required><?php echo $row['content']; ?></textarea>
		</div> 
	</div>
<!-- Tengah -->
<div class="form-row ml-5 mt-1">
    <div class="col-md-2 mb-3 my-1">
      <label class="sr-only" for="gender">Posted</label>
	<div class="input-group">
        <div class="input-group-prepend">
        <div class="input-group-text">Posted : </div>
        </div>
</div>
	<select class="custom-select mr-sm-5" id="posted" name="posted">
        <option selected>Choose</option>
        <option value="publish" <?php if ($row['posted'] == 'publish') echo 'selected'; ?>>Publish</option>
      	<option value="private" <?php if ($row['posted'] == 'private') echo 'selected'; ?>>Private</option>
      </select>
		</div> 
    <div class="col-md-2 mb-3 my-1 ml-2">
      <label for="date">Posted Date :</label>
      <input type="text" class="form-control" id="date" placeholder="date" name="date" readonly value="<?php echo $row['date']; ?>">
    </div>
    <div class="col-md-2 mb-3 my-1 ml-2">
       <label for="photo">Photo:</label>
    <input type="file" class="form-control-file" id="photo" name="photo">
  </div>
  </div>
<!-- Bawah -->
  <div class="form-group mt-4 ml-1 d-flex justify-content-center">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>
