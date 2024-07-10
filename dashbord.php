<?php
session_start();
if($_SESSION['status_login'] !=true){
    echo '<script>window.location="login.php"</script>';
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Official Site | dzhtech</title>
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
            <h3>dashbord</h3>
            <div class="box">
                <h4>Selamat Datang <?php echo $_SESSION['a_global']-> name_admin?> di DZH TECH SHOP</h4>
            </div>
        </div>
    </div>

    <!-- footer-->
     <footer>
        <div class="container">
            <small>Copyright &copy; 2024 - DZH TECH.</small>
        </div>
     </footer>



</body> 
</html>