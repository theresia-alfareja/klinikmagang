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
    <title>Tailwind Admin Template</title>
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
            <a href="Dashboard.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 nav-item">
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
            <a href="data_obat.php" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
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
       $query = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username_akun' ");
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
                <a href="Dashboard.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-2 pl-4 nav-item">
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
                <a href="data_obat.php" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                    <<i class="fas fa-pills mr-3"></i>
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
<?php 
include 'koneksi.php';
?>
<style type="text/css">
    .daftar:hover {color: lightblue;}
    .hakakses:hover {background: #2E9AFE; transition: 0.3s;}
    .akun:hover {background: #00BFFF; transition: 0.3s;}
</style>
<div class="w-full mt-2">

        <h1 class="text-3xl text-black pb-5" style="margin-bottom: -1%;">
              <i class="fas fa-list mr-3"></i>Data Obat-obatan
        </h1>
<div style="float: right;">
<a href="data_merk_obat.php" class="hakakses p-2 mr-2S hover:text-white" style="border:3px solid #2E9AFE;border-radius: 10px;">
    Kelola Merk
</a>
<a href="tambah_obat.php" class="akun p-2 ml-2 hover:text-white" style="border:3px solid #00BFFF;border-radius: 10px;">
    Tambah
</a>
</div>
<br><br>
                    <div class="bg-white overflow-auto mt-1">
                        <table class="min-w-full bg-white">
                            <thead class="bg-gray-800 text-white">
                                <tr>
                                    <th class="text-center text-left py-3 px-4 uppercase font-semibold text-sm">ID</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Nama obat</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Merk</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Satuan obat</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Stok</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Harga beli</th>
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Harga jual</th>  
                                    <th class="text-left py-3 px-4 uppercase font-semibold text-sm">Manfaat</th>
                                </tr>
                            </thead>
<?php
$query = mysqli_query($conn, "SELECT * FROM tb_obat LEFT JOIN tb_merk_obat USING (id_merk_obat) ORDER BY id_obat");
if(mysqli_num_rows($query) > 0)
{
while ($hasil = mysqli_fetch_array($query))
{
?>
<tbody class="text-gray-700">
<tr style="border-bottom: 1px solid #ccc;">
<td  class="px-3 py-3"><?php echo $hasil['id_obat'] ?></td>
<td  class="px-3 py-3"><?php echo $hasil['nama_obat'] ?></td>
<td  class="px-3 py-3"><?php echo $hasil['nama_merk'] ?></td>
<td  class="px-3 py-3"><?php echo $hasil['satuan_obat'] ?></td>
<td  class="px-3 py-3"><?php echo $hasil['stok'] ?></td>
<td  class="px-3 py-3"><?php echo $hasil['harga_beli'] ?></td>
<td  class="px-3 py-3"><?php echo $hasil['harga_jual'] ?></td>
<td  class="px-3 py-3"><?php echo $hasil['manfaat'] ?></td>
</tr>
</tbody>
<?php
}
}
else
{
echo <<< HTML
   <tr class="text-gray-500 dark:text-gray-500">
    <td colspan="8" align="center">Data kosong</td>
   </tr>
HTML;
}
?>
                        </table>
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
