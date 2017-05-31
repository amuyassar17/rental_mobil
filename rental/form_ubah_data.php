<?php 
//this function created by Sigit Dwi Prasetyo
//More information visit www.sixghakreasi.com / 0818956973
?>

<style type="text/css">
td{
	border:none;
}

#input{
	height:20px;
	border:1px solid #c0d3e2;
}
</style>
<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

	echo "
	<form id=formUbahData name=formUbahData method=post action=proses.php>
	<input type=hidden name=proses id=proses value=$_GET[kode] />";
	if($_GET['kode']=="mobil_update"){
		$pesan="SELECT * FROM mobil WHERE inc='$_GET[id]'";
		$query=mysql_query($pesan);
		$data=mysql_fetch_array($query);
	echo "	<h1>Ubah data mobil</h1>
        <table border=0 cellspacing=2 cellpadding=0>
          <tr>
            <td>Kode mobil<input type=hidden name=inc id=inc value=$data[inc] /></td>
            <td>:</td>
            <td><input name=mobil_Kode type=text id=input size=50 maxlength=70  value='".$data[mobil_id]."' /></td>
          </tr>
          <tr>
            <td>Nama mobil</td>
            <td>:</td>
            <td><label>
              <input name=nmmobil type=text id=input size=50 maxlength=90 value='".$data[mobil_nama]."' />
            </label></td>
          </tr>
		  
		  <tr>
            <td>Harga Jual</td>
            <td>:</td>
            <td><label>
              <input name=harga_rental type=text id=input size=50 maxlength=70 value='".$data[harga_rental]."' />
            </label></td>
          </tr>
		  <tr>
            <td>Kategori mobil</td>
            <td>:</td>
            <td><label>
              <input name=kategori type=text id=input size=50 maxlength=70 value='".$data[mobil_kategori]."' />
            </label></td>
          </tr>
          <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><label>
              <input type=submit name=simpan id=tombol value=Simpan />
            </label></td>
          </tr>
        </table>";	
	}	
	echo "</form>";
?>