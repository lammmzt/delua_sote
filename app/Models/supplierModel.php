<?php 
namespace App\Models;

use CodeIgniter\Model;

class supplierModel extends Model
{
    protected $table = 'supplier';
    protected $primaryKey = 'id_supplier';
    protected $allowedFields = ['id_supplier', 'id_user', 'nama_supplier', 'alamat_supplier', 'no_hp_supplier'];

    public function getsupplier($id = false)
    {
        if ($id == false) {
            return $this
            ->select('supplier.id_supplier, supplier.nama_supplier, supplier.alamat_supplier, supplier.no_hp_supplier, users.nama_user, users.id_user')
            ->join('users', 'users.id_user = supplier.id_user')
            ->findAll();
        }
        return $this
        ->select('supplier.id_supplier, supplier.nama_supplier, supplier.alamat_supplier, supplier.no_hp_supplier, users.nama_user as nama_user, users.id_user')
        ->join('users', 'users.id_user = supplier.id_user')
        ->where(['id_supplier' => $id])
        ->first();
    }
}
?>