<?php 
namespace App\Controllers;

use App\Models\bahanModel;

class Bahan extends BaseController
{
    protected $bahanModel;
    
    public function __construct()
    {
        $this->bahanModel = new bahanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Bahan',
            'main_menu' => 'Master Data',
            'main_menu_active' => 'data_bahan',
            'validation' => \Config\Services::validation(),
            'bahan' => $this->bahanModel->getBahan(),
        ];
        return view('Admin/Bahan/index', $data);
    }

    // ===================== DATA BAHAN =====================
    public function save(){
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'nama_bahan' => [
                'label' => 'Nama Bahan',
                'rules' => 'required|is_unique[bahan.nama_bahan]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('errors', 'Data gagal disimpan');
            return redirect()->to('/Bahan')->withInput();
        } else {
            $data = [
                'nama_bahan' => $this->request->getPost('nama_bahan'),
                'stok_bahan' => $this->request->getPost('stok_bahan'),
            ];

            $this->bahanModel->insert($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/Bahan');
        }
    }

    public function update($id){
        $validation =  \Config\Services::validation();
        $dataBahan = $this->bahanModel->getBahan($id);
        // dd($dataBahan);

        if ($this->request->getPost('edit_nama_bahan') == $dataBahan['nama_bahan']) {
            $unique = '';
        } else {
            $unique = 'is_unique[bahan.nama_bahan]';
        }
        
        $validation->setRules([
            'edit_nama_bahan' => [
                'label' => 'Nama Bahan',
                'rules' => 'required|'.$unique,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('errors', 'Data gagal diubah');
            return redirect()->to('/Bahan')->withInput();
        } else{
             $data = [
                'nama_bahan' => $this->request->getPost('edit_nama_bahan'),
                'stok_bahan' => $this->request->getPost('edit_stok_bahan'),
            ];
        
            $this->bahanModel->update($id, $data);
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to('/Bahan');
        }
    }

    public function delete($id){    
        $this->bahanModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/Bahan');
    }
}


?>