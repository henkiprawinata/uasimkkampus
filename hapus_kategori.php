<?php
include 'koneksi.php';

if(isset($_GET['idk'])){
    $delete=mysqli_query($conn, "DELETE FROM tb_category WHERE id_category='".$_GET['idk']."' ");
    echo '<script>window.location="data_kategori.php"</script>';
}

if(isset($_GET['idp'])){
    $produk=mysqli_query($conn, "SELECT gambar_produk FROM tb_produk WHERE id_produk = '".$_GET['idp']."' ");
    $p=mysqli_fetch_object($produk);

    unlink('./produk/'.$p->gambar_produk);

    $delete=mysqli_query($conn, "DELETE FROM tb_produk WHERE id_produk = '".$_GET['idp']."' ");
    echo '<script>window.location="data_produk.php"</script>';
}
?>