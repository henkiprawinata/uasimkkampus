<?php
    session_start();
    include 'koneksi.php';
    if($_SESSION['status_login'] !=true){
        echo '<script>window.location="login.php"</script>';
    }
    $kategori = mysqli_query($conn, "SELECT * FROM tb_category WHERE id_category= '".$_GET['id']."' ");
    if(mysqli_num_rows($kategori)==0){
        echo '<script>window.location="data_kategori.php"</script>';
    }
    $k=mysqli_fetch_object($kategori); 

    
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
            <h1><a href="dashbord.php">DZH TECH SHOP </a></h1>
            <ul>
            <li><a href="dashbord.php"> Dashboard</a></li>
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
            <h3>Edit Kategori</h3>
            <div class="box">
               <form action="" method="POST">
                <input type="text" name="nama" placeholder="Nama Kategori" class ="input-control" value="<?php echo $k->nama_category?>" required>
                
                <input type="submit" name="submit" value="Edit" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])){
                        $nama= ucwords($_POST['nama']);

                        $update= mysqli_query($conn, "UPDATE tb_category SET 
                                                nama_category='".$nama."' 
                                                WHERE id_category='".$k->id_category."' ");


                    if ($update){
                        echo '<script>alert("Edit Kategori Berhasil. Mantap")</script>';
                        echo '<script>window.location="data_kategori.php"</script>';
                    }else{
                        echo ' gagal men';
                    }
                    }
               ?>

               
            </div>

            
    </div>

    <!-- footer-->
     <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - MtdBike.</small>
        </div>
     </footer>



</body> 
</html>