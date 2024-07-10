<?php
    session_start();
    include 'koneksi.php';
    if($_SESSION['status_login'] !=true){
        echo '<script>window.location="login.php"</script>';
    }

    $query = mysqli_query($conn, "SELECT * FROM tb_admin WHERE id_admin='".$_SESSION['id']."' ");
    $d=mysqli_fetch_object($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Site | DZH.IT</title>
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
            <h3>Profil</h3>
            <div class="box">
               <form action="" method="POST">
                <input type="text" name="nama" placeholder="Nama Lengkap" class ="input-control" value="<?php echo  $d->name_admin ?>" required>
                <input type="text" name="user" placeholder="Username" class ="input-control" value="<?php echo   $d->username ?>" required>
                <input type="text" name="hp" placeholder="Nomor HP" class ="input-control" value="<?php echo   $d->telp_admin ?>"required>
                <input type="email" name="email" placeholder="Email" class ="input-control" value="<?php echo   $d->email_admin ?>" required>
                <input type="text" name="alamat" placeholder="Alamat" class ="input-control" value="<?php echo   $d->alamat_admin ?>"required>
                <input type="submit" name="submit" value="Ubah Profil" class="btn">
               </form>

               <?php
               if(isset($_POST['submit'])){
                $nama = ucwords($_POST['nama']);
                $user = $_POST['user'];
                $hp = $_POST['hp'];
                $email = $_POST['email'];
                $alamat = ucwords($_POST['alamat']);

                $update = mysqli_query($conn, "UPDATE tb_admin SET
                                name_admin='".$nama."',
                                username='".$user."',
                                telp_admin='".$hp."',
                                email_admin='".$email."',
                                alamat_admin='".$alamat."'
                                WHERE id_admin='".$_SESSION['a_global']->id_admin."' ");

                if($update){
                    echo '<script>alert("Ubah Data Admin Berhasil")</script>';
                    echo '<script>window.location="profil.php"</script>';
                }else{
                    echo 'gagal men'.mysqli_error($conn);
                }
               }
               ?>
            </div>

            <h3>Ubah Password</h3>
            <div class="box">
               <form action="" method="POST">
                <input type="password" name="pass1" placeholder="Password Baru" class ="input-control" required>
                <input type="password" name="pass2" placeholder="Konfirmasi Password Baru" class ="input-control" required>
                <input type="submit" name="ubah_password" value="Ubah Profil" class="btn">
               </form>

               <?php
               if(isset($_POST['ubah_password'])){
                
                $pass1 = $_POST['pass1'];
                $pass2 = $_POST['pass2'];

                if (pass2 != pass1){
                    echo '<script>alert("konfirmasi password salah. buat betul-betul")</script>';
                }else{
                    $u_pass = mysqli_query($conn, "UPDATE tb_admin SET
                                password='".MD5($pass1)."', 
                                WHERE id_admin='".$_SESSION['a_global']->id_admin."' ");

                    if(u_pass){
                        echo '<script>alert("Ubah password Admin Berhasil")</script>';
                    echo '<script>window.location="profil.php"</script>';

                    }else{
                        echo 'gagal men'.mysqli_error($conn);
                    }

                }
                
            }
               ?>
        </div>
    </div>

    <!-- footer-->
     <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - dzhtech.</small>
        </div>
     </footer>



</body> 
</html>