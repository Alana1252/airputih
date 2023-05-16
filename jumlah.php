<?php
require 'koneksi.php';
// Membuat query untuk menghitung jumlah data
$sql = "SELECT COUNT(*) as total FROM member WHERE status = 'Dosen'";
$result = mysqli_query($conn, $sql);

// Mengecek apakah query berhasil dieksekusi
if (mysqli_num_rows($result) > 0) {
  // Mengambil hasil perhitungan dan menampilkannya
  $row = mysqli_fetch_assoc($result);
  echo "" . $row["total"];
} else {
  echo "Tidak ada Dosen";
}

// Menutup koneksi
mysqli_close($conn);
?>