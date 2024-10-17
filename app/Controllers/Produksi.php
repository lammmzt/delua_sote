<?php 
namespace App\Controllers;

use App\Models\produksiModel;
use App\Models\supplierModel;
use App\Models\usersModel;
use App\Models\detailProduksiModel;
use App\Models\jenisProdukModel;
use Ramsey\Uuid\Uuid;

class Produksi extends BaseController
{
    protected $produksiModel;
    protected $supplierModel;
    protected $jenisProdukModel;
    protected $usersModel;
    protected $detailProduksiModel;

    public function __construct()
    {
        $this->supplierModel = new supplierModel();
        $this->usersModel = new usersModel();
        $this->detailProduksiModel = new detailProduksiModel();
        $this->produksiModel = new produksiModel();
        $this->jenisProdukModel = new jenisProdukModel();
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
            'jenis_produk' => $this->jenisProdukModel->getJenisProduk(),
            'validation' => \Config\Services::validation(),
        ];

        return view('Admin/Produksi/Tambah', $data);
    }

    public function SimpanPermintaan()
    {
        $validation =  \Config\Services::validation();
        $id_produksi = Uuid::uuid4()->toString();
        $data = [
            'id_produksi' => $id_produksi,
            'id_supplier' => $this->request->getPost('id_supplier'),
            'tgl_permintaan' => date('Y-m-d'),
            'ket_produksi' => $this->request->getPost('ket_produksi'),
            'status_produksi' => '0',
        ];

        $this->produksiModel->insert($data);
    //     data.push({
    //     name: 'data_jenis_produk',
    //     value: JSON.stringify(data_jenis_produk)
    // });
        $data_jenis_produk = json_decode($this->request->getPost('data_jenis_produk'), true);

        foreach ($data_jenis_produk as $key => $value) {
            $dataDetail = [
                'id_detail_produksi' => Uuid::uuid4()->toString(),
                'id_produksi' => $id_produksi,
                'id_jenis_produk' => $value['id_jenis_produk'],
                'jumlah_permintaan_produksi' => $value['jumlah_produk'],
                'status_detail_produksi' => '0',
            ];

            $this->detailProduksiModel->insert($dataDetail);
        }
        
        return $this->response->setJSON([
            'status' => '200',
            'message' => 'Data Berhasil Disimpan'
        ]);
    }

   }
?>