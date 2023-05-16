<!DOCTYPE html>
<html>
<?php require("libs/fetch_data.php");?>
<!DOCTYPE html>
<html lang="zxx">
<head>
	<title>Members</title>
	<title><?php echo $row['title']; ?>|<?php getwebname("titles");?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
	<link id="browser_favicon" rel="shortcut icon" href="blogadmin/images/<?php geticon("titles"); ?>">
	<meta charset="utf-8" name="description" content="<?php getshortdescription("titles");?>">
	<meta name="keywords" content="<?php getkeywords("titles");?>" />
	<script>
		addEventListener("load", function () {
			setTimeout(hideURLbar, 0);
		}, false);

		function hideURLbar() {
			window.scrollTo(0, 1);
		}
	</script>
	<link href="css/bootstrap.css" rel='stylesheet' type='text/css' />
	<link rel="stylesheet" href="css/single.css">
	<link href="css/style.css" rel='stylesheet' type='text/css' />
	<link href="css/fontawesome-all.css" rel="stylesheet">
	<link href="//fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800"
	rel="stylesheet">
	<!--additional javascripts will be placed here-->
	
</head>
<body>
	<div class="banner-inner">
	</div>
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="index.php">Home</a>
		</li>
		<li class="breadcrumb-item active">Profile</li>
	</li>
	</ol>
	<div class="container">
		<h1 class="mt-5 font-weight-bold">Dosen</h1>
		<hr>
		<div class="row">
			<?php
			// Include the database configuration file
			include 'koneksi.php';

			// Get data from the "member" table
			$sql = "SELECT * FROM member WHERE status IN ('dosen')";
			$result = $conn->query($sql);

			// Check if any records found
			if ($result->num_rows > 0) {
			    // Loop through each record
			    while ($row = $result->fetch_assoc()) {
			        ?>
			        <div class="col-md-4">
			        	<div class="card">
			        		<img class="card-img-top" src="blogadmin/images/<?php echo $row['photo']; ?>" alt="fantastic cms" class="img-fluid" style="max-width:400px;height:320px"/>
			        		<div class="floods-text">
			        			<span class="card-title font-weight-bold text-light ml-2">@<?php echo $row['nama']; ?><label class="font-weight-normal text-dark ml-1"> | </label>
			        			<i class="font-weight-light text-light"><?php echo $row['jabatan']; ?></i></span>
			        		</div>
			        	</div>
			        </div>
			        <?php
			    }
			} else {
			    // No records found
			    echo "<p>No records found.</p>";
			}

			// Close database connection
			$conn->close();
			?>
		</div>
	</div>

		<div class="container">
		<h1 class="mt-5 font-weight-bold">Mahasiswa</h1>
		<hr>
		<div class="row">
			<?php
			// Include the database configuration file
			include 'koneksi.php';

			// Get data from the "member" table
			$sql = "SELECT * FROM member WHERE status NOT IN ('Dosen')";
			$result = $conn->query($sql);

			// Check if any records found
			if ($result->num_rows > 0) {
			    // Loop through each record
			    while ($row = $result->fetch_assoc()) {
			        ?>
			        <div class="col-md-4">
			        	<div class="card">
			        		<img class="card-img-top" src="blogadmin/images/<?php echo $row['photo']; ?>" alt="fantastic cms" class="img-fluid" style="max-width:400px;height:320px"/>
			        		<div class="floods-text">
			        			<span class="card-title font-weight-bold text-light ml-2">@<?php echo $row['nama']; ?><label class="font-weight-normal text-dark ml-1"> | </label>
			        			<i class="font-weight-light text-light"><?php echo $row['jabatan']; ?></i></span>
			        		</div>
			        	</div>
			        </div>
			        <?php
			    }
			} else {
			    // No records found
			    echo "<p>No records found.</p>";
			}

			// Close database connection
			$conn->close();
			?>
		</div>
	</div>
	<div class="mt-5">
	<?php include("footer.php");?>
	<!-- Include Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
