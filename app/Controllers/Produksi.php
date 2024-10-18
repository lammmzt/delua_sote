<?php 
namespace App\Controllers;

use App\Models\produksiModel;
use App\Models\supplierModel;
use App\Models\usersModel;
use App\Models\detailProduksiModel;
use App\Models\jenisProdukModel;
use App\Models\prosesProduksiModel;
use App\Models\bahanModel;
use Ramsey\Uuid\Uuid;

class Produksi extends BaseController
{
    protected $produksiModel;
    protected $supplierModel;
    protected $jenisProdukModel;
    protected $usersModel;
    protected $detailProduksiModel;
    protected $prosesProduksiModel;
    protected $bahanModel;

    public function __construct()
    {
        $this->supplierModel = new supplierModel();
        $this->usersModel = new usersModel();
        $this->detailProduksiModel = new detailProduksiModel();
        $this->produksiModel = new produksiModel();
        $this->jenisProdukModel = new jenisProdukModel();
        $this->prosesProduksiModel = new prosesProduksiModel();
        $this->bahanModel = new bahanModel();
    }

    // ================================== PRODUKSI ==================================

    public function Permintaan()
    {
        $data = [
            'title' => 'Permintaan',
            'main_menu' => 'Produksi',
            'main_menu_active' => 'Permintaan',
            'validation' => \Config\Services::validation(),
            'produksi' => $this->produksiModel->getProduksi(),
        ];
        
        return view('Admin/Produksi/Permintaan', $data);
    }

    public function TambahProduksi()
    {
        $data = [
            'title' => 'Tambah Permintaan',
            'main_menu' => 'Produksi',
            'main_menu_active' => 'Permintaan',
            'supplier' => $this->supplierModel->findAll(),
            'bahan' => $this->bahanModel->findAll(),
            'jenis_produk' => $this->jenisProdukModel->getJenisProduk(),
            'validation' => \Config\Services::validation(),
        ];

        return view('Admin/Produksi/Tambah', $data);
    }

    public function SimpanPermintaan()
    {
        // validasi
        $validation =  \Config\Services::validation();
         //check jumlah barang kurang dari stok
        $panjang = $this->request->getPost('panjang'); // mengambil panjang
        $id_bahan = $this->request->getPost('id_bahan'); // mengambil id bahan
        $stok = $this->bahanModel->getBahan($id_bahan); // mengambil data stok
        if ($panjang > $stok['stok_bahan']) {
             return $this->response->setJSON([
                'status' => '400',
                'message' => 'Stok Tidak Mencukupi' 
             ]);
        }
        // generate id
        $id_produksi = Uuid::uuid4()->toString();
        // mengambil data dari form   
        $data = [
            'id_produksi' => $id_produksi,
            'id_supplier' => $this->request->getPost('id_supplier'),
            'tgl_permintaan' => date('Y-m-d'),
            'ket_produksi' => $this->request->getPost('ket_produksi'),
            'status_produksi' => '1',
        ];
        $this->produksiModel->insert($data); // simpan data ke database

        // mengambil data proses produksi
        $data_proses = [
            'id_proses_produksi' => Uuid::uuid4()->toString(),
            'id_produksi' => $id_produksi,
            'id_bahan ' => $this->request->getPost('id_bahan'),
            'panjang' => $this->request->getPost('panjang'),
            'harga_bahan' => $this->request->getPost('harga_bahan'),
            'status_proses_produksi' => '1',
        ];
        $this->prosesProduksiModel->insert($data_proses); // simpan data ke database
        // mengurangi jumlah stok bahan
        $this->bahanModel->update($id_bahan, ['stok_bahan' => $stok['stok_bahan'] - $panjang]);
        $data_jenis_produk = json_decode($this->request->getPost('data_jenis_produk'), true); // mengambil data jenis produk
        // melakukan perulangan untuk menyimpan data detail produksi
        foreach ($data_jenis_produk as $key => $value) {
            //mengambil data detail produksi
            $dataDetail = [
                'id_detail_produksi' => Uuid::uuid4()->toString(),
                'id_produksi' => $id_produksi,
                'id_jenis_produk' => $value['id_jenis_produk'],
                'jumlah_permintaan_produksi' => $value['jumlah_produk'],
                'status_detail_produksi' => '1',
            ];
            // insert data ke database
            $this->detailProduksiModel->insert($dataDetail);
        }
        
        session()->setFlashdata('success', 'Data Berhasil Disimpan'); // set flashdata
        return $this->response->setJSON([
            'status' => '200',
            'message' => 'Data Berhasil Disimpan'
        ]);
    }

    public function edit_produksi($id)
    {
        $data = [
            'title' => 'Edit Permintaan',
            'main_menu' => 'Produksi',
            'main_menu_active' => 'Permintaan',
            'supplier' => $this->supplierModel->findAll(),
            'bahan' => $this->bahanModel->findAll(),
            'jenis_produk' => $this->jenisProdukModel->getJenisProduk(),
            'validation' => \Config\Services::validation(),
            'produksi' => $this->produksiModel->getProduksi($id),
            'detail_produksi' => $this->detailProduksiModel->getDetailProduksiByIdProduksi($id),
            'proses_produksi' => $this->prosesProduksiModel->getProsesProduksiByIdProduksi($id),
        ];

        return view('Admin/Produksi/Edit', $data);
    }
    
   }
?>