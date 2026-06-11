<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>BuildMatch Onboarding</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-color: #F8F5F2;
            --brand-color: #8C2B0B;
            --brand-hover: #732309;
            --text-dark: #333333;
            --text-light: #666666;
            --accent-circle: #EBCAB6;
            --dot-inactive: #D9D9D9;
            --white: #FFFFFF;
            --transition-speed: 0.4s;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', sans-serif;
            -webkit-tap-highlight-color: transparent;
        }

        body {
            background-color: #E5E5E5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            color: var(--text-dark);
        }

        .app-container {
            width: 100%;
            max-width: 414px;
            height: 100vh;
            max-height: 896px;
            background-color: var(--bg-color);
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
            display: flex;
            flex-direction: column;
        }

        @media (min-width: 415px) {
            .app-container {
                height: 896px;
                border-radius: 40px;
                margin: 20px 0;
            }
        }

        /* --- SPLASH SCREEN --- */
        .splash-screen {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background-color: var(--brand-color);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            z-index: 100;
            color: var(--white);
            transition: opacity 0.6s ease-in-out, visibility 0.6s;
        }
        
        .splash-screen.hidden {
            opacity: 0;
            visibility: hidden;
        }

        .splash-logo {
            width: 80px;
            height: 80px;
            margin-bottom: 24px;
        }

        .splash-title {
            font-size: 32px;
            font-weight: 700;
            margin-bottom: 8px;
            letter-spacing: -0.5px;
        }

        .splash-subtitle {
            font-size: 14px;
            font-weight: 400;
            opacity: 0.9;
        }

        .splash-footer {
            position: absolute;
            bottom: 40px;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.6;
        }

        /* --- ONBOARDING SCREENS --- */
        .onboarding-container {
            flex: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            height: 100%;
        }

        .top-nav {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 16px 24px;
            z-index: 10;
        }

        .time {
            font-weight: 600;
            font-size: 14px;
        }

        .right-icons {
            display: flex;
            gap: 6px;
            align-items: center;
        }

        .icon-signal, .icon-wifi, .icon-battery {
            fill: var(--text-dark);
            height: 12px;
        }

        .skip-btn {
            position: absolute;
            top: 56px;
            right: 24px;
            background: rgba(235, 202, 182, 0.4);
            border: none;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-light);
            cursor: pointer;
            z-index: 10;
            transition: background 0.2s;
        }

        .skip-btn:hover {
            background: rgba(235, 202, 182, 0.7);
        }

        .slides-wrapper {
            flex: 1;
            position: relative;
            width: 100%;
            height: 100%;
        }

        .slide {
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            display: flex;
            flex-direction: column;
            opacity: 0;
            pointer-events: none;
            transform: translateX(20px);
            transition: opacity var(--transition-speed) ease, transform var(--transition-speed) ease;
        }

        .slide.active {
            opacity: 1;
            pointer-events: auto;
            transform: translateX(0);
        }
        
        .slide.slide-out {
            transform: translateX(-20px);
            opacity: 0;
        }

        .slide-image-container {
            flex: 1;
            position: relative;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            padding-bottom: 20px;
        }

        .bg-circle {
            position: absolute;
            border-radius: 50%;
            background-color: var(--accent-circle);
            opacity: 0.8;
        }

        .slide-1 .c1 { width: 100px; height: 100px; top: 10%; left: -20px; }
        .slide-1 .c2 { width: 300px; height: 300px; bottom: 0%; right: -50px; background: radial-gradient(circle, rgba(235,202,182,1) 0%, rgba(248,245,242,0) 70%); }
        .slide-1 .c3 { width: 40px; height: 40px; top: 40%; right: 20px; }

        .slide-2 .c1 { width: 60px; height: 60px; top: 15%; left: 20px; }
        .slide-2 .c2 { width: 350px; height: 350px; top: 30%; left: -100px; background: radial-gradient(circle, rgba(235,202,182,1) 0%, rgba(248,245,242,0) 70%); }
        
        .slide-3 .c1 { width: 80px; height: 80px; top: 10%; left: 30px; }
        .slide-3 .c2 { width: 250px; height: 250px; top: 40%; right: -50px; background: radial-gradient(circle, rgba(235,202,182,1) 0%, rgba(248,245,242,0) 70%); }

        .mockup-img {
            max-width: 80%;
            max-height: 80%;
            object-fit: contain;
            z-index: 2;
            filter: drop-shadow(0 20px 30px rgba(0,0,0,0.1));
            transition: transform 0.3s ease;
        }

        .mockup-img:hover {
            transform: translateY(-5px);
        }

        .slide-content {
            background-color: var(--white);
            border-top-left-radius: 32px;
            border-top-right-radius: 32px;
            padding: 32px 24px 40px;
            box-shadow: 0 -4px 20px rgba(0,0,0,0.03);
            min-height: 320px;
            display: flex;
            flex-direction: column;
            z-index: 5;
        }

        .dots {
            display: flex;
            justify-content: center;
            gap: 8px;
            margin-bottom: 24px;
        }

        .dot {
            width: 8px;
            height: 8px;
            border-radius: 4px;
            background-color: var(--dot-inactive);
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        .dot.active {
            width: 24px;
            background-color: var(--brand-color);
        }

        .slide h2 {
            font-size: 24px;
            font-weight: 700;
            line-height: 1.3;
            margin-bottom: 12px;
            color: var(--text-dark);
        }

        .slide p {
            font-size: 15px;
            line-height: 1.5;
            color: var(--text-light);
            margin-bottom: 32px;
            flex: 1;
        }

        .action-btn {
            background-color: var(--brand-color);
            color: var(--white);
            border: none;
            border-radius: 16px;
            padding: 18px 24px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 8px;
            width: 100%;
            transition: background-color 0.2s, transform 0.1s;
        }

        .action-btn:hover {
            background-color: var(--brand-hover);
        }

        .action-btn:active {
            transform: scale(0.98);
        }

        .action-btn svg {
            width: 18px;
            height: 18px;
            fill: none;
            stroke: currentColor;
            stroke-width: 2;
            stroke-linecap: round;
            stroke-linejoin: round;
        }

    </style>
</head>
<body>

<div class="app-container">

    <!-- Splash Screen -->
    <div id="splashScreen" class="splash-screen">
        <svg class="splash-logo" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M40 70 L60 50 L60 80" stroke="white" stroke-width="8" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M30 45 Q 50 20 70 45" stroke="white" stroke-width="8" stroke-linecap="round" fill="none"/>
            <path d="M70 45 L70 60" stroke="white" stroke-width="8" stroke-linecap="round"/>
            <path d="M25 40 L45 20" stroke="white" stroke-width="8" stroke-linecap="round"/>
            <path d="M45 20 L55 20" stroke="white" stroke-width="8" stroke-linecap="round"/>
            <circle cx="20" cy="45" r="5" fill="white"/>
            <path d="M20 45 L40 65" stroke="white" stroke-width="12" stroke-linecap="round"/>
        </svg>
        <h1 class="splash-title">BuildMatch</h1>
        <p class="splash-subtitle">Jasa Konstruksi Terpercaya</p>
        <p class="splash-footer">POLITEKNIK NEGERI MALANG &bull; 2026</p>
    </div>

    <!-- Onboarding Container -->
    <div class="onboarding-container">
        <!-- Status Bar -->
        <div class="top-nav">
            <span class="time">9:41</span>
            <div class="right-icons">
                <svg class="icon-signal" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M2 22h20V2L2 22z" fill="currentColor"/>
                </svg>
                <svg class="icon-wifi" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 3C7.8 3 3.9 4.8 1.1 7.7l1.4 1.4C4.8 6.6 8.3 5 12 5s7.2 1.6 9.5 4.1l1.4-1.4C20.1 4.8 16.2 3 12 3zm0 4.5c-3.1 0-6 1.3-8 3.5l1.4 1.4c1.6-1.8 4-2.9 6.6-2.9s5 .1 6.6 2.9l1.4-1.4c-2-2.2-4.9-3.5-8-3.5zm0 4.5c-1.9 0-3.6.8-4.8 2.1l1.4 1.4c.8-.9 2-1.5 3.4-1.5s2.6.6 3.4 1.5l1.4-1.4C15.6 12.8 13.9 12 12 12zm0 4.5c-.7 0-1.4.3-1.9.8l1.9 2.4 1.9-2.4c-.5-.5-1.2-.8-1.9-.8z"/>
                </svg>
                <svg class="icon-battery" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M15.67 4H14V2h-4v2H8.33C7.6 4 7 4.6 7 5.33v15.33C7 21.4 7.6 22 8.33 22h7.33c.74 0 1.34-.6 1.34-1.33V5.33C17 4.6 16.4 4 15.67 4z" fill="currentColor"/>
                </svg>
            </div>
        </div>

        <button class="skip-btn" onclick="finishOnboarding()">Lewati</button>

        <div class="slides-wrapper">
            <!-- SLIDE 1 -->
            <div class="slide slide-1 active" id="slide-1">
                <div class="slide-image-container">
                    <div class="bg-circle c1"></div>
                    <div class="bg-circle c2"></div>
                    <div class="bg-circle c3"></div>
                    <img src="/images/slide1.png" alt="Slide 1 Mockup" class="mockup-img" onerror="this.src='https://placehold.co/300x450/EBCAB6/8C2B0B?text=App+Mockup+1'" />
                </div>
                <div class="slide-content">
                    <div class="dots">
                        <span class="dot active"></span>
                        <span class="dot" onclick="goToSlide(2)"></span>
                        <span class="dot" onclick="goToSlide(3)"></span>
                    </div>
                    <h2>Temukan Kontraktor Terpercaya</h2>
                    <p>Cari dan bandingkan kontraktor & arsitek terverifikasi sesuai kebutuhan proyek Anda</p>
                    <button class="action-btn" onclick="goToSlide(2)">
                        Selanjutnya
                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            <!-- SLIDE 2 -->
            <div class="slide slide-2" id="slide-2">
                <div class="slide-image-container">
                    <div class="bg-circle c1"></div>
                    <div class="bg-circle c2"></div>
                    <img src="/images/slide2.png" alt="Slide 2 Mockup" class="mockup-img" onerror="this.src='https://placehold.co/300x450/EBCAB6/8C2B0B?text=App+Mockup+2'" />
                </div>
                <div class="slide-content">
                    <div class="dots">
                        <span class="dot" onclick="goToSlide(1)"></span>
                        <span class="dot active"></span>
                        <span class="dot" onclick="goToSlide(3)"></span>
                    </div>
                    <h2>Ajukan Proyek dengan Mudah</h2>
                    <p>Buat deskripsi proyek, tentukan anggaran, dan terima penawaran dari beberapa kontraktor</p>
                    <button class="action-btn" onclick="goToSlide(3)">
                        Selanjutnya
                        <svg viewBox="0 0 24 24"><path d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </button>
                </div>
            </div>

            <!-- SLIDE 3 -->
            <div class="slide slide-3" id="slide-3">
                <div class="slide-image-container">
                    <div class="bg-circle c1"></div>
                    <div class="bg-circle c2"></div>
                    <img src="/images/slide3.png" alt="Slide 3 Mockup" class="mockup-img" onerror="this.src='https://placehold.co/300x450/EBCAB6/8C2B0B?text=App+Mockup+3'" />
                </div>
                <div class="slide-content">
                    <div class="dots">
                        <span class="dot" onclick="goToSlide(1)"></span>
                        <span class="dot" onclick="goToSlide(2)"></span>
                        <span class="dot active"></span>
                    </div>
                    <h2>Pantau Progres Pembangunan</h2>
                    <p>Monitoring proyek secara real-time melalui laporan foto dan milestone dari kontraktor</p>
                    <button class="action-btn" onclick="finishOnboarding()">
                        Mulai Sekarang
                        <svg viewBox="0 0 24 24" style="fill: currentColor; stroke: none;"><path d="M13.13 22.19L11.5 18.36C13.07 17.78 14.54 17 15.9 16.09L13.13 22.19M5.64 12.5L1.81 10.87L7.91 8.1C7 9.46 6.22 10.93 5.64 12.5M21.61 2.39C21.61 2.39 16.66 2.69 11 8.35C8.84 10.5 7.6 12.7 7 14.15L3.43 12.63L2.2 13.86L6.5 17.5L5 19L6 20L7.5 18.5L11.14 22.8L12.37 21.57L10.85 18C12.3 17.4 14.5 16.16 16.65 14C22.31 8.34 22.61 3.39 22.61 3.39L21.61 2.39Z"/></svg>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Handle Splash Screen
    document.addEventListener('DOMContentLoaded', () => {
        setTimeout(() => {
            const splash = document.getElementById('splashScreen');
            if (splash) {
                splash.classList.add('hidden');
            }
        }, 2000); // Hide splash after 2 seconds
    });

    let currentSlide = 1;

    function goToSlide(slideNum) {
        if (slideNum === currentSlide) return;
        
        const oldSlide = document.getElementById(`slide-${currentSlide}`);
        const newSlide = document.getElementById(`slide-${slideNum}`);
        
        if (oldSlide) {
            oldSlide.classList.remove('active');
            oldSlide.classList.add('slide-out');
        }
        
        if (newSlide) {
            newSlide.classList.remove('slide-out');
            newSlide.classList.add('active');
        }
        
        currentSlide = slideNum;
    }

    function finishOnboarding() {
        // Here you would typically redirect to login or dashboard
        // window.location.href = '/login';
        alert('Onboarding Selesai! Mengarahkan ke Dashboard...');
        
        // Example for Laravel: 
        // window.location.href = "{{ route('login') ?? '/' }}";
    }
</script>

</body>
</html>
