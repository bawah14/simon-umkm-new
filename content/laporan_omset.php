<?php 
$mulai="";
$selesai="";
if (isset($_GET['tanggal-mulai']) && isset($_GET['tanggal-selesai'])) {
	// print_r($_GET);
	$transaksi = $db->manual_query('select * from transaksi where date(tanggal_transaksi) between \''.$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai'].'\'');
	$hasil = $db->manual_query('select sum(harga_total_transaksi) as omset from transaksi where date(tanggal_transaksi) between \''.$_GET['tanggal-mulai'].'\' and \''.$_GET['tanggal-selesai'].'\'')[0];
	$mulai = $_GET['tanggal-mulai'];
	$selesai= $_GET['tanggal-selesai'] ;
	$dataminggu = $db->manual_query("select week(selected_date) from (select adddate('1970-01-01',t4.i*10000 + t3.i*1000 + t2.i*100 + t1.i*10 + t0.i) selected_date from (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t0, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t1, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t2, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t3, (select 0 i union select 1 union select 2 union select 3 union select 4 union select 5 union select 6 union select 7 union select 8 union select 9) t4) v where selected_date between '".$_GET['mulai']."' and '".$_GET['selesai']."' group by week(selected_date)");
}
// $transaksi = null;
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header bg-gradient-info">
				<span class="description-header"><b>Laporan Omset</b></span>
				<div class="card-tools">
					<button type="button" class="btn bg-info btn-sm" data-card-widget="collapse">
	                    <i class="fas fa-minus"></i>
	                </button>
				</div>
			</div>
			<div class="card-body">
				<!-- <div class="row"> -->
					<form>
					<div class="row">
						<input type="hidden" name="content" value="laporan_penjualan">
						<div class="col-lg-4">
							<div class="form-group">
								
							<label>Tanggal Mulai</label>
								<input type="date" name="tanggal-mulai" id="tanggal-mulai" class="form-control" value="<?php echo $mulai ?>">
							</div>
						</div>
						<div class="col-lg-4">
							<div class="form-group">
								<label>Tanggal Selesai</label>
								<input type="date" name="tanggal-selesai" id="tanggal-selesai" class="form-control"  value="<?php echo $selesai ?>">
							</div>
							
						</div>
						<div class="col-lg-2">
							<button type="submit" class="btn btn-info">Pilih</button> <button type="button" id="btn-cetak-laporan" class="btn btn-default" id="cetak-omset"><i class="fa fa-print"></i> Cetak</button>
						</div>
						<div class="col-lg-2">
							
						</div>
					</div>	
					</form>
				<!-- </div> -->
				<hr>
				<div class="row">
					<div class="col-lg-12">
						
					<table class="table data-table-responsive" style="width: 100%">
						<thead>
							<th>ID</th>
							<th>Tanggal Nota</th>
							<th>Harga</th>
							<th>Status</th>
							<th>Action</th>
						</thead>
						<tbody>
							<?php if (isset($transaksi)): ?>
								
							<?php foreach ($transaksi as $key => $value): ?>
							<tr>
								<td><?php echo $value['id_transaksi'] ?></td>
								<td><?php echo $value['tanggal_transaksi'] ?></td>
								<td><?php echo number_format($value['harga_total_transaksi']) ?></td>
								<td><?php echo $value['keterangan_transaksi'] ?></td>
								<td><button class="btn btn-default" data-toggle="modal" data-target="#modal-transaksi-<?php echo($value['id_transaksi']) ?>"><i class="fa fa-eye"></i></button></td>								
							</tr>
							<?php endforeach ?>
							<?php endif ?>
						</tbody>
					</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
