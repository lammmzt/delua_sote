<?php 

namespace App\Controllers;

use App\Models\usersModel;
use Ramsey\Uuid\Uuid;

class Users extends BaseController
{
    protected $usersModel;
    
    public function __construct()
    {
        $this->usersModel = new usersModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Users',
            'main_menu' => 'Master Data',
            'main_menu_active' => 'data_users',
            'validation' => \Config\Services::validation(),
            'users' => $this->usersModel->findAll(),
        ];
        return view('Admin/Users/index', $data);
    }

    public function save(){
        $validation =  \Config\Services::validation();
        $validation->setRules([
            'username' => [
                'label' => 'Username',
                'rules' => 'required|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('errors', 'Data gagal disimpan');
            return redirect()->to('/Users')->withInput();
        } else {
            $id_user = Uuid::uuid4()->toString();

            $data = [
                'id_user' => $id_user,
                'username' => $this->request->getPost('username'),
                'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
                'role' => $this->request->getPost('role'),
                'nama_user' => $this->request->getPost('nama_user'),
            ];

            $this->usersModel->insert($data);
            session()->setFlashdata('success', 'Data berhasil disimpan');
            return redirect()->to('/Users');

        }
    }

    public function updateUser($id_user)
    {
        $validation =  \Config\Services::validation();
        $users = $this->usersModel->find($id_user); 
        // dd($users);
        $username = $this->request->getPost('edit_username');
        $password = $this->request->getPost('edit_password');
        
        if($username == $users['username']){
            $is_unique = 'required';
        } else {
            $is_unique = 'required|is_unique[users.username]';
        }
        
        $validation->setRules([
            'edit_username' => [
                'label' => 'Username',
                'rules' => 'required|'.$is_unique,
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                    'is_unique' => '{field} sudah ada',
                ],
            ],
            'edit_role' => [
                'label' => 'Role',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
            'edit_nama_user' => [
                'label' => 'Nama User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} tidak boleh kosong',
                ],
            ],
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            session()->setFlashdata('errors', 'Data gagal diubah');
            return redirect()->to('/Users')->withInput();
        } else {
            if ($password != $users['password']) {
                $password = password_hash($this->request->getPost('edit_password'), PASSWORD_DEFAULT);
            }
            $data = [
                'username' => $this->request->getPost('edit_username'),
                'role' => $this->request->getPost('edit_role'),
                'nama_user' => $this->request->getPost('edit_nama_user'),
                'password' => $password,
            ];
            // dd($data);
            $this->usersModel->update($id_user, $data);
            session()->setFlashdata('success', 'Data berhasil diubah');
            return redirect()->to('/Users');

        }
    }

    public function Delete($id_user)
    {
        $this->usersModel->delete($id_user);
        session()->setFlashdata('success', 'Data berhasil dihapus');
        return redirect()->to('/Users');
    }
    
}

?>