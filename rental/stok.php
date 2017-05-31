<?php 
//this function created by Sigit Dwi Prasetyo
//More information visit www.sixghakreasi.com / 0818956973
?>

<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
if (!isset($_POST['proses']) and ($_POST['proses']=="form1"))
	{
		$sql="SELECT * FROM stok ORDER BY mobil_id ASC";	
		$sumQty="SELECT SUM(qty) AS totalQty FROM stok";
	}
	elseif (isset($_POST['proses']) and ($_POST['mobil_nama']==""))
	{
		$sql="SELECT * FROM stok ORDER BY mobil_id ASC";
		$sumQty="SELECT SUM(qty) AS totalQty FROM stok";
	}
	else
	{
		$sql="SELECT * FROM stok WHERE mobil_nama LIKE '%$_POST[mobil_nama]%'";	
		$sumQty="SELECT SUM(qty) AS totalQty FROM stok WHERE mobil_nama LIKE '%$_POST[mobil_nama]%'";
	}

	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>

<body>
<div id="judulHalaman"><strong>Data Stok ketersediaan mobil siap rental</strong></div>
<form id="form1" name="form1" method="post" action="index.php?halaman=stok">
<input name="proses" type="hidden" value="form1" />
<table cellpadding="0" cellspacing="1">
  <tr>
    <td>Pencarian mobil</td>
  </tr>
  <tr>
    <td><input name="mobil_nama" id="input" type="text" /><input name="cari" id="tombol" type="submit" value="cari" /></td>
  </tr>
</table>
</form>
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
  	<td id="namaField">No</td>
    <td id="namaField">ID mobil</td>
    <td id="namaField">Nama mobil</td>
    <td id="namaField">Kategori</td>
    <td id="namaField">Mobil Tersedia</td>
    <td id="namaField">Satuan</td>
    
  </tr>
    <?php
		$no=1;
		$query=mysql_query($sql);
		while($data=mysql_fetch_array($query))
		{
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
	echo "
  <tr bgcolor=$warna>
  	<td>$no</td>
    <td>$data[mobil_id]</td>
    <td>$data[mobil_nama]</td>
    <td>$data[kategori]</td>
    <td><center>$data[qty]</center></td>
	<td>$data[satuan]</td>";
	
    echo "</tr>";
	$no++;
	} ?>
   <tr>
  	<td style="background-color:#333;color:#FFF;border:none" colspan="4" align="right">total :</td>
    <td id="namaField">
    	<?php
			$qsumQty=mysql_query($sumQty);
			$dsumQty=mysql_fetch_array($qsumQty);
			echo $dsumQty['totalQty'];
		?>
    </td>
    <td id="namaField" colspan="3">&nbsp;</td>
  </tr>
</table>
</body>
</html>