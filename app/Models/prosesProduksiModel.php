<?php 
namespace App\Models;
use CodeIgniter\Model;

class prosesProduksiModel extends Model
{
    protected $table = 'proses_produksi';
    protected $primaryKey = 'id_proses_produksi';
    protected $allowedFields = ['id_proses_produksi', 'id_produksi', 'id_bahan ', 'panjang', 'harga_bahan', 'status_proses_produksi'];
    
    public function getProsesProduksi($id = false)
    {
        if($id === false){
            return $this
            ->select('proses_produksi.id_proses_produksi, proses_produksi.id_produksi, proses_produksi.id_bahan, proses_produksi.panjang, proses_produksi.harga_bahan, proses_produksi.status_proses_produksi, bahan.nama_bahan as nama_bahan, produksi.id_produksi, produksi.id_supplier, produksi.tgl_permintaan, produksi.ket_produksi, produksi.tgl_proses, produksi.tgl_selesai, produksi.status_produksi, supplier.nama_supplier, supplier.id_supplier')
            ->join('bahan', 'bahan.id_bahan = proses_produksi.id_bahan')
            ->join('produksi', 'produksi.id_produksi = proses_produksi.id_produksi')
            ->join('supplier', 'supplier.id_supplier = produksi.id_supplier')
            ->findAll();
        } else {
            return $this
            ->select('proses_produksi.id_proses_produksi, proses_produksi.id_produksi, proses_produksi.id_bahan, proses_produksi.panjang, proses_produksi.harga_bahan, proses_produksi.status_proses_produksi, bahan.nama_bahan as nama_bahan, produksi.id_produksi, produksi.id_supplier, produksi.tgl_permintaan, produksi.ket_produksi, produksi.tgl_proses, produksi.tgl_selesai, produksi.status_produksi, supplier.nama_supplier, supplier.id_supplier')
            ->join('bahan', 'bahan.id_bahan = proses_produksi.id_bahan')
            ->join('produksi', 'produksi.id_produksi = proses_produksi.id_produksi')
            ->join('supplier', 'supplier.id_supplier = produksi.id_supplier')
            ->where(['id_proses_produksi' => $id])
            ->first();
        }
    }

    public function getProsesProduksiByIdProduksi($id)
    {
        return $this
        ->select('proses_produksi.id_proses_produksi, proses_produksi.id_produksi, proses_produksi.id_bahan, proses_produksi.panjang, proses_produksi.harga_bahan, proses_produksi.status_proses_produksi, bahan.nama_bahan as nama_bahan, produksi.id_produksi, produksi.id_supplier, produksi.tgl_permintaan, produksi.ket_produksi, produksi.tgl_proses, produksi.tgl_selesai, produksi.status_produksi, supplier.nama_supplier, supplier.id_supplier')   
        ->join('bahan', 'bahan.id_bahan = proses_produksi.id_bahan')
        ->join('produksi', 'produksi.id_produksi = proses_produksi.id_produksi')
        ->join('supplier', 'supplier.id_supplier = produksi.id_supplier')
        ->where(['proses_produksi.id_produksi' => $id])
        ->first();
    }

}


?>