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
    <title>Official Site | dzhtechshop</title>
    <link rel="stylesheet" type="text/css" href ="css/style.css" style="color:white;"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">


</head>
<body>
    <!-- header-->
    <header>
        <div class="container"> 
            <h1><a href="dashbord.php">DZH TECH SHOP</a></h1>
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
            <h3>Kategori</h3>
            <div class="box">
                <button class="btn-primary"><a href="tambah_kategori.php">Tambah Kategori</a></button> 
               <table border="1" cellspacing="0" class="table">
                    <thead>
                        <tr>
                            <th width="60px">No</th>
                            <th>Kategori</th>
                            <th width="150px">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no=1;
                        $kategori=mysqli_query($conn, "SELECT * FROM tb_category ORDER BY id_category DESC");
                        if(mysqli_num_rows($kategori) >0){
                        while ($row=mysqli_fetch_array($kategori)){

                        
                        ?>
                        <tr>
                            <td><?php echo $no++?></td>
                            <td><?php echo $row['nama_category']?></td>
                            <td>
                                <a href="edit_kategori.php?id= <?php echo $row['id_category']?>">Edit</a> || <a href = "hapus_kategori.php?idk= <?php echo $row['id_category']?>" onclick="return confirm('Yakin Ingin Menghapus Data?')" >Hapus</a>
                            </td>
                        </tr>
                        <?php }}else{ ?>
                            <tr>
                                <td colspan="3">Tidak Ada Kategori</td>
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