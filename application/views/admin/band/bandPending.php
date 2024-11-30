<div class="pc-container">
	<div class="pc-content">



		<div class="card">
			<div class="card-header">
				<h3 class="">Daftar jadwal band yang belum di konfirmasi</h3>
			</div>
			<div class="card-body">

				<?php if ($this->session->flashdata('error')): ?>
					<div class="alert mt-3 mb-3 alert-danger alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('error'); ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>

				<?php if ($this->session->flashdata('success')): ?>
					<div class="alert mt-3 mb-3 alert-success alert-dismissible fade show" role="alert">
						<?= $this->session->flashdata('success'); ?>
						<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
					</div>
				<?php endif; ?>


				<div class="table table-responsive table-sm">
					<table id="list_jadwal" class="table table-striped" style="width:100%">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Band</th>
								<th>Genre</th>
								<th>Tempat Manggung</th>
								<th>Jenis Konser</th>
								<th>Alamat</th>
								<th>Tanggal</th>
								<th>Waktu</th>
								<th>Status</th>

								<th>#</th>
							</tr>
						</thead>
						<tbody>
							<?php if (!empty($band_pending)) : ?>
								<?php $no = 1; ?>
								<?php foreach ($band_pending as $data) : ?>
									<?php if ($data['status'] == 'Pending') { ?>
										<tr>
											<td><?= $no++; ?></td>
											<td><?= htmlspecialchars($data['nama_band']); ?></td>
											<td><?= htmlspecialchars($data['genre']); ?></td>
											<td><?= htmlspecialchars($data['nama_tempat_manggung']); ?></td>
											<td><?= htmlspecialchars($data['nama_konser']); ?></td>
											<td><?= htmlspecialchars($data['alamat']); ?>, <?= '', htmlspecialchars($data['kota_name']); ?>, <?= '', htmlspecialchars($data['provinsi_name']); ?> </td>
											<td><?= htmlspecialchars($data['date']); ?></td>
											<td><?= htmlspecialchars($data['time']); ?></td>
											<td>
												<?php if ($data['status'] == 'Pending') { ?>

													<span class="badge text-bg-warning"><?= htmlspecialchars($data['status']); ?></span>

												<?php } elseif ($data['status'] == 'Terkonfirmasi') { ?>

													<span class="badge text-bg-success"><?= htmlspecialchars($data['status']); ?></span>

												<?php } elseif ($data['status'] == 'Selesai') { ?>

													<span class="badge text-bg-info"><?= htmlspecialchars($data['status']); ?></span>

												<?php } else { ?>
													<span class="badge text-bg-danger"><?= htmlspecialchars($data['status']); ?></span>
												<?php } ?>

												<button type="button" class="badge text-bg-dark mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#ModalStatus"
													data-id="<?= $data['id_jadwal'] ?>"
													data-status="<?= htmlspecialchars($data['status']); ?>">
													Ubah status <i class="ph ph-pencil"></i>
												</button>

												<!-- Modal ubah status -->
												<div class="modal fade" id="ModalStatus" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
													<div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
														<div class="modal-content">
															<div class="modal-header text-white" style="background:#800000">
																<h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Status Jadwal</h1>
																<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
															</div>

															<div class="modal-body">
																<div class="container">
																	<form method="post" action="<?= base_url('admin/dashboard/update_status') ?>" class="update-status-form">
																		<div id="form-container" style="max-height: 800px; overflow-y: auto;">
																			<div class="card mb-3 mt-3">
																				<div class="card-body">
																					<div class="modal-body" style="max-height: 500px; overflow-y: auto;">

																						<!-- Status -->
																						<input type="hidden" id="modalStatusIdField" name="id_jadwal_status">
																						<div class="form-group mb-3">
																							<label for="status" class="form-label">Status</label>
																							<select id="status" name="status" required class=" form-control">
																								<option value="Pending">Pending</option>
																								<option value="Terkonfirmasi">Konfirmasi</option>
																								<!-- <option value="Selesai">Selesai</option> -->
																								<option value="Batal hadir">Batal hadir</option>
																							</select>
																						</div>

																					</div>
																				</div>
																			</div>
																		</div>
																		<div class="modal-footer">
																			<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
																			<button type="submit" class="btn btn-dark">Update</button>
																		</div>
																	</form>
																</div>
															</div>
														</div>
													</div>
												</div>
												<!-- End Modal ubah status -->

												<script>
													// JavaScript untuk mengisi modal secara dinamis
													document.addEventListener('DOMContentLoaded', function() {
														const editButtons = document.querySelectorAll('[data-bs-target="#ModalStatus"]');

														editButtons.forEach(function(button) {
															button.addEventListener('click', function() {
																const jadwalId = button.getAttribute('data-id');

																const status = button.getAttribute('data-status');

																// Isi field di dalam modal dengan data yang diambil
																document.getElementById('modalStatusIdField').value = jadwalId;
																document.getElementById('status').value = status;
															});
														});
													});
												</script>

											</td>

											<td>

												<div class="d-flex gap-1">
													<form method="post" action="<?= base_url('admin/dashboard/hapus_data_jadwal') ?>" class="delete-form">
														<input type="hidden" name="id_jadwal[]" value="<?= $data['id_jadwal'] ?>" />
														<button type="button" id="delete_button" class="btn btn-danger text-white"><i class="ph ph-trash"></i></button>
													</form>


													<!-- Edit Button -->
													<button class="btn btn-primary text-white"
														data-bs-toggle="modal"
														data-bs-target="#modalEditJadwal"
														data-id="<?= $data['id_jadwal'] ?>"
														data-id-band="<?= $data['id_band'] ?>"
														data-id-tempat="<?= $data['id_tempat_manggung'] ?>"
														data-date="<?= $data['date'] ?>"
														data-time="<?= $data['time'] ?>"
														data-jenis-konser="<?= $data['id_jenis_konser'] ?>"
														data-status="<?= $data['status'] ?>">
														<i class="ph ph-pencil"></i>
													</button>

													<!-- Modal Edit Jadwal -->
													<div class="modal fade" id="modalEditJadwal" tabindex="-1" aria-labelledby="modalEditJadwalLabel" aria-hidden="true">
														<div class="modal-dialog">
															<div class="modal-content">
																<div class="modal-header">
																	<h5 class="modal-title" id="modalEditJadwalLabel">Edit Jadwal</h5>
																	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																</div>
																<div class="modal-body">
																	<form id="editJadwalForm" action="<?= base_url('admin/dashboard/update_jadwal') ?>" method="POST" class="update-form">
																		<input type="hidden" name="id_jadwal" value="<?= $data['id_jadwal'] ?>">

																		<div class="mb-3">
																			<label for="id_band" class="form-label">ID Band</label>
																			<select class="form-control" required name="id_band" id="id_band">
																				<!-- Default selected value will be populated using JS -->
																				<option value="">Pilih Salah Satu</option>
																				<?php foreach ($list_band as $band) : ?>
																					<option value="<?= $band['id_band'] ?>"><?= $band['nama_band'] ?></option>
																				<?php endforeach; ?>
																			</select>
																		</div>

																		<div class="mb-3">
																			<label for="id_tempat" class="form-label">Tempat</label>
																			<select class="form-control" required name="id_tempat" id="id_tempat">
																				<!-- Default selected value will be populated using JS -->
																				<option selected>Pilih Salah Satu</option>
																				<?php foreach ($list_panggung as $tempat) : ?>
																					<option value="<?= $tempat['id_tempat_manggung'] ?>"><?= $tempat['nama_tempat_manggung'] ?></option>
																				<?php endforeach; ?>
																			</select>
																		</div>

																		<div class="mb-3">
																			<label for="jenis" class="form-label">Jenis Konser</label>
																			<select class="form-control" required name="jenis_konser" id="jenis_konser">

																				<option selected>Pilih Salah Satu</option>
																				<?php foreach ($list_konser as $konser) : ?>
																					<option value="<?= $konser['id_jenis_konser'] ?>"><?= $konser['nama_konser'] ?></option>
																				<?php endforeach; ?>

																			</select>
																		</div>

																		<div class="mb-3">
																			<label for="date" class="form-label">Tanggal</label>
																			<input type="date" class="form-control" name="date" id="date">
																		</div>
																		<div class="mb-3">
																			<label for="time" class="form-label">Waktu</label>
																			<input type="time" class="form-control" name="time" id="time">
																		</div>
																</div>
																<div class="modal-footer">
																	<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
																	<button type="submit" class="btn btn-primary" form="editJadwalForm">Save changes</button>
																</div>
																</form>
															</div>
														</div>
													</div>
													<!-- End Modal Edit Jadwal -->

													<script>
														document.addEventListener('DOMContentLoaded', function() {
															const editButtons = document.querySelectorAll('[data-bs-target="#modalEditJadwal"]');

															editButtons.forEach(function(button) {
																button.addEventListener('click', function() {
																	// Extract data attributes from the clicked button
																	const idJadwal = button.getAttribute('data-id');
																	const idBand = button.getAttribute('data-id-band');
																	const idTempat = button.getAttribute('data-id-tempat');
																	const jenisKonser = button.getAttribute('data-jenis-konser');
																	const date = button.getAttribute('data-date');
																	const time = button.getAttribute('data-time');
																	const status = button.getAttribute('data-status');

																	// Fill modal fields with the extracted data
																	document.querySelector('[name="id_jadwal"]').value = idJadwal;
																	document.querySelector('[name="id_band"]').value = idBand;
																	document.querySelector('[name="id_tempat"]').value = idTempat;
																	document.querySelector('[name="jenis_konser"]').value = jenisKonser;
																	document.querySelector('[name="date"]').value = date;
																	document.querySelector('[name="time"]').value = time;

																	// If a status input exists, set its value
																	const statusField = document.querySelector('[name="status"]');
																	if (statusField) {
																		statusField.value = status;
																	}
																});
															});
														});
													</script>



												</div>
											</td>
										</tr>
									<?php } ?>
								<?php endforeach; ?>
							<?php else : ?>
								<tr>
									<td colspan="5" class="text-center">Tidak ada data tempat manggung yang tersedia.</td>
								</tr>
							<?php endif; ?>
						</tbody>

					</table>

				</div>

			</div>

		</div>

	</div>
</div>

<script>
	// UPDATE STATUS //
	document.querySelectorAll('.update-status-form').forEach(form => {
		form.addEventListener('submit', function(e) {
			e.preventDefault();
			Swal.fire({
				title: 'Apakah anda yakin?',
				text: 'Kamu akan update status jadwal manggung',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, update status jadwal manggung!',
				cancelButtonText: 'Tidak, batal update status jadwal mangggung!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					// Submit the form if confirmed
					form.submit();
					Swal.fire(
						'Updated!',
						'Data Anda telah berhasil di update.',
						'success'
					);
				} else {
					Swal.fire('Dibatalkan', 'status manggung batal di update :)',
						'error'); // Cancel the deletion
				}
			});
		});
	});
	// END SAVE ALERT //
</script>