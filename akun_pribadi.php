<?php 
error_reporting(0);
require 'koneksi.php';
session_start();
require 'cek_login.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data ku</title>
    <meta name="author" content="David Grzyb">
    <meta name="description" content="">

    <!-- Tailwind -->
    <link href="https://unpkg.com/tailwindcss/dist/tailwind.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css?family=Karla:400,700&display=swap');
        .font-family-karla { font-family: karla; }
        .bg-sidebar { background: #3d68ff; }
        .cta-btn { color: #3d68ff; }
        .upgrade-btn { background: #1947ee; }
        .upgrade-btn:hover { background: #0038fd; }
        .active-nav-link { background: #1947ee; }
        .nav-item:hover { background: #1947ee; }
        .account-link:hover { background: #3d68ff; }
    </style>
</head>
<body class="bg-gray-100 font-family-karla flex">

    <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
        <div class="p-6">
            <a href="Dashboard.php" class=" mb-5 text-white text-2xl font-semibold uppercase hover:text-gray-300">Klinik Theresia</a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="Dashboard.php" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="data_user.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-users mr-3"></i>
                Data User
            </a>
            <a href="data_pasien.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-hospital-user mr-3"></i>
                Pasien
            </a>
            <a href="data_dokter.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-user-nurse mr-3"></i>
                Dokter
            </a>
            <a href="data_poliklinik.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-clinic-medical mr-3"></i>
                Poliklinik
            </a>
            <a href="data_tindakan.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-check-double mr-3"></i>
                Tindakan
            </a>
            <a href="data_obat.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
                <i class="fas fa-pills mr-3"></i>
                Obat
            </a>
        </nav>
           <center>
            <a href="data_layanan.php" class="w-full bg-white cta-btn font-semibold py-2 mt-2 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center" style="width: 80%;">
                <i class="fas fa-plus mr-3" style="color: red;"></i> Layanan
            </a>
        </center>
        <a href="rekam_medis.php" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
            <i class="fas fa-arrow-circle-up mr-3"></i>
            Rekam Medis
        </a>
    </aside>

    <div class="w-full flex flex-col h-screen overflow-y-hidden">
        <!-- Desktop Header -->
        <header class="w-full items-center bg-white py-2 px-6 hidden sm:flex">
            <div class="w-1/2"></div>
            <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                <div class="block">
                    <?php  
                        if (@$_SESSION['ses_username_akun']) {
                            $username_akun = $_SESSION['ses_username_akun'];
                        }
$query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username_akun' ") or die(mysqli_errno());
$hasil = mysqli_fetch_array($query);
                    ?>
                   <h2 class="text-blue-500 mr-4 text-right"><?php echo $hasil['nama_lengkap_user'] ?></h2>
                   <p class="text-gray-400 mr-4 text-right"><?php echo $hasil['level_user'] ?></p>
                </div>
                <button @click="isOpen = !isOpen" class="realtive z-10 w-12 h-12 rounded-full overflow-hidden border-4 border-gray-400 hover:border-gray-300 focus:border-gray-300 focus:outline-none">
                    <img src="https://source.unsplash.com/uJ8LNVCBjFQ/400x400">
                </button>
                <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                <div x-show="isOpen" class="absolute w-32 bg-white rounded-lg shadow-lg py-2 mt-16">
                    <a href="akun_pribadi.php" class="block px-4 py-2 account-link hover:text-white">Akun saya</a>
                    <a href="logout.php" class="block px-4 py-2 account-link hover:text-white">Keluar</a>
                </div>
            </div>
        </header>

        <!-- Mobile Header & Nav -->
        <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
            <div class="flex items-center justify-between">
                <a href="Dashboard.php" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">Klinik Theresia</a>
                <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                    <i x-show="!isOpen" class="fas fa-bars"></i>
                    <i x-show="isOpen" class="fas fa-times"></i>
                </button>
            </div>

            <!-- Dropdown Nav -->
            <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                <a href="Dashboard.php" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                    <i class="fas fa-tachometer-alt mr-3"></i>
                    Dashboard
                </a>
                <a href="data_user.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-users mr-3"></i>
                    Data User
                </a>
                <a href="data_pasien.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-hospital-user mr-3"></i>
                    Pasien
                </a>
                <a href="data_dokter.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-user-nurse mr-3"></i>
                    Dokter
                </a>
                <a href="data_poliklinik.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-clinic-medical mr-3"></i>
                    Poliklinik
                </a>
                <a href="data_tindakan.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-check-double mr-3"></i>
                    Tindakan
                </a>
                <a href="data_obat.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-pills mr-3"></i>
                    Obat
                </a>
                <a href="data_layanan.php" class="w-full bg-white cta-btn font-semibold py-2 pl-4 mt-1 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center" style="width: 50%; text-align: left;">
                        <i class="fas fa-plus mr-3" style="color: red;"></i> Layanan
                </a>
                <a href="akun_pribadi.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-user mr-3"></i>
                    Akun Saya
                </a>
                <a href="logout.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
                    <i class="fas fa-sign-out-alt mr-3"></i>
                    Keluar
                </a>
                <a href="rekam_medis.php" class="w-full bg-white cta-btn font-semibold py-2 mt-3 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                    <i class="fas fa-arrow-circle-up mr-3"></i> Rekam Medis
                </a>
            </nav>
            <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
        </header>
    
        <div class="w-full h-screen overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <!-- Content goes here! 😁 -->
                <h1 class="text-3xl text-black pb-5" style="margin-bottom: -1%;">
                      <i class="fas fa-list mr-3"></i>Akun Saya
                </h1>

<div class="w-full mt-6" x-data="{ openTab: 1 }">
                    <div>
                        <ul class="flex border-b">
                            <li class="-mb-px mr-1" @click="openTab = 1">
                                <a :class="openTab === 1 ? 'border-l border-t border-r rounded-t text-blue-700 font-semibold' : 'text-blue-500 hover:text-blue-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">Informasi</a>
                            </li>
                            <li class="mr-1" @click="openTab = 2">
                                <a :class="openTab === 2 ? 'border-l border-t border-r rounded-t text-blue-700 font-semibold' : 'text-blue-500 hover:text-blue-800'" class="bg-white inline-block py-2 px-4 font-semibold" href="#">Ubah akun saya</a>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white p-6">

<!-- PROFIL-->
<div id="" class="" x-show="openTab === 1">  
       <table class="w-full md:flex-shrink-0 leading-loose">
                 <tr>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">Username</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">:</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3"><?php echo $hasil['username'] ?></td>
                 </tr> 
                 <tr>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">Nama Lengkap</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">:</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3"><?php echo $hasil['nama_lengkap_user'] ?></td>
                 </tr> 
                 <tr>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">Hak Akses</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">:</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3"><?php echo $hasil['level_user'] ?></td>
                 </tr> 
                 <tr>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">Alamat</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">:</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3"><?php echo $hasil['alamat_user'] ?></td>
                 </tr>  
                 <tr>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">No HP/WA</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">:</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3"><?php echo $hasil['nomor_telepon_user'] ?></td>
                 </tr>  
     </table>
</div>




<div id="" class="" x-show="openTab === 2">
<form action="" method="POST">
<table class="w-full md:flex-shrink-0 leading-loose">
    <input type="hidden" name="id" value="<?php echo $id; ?>" value="<?php echo $id; ?>">

                 <tr>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">Username</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">:</td>
                     <td ><input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" type="text" name="edit_username" value="<?php echo $hasil['username'] ?>"></td>
                 </tr> 
                 <tr>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">Nama Lengkap</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">:</td>
                     <td><input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" type="text" name="edit_nama" value="<?php echo $hasil['nama_lengkap_user'] ?>"></td>
                 </tr> 
                 <tr>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">Alamat</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">:</td>
                     <td>
                         <textarea class="pl-5 w-full text-gray-700 bg-gray-200 rounded" name="edit_alamat_user" value="<?php echo $hasil['alamat_user'] ?>" style="margin-left: 0%;"><?php echo $hasil['alamat_user'] ?>
                         </textarea>
                     </td>
                 </tr>  
                 <tr>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">No HP/WA</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">:</td>
                     <td><input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" type="text" name="edit_telp" value="<?php echo $hasil['nomor_telepon_user'] ?>"></td>
                 </tr>  
                 <tr>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">Hak Akses</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">:</td>
                     <td>
                        <div class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" style="color: red;">Maaf, Hak akses uses tak bisa diubah</div>
                     </td>
                 </tr> 
                 <tr>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">Password</td>
                     <td class="text-lg text-gray-800 font-medium mb-1 mt-3">:</td>
                     <td><input class="w-full px-5 py-1 text-gray-700 bg-gray-200 rounded" type="password" name="edit_password" value="<?php echo $hasil['password'] ?>"></td>
                 </tr>
                 <tr>
                     <td></td>
                     <td></td>
                     <td>
                         <button class="mt-3 px-4 py-1 text-white font-light tracking-wider bg-gray-900 rounded" style="float: right;" type="submit" name="simpan_edit_akun">Simpan
                         </button>
                     </td>
                 </tr>   
                </table>
            </form>

 <?php

if (@$_SESSION['ses_id']) {
    $id_akun = $_SESSION['ses_id'];
}

if(isset($_POST['simpan_edit_akun'])){
$edit_username = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['edit_username'])));
$edit_nama = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['edit_nama'])));
$edit_alamat_user = 
mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['edit_alamat_user'])));
$edit_telp = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['edit_telp'])));
$edit_password = mysqli_real_escape_string($conn, htmlspecialchars(trim($_POST['edit_password'])));

$update = mysqli_query ($conn , "UPDATE tb_user SET
username = '".$edit_username."',
nama_lengkap_user = '".$edit_nama."',
alamat_user = '".$edit_alamat_user."',
nomor_telepon_user = '".$edit_telp ."',
password = '".$edit_password ."' WHERE username = '$username_akun' ");

if($update){
  echo '<script>alert("Update Berhasil!");</script>';
  echo '<script>window.location="akun_pribadi.php"</script>';
}else {
  echo '<script>alert("Edit Data Gagal");</script>'; 
  echo '<script>window.location="akun_pribadi.php"</script>'; 
}

}
 ?>
                        </div>
                    </div>
                </div>
            </main>
    
            <footer class="w-full bg-white text-right p-4">
                Built by <a target="_blank" href="https://github.com/theresia-alfareja" class="underline">Theresia Alfareja</a>.
            </footer>
        </div>
        
    </div>

    <!-- AlpineJS -->
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <!-- Font Awesome -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/js/all.min.js" integrity="sha256-KzZiKy0DWYsnwMF+X1DvQngQ2/FxF7MF3Ff72XcpuPs=" crossorigin="anonymous"></script>
</body>
</html>
