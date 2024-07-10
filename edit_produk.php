<?php
    session_start();
    include 'koneksi.php';
    if($_SESSION['status_login'] !=true){
        echo '<script>window.location="login.php"</script>';
    }

    $produk=mysqli_query($conn,"SELECT * FROM tb_produk WHERE id_produk='".$_GET['id']."' ");
    if (mysqli_num_rows($produk)==0){
        echo '<script>window.location="data_produk.php"</script>';
    }
    $p=mysqli_fetch_object($produk);

    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Site | dzh</title>
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
            <h1><a href="dashbord.php">DZH TECH SHOP</a></h1>
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
            <h3>Edit Produk</h3>
            <div class="box">
            <button class="btn-primary"><a href="tambah_produk.php">Tambah Produk</a></button> 
               <form action="" method="POST" enctype="multipart/form-data">
                <select class="input-control" name="kategori" required>
                    <option value="">--Pilih--</option>
                    <?php
                        $kategori=mysqli_query($conn,"SELECT * FROM tb_category ORDER BY id_category DESC");
                        while($r=mysqli_fetch_array($kategori)){
    
                    ?>
                    <option value="<?php echo $r['id_category']?>" <?php echo ($r['id_category'] == $p->id_category)? 'selected':''; ?>><?php echo $r['nama_category']?></option>
                    <?php 
                    }
                    ?>
                </select>
                <input type="text" name="nama" class="input-control" placeholder="Nama Produk" value= "<?php echo $p->name_produk?>" required>
                <input type="text" name="harga" class="input-control" placeholder="Harga Produk" value="<?php echo $p->harga_produk?>" required>
                
                <img src ="produk/<?php echo $p->gambar_produk?>" width="100px">
                <input type="hidden" name="foto" value="<?php echo $p->gambar_produk?>"> 
                <input type="file" name="gambar" class="input-control">
                <textarea class="input-control" name="deskripsi" placeholder="Deskripsi"><?php echo $p->deskripsi_produk?></textarea>
                <select class="input-control" name="status">
                    <option value="">--Pilih--</option>
                    <option value="1" <?php echo ($p->status_produk == 1 )? 'selected' : '';?>>Aktif</option>
                    <option value="0" <?php echo ($p->status_produk == 0 )? 'selected' : '';?>>Non Aktif</option>

                </select>
                <input type="submit" name="submit" value="Tambah" class="btn">
               </form>
               <?php
                    if(isset($_POST['submit'])){
                        //data inputan dari form
                        $kategori= $_POST['kategori'];
                        $nama= $_POST['nama'];
                        $harga= $_POST['harga'];
                        $deskripsi= $_POST['deskripsi'];
                        $status= $_POST['status'];
                        $foto= $_POST['foto'];

                        //tampung data gambar yang baru 
                        $filename=$_FILES['gambar']['name'];
                        $tmp_name= $_FILES['gambar']['tmp_name'];

                        

                        //jika admin ganti gambar
                        if($filename != ''){
                            $type1 = explode('.',$filename);
                            $type2= $type1[1];

                            $newname='produk'.time().'.'.$type2;

                            //menampung format file yang diijinkan
                            $typeijinkan= array('jpg','jpeg','png','gif');


                            if(!in_array($type2,$typeijinkan)){
                                echo'<script>alert("format file tidak diijinkan")</script>';

                            }else{
                                unlink('./produk/'.$foto);
                                move_uploaded_file($tmp_name,'./produk/'.$newname);
                                $nama_gambar = $newname;
                            }

                        }else{
                             //jika tidak ganti gambar
                            $nama_gambar=$foto;
                        }

                        //query updata data produk
                        $update=mysqli_query($conn, "UPDATE tb_produk SET
                                                id_category='".$kategori."',
                                                name_produk='".$nama."',
                                                harga_produk='".$harga."',
                                                deskripsi_produk='".$deskripsi."',   
                                                gambar_produk='".$nama_gambar."', 
                                                status_produk='".$status."'
                                                WHERE id_produk='".$p->id_produk."' ");

                        if($update){
                            echo '<script>alert("Berhasil Mengubah Produk. Mantap")</script>';
                            echo '<script>window.location="data_produk.php"</script>';
                        }else{
                            echo'gagal men'.mysqli_error($conn);
                        }
                                                
                       
                    }
                
                        
               ?>

               
            </div>

            
    </div>

    <!-- footer-->
     <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - dzhtechshop.</small>
        </div>
     </footer>
     <script>
        CKEDITOR.replace( 'deskripsi' );
     </script>

</body> 
</html>