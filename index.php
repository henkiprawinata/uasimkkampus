<?php

include 'koneksi.php';

$admin=mysqli_query($conn,"SELECT email_admin, telp_admin, alamat_admin FROM tb_admin WHERE id_admin= 2 ");
$a=mysqli_fetch_object($admin);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Site | dzhtech</title>
    <link rel="stylesheet" type="text/css" href ="css/style.css" > 
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">


</head>
<body>
    <!-- header-->
    <header>
        <div class="container"> 
            <h1><a href="index.php">DZH TECH  SHOP </a></h1>
            <ul>
            <li><a href="produk.php"> Produk</a></li>
            
            </ul>
    </div>
    </header>

    <!-- seacrh-->
     <div class="search">
        <div class="container">
            <form action="produk.php">
                <input type="text" name="search" placeholder= "Cari Produk">
                <input type="submit" name="cari" value="cari produk">
            </form>
        </div>
     </div>

    <!-- <div>
        <img src="img/lenovo.jpg" width="100px">
     </div>-->

    <!--kategori-->
    <div class="section">
        <div class="container">
            <h3>kategori Produk</h3>
            <div class="box">
                <?php
                $kategori=mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC");
                if(mysqli_num_rows($kategori)>0){
                    while($k =mysqli_fetch_array($kategori)){
                ?>
                <a href ="produk.php?kat= <?php echo $k['id_category']?>">
                <div class="col-5">
                    <img src="img/kattegori.png" width="48px" style="margin-bottom:1px">
                    <p><?php echo $k['nama_category']?></p>
                </div>

                
                </a>
                
                <?php }} else{?>
                    <p>Kategori Tidak Ada</p>
                    <?php }?>
                

            </div>
        </div>
    </div>
    <img src="img/kattegori.png" width="48px" style="margin-bottom:1px">

    <!--produk-->
    <div class="section">
        <div class="container">
            <h3>Produk Terbaru</h3>
            <div class="box">
                <?php
                $produk=mysqli_query($conn,"SELECT * FROM tb_produk WHERE status_produk=1 ORDER BY id_produk DESC LIMIT 12");
                if(mysqli_num_rows($produk)>0){
                    while($p= mysqli_fetch_array($produk)){
                ?>
                <a href="detail_produk.php?id=<?php echo $p['id_produk']?>">
                <div class="col-4">
                    <img src="produk/<?php echo $p['gambar_produk']?>">
                    <p clas= "nama"><?php echo $p['name_produk']?></p>
                    <p class="harga">Rp.<?php echo number_format($p['harga_produk']) ?></p>
                </div>
                </a>
                <?php }} else{ ?>
                    <p>Produk Sedang Tidak Tersedia</p>
                    <?php }?>
            </div>
        </div>
    </div>

   
    <!-- footer-->
     <div class="footer">
        <div class="container">
            <h3>Alamat</h3>
            <p><?php echo $a->alamat_admin ?></p>

            <h3>Email</h3>
            <p><?php echo $a->email_admin?></p>

            <h3>Telp</h3>
            <p><?php echo $a->telp_admin?></p>
            <small>Copyright &copy; 2024 - DZH TECH Shop.</small>
        </div>
        </div>
     </footer>



</body> 
</html>