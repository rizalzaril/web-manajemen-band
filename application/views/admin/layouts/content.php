<style>
	.calendar {
		margin: 20px auto;
		max-width: 800px;
	}

	.calendar-header {
		display: flex;
		justify-content: space-between;
		padding: 10px;
		background-color: #f8f9fa;
	}

	.calendar-header h3 {
		margin: 0;
	}

	.calendar-days {
		display: grid;
		grid-template-columns: repeat(7, 1fr);
		background-color: #f1f1f1;
		padding: 10px 0;
	}

	.calendar-days div {
		text-align: center;
		font-weight: bold;
		padding: 10px;
		background-color: #e9ecef;
	}

	.calendar-dates {
		display: grid;
		grid-template-columns: repeat(7, 1fr);
	}

	.calendar-dates div {
		text-align: center;
		padding: 10px;
		cursor: pointer;
	}

	.calendar-dates div:hover {
		background-color: #e9ecef;
	}

	.empty {
		background-color: transparent;
	}

	.today {
		background-color: #4caf50;
		color: white;
	}

	/* Activities Section */
	.activities {
		background-color: #f8f9fa;
		padding: 10px;
		margin-top: 10px;
	}

	.activity-list {
		list-style-type: none;
		padding-left: 0;
	}

	.activity-list li {
		background-color: #e9ecef;
		padding: 5px;
		margin-bottom: 5px;
		border-radius: 5px;
	}
</style>









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


		<div class="calendar">
			<!-- Calendar Header -->
			<div class="calendar-header">
				<button class="btn btn-outline-secondary" onclick="navigateWeek(-1)">Prev</button>
				<h3 id="week-title"></h3>
				<button class="btn btn-outline-secondary" onclick="navigateWeek(1)">Next</button>
			</div>

			<!-- Calendar Days (Weekdays) -->
			<div class="calendar-days">
				<div>Sun</div>
				<div>Mon</div>
				<div>Tue</div>
				<div>Wed</div>
				<div>Thu</div>
				<div>Fri</div>
				<div>Sat</div>
			</div>

			<!-- Calendar Dates (Dynamic) -->
			<div class="calendar-dates" id="calendar-dates"></div>

			<!-- Activities Section (Display All Activities for the Week) -->
			<div class="activities" id="activities">
				<h5>Jadwal band of the week</h5>
				<ul id="activity-list" class="activity-list"></ul>
			</div>
		</div>


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
<!-- 
<script>
	let currentDate = new Date();

	// Example activities for the current week
	const activitiesData = {
		"2024-11-24": ["Attend team meeting", "Write reports"],
		"2024-11-25": ["Doctor's appointment", "Work on project"],
		"2024-11-26": ["Yoga session", "Conference call"],
		"2024-11-27": ["Submit assignments", "Family dinner"],
		"2024-11-28": ["Review tasks", "Attend webinar"],
		"2024-11-29": ["Weekend trip", "Catch up with friends"],
		"2024-11-30": ["Weekend hike", "Watch movie"],
		"2024-11-17": ["Old activity", "Past event"]
	};

	// Function to get the start of the week (Sunday)
	function getStartOfWeek(date) {
		let day = date.getDay(),
			diff = date.getDate() - day; // Adjust to Sunday
		return new Date(date.setDate(diff));
	}

	// Function to get the end of the week (Saturday)
	function getEndOfWeek(date) {
		let day = date.getDay(),
			diff = date.getDate() + (6 - day); // Adjust to Saturday
		return new Date(date.setDate(diff));
	}

	// Function to display the current week
	function displayWeek(weekStartDate) {
		let calendarDatesDiv = document.getElementById('calendar-dates');
		let weekTitle = document.getElementById('week-title');
		let activityList = document.getElementById('activity-list');

		// Clear the existing dates and activities
		calendarDatesDiv.innerHTML = '';
		activityList.innerHTML = '';

		let startOfWeek = new Date(weekStartDate);
		let endOfWeek = getEndOfWeek(new Date(startOfWeek));
		weekTitle.textContent = `${startOfWeek.toLocaleDateString()} - ${endOfWeek.toLocaleDateString()}`;

		// Generate calendar dates and display activities for the week
		for (let i = 0; i < 7; i++) {
			let currentDay = new Date(startOfWeek);
			currentDay.setDate(startOfWeek.getDate() + i);

			let dayDiv = document.createElement('div');
			dayDiv.textContent = currentDay.getDate();
			dayDiv.dataset.date = currentDay.toISOString().split('T')[0]; // Store date in ISO format

			// Highlight today's date
			if (currentDay.toDateString() === new Date().toDateString()) {
				dayDiv.classList.add('today');
			}

			calendarDatesDiv.appendChild(dayDiv);

			// Display activities for each day of the week if they belong to the current week
			let dateString = currentDay.toISOString().split('T')[0];
			if (activitiesData[dateString]) {
				activitiesData[dateString].forEach(activity => {
					let li = document.createElement('li');
					li.textContent = `Day ${currentDay.getDate()} - ${activity}`;
					activityList.appendChild(li);
				});
			}
		}
	}

	// Navigate to the previous or next week
	function navigateWeek(offset) {
		currentDate.setDate(currentDate.getDate() + offset * 7);
		let startOfWeek = getStartOfWeek(new Date(currentDate));
		displayWeek(startOfWeek);
	}

	// Display the current week when the page loads
	displayWeek(getStartOfWeek(new Date()));
