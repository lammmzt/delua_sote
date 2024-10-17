<?php 
namespace App\Models;

use CodeIgniter\Model;

class produksiModel extends Model
{
    protected $table = 'produksi';
    protected $primaryKey = 'id_produksi';
    protected $allowedFields = ['id_produksi', 'id_supplier', 'tgl_permintaan', 'ket_produksi', 'tgl_proses', 'tgl_selesai', 'status_produksi'];

    public function getProduksi($id = false)
    {
        if($id === false){
            return $this
            ->select('produksi.id_produksi, produksi.id_supplier, produksi.tgl_permintaan, produksi.ket_produksi, produksi.tgl_proses, produksi.tgl_selesai, produksi.status_produksi, supplier.nama_supplier, supplier.id_supplier')
            ->join('supplier', 'supplier.id_supplier = produksi.id_supplier')
            ->findAll();
        } else {
            return $this
            ->select('produksi.id_produksi, produksi.id_supplier, produksi.tgl_permintaan, produksi.ket_produksi, produksi.tgl_proses, produksi.tgl_selesai, produksi.status_produksi, supplier.nama_supplier as nama_supplier, supplier.id_supplier')
            ->join('supplier', 'supplier.id_supplier = produksi.id_supplier')
            ->where(['id_produksi' => $id])
            ->first();
        }   
    }

}
?>