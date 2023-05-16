<body class="body">
<?php
    include("navbar.php");?> 
<!-- Itung memori yang terpakai -->
<table align="center" valign="top" class="mt-5">
<tr>
<td>Used memory</td>
<td>Allocated memory</td>
<td>Difference</td>
</tr>
<?php
$big_array = array();
for ($i = 0; $i < 100000; $i++)
{
   $big_array[] = 'aaa' . $i;
   
   if (($i % 7000) == 0)
   {
      /* With $real_usage = false (the default value) */
      $used_mem = round(memory_get_usage(false) / 1024);
      
      /* With $real_usage = true */
      $alloc_mem = round(memory_get_usage(true) / 1024);
      
      echo '<tr><td style="color: green; border: 1px solid #888;">' . $used_mem . 'KB</td>';
      echo '<td style="color: blue; border: 1px solid #888;">' . $alloc_mem . 'KB</td>';
      echo '<td style="color: red; border: 1px solid #888;">' . ($alloc_mem - $used_mem) . 'KB</td></tr>';
   }
}
?>
<style>
.body {
  background-image: url("img/background.gif");
  background-size: cover; /* optional, adjusts the size of the image to cover the entire element */
}

</style>
<body class="body">
    aaa
</body>