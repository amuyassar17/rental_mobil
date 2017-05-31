<?php
if ($_SESSION['level'] == "admin")
	{
$rental_id=$_GET['id'];
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/base/jquery.ui.all.css">
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
	$(function() {
		$( "#datepicker2" ).datepicker();
	});
	</script>
<style type="text/css">
body
{
	font-family:Verdana, Geneva, sans-serif;
	font-size:12px;
}
td
{
	padding:5px 9px;
	border:none;
}
#datepicker{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
#input{
	height:20px;
	border:1px solid #c0d3e2;
}
</style>
</head>

<body>
<div id="judulHalaman"><strong>Form Pengembalian</strong></div>
<form id="form1" name="form1" method="post" action="proses.php">
<?php echo"<input type=hidden name=rental_id id=proses value=$_GET[id] />"; ?>
<input name="proses" type="hidden" value="denda_update" />
  
  <table cellspacing="1" cellpadding="0">
      <tr>
        <td id="namaField">mobil ID</td>
        <td id="namaField">Nama Mobil</td>
        <td id="namaField">Juml Unit</td>
		<td id="namaField">Lama</td>
        <td id="namaField">Satuan</td>
        <td id="namaField">Harga Rental</td>
        <td id="namaField">Harga total</td>
      </tr>
      <?php 
		$pesan="SELECT * FROM rental_detail WHERE rental_id='$_GET[id]'";
		$query=mysql_query($pesan);
		
		while($row=mysql_fetch_array($query)){
			if ($warna==$warna1){
				$warna=$warna2;
			}
			else{
				$warna=$warna1;
			}
		?>
      <tr bgcolor=<?php echo $warna; ?>>
        <td><?php echo "$row[mobil_id]"; ?></td>
        <td><?php echo "$row[mobil_nama]"; ?></td>
        <td><?php echo "$row[qty]"; ?></td>
		<td><?php echo "$row[lama]"; ?></td>
        <td><?php echo "$row[satuan]"; ?></td>
        <td align="right"><?php echo digit($row['harga_rental']);?></td>
        <td align="right"><?php echo digit($row['harga_total']); ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td colspan="2" style="color:#FFF; background-color:#333; border:none;" align="right">Total Qty :</td>
        
        <td style="color:#FFF; background-color:#333; border:none;">
        	<?php
				$sumQty="SELECT SUM(qty) AS totalQty FROM rental_detail WHERE rental_id='$_GET[id]'";
				$qsumQty=mysql_query($sumQty);
				$dsumQty=mysql_fetch_array($qsumQty);
				echo $dsumQty['totalQty'];
			?>
        </td>
		<td style="color:#FFF; background-color:#333; border:none;">
        	<?php
				$sumLama="SELECT SUM(lama) AS totalLama FROM rental_detail WHERE rental_id='$_GET[id]'";
				$qsumLama=mysql_query($sumLama);
				$dsumLama=mysql_fetch_array($qsumLama);
				echo $dsumLama['totalLama'];
			?>
        </td>
        <td style="color:#FFF; background-color:#333; border:none;">&nbsp;</td>
        <td style="color:#FFF; background-color:#333; border:none;" align="right">Total =</td>
        <td style="color:#FFF; background-color:#333; border:none;" align="right">
        	<?php
				$rental="SELECT * FROM rental WHERE rental_id='$_GET[id]'";
				$qrental=mysql_query($rental);
				$drental=mysql_fetch_array($qrental);
				echo "Rp ".digit($drental['total']);
			?>
        </td>
      </tr>
     
    </table>
	
  <table border="0" cellspacing="1" cellpadding="0">
    <tr>
      <td colspan="3">&nbsp;</td>
    </tr>
        <tr>
      <td>Pelanggan Nama</td>
      <td>:</td>
      <td>
	  	<?php 
			$sql="SELECT * FROM rental WHERE rental_id='$_GET[id]'";
			$query=mysql_query($sql);
	  		$data=mysql_fetch_array($query);
			echo $data['pelanggan_nama'];
		?>
      </td>
    </tr>
	
	  	<?php 
			$sqls="SELECT * FROM rental_detail WHERE rental_id='$_GET[id]'";
			$querys=mysql_query($sqls);
	  		$datas=mysql_fetch_array($querys);
			echo"<input type='hidden' name='qty' value='$datas[qty]' id='input' disable='true'/>";
			echo"<input type='hidden' name='mobil_id' value='$datas[mobil_id]' id='input' disable='true'/>";
		?>

    <tr>
      <td>Tanggal Pinjam</td>
      <td>:</td>
      <td>
	  	<?php 
			echo $data['tgl_rental'];
		?>
      </td>
    </tr>
    <tr>
      <td>Total dibayar</td>
      <td>:</td>
      <td>
      
	  	<?php 
		
			echo "Rp ".digit($data['jml_bayar']);
		?>
      </td>
    </tr>
    <tr>
      <td>Tanggal Kembali</td>
      <td>:</td>
      <td><label>
        <input type="text" name="tgl_kembali" id="datepicker" />
      </label></td>
    </tr>
    <tr>
      <td>Denda Bayar</td>
      <td>:</td>
      <td><label>
        <input type="text" name="denda" id="input" />
      </label></td>
    </tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><label>
        <input type="submit" name="simpan" id="tombol" value="simpan" />
      </label>
        <label>
          <input type="reset" name="batal" id="tombol" value="batal" />
      </label></td>
    </tr>
  </table>
  
  
  
</form>
</body>
</html>
<?php
	}
	else
	{
		echo "anda tidak berhak meng-akses halaman ini !";
	}
?>