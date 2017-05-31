<?php 
//this function created by Sigit Dwi Prasetyo
//More information visit www.sixghakreasi.com / 0818956973
?>

<?php
require_once "library/koneksi.php";
require_once "library/fungsi_standar.php";
$proses=$_POST['proses'];
$hapus=$_GET['proses'];
$url="";
//fungsi insert
	function insert($nama_tabel,$values)
	{
		$sql="INSERT INTO ".$nama_tabel." VALUES(".$values.")";
		mysql_query($sql);	
	}
//fungsi update
	function update($nama_tabel,$values,$kondisi)
	{
		$sql="UPDATE ".$nama_tabel." SET ".$values." WHERE ".$kondisi;
		mysql_query($sql);
	}
//fungsi delete
	function delete($nama_tabel,$kondisi)
	{
		$sql="DELETE FROM ".$nama_tabel." WHERE ".$kondisi;
		mysql_query($sql);
	}
//pilih fungsi
	switch($proses){
		//pemilihan fungsi insert
		case "akun_insert":
		{
			$nama_tabel="account";
			$username=md5($_POST["username"]);
			$password=md5($_POST["password"]);
			$values="'$username', '$password', '$_POST[nama]', '$_POST[level]'";
			$hal="data_akun";
			insert($nama_tabel,$values);
			break;
		}
		case "mobil_insert":
			{
				$brgKode=$_POST['mobil_Kode'];
				$mobilKode=str_ireplace(" ",_,$brgKode);
				$nama_tabel="mobil";
				$values="'$_POST[inc]', '$mobilKode', '$_POST[nmmobil]', '$_POST[kategori]', '$_POST[harga_rental]'";
				$hal="data_mobil";
				insert($nama_tabel,$values);
				break;
			}
		//insert mobilmasuk
		case "mobilmasuk_insert":
		{
			//menjumlahkan semua harga_total dari temp_mobilmasuk_detail
			$sum="SELECT SUM(harga_total) AS total FROM temp_mobilmasuk_detail WHERE mobilmasuk_id='$_POST[mobilmasuk_id]'";
			$qsum=mysql_query($sum);
			$dsum=mysql_fetch_array($qsum);
			//insert ke tabel mobilmasuk
			$mobilmasuk="INSERT INTO mobilmasuk(inc, mobilmasuk_id, no_fak, tgl_trans, total)
			VALUES('$_POST[inc]', '$_POST[mobilmasuk_id]', '$_POST[no_fak]', '$_POST[tgl_trans]','$dsum[total]')";
			mysql_query($mobilmasuk);
			
			
			//ambil data dari temp_mobilmasuk_detail
			$tmp="SELECT * FROM temp_mobilmasuk_detail WHERE mobilmasuk_id='$_POST[mobilmasuk_id]'";
			$qtmp=mysql_query($tmp);
			while($dtmp=mysql_fetch_array($qtmp))
			{
				//insert ke tabel mobilmasuk_detail
				$mobilmasuk_detail="INSERT INTO mobilmasuk_detail(mobilmasuk_id, mobil_id, mobil_nama, kategori, qty, satuan, harga_rental, harga_total)
				VALUES('$dtmp[mobilmasuk_id]', '$dtmp[mobil_id]', '$dtmp[mobil_nama]', '$dtmp[kategori]', '$dtmp[qty]','$dtmp[satuan]', '$dtmp[harga_rental]', '$dtmp[harga_total]')";
				mysql_query($mobilmasuk_detail);
				//proses cek stok
				$cek="SELECT * FROM stok WHERE mobil_id='$dtmp[mobil_id]'";
				$qcek=mysql_query($cek);
				$dcek=mysql_fetch_array($qcek);
				$nbaris=mysql_num_rows($qcek);
				if ($nbaris==0)
				{
					//insert data
					$stok="INSERT INTO stok(mobil_id, mobil_nama, kategori, qty, satuan)
					VALUES('$dtmp[mobil_id]', '$dtmp[mobil_nama]', '$dtmp[kategori]', '$dtmp[qty]', '$dtmp[satuan]')";
					mysql_query($stok);
				}
				else
				{
					if ($dcek['mobil_id']==$dtmp['mobil_id'])
					{
						//update qty stok mobil
						$qty=$dcek['qty']+$dtmp['qty'];
						$upstok="UPDATE stok SET qty='$qty' WHERE mobil_id='$dtmp[mobil_id]'";
						mysql_query($upstok);
					}
					else
					{
						//insert data
						$stok="INSERT INTO stok(mobil_id, mobil_nama, kategori, qty, satuan)
						VALUES('$dtmp[mobil_id]', '$dtmp[mobil_nama]', '$dtmp[kategori]', '$dtmp[qty]', '$dtmp[satuan]')";
						mysql_query($stok);	
					}
				}
			}	
			//hapus data temp_mobilmasuk_detil
			mysql_query("DELETE FROM temp_mobilmasuk_detail WHERE mobilmasuk_id='$_POST[mobilmasuk_id]'");
			$hal="mobilmasuk_detail&id=$_POST[mobilmasuk_id]";
			break;
		}
				
		
		case "rental_insert":
		{
			//insert ke tabel rental
			$rental="INSERT INTO rental(inc, rental_id, no_nota, tgl_rental, username, pelanggan_nama, total, jml_bayar)
			VALUES('$_POST[inc]', '$_POST[rental_id]', '$_POST[no_nota]', '$_POST[tgl_rental]', '$_POST[username]',
			'$_POST[pelanggan_nama]', '$_POST[total]', '$_POST[jml_bayar]')";
			mysql_query($rental);
			//select temp_rental_detail
			$tmp="SELECT * FROM temp_rental_detail";
			$qtmp=mysql_query($tmp);
			while($dtmp=mysql_fetch_array($qtmp))
			{
				$detail="INSERT INTO rental_detail(rental_id, mobil_id, mobil_nama, kategori, qty, lama, satuan, harga_rental, harga_total)
				VALUES('$_POST[rental_id]', '$dtmp[mobil_id]', '$dtmp[mobil_nama]', '$dtmp[kategori]', '$dtmp[qty]', '$dtmp[lama]', 
				'$dtmp[satuan]', '$dtmp[harga_rental]', '$dtmp[harga_total]')";
				mysql_query($detail);
			}
			
			//hapus data temp_rental_detail
			$hapus="DELETE FROM temp_rental_detail WHERE rental_id='$_POST[rental_id]'";
			mysql_query($hapus);
			//halaman
			$hal="rental_detail&id=$_POST[rental_id]";
			break;
		}
		
		
		//pemilihan fungsi update
		case "mobil_update":
			{
				$nama_tabel="mobil";
				$values="mobil_id='$_POST[mobil_Kode]', mobil_nama='$_POST[nmmobil]', harga_rental='$_POST[harga_rental]', mobil_kategori='$_POST[kategori]'";
				$kondisi="inc='$_POST[inc]'";
				$hal="data_mobil";
				update($nama_tabel,$values,$kondisi);
				break;
			}

		//pemilihan fungsi update
		case "denda_update":
			{
			mysql_query("UPDATE rental SET tgl_kembali='$_POST[tgl_kembali]', denda='$_POST[denda]' WHERE rental_id='$_POST[rental_id]'");
				
				$a="SELECT * FROM stok WHERE mobil_id='$_POST[mobil_id]'";
				$qa=mysql_query($a);
				$da=mysql_fetch_array($qa);
				$sisa_qty=$da['qty']+$_POST['qty'];
				
			$upstok="UPDATE stok SET qty='$sisa_qty' WHERE mobil_id='$_POST[mobil_id]'";
			mysql_query($upstok);
			
			$hal="penrentalan";
				break;
			}
		
	
		case "ubah_akun":
		{
			$sql="UPDATE account SET password='$_POST[password]', nama='$_POST[nama]', level='$_POST[level]' WHERE username='$_POST[username]'";
			mysql_query($sql);
			$hal="data_akun";
			break;
		}
	}//end switch
	
