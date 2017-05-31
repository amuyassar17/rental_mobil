<?php
error_reporting(0);
//this function created by Sigit Dwi Prasetyo
//More information visit www.sixghakreasi.com / 0818956973
?>

<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/style_index.css" type="text/css">
<style type="text/css">
#noBorder
{
	border:none;	
}
table
{
	margin:5px 9px;
}
td
{
	padding:5px 9px;
	border:1px solid #c0d3e2;
}
#namaField{
	color:#FFF;
	background-color:#333;
	text-align:center;
	padding-top:7px;
	border:none;
}
</style>

</head>

<body>
<div id="judulHalaman"><strong>Detail Transaksi mobil Masuk & Siap Rental serta Total perkiraan biaya rental</strong></div>
<?php
	$warna1="#c0d3e2";
	$warna2="#cfdde7";
	$warna=$warna1;

	$mobilmasuk="SELECT * FROM mobilmasuk WHERE mobilmasuk_id='$_GET[id]' order by inc asc";
	$qmobilmasuk=mysql_query($mobilmasuk);
	$data=mysql_fetch_array($qmobilmasuk);
		

?>
<table cellspacing="0" cellpadding="0">
  <tr>
    <td id="noBorder">No. Transaksi</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[mobilmasuk_id]"; ?></td>
  </tr>
 
  <tr>
    <td id="noBorder">Tgl Transaksi</td>
    <td id="noBorder">:</td>
    <td id="noBorder"><?php echo "$data[tgl_trans]"; ?></td>
  </tr>

 
</table>
    <table cellspacing="1" cellpadding="0">
      <tr>
        <td id="namaField">mobil ID</td>
        <td id="namaField">Nama Mobil</td>
        <td id="namaField">Kategori</td>
        <td id="namaField">Jumlah Unit</td>
        <td id="namaField">Satuan</td>
        <td id="namaField">Harga Rental</td>
        <td id="namaField">Harga total</td>
      </tr>
      <?php 
		$pesan="SELECT * FROM mobilmasuk_detail WHERE mobilmasuk_id='$_GET[id]'";
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
        <td><?php echo "$row[kategori]"; ?></td>
        <td><?php echo "$row[qty]"; ?></td>
        <td><?php echo "$row[satuan]"; ?></td>
        <td align="right"><?php echo digit($row['harga_rental']);?></td>
        <td align="right"><?php echo digit($row['harga_total']); ?></td>
      </tr>
      <?php } ?>
      <tr>
        <td style="color:#FFF; background-color:#333; border:none" colspan="3" align="right">total Qty :</td>
        <td style="color:#FFF; background-color:#333; border:none">
        	<?php
				$sumQty="SELECT SUM(qty) AS totalQty FROM mobilmasuk_detail WHERE mobilmasuk_id='$_GET[id]'";
				$qsumQty=mysql_query($sumQty);
				$dsumQty=mysql_fetch_array($qsumQty);
				echo $dsumQty['totalQty'];
			?>
        </td>
        <td style="color:#FFF; background-color:#333; border:none">&nbsp;</td>
        <td style="color:#FFF; background-color:#333; border:none" align="right">Total =</td>
        <td style="color:#FFF; background-color:#333; border:none" align="right"><?php echo "Rp "; echo digit($data['total']); ?></td>
      </tr>
      <tr>
      	<td style="color:#FFF; background-color:#333; border:none" colspan="6" align="right">Grand Total=</td>
        <td style="color:#FFF; background-color:#333; border:none" align="right"><?php $alltotal=$data['total'];
	echo "Rp ";
	echo digit($alltotal); ?></td>
      </tr>
    </table>
</body>
</html>
