<?php
error_reporting(0);
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
$a="SELECT * FROM rental";
$b="SELECT inc FROM rental ORDER BY inc DESC LIMIT 1";
$inc=penambahan($a, $b);
if (isset($_POST['run'])and($_POST['run']=="form2"))
{
	$cekQty="SELECT * FROM stok WHERE mobil_nama='$_POST[pilih_mobil]'";
	$qcekQty=mysql_query($cekQty);
	$dcekQty=mysql_fetch_array($qcekQty);
	if (!empty($_POST['qty'])and(!empty($_POST['harga'])))
	{
		//ambil dari stok
		$buah="SELECT * FROM stok WHERE mobil_nama='$_POST[pilih_mobil]'";
		$qbuah=mysql_query($buah);
		$dbuah=mysql_fetch_array($qbuah);
		$sisa_qty=$dbuah['qty']-$_POST['qty'];
		if ($sisa_qty >= 0)
		{
			//insert ke temp_mobilmasuk_detail
			$harga_total=$_POST['qty']*$_POST['lama']*$_POST['harga'];
			$input="INSERT INTO temp_rental_detail(rental_id, mobil_id, mobil_nama, kategori, qty, lama, satuan, harga_rental, harga_total)
			VALUES('RTL-$inc', '$dbuah[mobil_id]', '$_POST[pilih_mobil]', '$dbuah[kategori]', '$_POST[qty]', '$_POST[lama]', 'unit', 
			'$_POST[harga]', '$harga_total')";
			mysql_query($input);
			//update tabel stok
			$upstok="UPDATE stok SET qty='$sisa_qty' WHERE mobil_id='$dbuah[mobil_id]'";
			mysql_query($upstok);
		}
		else
		{
			echo "
			<script type=text/javascript>";
			echo "alert('Qty yang diambil melebihi stok')";
			echo "</script>";
		}
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link rel="stylesheet" href="style/style_form_transaksi.css" type="text/css"  />
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/demos/demos.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/template.css" type="text/css"/>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine-id.js" type="text/javascript" charset="utf-8"></script>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
	jQuery(document).ready( function() {
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();

            });
    </script>  

	<script src="JQuery-UI-1.8.17.custom/development-bundle/jquery-1.7.1.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="JQuery-UI-1.8.17.custom/development-bundle/ui/i18n/jquery.ui.datepicker-id.js"></script>
	<script>
	$(function() {
		$( "#datepicker" ).datepicker();
	});
	$(function() {
		$( "#datepicker1" ).datepicker();
	});
	</script>
<style type="text/css">
#formID
{
	border:none;
	margin:0px;
	padding:0px;
}
#formID1
{
	border:none;
	margin:0px;
	padding:0px;
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
body {
	color:#315567;
	background-color:#e9e9e9;
	font-size:11px;
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
#noborder
{
	border:none;
}
</style>
</head>

<body>
<div id="page"> 
<a href="index.php?halaman=penrentalan"><div id="keluar">close</div></a>
<div class="header"><h1>Transaksi Rental Mobil</h1></div>
<div class="halaman">
  <div class="tengah">
	<div class="batas_isi">
    <div class="isi">
<table border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td>
      <form id="form1" name="form1" method="post" action="proses.php">
            <input type="hidden" name="proses" id="proses" value="rental_insert" />
          <table border="0" cellspacing="1" cellpadding="0">
            <tr><input name="inc" type="hidden" value="<?php echo "$inc"; ?>" />
              <td id="noborder">No. Transaksi</td>
              <td id="noborder">:</td>
              <td id="noborder"><input name="rental_id" type="hidden" value="<?php echo "RTL-$inc"; ?>" /><?php echo "RTL-$inc"; ?></td>
            </tr>
            <tr>
              <td id="noborder">No. Nota</td>
              <td id="noborder">:</td>
              <td id="noborder">
                <input type="text" name="no_nota" id="input" value="<?php echo "nota-$inc"; ?>" readonly="true"/>
              </td>
            </tr>
            <tr>
              <td id="noborder">Tgl. Transaksi</td>
              <td id="noborder">:</td>
              <td id="noborder">
                <input type="text" name="tgl_rental" id="datepicker" value="<?php echo date(d)."/".date(m)."/".date(Y);?>" readonly="true"/>
              </td><input type="hidden" name="username" id="username" value="<?php echo $_SESSION['username']; ?>" />
            </tr>
            <tr>
              <td id="noborder">Pembeli</td>
              <td id="noborder">:</td>
              <td id="noborder"><select name="pelanggan_nama" id="input">
                <option>umum</option>
                <?php
                $pel="SELECT * FROM pelanggan ORDER BY inc ASC";
                $qpel=mysql_query($pel);
                while ($dtpel=mysql_fetch_array($qpel)){
              echo "
                <option>$dtpel[pelanggan_nama]</option>";
                }
                ?>
              </select></td>
            </tr>
          </table>
        
        <!--tabel item mobil -->
        <h3>mobil yg akan dirental :</h3>
        <table border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td id="namaField">ID</td>
            <td id="namaField">Nama mobil</td>
            <td id="namaField">Satuan</td>
			<td id="namaField">Juml Unit</td>
            <td id="namaField">Lama Rental</td>
            <td id="namaField">Harga Satuan</td>
            <td id="namaField">Harga Total</td>
            <td id="namaField">mobil</td>
          </tr>
          <?php
          $tmp="SELECT * FROM temp_rental_detail WHERE rental_id='RTL-$inc'";
          $qtmp=mysql_query($tmp);
          while ($dtmp=mysql_fetch_array($qtmp))
          {
          echo "
          <tr>
            <td>$dtmp[mobil_id]</td>
            <td>$dtmp[mobil_nama]</td>
            <td>$dtmp[satuan]</td>
            <td>$dtmp[qty]</td>
			<td>$dtmp[lama]</td>
            <td align=right>".digit($dtmp['harga_rental'])."</td>
            <td align=right>".digit($dtmp['harga_total'])."</td>
            <td><a href=proses.php?proses=hapus_item_rental&id=$dtmp[mobil_id]><div id=tombol>hapus</div></a></td>
          </tr>";
          }
          ?>
          <tr>
            <td id="namaField" colspan="5">&nbsp;</td>
            <td style="color:#FFF; border:none; background-color:#333" align="right">total:</td>
            <td style="color:#FFF; border:none; background-color:#333" align="right">
                <?php
                    $jml="SELECT SUM(harga_total) AS htotal FROM temp_rental_detail WHERE rental_id='RTL-$inc'";
                    $qjml=mysql_query($jml);
                    $djml=mysql_fetch_array($qjml);
                    echo digit($djml['htotal']);
                ?>
            </td>
            <td id="namaField"><input name="total" type="hidden" value="<?php echo $djml['htotal'] ?>" /></td>
          </tr>
        </table>
        <!--tabel pembayaran-->
        <table border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td id="noborder">Total Bayar</td>
            <td id="noborder">:</td>
            <td id="noborder"><label>
              <input type="text" name="jml_bayar" id="input" class="validate[required]" />
            </label></td>
          </tr>
          
          <tr>
            <td id="noborder">&nbsp;</td>
            <td id="noborder">&nbsp;</td>
            <td id="noborder">
              <input type="submit" name="simpan" id="tombol" value="simpan" />
              <input type="reset" name="batal" id="tombol" value="batal" />
            </td>
          </tr>
        </table>
      </form>
    </td>
    <td valign="top">
      	<form id="formID" name="form2" method="post" action="">
        <input name="run" type="hidden" value="form2" />
        <table border="0" cellspacing="1" cellpadding="0">
          <tr>
            <td id="namaField">Pilih mobil</td>
			<td id="namaField">Jumlah Unit</td>
            <td id="namaField">Lama Rental</td>
            <td id="namaField">Harga</td>
            <td id="namaField">add</td>
          </tr>
          <tr>
            <td>
              <?php     
$result = mysql_query("select * from mobil");  
$jsArray = "var prdName = new Array();\n";  
echo 'Kode Produk : <select name="pilih_mobil" onchange="document.getElementById(\'mobil_harga\').value = prdName[this.value]">';  
echo '<option>-------</option>';  
while ($row = mysql_fetch_array($result)) {  
    echo '<option value="' . $row['mobil_nama'] . '">' . $row['mobil_nama'] . '</option>'; 	
    $jsArray .= "prdName['" . $row['mobil_nama'] . "'] = '" . addslashes($row['harga_rental']) . "';\n";  
}  
echo '</select>';  
?> 
            </td>
            <td>
              <input name="qty" type="text" id="input" class="validate[required]" size="5" />
            </td>
			 <td>
              <input name="lama" type="text" id="input" class="validate[required]" size="5" />
            </td>
            <td>
              <input name="harga" type="text" id="mobil_harga" class="validate[required]" size="9" />
				  <script type='text/javascript'>    
    <?php echo $jsArray; ?>  
    </script> 
            </td>
            <td>
              <input type="submit" name="add" id="tombol" value="add" />
            </td>
          </tr>
        </table>
    	</form>
    </td>
  </tr>
</table>
		</div>
    </div>
    </div>  
  </div>
</div>
</body>
</html>