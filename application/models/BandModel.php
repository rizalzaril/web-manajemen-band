<?php
defined('BASEPATH') or exit('No direct script access allowed');

class BandModel extends CI_Model
{

	// Insert multiple rows into the database
	public function insertBatch($data)
	{
		$this->db->insert_batch('band', $data); // 'bands' is the table name
	}

	public function get_all_bands()
	{
		// Mengambil semua data dari tabel 'band' dan mengurutkan berdasarkan 'id_band' secara menurun (DESC)
		$this->db->order_by('id_band', 'DESC');
		$query = $this->db->get('band');

		if (!$query) {
			echo ("<script>alert('data kosong')</script>");
		} else {
			return $query->result_array(); // Mengembalikan hasil dalam bentuk array
		}
	}

	public function get_band_count()
	{
		return $this->db->count_all('band'); // Ganti 'bands' dengan nama tabel Anda
	}

	public function getBandById($band_id)
	{
		$this->db->where('id_band', $band_id);  // Assuming the column name is id_band
		$query = $this->db->get('band'); // 'bands' is the table name
		if ($query->num_rows() > 0) {
			return $query->row_array(); // Fetch single row as an associative array
		} else {
			return null; // Return null if no record found
		}
	}


	public function updateBand($band_id, $data)
	{
		// Update the data in the database where band_id matches
		$this->db->where('id_band', $band_id);
		return $this->db->update('band	', $data); // Assuming 'bands' is your table name
	}

	public function deleteBatch($band_ids)
	{
		// Ensure $band_ids is an array
		if (is_array($band_ids)) {
			$this->db->where_in('id_band', $band_ids); // Assuming 'id_band' is the primary key
			return $this->db->delete('band'); // 'bands' is the name of the table
		}
		return false;
	}
}
