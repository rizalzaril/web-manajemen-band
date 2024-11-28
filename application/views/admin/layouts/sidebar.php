<!-- [ Sidebar Menu ] start -->
<nav class="pc-sidebar">
	<div class="navbar-wrapper">
		<div class="m-header">
			<a href="../dashboard/index.html" class="b-brand text-primary">
				<!-- ========   Change your logo from here   ============ -->
				<img src="../assets/images/logo-white.svg" alt="logo image" class="logo-lg">
			</a>
		</div>
		<div class="navbar-content">
			<ul class="pc-navbar">
				<li class="pc-item pc-caption">
					<label>Navigation</label>
				</li>
				<li class="pc-item">
					<a href="<?= base_url('admin/dashboard') ?>" class="pc-link"><span class="pc-micon">
							<i class="ph ph-gauge"></i></span><span class="pc-mtext">Dashboard</span></a>
				</li>


				<li class="pc-item pc-caption">
					<label>
						<p>Manajemen Jadwal Band</p>
					</label>
					<i class="ph ph-compass-tool"></i>
				</li>
				<li class="pc-item">
					<a href="<?= base_url('admin/Dashboard/list_jadwal') ?>" class="pc-link">
						<span class="pc-micon"><i class="ph ph-clipboard"></i></span>
						<span class="pc-mtext">List Jadwal</span>
					</a>
				</li>

				<li class="pc-item">
					<a href="<?= base_url('admin/Dashboard/list_band') ?>" class="pc-link">
						<span class="pc-micon"><i class="ph ph-clipboard"></i></span>
						<span class="pc-mtext">List Band</span>
					</a>
				</li>

				<li class="pc-item">
					<a href="<?= base_url('admin/Dashboard/list_tempat_manggung') ?>" class="pc-link">
						<span class="pc-micon"><i class="ph ph-gear"></i></span>
						<span class="pc-mtext">Setting Tempat</span>
					</a>
				</li>
			</ul>

		</div>
	</div>
</nav>
<!-- [ Sidebar Menu ] end -->