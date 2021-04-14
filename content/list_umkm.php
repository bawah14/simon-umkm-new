<?php 
$umkm = $db->manual_query("select * from umkm inner join kategori on umkm.kategori_umkm = kategori.id_kategori inner join binaan on umkm.binaan_umkm = binaan.id_binaan");
 ?>

<div class="row">
	<div class="col-12">
		<div class="card">
			<div class="card-header bg-gradient-info">
				<div class="row">
					<div class="col-8">
						<span class="card-title">Daftar UMKM</span>
						
					</div>
					<div class="col-4">
						<a class="btn btn-default float-right" href="php/export/list_umkm.php">Download</a>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="row">
					<div class="col-12">
						<table class="table data-table-responsive">
							<thead>
								<th>No</th>
								<th>Nama UMKM</th>
								<th>Nama Pemilik UMKM</th>
								<th>Alamat UMKM</th>
								<!-- <th>Produk</th> -->
								<th>Kategori UMKM</th>
								<th>Binaan UMKM</th>
								<th>Act</th>
							</thead>
							<tbody>
								<?php $no=0; foreach ($umkm as $key => $value): $no++; ?>
									<tr class="clickable" onclick="location.href='index.php?content=profile_umkm&id_umkm=<?php echo($value["id_umkm"]) ?>'">
										<td><?php echo $no ?></td>
										<td><?php echo $value['nama_umkm'] ?></td>
										<td><?php echo $value['nama_pemilik_umkm'] ?></td>
										<!-- <td><?php echo $value['nama_kategori'] ?></td> -->
										<td><?php echo $value['alamat_ktp_umkm']." ".$value['gang_blok_umkm']." ".$value['no_rumah_umkm']." ,".$value['kelurahan_umkm']." , ".$value['kecamatan_umkm'] ?></td>
										<?php 
											// $produk = $db->manual_query("select nama_produk from produk where id_umkm = ".$value['id_umkm']);
											// $total = count($produk);
											// $count = 1;
										?>
										<!-- <td>
											<?php foreach ($produk as $k => $v): ?>
												<?php if ($count == $total): ?>
													<?php echo $v['nama_produk']."." ?>
												<?php else: ?>
													<?php echo $v['nama_produk']." , " ?>
												<?php endif ?>
												<?php $count ++ ?>
											<?php endforeach ?>
										</td> -->
										<td><?php echo $value['nama_kategori'] ?></td>
										<td><?php echo $value['nama_binaan'] ?></td>
										<td><a href="index.php?content=edit_umkm&id=<?php echo($value['id_umkm']) ?>">Edit</a> | <a href="php/umkm.php?delete=&id=<?php echo($value['id_umkm']) ?>" onclick="return confirm('Yakin Hapus?')">Hapus</a></td>
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