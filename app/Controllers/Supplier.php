<?php 
namespace App\Controllers;

use App\Models\supplierModel;
use App\Models\usersModel;
use Ramsey\Uuid\Uuid;


class Supplier extends BaseController
{
    protected $supplierModel;
    protected $usersModel;

    public function __construct()
    {
        $this->supplierModel = new supplierModel();
        $this->usersModel = new usersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data supplier',
            'main_menu' => 'Master Data',
            'main_menu_active' => 'data_supplier',
            'validation' => \Config\Services::validation(),
            'supplier' => $this->supplierModel->getsupplier(),
            'users' => $this->usersModel->where('role', 'supplier')->findAll(),
        ];
        return view('Admin/Supplier/index', $data);
    }

    public function save()
    {
        $validation =  \Config\Services::validation();
        $id_user = $this->request->getPost('id_user');
        $supplier = $this->supplierModel->where('id_user', $id_user)->first();
        if ($supplier) {
            session()->setFlashdata('errors', 'User sudah terdaftar sebagai supplier');
            return redirect()->to('/Supplier');
        }
        $validation->setRules([
            'nama_supplier' => [
                'label' => 'Nama Supplier',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'alamat_supplier' => [
                'label' => 'Alamat Supplier',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'no_hp_supplier' => [
                'label' => 'No HP Supplier',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'id_user' => [
                'label' => 'User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('errors', 'Data gagal disimpan');
            return redirect()->to('/Supplier')->withInput();
        }

        $this->supplierModel->insert([
            'id_supplier' => Uuid::uuid4()->toString(),
            'id_user' => $this->request->getPost('id_user'),
            'nama_supplier' => $this->request->getPost('nama_supplier'),
            'alamat_supplier' => $this->request->getPost('alamat_supplier'),
            'no_hp_supplier' => $this->request->getPost('no_hp_supplier'),
        ]);

        session()->setFlashdata('success', 'Data berhasil disimpan');
        return redirect()->to('/Supplier');
    }

    public function update($id)
    {
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'edit_nama_supplier' => [
                'label' => 'Nama Supplier',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'edit_alamat_supplier' => [
                'label' => 'Alamat Supplier',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'edit_no_hp_supplier' => [
                'label' => 'No HP Supplier',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'edit_id_user' => [
                'label' => 'User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('errors', 'Data gagal diupdate');
            return redirect()->to('/Supplier')->withInput();
        }
        $id_user = $this->request->getPost('edit_id_user');
        $data_supplier = $this->supplierModel->where('id_supplier', $id)->first();
        if($id_user != $data_supplier['id_user']){
            $supplier = $this->supplierModel->where('id_user', $id_user)->first();
            if ($supplier) {
                session()->setFlashdata('errors', 'User sudah terdaftar sebagai supplier');
                return redirect()->to('/Supplier');
            }
        }else{
            $this->supplierModel->save([
            'id_supplier' => $id,
            'id_user' => $id_user,
            'nama_supplier' => $this->request->getPost('edit_nama_supplier'),
            'alamat_supplier' => $this->request->getPost('edit_alamat_supplier'),
            'no_hp_supplier' => $this->request->getPost('edit_no_hp_supplier'),
        ]);

        session()->setFlashdata('success', 'Data berhasil diupdate');
        return redirect()->to('/Supplier');
        }
    }

    public function delete($id)
    {
        $this->supplierModel->delete($id);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/Supplier');
    }

}
?>