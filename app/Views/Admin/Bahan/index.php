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
                        <h4>Data Bahan</h4>
                        <button type="button" class="btn btn-primary btn-sm rounded" data-toggle="modal"
                            data-target="#tambahbahanModal">
                            <i class="ti-plus btn-icon-prepend"></i>
                        </button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table table-hover" id="data_bahan">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama bahan</th>
                                <th>Stok bahan</th>
                                <th class="text-center" style="width: 50px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($bahan as $key => $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $value['nama_bahan']; ?></td>
                                <td><?= $value['stok_bahan']; ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm rounded btn-xl" data-toggle="modal"
                                        data-target="#editbahanModal<?= $value['id_bahan']; ?>">
                                        <i class="ti-pencil btn-icon-prepend"></i>
                                    </a>
                                    <a class="btn btn-sm rounded btn-xl"
                                        onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data?')"
                                        href="<?= base_url('Bahan/Delete/' . $value['id_bahan']); ?>">
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

<!-- ============================== Data bahan ============================== -->
<!-- modal tambah data bahan -->
<div class="modal fade" id="tambahbahanModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tambah Data bahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="<?= base_url('Bahan/save'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_bahan">Nama Bahan</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('nama_bahan')) ? 'is-invalid' : ''; ?> "
                            id="nama_bahan" placeholder="Masukan Nama bahan" name="nama_bahan"
                            value="<?= old('nama_bahan'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('nama_bahan'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stok_bahan">Stok Bahan</label>
                        <input type="number"
                            class="form-control <?= ($validation->hasError('stok_bahan')) ? 'is-invalid' : ''; ?> "
                            id="stok_bahan" placeholder="Masukan Stok bahan" name="stok_bahan"
                            value="<?= old('stok_bahan'); ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('stok_bahan'); ?>
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

<!-- modal edit data bahan -->
<?php foreach ($bahan as $key => $value) : ?>
<div class="modal fade" id="editbahanModal<?= $value['id_bahan']; ?>" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Data bahan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="forms-sample" action="<?= base_url('Bahan/update/' . $value['id_bahan']); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nama_bahan" class="">Nama bahan</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('edit_nama_bahan')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Nama bahan" name="edit_nama_bahan"
                            value="<?= $value['nama_bahan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_nama_bahan'); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="stok_bahan" class="">Stok bahan</label>
                        <input type="text"
                            class="form-control <?= ($validation->hasError('edit_stok_bahan')) ? 'is-invalid' : ''; ?> "
                            placeholder="Masukan Stok bahan" name="edit_stok_bahan"
                            value="<?= $value['stok_bahan']; ?>">
                        <div class="invalid-feedback">
                            <?= $validation->getError('edit_stok_bahan'); ?>
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
    $('#data_bahan').DataTable({
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
</script>

<?= $this->endSection('script'); ?>