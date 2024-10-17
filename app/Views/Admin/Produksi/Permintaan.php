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
                        <h4>Data produksi</h4>
                        <a type="button" class="btn btn-primary btn-sm rounded"
                            href="<?= base_url('Produksi/TambahProduksi'); ?>">
                            <i class="ti-plus btn-icon-prepend"></i>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table table-hover" id="data_produksi">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>TGL Permintaaan</th>
                                <th>Nama Supplier</th>
                                <th>Ket</th>
                                <th>Status</th>
                                <th class="text-center" style="width: 50px;">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php foreach ($produksi as $key => $value) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= date('d-m-Y', strtotime($value['tgl_permintaan'])); ?></td>
                                <td><?= $value['nama_supplier']; ?></td>
                                <td><?= $value['ket_produksi']; ?></td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm rounded btn-xl" data-toggle="modal"
                                        data-target="#editproduksiModal<?= $value['id_produksi']; ?>">
                                        <i class="ti-pencil btn-icon-prepend"></i>
                                    </a>
                                    <a class="btn btn-sm rounded btn-xl"
                                        onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data?')"
                                        href="<?= base_url('produksi/Delete/' . $value['id_produksi']); ?>">
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

<?= $this->endSection('isi'); ?>

<?= $this->section('script'); ?>
<script>
// data tables
$(document).ready(function() {
    $('#data_produksi').DataTable({
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
});

// auto close alert
window.setTimeout(function() {
    $(".alert").fadeTo(500, 0).slideUp(500, function() {
        $(this).remove();
    });
}, 3000);

// select2
$('#select_id_produksi').select2({
    placeholder: "-- Pilih produksi --",
    allowClear: true
});

// select2 edit
$('#select_id_produksi').select2({
    placeholder: "-- Pilih produksi --",
    allowClear: true
});
</script>

<?= $this->endSection('script'); ?>