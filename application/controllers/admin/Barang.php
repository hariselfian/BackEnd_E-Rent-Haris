<?php
class Barang extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_Model', 'barangModel');

        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('error', 'Anda Harus Login.');
            redirect('login');
        }
    }
    public function barangIndex()
    {
        $data['barang'] = $this->barangModel->getAll();
        $data['join_barang'] = $this->barangModel->join_all();
        // var_dump($data['join_barang']);
        // exit;
        $this->load->view('admin/component/header');
        $this->load->view('admin/component/top');
        $this->load->view('admin/component/menu');
        $this->load->view('admin/modul/barang/index', $data);
        $this->load->view('admin/component/footer');
    }
    public function barangTambah()
    {
        $data['barang'] = $this->barangModel->getAll();
        $this->load->view('admin/component/header');
        $this->load->view('admin/component/top');
        $this->load->view('admin/component/menu');
        $this->load->view('admin/modul/barang/tambah', $data);
        $this->load->view('admin/component/footer');
    }
    public function barangSave()
    {
        $this->barangModel->save($_POST);
        $this->session->set_flashdata('pesan', '<div class="alert alert-succes alert-dismissible fade show" role="alert">
        Data Berhasil Ditambahkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        // var_dump($_POST);
        // exit;
        redirect('admin/barang');
    }
}
