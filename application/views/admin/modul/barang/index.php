<div class="page-wrapper">

    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-12 d-flex no-block align-items-center">
                <h3 class="page-title">Data Barang</h3>
                <div class="ml-auto text-right">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Data Barang</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Barang</h4>

                        <!-- <a href="<?= base_url('admin/store/tambah') ?>"><button type="button" class="btn btn-info">Tambah Data</button></a> -->
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered">
                                <thead>
                                    <tr style="text-align: center;">
                                        <th>No</th>
                                        <th>Nama User</th>
                                        <th>Kategori</th>
                                        <th>Store</th>
                                        <th>Nama Barang</th>
                                        <th>Tarif Barang</th>
                                        <th>Desktipsi</th>
                                        <th>Stok</th>
                                        <th>Gambar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    // var_dump($join_barang);
                                    // exit;
                                    $no = 0;
                                    foreach ($join_barang as $a => $pecah) {
                                    ?>
                                        <tr>
                                            <td><?php echo $no + 1 ?></td>
                                            <td><?php echo $pecah->nama_user ?></td>
                                            <td><?php echo $pecah->nama_kategori ?></td>
                                            <td><?php echo $pecah->nama_store ?></td>
                                            <td><?php echo $pecah->nama_barang ?></td>
                                            <td><?php echo $pecah->tarif_barang ?></td>
                                            <td><?php echo $pecah->deskripsi ?></td>
                                            <td><?php echo $pecah->stok ?></td>
                                            <td>
                                                <img src="<?php echo base_url('api/gambar/' . $pecah->gambar_barang) ?>" alt="<?= $pecah->gambar_barang ?>" style="width: 100px; height: 100px;">
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>