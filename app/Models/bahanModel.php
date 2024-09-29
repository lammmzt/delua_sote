<?php 
namespace App\Models;

use CodeIgniter\Model;



class bahanModel extends Model
{
    protected $table = 'bahan';
    protected $primaryKey = 'id_bahan';
    protected $allowedFields = ['id_bahan', 'nama_bahan','stok_bahan'];
    
    public function getBahan($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this
            ->where(['id_bahan' => $id])
            ->first();
        }   
    }

}

?>