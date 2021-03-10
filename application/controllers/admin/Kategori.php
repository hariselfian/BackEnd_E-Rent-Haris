<?php
class Kategori extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Kategori_Model', 'kategoriModel');

        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('error', 'Anda Harus Login.');
            redirect('login');
        }
    }
    public function kategoriIndex()
    {
        $data['kategori'] = $this->kategoriModel->getAll();
        $this->load->view('admin/component/header');
        $this->load->view('admin/component/top');
        $this->load->view('admin/component/menu');
        $this->load->view('admin/modul/kategori/index', $data);
        $this->load->view('admin/component/footer');
    }
    public function kategoriTambah()
    {
        $data['kategori'] = $this->kategoriModel->getAll();
        $this->load->view('admin/component/header');
        $this->load->view('admin/component/top');
        $this->load->view('admin/component/menu');
        $this->load->view('admin/modul/kategori/tambah', $data);
        $this->load->view('admin/component/footer');
    }
    public function kategoriSave()
    {
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];
        if ($_FILES['gambar_']['size'] != 0) {
            $foto = $_FILES['gambar_']['name'];
            $filename = time()."-".$foto;
            move_uploaded_file($_FILES['gambar_']['tmp_name'], "api/gambar_kategori/$filename");
            $data['gambar_'] = $filename;
        }
        $this->kategoriModel->save($data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-succes alert-dismissible fade show" role="alert">
        Data Berhasil Ditambahkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        // var_dump($_POST);
        // exit;
        redirect('admin/kategori');
    }

    public function kategoriUpdate()
    {
        $id = $this->input->post('id_kategori');
        // 
        $row = $this->kategoriModel->getById($id);
        // var_dump($row);
        // exit;
        $data = [
            'nama_kategori' => $this->input->post('nama_kategori')
        ];
        if ($_FILES['gambar_']['size'] != 0) {
            unlink("api/gambar_kategori/" . $row['gambar_']);
            $foto = $_FILES['gambar_']['name'];
            $filename = time()."-".$foto;
            move_uploaded_file($_FILES['gambar_']['tmp_name'], "api/gambar_kategori/$filename");
            $data['gambar_'] = $filename;
        }

        $this->kategoriModel->update($id, $data);
        $this->session->set_flashdata('pesan', '<div class="alert alert-succes alert-dismissible fade show" role="alert">
        Data Berhasil Diedit
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');
        // var_dump($_POST);
        // exit;
        redirect('admin/kategori');
    }

    public function kategoriEdit($id)
    {
        $data['kategori'] = $this->kategoriModel->getById($id);
        $this->load->view('admin/component/header');
        $this->load->view('admin/component/top');
        $this->load->view('admin/component/menu');
        $this->load->view('admin/modul/kategori/edit', $data);
        $this->load->view('admin/component/footer');
    }

    public function kategoriDelete($id)
    {

        $row = $this->kategoriModel->getById($id);
        unlink("api/gambar_kategori/" . $row['gambar_']);

        $this->kategoriModel->delete($id);

        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Admin Berhasil DiHapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>');
        redirect('admin/kategori');
    }
}