switch($hapus){
	//pemilihan fungsi delete
	case "mobil_delete":
			{
				$nama_tabel="mobil";
				$kondisi="inc='$_GET[id]'";
				delete($nama_tabel,$kondisi);
				
				//hapus mobil dari stok
				$hapus="DELETE FROM stok WHERE mobil_id='$_GET[mobil_id]'";
				
				$hal="data_mobil";
		
				break;
			}
	
	case "hapus_item_rental":
	{
		//select stok
		$stok="SELECT * FROM stok WHERE mobil_id='$_GET[id]'";
		$qstok=mysql_query($stok);
		$dstok=mysql_fetch_array($qstok);
		//select temp_rental_detail
		$rental="SELECT * FROM temp_rental_detail WHERE mobil_id='$_GET[id]'";
		$qrental=mysql_query($rental);
		$drental=mysql_fetch_array($qrental);
		//hasil stok sekarang
		$qty=$dstok['qty']+$drental['qty'];
		//update stok
		$upstok="UPDATE stok SET qty='$qty' WHERE mobil_id='$_GET[id]'";
		mysql_query($upstok);
		//hapus mobil dari temp_rental_detail
		$hapus="DELETE FROM temp_rental_detail WHERE mobil_id='$_GET[id]'";
		mysql_query($hapus);
		$url="transaksi";
		$hal="form_rental.php";
		break;
	}
	
	case "hapus_item_masuk":
	{
		//hapus mobil dari temp__mobilmasuk_detail
		$hapus="DELETE FROM temp_mobilmasuk_detail WHERE mobil_id='$_GET[id]'";
		mysql_query($hapus);
		$url="transaksi";
		$hal="form_mobilmasuk.php";
		break;
	}

	case "hapus_akun":
	{
		$sql="DELETE FROM account WHERE username='$_GET[id]'";
		mysql_query($sql);
		$hal="data_akun";
		break;
	}
}
	if ($url=="transaksi")
	{
		lompat_ke($hal);
	}
	else
	{
		lompat_ke("index.php?halaman=".$hal);
	}
?>