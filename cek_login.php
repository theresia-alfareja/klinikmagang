<?php
//PEMERIKSAAN APAKAH USER SUDAH LOGIN ATAU TIDAK
if(isset($_SESSION['ses_username_akun'])){

    $username_akun = $_SESSION['ses_username_akun'];
    $get_user_data = mysqli_query($conn,"SELECT * FROM tb_user WHERE username = '$username_akun'");
    $userData =  mysqli_fetch_assoc($get_user_data);
}

// APABILA USER BELUM LOGIN
if (!isset($_SESSION['ses_username_akun'])){
      echo '<script>alert("Harus Login dulu!"); document.location="index.php";</script>';
}
// MENGHINDARI KE HALAMAN LOGIN JIKA SUDAH LOGIN

?>