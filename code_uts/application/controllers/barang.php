<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class barang extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('barang_model');
        
    }
    
    public function index($id)
    {
        $data['barang'] = $this->barang_model->getbarang($id);
        $this->load->view('view_barang',$data);
        
    }

   public function create(){
		$this->validation();
		if($this->form_validation->run()==FALSE){
			$this->load->model('kategori_model');
			$data['data_kategori']= $this->kategori_model->getKategori();
			
			$this->load->view('tambah_barang',$data);
			
		}else{
			$config['upload_path']          = './assets/upload/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1000000000;
			$config['max_width']            = 10240;
			$config['max_height']           = 7680;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('foto')){
					$error = array('error' => $this->upload->display_errors());
					var_dump($error);
					//$this->load->view('tambah_pegawai_view',$error);
			} else {
					$this->barang_model->insertbarang();
					$this->session->set_flashdata('pesan', 'Tambah Data Barang Berhasil  ');
					redirect('kategori/index/');
			}
			
			
		}

		
	}
	public function update($id_barang,$id)
	{
		$this->validation();
		
		$this->load->model('kategori_model');

		$data['data_kategori']= $this->kategori_model->getKategori();
		$data['kategori']=$this->barang_model->getbarangById($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_barang',$data);

		}else{
			$config['upload_path']          = './assets/upload/';
			$config['allowed_types']        = 'gif|jpg|png';
			$config['max_size']             = 1000000000;
			$config['max_width']            = 10240;
			$config['max_height']           = 7680;

			$this->load->library('upload', $config);

			if ( ! $this->upload->do_upload('foto')){
					$error = array('error' => $this->upload->display_errors());
					var_dump($error);
					//$this->load->view('tambah_pegawai_view',$error);
			} else {
					$this->barang_model->updateById($id);
					$this->session->set_flashdata('pesan', 'Ubah Data Kategori '.$id. ' Berhasil ');
					redirect('barang/index/'.$id_barang);
			}
			
		}
	}
	public function delete($id_barang,$id){
		$this->barang_model->delete($id);
		redirect('barang/index/'.$id_barang);
		
	}
	public function detail($id_barang,$id){
		$data['kategori'] = $this->barang_model->getbarangById($id);
        $this->load->view('detail',$data);
	}
    public function validation(){
		//load library	
		$this->form_validation->set_rules('nama', 'Nama', 'alpha|trim|required');
		$this->form_validation->set_rules('kode', 'Kode', 'numeric|trim|required|is_unique[barang.kode]');
		$this->form_validation->set_rules('tanggal_beli', 'Tanggal Beli', 'trim|required');
		$this->form_validation->set_rules('fk_kategori', 'kategori', 'trim|required');
	}

}

/* End of file Controllername.php */
