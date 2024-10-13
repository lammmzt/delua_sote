<?= $this->extend('Template/index'); ?>
<?= $this->section('isi'); ?>
<div class="row">
    <div class="col-lg-12">
        <?php if (session()->getFlashdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Sukses!</strong> <?= session()->getFlashdata('success'); ?><button type="button" class="close"
                data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('errors')) : ?>
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Gagal!</strong> <?= session()->getFlashdata('errors'); ?><button type="button" class="close"
                data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <?php endif; ?>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="d-flex justify-content-between">
                        <h4>Data Produk</h4>
                        <button type="button" class="btn btn-primary btn-sm rounded" data-toggle="modal"
                            data-target="#tambahProdukModal">
                            <i class="ti-plus btn-icon-prepend"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table table-hover" id="data_produk">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Kode Produk</th>
                                <th>Nama Produk</th>
                                <th class="text-center" style="width: 50px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($produk as $key => $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['id_produk']; ?></td>
                                <td><?= $value['nama_produk']; ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm rounded btn-xl" data-toggle="modal"
                                        data-target="#editProdukModal<?= $value['id_produk']; ?>">
                                        <i class="ti-pencil btn-icon-prepend"></i>
                                    </a>
                                    <a class="btn btn-sm rounded btn-xl"
                                        onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data?')"
                                        href="<?= base_url('Produk/Delete/' . $value['id_produk']); ?>">
                                        <i class="ti-trash btn-icon-prepend"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="d-flex justify-content-between">
                        <h4>Data Jenis Produk</h4>
                        <button type="button" class="btn btn-primary btn-sm rounded" data-toggle="modal"
                            data-target="#tambahDataProduk">
                            <i class="ti-plus btn-icon-prepend"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover" id="tabel_jenis_produk">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Jenis Produk</th>
                                <th class="text-center" style="width: 50px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($jenis_produk as $key => $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['nama_produk']; ?></td>
                                <td><?= $value['nama_jenis_produk']; ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm rounded btn-xl" data-toggle="modal"
                                        data-target="#editDataProduk<?= $value['id_jenis_produk']; ?>">
                                        <i class="ti-pencil btn-icon-prepend"></i>
                                    </a>
                                    <a class="btn btn-sm rounded btn-xl"
                                        onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data?')"
                                        href="<?= base_url('Produk/DeleteJenisProduk/' . $value['id_jenis_produk']); ?>">
                                        <i class="ti-trash btn-icon-prepend"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- ============================== Data Produk ============================== -->
<!-- modal tambah data produk -->
<div class="modal fade" id="tambahProdukModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="<?= base_url('Produk/save'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('nama_produk')) ? 'is-invalid' : ''; ?> "
                            id="nama_produk" placeholder="Masukan Nama Produk" name="nama_produk"
                            value="<?= old('nama_produk'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_produk'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="Submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit data produk -->
<?php foreach ($produk as $key => $value) : ?>
<div class="modal fade" id="editProdukModal<?= $value['id_produk']; ?>" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="<?= base_url('Produk/update/' . $value['id_produk']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_produk" class="">Nama Produk</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('edit_nama_produk')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Nama Produk" name="edit_nama_produk"
                            value="<?= $value['nama_produk']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_nama_produk'); ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="Submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>

