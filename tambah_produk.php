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
<script src="https://cdn.ckeditor.com/4.24.0-lts/standard/ckeditor.js"></script>


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
            <h3>Tambah Produk</h3>
            <div class="box">
            <button class="btn-primary"><a href="tambah_produk.php">Tambah Produk</a></button> 
               <form action="" method="POST" enctype="multipart/form-data">
                <select class="input-control" name="kategori" required>
                    <option value="">--Pilih--</option>
                    <?php
                        $kategori=mysqli_query($conn,"SELECT * FROM tb_category ORDER BY id_category DESC");
                        while($r=mysqli_fetch_array($kategori)){
    
                    ?>
                    <option value="<?php echo $r['id_category']?>"><?php echo $r['nama_category']?></option>
                    <?php 
                    }
                    ?>
                </select>
                <input type="text" name="nama" class="input-control" placeholder="Nama Produk" required>
                <input type="text" name="harga" class="input-control" placeholder="Harga Produk" required>
                <input type="file" name="gambar" class="input-control"  required>
                <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"></textarea>
                <select class="input-control" name="status">
                    <option value="">--Pilih--</option>
                    <option value="1">Aktif</option>
                    <option value="0">Non Aktif</option>

                </select>
                <input type="submit" name="submit" value="Tambah" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])){

                        //print_r($_FILES['gambar']);

                        //menampung inputan dari form
                        $kategori= $_POST['kategori'];
                        $nama= $_POST['nama'];
                        $harga= $_POST['harga'];
                        $deskripsi= $_POST['deskripsi'];
                        $status= $_POST['status'];


                        //menampung data file yang diupload
                        $filename=$_FILES['gambar']['name'];
                        $tmp_name= $_FILES['gambar']['tmp_name'];

                        $type1 = explode('.',$filename);
                        $type2= $type1[1];

                        $newname='produk'.time().'.'.$type2;

                        //menampung format file yang diijinkan
                        $typeijinkan= array('jpg','jpeg','png','gif');

                        //validasi format file
                        if(!in_array($type2,$typeijinkan)){
                            echo'format file tidak diijinkan';
                        }else{
                            move_uploaded_file($tmp_name,'./produk/'.$newname);

                            $insert = mysqli_query($conn, "INSERT INTO tb_produk VALUES(
                                        null,
                                        '".$kategori."',
                                        '".$nama."',
                                        '".$harga."',
                                        '".$deskripsi."',
                                        '".$newname."',
                                        '".$status."',
                                        null

                                            )");

                            if($insert){
                                echo '<script>alert("Berhasil Menambah Produk. Mantap")</script>';
                                echo '<script>window.location="data_produk.php"</script>';
                            }else{
                                echo'gagal men'.mysqli_error($conn);
                            }
                        }
                        //proses input file skaligus insert kedatabase


                    }
                        
               ?>

               
            </div>

            
    </div>

    <!-- footer-->
     <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - DZH TECH SHOP.</small>
        </div>
     </footer>
     <script>
        CKEDITOR.replace( 'deskripsi' );
     </script>

</body> 
</html>