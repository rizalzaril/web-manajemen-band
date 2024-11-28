<?php
defined('BASEPATH') or exit('No direct script access allowed');



class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct(); // Memanggil constructor bawaan CI_Controller
		$this->load->database(); // Memuat library database
		$this->load->library('session', 'database'); // Memuat library session (opsional, jika diperlukan)
		$this->load->helper('url'); // Memuat helper URL (opsional, jika diperlukan untuk redirect)
		$this->load->model('Users_model');
		$this->load->model('BandModel');
		$this->load->model('TempatManggungModel');
		$this->load->model('JadwalModel');
	}





	// ********************** REGISTER ADMIN ***************** \\

	public function index()
	{
		if ($this->session->userdata('id_user_admin') || $this->session->userdata('username')) {
			$id_user_admin = $this->session->userdata('id_user_admin'); //session

			$data['band_count'] = $this->BandModel->get_band_count();
			$data['panggung_count'] = $this->TempatManggungModel->get_count_tempat_manggung();

			$this->load->view('admin/layouts/header', $id_user_admin);
			$this->load->view('admin/layouts/navheader');
			$this->load->view('admin/layouts/sidebar');
			$this->load->view('admin/layouts/content', $data);
			$this->load->view('admin/layouts/footer');
		} else {
			echo "<script>
			alert('Anda harus Login untuk akses halaman ini!.');
			window.location.href = '" . base_url() . "'
		</script>"; // Redirect ke halaman login jika tidak ada session
		}
	}

	// ********************* BAND DATA CRUD FUCNTION *********************** \\

	public function list_band()
	{

		if ($this->session->userdata('id_user_admin') || $this->session->userdata('username')) {
			$data_band['list_band'] = $this->BandModel->get_all_bands();

			// echo '<pre>';
			// print_r($data_band);
			// echo '</pre>';
			// exit(); // Stop script execution
			$id_user_admin = $this->session->userdata('id_user_admin');

			$this->load->view('admin/layouts/header', $id_user_admin);
			$this->load->view('admin/layouts/navheader');
			$this->load->view('admin/layouts/sidebar');
			$this->load->view('admin/band/listBand', $data_band);
			$this->load->view('admin/layouts/footer');
		} else {
			echo "<script>
			alert('Anda harus Login untuk akses halaman ini!.');
			window.location.href = '" . base_url() . "'
		</script>"; // Redirect ke halaman login jika tidak ada session
		}
	}


	public function simpan_data_band()
	{
		// Retrieve the data from the form
		$nama_band = $this->input->post('nama_band'); // Array of band names
		$genre = $this->input->post('genre'); // Array of genre names
		$contact = $this->input->post('contact'); // Array of contact numbers

		// Prepare data for insertion
		$data = [];
		if (!empty($nama_band) && !empty($contact)) {
			foreach ($nama_band as $key => $name) {
				if (!empty($name) && !empty($contact[$key])) {
					$data[] = [
						'nama_band' => $name,
						'genre' => !empty($genre[$key]) ? $genre[$key] : null, // Default genre to null if empty
						'contact' => $contact[$key]
					];
				}
			}
		}

		// Save data using the model
		if (!empty($data)) {
			$this->load->model('BandModel'); // Ensure model is loaded
			$result = $this->BandModel->insertBatch($data);
			if ($result) {
				$this->session->set_flashdata('success', 'Data successfully saved!');
			} else {
				// $this->session->set_flashdata('error', 'Failed to save data. Please try again.');
			}
		} else {
			$this->session->set_flashdata('error', 'Failed to save data. Please fill in all fields.');
		}

		// Redirect to a specific page (e.g., form page)
		redirect('/admin/dashboard/list_band');
	}




	public function edit_band($band_id)
	{
		// Load the model
		$this->load->model('BandModel');

		// Fetch the band data by ID
		$band = $this->BandModel->getBandById($band_id);

		// Check if band exists
		if (!$band) {
			$this->session->set_flashdata('error', 'Band not found');
			redirect('/admin/dashboard/list_band');
		}

		// Pass the band data to the view
		$data['band'] = $band;
		$this->load->view('admin/layouts/header');
		$this->load->view('admin/layouts/navheader');
		$this->load->view('admin/layouts/sidebar');
		$this->load->view('admin/band/listBand', $data);
		$this->load->view('admin/layouts/footer');
	}



	public function update_data_band()
	{
		// Get the data from the form
		$band_id = $this->input->post('id_band');
		$nama_band = $this->input->post('nama_band');
		$genre = $this->input->post('genre');
		$contact = $this->input->post('contact');

		// Validate the data
		if (!empty($nama_band) && !empty($contact)) {
			// Prepare data for updating
			$data = [
				'nama_band' => $nama_band,
				'genre' => $genre,
				'contact' => $contact
			];

			// Load the model
			$this->load->model('BandModel');

			// Update the band data in the database
			$result = $this->BandModel->updateBand($band_id, $data);

			if ($result) {
				$this->session->set_flashdata('success', 'Band data updated successfully!');
			} else {
				$this->session->set_flashdata('error', 'Failed to update band data.');
			}
		} else {
			$this->session->set_flashdata('error', 'Please fill all the fields.');
		}

		// Redirect back to the list page
		redirect('/admin/dashboard/list_band');
	}




	public function hapus_data_band()
	{
		// Retrieve the band IDs to delete
		$band_ids = $this->input->post('band_ids'); // Array of band IDs to be deleted

		// Check if band IDs are provided
		if (!empty($band_ids)) {
			// Load the BandModel
			$this->load->model('BandModel');

			// Attempt to delete the bands by IDs
			$result = $this->BandModel->deleteBatch($band_ids);

			if ($result) {
				$this->session->set_flashdata('success', 'Data successfully deleted!');
			} else {
				$this->session->set_flashdata('error', 'Failed to delete data. Please try again.');
			}
		} else {
			$this->session->set_flashdata('error', 'No band IDs provided for deletion.');
		}

		// Redirect to the list page
		redirect('/admin/dashboard/list_band');
	}




	// ************************** SETTING TEMPAT MANGGUNG CRUD FUNCTION ********************** \\

	private $api_key = 'fadfcca283fa5c1162a55401d306842f';
	private $api_url = 'https://api.rajaongkir.com/starter/';

	// Ambil data provinsi
	public function province()
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "{$this->api_url}province",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: {$this->api_key}"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			// Kirimkan error sebagai JSON
			header('Content-Type: application/json');
			echo json_encode(['error' => $err]);
		} else {
			// Kirimkan response langsung dalam JSON
			header('Content-Type: application/json');
			echo $response;
		}
	}

	// Ambil data kota berdasarkan ID provinsi
	public function city($province_id)
	{
		$curl = curl_init();

		curl_setopt_array($curl, array(
			CURLOPT_URL => "{$this->api_url}city?province=" . $province_id,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 30,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "GET",
			CURLOPT_HTTPHEADER => array(
				"key: {$this->api_key}"
			),
		));

		$response = curl_exec($curl);
		$err = curl_error($curl);

		curl_close($curl);

		if ($err) {
			// Kirimkan error sebagai JSON
			header('Content-Type: application/json');
			echo json_encode(['error' => $err]);
		} else {
			// Kirimkan response langsung dalam JSON
			header('Content-Type: application/json');
			echo $response;
		}
	}

	// List Tempat Manggung with Optimized API Calls
	public function list_tempat_manggung()
	{

		if ($this->session->userdata('id_user_admin') || $this->session->userdata('username')) {
			$id_user_admin = $this->session->userdata('id_user_admin'); //session
			// Fetch the list of tempat_manggung from the model
			$data_tempat['list_tempat_manggung'] = $this->TempatManggungModel->get_all_tempat_manggung();

			// Fetch province and city names
			foreach ($data_tempat['list_tempat_manggung'] as &$tempat) {
				// Fetch Provinsi Name
				$tempat['provinsi_name'] = $this->get_provinsi_name($tempat['provinsi']);

				// Fetch Kota Name
				$tempat['kota_name'] = $this->get_kota_name($tempat['kota']);
			}

			// Load views as usual
			$this->load->view('admin/layouts/header', $id_user_admin);
			$this->load->view('admin/layouts/navheader');
			$this->load->view('admin/layouts/sidebar');
			$this->load->view('admin/tempat/listTempatManggung', $data_tempat);
			$this->load->view('admin/layouts/footer');
		} else {
			echo "<script>
			alert('Anda harus Login untuk akses halaman ini!.');
			window.location.href = '" . base_url() . "'
		</script>"; // Redirect ke halaman login jika tidak ada session
		}
	}

	// Fetch the cached or fresh data for provinsi or kota
	private function get_cached_data($type)
	{
		$cache_key = $type . '_data';
		// Check if data is cached
		$data = $this->session->userdata($cache_key);

		if (!$data) {
			// Make API call and cache the data
			$url = $this->api_url . $type;
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, ["key: {$this->api_key}"]);
			$response = curl_exec($ch);
			curl_close($ch);

			$data = json_decode($response, true);

			// Store data in session cache
			$this->session->set_userdata($cache_key, $data);
		}

		return $data;
	}

	// Get the name of the province by ID
	private function get_provinsi_name($provinsi_id)
	{
		$data = $this->get_cached_data('province');

		foreach ($data['rajaongkir']['results'] as $province) {
			if ($province['province_id'] == $provinsi_id) {
				return $province['province'];
			}
		}
		return null;
	}

	// Get the name of the city by ID
	private function get_kota_name($kota_id)
	{
		$data = $this->get_cached_data('city');

		foreach ($data['rajaongkir']['results'] as $city) {
			if ($city['city_id'] == $kota_id) {
				return $city['city_name'];
			}
		}
		return null;
	}

	// Save Tempat Manggung Data
	public function simpan_data_panggung()
	{
		// Retrieve the data from the form
		$nama_tempat = $this->input->post('nama_tempat');
		$provinsi = $this->input->post('provinsi');
		$kota = $this->input->post('kota');
		$alamat = $this->input->post('alamat');
		$contact = $this->input->post('contact');

		// Prepare data for insertion
		$data = [];
		if (!empty($nama_tempat) && !empty($contact)) {
			for ($i = 0; $i < count($nama_tempat); $i++) {
				if (!empty($nama_tempat[$i]) && !empty($contact[$i])) {
					$data[] = [
						'nama_tempat_manggung' => $nama_tempat[$i],
						'provinsi' => $provinsi[$i] ?? null,
						'kota' => $kota[$i] ?? null,
						'alamat' => $alamat[$i],
						'contact' => $contact[$i]
					];
				}
			}
		}

		// Bulk insert using the model
		if (!empty($data)) {
			$this->load->model('TempatManggungModel');
			$result = $this->TempatManggungModel->insertTempatManggung($data);

			if ($result) {
				$this->session->set_flashdata('success', 'Data successfully saved!');
			} else {
				// $this->session->set_flashdata('error', 'Failed to save data. Please try again.');
			}
		} else {
			$this->session->set_flashdata('error', 'Failed to save data. Please fill in all fields.');
		}

		redirect('/admin/dashboard/list_tempat_manggung');
	}


	public function update_data_manggung()
	{
		// Get the data from the form
		$tempat_id = $this->input->post('id_tempat');
		$nama_tempat = $this->input->post('nama_tempat_edit');
		$provinsi = $this->input->post('provinsi_edit');
		$kota = $this->input->post('kota_edit');
		$alamat = $this->input->post('alamat_edit');
		$contact = $this->input->post('contact_edit');

		// Validate the data
		if (!empty($nama_tempat) && !empty($contact)) {
			// Prepare data for updating
			$data = [
				'nama_tempat_manggung' => $nama_tempat,
				'provinsi' => $provinsi,
				'kota' => $kota,
				'alamat' => $alamat,
				'contact' => $contact
			];


			// Update the tempat data in the database
			$result = $this->TempatManggungModel->updateTempatManggung($tempat_id, $data);

			if ($result) {
				$this->session->set_flashdata('success', 'Tempat data updated successfully!');
			} else {
				$this->session->set_flashdata('error', 'Failed to update tempat data.');
			}
		} else {
			$this->session->set_flashdata('error', 'Please fill all the fields.');
		}

		// Redirect back to the list page
		redirect('/admin/dashboard/list_tempat_manggung');
	}



	public function hapus_data_tempat_manggung()
	{
		// Retrieve the band IDs to delete
		$tempat_id = $this->input->post('tempat_id'); // Array of band IDs to be deleted

		// Check if band IDs are provided
		if (!empty($tempat_id)) {



			// Attempt to delete the  by IDs
			$result = $this->TempatManggungModel->deleteTempatmanggung($tempat_id);

			if ($result) {
				// $this->session->set_flashdata('success', 'Data successfully deleted!');
			} else {
				$this->session->set_flashdata('error', 'Failed to delete data. Please try again.');
			}
		} else {
			$this->session->set_flashdata('error', 'No band IDs provided for deletion.');
		}

		// Redirect to the list page
		redirect('/admin/dashboard/list_tempat_manggung');
	}

	//  ************************* JADWAL CRUD FUNCTION ************************* \\

	public function list_jadwal()
	{

		if ($this->session->userdata('id_user_admin') || $this->session->userdata('username')) {
			$id_user_admin = $this->session->userdata('id_user_admin'); //session
			// Fetch the list of tempat_manggung from the model
			$data_jadwal['list_jadwal'] = $this->JadwalModel->get_all_jadwal();

			//Fetch province and city names
			foreach ($data_jadwal['list_jadwal'] as &$tempat) {
				// Fetch Provinsi Name
				$tempat['provinsi_name'] = $this->get_provinsi_name($tempat['provinsi']);

				// Fetch Kota Name
				$tempat['kota_name'] = $this->get_kota_name($tempat['kota']);
			}

			// Load views as usual
			$this->load->view('admin/layouts/header', $id_user_admin);
			$this->load->view('admin/layouts/navheader');
			$this->load->view('admin/layouts/sidebar');
			$this->load->view('admin/jadwal/listJadwal', $data_jadwal);
			$this->load->view('admin/layouts/footer');
		} else {
			echo "<script>
			alert('Anda harus Login untuk akses halaman ini!.');
			window.location.href = '" . base_url() . "'
		</script>"; // Redirect ke halaman login jika tidak ada session
		}
	}
}
