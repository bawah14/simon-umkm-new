<?php 
$produk = $db->manual_query("select * from produk inner join stok on stok.id_produk = produk.id_produk inner join umkm on produk.id_umkm = umkm.id_umkm where status_produk = 1");
$dataajust = $db->manual_query("select * from purchase inner join produk on produk.id_produk = purchase.id_barang where id_transaksi = 0 order by tanggal_purchase desc");
$umkm = $db->manual_query("select * from umkm inner join kategori on umkm.kategori_umkm = kategori.id_kategori inner join binaan on umkm.binaan_umkm = binaan.id_binaan where umkm.binaan_umkm = 1");
$kategori = $db->manual_query("select * from kategori");
foreach ($kategori as $key => $value) {
	# code...
	$newkategori[$value['id_kategori']] = $value['nama_kategori'];
}
?>
<div class="row">
	<div class="col-lg-12">
		<div class="card">
			<div class="card-header">
				<!-- <div class="card-title"> -->
					<div class="row">
						<div class="col-8">
							<h2 class="description-header">Stok</h2>
						</div>
						<div class="col-4">
              <button class="btn btn-primary" data-toggle="modal" data-target="#modal-tambah-produk">Tambah Produk</button>
							<a href="php/export/print_katalog.php" class="btn btn-default">Katalog</a>
						</div>
					</div>

				<!-- </div> -->
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-lg-5">
						<label>Barang</label>
						<select class="form-control select2" name="id_produk" id="nama_produk_stok">
							<option disabled="" selected="">pilih produk</option>
							<?php foreach ($produk as $key => $value): ?>
								<option value="<?php echo $value['id_produk'] ?>" > <?php echo $value['nama_produk']." - ".$value['nama_umkm']." - ".$value['harga_produk'] ?></option>
							<?php endforeach ?>
						</select>
					</div>
					<div class="col-lg-5">
						<label>Jumlah Stok</label>
						<input type="number" readonly="" name="stok" class="form-control" id="stok">
					</div>
					<div class="col-lg-2">
						<div class="form-group">
						<br>
						<button class="btn btn-default" id="btn-min" data-target="#modal-tambah" data-toggle="modal"><i class="fa fa-minus"></i></button>
						<button class="btn btn-default" id="btn-plus" data-target="#modal-tambah" data-toggle="modal"><i class="fa fa-plus" ></i></button>
						</div>
					</div>
				</div>
				<hr>
				<!-- <div class="row">
					<div class="col-lg-12">
						<table class="table">
							<thead>
								<th>No</th>
								<th>Tanggal</th>
								<th>Barang</th>
								<th>Jumlah</th>
								<th>Keterangan</th>	
							</thead>
							<tbody>
								<?php $no=0; foreach ($dataajust as $key => $value): $no++ ?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $value['tanggal_purchase'] ?></td>
									<td><?php echo $value['nama_produk'] ?></td>
									<td><?php echo $value['jenis_purchase'] ?>  <?php echo $value['jumlah_barang_purchase'] ?></td>
									<td><?php echo $value['keterangan_purchase'] ?></td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div> -->
				<div class="row">
					<div class="col-lg-12">
						<table class="table data-table">
							<thead>
								<th>No</th>
								<th>Nama Produk</th>
								<th>Stok</th>
								<th>Nama Umkm</th>
								<th>Harga</th>
								<th>Action</th>
							</thead>
							<tbody>
								<?php $no=0; foreach ($produk as $key => $value): $no++ ?>
								<tr>
									<td><?php echo $no ?></td>
									<td><?php echo $value['nama_produk'] ?></td>
									<td><?php echo $value['jumlah_stok'] ?></td>
									<td><?php echo $value['nama_umkm'] ?></td>
									<td><?php echo $value['harga_produk'] ?></td>
									<td><a href="#" data-toggle="modal" data-target="#modal-edit-produk-<?php echo $value['id_produk'] ?>">Edit</a></td>
								</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal-tambah" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><span id="nama"></span>Stok</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<form action="php/stok.php">
      		
        <div class="form-group form-group-lg">
        	<label>Jumlah</label>
        	<input type="number" class="form-control" name="jumlah" id="jumlah-tambah">
        </div>
        <div class="form-group form-group-lg">
        	<label>Ketrengan</label>
        	<input type="text" class="form-control" name="keterangan" >
        </div>
        <input type="hidden" name="tipe" id="tipe">
        <input type="hidden" name="id_produk" id="id_produk_stok">
      </div>
      <div class="modal-footer">
        <button  class="btn btn-primary" id="kirim-stok">Save changes</button>
      	</form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<?php foreach ($produk as $key => $value): ?>
