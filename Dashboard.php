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
    <style>
         /* Tab content - closed */
         .tab-content {
         max-height: 0;
         -webkit-transition: max-height .35s;
         -o-transition: max-height .35s;
         transition: max-height .35s;
         }
         /* :checked - resize to full height */
         .tab input:checked ~ .tab-content {
         max-height: 50vh;
         }
      </style>
</head>
<body class="bg-gray-100 font-family-karla flex">

 <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl" style="">
        <div class="p-6">
            <a href="Dashboard.php" class=" mb-5 text-white text-2xl font-semibold uppercase hover:text-gray-300">Klinik Theresia</a>
        </div>
        <nav class="text-white text-base font-semibold pt-3">
            <a href="Dashboard.php" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="data_user.php" class="flex items-center text-white opacity-75 hover:opacity-100 py-4 pl-6 purple-item">
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
            </nav>
            <!-- <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                <i class="fas fa-plus mr-3"></i> New Report
            </button> -->
        </header>
    
        <div class="w-full overflow-x-hidden border-t flex flex-col">
            <main class="w-full flex-grow p-6">
                <h1 class="text-3xl text-black pb-6">Dashboard</h1>
    
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
    <!-- ChartJS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>

    <script>
        var chartOne = document.getElementById('chartOne');
        var myChart = new Chart(chartOne, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        var chartTwo = document.getElementById('chartTwo');
        var myLineChart = new Chart(chartTwo, {
            type: 'line',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });
    </script>


    <script>
      /* Optional Javascript to close the radio button version by clicking it again */
      var myRadios = document.getElementsByName('tabs2');
      var setCheck;
      var x = 0;
      for(x = 0; x < myRadios.length; x++){
          myRadios[x].onclick = function(){
              if(setCheck != this){
                   setCheck = this;
              }else{
                  this.checked = false;
                  setCheck = null;
          }
          };
      }
   </script>
</body>
</html>
