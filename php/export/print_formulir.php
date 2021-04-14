<?
require_once '../../config/db.php';
$db = new db();
$id = $_GET['id'];
$umkm = $db->manual_query('select * from umkm where id_umkm = '.$id)[0]; 
?>
<!DOCTYPE html>
<html>
<head>
	<title>Form UMKM</title>
	<style type="text/css">
			@media print {
		    body{
		        width: 215mm;
		        /*margin: 10mm 10mm 10mm 10mm; */
		        /* change the margins as you want them to be. */
			   } 
			}
			br {
				   display: block;
				   margin: 10px 0;
				   line-height:22px;
				}
			p {
				  font-family: Arial, Helvetica, sans-serif;
				}
	
			.ctr {text-align: center;}
			.rght {text-align: right;}


	</style>
</head>
<body>
<div align="center">
	<table>
		<tr>
			<td>
				<img style="width:100px;height:130px;" src="pdf/logo-pemkot.png">
			</td>
			<td>
				<p></p>
			</td>
			<td class="ctr">
				<h2>PEMERINTAH KOTA SURABAYA</h2>
				<h2>DINAS KETAHANAN PANGAN DAN PERTANIAN</h2>
				<p>Jalan Pagesangan II Nomor 56 Surabaya 60233</p>
				<p>Telp. (031) 8282328 Fax Telp. (031)</p>
			</td>
		</tr>
	</table>
	<h2 class="ctr">Formulir Pendataan</h2>

</div>


<table width="100%" style="font-family: Arial">
	<tr style="height: 30px">
		<td colspan="2" width="30%">UMKM</td>
		<td colspan="2" width="70%">: <?php echo $umkm['nama_umkm'] ?></td>
	</tr>
	<tr style="height: 30px">
		<td colspan="2" width="30%">Nama (Ketua)</td>
		<td colspan="2" width="70%">: <?php echo $umkm['nama_pemilik_umkm'] ?></td>
	</tr>
	<tr style="height: 30px">
		<td colspan="2" width="30%">No. HP</td>
		<td colspan="2" width="70%">: <?php echo $umkm['no_hp_umkm'] ?></td>
	</tr>
	<tr style="height: 30px">
		<td colspan="2" width="30%">NIK</td>
		<td colspan="2" width="70%">: <?php echo $umkm['nik_umkm'] ?></td>
	</tr>
	<tr style="height: 30px">
		<td colspan="2" width="30%">Alamat</td>
		<td colspan="2" width="70%">: <?php echo $umkm['alamat_ktp_umkm']." ".$umkm['gang_blok_umkm']." ".$umkm['no_rumah_umkm']." ,".$umkm['kelurahan_umkm']." , ".$umkm['kecamatan_umkm'] ?></td>
	</tr>
	<tr style="height: 30px">
		<td colspan="2" width="30%">Jabatan</td>
		<td colspan="2" width="70%">: Ketua UMKM</td>
	</tr>
	<tr style="height: 30px">
		<td colspan="2" width="30%">Jumlah Anggota</td>
		<td colspan="2" width="70%">:</td>
	</tr>
	<tr style="height: 30px">
		<td colspan="2" width="30%">Produk</td>
		<td colspan="2" width="70%">:</td>
	</tr>
	<tr style="height: 30px">
		<td colspan="2" width="30%">Produk Unggulan</td>
		<td colspan="2" width="70%">:</td>
	</tr>
	<tr style="height: 30px">
		<td colspan="2" width="30%">Jumlah Produksi</td>
		<td colspan="2" width="70%">: <?php echo $umkm['produksi_umkm'] ?></td>
	</tr>
	<tr style="height: 30px">
		<td colspan="2" width="30%">Jumlah Omset</td>
		<td colspan="2" width="70%">: <?php echo $umkm['omset_perbulan_umkm'] ?></td>
	</tr>
</table>

<br>
<br>
<table>
	<tr>
		<td colspan="2" width="75%">
			<img style="width: 200px;height: : 100px" src="../images/<?php echo $umkm['foto_ktp_umkm'] ?>">
		</td>
		<td>
			<p class="ctr">
				Surabaya, ......................
			</p>
			<p class="ctr">
				Yang Membuat,
			</p>
			<img style="width: 200px;height: : 100px" src="../images/<?php echo $umkm['foto_ttd_umkm'] ?>">
			<p class="ctr">
				(<?php echo $umkm['nama_pemilik_umkm'] ?>)
			</p>
		</td>
	</tr>
</table>
<!-- <p>Yang bertanda tangan di bawah ini : </p>
<p>UMKM&emsp;&emsp;:</p>
<p>Nama (Ketua)&emsp;&emsp;:</p>
<p>No.HP&emsp;&emsp;:</p>
<p></p> -->
</body>
</html>