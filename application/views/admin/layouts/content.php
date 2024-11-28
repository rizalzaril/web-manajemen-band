<!-- [ Main Content ] start -->
<div class="pc-container">
	<div class="pc-content">
		<!-- [ Main Content ] start -->


		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>Hallo, Selamat Datang <?= $this->session->userdata('username') ?> di Halaman Web Manajemen Band!</strong>, Terimakasih telah menjadi bagian dari kami
			<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div>


		<div class="row">
			<div class="col-md-6 col-xl-3">
				<div class="card bg-brand-color-10 order-card">
					<div class="card-body">
						<h6 class="text-white">Jumlah List Jadwal</h6>
						<h2 class="text-end text-white"><i class="feather icon-file float-start"></i><span>0</span>
						</h2>

					</div>
				</div>
			</div>
			<div class="col-md-6 col-xl-3">
				<a href="<?= base_url('admin/dashboard/list_band') ?>" style="text-decoration:none">
					<div class="card bg-brand-color-12 order-card">
						<div class="card-body">
							<h6 class="text-white">Jumlah List Band</h6>
							<h2 class="text-end text-white"><i class="feather icon-file float-start"></i><span><?php echo $band_count > 0 ? $band_count : 'Belum ada data'; ?></span>
							</h2>
						</div>
					</div>
				</a>
			</div>

			<div class="col-md-6 col-xl-3">
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

		</div>
		<!-- [ Main Content ] end -->
	</div>
</div>
<!-- [ Main Content ] end -->