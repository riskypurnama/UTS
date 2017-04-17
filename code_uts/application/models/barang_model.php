<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang_model extends CI_Model {

        public function __construct()
		{
			parent::__construct();
			//Do your magic here
		}	

		public function getbarang($id)
		{
			$this->db->where('fk_kategori',$id);
			$query = $this->db->get('barang');
			return $query->result();
		}

		public function insertbarang()
		{
			$object = array(
				'nama' => $this->input->post('nama'),
                'kode' => $this->input->post('kode'),
                'tanggal_beli' => $this->input->post('tanggal_beli'),
                'foto' => $this->upload->data('file_name'),
                'fk_kategori' => $this->input->post('fk_kategori'),
				);
			$this->db->insert('barang', $object);
		}


		public function getbarangById($id)
		{
			$this->db->where('id', $id);	
			$query = $this->db->get('barang',1);
			return $query->result();

		}

		public function updateById($id)
		{
			$object = array(
				'nama' => $this->input->post('nama'),
                'kode' => $this->input->post('kode'),
                'tanggal_beli' => $this->input->post('tanggal_beli'),
                'foto' => $this->upload->data('file_name'),
                'fk_kategori' => $this->input->post('fk_kategori')
				);
			$this->db->where('id', $id);
			$this->db->update('barang', $object);
		}
		
		public function delete($id){
			$this->db->where('id',$id);
			$this->db->delete('barang');
		}    

}

/* End of file barang_model.php */
