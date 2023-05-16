<!DOCTYPE html>
<html>
<head>
	<title>Daftar Dosen</title>
	<!-- load Bootstrap CSS -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
	<div class="container">
		<table class="table table-striped">
			<thead>
				<tr>
					<th>Nama</th>
					<th>Umur</th>
					<th>Asal</th>
				</tr>
			</thead>
			<tbody>
				<?php
					//koneksi ke database
					require 'koneksi.php';

					//query data member
					$query = "SELECT nama, umur, asal FROM member WHERE status = 'Dosen' ORDER BY id DESC LIMIT 5 ";
					$result = mysqli_query($conn, $query);

					//tampilkan data member
					while ($row = mysqli_fetch_assoc($result)) {
						echo "<tr>";
						echo "<td>" . $row['nama'] . "</td>";
						echo "<td>" . $row['umur'] . "</td>";
						echo "<td>" . $row['asal'] . "</td>";
						echo "</tr>";
					}

					//membebaskan memori
					mysqli_free_result($result);

					//menutup koneksi
					mysqli_close($conn);
				?>
			</tbody>
		</table>
	</div>
	<!-- load Bootstrap JS -->
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
