<?php
defined('BASEPATH') or exit('No direct script access allowed');

class TempatManggungModel extends CI_Model
{

	// Insert multiple rows into the database
	public function insertTempatManggung($data)
	{
		$this->db->insert_batch('tempat_manggung', $data); // 'bands' is the table name
	}

	public function get_all_tempat_manggung()
	{
		// Mengambil semua data dari tabel 'band' dan mengurutkan berdasarkan 'id_band' secara menurun (DESC)
		$this->db->order_by('id_tempat_manggung', 'DESC');
		$query = $this->db->get('tempat_manggung');

		if (!$query) {
			echo ("<script>alert('data kosong')</script>");
		} else {
			return $query->result_array(); // Mengembalikan hasil dalam bentuk array
		}
	}


	public function getTempatManggungById($band_id)
	{
		$this->db->where('id_tempat_manggung', $band_id);  // Assuming the column name is id_band
		$query = $this->db->get('tempat_manggung'); // 'bands' is the table name
		if ($query->num_rows() > 0) {
			return $query->row_array(); // Fetch single row as an associative array
		} else {
			return null; // Return null if no record found
		}
	}


	public function updateTempatManggung($tempat_id, $data)
	{
		// Update the data in the database where band_id matches
		$this->db->where('id_tempat_manggung', $tempat_id);
		return $this->db->update('tempat_manggung	', $data); // Assuming 'bands' is your table name
	}

	public function deleteTempatmanggung($tempat_id)
	{
		// Ensure $band_ids is an array
		if (is_array($tempat_id)) {
			$this->db->where_in('id_tempat_manggung', $tempat_id); // Assuming 'id_band' is the primary key
			return $this->db->delete('tempat_manggung'); // 'bands' is the name of the table
		}
		return false;
	}
}