</script> -->



<script>
	let currentDate = new Date();

	// Example activities for the current week (from PHP data)
	const activitiesData = <?= json_encode($jadwal); ?>;

	// Function to get the start of the week (Sunday)
	function getStartOfWeek(date) {
		let day = date.getDay(),
			diff = date.getDate() - day; // Adjust to Sunday
		return new Date(date.setDate(diff));
	}

	// Function to get the end of the week (Saturday)
	function getEndOfWeek(date) {
		let day = date.getDay(),
			diff = date.getDate() + (6 - day); // Adjust to Saturday
		return new Date(date.setDate(diff));
	}

	// Function to display the current week
	function displayWeek(weekStartDate) {
		let calendarDatesDiv = document.getElementById('calendar-dates');
		let weekTitle = document.getElementById('week-title');
		let activityList = document.getElementById('activity-list');

		// Clear the existing dates and activities
		calendarDatesDiv.innerHTML = '';
		activityList.innerHTML = '';

		let startOfWeek = new Date(weekStartDate);
		let endOfWeek = getEndOfWeek(new Date(startOfWeek));
		weekTitle.textContent = `${startOfWeek.toLocaleDateString()} - ${endOfWeek.toLocaleDateString()}`;

		// Generate calendar dates and display activities for the week
		for (let i = 0; i < 7; i++) {
			let currentDay = new Date(startOfWeek);
			currentDay.setDate(startOfWeek.getDate() + i);

			let dayDiv = document.createElement('div');
			dayDiv.textContent = currentDay.getDate();
			dayDiv.dataset.date = currentDay.toISOString().split('T')[0]; // Store date in ISO format

			// Highlight today's date
			if (currentDay.toDateString() === new Date().toDateString()) {
				dayDiv.classList.add('today');
			}

			calendarDatesDiv.appendChild(dayDiv);

			// Check if there's any activity for this day
			let dateString = currentDay.toISOString().split('T')[0];
			let activitiesForDay = activitiesData.filter(activity => activity.date === dateString);

			// Display activities for the current day with date
			activitiesForDay.forEach(activity => {
				let li = document.createElement('li');
				li.textContent = `Tanggal: ${currentDay.toLocaleDateString()} - Band: ${activity.nama_band}, Konser: ${activity.nama_konser} at ${activity.nama_tempat_manggung}`;
				activityList.appendChild(li);
			});
		}
	}

	// Navigate to the previous or next week
	function navigateWeek(offset) {
		currentDate.setDate(currentDate.getDate() + offset * 7);
		let startOfWeek = getStartOfWeek(new Date(currentDate));
		displayWeek(startOfWeek);
	}

	// Display the current week when the page loads
	displayWeek(getStartOfWeek(new Date()));
</script>