<div class="modal" id="modal-edit-produk-<?php echo $value['id_produk'] ?>" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="php/produk.php" enctype="multipart/form-data">
          <input type="hidden" name="from" value="">
          <input type="hidden" name="id_produk" value="<?php echo $value['id_produk'] ?>">
          <input type="hidden" name="edit" >
          <div class="form-group">
            <label>Nama Produk</label>
            <input type="text" class="form-control" name="nama_produk" value="<?php echo $value['nama_produk'] ?>">
          </div>
          <div class="form-group">
            <label>Harga Produk</label>
            <input type="text"  class="form-control" name="harga_produk" value="<?php echo $value['harga_produk'] ?>">
          </div>
          <div class="form-group">
            <label>Satuan Produk</label>
            <input type="text" class="form-control" name="satuan_produk" value="<?php echo $value['satuan_produk'] ?>">
          </div>
          <div class="form-group" >
            <label>Produksi Produk / Bulan</label>
            <input type="text" class="form-control" name="produksi_produk" value="<?php echo $value['produksi_produk'] ?>">
          </div>
          <div class="form-group">
            <label>Kategori Produk</label>
            <select class="form-control" name="kategori_produk">
              <option value="" >Pilih Kategori ... </option>
              <?php foreach ($newkategori as $k => $v): ?>
                <option value="<?php echo $k ?>" <?php if ($value['kategori_produk'] == $k): ?>
                  selected
                <?php endif ?>><?php echo $v ?></option>
              <?php endforeach ?>
            </select>
          </div>
          <div class="form-group">
            <label>Foto Produk</label>
            <input type="file" name="foto_produk" accept="image/*">
          </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>  
<?php endforeach ?>

<div class="modal" id="modal-tambah-produk" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tambah Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form method="post" action="php/produk.php" enctype="multipart/form-data">
        	<!-- <input type="hidden" name="id_umkm" value="<?php echo $_GET['id_umkm'] ?>"> -->
        	<input type="hidden" name="insert" >
        	<div class="form-group">
        		<label>UMKM</label>
        		<select class="form-control select2" name="id_umkm" required="">
        			<option value="">Pilih ...</option>
        			<?php foreach ($umkm as $key => $value): ?>
        				<option value="<?php echo $value['id_umkm'] ?>"><?php echo $value['nama_umkm'] ?></option>
        			<?php endforeach ?>
        		</select>
        	</div>
        	<div class="form-group">
        		<label>Nama Produk</label>
        		<input type="text" required="" class="form-control" name="nama_produk">
        	</div>
        	<div class="form-group">
        		<label>Harga Produk</label>
        		<input type="text" required="" class="form-control" name="harga_produk">
        	</div>
        	<div class="form-group">
        		<label>Satuan Produk</label>
        		<input type="text" required="" class="form-control" name="satuan_produk">
        	</div>
        	<div class="form-group" >
        		<label>Produksi Produk / Bulan</label>
        		<input type="text" required="" class="form-control" name="produksi_produk">
        	</div>
        	<div class="form-group">
        		<label>Kategori Produk</label>
        		<select class="form-control" required="" name="kategori_produk">
        			<option value="" disabled="" selected>Pilih Kategori ... </option>
        			<?php foreach ($newkategori as $key => $value): ?>
        				<option value="<?php echo $key ?>"><?php echo $value ?></option>
        			<?php endforeach ?>
        		</select>
        	</div>
        	<div class="form-group">
        		<label>Foto Produk</label>
        		<input type="file" name="foto_produk" accept="image/*">
        	</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Tambah</button>
        </form>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>