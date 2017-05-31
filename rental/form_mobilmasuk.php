<?php
error_reporting(0);
//this function created by Sigit Dwi Prasetyo
//More information visit www.sixghakreasi.com / 0818956973
?>
<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$a="SELECT * FROM mobilmasuk";
$b="SELECT inc FROM mobilmasuk ORDER BY inc DESC LIMIT 1";
$inc=penambahan($a, $b);
if (isset($_POST['proses'])and($_POST['proses']=="form2"))
{
	if (!empty($_POST['qty'])and(!empty($_POST['harga'])))
	{
		$buah="SELECT * FROM mobil WHERE mobil_nama='$_POST[pilih_mobil]'";
		$qbuah=mysql_query($buah);
		$dbuah=mysql_fetch_array($qbuah);
		//insert ke temp_mobilmasuk_detail
		$harga_total=$_POST['qty']*$_POST['harga'];
		$input="INSERT INTO temp_mobilmasuk_detail(mobilmasuk_id, mobil_id, mobil_nama, kategori, qty, satuan, harga_rental, harga_total)
		VALUES('TRX-$inc', '$dbuah[mobil_id]', '$_POST[pilih_mobil]', '$dbuah[mobil_kategori]', '$_POST[qty]', 'unit', 
		'$_POST[harga]', '$harga_total')";
		mysql_query($input);
	}
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Pemmobilmasukan</title>
<link rel="stylesheet" href="style/style_form_transaksi.css" type="text/css"  />
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/demos/demos.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/template.css" type="text/css"/>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine-id.js" type="text/javascript" charset="utf-8"></script>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
    </script>    
    <script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="JQuery-UI-1.8.17.custom/development-bundle/ui/jquery.ui.datepicker.js"></script>
    <script src="JQuery-UI-1.8.17.custom/development-bundle/ui/i18n/jquery.ui.datepicker-id.js"></script>
        <script>
            jQuery(document).ready( function() {
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();
            });
			///
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
#noborder
{
	border:none;
}
</style>
</head>

<body>
<div id="page"> 
<a href="index.php?halaman=mobil_masuk"><div id="keluar">close</div></a>
<div class="header"><h1>Transaksi mobil Masuk</h1></div>
<div class="halaman">
  <div class="tengah">
	<div class="batas_isi">
    <div class="isi">

<table border="0" cellspacing="1" cellpadding="0">
  <tr>
mobilmasuk_insert    <td>
    	<form id="form1" name="form1" method="post" action="proses.php">
        <input name="proses" type="hidden" value="mobilmasuk_insert" />
        <input name="inc" type="hidden" value="<?php echo "$inc"; ?>" />
			<table border="0" cellspacing="1" cellpadding="0">
  				<tr>
    				<td id="noborder">No. Transaksi</td>
    				<td id="noborder">:</td>
    				<td id="noborder"><?php echo "TRX-$inc" ?><input name="mobilmasuk_id" type="hidden" value="<?php echo "TRX-$inc"; ?>" /></td>
  				</tr>
  				<tr>
    				<td id="noborder">No. Faktur</td>
    				<td id="noborder">:</td>
    				<td id="noborder"><input name="no_fak" type="text" id="input" value="<?php echo "FAK-$inc" ?>" /></td>
  				</tr>
  				<tr>
    				<td id="noborder">Tgl. Transaksi</td>
    				<td id="noborder">:</td>
    				<td id="noborder"><input name="tgl_trans" type="text" id="datepicker" value="<?php echo date(d)."/".date(m)."/".date(Y);?>" /></td>
  				</tr>
  				
  				
  				
			</table>
            
            <!--tabel item mobil -->
        <h3>mobil yg Masuk :</h3>
        <table border="0" cellspacing="1" cellpadding="0">
              
              <tr>
                <td id="namaField">ID</td>
                <td id="namaField">Nama mobil</td>
                <td id="namaField">Kategori</td>
                <td id="namaField">Jumlah Unit</td>
                <td id="namaField">Satuan</td>
                <td id="namaField">Harga Rental</td>
                <td id="namaField">Harga Total</td>
                <td id="namaField"></td>
                
              </tr>
              <?php
			  	$rinci="SELECT * FROM temp_mobilmasuk_detail WHERE mobilmasuk_id='TRX-$inc'";
				$qrinci=mysql_query($rinci);
				while($drinci=mysql_fetch_array($qrinci))
				{
			  ?>
              <tr>
                <td><?php echo $drinci['mobil_id']; ?></td>
                <td><?php echo $drinci['mobil_nama']; ?></td>
                <td><?php echo $drinci['kategori']; ?></td>
                <td><?php echo $drinci['qty']; ?></td>
                <td><?php echo $drinci['satuan']; ?></td>
                <td align="right"><?php echo digit($drinci['harga_rental']); ?></td>
                <td align="right"><?php echo digit($drinci['harga_total']); ?></td>
               <td><?php echo "<a href=proses.php?proses=hapus_item_masuk&id=$drinci[mobil_id]>hapus</a>"; ?></td>
              </tr>
              <?php } ?>
              <tr>
                <td style="color:#FFF; background-color:#333; border:none" colspan="6" align="right">total :</td>
                <td style="color:#FFF; background-color:#333; border:none" align="right">
					<?php
						$sum="SELECT SUM(harga_total)AS total FROM temp_mobilmasuk_detail WHERE mobilmasuk_id='BM-$inc'";
						$qsum=mysql_query($sum);
						$dsum=mysql_fetch_array($qsum);
						echo digit($dsum['total']);
					?>
                </td>
                <td style="color:#FFF; background-color:#333; border:none">&nbsp;</td>
              </tr>
            </table>

            <table border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td><input type="submit" name="simpan" id="tombol" value="simpan" /></td>
				<td><input type="reset" name="batal" id="tombol" value="batal" /></td>
              </tr>
            </table>

		</form>
	</td>
    <td valign="top">
    	<form id="formID"  name="form2" method="post" action="form_mobilmasuk.php">
        <input name="proses" type="hidden" value="form2" />
        <table border="0" cellspacing="1" cellpadding="0">
  			<tr>
    			<td>Nama mobil</td>
    			<td>Jumlah Unit</td>
    			<td>Harga Rental Mobil</td>
    			<td>Menu</td>
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
                <input type="text" name="qty" id="input" class="validate[required]" size="3" />
  			  	</td>
    			<td><label>
    			  <input name="harga" type="text" id="mobil_harga" class="validate[required]" size="9" />
				  <script type='text/javascript'>    
    <?php echo $jsArray; ?>  
    </script> 
  			  </label></td>
   				<td><label>
   				  <input type="submit" name="add" id="tombol" value="add" />
			    </label></td>
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