<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BuildMatch - Wujudkan Bangunan Impian Tanpa Drama</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Alpine.js for interactions -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.13.3/dist/cdn.min.js"></script>
    
    <!-- Boxicons CDN -->
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--color-cream-soft);
            color: #1A1A1A;
        }
        
        .bento-card {
            background-color: var(--color-cream-card);
            border: 1px solid rgba(139, 43, 15, 0.08);
            border-radius: 24px;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.03);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .bento-card:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 12px 30px -4px rgba(139, 43, 15, 0.08);
            border-color: rgba(139, 43, 15, 0.15);
        }

        .mockup-shadow {
            box-shadow: 0 25px 50px -12px rgba(139, 43, 15, 0.15);
        }
        
        /* Floating Animation */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
            100% { transform: translateY(0px); }
        }
        .animate-float {
            animation: float 6s ease-in-out infinite;
        }
        .animate-float-delayed {
            animation: float 6s ease-in-out infinite;
            animation-delay: 2s;
        }
    </style>
</head>
<body class="antialiased overflow-x-hidden selection:bg-terracotta-light selection:text-white">

    <!-- Navigation -->
    <nav class="fixed w-full z-50 transition-all duration-300 backdrop-blur-md bg-cream-soft/80 border-b border-terracotta/10" x-data="{ scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <div class="flex items-center gap-2">
                <div class="w-11 h-11 rounded-xl bg-terracotta flex items-center justify-center flex-shrink-0">
                    <svg width="32" height="32" viewBox="0 0 192 192" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_nav)">
                            <path d="M78.3518 44.3721C82.0099 44.6681 85.6302 43.4573 88.3741 41.02L101.045 29.765C104.064 27.0835 108.685 27.357 111.367 30.3759L113.037 32.2559C114.796 34.2365 114.616 37.2684 112.636 39.0277C109.481 41.8297 111.22 47.046 115.425 47.3944L133.534 48.8951C140.23 49.45 145.307 55.1713 145.062 61.8862L142.763 124.842C142.636 128.339 139.617 131.024 136.128 130.741C132.85 130.476 130.362 127.675 130.485 124.388L132.067 82.1701C132.508 70.3985 123.599 60.3682 111.858 59.4178L69.751 56.0096C66.4705 55.744 63.9812 52.9416 64.1045 49.6527C64.2356 46.156 67.255 43.474 70.7428 43.7562L78.3518 44.3721Z" fill="#FEFBF9"/>
                            <path d="M52.5684 144.206C53.4872 145.24 54.7818 145.858 56.1646 145.928C57.5475 145.993 58.8966 145.496 59.9085 144.558L113.377 94.8379C118.297 90.2627 118.663 82.596 114.201 77.5728C109.739 72.5496 102.082 72.0089 96.9587 76.3553L41.2812 123.588C40.2278 124.479 39.5785 125.763 39.4792 127.144C39.383 128.522 39.8465 129.884 40.7627 130.915L52.5684 144.206Z" fill="#FEFBF9"/>
                        </g>
                        <defs><clipPath id="clip0_nav"><rect width="135.342" height="135.342" fill="white" transform="translate(101.189) rotate(48.3871)"/></clipPath></defs>
                    </svg>
                </div>
                <span class="text-xl font-bold tracking-tight"><span class="text-terracotta">Build</span><span class="text-gray-900">Match</span></span>
            </div>
            
            <div class="hidden md:flex items-center gap-8 font-medium text-sm text-gray-700">
                <a href="#how-it-works" class="hover:text-terracotta transition-colors">Cara Kerja</a>
                <a href="#features" class="hover:text-terracotta transition-colors">Fitur</a>
                <a href="#cara-mulai" class="hover:text-terracotta transition-colors">Aplikasi</a>
            </div>

            <div class="flex items-center gap-4">
                <a href="{{ route('login') }}" class="bg-terracotta text-white px-5 py-2.5 rounded-full font-medium text-sm shadow-sm hover:bg-terracotta-dark hover:scale-105 transition-all duration-300">
                    Masuk
                </a>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-28 pb-20 lg:pt-36 lg:pb-28 overflow-hidden">
        <!-- Abstract Background Shapes -->
        <div class="absolute top-0 right-0 -mr-40 -mt-40 w-[600px] h-[600px] rounded-full bg-terracotta/5 blur-3xl"></div>
        <div class="absolute bottom-0 left-0 -ml-40 -mb-40 w-[500px] h-[500px] rounded-full bg-terracotta-light/10 blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 grid lg:grid-cols-2 gap-16 items-start">
            <!-- Copy -->
            <div class="max-w-2xl pt-2">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-terracotta/10 text-terracotta text-xs font-semibold mb-6 border border-terracotta/20">
                    <span class="relative flex h-2 w-2">
                      <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-terracotta opacity-75"></span>
                      <span class="relative inline-flex rounded-full h-2 w-2 bg-terracotta"></span>
                    </span>
                    Platform Konstruksi #1 di Indonesia
                </div>
                <h1 class="text-5xl lg:text-7xl font-extrabold tracking-tight leading-[1.1] mb-6 text-gray-900">
                    Wujudkan Bangunan Impian <span class="text-transparent bg-clip-text bg-gradient-to-r from-terracotta to-terracotta-light">Tanpa Drama.</span>
                </h1>
                <p class="text-lg lg:text-xl text-gray-600 mb-8 leading-relaxed font-light">
                    Hubungkan pemilik proyek dengan arsitek & kontraktor terverifikasi dalam satu platform berbasis milestone yang aman dan transparan.
                </p>

                <!-- Quick Feature Pills -->
                <div class="flex flex-wrap gap-3 mb-8">
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-200 text-sm text-gray-700">
                        <svg class="w-4 h-4 text-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Mitra Terverifikasi
                    </div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-200 text-sm text-gray-700">
                        <svg class="w-4 h-4 text-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Pembayaran Aman
                    </div>
                    <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-white border border-gray-200 text-sm text-gray-700">
                        <svg class="w-4 h-4 text-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Laporan Real-time
                    </div>
                </div>

                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="#how-it-works" class="border-2 border-gray-300 text-gray-700 px-8 py-4 rounded-full font-semibold text-center hover:border-terracotta hover:text-terracotta hover:-translate-y-1 transition-all duration-300">
                        Pelajari Selengkapnya
                    </a>
                </div>
                
                <!-- Trust Indicators -->
                <div class="mt-12 flex items-center gap-6 pt-8 border-t border-gray-200/60">
                    <div class="flex -space-x-3">
                        <img class="w-10 h-10 rounded-full border-2 border-cream-soft" src="https://i.pravatar.cc/100?img=1" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-cream-soft" src="https://i.pravatar.cc/100?img=2" alt="User">
                        <img class="w-10 h-10 rounded-full border-2 border-cream-soft" src="https://i.pravatar.cc/100?img=3" alt="User">
                        <div class="w-10 h-10 rounded-full border-2 border-cream-soft bg-cream-dark flex items-center justify-center text-xs font-bold text-gray-600">+1k</div>
                    </div>
                    <div class="text-sm">
                        <span class="font-bold text-gray-900">1,000+</span> proyek<br>berhasil dibangun
                    </div>
                </div>
            </div>

            <!-- Dashboard Mockup -->
            <div class="flex items-start justify-center pt-12">
                <!-- Inner wrapper: mockup + floating card are positioned relative to this -->
                <div class="relative w-full max-w-[500px]">
                    <!-- Main Mockup -->
                    <div class="relative z-20 w-full bg-white rounded-3xl mockup-shadow border border-gray-100 overflow-hidden animate-float">
                        <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl bg-terracotta/10 flex items-center justify-center text-terracotta">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                                </div>
                                <div>
                                    <h3 class="font-bold text-gray-900 text-sm">Rumah Modern Tropis</h3>
                                    <p class="text-xs text-gray-500">Jakarta Selatan</p>
                                </div>
                            </div>
                            <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-bold">On Progress</span>
                        </div>
                        <div class="p-6">
                            <div class="flex justify-between items-end mb-2">
                                <span class="text-sm font-semibold text-gray-600">Progress Pembangunan</span>
                                <span class="text-2xl font-bold text-terracotta">65%</span>
                            </div>
                            <div class="w-full bg-gray-100 rounded-full h-3 mb-6 overflow-hidden">
                                <div class="bg-gradient-to-r from-terracotta to-terracotta-light h-3 rounded-full" style="width: 65%"></div>
                            </div>
                            
                            <div class="space-y-4">
                                <div class="flex items-center gap-4 p-4 rounded-2xl bg-cream-soft border border-cream-dark">
                                    <div class="w-12 h-12 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-bold text-gray-900">Termin 1: Pondasi & Struktur</h4>
                                        <p class="text-xs text-gray-500 mt-1">Selesai & Dibayar</p>
                                    </div>
                                    <span class="font-semibold text-sm text-gray-900">Rp 150Jt</span>
                                </div>
                                <div class="flex items-center gap-4 p-4 rounded-2xl bg-white border border-terracotta/20 shadow-sm relative overflow-hidden">
                                    <div class="absolute left-0 top-0 bottom-0 w-1 bg-terracotta"></div>
                                    <div class="w-12 h-12 rounded-full bg-terracotta/10 flex items-center justify-center text-terracotta animate-pulse">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-bold text-gray-900">Termin 2: Dinding & Atap</h4>
                                        <p class="text-xs text-terracotta mt-1">Menunggu Verifikasi</p>
                                    </div>
                                    <span class="font-semibold text-sm text-gray-900">Rp 200Jt</span>
                                </div>
                                <div class="flex items-center gap-4 p-4 rounded-2xl bg-gray-50 border border-gray-100">
                                    <div class="w-12 h-12 rounded-full bg-gray-200 flex items-center justify-center text-gray-400">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-sm font-bold text-gray-400">Termin 3: Finishing & Interior</h4>
                                        <p class="text-xs text-gray-300 mt-1">Belum Dimulai</p>
                                    </div>
                                    <span class="font-semibold text-sm text-gray-400">Rp 150Jt</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Floating Architect Element — positioned relative to inner mockup wrapper -->
                    <div class="absolute -bottom-6 -left-8 z-30 bg-white p-4 rounded-2xl mockup-shadow border border-gray-100 flex items-center gap-4 animate-float-delayed">
                        <img src="https://ui-avatars.com/api/?name=Rifat+Djibran&background=8B2B0F&color=fff" alt="Rifat Djibran" class="w-12 h-12 rounded-full border-2 border-terracotta/20 object-cover">
                        <div>
                            <h4 class="text-sm font-bold text-gray-900">Rifat Djibran</h4>
                            <p class="text-xs text-gray-500">Arsitek<br>+6212312344321</p>
                        </div>
                        <div class="w-8 h-8 rounded-full bg-green-100 flex items-center justify-center text-green-600 ml-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>

                    <!-- Floating Rating Card — bottom right -->
                    <div class="absolute -bottom-12 -right-6 z-30 bg-white px-5 py-3 rounded-2xl mockup-shadow border border-gray-100 animate-float">
                        <div class="flex items-center gap-1 mb-1">
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                            <svg class="w-4 h-4 text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                        </div>
                        <p class="text-xs font-bold text-gray-900">4.9 Rating Klien</p>
                        <p class="text-[10px] text-gray-400">dari 500+ ulasan</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Value Proposition (Trust Factor) -->
    <section id="how-it-works" class="py-24 bg-cream-card relative border-y border-terracotta/5 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-16">
                <h2 class="text-sm font-bold text-terracotta tracking-wider uppercase mb-3">Keamanan Transaksi</h2>
                <h3 class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-6">Smart Payment Milestone</h3>
                <p class="text-gray-600 text-lg">Bayar dengan aman melalui Virtual Account untuk setiap fase pembangunan. Dana hanya akan diteruskan ke mitra ketika progres dilaporkan dan Anda menyetujuinya.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 relative">
                <!-- Connecting lines -->
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-terracotta/20 -translate-y-1/2 z-0"></div>

                <!-- Step 1 -->
                <div class="relative z-10 bento-card p-8 text-center bg-white">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-cream-soft flex items-center justify-center mb-6 border border-terracotta/10 text-terracotta text-2xl font-bold">1</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Setor Dana Termin</h4>
                    <p class="text-gray-600 text-sm">Transfer aman via Virtual Account. Dana ditahan oleh sistem escrow BuildMatch.</p>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 bento-card p-8 text-center bg-white border-2 border-terracotta/20 transform md:-translate-y-4">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-terracotta flex items-center justify-center mb-6 text-white shadow-lg shadow-terracotta/30 text-2xl font-bold">2</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Laporan Progres</h4>
                    <p class="text-gray-600 text-sm">Kontraktor mengunggah foto lapangan dan dokumen PDF bukti selesainya fase tersebut.</p>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 bento-card p-8 text-center bg-white">
                    <div class="w-16 h-16 mx-auto rounded-2xl bg-cream-soft flex items-center justify-center mb-6 border border-terracotta/10 text-terracotta text-2xl font-bold">3</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-3">Verifikasi & Cair</h4>
                    <p class="text-gray-600 text-sm">Anda cek laporannya. Jika sesuai, cukup klik setuju dan dana diteruskan ke kontraktor.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Feature Showcase (Bento Box Layout) -->
    <section id="features" class="py-32 scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="mb-20 text-center">
                <h2 class="text-4xl md:text-5xl font-extrabold text-gray-900 mb-6">Ekosistem Terintegrasi</h2>
                <p class="text-xl text-gray-600 max-w-2xl mx-auto">Satu platform yang didesain khusus untuk menyatukan pemilik proyek, kontraktor, dan arsitek.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-6 lg:gap-8">
                
                <!-- A. Untuk Klien -->
                <div class="bento-card p-8 md:col-span-8 flex flex-col justify-between overflow-hidden relative group">
                    <div class="absolute right-0 top-0 w-64 h-64 bg-terracotta/5 rounded-full blur-3xl -mr-20 -mt-20 transition-all duration-500 group-hover:bg-terracotta/10"></div>
                    <div class="relative z-10 mb-8">
                        <div class="inline-block px-4 py-1.5 rounded-full bg-white border border-terracotta/20 text-terracotta font-bold text-sm mb-6">Untuk Klien</div>
                        <h3 class="text-2xl font-bold text-gray-900 mb-4">Kendali Penuh Atas Proyek Anda</h3>
                        <ul class="space-y-4">
                            <li class="flex items-start gap-3">
                                <div class="mt-1 w-6 h-6 rounded-full bg-terracotta/10 flex items-center justify-center flex-shrink-0 text-terracotta">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div>
                                    <span class="font-bold text-gray-900 block">Smart Custom Project Form</span>
                                    <span class="text-gray-500 text-sm">Tentukan luas tanah, budget, & gaya desain dengan integrasi OpenStreetMap.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="mt-1 w-6 h-6 rounded-full bg-terracotta/10 flex items-center justify-center flex-shrink-0 text-terracotta">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div>
                                    <span class="font-bold text-gray-900 block">Bidding Transparan</span>
                                    <span class="text-gray-500 text-sm">Bandingkan penawaran harga, durasi, dan portofolio kontraktor dengan mudah.</span>
                                </div>
                            </li>
                            <li class="flex items-start gap-3">
                                <div class="mt-1 w-6 h-6 rounded-full bg-terracotta/10 flex items-center justify-center flex-shrink-0 text-terracotta">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                </div>
                                <div>
                                    <span class="font-bold text-gray-900 block">Partner Hub</span>
                                    <span class="text-gray-500 text-sm">Cari dan filter Arsitek serta Kontraktor yang telah diverifikasi.</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- B. Untuk Arsitek -->
                <div class="bento-card p-8 md:col-span-4 flex flex-col bg-white">
                    <div class="inline-block self-start px-4 py-1.5 rounded-full bg-cream-card border border-terracotta/10 text-gray-700 font-bold text-sm mb-6">Untuk Arsitek</div>
                    <h3 class="text-xl font-bold text-gray-900 mb-6">Tingkatkan Kredibilitas</h3>
                    
                    <div class="bg-cream-soft rounded-2xl p-5 mb-6 border border-cream-dark">
                        <div class="flex items-center gap-3 mb-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center text-blue-600 font-bold text-sm">STRA</div>
                            <div>
                                <h4 class="font-bold text-gray-900 text-sm">Integrasi STRA</h4>
                                <p class="text-xs text-gray-500">Terverifikasi Resmi</p>
                            </div>
                        </div>
                        <p class="text-sm text-gray-600">Tampilkan lisensi resmi Anda untuk mendapatkan kepercayaan penuh dari klien kelas atas.</p>
                    </div>

                    <div class="flex items-center gap-3 p-4 rounded-xl border border-gray-100 bg-white shadow-sm">
                        <div class="w-8 h-8 rounded-full bg-terracotta/10 flex items-center justify-center text-terracotta">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        </div>
                        <span class="text-sm font-semibold text-gray-800">Konsultasi & Blueprint Chat</span>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <!-- 1. Langkah Mudah Memulai (Cara Mulai) -->
    <section id="cara-mulai" class="py-24 bg-white relative overflow-hidden scroll-mt-20">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center max-w-3xl mx-auto mb-20">
                <h2 class="text-sm font-bold text-terracotta tracking-wider uppercase mb-3">Cara Kerja</h2>
                <h3 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-6">Mulai dalam 3 Langkah Mudah</h3>
                <p class="text-gray-600 text-lg">Platform kami memandu Anda dari pencarian ide hingga serah terima kunci, semua dalam satu genggaman.</p>
            </div>

            <div class="grid md:grid-cols-3 gap-8 relative">
                <!-- Line connector for desktop -->
                <div class="hidden md:block absolute top-1/2 left-10 right-10 h-0.5 bg-gradient-to-r from-terracotta/10 via-terracotta/30 to-terracotta/10 -translate-y-1/2 z-0"></div>
                
                <!-- Step 1 -->
                <div class="relative z-10 bg-cream-soft rounded-3xl p-8 border border-terracotta/10 hover:-translate-y-2 transition-transform duration-300 shadow-sm hover:shadow-xl hover:shadow-terracotta/10 group">
                    <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center text-terracotta font-bold text-2xl shadow-sm mb-8 border border-terracotta/20 group-hover:bg-terracotta group-hover:text-white transition-colors duration-300">1</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Temukan Ahlinya</h4>
                    <p class="text-gray-600 leading-relaxed mb-6">Cari dan bandingkan portofolio kontraktor serta arsitek terverifikasi yang sesuai dengan gaya dan *budget* Anda.</p>
                    <div class="h-32 bg-white rounded-xl border border-gray-100 overflow-hidden relative p-4 flex flex-col gap-3">
                        <div class="w-full h-8 bg-gray-50 rounded-lg flex items-center px-3 gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            <div class="w-24 h-2 bg-gray-200 rounded"></div>
                        </div>
                        <div class="flex gap-2">
                            <div class="w-10 h-10 bg-terracotta/10 rounded-full"></div>
                            <div class="flex-1 flex flex-col justify-center gap-2">
                                <div class="w-20 h-2 bg-gray-200 rounded"></div>
                                <div class="w-12 h-2 bg-gray-100 rounded"></div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative z-10 bg-cream-soft rounded-3xl p-8 border border-terracotta/10 hover:-translate-y-2 transition-transform duration-300 shadow-sm hover:shadow-xl hover:shadow-terracotta/10 group">
                    <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center text-terracotta font-bold text-2xl shadow-sm mb-8 border border-terracotta/20 group-hover:bg-terracotta group-hover:text-white transition-colors duration-300">2</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Sepakati Proposal</h4>
                    <p class="text-gray-600 leading-relaxed mb-6">Buat deskripsi proyek, terima penawaran (bidding), dan sepakati milestone pembayaran dengan aman.</p>
                    <div class="h-32 bg-white rounded-xl border border-gray-100 overflow-hidden relative p-4 flex flex-col gap-3">
                        <div class="flex justify-between items-center mb-2">
                            <div class="w-16 h-3 bg-gray-200 rounded"></div>
                            <div class="w-8 h-4 bg-green-100 rounded"></div>
                        </div>
                        <div class="w-full h-12 bg-terracotta/5 rounded-lg border border-terracotta/10 flex items-center px-3">
                            <div class="w-6 h-6 rounded-full bg-terracotta text-white flex items-center justify-center text-[10px]">✓</div>
                            <div class="ml-3 w-20 h-2 bg-terracotta/40 rounded"></div>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative z-10 bg-cream-soft rounded-3xl p-8 border border-terracotta/10 hover:-translate-y-2 transition-transform duration-300 shadow-sm hover:shadow-xl hover:shadow-terracotta/10 group">
                    <div class="w-16 h-16 rounded-2xl bg-white flex items-center justify-center text-terracotta font-bold text-2xl shadow-sm mb-8 border border-terracotta/20 group-hover:bg-terracotta group-hover:text-white transition-colors duration-300">3</div>
                    <h4 class="text-xl font-bold text-gray-900 mb-4">Pantau & Bayar</h4>
                    <p class="text-gray-600 leading-relaxed mb-6">Pantau laporan foto mingguan dari kontraktor dan setujui pencairan dana termin hanya saat target tercapai.</p>
                    <div class="h-32 bg-white rounded-xl border border-gray-100 overflow-hidden relative p-4 flex flex-col justify-center">
                        <div class="flex justify-between mb-2">
                            <span class="text-xs font-bold text-gray-400">Progres</span>
                            <span class="text-xs font-bold text-terracotta">75%</span>
                        </div>
                        <div class="w-full h-2 bg-gray-100 rounded-full overflow-hidden mb-4">
                            <div class="w-[75%] h-full bg-terracotta rounded-full"></div>
                        </div>
                        <button class="w-full py-2 bg-terracotta text-white rounded-lg text-xs font-bold">Cairkan Termin</button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 2. Numbers that Matter -->
    <section class="py-12 bg-cream-card border-y border-terracotta/10">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-8 divide-x divide-terracotta/10">
                <div class="text-center px-4">
                    <div class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">150+</div>
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider mt-2">Mitra Terverifikasi</div>
                </div>
                <div class="text-center px-4">
                    <div class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">Rp 20M+</div>
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider mt-2">Nilai Proyek</div>
                </div>
                <div class="text-center px-4">
                    <div class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">100%</div>
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider mt-2">Pembayaran Aman</div>
                </div>
                <div class="text-center px-4">
                    <div class="text-3xl md:text-4xl font-extrabold text-gray-900 mb-2">4.9/5</div>
                    <div class="text-sm font-medium text-gray-500 uppercase tracking-wider mt-2">Rating Klien</div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Call to Action (CTA) Immersive -->
    <section class="py-24 relative overflow-hidden">
        <div class="absolute inset-0 bg-gradient-to-br from-terracotta-dark via-terracotta to-terracotta-light z-0"></div>
        <!-- Decorative blobs -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl -mr-20 -mt-20 z-0"></div>
        <div class="absolute bottom-0 left-0 w-96 h-96 bg-black/10 rounded-full blur-3xl -ml-20 -mb-20 z-0"></div>
        
        <div class="max-w-4xl mx-auto px-6 relative z-10 text-center text-white">
            <h2 class="text-4xl md:text-6xl font-extrabold mb-6 leading-tight">Siap Wujudkan Bangunan Impian Tanpa Drama?</h2>
            <p class="text-lg md:text-xl text-white/80 mb-10 max-w-2xl mx-auto">Bergabunglah dengan ribuan pemilik proyek dan mitra profesional lainnya di ekosistem konstruksi paling inovatif di Indonesia.</p>
        </div>
    </section>

    <!-- 4. Modern Fat Footer -->
    <footer class="bg-gray-900 text-gray-400 py-20 border-t-8 border-terracotta">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-12 gap-12 lg:gap-8">
            
            <!-- Column 1: Brand & Description -->
            <div class="md:col-span-5 lg:col-span-5">
                <div class="flex items-center gap-3 mb-6">
                    <div class="w-11 h-11 rounded-xl bg-terracotta flex items-center justify-center flex-shrink-0">
                        <svg width="32" height="32" viewBox="0 0 192 192" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_footer)">
                                <path d="M78.3518 44.3721C82.0099 44.6681 85.6302 43.4573 88.3741 41.02L101.045 29.765C104.064 27.0835 108.685 27.357 111.367 30.3759L113.037 32.2559C114.796 34.2365 114.616 37.2684 112.636 39.0277C109.481 41.8297 111.22 47.046 115.425 47.3944L133.534 48.8951C140.23 49.45 145.307 55.1713 145.062 61.8862L142.763 124.842C142.636 128.339 139.617 131.024 136.128 130.741C132.85 130.476 130.362 127.675 130.485 124.388L132.067 82.1701C132.508 70.3985 123.599 60.3682 111.858 59.4178L69.751 56.0096C66.4705 55.744 63.9812 52.9416 64.1045 49.6527C64.2356 46.156 67.255 43.474 70.7428 43.7562L78.3518 44.3721Z" fill="#FEFBF9"/>
                                <path d="M52.5684 144.206C53.4872 145.24 54.7818 145.858 56.1646 145.928C57.5475 145.993 58.8966 145.496 59.9085 144.558L113.377 94.8379C118.297 90.2627 118.663 82.596 114.201 77.5728C109.739 72.5496 102.082 72.0089 96.9587 76.3553L41.2812 123.588C40.2278 124.479 39.5785 125.763 39.4792 127.144C39.383 128.522 39.8465 129.884 40.7627 130.915L52.5684 144.206Z" fill="#FEFBF9"/>
                            </g>
                            <defs><clipPath id="clip0_footer"><rect width="135.342" height="135.342" fill="white" transform="translate(101.189) rotate(48.3871)"/></clipPath></defs>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold tracking-tight"><span class="text-terracotta-light">Build</span><span class="text-white">Match</span></span>
                </div>
                <p class="text-gray-500 text-sm leading-relaxed mb-8 max-w-sm">
                    Platform konstruksi premium yang menghubungkan pemilik proyek dengan arsitek dan kontraktor terverifikasi dalam satu ekosistem yang aman dan terpercaya.
                </p>
                <div class="flex flex-wrap gap-3">
                    <!-- Badges as requested by photo structure -->
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-gray-700 text-xs font-medium text-gray-400">
                        <svg class="w-3.5 h-3.5 text-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8V7a4 4 0 00-8 0v4h8z"></path></svg>
                        Keamanan Siber 100%
                    </div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-gray-700 text-xs font-medium text-gray-400">
                        <svg class="w-3.5 h-3.5 text-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Mitra Terverifikasi STRA
                    </div>
                    <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full border border-gray-700 text-xs font-medium text-gray-400">
                        <svg class="w-3.5 h-3.5 text-terracotta" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                        Pembayaran Aman
                    </div>
                </div>
                
                <!-- App Download Buttons -->
                <div class="flex flex-wrap gap-4 mt-8">
                    <div class="flex items-center gap-3 bg-gray-800 border border-gray-700 rounded-xl px-5 py-2.5 cursor-default select-none hover:bg-gray-700 transition-colors">
                        <i class='bx bxl-apple text-[32px] text-white'></i>
                        <div class="flex flex-col">
                            <span class="text-[10px] uppercase font-semibold text-gray-400 leading-none">Download on the</span>
                            <span class="text-base font-bold text-white leading-tight mt-1">App Store</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3 bg-gray-800 border border-gray-700 rounded-xl px-5 py-2.5 cursor-default select-none hover:bg-gray-700 transition-colors">
                        <i class='bx bxl-play-store text-[30px] text-white'></i>
                        <div class="flex flex-col">
                            <span class="text-[10px] uppercase font-semibold text-gray-400 leading-none">GET IT ON</span>
                            <span class="text-base font-bold text-white leading-tight mt-1">Google Play</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Column 2: Navigasi Cepat -->
            <div class="md:col-span-3 lg:col-span-3">
                <h4 class="font-bold text-white mb-6">Navigasi Cepat</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-terracotta mt-1.5 flex-shrink-0"></span>
                        <a href="#" class="hover:text-white transition-colors">Beranda & Profil BuildMatch</a>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-terracotta mt-1.5 flex-shrink-0"></span>
                        <a href="#" class="hover:text-white transition-colors">Cara Kerja Sistem BuildMatch</a>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-terracotta mt-1.5 flex-shrink-0"></span>
                        <a href="#" class="hover:text-white transition-colors">Fitur Utama & Keunggulan</a>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-terracotta mt-1.5 flex-shrink-0"></span>
                        <a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan Pengguna</a>
                    </li>
                    <li class="flex items-start gap-3">
                        <span class="w-1.5 h-1.5 rounded-full bg-terracotta mt-1.5 flex-shrink-0"></span>
                        <a href="#" class="hover:text-white transition-colors">Kebijakan Privasi Data Klien</a>
                    </li>
                </ul>
            </div>

            <!-- Column 3: Informasi (Project Identity) -->
            <div class="md:col-span-4 lg:col-span-4">
                <h4 class="font-bold text-white mb-6">Informasi</h4>
                <ul class="space-y-6 text-sm">
                    <li class="flex gap-4">
                        <svg class="w-5 h-5 text-terracotta mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        <div>
                            <div class="font-bold text-white uppercase tracking-wider text-xs mb-1">UNIVERSITAS</div>
                            <div class="text-gray-400">Politeknik Negeri Malang</div>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <svg class="w-5 h-5 text-terracotta mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <div>
                            <div class="font-bold text-white uppercase tracking-wider text-xs mb-1">SEMESTER</div>
                            <div class="text-gray-400">Genap 2025/2026</div>
                        </div>
                    </li>
                    <li class="flex gap-4">
                        <svg class="w-5 h-5 text-terracotta mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2 2v2m4 6h.01M5 20h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        <div>
                            <div class="font-bold text-white uppercase tracking-wider text-xs mb-1">SIB2E</div>
                            <div class="text-gray-400">Kelompok 3 (Buildmatch)</div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        
        <!-- Bottom Bar -->
        <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-gray-800 text-center text-xs">
            <div class="text-gray-500">
                &copy; 2026 BuildMatch (Politeknik Negeri Malang). Hak Cipta Dilindungi.
            </div>
        </div>
    </footer>

</body>
</html>
