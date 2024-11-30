<footer class="pc-footer">
	<div class="footer-wrapper container-fluid">

	</div>
</footer>
<!-- [Page Specific JS] start -->
<script src="<?= base_url('./assets/js/plugins/apexcharts.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/jsvectormap.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/world.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/world-merc.js'); ?>"></script>
<script src="<?= base_url('./assets/js/pages/dashboard-sales.js'); ?>"></script>
<!-- [Page Specific JS] end -->
<!-- Required Js -->
<script src="<?= base_url('./assets/js/plugins/popper.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/simplebar.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/bootstrap.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/fonts/custom-font.js'); ?>"></script>
<script src="<?= base_url('./assets/js/pcoded.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/feather.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/jquery.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/bootstrap.bundle.min.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/dataTables.js'); ?>"></script>
<script src="<?= base_url('./assets/js/plugins/dataTables.bootstrap5.js'); ?>"></script>
<!-- DataTables Buttons plugin -->
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>

<!-- JSZip for Excel export -->
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<!-- pdfMake for PDF export -->
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.min.js"></script>
<script src="<?= base_url('./assets/js/formCount.js'); ?>"></script>
<script src="<?= base_url('./assets/js/genre.js'); ?>"></script>
<!-- Include SweetAlert2 CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.js"></script>


<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>



<script>
	// Select all table elements
	document.querySelectorAll('table').forEach((table) => {
		// Initialize DataTable for each table
		new DataTable(table);
	});
</script>


<script>
	layout_change('light');
</script>




<script>
	layout_sidebar_change('light');
</script>



<script>
	change_box_container('false');
</script>


<script>
	layout_caption_change('true');
</script>




<script>
	layout_rtl_change('false');
</script>


<script>
	preset_change("preset-1");
</script>


<script>
	header_change("header-1");
</script>


<script>
	<?php if ($this->session->flashdata('success')): ?>
		Swal.fire({
			icon: 'success',
			title: 'Berhasil!',
			text: '<?= $this->session->flashdata('success'); ?>',
			confirmButtonText: 'OK'
		});
	<?php endif; ?>

	<?php if ($this->session->flashdata('error')): ?>
		Swal.fire({
			icon: 'error',
			title: 'Gagal!',
			text: '<?= $this->session->flashdata('error'); ?>',
			confirmButtonText: 'Coba Lagi'
		});
	<?php endif; ?>
</script>


<!-- ONCHANGE band dan panggung -->
<script>
	$(document).ready(function() {
		// Event onchange untuk dropdown namaBand
		$('#namaBand').change(function() {
			const bandId = $(this).val();
			if (bandId) {
				$.ajax({
					url: "<?= base_url('admin/dashboard/get_band_details') ?>", // Ganti dengan nama controller/method
					type: "POST",
					data: {
						id_band: bandId
					},
					dataType: "json",
					success: function(data) {
						if (data) {
							let cardContent = `
                                    <div class="card p-3">
                                        <div class="card-body">
                                            <h5 class="card-title">${data.nama_band}</h5>
                                            <p class="card-text">Genre: ${data.genre}</p>
                                            <p class="card-text">Kontak: ${data.contact_band}</p>
                                        </div>
                                    </div>`;
							$('#resultCard').html(cardContent);
						} else {
							$('#resultCard').html('<p>Data tidak ditemukan.</p>');
						}
					},
					error: function() {
						alert('Gagal mengambil data. Silakan coba lagi.');
					}
				});
			}
		});

		// Event onchange untuk dropdown tempatManggung
		$('#tempatManggung').change(function() {
			const tempatId = $(this).val();
			if (tempatId) {
				$.ajax({
					url: "<?= base_url('admin/dashboard/get_tempat_details') ?>", // Sesuaikan endpoint
					type: "POST",
					data: {
						id_tempat: tempatId
					},
					dataType: "json",
					success: function(data) {
						if (data) {
							let cardContent = `
                        <div class="card">
                            <div class="card-body p-3">
                                <h5 class="card-title">${data.nama_tempat_manggung}</h5>
                                <p class="card-text">Provinsi: ${data.provinsi}</p>
                                <p class="card-text">Kota: ${data.kota}</p>
                                <p class="card-text">Alamat: ${data.alamat}</p>
                                <p class="card-text">Kontak: ${data.contact}</p>
                            </div>
                        </div>`;
							$('#resultCard2').html(cardContent);
						} else {
							$('#resultCard2').html('<p>Data tidak ditemukan.</p>');
						}
					},
					error: function() {
						alert('Gagal mengambil data. Silakan coba lagi.');
					}
				});
			}
		});
	});
</script>

<script>
	$(document).ready(function() {
		// Initialize DataTable
		var table = $('#list_jadwal').DataTable();

		// Custom filter by Month
		$('#monthFilter').on('change', function() {
			var month = $(this).val();
			table.column(6).search(month ? '^' + month : '', true, false).draw();
		});

		// Custom filter by Year
		$('#yearFilter').on('change', function() {
			var year = $(this).val();
			table.column(6).search(year ? '^' + year : '', true, false).draw();
		});

		// Custom filter by Date
		$('#dateFilter').on('change', function() {
			var date = $(this).val();
			table.column(6).search(date ? '^' + date : '', true, false).draw();
		});

		// Custom filter by Status
		$('#statusFilter').on('change', function() {
			var status = $(this).val();
			table.column(8).search(status ? '^' + status : '', true, false).draw();
		});
	});
</script>

</body>
<!-- [Body] end -->

</html>