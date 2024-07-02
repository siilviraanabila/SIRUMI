<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agency - Start Bootstrap Theme</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico">
    <!-- Font Awesome icons (free version)-->
    <script src="https://use.fontawesome.com/releases/v5.15.3/js/all.js" crossorigin="anonymous"></script>
    <!-- Google fonts-->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet">
    <!-- Tailwind CSS -->
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <!-- Navigation-->
    <nav class="bg-white p-6 fixed w-full z-10 top-0">
        <div class="container mx-auto flex items-center justify-between flex-wrap">
            <div class="flex items-center flex-shrink-0 text-white mr-6">
              <img src="img/logo.png" alt="Logo" class="w-auto h-10 mr-2">
            </div>
            <div class="block lg:hidden">
                <button id="nav-toggle" class="flex items-center px-3 py-2 border rounded text-gray-500 border-gray-600 hover:text-white hover:border-white">
                    <svg class="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><title>Menu</title><path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/></svg>
                </button>
            </div>
            <div class="w-full flex-grow lg:flex lg:items-center lg:w-auto hidden lg:block pt-6 lg:pt-0" id="nav-content">
                <ul class="list-reset lg:flex justify-end flex-1 items-center">
                    <li class="mr-3">
                        <a class="inline-block text-black no-underline hover:text-gray-500 hover:text-underline py-2 px-4" href="#services">Home</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block text-black no-underline hover:text-gray-500 hover:text-underline py-2 px-4" href="#portfolio">About</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block text-black no-underline hover:text-gray-500 hover:text-underline py-2 px-4" href="#about">Langkah</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block text-black no-underline hover:text-gray-500 hover:text-underline py-2 px-4" href="#team">Team</a>
                    </li>
                    <li class="mr-3">
                        <a class="inline-block text-black no-underline hover:text-gray-500 hover:text-underline py-2 px-4" href="#contact">Contact</a>
                    </li>
                    <li class="mr-3">
                        <a href="#" class="px-4 py-2 rounded-full" style="background-color: #179FB7; color: white; transition: background-color 0.3s;">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Masthead-->
    <header class="bg-cover bg-center bg-fixed w-full h-screen pt-24 flex justify-center items-center" style="background-image: url('img/background1.jpg'); opacity: 0.8;">
        <div class="container mx-auto px-4">
            <div class="text-white text-center">
                <div class="text-3xl font-semibold mb-4">Selamat Datang di Peminjaman Ruang Meeting!</div>
                <div class="text-5xl font-bold mb-8">PT PLN Indonesia Power UBP Semarang</div>
                <a class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-full uppercase text-lg" href="#services">Tell Me More</a>
            </div>
        </div>
    </header>
    <section class="bg-gray text-black body-font" id="services">
      <div class="container px-5 py-24 mx-auto">
        <div class="text-center mb-20">
          <h2 class="text-4xl font-bold text-primary">Services</h2>
          <p class="text-lg text-gray-500">2 Buildings and 3 Facilities</p>
        </div>
        <div class="flex flex-wrap -m-4 text-center">
          <div class="p-4 md:w-1/3">
            <div class="border-2 border-primary p-6 rounded-lg">
              <i class="fas fa-shopping-cart text-5xl text-primary mb-4"></i>
              <h2 class="text-lg font-medium title-font mb-2">Meeting Center</h2>
              <p class="leading-relaxed text-base text-gray-600">Gedung Meeting Center terdiri dari beberapa ruangan yaitu Bima, Srikandi, Drupadi, dan VIP.</p>
            </div>
          </div>
          <div class="p-4 md:w-1/3">
            <div class="border-2 border-primary p-6 rounded-lg">
              <i class="fas fa-laptop text-5xl text-primary mb-4"></i>
              <h2 class="text-lg font-medium title-font mb-2">Puri Parikesit</h2>
              <p class="leading-relaxed text-base text-gray-600">Gedung Puri Parikesit terdiri dari beberapa ruangan yaitu Narotama, Arjuna, dan Pandawa.</p>
            </div>
          </div>
          <div class="p-4 md:w-1/3">
            <div class="border-2 border-primary p-6 rounded-lg">
              <i class="fas fa-lock text-5xl text-primary mb-4"></i>
              <h2 class="text-lg font-medium title-font mb-2">Fasilitas</h2>
              <p class="leading-relaxed text-base text-gray-600">Terdapat 3 fasilitas seperti konsumsi meliputi nasi box, snack, prasmanan, video conference dan proyektor.</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="bg-white text-black body-font" id="about">
      <div class="container px-5 py-24 mx-auto">
        <div class="text-center mb-20">
          <h2 class="text-4xl font-bold text-primary">Company Profile</h2>
        </div>
        <div class="row">
            <div class="col-lg-8 mx-auto text-center"><p class="large text-muted">PT Indonesia Power("IP") merupakan anak perusahaan PT Perusahaan Listrik Negara yang memegang peranan strategis dalam sektor ketenagalistrikan di Indonesia. 
              Kegiatan Utama bisnis perusahaan saat ini yakni sebagai penyedia solusi energi yang andal, inovatif, ramah lingkungan dan melampaui harapan pelanggan.
            </p></div>
        </div>
      </div>
      </div>
    </section>

    <!-- Scripts -->
    <script>
        /*Toggle dropdown list*/
        function toggleMenu() {
            const toggle = document.getElementById('nav-toggle');
            const nav = document.getElementById('nav-content');
            if (nav.classList.contains('hidden')) {
                nav.classList.remove('hidden');
            } else {
                nav.classList.add('hidden');
            }
        }
        //Close dropdown if clicked outside
        window.onclick = function(event) {
            if (!event.target.matches('#nav-toggle')) {
                const navContent = document.getElementById('nav-content');
                if (navContent.classList.contains('hidden')) {
                    navContent.classList.remove('hidden');
                }
            }
        }
    </script>
</body>

</html>
