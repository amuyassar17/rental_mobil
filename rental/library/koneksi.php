<?php

function koneksiDB($host="localhost:3306", $user="root", $pass="")
{
   $koneksi =    $mysql_connect($host,$user,$pass) or
            die ("Terjadi Kesalahan: " . mysql_error());
   if ($koneksi){
      return $koneksi;   
   }
}
$conn=koneksiDB();
mysql_select_db("mobil",$conn);

?> 