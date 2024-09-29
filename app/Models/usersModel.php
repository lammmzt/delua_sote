<?php 
namespace App\Models;

use CodeIgniter\Model;

class usersModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id_user';
    protected $allowedFields = ['id_user', 'username','password','role','nama_user'];

    public function getUsers($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this
            ->where(['id_user' => $id])
            ->first();
        }   
    }

}
?>