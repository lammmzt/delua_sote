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
                        <h4>Data Users</h4>
                        <button type="button" class="btn btn-primary btn-sm rounded" data-toggle="modal"
                            data-target="#tambahuserModal">
                            <i class="ti-plus btn-icon-prepend"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table table-hover" id="data_user">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Username</th>
                                <th>Nama User</th>
                                <th>Role</th>
                                <th class="text-center" style="width: 50px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($users as $key => $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['username']; ?></td>
                                <td><?= $value['nama_user']; ?></td>
                                <td><?= $value['role']; ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm rounded btn-xl" data-toggle="modal"
                                        data-target="#edituserModal<?= $value['id_user']; ?>">
                                        <i class="ti-pencil btn-icon-prepend"></i>
                                    </a>
                                    <a class="btn btn-sm rounded btn-xl"
                                        onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data?')"
                                        href="<?= base_url('Users/Delete/' . $value['id_user']); ?>">
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

<!-- ============================== Data user ============================== -->
<!-- modal tambah data user -->
<div class="modal fade" id="tambahuserModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="<?= base_url('Users/save'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_user">Nama User</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('nama_user')) ? 'is-invalid' : ''; ?> "
                            id="nama_user" placeholder="Masukan Nama user" name="nama_user"
                            value="<?= old('nama_user'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_user'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('username')) ? 'is-invalid' : ''; ?> "
                            id="username" placeholder="Masukan Nama user" name="username"
                            value="<?= old('username'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('username'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password"
                            class="form-control <?= ($validation->hasError('password')) ? 'is-invalid' : ''; ?> "
                            id="password" placeholder="Masukan Password" name="password"
                            value="<?= old('password'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('password'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-control <?= ($validation->hasError('role')) ? 'is-invalid' : ''; ?> "
                            id="role" name="role">
                            <option value="">Pilih Role</option>
                            <option value="admin" <?= (old('role') == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="owner" <?= (old('role') == 'owner') ? 'selected' : ''; ?>>Owner</option>
                            <option value="supplier" <?= (old('role') == 'supplier') ? 'selected' : ''; ?>>Supplier
                            </option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('role'); ?>
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

<!-- modal edit data user -->
<?php foreach ($users as $key => $value) : ?>
<div class="modal fade" id="edituserModal<?= $value['id_user']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data user</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="<?= base_url('Users/updateUser/' . $value['id_user']); ?>" method="post"
                enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_user" class="">Nama user</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('edit_nama_user')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Nama User" name="edit_nama_user" value="<?= $value['nama_user']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_nama_user'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="username" class="">Username</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('edit_username')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Username" name="edit_username" value="<?= $value['username']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_username'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password" class="">Password</label>
                        <input type="password"
                            class="form-control <?= ($validation->hasError('edit_password')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Password" name="edit_password" value="<?= $value['password']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_password'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="role" class="">Role</label>
                        <select class="form-control <?= ($validation->hasError('edit_role')) ? 'is-invalid' : ''; ?> "
                            name="edit_role">
                            <option value="">Pilih Role</option>
                            <option value="admin" <?= ($value['role'] == 'admin') ? 'selected' : ''; ?>>Admin</option>
                            <option value="owner" <?= ($value['role'] == 'owner') ? 'selected' : ''; ?>>Owner</option>
                            <option value="supplier" <?= ($value['role'] == 'supplier') ? 'selected' : ''; ?>>supplier
                            </option>
                        </select>
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_role'); ?>
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
    $('#data_user').DataTable({
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