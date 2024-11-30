<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<!-- [ Main Content ] start -->


		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Hallo, Selamat Datang <?= $this->session->userdata('username') ?> di Halaman Web Manajemen Band!</strong>
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>

		<div class="row">
			<div class="col-md-8">
				<img class="img rounded img-thumbnail" src="https://i.pinimg.com/736x/fe/51/8a/fe518a12503594b61c40168fd97b2adc.jpg">
			</div>

			<div class="col-md-4 ">
				<a href="<?= base_url('admin/dashboard/view_band_pending') ?>" style="text-decoration:none">
					<div class="card bg-brand-color-8 order-card mt-3">
						<div class="card-body">
							<h6 class="text-white">Butuh Konfirmasi</h6>
							<h2 class="text-end text-white"><i class="feather icon-alert-circle float-start"></i><?php echo $jadwal_count_pending > 0 ? $jadwal_count_pending : '<p>Belum ada data</p>'; ?></span>
							</h2>
						</div>
					</div>
				</a>

				<a href="<?= base_url('admin/dashboard/view_band_hadir') ?>" style="text-decoration:none">
					<div class="card bg-brand-color-10 order-card mt-3">
						<div class="card-body">
							<h6 class="text-white">Daftar Hadir</h6>
							<h2 class="text-end text-white"><i class="feather icon-user-check float-start"></i><?php echo $jadwal_count_hadir > 0 ? $jadwal_count_hadir : '<p>Belum ada data</p>'; ?></span>
							</h2>
						</div>
					</div>
				</a>

				<a href="<?= base_url('admin/dashboard/view_band_batal_hadir') ?>" style="text-decoration:none">
					<div class="card bg-dark order-card mt-3">
						<div class="card-body">
							<h6 class="text-white">Daftar Batal Hadir</h6>
							<h2 class="text-end text-white"><i class="feather icon-user-x float-start"></i><?php echo $jadwal_count_batal_hadir > 0 ? $jadwal_count_batal_hadir : '<p>Belum ada data</p>'; ?></span>
							</h2>
						</div>
					</div>
				</a>

			</div>
		</div>

		<!-- <div class="row">
			<div class="col-md-4">
				<div class="card bg-brand-color-10 order-card">
					<div class="card-body">
						<h6 class="text-white">Jumlah List Jadwal</h6>
						<h2 class="text-end text-white"><i class="feather icon-file float-start"></i><?php echo $jadwal_count > 0 ? $jadwal_count : 'Belum ada data'; ?></span>
						</h2>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<a href="<?= base_url('admin/dashboard/list_band') ?>" style="text-decoration:none">
					<div class="card bg-brand-color-12 order-card mt-3">
						<div class="card-body">
							<h6 class="text-white">Jumlah List Band</h6>
							<h2 class="text-end text-white"><i class="feather icon-file float-start"></i><span><?php echo $band_count > 0 ? $band_count : 'Belum ada data'; ?></span>
							</h2>
						</div>
					</div>
				</a>
			</div>
			<div class="col-md-4">
				<a href="<?= base_url('admin/dashboard/list_tempat_manggung') ?>" style="text-decoration:none">
					<div class="card bg-brand-color-11 order-card">
						<div class="card-body">
							<h6 class="text-white">Jumlah List Panggung</h6>
							<h2 class="text-end text-white"><i class="feather icon-file float-start"></i><?php echo $panggung_count > 0 ? $panggung_count : 'Belum ada data'; ?></span>
							</h2>
						</div>
					</div>
				</a>
			</div>
		</div> -->


		<div class="mt-5">

			<div class="card mb-5">
				<div class="card-body  ">
					<h5>Recent Jadwal Manggung</h5>
					<table id="list_jadwal" class="table table-striped table-bordered">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Band</th>
								<th>Tanggal</th>
								<th>Tempat</th>
								<th>Alamat</th>
								<th>Jenis Konser</th>
								<th>Waktu</th>
								<th>Status Jadwal</th>
							</tr>
						</thead>
						<tbody>
							<?php $no = 1;
							foreach ($list_jadwal as $b) : ?>
								<tr>
									<td><?= $no++ ?></td>
									<td><?= $b['nama_band'] ?></td>
									<td><?= $b['date'] ?></td>
									<td><?= $b['nama_tempat_manggung'] ?></td>
									<td><?= $b['alamat'] ?></td>
									<td><?= $b['nama_konser'] ?></td>
									<td><?= $b['time'] ?></td>
									<td>
										<?php if ($b['status'] == 'Pending') { ?>
											<span class="badge text-bg-warning"><?= $b['status'] ?></span>
										<?php } elseif ($b['status'] == 'Terkonfirmasi') { ?>
											<span class="badge bg-success"><?= $b['status'] ?></span>
										<?php } elseif ($b['status'] == 'Selesai') { ?>
											<span class="badge bg-info"><?= $b['status'] ?></span>
										<?php } else { ?>
											<span class="badge bg-danger"><?= $b['status'] ?></span>
										<?php } ?>
									</td>
								</tr>
							<?php endforeach; ?>
						</tbody>
					</table>

				</div>
			</div>
		</div>





	</div>
	<!-- [ Main Content ] end -->
</div>
</div>
<!-- [ Main Content ] end -->