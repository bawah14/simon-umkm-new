<?php 
require_once '../../config/db.php';
$db = new db();
// print_r($_GET);
// $datatransaksi = $db->manual_query("select * from transaksi where tanggal");
$dataumkm = $db->manual_query("select * from umkm where binaan_umkm = 1");
$dataminggu = $db->manual_query("select week(selected_date) from (select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v where selected_date between '".$_GET['mulai']."' and '".$_GET['selesai']."' group by week(selected_date)");
// print_r($dataminggu);
?>
<style type="text/css">
	table,
      th,
      td {
        padding: 2px;
        border: 1px solid black;
        border-collapse: collapse;
      }
</style>
<h1>Laporan Penjualan</h1>
<table style="border-width: 0px"> 
	<tr>
		<td>Tanggal</td>
		<td>: <?php echo $_GET['mulai']." - ".$_GET['selesai']  ?></td>
	</tr>
</table>
<br>
<table style="border-width: 2px">
	<thead>
		<th>Nama Umkm</th>
		<th></th>
		<?php $no = 0; foreach ($dataminggu as $key => $value): $no++; ?>
		<th>Minggu <?php echo $no ?></th>	
		<?php endforeach ?>
		<th>Omset</th>
		<th>Stok</th>
	</thead>
	<tbody>
		<?php foreach ($dataumkm as $key => $value): ?>
			<tr>
				<td><?php echo $value['nama_umkm'] ?></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
				<td></td>
			</tr>
			<?php $dataproduk = $db->manual_query("select * from produk where id_umkm = ".$value['id_umkm']); ?>
			<?php if ($dataproduk != null): ?>
				
			<?php foreach ($dataproduk as $k => $val): ?>
			<?php $stok = $db->manual_query("select * from stok where id_produk = ".$val['id_produk']) ?>
			<?php
			$omset = $db->manual_query("select sum(harga_total_purchase) as total from purchase where id_barang = ".$val['id_produk']." and date(tanggal_purchase) between '".$_GET['mulai'].'\' and \''.$_GET['selesai'].'\'') ;
			foreach ($dataminggu as $key => $value) {
				// echo "select sum(harga_total_purchase) as total from purchase where id_barang = ".$val['id_produk']." and date(tanggal_purchase) between '".$_GET['mulai'].'\' and \''.$_GET['selesai'].'\' and week(tanggal_purchase) = '.$value[0];
				$minggu[$value[0]]= $db->manual_query("select sum(harga_total_purchase) as total from purchase where id_barang = ".$val['id_produk']." and date(tanggal_purchase) between '".$_GET['mulai'].'\' and \''.$_GET['selesai'].'\' and week(tanggal_purchase) = '.$value[0]);
				$jmlhterjual[$value[0]] = $db->manual_query("select sum(jumlah_barang_purchase) as jumlah from purchase where id_barang = ".$val['id_produk']." and jenis_purchase = '-' and id_transaksi != 0 and date(tanggal_purchase) between '".$_GET['mulai'].'\' and \''.$_GET['selesai'].'\' and week(tanggal_purchase) = '.$value[0]);
			}

			?>
			<tr>
				<td></td>
				<td><?php echo $val['nama_produk'] ?></td>
				<?php foreach ($minggu as $key => $value): ?>
					<td><?php echo $value[0]['total'] == "" ? 0:number_format($value[0]['total'])." / ".$jmlhterjual[$key][0]['jumlah'];   ?></td>
				<?php endforeach ?>
				
				<td><?php echo number_format($omset[0]['total'])?></td>
				<td><?php echo $stok == null ? "Kosong":$stok[0]["jumlah_stok"]; ?></td>
			</tr>
			<?php endforeach ?>
			<?php endif ?>
		<?php endforeach ?>
	</tbody>
</table>