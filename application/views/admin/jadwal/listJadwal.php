<div class="pc-container">
	<div class="pc-content">


		<!-- Recent Orders start -->
		<div class="col-sm-12">
			<div class="card table-card">
				<div class="card-header">
					<h3>List Jadwal Manggung</h3>
				</div>
				<div class="card-body p-1">


					<!-- Button trigger modal -->
					<div class="ml-3">
						<button type="button" class="btn btn-dark mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
							Tambah data <i class="ph ph-plus"></i>
						</button>
					</div>

					<!-- Modal add data -->
					<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog  modal-dialog-scrollable">
							<div class="modal-content">
								<div class="modal-header text-white" style="background:#800000">
									<h1 class="modal-title fs-5" id="exampleModalLabel">Isi Data List Tempat Manggung</h1>
									<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>

								<div class="modal-body">
									<div class="container">
										<form method="post" action="<?= base_url('admin/dashboard/simpan_data_panggung') ?>" class="save-form">
											<div id="form-container" style="max-height: 800px; overflow-y: auto;">
												<div class="card mb-3 mt-3">
													<div class="card-body">
														<div class="modal-body" style="max-height: 500px; overflow-y: auto;">
															<!-- Nama Tempat Manggung -->
															<div class="form-group mb-3">
																<label for="namaBand1" class="form-label">Nama Tempat Manggung</label>
																<input type="text" required name="nama_tempat[]" class="form-control" id="namaBand1">
															</div>

															<!-- Provinsi -->
															<div class="form-group mb-3">
																<label for="province1" class="form-label">Provinsi</label>
																<select class="form-control province" required name="provinsi[]" id="province1" onchange="loadCities()">
																	<option value="">Provinsi</option>
																	<!-- Province options will be loaded dynamically -->
																</select>
															</div>

															<!-- Kota -->
															<div class="form-group mb-3">
																<label for="city1" class="form-label">Kota</label>
																<select id="city1" name="kota[]" required class="city form-control">
																	<option value="">Kota</option>
																	<!-- City options will be loaded dynamically -->
																</select>
															</div>

															<!-- Alamat -->
															<div class="form-group mb-3">
																<label for="alamat1" class="form-label">Alamat</label>
																<input type="text" name="alamat[]" required class="form-control" id="alamat1">
															</div>

															<!-- No Telepon -->
															<div class="form-group mb-3">
																<label for="contact1" class="form-label">No Telepon</label>
																<input type="number" name="contact[]" required class="form-control" id="contact1">
															</div>

															<!-- ID Band -->
															<div class="form-group mb-3">
																<label for="idBand" class="form-label">ID Band</label>
																<input type="text" required name="id_band[]" class="form-control" id="idBand">
															</div>

															<!-- ID Tempat Manggung -->
															<div class="form-group mb-3">
																<label for="idTempatManggung" class="form-label">ID Tempat Manggung</label>
																<input type="text" required name="id_tempat_manggung[]" class="form-control" id="idTempatManggung">
															</div>

															<!-- Tanggal -->
															<div class="form-group mb-3">
																<label for="date" class="form-label">Tanggal</label>
																<input type="date" required name="date[]" class="form-control" id="date">
															</div>

															<!-- Waktu -->
															<div class="form-group mb-3">
																<label for="time" class="form-label">Waktu</label>
																<input type="time" required name="time[]" class="form-control" id="time">
															</div>

															<!-- Status -->

														</div>
													</div>
												</div>
											</div>

											<!-- Button untuk menambah form baru -->
											<button type="button" class="btn btn-success mb-3" id="add-button">+</button>

											<div class="modal-footer">
												<button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
												<button type="submit" class="btn btn-dark">Simpan</button>
											</div>
										</form>


										<script>
											document.getElementById('add-button').addEventListener('click', function() {
												var formContainer = document.getElementById('form-container');
												var newFormGroup = formContainer.querySelector('.card').cloneNode(true);
												formContainer.appendChild(newFormGroup);
											});
										</script>

									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- end Modal -->


					<!-- Tab nav -->
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
							<button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Konfirmasi Jadwal</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Terkonfirmasi</button>
						</li>
						<li class="nav-item" role="presentation">
							<button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane" type="button" role="tab" aria-controls="contact-tab-pane" aria-selected="false">Selesai</button>
						</li>

						<li class="nav-item" role="presentation">
							<button class="nav-link" id="cancel-tab" data-bs-toggle="tab" data-bs-target="#cancel-tab-pane" type="button" role="tab" aria-controls="cancel-tab-pane" aria-selected="false">Batal Hadir</button>
						</li>
					</ul>
					<div class="tab-content" id="myTabContent">

						<!-- tab jadwal konfirmasi -->
						<div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
							<div class="alert mt-3 mb-3 alert-warning alert-dismissible fade show" role="alert">
								<strong>Harap isi data dengan benar!</strong>, karena setelah data terkonfirmasi, data tidak bisa di ubah dan di hapus.
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
							</div>
							<div class=" table-responsive">
								<table id="list_jadwal" class="table table-striped" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Band</th>
											<th>Genre</th>
											<th>Tempat Manggung</th>
											<th>Alamat</th>
											<th>Tanggal</th>
											<th>Waktu</th>
											<th>Status</th>
											<th>Kontak Band</th>
											<th>#</th>
										</tr>
									</thead>
									<tbody>
										<?php if (!empty($list_jadwal)) : ?>
											<?php $no = 1; ?>
											<?php foreach ($list_jadwal as $data) : ?>
												<?php if ($data['status'] == 'Pending') { ?>
													<tr>
														<td><?= $no++; ?></td>
														<td><?= htmlspecialchars($data['nama_band']); ?></td>
														<td><?= htmlspecialchars($data['genre']); ?></td>
														<td><?= htmlspecialchars($data['nama_tempat_manggung']); ?></td>
														<td><?= htmlspecialchars($data['alamat']); ?>, <?= '', htmlspecialchars($data['kota_name']); ?>, <?= '', htmlspecialchars($data['provinsi_name']); ?> </td>
														<td><?= htmlspecialchars($data['date']); ?></td>
														<td><?= htmlspecialchars($data['time']); ?></td>
														<td>
															<?php if ($data['status'] == 'Pending') { ?>

																<span class="badge text-bg-warning"><?= htmlspecialchars($data['status']); ?></span>

															<?php } elseif ($data['status'] == 'Hadir') { ?>

																<span class="badge text-bg-success"><?= htmlspecialchars($data['status']); ?></span>

															<?php } else { ?>

																<span class="badge text-bg-danger"><?= htmlspecialchars($data['status']); ?></span>

															<?php } ?>

															<button type="button" class="badge text-bg-dark mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#ModalStatus">
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
																				<form method="post" action="<?= base_url('admin/dashboard/simpan_data_panggung') ?>" class="save-form">
																					<div id="form-container" style="max-height: 800px; overflow-y: auto;">
																						<div class="card mb-3 mt-3">
																							<div class="card-body">
																								<div class="modal-body" style="max-height: 500px; overflow-y: auto;">

																									<!-- Status -->
																									<div class="form-group mb-3">
																										<label for="city1" class="form-label">Status</label>
																										<select id="city1" name="kota[]" required class="city form-control">
																											<option value="Pending">Pending</option>
																											<option value="Hadir">Hadir</option>
																											<option value="Selesai">Selesai</option>
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

														</td>
														<td><?= htmlspecialchars($data['contact']); ?></td>
														<td>

															<div class="d-flex gap-3">
																<form method="post" action="<?= base_url('admin/dashboard/hapus_data_tempat_manggung') ?>" class="delete-form">
																	<input type="hidden" name="tempat_id[]" value="<?= $data['id_jadwal'] ?>" />
																	<button type="button" id="delete_button" class="btn btn-danger text-white"><i class="ph ph-trash"></i></button>
																</form>


																<!-- Edit Button -->
																<button class="btn btn-primary text-white"
																	data-bs-toggle="modal"
																	data-bs-target="#modalEditBand"
																	data-id="<?= $data['id_band'] ?>"
																	data-tempat="<?= htmlspecialchars($data['id_tempat_manggung']); ?>"
																	data-date="<?= htmlspecialchars($data['date']); ?>"
																	data-time="<?= htmlspecialchars($data['time']); ?>"
																	data-status="<?= htmlspecialchars($data['status']); ?>">
																	<i class="ph ph-pencil"></i>
																</button>


																<!-- Modal Edit Band -->
																<div class="modal fade" id="modalEditBand" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
																	<div class="modal-dialog modal-dialog-scrollable">
																		<div class="modal-content">
																			<div class="modal-header text-white" style="background:#800000">
																				<h1 class="modal-title fs-5" id="exampleModalLabel">Edit Data Tempat Manggung</h1>
																				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																			</div>

																			<div class="modal-body">
																				<div class="container">
																					<form method="post" action="<?= base_url('admin/dashboard/update_data_manggung') ?>" class="update-form">
																						<div id="form-container" style="max-height: 700px; overflow-y: auto;">
																							<input type="hidden" id="modalTempatIdField" name="id_tempat">
																							<div class="card mb-3 mt-3">
																								<div class="card-body">
																									<div class="modal-body" style="max-height: 400px; overflow-y: auto;">
																										<div class="form-group mb-3">
																											<label for="namaTempat" class="form-label">Nama Tempat</label>
																											<input type="text" required name="nama_tempat_edit" class="form-control" id="namaTempat">
																										</div>

																										<div class="input-group mb-3">
																											<label class="input-group-text" for="provinsi">Provinsi</label>
																											<select class="form-select province" required name="provinsi_edit" id="province2">
																												<option value="<?= htmlspecialchars($data['provinsi_name']) ?>"><?= htmlspecialchars($data['provinsi_name']) ?></option>
																											</select>
																										</div>

																										<div class="input-group mb-3">
																											<label class="input-group-text" for="kota">Kota</label>
																											<select class="form-select city" required name="kota_edit" id="city2">
																												<option value="<?= htmlspecialchars($data['kota_name']) ?>"><?= htmlspecialchars($data['kota_name']) ?></option>
																											</select>
																										</div>

																										<div class="form-group mb-3">
																											<label for="alamat" class="form-label">Alamat</label>
																											<input type="text" required name="alamat_edit" class="form-control" id="alamat">
																										</div>

																										<div class="form-group mb-3">
																											<label for="contact" class="form-label">No Telepon</label>
																											<input type="number" required name="contact_edit" class="form-control" id="contact">
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
																<!-- End Modal Edit Band -->

																<script>
																	// JavaScript untuk mengisi modal secara dinamis
																	document.addEventListener('DOMContentLoaded', function() {
																		const editButtons = document.querySelectorAll('[data-bs-target="#modalEditBand"]');

																		editButtons.forEach(function(button) {
																			button.addEventListener('click', function() {
																				const bandId = button.getAttribute('data-id');
																				const tempatId = button.getAttribute('data-tempat');
																				const date = button.getAttribute('data-date');
																				const time = button.getAttribute('data-time');
																				const status = button.getAttribute('data-status');

																				// Isi field di dalam modal dengan data yang diambil
																				document.getElementById('modalBandIdField').value = bandId;
																				document.getElementById('tempatManggung').value = tempatId;
																				document.getElementById('tanggal').value = date;
																				document.getElementById('waktu').value = time;
																				document.getElementById('status').value = status;
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

									<tfoot>
										<tr>
											<th>No</th>
											<th>Nama Band</th>
											<th>Genre</th>
											<th>Tempat Manggung</th>
											<th>Alamat</th>
											<th>Tanggal</th>
											<th>Waktu</th>
											<th>Status</th>
											<th>Kontak Band</th>
											<th>#</th>
										</tr>
									</tfoot>
								</table>

							</div>
						</div>
						<!-- tab jadwal terkonfirmasi -->
						<div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
							<div class=" table-responsive">
								<table id="list_jadwal" class="table table-striped" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Band</th>
											<th>Genre</th>
											<th>Tempat Manggung</th>
											<th>Alamat</th>
											<th>Tanggal</th>
											<th>Waktu</th>
											<th>Status</th>
											<th>Kontak Band</th>

										</tr>
									</thead>
									<tbody>
										<?php if (!empty($list_jadwal)) : ?>
											<?php $no = 1; ?>
											<?php foreach ($list_jadwal as $data) : ?>
												<?php if ($data['status'] == 'Hadir') { ?>
													<tr>
														<td><?= $no++; ?></td>
														<td><?= htmlspecialchars($data['nama_band']); ?></td>
														<td><?= htmlspecialchars($data['genre']); ?></td>
														<td><?= htmlspecialchars($data['nama_tempat_manggung']); ?></td>
														<td><?= htmlspecialchars($data['alamat']); ?>, <?= '', htmlspecialchars($data['kota_name']); ?>, <?= '', htmlspecialchars($data['provinsi_name']); ?> </td>
														<td><?= htmlspecialchars($data['date']); ?></td>
														<td><?= htmlspecialchars($data['time']); ?></td>
														<td>
															<?php if ($data['status'] == 'Pending') { ?>

																<span class="badge text-bg-warning"><?= htmlspecialchars($data['status']); ?></span>

															<?php } elseif ($data['status'] == 'Hadir') { ?>

																<span class="badge text-bg-success"><?= htmlspecialchars($data['status']); ?></span>

															<?php } else { ?>

																<span class="badge text-bg-danger"><?= htmlspecialchars($data['status']); ?></span>

															<?php } ?>

															<button type="button" class="badge text-bg-dark mb-3 mt-3" data-bs-toggle="modal" data-bs-target="#ModalStatus2">
																Ubah status <i class="ph ph-pencil"></i>
															</button>
															<!-- Modal ubah status -->
															<div class="modal fade" id="ModalStatus2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
																<div class="modal-dialog modal-dialog-centered  modal-dialog-scrollable">
																	<div class="modal-content">
																		<div class="modal-header text-white" style="background:#800000">
																			<h1 class="modal-title fs-5" id="exampleModalLabel">Ubah Status Jadwal</h1>
																			<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
																		</div>

																		<div class="modal-body">
																			<div class="container">
																				<form method="post" action="<?= base_url('admin/dashboard/simpan_data_panggung') ?>" class="save-form">
																					<div id="form-container" style="max-height: 800px; overflow-y: auto;">
																						<div class="card mb-3 mt-3">
																							<div class="card-body">
																								<div class="modal-body" style="max-height: 500px; overflow-y: auto;">

																									<!-- Status -->
																									<div class="form-group mb-3">
																										<label for="city1" class="form-label">Status</label>
																										<select id="city1" name="kota[]" required class="city form-control">
																											<option value="Pending">Pending</option>
																											<option value="Hadir">Hadir</option>
																											<option value="Selesai">Selesai</option>
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

														</td>
														<td><?= htmlspecialchars($data['contact']); ?></td>

													</tr>
												<?php } ?>
											<?php endforeach; ?>
										<?php else : ?>
											<tr>
												<td colspan="5" class="text-center">Tidak ada data tempat manggung yang tersedia.</td>
											</tr>
										<?php endif; ?>
									</tbody>

									<tfoot>
										<tr>
											<th>No</th>
											<th>Nama Band</th>
											<th>Genre</th>
											<th>Tempat Manggung</th>
											<th>Alamat</th>
											<th>Tanggal</th>
											<th>Waktu</th>
											<th>Status</th>
											<th>Kontak Band</th>

										</tr>
									</tfoot>
								</table>

							</div>
						</div>
						<!-- tab jadwal selesai -->
						<div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab" tabindex="0">
							<div class=" table-responsive">
								<table id="list_jadwal" class="table table-striped" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Band</th>
											<th>Genre</th>
											<th>Tempat Manggung</th>
											<th>Alamat</th>
											<th>Tanggal</th>
											<th>Waktu</th>
											<th>Status</th>
											<th>Kontak Band</th>

										</tr>
									</thead>
									<tbody>
										<?php if (!empty($list_jadwal)) : ?>
											<?php $no = 1; ?>
											<?php foreach ($list_jadwal as $data) : ?>
												<?php if ($data['status'] == 'Selesai') { ?>
													<tr>
														<td><?= $no++; ?></td>
														<td><?= htmlspecialchars($data['nama_band']); ?></td>
														<td><?= htmlspecialchars($data['genre']); ?></td>
														<td><?= htmlspecialchars($data['nama_tempat_manggung']); ?></td>
														<td><?= htmlspecialchars($data['alamat']); ?>, <?= '', htmlspecialchars($data['kota_name']); ?>, <?= '', htmlspecialchars($data['provinsi_name']); ?> </td>
														<td><?= htmlspecialchars($data['date']); ?></td>
														<td><?= htmlspecialchars($data['time']); ?></td>
														<td>
															<?php if ($data['status'] == 'Pending') { ?>

																<span class="badge text-bg-warning"><?= htmlspecialchars($data['status']); ?></span>

															<?php } elseif ($data['status'] == 'Hadir') { ?>

																<span class="badge text-bg-success"><?= htmlspecialchars($data['status']); ?></span>

															<?php } else { ?>

																<span class="badge text-bg-danger"><?= htmlspecialchars($data['status']); ?></span>

															<?php } ?>

														</td>
														<td><?= htmlspecialchars($data['contact']); ?></td>

													</tr>
												<?php } ?>
											<?php endforeach; ?>
										<?php else : ?>
											<tr>
												<td colspan="5" class="text-center">Tidak ada data tempat manggung yang tersedia.</td>
											</tr>
										<?php endif; ?>
									</tbody>

									<tfoot>
										<tr>
											<th>No</th>
											<th>Nama Band</th>
											<th>Genre</th>
											<th>Tempat Manggung</th>
											<th>Alamat</th>
											<th>Tanggal</th>
											<th>Waktu</th>
											<th>Status</th>
											<th>Kontak Band</th>

										</tr>
									</tfoot>
								</table>

							</div>
						</div>
						<!-- tab jadwal batal hadir -->
						<div class="tab-pane fade" id="cancel-tab-pane" role="tabpanel" aria-labelledby="cancel-tab" tabindex="0">
							<div class=" table-responsive">
								<table id="list_jadwal" class="table table-striped" style="width:100%">
									<thead>
										<tr>
											<th>No</th>
											<th>Nama Band</th>
											<th>Genre</th>
											<th>Tempat Manggung</th>
											<th>Alamat</th>
											<th>Tanggal</th>
											<th>Waktu</th>
											<th>Status</th>
											<th>Kontak Band</th>

										</tr>
									</thead>
									<tbody>
										<?php if (!empty($list_jadwal)) : ?>
											<?php $no = 1; ?>
											<?php foreach ($list_jadwal as $data) : ?>
												<?php if ($data['status'] == 'Batal hadir') { ?>
													<tr>
														<td><?= $no++; ?></td>
														<td><?= htmlspecialchars($data['nama_band']); ?></td>
														<td><?= htmlspecialchars($data['genre']); ?></td>
														<td><?= htmlspecialchars($data['nama_tempat_manggung']); ?></td>
														<td><?= htmlspecialchars($data['alamat']); ?>, <?= '', htmlspecialchars($data['kota_name']); ?>, <?= '', htmlspecialchars($data['provinsi_name']); ?> </td>
														<td><?= htmlspecialchars($data['date']); ?></td>
														<td><?= htmlspecialchars($data['time']); ?></td>
														<td>
															<?php if ($data['status'] == 'Pending') { ?>

																<span class="badge text-bg-warning"><?= htmlspecialchars($data['status']); ?></span>

															<?php } elseif ($data['status'] == 'Hadir') { ?>

																<span class="badge text-bg-success"><?= htmlspecialchars($data['status']); ?></span>

															<?php } else { ?>

																<span class="badge text-bg-danger"><?= htmlspecialchars($data['status']); ?></span>

															<?php } ?>

														</td>
														<td><?= htmlspecialchars($data['contact']); ?></td>

													</tr>
												<?php } ?>
											<?php endforeach; ?>
										<?php else : ?>
											<tr>
												<td colspan="5" class="text-center">Tidak ada data tempat manggung yang tersedia.</td>
											</tr>
										<?php endif; ?>
									</tbody>

									<tfoot>
										<tr>
											<th>No</th>
											<th>Nama Band</th>
											<th>Genre</th>
											<th>Tempat Manggung</th>
											<th>Alamat</th>
											<th>Tanggal</th>
											<th>Waktu</th>
											<th>Status</th>
											<th>Kontak Band</th>

										</tr>
									</tfoot>
								</table>

							</div>
						</div>

					</div>



				</div>
			</div>
		</div>

	</div>

</div>


<script>
	// DELETE ALERT
	document.querySelectorAll('.delete-form').forEach(form => {
		form.querySelector('#delete_button').addEventListener('click', function() {
			Swal.fire({
				title: 'Apakah anda yakin?',
				text: 'Kamu akan menghapus data',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, hapus data!',
				cancelButtonText: 'Tidak, batal hapus!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					// Submit the form if confirmed
					form.submit();

					// Success alert can be added after form submission using session flash messages
					Swal.fire(
						'Dihapus!',
						'Data Anda telah berhasil dihapus.',
						'success'
					);
				} else {
					Swal.fire('Dibatalkan', 'Data anda tetap aman :)', 'error'); // Cancel the deletion
				}
			});
		});
	});


	// SAVE ALERT //
	document.querySelectorAll('.save-form').forEach(form => {
		form.addEventListener('submit', function(e) {
			e.preventDefault();
			Swal.fire({
				title: 'Apakah anda yakin?',
				text: 'Kamu akan menyimpan data panggung',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, simpan data panggung!',
				cancelButtonText: 'Tidak, batal simpan data panggung!',
				reverseButtons: true
			}).then((result) => {
				if (result.isConfirmed) {
					// Submit the form if confirmed
					form.submit();
					Swal.fire(
						'Disimpan!',
						'Data Anda telah berhasil disimpan.',
						'success'
					);
				} else {
					Swal.fire('Dibatalkan', 'Data panggung batal ditambahkan :)',
						'error'); // Cancel the deletion
				}
			});
		});
	});
	// END SAVE ALERT //


	// UPDATE ALERT //
	document.querySelectorAll('.update-form').forEach(form => {
		form.addEventListener('submit', function(e) {
			e.preventDefault();
			Swal.fire({
				title: 'Apakah anda yakin?',
				text: 'Kamu akan update data band',
				icon: 'warning',
				showCancelButton: true,
				confirmButtonText: 'Ya, update data tempat manggung!',
				cancelButtonText: 'Tidak, batal update data band!',
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
					Swal.fire('Dibatalkan', 'Data tempat manggung batal di update :)',
						'error'); // Cancel the deletion
				}
			});
		});
	});
	// END SAVE ALERT //


	document.addEventListener('DOMContentLoaded', function() {
		// Attach event listener to all "Edit" buttons
		document.querySelectorAll('[data-bs-toggle="modal"]').forEach(button => {
			button.addEventListener('click', function() {
				const bandId = this.getAttribute('data-band-id'); // Get the band ID from the button
				console.log('Band ID:', bandId); // For debugging

				// Now you can use the bandId to fetch more details about the band or populate modal fields
				// Example: Set the value of a hidden field inside the modal
				document.getElementById('modalBandIdField').value = bandId;

				// Optionally, make an AJAX request to get more details about the band based on the ID
			});
		});
	});
</script>


<script>
	// JavaScript to populate the modal dynamically
	document.addEventListener('DOMContentLoaded', function() {
		var editButtons = document.querySelectorAll('[data-bs-target="#modalEditBand"]');

		editButtons.forEach(function(button) {
			button.addEventListener('click', function() {
				var bandId = button.getAttribute('data-id');
				var bandName = button.getAttribute('data-name');
				var bandGenre = button.getAttribute('data-genre');
				var bandContact = button.getAttribute('data-contact');

				// Populate the modal fields with the clicked band's data
				document.getElementById('modalBandIdField').value = bandId;
				document.getElementById('namaBand').value = bandName;
				document.getElementById('genre-option').value = bandGenre;
				document.getElementById('contact').value = bandContact;
			});
		});
	});
</script>