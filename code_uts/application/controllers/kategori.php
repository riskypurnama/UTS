<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class kategori extends CI_Controller {

    
    public function __construct()
    {
        parent::__construct();
        
        $this->load->model('kategori_model');
        
    }
    
    public function index()
    {
        $data['kategori'] = $this->kategori_model->getKategori();
        $this->load->view('view_kategori',$data);
        
    }

   public function create(){
		$this->validation();
		if($this->form_validation->run()==FALSE){
			
			$this->load->view('tambah_kategori');
			
		}else{
			
			$this->kategori_model->insertkategori();
			$this->session->set_flashdata('pesan', 'Tambah Data Kategori Berhasil  ');
			redirect('kategori/index/');
			
		}

		
	}
	public function update($id)
	{
		$this->validation();
		$data['kategori']=$this->kategori_model->getKategoriById($id);
		//skeleton code
		if($this->form_validation->run()==FALSE){

		//setelah load data dikirim ke view
			$this->load->view('edit_kategori',$data);

		}else{
			$this->kategori_model->updateById($id);
			$this->session->set_flashdata('pesan', 'Ubah Data Kategori '.$id. ' Berhasil ');
			redirect('kategori/index/');
		}
	}
	public function delete($id){
		$this->kategori_model->delete($id);
		redirect('kategori/index/');
		
	}
    public function validation(){
		//load library	
		$this->form_validation->set_rules('nama', 'Nama', 'alpha|trim|required');
	}

}

/* End of file Controllername.php */
