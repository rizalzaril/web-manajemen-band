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




</body>
<!-- [Body] end -->

</html>