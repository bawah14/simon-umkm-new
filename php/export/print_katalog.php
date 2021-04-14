<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=Data Produk.xls"); 
require_once '../../config/db.php';
$db = new db();
$umkm = $db->manual_query("select * from umkm where binaan_umkm = 1 order by nama_umkm asc");

?>
<!DOCTYPE html>
<html>
<head>
	<title>Katalog DS Point</title>
</head>
<body>
<table>
	<thead>
		<th>Kode</th>
		<th>Nama</th>
		<th>Harga</th>
	</thead>
	<tbody>
		<?php foreach ($umkm as $key => $value): ?>	
		<tr>
			<td colspan="3" style="text-align: center; background-color: yellow" ><b><?php echo $value['nama_umkm'] ?></b></td>
		</tr>		
		<?php 
			$produk = $db->manual_query("select * from produk where id_umkm = ".$value['id_umkm']." order by nama_produk asc");
		?>
			<?php foreach ($produk as $k => $v): ?>
			<tr>
				<td><?php echo $v['id_produk'] ?></td>
				<td><?php echo $v['nama_produk'] ?></td>
				<td style="text-align: right"><?php echo number_format($v['harga_produk'],0,",",".") ?></td>
			</tr>
			<?php endforeach ?>
		<?php endforeach ?>
	</tbody>
</table>
</body>
</html>
