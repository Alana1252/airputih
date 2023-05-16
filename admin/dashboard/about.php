<?php

// koneksi ke database
include_once '../znew/koneksi.php';


// Query untuk mendapatkan data dari tabel album
$sql = "SELECT * FROM titles";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Menampilkan Album</title>
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
<?php
include("navbar.php");?>
	<div class="container mt-5">
		
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>About Us</th>
                    <th>Text 1</th>
                    <th>Text 2</th>
					<th>Text 3</th>
					<th>Text 4</th>
                    <th class="text-center">Logo</th>
					<th>Option</th>
				</tr>
			</thead>
			<tbody>
				<?php while ($row = mysqli_fetch_assoc($result)) { ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['detailed_description']; ?></td>
						<td><?php echo $row['bannertext1']; ?></td>
						<td><?php echo $row['bannertext2']; ?></td>
						<td><?php echo $row['bannertext3']; ?></td>
                        <td><?php echo $row['bannertext4']; ?></td>
						<td><img src="../blogadmin/images/<?php echo $row['icon']; ?>" width="100" height="100"></td>
						<td><a href="about_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
								
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