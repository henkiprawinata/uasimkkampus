<?php
session_start();
include 'koneksi.php';
if($_SESSION['status_login'] !=true){
    echo '<script>window.location="login.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Site | dzh tech shop</title>
    <link rel="stylesheet" type="text/css" href ="css/style.css" style="color:white;"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">


</head>
<body>
    <!-- header-->
    <header>
        <div class="container"> 
            <h1><a href="dashbord.php">DZH TECH SHOP </a></h1>
            <ul>
            <li><a href="dashbord.php"> Dashboar</a></li>
            <li><a href="profil.php"> Profil</a></li>
            <li><a href="data_kategori.php"> Data Kategori</a></li>
            <li><a href="data_produk.php"> Data Produk</a></li>
            <li><a href="keluar.php"> Keluar</a></li>
            </ul>
    </div>
    </header>


    <!-- content-->
    
    <div class="section">
        <div class="container">
            <h3>Produk</h3>
            <div class="box">
                <button class="btn-primary"><a href="tambah_produk.php">Tambah Produk</a></button> 
               <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th>Nama Produk</th>
                            <th>Harga</th>
                            <th>Gambar</th>
                            <th>Status</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        $produk = mysqli_query($conn, "SELECT * FROM tb_produk LEFT JOIN tb_category USING (id_category) ORDER BY id_produk DESC");
                        if(mysqli_num_rows($produk)>0){
                            while ($row=mysqli_fetch_array($produk)){
                        ?>
                        <tr>
                            <td><?php echo $no++?></td>
                            <td><?php echo $row['nama_category']?></td>
                            <td><?php echo $row['name_produk']?></td>
                            <td>Rp.<?php echo number_format($row['harga_produk'])?></td>
                            <td><a href="produk /<?php echo $row['gambar_produk']?>" target="_blank"><img src="produk /<?php echo $row['gambar_produk']?>" width="50px"></a></td>
                            <td><?php echo ($row['status_produk']==0)?'Tidak Aktif':'Aktif';?></td>
                            <td>
                                <a href="edit_produk.php?id= <?php echo $row['id_produk']?>">Edit</a> || <a href = "hapus_kategori.php?idp= <?php echo $row['id_produk']?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" >Hapus</a>
                            </td>
                        </tr>
                        <?php
                            }
                        }else{ ?>
                            <tr>
                                <td colspan="7">Tidak Ada Data</td>
                            </tr>
                        <?php } ?>
                        
                    </tbody>
                    </table>
            </div>
        </div>
    </div>

    <!-- footer-->
     <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - dzhtechshop.</small>
        </div>
     </footer>



</body> 
</html>