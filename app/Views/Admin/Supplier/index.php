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
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    <div class="d-flex justify-content-between">
                        <h4>Data Supplier</h4>
                        <button type="button" class="btn btn-primary btn-sm rounded" data-toggle="modal"
                            data-target="#tambahsupplierModal">
                            <i class="ti-plus btn-icon-prepend"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table table-hover" id="data_supplier">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Supplier</th>
                                <th>Alamat</th>
                                <th>No HP</th>
                                <th>Ket</th>
                                <th class="text-center" style="width: 50px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($supplier as $key => $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['nama_supplier']; ?></td>
                                <td><?= $value['alamat_supplier']; ?></td>
                                <td><?= $value['no_hp_supplier']; ?></td>
                                <th>
                                    <?= $value['ket_supplier']; ?>
                                </th>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm rounded btn-xl" data-toggle="modal"
                                        data-target="#editsupplierModal<?= $value['id_supplier']; ?>">
                                        <i class="ti-pencil btn-icon-prepend"></i>
                                    </a>
                                    <a class="btn btn-sm rounded btn-xl"
                                        onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data?')"
                                        href="<?= base_url('Supplier/Delete/' . $value['id_supplier']); ?>">
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

<!-- ============================== Data supplier ============================== -->
<!-- modal tambah data supplier -->
<div class="modal fade" id="tambahsupplierModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="<?= base_url('Supplier/save'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_user">Nama User</label>
                        <select class="form-control w-100 js-example-basic-single" name="id_user" id="select_id_user">
                            <option value="">-- Pilih user --</option>
                            <?php foreach ($users as $key => $value) : ?>
                            <option value="<?= $value['id_user']; ?>"
                                <?= (old('id_user') == $value['id_user']) ? 'selected' : ''; ?>>
                                <?= $value['nama_user']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_supplier">Nama Supplier</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('nama_supplier')) ? 'is-invalid' : ''; ?> "
                            id="nama_supplier" placeholder="Masukan nama supplier" name="nama_supplier"
                            value="<?= old('nama_supplier'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_supplier'); ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="alamat_supplier">Alamat Supplier</label>
                        <textarea
                            class="form-control <?= ($validation->hasError('alamat_supplier')) ? 'is-invalid' : ''; ?> "
                            id="alamat_supplier" rows="4" name="alamat_supplier"
                            placeholder="Masukan alamat supplier"><?= old('alamat_supplier'); ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('alamat_supplier'); ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="no_hp_supplier">No HP Supplier</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('no_hp_supplier')) ? 'is-invalid' : ''; ?> "
                            id="no_hp_supplier" placeholder="Masukan no hp supplier" name="no_hp_supplier"
                            value="<?= old('no_hp_supplier'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('no_hp_supplier'); ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="ket_supplier">Keterangan Supplier</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('ket_supplier')) ? 'is-invalid' : ''; ?> "
                            id="ket_supplier" placeholder="Masukan keterangan supplier" name="ket_supplier"
                            value="<?= old('ket_supplier'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('ket_supplier'); ?>
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

<!-- modal edit data supplier -->
<?php foreach ($supplier as $key => $value) : ?>
<div class="modal fade" id="editsupplierModal<?= $value['id_supplier']; ?>" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="<?= base_url('supplier/update/' . $value['id_supplier']); ?>"
                method="post">
                <div class="modal-body">
                    <div class="form-group ">
                        <label for="nama_user">Nama User</label>
                        <select class="form-control w-100 js-example-basic-single" name="edit_id_user"
                            id="select_id_user">
                            <option value="">-- Pilih user --</option>
                            <?php foreach ($users as $key => $val) : ?>
                            <option value="<?= $val['id_user']; ?>"
                                <?= ($val['id_user'] == $value['id_user']) ? 'selected' : ''; ?>>
                                <?= $val['nama_user']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_supplier" class="">Nama supplier</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('edit_nama_supplier')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Nama supplier" name="edit_nama_supplier"
                            value="<?= $value['nama_supplier']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_nama_supplier'); ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="alamat_supplier" class="">Alamat supplier</label>
                        <textarea
                            class="form-control <?= ($validation->hasError('edit_alamat_supplier')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Alamat supplier" name="edit_alamat_supplier"
                            rows="4"><?= $value['alamat_supplier']; ?></textarea>
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_alamat_supplier'); ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="no_hp_supplier" class="">No HP supplier</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('edit_no_hp_supplier')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan No HP supplier" name="edit_no_hp_supplier"
                            value="<?= $value['no_hp_supplier']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_no_hp_supplier'); ?>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="edit_ket_supplier" class="">Ket supplier</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('edit_ket_supplier')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Ket supplier" name="edit_ket_supplier"
                            value="<?= $value['ket_supplier']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_ket_supplier'); ?>
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
$(document).ready(function() {
    $('#data_supplier').DataTable({
        columnDefs: [{
            orderable: false,
            targets: [0, 4]
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
</script>

<?= $this->endSection('script'); ?>