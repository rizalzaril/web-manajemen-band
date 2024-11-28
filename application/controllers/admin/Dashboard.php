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
	}



	// ********************** REGISTER ADMIN ***************** \\

	public function index()
	{
		$this->load->view('admin/dashboard/header');
		$this->load->view('admin/dashboard/navheader');
		$this->load->view('admin/dashboard/sidebar');
		$this->load->view('admin/dashboard/content');
		$this->load->view('admin/dashboard/footer');
	}

	public function list_jadwal()
	{
		$this->load->view('admin/dashboard/header');
		$this->load->view('admin/dashboard/navheader');
		$this->load->view('admin/dashboard/sidebar');
		$this->load->view('admin/jadwal/listJadwal');
		$this->load->view('admin/dashboard/footer');
	}

	public function list_band()
	{


		$data_band['list_band'] = $this->BandModel->get_all_bands();

		// echo '<pre>';
		// print_r($data_band);
		// echo '</pre>';
		// exit(); // Stop script execution

		$this->load->view('admin/dashboard/header');
		$this->load->view('admin/dashboard/navheader');
		$this->load->view('admin/dashboard/sidebar');
		$this->load->view('admin/band/listBand', $data_band);
		$this->load->view('admin/dashboard/footer');
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
				$this->session->set_flashdata('error', 'Failed to save data. Please try again.');
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
		$this->load->view('admin/dashboard/header');
		$this->load->view('admin/dashboard/navheader');
		$this->load->view('admin/dashboard/sidebar');
		$this->load->view('admin/band/listBand', $data);
		$this->load->view('admin/dashboard/footer');
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
}
