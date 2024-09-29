<?php 
namespace App\Controllers;

use App\Models\produkModel;
use App\Models\jenisProdukModel;
use Ramsey\Uuid\Uuid;


class Produk extends BaseController
{
    protected $produkModel;
    protected $jenisProdukModel;
    
    public function __construct()
    {
        $this->produkModel = new produkModel();
        $this->jenisProdukModel = new jenisProdukModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Produk',
            'main_menu' => 'Master Data',
            'main_menu_active' => 'data_produk',
            'validation' => \Config\Services::validation(),
            'produk' => $this->produkModel->findAll(),
            'jenis_produk' => $this->jenisProdukModel->getJenisProduk(),
        ];
        return view('Admin/Produk/index', $data);
    }

    // ===================== DATA PRODUK =====================
    public function save(){
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama_produk' => [
                'label' => 'Nama Produk',
                'rules' => 'required|is_unique[produk.nama_produk]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('errors', 'Data gagal disimpan');
            return redirect()->to('/Produk')->withInput();
        } else {
            $id_produk = Uuid::uuid4()->toString();
            $kode_produk = 'PRD-' . date('Ymd') . rand(1000, 9999);

            $data = [
                'id_produk' => $id_produk,
                'kode_produk' => $kode_produk,
                'nama_produk' => $this->request->getPost('nama_produk'),
            ];

            $this->produkModel->insert($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/Produk');

        }
    }


    public function update($id_produk)
    {
        $validation =  \Config\Services::validation();
        $produk = $this->produkModel->find($id_produk);
        $nama_produk = $this->request->getPost('edit_nama_produk');
        if($nama_produk == $produk['nama_produk']){
            $is_unique = 'required';
        } else {
            $is_unique = 'required|is_unique[produk.nama_produk]';
        }
        $validation->setRules([
            'edit_nama_produk' => [
                'label' => 'Nama Produk',
                'rules' => 'required|'.$is_unique,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('errors', 'Data gagal diupdate');
            return redirect()->to('/Produk')->withInput();
        } else {
            $data = [
                'nama_produk' => $this->request->getPost('edit_nama_produk'),
            ];

            $this->produkModel->update($id_produk, $data);
            session()->setFlashdata('success', 'Data berhasil diupdate');
            return redirect()->to('/Produk');

        }
    }

    public function Delete($id_produk)
    {
        $this->produkModel->delete($id_produk);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/Produk');
    }

    // ===================== JENIS PRODUK =====================

    public function saveJenisProduk(){
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama_jenis_produk' => [
                'label' => 'Nama Jenis Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'id_produk' => [
                'label' => 'Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('errors', 'Data gagal disimpan');
            return redirect()->to('/Produk/jenisProduk')->withInput();
        } else {

            $data = [
                'nama_jenis_produk' => $this->request->getPost('nama_jenis_produk'),
                'id_produk' => $this->request->getPost('id_produk'),
                'deskripsi' => $this->request->getPost('deskripsi'),
                'harga_jual' => $this->request->getPost('harga_jual'),
                'stok_produk' => $this->request->getPost('stok_produk'),
            ];
            // dd($data);

            $this->jenisProdukModel->save($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/Produk');

        }
    }

    public function updateJenisProduk($id_jenis_produk)
    {
        $validation =  \Config\Services::validation();
           
        $validation->setRules([
            'edit_nama_jenis_produk' => [
                'label' => 'Nama Jenis Produk',
                'rules' => 'required|',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'edit_id_produk' => [
                'label' => 'Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('errors', 'Data gagal diupdate');
            return redirect()->to('/Produk')->withInput();
        } else {
            $data = [
                'nama_jenis_produk' => $this->request->getPost('edit_nama_jenis_produk'),
                'id_produk' => $this->request->getPost('edit_id_produk'),
                'deskripsi' => $this->request->getPost('edit_deskripsi'),
                'harga_jual' => $this->request->getPost('edit_harga_jual'),
                'stok_produk' => $this->request->getPost('edit_stok_produk'),
            ];

            $this->jenisProdukModel->update($id_jenis_produk, $data);
            session()->setFlashdata('success', 'Data berhasil diupdate');
            return redirect()->to('/Produk');

        }
    }

    public function DeleteJenisProduk($id_jenis_produk)
    {
        $this->jenisProdukModel->delete($id_jenis_produk);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/Produk');
    }
}


?>