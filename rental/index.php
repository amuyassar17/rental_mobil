<?php 
//this function created by Sigit Dwi Prasetyo
//More information visit www.sixghakreasi.com / 0818956973
?>
<?php error_reporting(0) ?>
<?php
session_start();
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";

$hal=$_GET['halaman'];
	if (empty($hal)){
			$hal="data_mobil";
	}
// cek apakah user yang mengakses halaman ini sudah melalui login atau belum
// logikanya jika user telah login dan sukses, maka SESSION level dan SESSION username ini pasti sudah ada
// jika ada user yang mencoba akses halaman ini tanpa login, maka logikanya kedua SESSION belum ada

if (isset($_SESSION['level']) && isset($_SESSION['username']))
{
// tampilkan mobil.
// mobil hanya ditampilkan bila halaman ini diakses oleh user yang telah login
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Sistem Rental Mobil</title>
<link rel="stylesheet" href="style/style_index.css" type="text/css"  />
<style type="text/css">
/*link a*/
a
{
	text-decoration:none;
	color:#09F;
}
a:hover
{
	color:#9C0;
}
/*akhir link a*/
/*judul halaman*/
#judulHalaman
{
	color:#333;
	font-size:18px;
	background-color:#CCC;
	border:1px solid #999;
	padding:7px 14px;
	margin:7px 9px;
	border-radius:5px;
}
/*akhir judul halaman*/
/*style form*/
#input
{
	padding:3px 5px;
	margin:0px 3px;
	border:1px solid #c0d3e2;
	border-radius:3px;
}
#tombol
{
	color:#FFF;
	padding:3px 5px;
	background-color:#09C;
	border:1px solid #069;
	border-radius:3px;
}
#tombol:hover
{
	background-color:#9C0;
	border:1px solid #990;
}
#tombolAdd
{
	color:#FFF;
	margin:7px 9px;
	width:90px;
	padding:5px 7px;
	background-color:#09C;
	border:1px solid #069;
	border-radius:3px;
}
#tombolAdd:hover
{
	background-color:#9C0;
	border:1px solid #990;
}
/*akhir style form*/
/*style tabel*/
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
/*akhir style tabel*/
</style>
</head>

<body>
<div id="page">  
  <div class="header"><img src="Style/LogoImg.png" /><img src="style/Judul.png" />
  <div id="box">
	<div id="tgl"><?php echo tanggal();?></div>
	<div id="akun"><?php echo $_SESSION['nama']; ?></div>
   </div>
  </div>
  <div id="menu-bg">
  <div id="menu">
<?php  
// cek level user apakah admin atau bukan
if ($_SESSION['level'] == "admin")
{ 
	echo 
	"<ul id=main>
      <li><a href=index.php?halaman=data_mobil>Mobil</a></li>
<li><a href=index.php?halaman=mobil_masuk>Input Ketersediaan Unit</a></li>
<li><a href=index.php?halaman=stok>Ketersediaan Unit</a></li>	  
      <li><a href=index.php?halaman=penrentalan>Transaksi Rental Mobil</a></li>
	  <li><a href=index.php?halaman=data_akun>Data Akun</a></li>
      <li><a href=logout.php>Keluar</a></li>
    </ul>";
}
else
{
	echo 
	"<ul id=main>
        <li><a href=index.php?halaman=data_mobil>Mobil</a></li>	  
      <li><a href=index.php?halaman=penrentalan>Transaksi Rental Mobil</a></li>
      <li><a href=logout.php>Keluar</a></li>
     
    </ul>";
}
?>
  </div>
  </div>
<div class="halaman">
  <div class="tengah">
	<div class="batas_isi">
    <div class="isi">
   	<?php
		require_once $hal.".php";
	?>
    </div>
    </div>
    </div>  
  </div>
 <div class="BatasBawah"></div>
</div>
</body>
</html>
<?php
}
else
{
	lompat_ke("form_login.php");
}
?>