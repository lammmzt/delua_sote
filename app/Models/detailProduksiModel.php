<?php 

namespace App\Models;

use CodeIgniter\Model;

class detailProduksiModel extends Model
{
    protected $table = 'detail_produksi';
    protected $primaryKey = 'id_detail_produksi';
    protected $allowedFields = ['id_detail_produksi', 'id_produksi', 'id_jenis_produk', 'jumlah_permintaan_produksi', 'catatan_produksi','jumlah_hasil_produksi', 'status_detail_produksi'];

    public function getDetailProduksi($id = false)
    {
        if($id === false){
            return $this
            ->select('detail_produksi.id_detail_produksi, detail_produksi.id_produksi, detail_produksi.id_jenis_produk, detail_produksi.jumlah_permintaan_produksi, detail_produksi.catatan_produksi, detail_produksi.jumlah_hasil_produksi, detail_produksi.status_detail_produksi, jenis_produk.nama_jenis_produk, jenis_produk.id_jenis_produk, produk.nama_produk')
            ->join('jenis_produk', 'jenis_produk.id_jenis_produk = detail_produksi.id_jenis_produk')
            ->join('produk', 'produk.id_produk = jenis_produk.id_produk')
            ->findAll();
        } else {
            return $this
            ->select('detail_produksi.id_detail_produksi, detail_produksi.id_produksi, detail_produksi.id_jenis_produk, detail_produksi.jumlah_permintaan_produksi, detail_produksi.catatan_produksi, detail_produksi.jumlah_hasil_produksi, detail_produksi.status_detail_produksi, jenis_produk.nama_jenis_produk as nama_jenis_produk, jenis_produk.id_jenis_produk, produk.nama_produk')
            ->join('jenis_produk', 'jenis_produk.id_jenis_produk = detail_produksi.id_jenis_produk')
            ->join('produk', 'produk.id_produk = jenis_produk.id_produk')
            ->where(['id_detail_produksi' => $id])
            ->first();
        }
    }

    public function getDetailProduksiByIdProduksi($id)
    {
        return $this
          ->select('detail_produksi.id_detail_produksi, detail_produksi.id_produksi, detail_produksi.id_jenis_produk, detail_produksi.jumlah_permintaan_produksi, detail_produksi.catatan_produksi, detail_produksi.jumlah_hasil_produksi, detail_produksi.status_detail_produksi, jenis_produk.nama_jenis_produk as nama_jenis_produk, jenis_produk.id_jenis_produk, produk.nama_produk')   
        ->join('jenis_produk', 'jenis_produk.id_jenis_produk = detail_produksi.id_jenis_produk')
        ->join('produk', 'produk.id_produk = jenis_produk.id_produk')
        ->where(['detail_produksi.id_produksi' => $id])
        ->findAll();
    }

}
?>