<?php 
//this function created by Sigit Dwi Prasetyo
//More information visit www.sixghakreasi.com / 0818956973
?>

<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/demos/demos.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/development-bundle/themes/ui-lightness/jquery.ui.all.css">
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/validationEngine.jquery.css" type="text/css"/>
<link rel="stylesheet" href="JQuery-UI-1.8.17.custom/validationEngine/css/template.css" type="text/css"/>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine-id.js" type="text/javascript" charset="utf-8"></script>
	<script src="JQuery-UI-1.8.17.custom/validationEngine/js/jquery.validationEngine.js" type="text/javascript" charset="utf-8">
    </script> 
    <script>
            jQuery(document).ready( function() {
                // binds form submission and fields to the validation engine
                jQuery("#formID").validationEngine();
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
	border:none;
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
</style>
<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

	echo "
	<form id=formID name=formInput method=post action=proses.php>
	  <input type=hidden name=proses id=proses value=$_GET[kode] />";
//form data mobil
	if ($_GET['kode']=="mobil_insert"){
		//pemanggilan fungsi penambahan
		$a="SELECT * FROM mobil";
		$b="SELECT inc FROM mobil ORDER BY inc DESC LIMIT 1";
		$inc=penambahan($a, $b);
	echo "	<div id=judulHalaman><strong>Form input data mobil</strong></div>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Kode mobil</td><input type=hidden name=inc id=inc value=$inc />
            <td>:</td>
            <td><input name=mobil_Kode type=text id=input class=validate[required] size=50 maxlength=70 value='MB-$inc' readonly='true'/></td>
          </tr>
          <tr>
            <td>Nama mobil</td>
            <td>:</td>
            <td><label>
              <input name=nmmobil type=text id=input class=validate[required] size=50 maxlength=70 />
            </label></td>
          </tr>
	
		  
		  <tr>
            <td>Harga Rental</td>
            <td>:</td>
            <td><label>
              <input name=harga_rental type=text id=input class=validate[required] size=50 maxlength=70 />
            </label></td>
          </tr>
		  
		  <tr>
            <td>Kategori mobil</td>
            <td>:</td>
            <td><label>
              <input name=kategori type=text id=input class=validate[required] size=50 maxlength=70 />
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type=submit name=SimpanBar id=tombol value=Simpan />
            </label>
              <label>
                <input type=reset name=BatalBar id=tombol value=Batal />
              </label></td>
          </tr>
        </table>";
	}
     echo " </form>";

?>