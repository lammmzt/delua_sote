<?= $this->extend('Template/index'); ?>
<?= $this->section('isi'); ?>
<?php 
use App\Models\detailProduksiModel;
use App\Models\prosesProduksiModel;
$detailProduksiModel = new detailProduksiModel();
$prosesProduksiModel = new prosesProduksiModel();
?>
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
                                <td>
                                    <?php if ($value['status_produksi'] == 1) : ?>
                                    <span class="badge badge-warning">Menunggu Proses</span>
                                    <?php elseif ($value['status_produksi'] == 0) : ?>
                                    <span class="badge badge-danger">Batal</span>
                                    <?php endif; ?>
                                </td>
                                <td class="text-center">
                                    <a href="#" class="btn btn-sm rounded btn-xl" data-toggle="modal"
                                        data-target="#detailproduksiModal<?= $value['id_produksi']; ?>">
                                        <i class="ti-eye btn-icon-prepend"></i>
                                    </a>
                                    <!-- detail -->
                                    <a href="<?= base_url('Produksi/edit_produksi/' . $value['id_produksi']); ?>"
                                        class="btn btn-sm rounded btn-xl">
                                        <i class="ti-pencil btn-icon-prepend"></i>
                                    </a>
                                    <!-- add button to proses -->
                                    <!-- <a href="<?= base_url('Produksi/proses_admin/' . $value['id_produksi']); ?>"
                                        class="btn btn-sm rounded btn-xl">
                                        <i class="ti-check btn-icon-prepend"></i>
                                    </a> -->
                                    <!-- <a class="btn btn-sm rounded btn-xl"
                                        onclick="return confirm('Apakah Anda Yakin Untuk Menghapus Data?')"
                                        href="<?= base_url('Produksi/DetailProduksi/' . $value['id_produksi']); ?>">
                                        <i class="ti-trash btn-icon-prepend"></i>
                                    </a> -->

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
<!-- detail -->
<?php foreach ($produksi as $key => $value) : ?>
<div class="modal fade" id="detailproduksiModal<?= $value['id_produksi']; ?>" tabindex="-1" role="dialog"
    aria-labelledby="detailproduksiModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4>Detail Permintaan Produksi</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="card-body">
                <!-- data produksi -->
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="tgl_permintaan">Tgl Permintaan</label>
                            <input type="text" class="form-control" id="tgl_permintaan"
                                value="<?= date('d-m-Y', strtotime($value['tgl_permintaan'])); ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama_supplier">Nama Supplier</label>
                            <input type="text" class="form-control" id="nama_supplier"
                                value="<?= $value['nama_supplier']; ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="ket_produksi">Keterangan</label>
                            <input type="text" class="form-control" id="ket_produksi"
                                value="<?= $value['ket_produksi']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="status_produksi">Status</label>
                            <?php if ($value['status_produksi'] == 1) : ?>
                            <input type="text" class="form-control" id="status_produksi" value="Menunggu Proses"
                                readonly>
                            <?php elseif ($value['status_produksi'] == 0) : ?>
                            <input type="text" class="form-control" id="status_produksi" value="Batal" readonly>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php 
                $proses_produksi = $prosesProduksiModel->getProsesProduksiByIdProduksi($value['id_produksi']);
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="nama_bahan">Nama Bahan</label>
                            <input type="text" class="form-control" id="nama_bahan"
                                value="<?= $proses_produksi['nama_bahan']; ?>" readonly>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label for="panjang">Panjang</label>
                            <input type="text" class="form-control" id="panjang"
                                value="<?= $proses_produksi['panjang']; ?>" readonly>
                        </div>
                    </div>
                </div>
                <div class="card-title">
                    <div class="d-flex justify-content-between">
                        <h4>Data produksi</h4>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table table-striped" id="data_produksi">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama Produk</th>
                                <th>Jumlah</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; 
                            
                            $detail_produksi = $detailProduksiModel->getDetailProduksiByIdProduksi($value['id_produksi']);
                            // dd($detail_produksi);

                            foreach ($detail_produksi as $dp) : ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $dp['nama_produk']; ?></td>
                                <td><?= $dp['jumlah_permintaan_produksi']; ?></td>
                                <td>
                                    <?php if ($dp['status_detail_produksi'] == 1) : ?>
                                    <span class="badge badge-warning">Menunggu Proses</span>
                                    <?php elseif ($dp['status_detail_produksi'] == 0) : ?>
                                    <span class="badge badge-danger">Batal</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>


                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<?php endforeach; ?>

<?= $this->endSection('isi'); ?>

<?= $this->section('script'); ?>
<script>
// data tables
$(document).ready(function() {
    $('#data_produksi').DataTable({
            columnDefs: [{
                orderable: false,
                targets: [0, 5]
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