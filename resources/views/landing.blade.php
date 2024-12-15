<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Apple</title>
    <link rel="icon" type="image/x-icon" href="assets/logo.png">
    <script src="https://unpkg.com/@phosphor-icons/web"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        :root {
            --primary-color: #2C5038;
            --white-color: #ffffff;
        }

        /* Navbar Styles */
        .navbar {
            background-color: var(--primary-color);
            padding: 1rem 2rem;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
        }

        .navbar-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .logo {
            color: var(--white-color);
            font-size: 1.5rem;
            font-weight: bold;
        }

        .nav-links {
            list-style: none;
            display: flex;
            gap: 2rem;
        }

        .nav-links a {
            color: var(--white-color);
            text-decoration: none;
            transition: opacity 0.3s;
        }

        .nav-links a:hover {
            opacity: 0.8;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            background-color: var(--white-color);
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 0 1rem;
        }

        .hero-content {
            max-width: 800px;
        }

        .hero h1 {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .hero p {
            font-size: 1.2rem;
            color: #333;
            margin-bottom: 2rem;
        }

        .cta-button {
            background-color: var(--primary-color);
            color: var(--white-color);
            padding: 1rem 2rem;
            border: none;
            border-radius: 5px;
            font-size: 1.1rem;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        .cta-button:hover {
            background-color: #2C5038;
        }

        /* Features Section */
        .features {
            padding: 4rem 2rem;
            background-color: #f9f9f9;
        }

        .features-container {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
            overflow: hidden;
        }

        .features-grid {
            display: flex;
            transition: transform 0.3s ease;
            gap: 2rem;
            padding: 1rem;
        }

        .feature-card {
            min-width: calc(33.333% - 1.33rem);
            flex: 0 0 auto;
            aspect-ratio: 1 / 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 1.5rem;
        }

        .feature-card i {
            font-size: 2.5rem;
            margin-bottom: 1rem;
        }

        .feature-card h3 {
            font-size: 1.2rem;
            margin-bottom: 0.5rem;
        }

        .feature-card p {
            font-size: 0.9rem;
            text-align: center;
            line-height: 1.4;
        }

        .scroll-button {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background-color: rgba(44, 80, 56, 0.8);
            color: white;
            border: none;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            cursor: pointer;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background-color 0.3s;
        }

        .scroll-button:hover {
            background-color: rgba(44, 80, 56, 1);
        }

        .scroll-button.left {
            left: 0;
        }

        .scroll-button.right {
            right: 0;
        }

        .feature-card {
            background-color: var(--white-color);
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-card h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        /* Team Section */
        .team {
            padding: 4rem 2rem;
            background-color: #ffffff;
        }

        .team-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .team-card {
            background-color: #f9f9f9;
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .team-card:hover {
            transform: translateY(-10px);
        }

        .team-image {
            width: 120px;
            height: 120px;
            border-radius: 50%;
            margin-bottom: 1rem;
            object-fit: cover;
        }

        .team-quote {
            color: #666;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            font-style: italic;
        }

        .team-name {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .team-role {
            color: #666;
            font-size: 0.9rem;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .team-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
        }

        /* Footer */
        footer {
            background-color: var(--primary-color);
            color: var(--white-color);
            text-align: center;
            padding: 2rem;
        }

        /* About Section */
        .about {
            padding: 4rem 2rem;
            background-color: #f9f9f9;
        }

        .about-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .about-card {
            background-color: var(--white-color);
            padding: 2rem;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-10px);
        }

        .about-card h3 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.5rem;
        }

        .about-card p {
            color: #666;
            line-height: 1.6;
        }

        .hero-content h1 {
            color: white;
        }

        .hero-content p {
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <div class="navbar-content">
            <div class="logo" style="display: flex; align-items: center;">
                <img src="assets/logo.png" alt="MyApple" style="height: 40px;">
                <span style="color: white; font-size: 24px; margin-left: 10px; font-weight: bold;">MyApple</span>
            </div>
            <ul class="nav-links">
                <li><a href="#home">Home</a></li>
                <li><a href="#features">Features</a></li>
                <li><a href="#about">About</a></li>
                <li><a href="#team">Team</a></li>
                <li><a href="http://127.0.0.1:8000/admin/login" style="background-color: white; color: #2C5038; padding: 8px 15px; border-radius: 5px;">Login</a></li>
            </ul>
        </div>
    </nav>

    <section class="hero" id="home" style="background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url('assets/background apel.jpg'); 
        background-size: cover; 
        background-position: center;
        background-repeat: no-repeat;
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
        -webkit-backface-visibility: hidden;
        backface-visibility: hidden;
        transform: translateZ(0);
        perspective: 1000;
        ">
        <div class="hero-content">
            <h1>Welcome to My Apple</h1>
            <p>We are ready to help you detect apple leaf diseases quickly and accurately. Improve your harvest with practical and easy-to-use technology.</p>
            <button class="cta-button">Get Started</button>
        </div>
    </section>

    <section class="about" id="about">
        <h2 style="color: #2C5038; margin-bottom: 2rem; font-size: 2.5rem; margin-left: 2rem;">Our Missions</h2>
        <div class="about-grid">
            <div class="about-card" style="border: 3px solid #2C5038; background: white;">
                <i class="fas fa-heart fa-3x" style="color: #2C5038; margin-bottom: 1rem;"></i>
                <h3 style="color: #2C5038;">Supporting Apple Farmers</h3>
                <p style="color: #666;">Helping apple farmers detect leaf diseases quickly and easily.</p>
            </div>
            <div class="about-card" style="border: 3px solid #2C5038; background: white;">
                <i class="fas fa-bullseye fa-3x" style="color: #2C5038; margin-bottom: 1rem;"></i>
                <h3 style="color: #2C5038;">Support Better Harvests</h3>
                <p style="color: #666;">Early disease detection technology for apple leaves to prevent loss and maintain harvest quality..</p>
            </div>
            <div class="about-card" style="border: 3px solid #2C5038; background: white;">
                <i class="fas fa-microchip fa-3x" style="color: #2C5038; margin-bottom: 1rem;"></i>
                <h3 style="color: #2C5038;">Technology for Agriculture</h3>
                <p style="color: #666;">Combining modern technology to provide practical solutions for farmers.</p>
            </div>
        </div>
    </section>

    <section class="features" id="features">
        <h2 style="color: #2C5038; margin-bottom: 2rem; font-size: 2.5rem; margin-right: 2rem; text-align: right;">Our Features</h2>
        <div class="features-container">
            <button class="scroll-button left" onclick="scrollFeatures('left')">
                <i class="fa-solid fa-chevron-left"></i>
            </button>
            <button class="scroll-button right" onclick="scrollFeatures('right')">
                <i class="fa-solid fa-chevron-right"></i>
            </button>
            <div class="features-grid" id="featuresGrid">
                <div class="feature-card" style="border: 3px solid white; background: #2C5038;">
                    <i class="fa-solid fa-house" style="color: white;"></i>
                    <h3 style="color: white;">Home Page</h3>
                    <p style="color: white;">App bar profile & recent history</p>
                </div>
                <div class="feature-card" style="border: 3px solid white; background: #2C5038;">
                    <i class="fa-solid fa-camera" style="color: white;"></i>
                    <h3 style="color: white;">Scanning Page</h3>
                    <p style="color: white;">Disease diagnosis & solutions</p>
                </div>
                <div class="feature-card" style="border: 3px solid white; background: #2C5038;">
                    <i class="fa-solid fa-newspaper" style="color: white;"></i>
                    <h3 style="color: white;">Article Page</h3>
                    <p style="color: white;">Connected internet articles</p>
                </div>
                <div class="feature-card" style="border: 3px solid white; background: #2C5038;">
                    <i class="fa-solid fa-user" style="color: white;"></i>
                    <h3 style="color: white;">Profile Page</h3>
                    <p style="color: white;">User profile management</p>
                </div>
                <div class="feature-card" style="border: 3px solid white; background: #2C5038;">
                    <i class="fa-solid fa-clock-rotate-left" style="color: white;"></i>
                    <h3 style="color: white;">History Page</h3>
                    <p style="color: white;">Detailed scan history</p>
                </div>
            </div>
        </div>
    </section>
    <section class="team" id="team">
        <h2 style="color: #2C5038; margin-bottom: 2rem; font-size: 2.5rem; text-align: center;">Our Member</h2>
        <div class="team-grid">
            <div class="team-card">
                <img src="assets/dq.jpeg" alt="Team Member" class="team-image">
                <h3 class="team-name">Fatriya Ibnu Ash shidiqqi</h3>
                <p class="team-role">Frontend Developer</p>
            </div>
            <div class="team-card">
                <img src="assets/dhanes.jpeg" alt="Team Member" class="team-image">            
                <h3 class="team-name">Dhaneswara Haryo Satriagung</h3>
                <p class="team-role">Backend Developer</p>
            </div>
            <div class="team-card">
                <img src="assets/rizky.jpeg" alt="Team Member" class="team-image">
                <h3 class="team-name">Muhammad Rizky Fauzi</h3>
                <p class="team-role">Mobile Developer</p>
            </div>
            <div class="team-card">
                <img src="assets/fathur.jpeg" alt="Team Member" class="team-image">
                
                <h3 class="team-name">Muhammad Fathurrozak Al Qoroni</h3>
                <p class="team-role">System Analyst</p>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Group 7. All rights reserved.</p>
    </footer>

    <script>
        // Smooth scrolling for navigation links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });

        // Add scroll animation for navbar
        window.addEventListener('scroll', function() {
            if (window.scrollY > 50) {
                document.querySelector('.navbar').style.backgroundColor = '#243f2d';
            } else {
                document.querySelector('.navbar').style.backgroundColor = '#2C5038';
            }
        });

        let currentPosition = 0;
        const featuresGrid = document.getElementById('featuresGrid');
        const cardWidth = featuresGrid.querySelector('.feature-card').offsetWidth + 32; // Including gap
        const visibleCards = 3;
        const totalCards = featuresGrid.children.length;
        const maxPosition = -(cardWidth * (totalCards - visibleCards));

        function scrollFeatures(direction) {
            if (direction === 'right' && currentPosition > maxPosition) {
                currentPosition -= cardWidth;
            } else if (direction === 'left' && currentPosition < 0) {
                currentPosition += cardWidth;
            }
            
            featuresGrid.style.transform = `translateX(${currentPosition}px)`;
            
            // Update button visibility
            document.querySelector('.scroll-button.left').style.opacity = currentPosition < 0 ? '1' : '0.5';
            document.querySelector('.scroll-button.right').style.opacity = currentPosition > maxPosition ? '1' : '0.5';
        }

        // Initialize button states
        scrollFeatures('');
    </script>
</body>
</html>
