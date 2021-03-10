<?php defined('BASEPATH') or exit('No direct script access allowed');

class Barang_Model extends CI_Model
{

    private $_table = "tb_barang";

    // KITA TIDAK PAKAI PRODUCT ID KARENA SEMUA ID MENGGUNAKAN AUTO INCREMENT
    // public $product_id;
    public $primaryKey = "id_barang"; // primary key

    public function getAll()
    {
        return $this->db->get($this->_table)->result();
    }
    public function join_all()
    {
        return $this->db->query("SELECT * FROM tb_barang LEFT JOIN tb_user ON tb_barang.id_user=tb_user.id_user LEFT JOIN tb_kategori ON tb_barang.id_kategori=tb_kategori.id_kategori LEFT JOIN tb_store ON tb_barang.id_store=tb_store.id_store")->result();
    }
    // public function save($post)
    // {
    //     $data = [];
    //     $data['img_barang'] = $post["img_barang"];
    //     return $this->db->insert($this->_table, $data);
    // }
    // public function getById($id)
    // {
    // 	return $this->db->get_where($this->_table, [$this->primaryKey => $id])->result();
    // }

    // public function delete($id)
    // {
    // 	return $this->db->delete($this->_table, array($this->primaryKey => $id));
    // }
}
