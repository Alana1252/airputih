<?php

// koneksi ke database
include_once '../../koneksi.php';

// memeriksa apakah tombol delete diklik
if(isset($_GET['delete_id'])) {
    $id = $_GET['delete_id'];
    
    // menghapus data dengan id yang sesuai dari tabel album
    $query = "DELETE FROM blogs WHERE id='$id'";
    $result = mysqli_query($conn, $query);
    
    // mengembalikan ke halaman album.php setelah selesai menghapus data
    header("Location: album.php");
    exit();
}

// Query untuk mendapatkan data dari tabel album
$sql = "SELECT * FROM blogs";
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
	<div class="container mt-5">
		
		<h2 class="mb-4">Album</h2>
		<a href="tambah_album.php" class="btn btn-primary mb-3">Tambah Album</a>
		<table class="table">
			<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Content</th>
                    <th>Posted</th>
                    <th>Date</th>
					<th>Photo</th>
					<th>Options</th>
					<th>Aksi</th>
					
				</tr>
			</thead>
			<tbody>
				<?php while ($row = mysqli_fetch_assoc($result)) { ?>
					<tr>
						<td><?php echo $row['id']; ?></td>
						<td><?php echo $row['title']; ?></td>
						<td><?php echo $row['content']; ?></td>
						<td><?php echo $row['posted']; ?></td>
						<td><?php echo $row['date']; ?></td>
						<td><img src="../../images/img-album/<?php echo $row['photo']; ?>" width="100" height="100"></td>
						<td><a href="album_edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm" style="width:300px;">Edit Album</a>
								<a href="album.php?delete_id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Anda yakin akan menghapus data ini?')">Delete</a>
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