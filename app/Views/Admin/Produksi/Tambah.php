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
            <form class="form-sample" id="form_produksi">
                <div class="card-body">
                    <div class="card-title">
                        <div class="d-flex justify-content-between">
                            <h4>Form Tambah Permintaan Produksi</h4>

                        </div>
                    </div>
                    <!-- <form class="form-sample" action="<?= base_url('Produksi/SimpanProduksi'); ?>" method="POST"> -->
                    <?= csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_supplier">Supplier</label>
                                <select class="form-control w-100 js-example-basic-single" name="id_supplier"
                                    id="id_supplier" required>
                                    <option value="">-- Pilih Supplier --</option>
                                    <?php foreach ($supplier as $key => $value) : ?>
                                    <option value="<?= $value['id_supplier']; ?>"><?= $value['nama_supplier']; ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ket_produksi" class="">Keterangan</label>
                                <textarea type="date" class="form-control" id="ket_produksi" name="ket_produksi"
                                    required
                                    placeholder="Keterangan"><?= (old('ket_produksi')) ? old('ket_produksi') :'' ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="id_bahan">Bahan</label>
                                <select class="form-control w-100 js-example-basic-single" name="id_bahan" id="id_bahan"
                                    required>
                                    <option value="">-- Pilih Bahan --</option>
                                    <?php foreach ($bahan as $key => $value) : ?>
                                    <option value="<?= $value['id_bahan']; ?>"><?= $value['nama_bahan']; ?>
                                        (<?= $value['stok_bahan']; ?>m<sup>3</sup>)</option>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="panjang" class="">panjang</label>
                                <input type="number" class="form-control" id="panjang" name="panjang" required
                                    placeholder="panjang" value="<?= (old('panjang')) ? old('panjang') :'' ?>">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="harga_bahan" class="">Harga Bahan</label>
                                <input type="number" class="form-control" id="harga_bahan" name="harga_bahan" required
                                    placeholder="harga_bahan"
                                    value="<?= (old('harga_bahan')) ? old('harga_bahan') :'' ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="ket_produksi" class="">Jenis Produk</label>
                                <select class="form-control w-100" name="id_jenis_produk" id="id_jenis_produk" required>
                                    <option value="">-- Pilih Jenis Produk --</option>
                                    <?php foreach ($jenis_produk as $key => $value) : ?>
                                    <option value="<?= $value['id_jenis_produk']; ?>">
                                        <?= $value['nama_produk']; ?> (<?= $value['nama_jenis_produk']; ?>)
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-primary btn-sm rounded my-4" id="add_jenis_produk">
                                <i class="ti-plus btn-icon-prepend"></i>
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table table-striped" id="data_jenis_produk">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Produk</th>
                                    <th class="text-center" style="width: 250px;">Jumlah</th>
                                    <th class="text-center" style="width: 50px;">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4" class="text-center">Data Kosong</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-sm rounded my-4">
                                <i class="ti-save btn-icon-prepend"></i> Simpan
                            </button>
                            <a href="<?= base_url('Produksi/Permintaan'); ?>"
                                class="btn btn-danger btn-sm rounded my-4">
                                <i class="ti-back-left btn-icon-prepend"></i> Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </form>
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
$('#id_supplier').select2({
    placeholder: "-- Pilih supplier --",
    allowClear: true
});

$('#id_jenis_produk').select2({
    placeholder: "-- Pilih jenis produk --",
    allowClear: true
});

// data jenis produk
var data_jenis_produk = [];

// render data jenis produk
function renderData() {
    var html = '';
    if (data_jenis_produk.length == 0) {
        html += '<tr>';
        html += '<td colspan="4" class="text-center">Data Kosong</td>';
        html += '</tr>';
    } else {
        $.each(data_jenis_produk, function(key, value) {
            html += '<tr>';
            html += '<td>' + (key + 1) + '</td>';
            html += '<td>' + value.nama_jenis_produk + '</td>';
            html += '<td class="text-center" style="width: 200px;">' +
                '<input type="number" class="form-control text-center" name="jumlah_produk[]" value="' +
                value.jumlah_produk + '" required>' + '</td>';
            html += '<td class="text-center">';
            html +=
                '<button type="button" class="btn btn-danger btn-sm rounded" onclick="deleteData(' + key +
                ')"><i class="ti-trash btn-icon-prepend"></i></button>';
            html += '</td>';
            html += '</tr>';
        });
    }

    $('#data_jenis_produk tbody').html(html);
}

// jika menambahkan data
function addData() {
    var id_jenis_produk = $('#id_jenis_produk').val();
    var nama_jenis_produk = $('#id_jenis_produk option:selected').text();
    if (id_jenis_produk == '') {
        alert('Pilih jenis produk terlebih dahulu');
        return false;
    }
    var index = data_jenis_produk.findIndex(function(item) {
        return item.id_jenis_produk == id_jenis_produk;
    });

    if (index == -1) {
        data_jenis_produk.push({
            id_jenis_produk: id_jenis_produk,
            nama_jenis_produk: nama_jenis_produk,
            jumlah_produk: 1
        });
    } else {
        data_jenis_produk[index].jumlah_produk++;
    }

    renderData();
}

// jiaka mengubah jumlah produk
$('#data_jenis_produk').on('change', 'input[name="jumlah_produk[]"]', function() {
    var index = $(this).closest('tr').index();
    data_jenis_produk[index].jumlah_produk = $(this).val();
});

// jika menghapus data
function deleteData(index) {
    data_jenis_produk.splice(index, 1);
    renderData();
}

// jika menekan tombol simpan
$('#add_jenis_produk').click(function() {
    addData();
});

// jika menekan tombol simpan
$('#form_produksi').submit(function(e) {
    e.preventDefault();
    // validasi
    if (data_jenis_produk.length == 0) {
        alert('Data jenis produk tidak boleh kosong');
        return false;
    }
    var data = $(this).serializeArray(); // mengambil semua data form
    // tambahkan data jenis produk
    data.push({
        name: 'data_jenis_produk',
        value: JSON.stringify(data_jenis_produk)
    });

    console.log(data);

    // simpan data
    $.ajax({
        url: '<?= base_url('Produksi/SimpanPermintaan'); ?>',
        type: 'POST',
        data: data,
        success: function(response) {
            if (response.status == '200') {
                // alert(response.message);
                window.location.href = '<?= base_url('Produksi/Permintaan'); ?>';
            } else {
                alert(response.message);
            }
        }
    });
});
// render data
renderData();
</script>

<?= $this->endSection('script'); ?>