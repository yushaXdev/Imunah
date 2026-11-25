<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COVIDcare - Test & Vaccination Portal</title>
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Icons: FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- AOS Animation CSS -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        /* ============================================
           1. CORE VARIABLES
           ============================================ */
        :root {
            /* Dark Mode (Default) */
            --bg-primary: #0B1120;
            --bg-secondary: #111827; /* Navbar Background */
            --bg-card: #1F2937;
            --bg-card-hover: #374151;
            --bg-input: #111827;
            
            --text-primary: #F9FAFB;
            --text-secondary: #9CA3AF;
            --text-muted: #6B7280;
            
            /* Logo Colors */
            --logo-text: #F9FAFB; 
            --logo-accent: #0D9488; /* "Care" Green Color */
            
            /* Accents */
            --accent: #0D9488; 
            --accent-hover: #0f766e; 
            --accent-light: rgba(13, 148, 136, 0.12); 
            
            --danger: #EF4444;
            --success: #22C55E; 
            --warning: #F59E0B;
            
            --border: #374151;
            --border-light: #4B5563;
            --shadow: 0 4px 24px rgba(0, 0, 0, 0.3);
            --shadow-lg: 0 8px 40px rgba(0, 0, 0, 0.4);
            
            --radius: 12px;
            --radius-sm: 8px;
            --topbar-height: 80px;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            
            --font-main: 'Inter', sans-serif;
        }

        /* Light Mode Overrides */
        [data-theme="light"] {
            --bg-primary: #F3F4F6;
            --bg-secondary: #FFFFFF;
            --bg-card: #FFFFFF;
            --bg-card-hover: #F9FAFB;
            --bg-input: #F9FAFB;
            --text-primary: #111827;
            --text-secondary: #4B5563;
            --logo-text: #111827;
            --border: #E5E7EB;
            --shadow: 0 4px 24px rgba(0, 0, 0, 0.05);
            --shadow-lg: 0 8px 40px rgba(0, 0, 0, 0.08);
        }

        /* ============================================
           2. RESET & BASE STYLES
           ============================================ */
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

        /* ============================================
           3. UTILITY CLASSES
           ============================================ */
        .container { max-width: 1200px; margin: 0 auto; padding: 0 20px; }
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

        /* ============================================
           4. NAVBAR STYLING
           ============================================ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--topbar-height);
            background: var(--bg-secondary);
            border-bottom: 1px solid var(--border);
            z-index: 1000;
            backdrop-filter: blur(12px);
            transition: var(--transition);
        }

        .nav-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
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
            text-transform: uppercase;
            letter-spacing: -0.5px;
        }

        .nav-logo img {
            height: 40px; 
            width: auto;
            margin-right: 8px;
        }
        
        .nav-logo span {
            display: inline-block;
            line-height: 1;
        }

        .nav-links {
            display: flex;
            align-items: center;
            gap: 32px;
        }

        .nav-link {
            color: var(--text-secondary);
            font-weight: 500;
            font-size: 1rem;
            position: relative;
            cursor: pointer;
        }
        
        .nav-link:hover, .nav-link.active {
            color: var(--accent);
        }

        /* --- Dropdown Styling --- */
        .dropdown {
            position: relative;
            height: 100%;
            display: flex;
            align-items: center;
        }

        .dropdown-menu {
            position: absolute;
            top: 100%;
            left: 50%;
            transform: translateX(-50%) translateY(20px);
            background: var(--bg-card);
            border: 1px solid var(--border);
            min-width: 200px;
            box-shadow: var(--shadow-lg);
            border-radius: 8px;
            list-style: none;
            padding: 10px 0;
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
            transform: translateX(-50%) translateY(10px);
        }

        .dropdown-menu li a {
            display: block;
            padding: 12px 20px;
            color: var(--text-secondary);
            font-size: 0.95rem;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .dropdown-menu li a:hover {
            background-color: var(--bg-card-hover);
            color: var(--accent);
            padding-left: 25px;
        }

        /* --- Nav Actions --- */
        .nav-actions {
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .theme-toggle {
            background: var(--bg-card);
            border: 1px solid var(--border);
            color: var(--text-primary);
            width: 40px;
            height: 40px;
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
            width: 25px;
            height: 2px;
            background: var(--text-primary);
            transition: var(--transition);
        }

        /* --- Mobile Menu --- */
        .mobile-menu {
            position: fixed;
            top: 0;
            right: -100%;
            width: 300px;
            height: 100vh;
            background: var(--bg-secondary);
            border-left: 1px solid var(--border);
            z-index: 1001;
            padding: 80px 24px;
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            gap: 20px;
            box-shadow: -10px 0 40px rgba(0,0,0,0.5);
        }
        .mobile-menu.active { right: 0; }
        .mobile-link {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--text-primary);
            padding-bottom: 12px;
            border-bottom: 1px solid var(--border);
        }

        /* ============================================
           5. BUTTONS & CARDS
           ============================================ */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 24px;
            border-radius: var(--radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 0.95rem;
        }

        .btn-primary {
            background: var(--accent);
            color: #fff;
            box-shadow: 0 4px 15px rgba(13, 148, 136, 0.3);
        }
        .btn-primary:hover {
            background: var(--accent-hover);
            transform: translateY(-2px);
        }

        .btn-outline {
            background: transparent;
            border: 1px solid var(--accent);
            color: var(--accent);
        }
        .btn-outline:hover {
            background: var(--accent);
            color: #fff;
        }

        .btn-sm { padding: 8px 16px; font-size: 0.85rem; }
        .w-full { width: 100%; }

        .card {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 24px;
            transition: var(--transition);
        }
        .card:hover {
            border-color: var(--accent);
            transform: translateY(-5px);
            box-shadow: var(--shadow);
        }

        /* ============================================
           6. SECTIONS
           ============================================ */
        .section { padding: 100px 0; }
        
        .hero {
            padding-top: 160px;
            padding-bottom: 100px;
            position: relative;
            background: radial-gradient(circle at 80% 20%, var(--accent-light) 0%, transparent 40%);
        }

        .hero-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 60px;
            align-items: center;
        }

        .hero-text h1 {
            font-size: 3.5rem;
            line-height: 1.1;
            margin-bottom: 24px;
            font-weight: 800;
        }
        .hero-text p {
            font-size: 1.1rem;
            color: var(--text-secondary);
            margin-bottom: 32px;
            max-width: 500px;
        }

        /* Float Animation for Badges */
        @keyframes float {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }

        .grid-3 {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 24px;
        }

        .service-card {
            display: flex;
            flex-direction: column;
            overflow: hidden;
            padding: 0;
        }
        .service-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card-body {
            padding: 20px;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .card-footer {
            padding: 20px;
            margin-top: auto;
        }

        .doctor-card { text-align: center; }
        .doctor-img {
            width: 120px; height: 120px;
            border-radius: 50%;
            object-fit: cover;
            margin: 0 auto 20px;
            border: 3px solid var(--accent);
            padding: 3px;
            background: var(--bg-card);
        }

        .map-container iframe {
            width: 100%;
            height: 400px;
            border-radius: 12px;
            border: none;
        }

        .footer {
            background: var(--bg-secondary);
            border-top: 1px solid var(--border);
            padding: 60px 0 20px;
        }
        .footer-grid {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            gap: 40px;
            margin-bottom: 40px;
        }
        .footer-links li { margin-bottom: 12px; }
        .footer-links a { color: var(--text-secondary); }
        .footer-links a:hover { color: var(--accent); }

        @media (max-width: 992px) {
            .nav-links { display: none; }
            .hamburger { display: flex; }
            .hero-content { grid-template-columns: 1fr; text-align: center; }
            .hero-text p { margin: 0 auto; }
            .hero-image { display: none; }
            .footer-grid { grid-template-columns: 1fr 1fr; }
        }

        @media (max-width: 576px) {
            .hero-text h1 { font-size: 2.5rem; }
            .footer-grid { grid-template-columns: 1fr; }
            .grid-3 { grid-template-columns: 1fr; }
        }

        .section-header { text-align: center; margin-bottom: 60px; }
        .section-tag {
            color: var(--accent);
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.9rem;
            display: block;
            margin-bottom: 10px;
        }
        .sub-title {
            font-size: 1.5rem;
            margin-bottom: 30px;
            border-left: 5px solid var(--accent);
            padding-left: 15px;
            color: var(--text-primary);
        }

        /* ============================================
           7. INTEGRATED FAQ STYLING (Adapted)
           ============================================ */
        .faq-wrapper {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .faq-item {
            background: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            overflow: hidden;
            transition: all 0.35s ease;
        }

        .faq-item:hover {
            border-color: var(--accent);
            transform: translateY(-2px);
            box-shadow: var(--shadow);
        }

        .faq-item.faq-active {
            border-color: var(--accent);
            box-shadow: var(--shadow-lg);
        }

        .faq-header {
            padding: 25px;
            display: flex;
            align-items: center;
            cursor: pointer;
            justify-content: space-between;
            position: relative;
            z-index: 2;
        }

        .header-content {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .faq-number {
            font-size: 1.2rem;
            font-weight: 800;
            color: rgba(13, 148, 136, 0.3); /* Accent color with opacity */
            transition: color 0.3s;
        }

        .faq-item.faq-active .faq-number {
            color: var(--accent);
        }

        .faq-header h4 {
            font-size: 1.15rem;
            font-weight: 600;
            color: var(--text-primary);
            margin: 0;
            transition: color 0.3s;
        }

        .faq-item.faq-active .faq-header h4 {
            color: var(--accent);
        }

        /* Toggle Icon Animation */
        .faq-toggle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background-color: var(--bg-input);
            border: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            color: var(--text-secondary);
        }

        .faq-item.faq-active .faq-toggle {
            background-color: var(--accent);
            border-color: var(--accent);
            color: var(--white);
            transform: rotate(180deg);
        }

        .icon-plus, .icon-minus {
            position: absolute;
            transition: opacity 0.2s ease, transform 0.2s ease;
        }

        .faq-item .icon-minus {
            opacity: 0;
            transform: scale(0.5);
        }

        .faq-item.faq-active .icon-plus {
            opacity: 0;
            transform: scale(0.5);
        }

        .faq-item.faq-active .icon-minus {
            opacity: 1;
            transform: scale(1);
        }

        /* FAQ Content Animation */
        .faq-content {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.35s ease;
            opacity: 0.5;
            background-color: rgba(0,0,0,0.2); /* Slight darken for content area */
        }

        .faq-item.faq-active .faq-content {
            opacity: 1;
            /* Max-height is set via JS for dynamic content */
        }

        .content-inner {
            padding: 5px 25px 25px 70px; /* Indented to align with text, not number */
            color: var(--text-secondary);
            font-size: 0.95rem;
            border-top: 1px solid var(--border);
            margin-top: 10px;
            padding-top: 20px;
        }

        /* --- Responsive Design for FAQ --- */
        @media (max-width: 768px) {
            .faq-header {
                padding: 20px;
            }
            .header-content {
                gap: 15px;
            }
            .faq-header h4 {
                font-size: 1rem;
                padding-right: 10px;
            }
            .content-inner {
                padding-left: 20px;
                padding-right: 20px;
            }
        }
    </style>
</head>
<body data-theme="dark">

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#" class="nav-logo">
                <img src="http://127.0.0.1:8000/hospital-logo-design.avif" alt="Logo">COVID<span class="text-green">Care</span>
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
                        <!-- Auth Logic for Navbar -->
                        <li>
                            @auth
                                <a href="/patient/dashboard"><i class="fa-solid fa-user"></i> Dashboard</a>
                            @else
                                <a href="/patient/login" onclick="alert('For any booking of test or appointment, please login or register yourself first.')"><i class="fa-solid fa-user"></i> Patient Login</a>
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

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <a href="#hero" class="mobile-link">Home</a>
        <a href="#services" class="mobile-link">Services</a>
        <a href="#doctors" class="mobile-link">Find Doctor</a>
        <a href="#faq" class="mobile-link">FAQs</a>
        
        <!-- Auth Logic for Mobile Booking Link -->
        {{-- @auth
            <a href="/patient/dashboard" class="mobile-link">Book Vaccine / Test</a>
        @else
            <a href="/patient/login" class="mobile-link" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">Book Vaccine / Test</a>
        @endauth --}}

        <a href="#contact" class="mobile-link">Contact</a>
        
        <!-- Auth Logic for Mobile Login -->
        @auth
            <a href="/patient/dashboard" class="mobile-link">Patient Dashboard</a>
        @else
            <a href="/patient/login" class="mobile-link">Patient Login or Register</a>
        @endauth
        
        <a href="/hospital/login" class="mobile-link">Hospital Login</a>
        <a href="/admin/login" class="mobile-link">Admin Login</a>
    </div>

    <main>
        <!-- Hero Section -->
        <section id="hero" class="hero">
            <div class="container">
                <div class="hero-content">
                    <div class="hero-text" data-aos="fade-right">
                        <span class="section-tag"><i class="fa-solid fa-shield-check"></i> WHO Compliant</span>
                        <h1>United Against <span class="text-accent">COVID-19</span> With Compassionate Care</h1>
                        <p>Access state-of-the-art COVID-19 testing, vaccination, and treatment in a safe, sterile environment.</p>
                        
                        <div class="flex gap-4" style="flex-wrap: wrap; justify-content: inherit;">
                            <!-- Auth Logic for Hero Button -->
                            @auth
                                <a href="/patient/dashboard" class="btn btn-primary">
                                    <i class="fa-solid fa-syringe"></i> Book Vaccination Or Test
                                </a>
                            @else
                                <a href="/patient/login" class="btn btn-primary" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">
                                    <i class="fa-solid fa-syringe"></i> Book Vaccination Or Test
                                </a>
                            @endauth

                            <a href="#services" class="btn btn-outline">
                                View Services
                            </a>
                        </div>
                    </div>
                    
                    <div class="hero-image" data-aos="zoom-in" data-aos-delay="200">
                        <img src="{{asset('website/img/health/staff-10.webp')}}" alt="Medical Team" style="border-radius: 12px; box-shadow: var(--shadow-lg); border: 1px solid var(--border);">
                        
                        <!-- Floating Badges -->
                        <div class="card" style="position: absolute; top: 10%; right: -20px; padding: 15px; display: flex; gap: 10px; align-items: center; animation: float 6s infinite;">
                            <i class="fa-solid fa-check-circle text-accent" style="font-size: 1.5rem;"></i>
                            <div>
                                <small style="display: block; color: var(--text-secondary);">Safety Score</small>
                                <strong style="display: block;">100%</strong>
                            </div>
                        </div>

                        <div class="card" style="position: absolute; bottom: 10%; left: -20px; padding: 15px; display: flex; gap: 10px; align-items: center; animation: float 6s infinite 2s;">
                            <i class="fa-solid fa-clock text-accent" style="font-size: 1.5rem;"></i>
                            <div>
                                <small style="display: block; color: var(--text-secondary);">Available</small>
                                <strong style="display: block;">24/7</strong>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Services Section -->
        <section id="services" class="section">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-tag"><h2>Our Services</h2></span>
                    <h2>Comprehensive COVID Care</h2>
                    <br>
                    <p class="text-secondary">Choose from our wide range of approved vaccines and accurate testing services.</p>
                </div>

                <!-- VACCINATIONS SECTION -->
                <div style="margin-bottom: 60px;">
                    <h3 class="sub-title">Available Vaccinations</h3>
                    <div class="grid-3">
                        <!-- Vaccine 1 -->
                        <div class="card service-card" data-aos="fade-up">
                            <img src="https://images.theconversation.com/files/374161/original/file-20201210-13-1br3gai.jpg?ixlib=rb-4.1.0&rect=0%2C22%2C1000%2C666&q=75&auto=format&w=768&h=512&fit=crop&dpr=1" class="service-img" alt="Pfizer">
                            <div class="card-body">
                                <h3>Pfizer Vaccine</h3>
                                <p class="text-secondary">FDA authorized mRNA vaccine. High efficacy against variants.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">Book Now</a>
                                @endauth
                            </div>
                        </div>
                        <!-- Vaccine 2 -->
                        <div class="card service-card" data-aos="fade-up" data-aos-delay="100">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT9EHWJkn89je0H1gimLfuylUeaztQ7MXu7HA&s" alt="Moderna">
                            <div class="card-body">
                                <h4>Moderna</h4>
                                <p class="text-secondary">2 Doses, widely used effective vaccine.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">Book Now</a>
                                @endauth
                            </div>
                        </div>
                         <!-- Vaccine 3 -->
                         <div class="card service-card" data-aos="fade-up" data-aos-delay="200">
                            <img src="https://images.theconversation.com/files/390491/original/file-20210318-19-1q6kytv.jpg?ixlib=rb-4.1.0&rect=252%2C168%2C5978%2C3979&q=50&auto=format&w=768&h=512&fit=crop&dpr=2" alt="AstraZeneca">
                            <div class="card-body">
                                <h4>AstraZeneca</h4>
                                <p class="text-secondary">Viral vector vaccine, trusted globally.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">Book Now</a>
                                @endauth
                            </div>
                        </div>
                    </div>
                         <h1 class="text-center mb-5" style="padding-top: 80px;"> And More Other ....</h1>
                </div>

                <!-- TESTING SECTION -->
                <div>
                    <h3 class="sub-title">Diagnostic Testing</h3>
                    <div class="grid-3">
                        <!-- Test 1 -->
                        <div class="card service-card" data-aos="fade-up">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcTZRIafO10532MfHFRz1hs25pSqm8k4s6iUPw&s" alt="PCR Test">
                            <div class="card-body">
                                <h4>RT-PCR Standard</h4>
                                <p class="text-secondary">Gold standard detection. Results in 24 hours.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">Book Now</a>
                                @endauth
                            </div>
                        </div>

                        <!-- Test 2 -->
                        <div class="card service-card" data-aos="fade-up" data-aos-delay="100">
                            <img src="https://media.gettyimages.com/id/1310651714/photo/positive-test-result-by-using-rapid-test-device-for-covid-19.jpg?s=612x612&w=gi&k=20&c=utstrbGDvsO5sxAbLBM0IrXnmof1NwfwMTNsczkvmyE=" alt="Rapid Test">
                            <div class="card-body">
                                <h4>Rapid Antigen</h4>
                                <p class="text-secondary">Get results in just 15 minutes.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">Book Now</a>
                                @endauth
                            </div>
                        </div>

                        <!-- Test 3 -->
                        <div class="card service-card" data-aos="fade-up" data-aos-delay="200">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ1ixHs4LrWWgYG-70xiswZPldIplduzKt5DA&s" alt="Antibody Test">
                            <div class="card-body">
                                <h4>Antibody Test</h4>
                                <p class="text-secondary">Check if you have had COVID-19 previously.</p>
                            </div>
                            <div class="card-footer">
                                @auth
                                    <a href="/patient/dashboard" class="btn btn-primary btn-sm w-full">Book Now</a>
                                @else
                                    <a href="/patient/login" class="btn btn-primary btn-sm w-full" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">Book Now</a>
                                @endauth
                            </div>
                           
                        </div>
                    </div>
                    
                </div>
                 <h1 class="text-center mb-5" style="padding-top: 80px;"> And More Other ....</h1>
            </div>
        </section>

        <!-- Doctors Section -->
        <section id="doctors" class="section" style="background-color: var(--bg-secondary);">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-tag"><h2>Specialists</h2></span>
                    <h2>Meet Our Experts</h2>
                    <p class="text-secondary">Top-rated virologists and pulmonologists ready to help.</p>
                </div>

                <div class="grid-3">
                    <!-- Doctor 1 -->
                    <div class="card doctor-card" data-aos="zoom-in">
                        <img src="{{asset('website/img/health/staff-2.webp')}}" alt="Doctor" class="doctor-img">
                        <h4>Dr. Amanda Foster</h4>
                        <p class="text-accent" style="font-size: 0.9rem; margin-bottom: 10px;">Infectious Disease</p>
                        <p class="text-secondary" style="font-size: 0.9rem;">14 years experience</p>
                        <div style="margin-top: 20px;">
                            @auth
                                <a href="/patient/dashboard" class="btn btn-outline btn-sm">Book Now</a>
                            @else
                                <a href="/patient/login" class="btn btn-outline btn-sm" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">Book Now</a>
                            @endauth
                        </div>
                    </div>
                    <!-- Doctor 2 -->
                    <div class="card doctor-card" data-aos="zoom-in" data-aos-delay="100">
                        <img src="{{asset('website/img/health/staff-6.webp')}}" alt="Doctor" class="doctor-img">
                        <h4>Dr. Marcus Johnson</h4>
                        <p class="text-accent" style="font-size: 0.9rem; margin-bottom: 10px;">Pulmonology</p>
                        <p class="text-secondary" style="font-size: 0.9rem;">16 years experience</p>
                        <div style="margin-top: 20px;">
                            @auth
                                <a href="/patient/dashboard" class="btn btn-outline btn-sm">Book Now</a>
                            @else
                                <a href="/patient/login" class="btn btn-outline btn-sm" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">Book Now</a>
                            @endauth
                        </div>
                    </div>
                    <!-- Doctor 3 -->
                    <div class="card doctor-card" data-aos="zoom-in" data-aos-delay="200">
                        <img src="{{asset('website/img/health/staff-4.webp')}}" alt="Doctor" class="doctor-img">
                        <h4>Dr. Rachel Williams</h4>
                        <p class="text-accent" style="font-size: 0.9rem; margin-bottom: 10px;">Pediatric Care</p>
                        <p class="text-secondary" style="font-size: 0.9rem;">11 years experience</p>
                        <div style="margin-top: 20px;">
                            @auth
                                <a href="/patient/dashboard" class="btn btn-outline btn-sm">Book Now</a>
                            @else
                                <a href="/patient/login" class="btn btn-outline btn-sm" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">Book Now</a>
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- FAQ Section (Integrated) -->
        <section id="faq" class="section" style="background-color: var(--bg-secondary);">
            <div class="container">
                <div class="section-header" data-aos="fade-up">
                    <span class="section-tag"><h2>Information</h2></span>
                    <h2>COVID-19 FAQs</h2>
                    <p class="text-secondary">Common questions regarding symptoms, prevention, and safety guidelines.</p>
                </div>

                <div class="faq-wrapper">
                    <!-- FAQ Item 01 -->
                    <div class="faq-item" data-aos="fade-up">
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
                                <p>People with COVID-19 have reported a wide range of symptoms, ranging from mild symptoms to severe illness. Common symptoms include fever or chills, cough, shortness of breath or difficulty breathing, fatigue, muscle or body aches, headache, new loss of taste or smell, sore throat, congestion or runny nose, nausea, vomiting, and diarrhea.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 02 -->
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="100">
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
                                <p>The virus spreads mainly from person to person through respiratory droplets and small particles produced when an infected person coughs, sneezes, or talks. These droplets can land in the mouths or noses of people who are nearby or possibly be inhaled into the lungs. In some circumstances, they may contaminate surfaces they touch.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 03 -->
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="200">
                        <div class="faq-header">
                            <div class="header-content">
                                <span class="faq-number">03</span>
                                <h4>What should I do if I feel sick?</h4>
                            </div>
                            <div class="faq-toggle">
                                <svg class="icon-plus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <svg class="icon-minus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </div>
                        </div>
                        <div class="faq-content">
                            <div class="content-inner">
                                <p>If you have symptoms of COVID-19, you should get tested. While waiting for test results, stay home and isolate yourself from others, monitor your health, and follow the advice of your healthcare provider. If you have emergency warning signs (like trouble breathing or persistent pain/pressure in the chest), seek emergency medical care immediately.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 04 -->
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="300">
                        <div class="faq-header">
                            <div class="header-content">
                                <span class="faq-number">04</span>
                                <h4>Do vaccines prevent severe illness?</h4>
                            </div>
                            <div class="faq-toggle">
                                <svg class="icon-plus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <svg class="icon-minus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </div>
                        </div>
                        <div class="faq-content">
                            <div class="content-inner">
                                <p>Yes. COVID-19 vaccines are effective at preventing infection, serious illness, and death. Most people who get vaccinated will not get sick, but "breakthrough" infections can occur. However, vaccinated individuals are much less likely to be hospitalized or die compared to those who are unvaccinated.</p>
                            </div>
                        </div>
                    </div>

                    <!-- FAQ Item 05 -->
                    <div class="faq-item" data-aos="fade-up" data-aos-delay="400">
                        <div class="faq-header">
                            <div class="header-content">
                                <span class="faq-number">05</span>
                                <h4>How can I protect myself and others?</h4>
                            </div>
                            <div class="faq-toggle">
                                <svg class="icon-plus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                                <svg class="icon-minus" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                            </div>
                        </div>
                        <div class="faq-content">
                            <div class="content-inner">
                                <p>You can protect yourself by staying up to date with COVID-19 vaccines, improving ventilation in indoor spaces, testing if you have symptoms, and wearing masks if needed. Maintain good hygiene: wash your hands often with soap and water for at least 20 seconds, avoid close contact with people who are sick, and cover coughs and sneezes.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Section -->
        <section id="contact" class="section" style="background-color: var(--bg-secondary);">
            <div class="container">
                <div class="grid-3" style="grid-template-columns: 1fr 2fr;">
                    <div data-aos="fade-right">
                        <h2>Contact Us </h2>
                        <br>
                        <p class="text-secondary mb-4">Need help? Call our 24/7 hotline.</p>
                        <br>
                        <div class="flex items-center gap-4 mb-3">
                            <div class="theme-toggle"><i class="fa-solid fa-phone text-accent"></i></div>
                            <div><small class="text-muted block">Emergency Hotline</small><strong>+92 334 363909</strong></div>
                        </div>
                        <br>
                        <div class="flex items-center gap-4 mb-3">
                            <div class="theme-toggle"><i class="fa-solid fa-envelope text-accent"></i></div>
                            <div><small class="text-muted block">Email</small><strong>support@covidcare.com</strong></div>
                        </div>
                        <br>
                        <div class="flex items-center gap-4">
                            <div class="theme-toggle"><i class="fa-solid fa-location-dot text-accent"></i></div>
                            <div><small class="text-muted block">Location</small><strong>123 Medical Plaza, NY</strong></div>
                        </div>
                    </div>
                    <div class="map-container" data-aos="fade-up">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d48389.78314118045!2d-74.006138!3d40.710059!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a22a3bda30d%3A0xb89d1fe6bc499443!2sDowntown%20Conference%20Center!5e0!3m2!1sen!2sus!4v1676961268712!5m2!1sen!2sus" width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div>
                    <a href="#" class="nav-logo" style="margin-bottom: 20px; display: inline-flex;">
                        COVID<span class="text-green">Care</span>
                    </a>
                    <p class="text-secondary" style="margin-bottom: 20px;">
                        Dedicated to community immunity through state-of-the-art COVID-19 testing and vaccination services.
                    </p>
                    <div class="flex gap-2">
                        <a href="#" class="theme-toggle"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#" class="theme-toggle"><i class="fa-brands fa-facebook"></i></a>
                        <a href="#" class="theme-toggle"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                </div>
                <div>
                    <h4 style="margin-bottom: 20px;">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="#hero">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="/book">Doctors</a></li>
                    </ul>
                </div>
                <div>
                    <h4 style="margin-bottom: 20px;">Services</h4>
                    <ul class="footer-links">
                        <li><a href="#">PCR Test</a></li>
                        <li><a href="#">Vaccination</a></li>
                        <li><a href="#">Antibody Test</a></li>
                        <li><a href="#">Travel Cert</a></li>
                    </ul>
                </div>
                <div>
                    <h4 style="margin-bottom: 20px;">Account</h4>
                    <ul class="footer-links">
                        <!-- Auth Logic for Footer -->
                        <li>
                            @auth
                                <a href="/patient/dashboard">Patient Dashboard</a>
                            @else
                                <a href="/patient/login" onclick="alert('For any booking of test or appointment, please login or register yourself first.')">Patient Login</a>
                            @endauth
                        </li>
                        <li><a href="/hospital/login">Hospital Login</a></li>
                        <li><a href="/admin/login">Admin Login</a></li>
                        <li><a href="/patient/register">Register</a></li>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom" style="text-align: center; border-top: 1px solid var(--border); padding-top: 20px; color: var(--text-muted); font-size: 0.9rem;">
                &copy; 2023 COVIDcare Portal. All rights reserved.
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({ duration: 800, easing: 'ease-in-out', once: true, offset: 100 });

        // Theme Toggler
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

        // Mobile Menu
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

        // FAQ Accordion Logic
        document.addEventListener('DOMContentLoaded', () => {
            const faqItems = document.querySelectorAll('.faq-item');
            const faqHeaders = document.querySelectorAll('.faq-header');

            faqHeaders.forEach(header => {
                header.addEventListener('click', (e) => {
                    const currentItem = header.parentElement;
                    const isActive = currentItem.classList.contains('faq-active');
                    
                    // Close all other items (Accordion behavior)
                    faqItems.forEach(item => {
                        if (item !== currentItem) {
                            item.classList.remove('faq-active');
                            const content = item.querySelector('.faq-content');
                            content.style.maxHeight = null;
                        }
                    });

                    // Toggle current item
                    if (!isActive) {
                        currentItem.classList.add('faq-active');
                        const content = currentItem.querySelector('.faq-content');
                        // Set max-height to the scroll height to allow CSS transition
                        content.style.maxHeight = content.scrollHeight + "px";
                    } else {
                        currentItem.classList.remove('faq-active');
                        const content = currentItem.querySelector('.faq-content');
                        content.style.maxHeight = null;
                    }
                });
            });

            // Handle Resize to adjust max-height if open
            window.addEventListener('resize', () => {
                faqItems.forEach(item => {
                    if(item.classList.contains('faq-active')) {
                        const content = item.querySelector('.faq-content');
                        content.style.maxHeight = content.scrollHeight + "px";
                    }
                });
            });
        });
    </script>
</body>
</html>