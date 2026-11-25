<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Imunah | Test & Vaccination Portal</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Anime.js CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/animejs/3.2.1/anime.min.js"></script>

    <style>
        :root {
            --bg-primary: #070b14;
            --bg-secondary: #0b101a;
            --bg-card: #171e29;
            --bg-card-hover: #374151e7;
            --bg-input: #111827;
            
            --text-primary: #F9FAFB;
            --text-secondary: #9CA3AF;
            --text-muted: #7a808a;
            
            --logo-text: #F9FAFB; 
            --logo-accent: #14B8A6; 
            
            --accent: #14B8A6; 
            --accent-hover: #0D9488; 
            --accent-light: rgba(20, 184, 166, 0.15); 
            
            --danger: #EF4444;
            --success: #22C55E; 
            --warning: #F59E0B;
            
            --border: #374151;
            --border-light: rgba(255, 255, 255, 0.1);
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.4);
            --shadow-lg: 0 15px 50px rgba(0, 0, 0, 0.5);
            
            --radius: 16px;
            --radius-sm: 10px;
            --topbar-height: 80px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            
            --font-main: 'Inter', sans-serif;
        }

        [data-theme="light"] {
            --bg-primary: #F3F4F6;
            --bg-secondary: #FFFFFF;
            --bg-card: #FFFFFF;
            --bg-card-hover: #F9FAFB;
            --bg-input: #F9FAFB;
            --text-primary: #111827;
            --text-secondary: #4B5563;
            --logo-text: #0c111b;
            --border: #E5E7EB;
            --border-light: rgba(0, 0, 0, 0.05);
            --shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
            --shadow-lg: 0 15px 50px rgba(0, 0, 0, 0.12);
        }

        *, *::before, *::after {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: var(--font-main);
            background-color: var(--bg-primary);
            color: var(--text-primary);
            line-height: 1.6;
            overflow-x: hidden;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        a { text-decoration: none; color: inherit; transition: var(--transition); }
        ul { list-style: none; }
        img { max-width: 100%; display: block; }

        .container { max-width: 1200px; margin: 0 auto; padding: 0 24px; }
        .flex { display: flex; }
        .items-center { align-items: center; }
        .justify-between { justify-content: space-between; }
        .gap-2 { gap: 0.5rem; }
        .gap-4 { gap: 1rem; }
        .text-center { text-align: center; }
        .text-accent { color: var(--accent); }
        .text-secondary { color: var(--text-secondary); }
        
        .text-green { 
            color: var(--logo-accent) !important; 
            font-weight: 800; 
        }

        .hidden { display: none !important; }
        .grid { display: grid; }
        .block { display: block; }

        .navbar {
            position: fixed;
            top: 24px;
            left: 50%;
            transform: translateX(-50%);
            width: calc(100% - 48px);
            max-width: 1200px;
            height: var(--topbar-height);
            background: rgba(17, 24, 39, 0.65);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1.5px solid var(--border-light);
            border-radius: 50px;
            z-index: 1000;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }

        [data-theme="light"] .navbar {
            background: rgba(255, 255, 255, 0.75);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        .nav-container {
            width: 100%;
            padding: 0 32px;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .nav-logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--logo-text);
            display: flex;
            align-items: center;
            white-space: nowrap;
            letter-spacing: -0.5px;
        }

        .nav-logo img {
            height: 50px; 
            width: auto;
            object-fit: contain;
            transition: var(--transition);
            filter: brightness(0) invert(1);
        }

        [data-theme="light"] .nav-logo img {
            filter: none;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-link {
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 0.95rem;
            position: relative;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--accent);
        }

        .nav-link::after {
            content: '';
            position: absolute;
            bottom: -4px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--accent);
            transition: var(--transition);
        }

        .nav-link:hover::after, .nav-link.active::after {
            width: 100%;
        }

        .dropdown {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .dropdown-menu {
            position: absolute;
            top: calc(100% + 15px);
            left: 50%;
            transform: translateX(-50%) translateY(15px);
            background: var(--bg-card);
            border: 1px solid var(--border);
            min-width: 220px;
            box-shadow: var(--shadow-lg);
            border-radius: 12px;
            list-style: none;
            padding: 12px 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 1001;
        }

        .dropdown-menu::before {
            content: '';
            position: absolute;
            top: -6px;
            left: 50%;
            transform: translateX(-50%);
            border-left: 6px solid transparent;
            border-right: 6px solid transparent;
            border-bottom: 6px solid var(--bg-card);
        }

        .dropdown:hover .dropdown-menu {
            opacity: 1;
            visibility: visible;
            transform: translateX(-50%) translateY(0);
        }

        .dropdown-menu li a {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 24px;
            color: var(--text-secondary);
            font-size: 0.95rem;
            transition: 0.2s;
        }

        .dropdown-menu li a:hover {
            background-color: var(--bg-card-hover);
            color: var(--accent);
            padding-left: 28px;
        }

        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .theme-toggle {
            background: var(--bg-card);
            border: 1px solid var(--border);
            color: var(--text-primary);
            width: 44px;
            height: 44px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
        }
        .theme-toggle:hover { border-color: var(--accent); color: var(--accent); transform: rotate(15deg); }

        .hamburger {
            display: none;
            flex-direction: column;
            gap: 6px;
            cursor: pointer;
            z-index: 1002;
        }
        .hamburger span {
            width: 28px;
            height: 2px;
            background: var(--text-primary);
            transition: var(--transition);
        }

        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 320px;
            height: 100vh;
            background: var(--bg-secondary);
            border-left: 1px solid var(--border);
            z-index: 1001;
            padding: 100px 32px;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            gap: 24px;
            box-shadow: -20px 0 60px rgba(0,0,0,0.5);
        }
        .mobile-menu.active { right: 0; }
        .mobile-link {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-primary);
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            padding: 14px 28px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 1rem;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 4px 20px rgba(20, 184, 166, 0.4);
        }
        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(20, 184, 166, 0.6);
        }

        .btn-outline {
            background: transparent;
            border: 2px solid var(--accent);
            color: var(--accent);
        }
        .btn-outline:hover {
            background: var(--accent);
            color: #fff;
            transform: translateY(-3px);
        }

        .btn-sm { padding: 10px 20px; font-size: 0.9rem; }
        .w-full { width: 100%; }

        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 32px;
            transition: var(--transition);
        }
        .card:hover {
            border-color: var(--accent);
            transform: translateY(-8px);
            box-shadow: var(--shadow);
        }

        .section { padding: 120px 0; }
        
        .hero {
            padding-top: 180px;
            padding-bottom: 100px;
            position: relative;
            background: radial-gradient(circle at 80% 20%, var(--accent-light) 0%, transparent 50%);
            overflow: hidden;
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 60px;
            align-items: center;
        }

        .hero-text h1 {
            font-size: 4rem;
            line-height: 1.1;
            margin-bottom: 24px;
            font-weight: 800;
            letter-spacing: -1px;
            opacity: 0;
            transform: translateY(30px);
        }
        .hero-text p {
            font-size: 1.15rem;
            color: var(--text-secondary);
            margin-bottom: 40px;
            max-width: 500px;
            line-height: 1.8;
            opacity: 0;
            transform: translateY(30px);
        }

        .hero-text .section-tag {
            opacity: 0;
            transform: translateX(-30px);
        }

        .hero-buttons {
            opacity: 0;
            transform: translateY(30px);
            display: flex;
            gap: 16px;
            flex-wrap: wrap;
        }

        .hero-image-wrapper {
            position: relative;
            width: 100%;
            height: 550px;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border-light);
            opacity: 0;
            transform: scale(0.9);
        }

        .hero-carousel-img {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0;
            transition: opacity 1s ease-in-out, transform 1s ease-in-out;
            transform: scale(1.05);
        }

        .hero-carousel-img.active {
            opacity: 1;
            transform: scale(1);
        }

        .floating-badge {
            position: absolute; 
            bottom: 20px; 
            left: 20px; 
            padding: 16px 24px; 
            display: flex; 
            gap: 16px; 
            align-items: center; 
            z-index: 10; 
            background: rgba(17, 24, 39, 0.85); 
            backdrop-filter: blur(10px); 
            border: 1px solid rgba(255,255,255,0.1); 
            border-radius: 16px;
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 32px;
        }

        .service-card {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            padding: 0;
            opacity: 0;
            transform: translateY(50px);
        }
        .service-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            transition: var(--transition);
        }
        .service-card:hover .service-img {
            transform: scale(1.05);
        }
        .card-body {
            padding: 32px;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .card-body h3, .card-body h4 {
            font-size: 1.4rem;
            margin-bottom: 12px;
            color: var(--text-primary);
        }
        .card-footer {
            padding: 0 32px 32px;
            margin-top: auto;
        }

        .doctor-card { 
            text-align: center; 
            opacity: 0;
            transform: translateY(50px);
        }
        .doctor-img {
            width: 140px; height: 140px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 24px;
            border: 4px solid var(--accent);
            padding: 4px;
            background: var(--bg-card);
            transition: var(--transition);
        }
        .doctor-card:hover .doctor-img {
            transform: scale(1.05);
        }

        .map-container iframe {
            width: 100%;
            height: 450px;
            border-radius: 16px;
            border: none;
        }

        .footer {
            background: var(--bg-secondary);
            border-top: 1px solid var(--border);
            padding: 80px 0 30px;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 60px;
            margin-bottom: 60px;
        }
        .footer-links li { margin-bottom: 16px; }
        .footer-links a { color: var(--text-secondary); font-size: 0.95rem; }
        .footer-links a:hover { color: var(--accent); padding-left: 5px; }

        .section-header { text-align: center; margin-bottom: 70px; max-width: 700px; margin-left: auto; margin-right: auto; opacity: 0; transform: translateY(30px); }
        .section-tag {
            color: var(--accent);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.85rem;
            display: block;
            margin-bottom: 16px;
        }
        .section-header h2 {
            font-size: 2.8rem;
            font-weight: 800;
            margin-bottom: 16px;
            letter-spacing: -0.5px;
        }
        .sub-title {
            font-size: 1.8rem;
            margin-bottom: 40px;
            border-left: 6px solid var(--accent);
            padding-left: 20px;
            color: var(--text-primary);
            font-weight: 700;
            opacity: 0;
            transform: translateX(-30px);
        }

        .faq-wrapper { display: flex; flex-direction: column; gap: 20px; max-width: 900px; margin: 0 auto; }
        .faq-item {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: var(--transition);
            opacity: 0;
            transform: translateY(30px);
        }
        .faq-item:hover { border-color: var(--accent); }
        .faq-item.faq-active { border-color: var(--accent); box-shadow: var(--shadow); }
        .faq-header {
            padding: 28px;
            display: flex;
            align-items: center;
            cursor: pointer;
            justify-content: space-between;
            position: relative;
            z-index: 2;
        }
        .header-content { display: flex; align-items: center; gap: 24px; }
        .faq-number { font-size: 1.2rem; font-weight: 800; color: rgba(20, 184, 166, 0.4); transition: color 0.3s; }
        .faq-item.faq-active .faq-number { color: var(--accent); }
        .faq-header h4 { font-size: 1.2rem; font-weight: 600; color: var(--text-primary); margin: 0; transition: color 0.3s; }
        .faq-item.faq-active .faq-header h4 { color: var(--accent); }
        
        .faq-toggle {
            width: 36px; height: 36px;
            border-radius: 50%;
            background-color: var(--bg-input);
            border: 1px solid var(--border);
            display: flex; align-items: center; justify-content: center;
            transition: var(--transition);
            color: var(--text-secondary);
        }
        .faq-item.faq-active .faq-toggle {
            background-color: var(--accent); border-color: var(--accent); color: #fff; transform: rotate(180deg);
        }
        .icon-plus, .icon-minus { position: absolute; transition: opacity 0.3s ease, transform 0.3s ease; }
        .faq-item .icon-minus { opacity: 0; transform: scale(0.5); }
        .faq-item.faq-active .icon-plus { opacity: 0; transform: scale(0.5); }
        .faq-item.faq-active .icon-minus { opacity: 1; transform: scale(1); }
        .faq-content {
            max-height: 0; overflow: hidden;
            transition: max-height 0.4s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.4s ease;
            opacity: 0.5; background-color: rgba(0,0,0,0.1);
        }
        .faq-item.faq-active .faq-content { opacity: 1; }
        .content-inner {
            padding: 0 28px 28px 80px;
            color: var(--text-secondary); font-size: 1rem; line-height: 1.7;
            border-top: 1px solid var(--border); margin-top: 10px; padding-top: 24px;
        }

        @media (max-width: 1024px) {
            .hero-content { grid-template-columns: 1fr; text-align: center; gap: 60px; }
            .hero-text h1 { font-size: 3.2rem; }
            .hero-text p { margin: 0 auto 32px; }
            .hero-buttons { justify-content: center; }
            .hero-image-wrapper { height: 400px; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 992px) {
            .nav-links { display: none; }
            .hamburger { display: flex; }
        }

        @media (max-width: 768px) {
            .navbar { top: 15px; height: 70px; width: calc(100% - 30px); }
            .nav-container { padding: 0 20px; }
            .nav-logo img { height: 40px; }
            .hero { padding-top: 130px; }
            .hero-text h1 { font-size: 2.5rem; }
            .section-header h2 { font-size: 2.2rem; }
            .sub-title { font-size: 1.5rem; }
            .content-inner { padding-left: 28px; }
            .faq-header { padding: 20px; }
            .header-content { gap: 15px; }
        }

        @media (max-width: 576px) {
            .hero-text h1 { font-size: 2rem; }
            .footer-grid { grid-template-columns: 1fr; }
            .grid-3 { grid-template-columns: 1fr; }
            .hero-image-wrapper { height: 300px; }
        }
    </style>
</head>
<body data-theme="dark">

    <nav class="navbar">
        <div class="nav-container">
            <a href="{{ url('/') }}" class="nav-logo">
                <img src="{{ asset('logo.png') }}" alt="Imunah Logo">
            </a>

            <ul class="nav-links">
                <li><a href="#hero" class="nav-link active">Home</a></li>
                <li><a href="#services" class="nav-link">Services</a></li>
                <li><a href="#doctors" class="nav-link">Doctors</a></li>
                <li><a href="#faq" class="nav-link">FAQs</a></li>
                <li><a href="#contact" class="nav-link">Contact</a></li>
                
                <li class="dropdown">
                    <a href="javascript:void(0)" class="nav-link">
                        Login <i class="fa-solid fa-chevron-down" style="font-size: 0.8em; margin-left: 5px;"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            @auth
                                <a href="/patient/dashboard"><i class="fa-solid fa-user"></i> Dashboard</a>
                            @else
                                <a href="/patient/login"><i class="fa-solid fa-user"></i> Patient Login</a>
                            @endauth
                        </li>
                        <li><a href="/hospital/login"><i class="fa-solid fa-hospital"></i> Hospital Login</a></li>
                        <li><a href="/admin/login"><i class="fa-solid fa-user-shield"></i> Admin Login</a></li>
                    </ul>
                </li>
            </ul>

            <div class="nav-actions">
                <button class="theme-toggle" id="themeToggle" title="Toggle Dark/Light Mode">
                    <i class="fa-solid fa-sun"></i>
                </button>
                <div class="hamburger" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
        </div>
    </nav>

    <div class="mobile-menu" id="mobileMenu">
        <a href="#hero" class="mobile-link">Home</a>
        <a href="#services" class="mobile-link">Services</a>
        <a href="#doctors" class="mobile-link">Find Doctor</a>
        <a href="#faq" class="mobile-link">FAQs</a>
        <a href="#contact" class="mobile-link">Contact</a>
        
        @auth
            <a href="/patient/dashboard" class="mobile-link">Patient Dashboard</a>
        @else
            <a href="/patient/login" class="mobile-link">Patient Login or Register</a>
        @endauth
        
        <a href="/hospital/login" class="mobile-link">Hospital Login</a>
        <a href="/admin/login" class="mobile-link">Admin Login</a>
    </div>

    <main>
        <section id="hero" class="hero">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text">
                        <span class="section-tag"><i class="fa-solid fa-shield-check"></i> WHO Compliant Portal</span>
                        <h1>United Against <span class="text-accent">COVID-19</span> With Compassionate Care</h1>
                        <p>Access state-of-the-art COVID-19 testing, vaccination, and treatment in a safe, sterile, and premium environment.</p>
                        
                        <div class="hero-buttons">
                            @auth
                                <a href="/patient/dashboard" class="btn btn-primary">
                                    <i class="fa-solid fa-syringe"></i> Book Vaccination Or Test
                                </a>
                            @else
                                <a href="/patient/login" class="btn btn-primary" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">
                                    <i class="fa-solid fa-syringe"></i> Book Vaccination Or Test
                                </a>
                            @endauth

                            <a href="#services" class="btn btn-outline">Explore Services</a>
                        </div>
                    </div>
                    
                    <div class="hero-image-wrapper">
                        <img src="{{asset('website/img/health/staff-10.webp')}}" class="hero-carousel-img active" alt="Medical Team">
                        <img src="https://images.theconversation.com/files/374161/original/file-20201210-13-1br3gai.jpg?ixlib=rb-4.1.0&rect=0%2C22%2C1000%2C666&q=75&auto=format&w=768&h=512&fit=crop&dpr=1" class="hero-carousel-img" alt="Vaccine">
                        <img src="https://media.gettyimages.com/id/1310651714/photo/positive-test-result-by-using-rapid-test-device-for-covid-19.jpg?s=612x612&w=gi&k=20&c=utstrbGDvsO5sxAbLBM0IrXnmof1NwfwMTNsczkvmyE=" class="hero-carousel-img" alt="Testing">
                        
                        <div class="floating-badge" id="floatingBadge">
                            <div style="background: var(--accent-light); padding: 12px; border-radius: 50%;">
                                <i class="fa-solid fa-check-circle text-accent" style="font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <small style="display: block; color: var(--text-secondary); font-size: 0.85rem;">Safety Score</small>
                                <strong style="display: block; font-size: 1.2rem; color: #fff;">100% Secure</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="services" class="section">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Our Services</span>
                    <h2>Comprehensive COVID Care</h2>
                    <p class="text-secondary">Choose from our wide range of approved vaccines and accurate testing services, tailored for your safety.</p>
                </div>

                <div style="margin-bottom: 80px;">
                    <h3 class="sub-title">Available Vaccinations</h3>
                    <div class="grid-3">
                        <div class="card service-card">
                            <img src="https://images.theconversation.com/files/374161/original/file-20201210-13-1br3gai.jpg?ixlib=rb-4.1.0&rect=0%2C22%2C1000%2C666&q=75&auto=format&w=768&h=512&fit=crop&dpr=1" class="service-img" alt="Pfizer">
                            <div class="card-body">
                                <h3>Pfizer Vaccine</h3>
                                <p class="text-secondary">FDA authorized mRNA vaccine. High efficacy against multiple variants.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking, please login first.')">Book Now</a>
                                @endauth
                            </div>
                        </div>
                        <div class="card service-card">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9EHWJkn89je0H1gimLfuylUeaztQ7MXu7HA&s" alt="Moderna" class="service-img">
                            <div class="card-body">
                                <h4>Moderna</h4>
                                <p class="text-secondary">2 Doses, widely used and highly effective vaccine globally.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking, please login first.')">Book Now</a>
                                @endauth
                            </div>
                        </div>
                         <div class="card service-card">
                            <img src="https://images.theconversation.com/files/390491/original/file-20210318-19-1q6kytv.jpg?ixlib=rb-4.1.0&rect=252%2C168%2C5978%2C3979&q=50&auto=format&w=768&h=512&fit=crop&dpr=2" alt="AstraZeneca" class="service-img">
                            <div class="card-body">
                                <h4>AstraZeneca</h4>
                                <p class="text-secondary">Viral vector vaccine, trusted and approved by WHO globally.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking, please login first.')">Book Now</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <h3 class="sub-title">Diagnostic Testing</h3>
                    <div class="grid-3">
                        <div class="card service-card">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZRIafO10532MfHFRz1hs25pSqm8k4s6iUPw&s" alt="PCR Test" class="service-img">
                            <div class="card-body">
                                <h4>RT-PCR Standard</h4>
                                <p class="text-secondary">Gold standard detection with certified lab results in 24 hours.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking, please login first.')">Book Now</a>
                                @endauth
                            </div>
                        </div>

                        <div class="card service-card">
                            <img src="https://media.gettyimages.com/id/1310651714/photo/positive-test-result-by-using-rapid-test-device-for-covid-19.jpg?s=612x612&w=gi&k=20&c=utstrbGDvsO5sxAbLBM0IrXnmof1NwfwMTNsczkvmyE=" alt="Rapid Test" class="service-img">
                            <div class="card-body">
                                <h4>Rapid Antigen</h4>
                                <p class="text-secondary">Get fast and reliable results in just 15 minutes at your home.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking, please login first.')">Book Now</a>
                                @endauth
                            </div>
                        </div>

                        <div class="card service-card">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1ixHs4LrWWgYG-70xiswZPldIplduzKt5DA&s" alt="Antibody Test" class="service-img">
                            <div class="card-body">
                                <h4>Antibody Test</h4>
                                <p class="text-secondary">Check your immunity and if you have had COVID-19 previously.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking, please login first.')">Book Now</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="doctors" class="section" style="background-color: var(--bg-secondary);">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Specialists</span>
                    <h2>Meet Our Experts</h2>
                    <p class="text-secondary">Top-rated virologists, pulmonologists, and healthcare experts ready to help you.</p>
                </div>

                <div class="grid-3">
                    <div class="card doctor-card">
                        <img src="{{asset('website/img/health/staff-2.webp')}}" alt="Doctor" class="doctor-img">
                        <h4>Dr. Amanda Foster</h4>
                        <p class="text-accent" style="font-size: 0.95rem; font-weight: 600; margin-bottom: 8px;">Infectious Disease</p>
                        <p class="text-secondary" style="font-size: 0.9rem;">14 years experience</p>
                        <div style="margin-top: 24px;">
                            @auth
                                <a href="/patient/dashboard" class="btn btn-outline btn-sm">Book Appointment</a>
                            @else
                                <a href="/patient/login" class="btn btn-outline btn-sm" onclick="alert('Please login first.')">Book Appointment</a>
                            @endauth
                        </div>
                    </div>
                    <div class="card doctor-card">
                        <img src="{{asset('website/img/health/staff-6.webp')}}" alt="Doctor" class="doctor-img">
                        <h4>Dr. Marcus Johnson</h4>
                        <p class="text-accent" style="font-size: 0.95rem; font-weight: 600; margin-bottom: 8px;">Pulmonology</p>
                        <p class="text-secondary" style="font-size: 0.9rem;">16 years experience</p>
                        <div style="margin-top: 24px;">
                            @auth
                                <a href="/patient/dashboard" class="btn btn-outline btn-sm">Book Appointment</a>
                            @else
                                <a href="/patient/login" class="btn btn-outline btn-sm" onclick="alert('Please login first.')">Book Appointment</a>
                            @endauth
                        </div>
                    </div>
                    <div class="card doctor-card">
                        <img src="{{asset('website/img/health/staff-4.webp')}}" alt="Doctor" class="doctor-img">
                        <h4>Dr. Rachel Williams</h4>
                        <p class="text-accent" style="font-size: 0.95rem; font-weight: 600; margin-bottom: 8px;">Pediatric Care</p>
                        <p class="text-secondary" style="font-size: 0.9rem;">11 years experience</p>
                        <div style="margin-top: 24px;">
                            @auth
                                <a href="/patient/dashboard" class="btn btn-outline btn-sm">Book Appointment</a>
                            @else
                                <a href="/patient/login" class="btn btn-outline btn-sm" onclick="alert('Please login first.')">Book Appointment</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="faq" class="section">
            <div class="container">
                <div class="section-header">
                    <span class="section-tag">Information</span>
                    <h2>COVID-19 FAQs</h2>
                    <p class="text-secondary">Common questions regarding symptoms, prevention, and safety guidelines.</p>
                </div>

                <div class="faq-wrapper">
                    <div class="faq-item">
                        <div class="faq-header">
                            <div class="header-content">
                                <span class="faq-number">01</span>
                                <h4>What are the common symptoms of COVID-19?</h4>
                            </div>
                            <div class="faq-toggle">
                                <svg class="icon-plus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <svg class="icon-minus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </div>
                        </div>
                        <div class="faq-content">
                            <div class="content-inner">
                                <p>People with COVID-19 have reported a wide range of symptoms, ranging from mild symptoms to severe illness. Common symptoms include fever or chills, cough, shortness of breath, fatigue, muscle aches, headache, new loss of taste or smell, sore throat, congestion, nausea, and diarrhea.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-header">
                            <div class="header-content">
                                <span class="faq-number">02</span>
                                <h4>How does the virus spread?</h4>
                            </div>
                            <div class="faq-toggle">
                                <svg class="icon-plus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <svg class="icon-minus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </div>
                        </div>
                        <div class="faq-content">
                            <div class="content-inner">
                                <p>The virus spreads mainly from person to person through respiratory droplets produced when an infected person coughs, sneezes, or talks. These droplets can land in the mouths or noses of people who are nearby or possibly be inhaled into the lungs.</p>
                            </div>
                        </div>
                    </div>

                    <div class="faq-item">
                        <div class="faq-header">
                            <div class="header-content">
                                <span class="faq-number">03</span>
                                <h4>Do vaccines prevent severe illness?</h4>
                            </div>
                            <div class="faq-toggle">
                                <svg class="icon-plus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <svg class="icon-minus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </div>
                        </div>
                        <div class="faq-content">
                            <div class="content-inner">
                                <p>Yes. COVID-19 vaccines are highly effective at preventing infection, serious illness, and death. While breakthrough infections can occur, vaccinated individuals are much less likely to be hospitalized or face severe outcomes compared to those unvaccinated.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="contact" class="section" style="background-color: var(--bg-secondary);">
            <div class="container">
                <div class="grid-3" style="grid-template-columns: 1fr 1.5fr; gap: 60px; align-items: center;">
                    <div class="contact-info-anim">
                        <span class="section-tag">Get in touch</span>
                        <h2 style="font-size: 2.5rem; font-weight: 800; margin-bottom: 20px;">Contact Us</h2>
                        <p class="text-secondary" style="margin-bottom: 40px; font-size: 1.1rem;">Need help or have questions? Call our 24/7 emergency hotline or drop us an email.</p>
                        
                        <div class="flex items-center gap-4" style="margin-bottom: 30px;">
                            <div class="theme-toggle" style="width: 50px; height: 50px;"><i class="fa-solid fa-phone text-accent" style="font-size: 1.2rem;"></i></div>
                            <div>
                                <small class="text-muted block" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Emergency Hotline</small>
                                <strong style="font-size: 1.2rem; color: var(--text-primary);">+92 334567890</strong>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4" style="margin-bottom: 30px;">
                            <div class="theme-toggle" style="width: 50px; height: 50px;"><i class="fa-solid fa-envelope text-accent" style="font-size: 1.2rem;"></i></div>
                            <div>
                                <small class="text-muted block" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Email Support</small>
                                <strong style="font-size: 1.2rem; color: var(--text-primary);">support@imunah.com</strong>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-4">
                            <div class="theme-toggle" style="width: 50px; height: 50px;"><i class="fa-solid fa-location-dot text-accent" style="font-size: 1.2rem;"></i></div>
                            <div>
                                <small class="text-muted block" style="font-size: 0.85rem; text-transform: uppercase; letter-spacing: 1px;">Main Location</small>
                                <strong style="font-size: 1.2rem; color: var(--text-primary);">Apwa Complex Garden east Center </strong>
                            </div>
                        </div>
                    </div>
                    <div class="map-container map-anim" style="box-shadow: var(--shadow-lg); border-radius: 16px; overflow: hidden; border: 1px solid var(--border);">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <a href="{{ url('/') }}" class="nav-logo" style="margin-bottom: 24px; display: inline-flex;">
                        <img src="{{ asset('logo.png') }}" alt="Imunah Logo" style="height: 60px; filter: brightness(0) invert(1);">
                    </a>
                    <p class="text-secondary" style="margin-bottom: 24px; font-size: 0.95rem;">
                        Dedicated to community immunity through state-of-the-art COVID-19 testing and vaccination services. Your safety is our priority.
                    </p>
                    <div class="flex gap-2">
                        <a href="#" class="theme-toggle"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="theme-toggle"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="theme-toggle"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h4 style="margin-bottom: 24px; font-size: 1.1rem;">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="#hero">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#doctors">Doctors</a></li>
                    </ul>
                </div>
                <div>
                    <h4 style="margin-bottom: 24px; font-size: 1.1rem;">Our Services</h4>
                    <ul class="footer-links">
                        <li><a href="#">PCR Test</a></li>
                        <li><a href="#">Vaccination</a></li>
                        <li><a href="#">Antibody Test</a></li>
                        <li><a href="#">Travel Certificate</a></li>
                    </ul>
                </div>
                <div>
                    <h4 style="margin-bottom: 24px; font-size: 1.1rem;">Account</h4>
                    <ul class="footer-links">
                        <li>
                            @auth
                                <a href="/patient/dashboard">Patient Dashboard</a>
                            @else
                                <a href="/patient/login" onclick="alert('Please login first.')">Patient Login</a>
                            @endauth
                        </li>
                        <li><a href="/hospital/login">Hospital Login</a></li>
                        <li><a href="/admin/login">Admin Login</a></li>
                        <li><a href="/patient/register">Register</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom" style="text-align: center; border-top: 1px solid var(--border); padding-top: 24px; color: var(--text-muted); font-size: 0.9rem;">
                &copy; 2026 IMUNAH Portal | All Rights Reserved | Designed for those who cares.
            </div>
        </div>
    </footer>

    <!-- Anime.js Script -->
    <script>
        // Theme Toggle Logic
        const themeToggleBtn = document.getElementById('themeToggle');
        const icon = themeToggleBtn.querySelector('i');
        const body = document.body;

        const savedTheme = localStorage.getItem('theme') || 'dark';
        body.setAttribute('data-theme', savedTheme);
        updateIcon(savedTheme);

        themeToggleBtn.addEventListener('click', () => {
            const currentTheme = body.getAttribute('data-theme');
            const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
            body.setAttribute('data-theme', newTheme);
            localStorage.setItem('theme', newTheme);
            updateIcon(newTheme);
        });

        function updateIcon(theme) {
            if (theme === 'dark') {
                icon.className = 'fa-solid fa-sun';
            } else {
                icon.className = 'fa-solid fa-moon';
            }
        }

        // Mobile Menu Logic
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobileMenu');
        const mobileLinks = document.querySelectorAll('.mobile-link');

        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('active');
            const spans = hamburger.querySelectorAll('span');
            if (mobileMenu.classList.contains('active')) {
                spans[0].style.transform = 'rotate(45deg) translate(5px, 6px)';
                spans[1].style.opacity = '0';
                spans[2].style.transform = 'rotate(-45deg) translate(5px, -6px)';
            } else {
                spans[0].style.transform = 'none';
                spans[1].style.opacity = '1';
                spans[2].style.transform = 'none';
            }
        });

        mobileLinks.forEach(link => {
            link.addEventListener('click', () => {
                mobileMenu.classList.remove('active');
                const spans = hamburger.querySelectorAll('span');
                spans[0].style.transform = 'none'; spans[1].style.opacity = '1'; spans[2].style.transform = 'none';
            });
        });

        // FAQ Logic
        document.addEventListener('DOMContentLoaded', () => {
            const faqItems = document.querySelectorAll('.faq-item');
            const faqHeaders = document.querySelectorAll('.faq-header');

            faqHeaders.forEach(header => {
                header.addEventListener('click', (e) => {
                    const currentItem = header.parentElement;
                    const isActive = currentItem.classList.contains('faq-active');
                    
                    faqItems.forEach(item => {
                        if (item !== currentItem) {
                            item.classList.remove('faq-active');
                            const content = item.querySelector('.faq-content');
                            content.style.maxHeight = null;
                        }
                    });

                    if (!isActive) {
                        currentItem.classList.add('faq-active');
                        const content = currentItem.querySelector('.faq-content');
                        content.style.maxHeight = content.scrollHeight + "px";
                    } else {
                        currentItem.classList.remove('faq-active');
                        const content = currentItem.querySelector('.faq-content');
                        content.style.maxHeight = null;
                    }
                });
            });

            window.addEventListener('resize', () => {
                faqItems.forEach(item => {
                    if(item.classList.contains('faq-active')) {
                        const content = item.querySelector('.faq-content');
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            });

            // Hero Image Carousel
            let currentHeroImage = 0;
            const heroImages = document.querySelectorAll('.hero-carousel-img');
            
            if(heroImages.length > 0) {
                setInterval(() => {
                    heroImages[currentHeroImage].classList.remove('active');
                    currentHeroImage = (currentHeroImage + 1) % heroImages.length;
                    heroImages[currentHeroImage].classList.add('active');
                }, 3000);
            }

            // --- Anime.js Animations --- //

            // 1. Hero Section Initial Load Animations (Staggered)
            let heroTimeline = anime.timeline({
                easing: 'easeOutExpo',
                duration: 1000
            });

            heroTimeline
                .add({
                    targets: '.hero-text .section-tag',
                    translateX: [-30, 0],
                    opacity: [0, 1],
                    duration: 800
                })
                .add({
                    targets: '.hero-text h1',
                    translateY: [30, 0],
                    opacity: [0, 1],
                    duration: 800
                }, '-=600')
                .add({
                    targets: '.hero-text p',
                    translateY: [30, 0],
                    opacity: [0, 1],
                    duration: 800
                }, '-=600')
                .add({
                    targets: '.hero-buttons',
                    translateY: [30, 0],
                    opacity: [0, 1],
                    duration: 800
                }, '-=600')
                .add({
                    targets: '.hero-image-wrapper',
                    scale: [0.9, 1],
                    opacity: [0, 1],
                    duration: 1200
                }, '-=1000');

            // 2. Floating Badge Continuous Loop Animation
            anime({
                targets: '#floatingBadge',
                translateY: [-10, 10],
                direction: 'alternate',
                loop: true,
                easing: 'easeInOutSine',
                duration: 2500
            });

            // 3. Scroll Intersection Observer for Reveal Animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: "0px 0px -50px 0px"
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const target = entry.target;
                        
                        if (target.classList.contains('section-header')) {
                            anime({
                                targets: target,
                                translateY: [30, 0],
                                opacity: [0, 1],
                                duration: 800,
                                easing: 'easeOutExpo'
                            });
                        } 
                        else if (target.classList.contains('sub-title')) {
                            anime({
                                targets: target,
                                translateX: [-30, 0],
                                opacity: [0, 1],
                                duration: 800,
                                easing: 'easeOutExpo'
                            });
                        }
                        else if (target.classList.contains('service-card') || target.classList.contains('doctor-card') || target.classList.contains('faq-item')) {
                            anime({
                                targets: target,
                                translateY: [50, 0],
                                opacity: [0, 1],
                                duration: 800,
                                delay: (el, i) => i * 100, // Stagger effect inside grid
                                easing: 'easeOutExpo'
                            });
                        }
                        else if (target.classList.contains('contact-info-anim')) {
                            anime({
                                targets: target,
                                translateX: [-30, 0],
                                opacity: [0, 1],
                                duration: 800,
                                easing: 'easeOutExpo'
                            });
                        }
                        else if (target.classList.contains('map-anim')) {
                            anime({
                                targets: target,
                                translateY: [30, 0],
                                opacity: [0, 1],
                                duration: 800,
                                easing: 'easeOutExpo'
                            });
                        }

                        // Stop observing once animated
                        observer.unobserve(target);
                    }
                });
            }, observerOptions);

            // Observe targets
            document.querySelectorAll('.section-header, .sub-title, .service-card, .doctor-card, .faq-item, .contact-info-anim, .map-anim').forEach(el => {
                observer.observe(el);
            });
        });
    </script>
</body>
</html>