<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | dzhtechshop</title>
    <link rel="stylesheet" type="text/css" href ="css/style.css" style="color:white;"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">


</head>
<body id="bg-login">
    <div class="box-login">
        <h2>Login</h2>
        <form action ="" method="POST">
            <input type="text" name="user" placeholder="Username" class= "input-control">
            <input type="password" name="password" placeholder="Password"  class= "input-control">
            <input type="submit" name="submit" value="Login" class="btn">

        </form>
        <?php
        if(isset($_POST['submit'])){
            session_start();
            include 'koneksi.php';

            $user=mysqli_real_escape_string($conn, $_POST['user']);
            $password=mysqli_real_escape_string($conn,$_POST['password']);

            $cek= mysqli_query($conn, "SELECT * FROM tb_admin WHERE username = '".$user."' AND password= '".MD5($password)."'");
            if(mysqli_num_rows($cek)>0){
                $d=mysqli_fetch_object($cek);
                $_SESSION['status_login']=true;
                $_SESSION['a_global']=$d;
                $_SESSION['id']=$d->id_admin;

                echo '<script>window.location="dashbord.php"</script>';

            }else{
                echo '<script>alert(" Gagal Login Cuuy, Buat Betul-Betul!")</script>';
            }
        }
        ?>
    </div>
    
</body>
</html>