<!-- ============================== Data Jenis Produk ============================== -->
<!-- modal tambah data jenis produk -->
<div class="modal fade" id="tambahDataProduk" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Jenis Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="<?= base_url('Produk/saveJenisProduk'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_produk">Nama Produk</label>
                        <select class="form-control w-100" name="id_produk" id="select_id_produk">
                            <option value="">-- Pilih Produk --</option>
                            <?php foreach ($produk as $key => $value) : ?>
                            <option value="<?= $value['id_produk']; ?>"
                                <?= (old('id_produk') == $value['id_produk']) ? 'selected' : ''; ?>>
                                <?= $value['nama_produk']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_jenis_produk">Nama Jenis Produk</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('nama_jenis_produk')) ? 'is-invalid' : ''; ?> "
                            id="nama_jenis_produk" placeholder="Masukan Jenis Produk" name="nama_jenis_produk"
                            value="<?= old('nama_jenis_produk'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_jenis_produk'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi">Deskripsi</label>
                        <textarea type="text"
                            class="form-control <?= ($validation->hasError('deskripsi')) ? 'is-invalid' : ''; ?> "
                            id="deskripsi" placeholder="Masukan deskripsi"
                            name="deskripsi"><?= old('deskripsi'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError(' '); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga_jual">Harga Jual</label>
                        <input type="number"
                            class="form-control <?= ($validation->hasError('harga_jual')) ? 'is-invalid' : ''; ?> "
                            id="harga_jual" placeholder="Masukan harga jual" name="harga_jual"
                            value="<?= old('harga_jual'); ?>" min="0">
                        <div class="invalid-feedback">
                            <?= $validation->getError('harga_jual'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stok_produk">Stok Produk</label>
                        <input type="number"
                            class="form-control <?= ($validation->hasError('stok_produk')) ? 'is-invalid' : ''; ?> "
                            id="stok_produk" placeholder="Masukan stok produk" name="stok_produk"
                            value="<?= old('stok_produk'); ?>" min="0">
                        <div class="invalid-feedback">
                            <?= $validation->getError('stok_produk'); ?>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="Submit" class="btn btn-primary">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- modal edit data jenis produk -->
<?php foreach ($jenis_produk as $key => $value) : ?>
<div class="modal fade" id="editDataProduk<?= $value['id_jenis_produk']; ?>" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data Jenis Produk</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample"
                action="<?= base_url('Produk/updateJenisProduk/' . $value['id_jenis_produk']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_produk" class="">Nama Produk</label>
                        <select class="form-control w-100 js-example-basic-single" name="edit_id_produk" <option
                            value="">-- Pilih Produk --</option>
                            <?php foreach ($produk as $pd) : ?>
                            <option value="<?= $pd['id_produk']; ?>"
                                <?= ($pd['id_produk'] == $value['id_produk']) ? 'selected' : ''; ?>>
                                <?= $pd['nama_produk']; ?></option>
                            <?php endforeach; ?>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_jenis_produk" class="">Nama Jenis Produk</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('edit_nama_jenis_produk')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Nama Jenis Produk" name="edit_nama_jenis_produk"
                            value="<?= $value['nama_jenis_produk']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_nama_jenis_produk'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="deskripsi" class="">Deskripsi</label>
                        <textarea type="text"
                            class="form-control <?= ($validation->hasError('edit_deskripsi')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Deskripsi" name="edit_deskripsi"><?= $value['deskripsi']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_deskripsi'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="harga_jual" class="">Harga Jual</label>
                        <input type="number"
                            class="form-control <?= ($validation->hasError('edit_harga_jual')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Harga Jual" name="edit_harga_jual" value="<?= $value['harga_jual']; ?>"
                            min="0">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_harga_jual'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stok_produk" class="">Stok Produk</label>
                        <input type="number"
                            class="form-control <?= ($validation->hasError('edit_stok_produk')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Stok Produk" name="edit_stok_produk"
                            value="<?= $value['stok_produk']; ?>" min="0">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_stok_produk'); ?>
                        </div>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button type="Submit" class="btn btn-primary">Ubah</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endforeach; ?>
<?= $this->endSection('isi'); ?>

<?= $this->section('script'); ?>
<script>
// data tables
$(document).ready(function() {
    $('#data_produk').DataTable({
            columnDefs: [{
                orderable: false,
                targets: [0, 3]
            }],
            lengthMenu: [
                [5, 10, 25, 50, -1],
                [5, 10, 25, 50, "All"]
            ],
        }

    );
    $('#tabel_jenis_produk').DataTable({
        columnDefs: [{
            orderable: false,
            targets: [0, 3]
        }],
        lengthMenu: [
            [5, 10, 25, 50, -1],
            [5, 10, 25, 50, "All"]
        ],
    });
});

// auto close alert
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 3000);

// select2
$('#select_id_produk').select2({
    placeholder: "-- Pilih Produk --",
    allowClear: true
});

// select2 edit
$('#select_id_produk').select2({
    placeholder: "-- Pilih Produk --",
    allowClear: true
});
</script>

<?= $this->endSection('script'); ?>