

<?php

// koneksi ke database
include_once '../../koneksi.php';


// memeriksa apakah tombol delete diklik
if(isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    
    // menghapus data dengan id yang sesuai dari tabel member
    $query = "DELETE FROM member WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    
    // mengembalikan ke halaman index.php setelah selesai menghapus data
    header("Location: member.php");
    exit();
}

// Query untuk mendapatkan data dari tabel members
$sql = "SELECT * FROM member";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
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
        $location = 'img-member/'.$filename;
     
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

<!doctype html>
<html lang="en">
  <head>
	
  	<title>AirPutih | N0B</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">
		
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
		<link rel="stylesheet" href="css/style.css">
  </head>
  <body>
				<!--Sidebar-->
		<div class="wrapper d-flex align-items-stretch">
			<nav id="sidebar">
				<div class="p-4 pt-5">
		  		<img src="<?php echo $image; ?>" class="img logo rounded-circle mb-5" id="imgBlock" class="imgBlock" onclick="fileUpload()">
	        <ul class="list-unstyled components mb-5">
	          <li class="active">
	            <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Welcome <span class="name"><?php echo $_SESSION["name"]; ?></span>!</a>
	            <ul class="collapse list-unstyled" id="homeSubmenu">
                <li>
                    <a>Date Created: <?php echo date("F j Y,g:i A", strtotime($_SESSION["date"]));?></a>
                </li>
	            </ul>
	          </li>
	          <li>
	              <a href="page.php">Account Options</a>
	          </li>
	          <li>
              <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Pages</a>
              <ul class="collapse list-unstyled" id="pageSubmenu">
                <li>
                    <a href="album.php">Album</a>
                </li>
                <li>
                    <a href="member.php">Member</a>
                </li>
                <li>
                    <a href="memori.php">Memori Usages</a>
                </li>
				<li>
                    <a href="event.php">Event Settings</a>
                </li>
              </ul>
	          </li>
	          <li>
              <a href="ti6a.my.id">Go to Website</a>
	          </li>
	          <li>
              <a href="#">Contact Me</a>
	          </li>
	        </ul>

	        <div class="footer">
	        	<p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						  Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart" aria-hidden="true"></i> by <a href="#" target="_blank">airputih</a>
						  <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
	        </div>

	      </div>
    	</nav>

        <!-- Page Content  -->
      <div id="content" class="p-4 p-md-5">

        <nav class="navbar navbar-expand-lg navbar-light bg-light">
          <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-primary">
              <i class="fa fa-bars"></i>
              <span class="sr-only">Toggle Menu</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-bars"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="nav navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="album.php">Album</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="member.php">Event</a>
                </li>
                </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>


    <script src="js/jquery.min.js"></script>
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
<style>
.footer {
  position: fixed;
  left: 0;
  bottom: 0;
  width: 18%;
}
.gold {
  color: #FFD700;
}
.floods-text {
  position: absolute;
  bottom: 0%;
  left: 0%;
  padding: 1em;
  background: rgba(14, 15, 16, 0.67);
  width: 100%;
}

.card {
	max-width:400px;
	height:180px
}
</style>

<head>
	<title>Menampilkan Data Members</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
	<div class="container mt-5">


		<!--Data Member-->
		<h2 class="mb-4">DATA MEMBER</h2>
		<a href="member_tambah.php" class="btn btn-primary mb-3">Tambah Member</a>
		<table class="table">
			<thead>
				<tr class="text-center">
					<th>Nama</th>
					<th>Username</th>
					<th>Jabatan</th>
					<th>Anggota</th>
					<th>Asal</th>
					<th>Umur</th>
					<th>Gender</th>
					<th>Hobi</th>
					<th>Discord</th>
					<th>Photo</th>
					<th>Aksi</th>
				</tr>
			</thead>
			<tbody class="text-center">
				<?php while ($row = mysqli_fetch_assoc($result)) { ?>
					<tr>
						<td><?php echo $row['nama']; ?></td>
						<td><?php echo $row['username']; ?></td>
						<td><?php echo $row['jabatan']; ?></td>
						<td><?php echo $row['anggota']; ?></td>
						<td><?php echo $row['asal']; ?></td>
						<td><?php echo $row['umur']; ?></td>
						<td><?php echo $row['gender']; ?></td>
						<td><?php echo $row['hobi']; ?></td>
						<td><?php echo $row['discord']; ?></td>
						<td><img src="../../images/img-member/<?php echo $row['photo']; ?>" width="100" height="100"></td>
						<td><a href="member_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit Profil</a>
								<a href="member.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')">Delete</a>
					</tr>
				<?php } ?>
			</tbody>
		</table>
	</div>

	<!-- jQuery dan Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>

<?php
// Tutup koneksi ke database
mysqli_close($conn);
?>