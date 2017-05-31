<?php 
//this function created by Sigit Dwi Prasetyo
//More information visit www.sixghakreasi.com / 0818956973
?>

<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
if (!isset($_POST['proses']) and ($_POST['proses']=="form1"))
	{
		$qtmpil_mobil="select * from mobil order by inc asc";	
	}
	elseif (isset($_POST['proses']) and ($_POST['tcari']==""))
	{
		$qtmpil_mobil="select * from mobil order by inc asc";	
	}
	else
	{
		$qtmpil_mobil="SELECT * FROM mobil WHERE mobil_nama LIKE '%$_POST[tcari]%'";	
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>

</head>
<body>
<div id="judulHalaman"><strong>Data mobil</strong></div>
<form id="form1" name="form1" method="post" action="index.php?halaman=data_mobil">
<input name="proses" type="hidden" value="form1" />
<table>
  <tr>
    <td>Pencarian mobil</td>
  </tr>
  <tr>
    <td><input name="tcari" id="input" type="text" size="25" /><input name="bcari" id="tombol" type="submit" value="cari" /></td>
  </tr>
</table>
</form>
<?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
	?>

      <table cellpadding="0" cellspacing="1">
        <tr>
          <td id="namaField">No</td>
          <td id="namaField">Kode mobil</td>
          <td id="namaField">Nama mobil</td>
		   <td id="namaField">Harga Rental</td>
          <td id="namaField">Kategori</td>
          <td colspan="2" id="namaField">
          <?php echo "<a href=index.php?halaman=form_data_master&kode=mobil_insert>"; ?>
            <div id="tombol">tambah data</div>
          <?php echo "</a>"; ?>
          </td>
        </tr>
        <?php 
		
		$qp_brg=mysql_query($qtmpil_mobil);
		$no=1;
		while($row1=mysql_fetch_array($qp_brg)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
        <tr bgcolor=<?php echo $warna; ?>>
          <td><?php echo "$no"; ?></td>
          <td><?php echo "$row1[mobil_id]"; ?></td>
          <td><?php echo "$row1[mobil_nama]"; ?></td>
          <td><?php echo "$row1[harga_rental]"; ?></td>
          <td><?php echo "$row1[mobil_kategori]"; ?></td>
          <td><?php echo "<a href=index.php?halaman=form_ubah_data&kode=mobil_update&id=$row1[inc]>"; ?>
          	 <div id="tombol">ubah</div>
			 <?php echo "</a>"; ?>
          </td>
          <td>
          <a href="<?php echo "proses.php?proses=mobil_delete&id=$row1[inc]&mobil_id=$row1[mobil_id]>"; ?>" onclick="return confirm('Apakah Anda akan menghapus data ini ?')">
          <div id="tombol">hapus</div>
		  </a>
          </td>
        </tr>
        <?php	$no++; } ?>
      </table>
</body>
</html>