<?php 
namespace App\Models;

use CodeIgniter\Model;

class produkModel extends Model
{
    protected $table = 'produk';
    protected $primaryKey = 'id_produk';
    protected $allowedFields = ['id_produk', 'nama_produk', 'nama_produk'];
    
    public function getProduk($id = false)
    {
        if($id === false){
            return $this->findAll();
        } else {
            return $this->getWhere(['id_produk' => $id]);
        }   
    }

}

?>