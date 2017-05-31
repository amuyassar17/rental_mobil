<?php 
//this function created by Sigit Dwi Prasetyo
//More information visit www.sixghakreasi.com / 0818956973
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css">
	<script src="JQuery-UI-1.8.17.custom/development-bundle/jquery-1.7.1.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="JQuery-UI-1.8.17.custom/development-bundle/ui/i18n/jquery.ui.datepicker-id.js"></script>
	<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/demos/demos.css">
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	$(function() {
		$( "#datepicker1" ).datepicker();
	});
	</script>
<style type="text/css">
td
{
	padding:5px 9px;
	border:1px solid #c0d3e2;
}
body {
	color:#315567;
	background-color:#e9e9e9;
	font-size:12px;
	font-family:Verdana, Geneva, sans-serif;
}
#datepicker{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
#datepicker1{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
</style>
</head>

<body>
<div id="judulHalaman"><strong>Data Rental Mobil</strong></div>
<?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;
?>
<?php echo "<a href=form_rental.php>"; ?>
<div id="tombolAdd">tambah data</div>
<?php echo "</a>"; ?>
    <form id="form1" name="form1" method="post" action="index.php?halaman=rental_cari">
    <input name="proses" type="hidden" value="form1" />
      <table border="0">
        <tr>
          <td>tanggal awal</td>
          
          <td>tanggal akhir</td>
          <td>&nbsp;</td>
        </tr>
        <tr>
          <td><input name="tgl_awal" type="text" id="datepicker" /></td>
          <td><input name="tgl_akhir" type="text" id="datepicker1" /></td>
          <td><input name="tampil" id="tombol" type="submit" value="tampilkan" /></td>
        </tr>
      </table>
    </form> 
<table cellpadding="0" cellspacing="1">
  <tr>
    <td id="namaField">No.Trans</td>
    <td id="namaField">No.Nota</td>
    <td id="namaField">Tgl. Trans</td>
    <td id="namaField">Nama Pelanggan</td>
    <td id="namaField">Total Harga</td>
	<td id="namaField">Tanggal Kembali</td>
	<td id="namaField">Denda</td>
	<td id="namaField">Action</td>
    
  </tr>
  <?php 
  		$pesan="SELECT * FROM rental ORDER BY inc DESC LIMIT 25";
		$query=mysql_query($pesan);
		while($row=mysql_fetch_array($query)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		$piutang=$row['total']-$row['jml_bayar'];
		?>
  <tr bgcolor=<?php echo $warna; ?>>
    <td><a href="#" onclick="javascript:wincal=window.open('rental_detail.php?id=<?php echo $row['rental_id']; ?>','Lihat Data','width=790,height=400,scrollbars=1');">
    <?php echo $row['rental_id']; ?></a></td>
    <td><?php echo "$row[no_nota]"; ?></td>
    <td><?php echo "$row[tgl_rental]"; ?></td>
    <td><?php echo "$row[pelanggan_nama]"; ?></td>
    <td align="right"><?php echo "Rp "; echo digit($row['total']); ?></td>
	<td><?php echo "$row[tgl_kembali]"; ?></td>
	<td><?php echo "$row[denda]"; ?></td>
	<td><?php if ($row['tgl_kembali']=='')
						{ ?><a href="<?php echo "index.php?halaman=form_ubah_rental&id=$row[rental_id]";?>"><div id="tombol">Kembali</div></a><?php } else
						{
						?><a href=""><div id="">Closed</div></a><?php	
						} ?></td>
    
  </tr>
  <?php } ?>
</table>
</body>
</html>