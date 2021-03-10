<?php
class Store extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Store_Model', 'storeModel');

        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('error', 'Anda Harus Login.');
            redirect('login');
        }
    }
    public function storeIndex()
    {
        $data['store'] = $this->storeModel->getAll();
        $data['join_store'] = $this->storeModel->join_all();
        $this->load->view('admin/component/header');
        $this->load->view('admin/component/top');
        $this->load->view('admin/component/menu');
        $this->load->view('admin/modul/store/index', $data);
        $this->load->view('admin/component/footer');
    }
    public function storeTambah()
    {
        $data['store'] = $this->storeModel->getAll();
        $this->load->view('admin/component/header');
        $this->load->view('admin/component/top');
        $this->load->view('admin/component/menu');
        $this->load->view('admin/modul/store/tambah', $data);
        $this->load->view('admin/component/footer');
    }
    public function storeSave()
    {
        $this->storeModel->save($_POST);
        $this->session->set_flashdata('pesan', '<div class="alert alert-succes alert-dismissible fade show" role="alert">
        Data Berhasil Ditambahkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        // var_dump($_POST);
        // exit;
        redirect('admin/store');
    }
}
