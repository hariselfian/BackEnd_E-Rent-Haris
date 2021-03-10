<?php
class Slider extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Slider_Model', 'sliderModel');

        if (!$this->session->userdata('username')) {
            $this->session->set_flashdata('error', 'Anda Harus Login.');
            redirect('login');
        }
    }
    public function sliderIndex()
    {
        $data['slider'] = $this->sliderModel->getAll();
        $this->load->view('admin/component/header');
        $this->load->view('admin/component/top');
        $this->load->view('admin/component/menu');
        $this->load->view('admin/modul/slider/index', $data);
        $this->load->view('admin/component/footer');
    }
    public function sliderTambah()
    {
        $data['slider'] = $this->sliderModel->getAll();
        $this->load->view('admin/component/header');
        $this->load->view('admin/component/top');
        $this->load->view('admin/component/menu');
        $this->load->view('admin/modul/slider/tambah', $data);
        $this->load->view('admin/component/footer');
    }
    public function sliderSave()
    {
        // pindakan gambar dengan helper
        if ($_FILES['img_slider']['size'] != 0) {
            $foto = $_FILES['img_slider']['name'];
            $filename = time()."-".$foto;
            move_uploaded_file($_FILES['img_slider']['tmp_name'], "api/slider/$filename");
            $data['img_slider'] = $filename;
        }
        $this->sliderModel->save($data);

        $this->session->set_flashdata('pesan', '<div class="alert alert-succes alert-dismissible fade show" role="alert">
        Data Berhasil Ditambahkan
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>');

        // var_dump($_POST);
        // exit;
        redirect('admin/slider');
    }

    public function sliderEdit($id)
    {
        $data['slider'] = $this->sliderModel->getById($id);
        $this->load->view('admin/component/header');
        $this->load->view('admin/component/top');
        $this->load->view('admin/component/menu');
        $this->load->view('admin/modul/slider/edit', $data);
        $this->load->view('admin/component/footer');
    }

    public function sliderUpdate()
    {

        $id = $this->input->post('id_slider');
        // 
        $row = $this->sliderModel->getById($id);
        // var_dump($row);
        // exit;
        $data = [];
        if ($_FILES['img_slider']['size'] != 0) {
            unlink("api/slider/" . $row['img_slider']);
            $foto = $_FILES['img_slider']['name'];
            $filename = time()."-".$foto;
            move_uploaded_file($_FILES['img_slider']['tmp_name'], "api/slider/$filename");
            $data['img_slider'] = $filename;
            $this->sliderModel->update($id, $data);
            $this->session->set_flashdata('pesan', '<div class="alert alert-succes alert-dismissible fade show" role="alert">
            Data Berhasil Diedit
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>');
        }


        // var_dump($_POST);
        // exit;
        redirect('admin/slider');
    }
    public function sliderDelete($id)
    {
        $this->sliderModel->delete($id);
        $this->session->set_flashdata('pesan', '<div class="alert alert-success alert-dismissible fade show" role="alert">
            Data Admin Berhasil DiHapus
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>');
        redirect('admin/slider');
    }
}
