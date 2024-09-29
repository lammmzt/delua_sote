<?php 
namespace App\Models;

use CodeIgniter\Model;

class jenisProdukModel extends Model
{
    protected $table = 'jenis_produk';
    protected $primaryKey = 'id_jenis_produk';
    protected $allowedFields = ['id_jenis_produk','id_produk', 'nama_jenis_produk', 'deskripsi', 'harga_jadi', 'harga_jual', 'stok_produk'];
    
    public function getJenisProduk($id = false)
    {
        if($id === false){
            return $this
            ->select('jenis_produk.id_jenis_produk, produk.nama_produk, jenis_produk.nama_jenis_produk, jenis_produk.deskripsi, jenis_produk.harga_jadi, jenis_produk.harga_jual, jenis_produk.stok_produk, jenis_produk.id_produk')
            ->join('produk', 'produk.id_produk = jenis_produk.id_produk')
            ->findAll();
        } else {
            return $this
            ->select('jenis_produk.id_jenis_produk, produk.nama_produk, jenis_produk.nama_jenis_produk, jenis_produk.deskripsi, jenis_produk.harga_jadi, jenis_produk.harga_jual, jenis_produk.stok_produk, jenis_produk.id_produk')
            ->join('produk', 'produk.id_produk = jenis_produk.id_produk')
            ->Where(['id_jenis_produk' => $id])
            ->first();
        }   
    }

}


?>