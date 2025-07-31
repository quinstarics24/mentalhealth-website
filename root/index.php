<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe Space | Professional Mental Health Support</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary:rgb(16, 103, 233);
            --secondary: #5a8ba6;
            --accent:rgb(49, 99, 192);
            --light: #f7f9fb;
            --dark: #2c3e50;
            --text-color: #333333;
            --light-gray: #f4f6f9;
            --transition: all 0.3s ease;
        }
        
        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-color);
            line-height: 1.7;
            background-color: var(--light);
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-weight: 600;
            color: var(--dark);
        }

        /* Button Styles */
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: var(--transition);
            box-shadow: 0 3px 10px rgba(58, 93, 122, 0.2);
        }
        
        .btn-primary:hover {
            background-color:rgb(54, 131, 194);
            border-color:rgb(51, 115, 167);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(58, 93, 122, 0.3);
        }
        
        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
            padding: 0.6rem 1.5rem;
            font-weight: 500;
            transition: var(--transition);
        }
        
        .btn-outline-primary:hover {
            background-color: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        /* Hero Section */
        .hero {
            position: relative;
            height: 90vh;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
        }
        
        .hero .swiper-container {
            width: 100%;
            height: 100%;
            position: absolute;
        }
        
        .hero .swiper-slide::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.6));
            z-index: 1;
        }
        
        .hero .swiper-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .hero-content {
            position: relative;
            z-index: 10;
            color: white;
            text-align: center;
            max-width: 800px;
            padding: 0 20px;
        }
        
        .hero h1 {
            font-size: 3.2rem;
            font-weight: 700;
            margin-bottom: 1.2rem;
            color: white;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s ease-out forwards 0.3s;
        }
        
        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s ease-out forwards 0.6s;
        }
        
        .hero .btn {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeIn 1s ease-out forwards 0.9s;
            margin: 0 8px;
            min-width: 160px;
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Section Styles */
        section {
            padding: 5rem 0;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
            font-weight: 700;
            font-size: 2.2rem;
            color: var(--dark);
        }
        
        .section-title::after {
            content: '';
            display: block;
            width: 60px;
            height: 4px;
            background-color: var(--accent);
            margin: 20px auto 0;
            border-radius: 2px;
        }
        
        /* About Section */
        .about-card {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 5px 30px rgba(0, 0, 0, 0.05);
            height: 100%;
            transition: var(--transition);
            border-top: 4px solid var(--accent);
        }
        
        .about-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        }
        
        .about-card h4 {
            color: var(--primary);
            margin-bottom: 1.2rem;
            display: flex;
            align-items: center;
        }
        
        .about-card i {
            font-size: 1.4rem;
            margin-right: 10px;
            color: var(--accent);
        }
        
        /* Services Section */
        .services-section {
            background-color: var(--light-gray);
        }
        
        .service-card {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            overflow: hidden;
            transition: var(--transition);
            height: 100%;
            border: none;
        }
        
        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .service-card .card-header {
            background-color: var(--primary);
            padding: 1.5rem;
            border: none;
            position: relative;
            overflow: hidden;
        }
        
        .service-card .card-header::before {
            content: '';
            position: absolute;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, 0.1);
            top: -60px;
            right: -60px;
            border-radius: 50%;
        }
        
        .service-card h4 {
            color: white;
            font-weight: 600;
            margin-bottom: 0;
            display: flex;
            align-items: center;
        }
        
        .service-card i {
            font-size: 1.2rem;
            margin-right: 10px;
        }
        
        .service-card .card-body {
            padding: 1.8rem;
        }
        
        /* Testimonials Section */
        .testimonial {
            background-color: white;
            border-radius: 10px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(30, 0, 0, 0.05);
            position: relative;
            margin-bottom: 20px;
            height: 100%;
            display: flex;
            flex-direction: column;
            transition: var(--transition);
            border-left: 4px solid var(--accent);
        }
        
        .testimonial:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
        }
        
        .testimonial::before {
            content: '\201C';
            font-family: Georgia, serif;
            font-size: 5rem;
            color: rgba(22, 22, 20, 0.1);
            position: absolute;
            top: 50px;
            left: 10px;
            line-height: 0;
        }
        
        .testimonial p {
            font-style: italic;
            margin-bottom: 20px;
            position: relative;
            z-index: 1;
            flex-grow: 1;
            padding-top: 1rem;
        }
        
        .testimonial cite {
            font-style: normal;
            font-weight: 600;
            color: var(--primary);
            display: block;
            margin-top: auto;
            font-size: 0.95rem;
        }
        
        /* Responsive Styles */
        @media (max-width: 991.98px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            section {
                padding: 4rem 0;
            }
            
            .section-title {
                font-size: 1.8rem;
                margin-bottom: 2.5rem;
            }
        }
        
        @media (max-width: 767.98px) {
            .hero {
                height: 70vh;
            }
            
            .hero h1 {
                font-size: 2rem;
            }
            
            .hero .btn {
                margin-bottom: 0.5rem;
                min-width: 140px;
            }
            
            section {
                padding: 3rem 0;
            }
            
            .service-card, .testimonial, .about-card {
                margin-bottom: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <!-- Placeholder for Header -->
    <div id="header-container"></div>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="swiper-container hero-swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img src="../assets/images/about1.png" class="img-fluid" alt="Hero Image 1" />
                </div>
                <div class="swiper-slide">
                    <img src="../assets/images/img5.jpeg" class="img-fluid" alt="Hero Image 2" />
                </div>
                <div class="swiper-slide">
                    <img src="../assets/images/im.jpeg" class="img-fluid" alt="Hero Image 3" />
                </div>
            </div>
            <div class="swiper-pagination"></div>
        </div>
        <div class="hero-content">
            <h1 id="hero-title">Welcome to Safe Space</h1>
            <p id="hero-text">
                Your mental health matters. Find support, resources, and community here.
            </p>
            <div>
                <a href="#services" class="btn btn-primary">Explore Our Services</a>
                <a href="#about" class="btn btn-outline-primary">Learn More</a>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-5">
        <div class="container">
            <h2 class="section-title">About Us</h2>
            <div class="row">
                <div class="col-lg-8 mx-auto text-center mb-5">
                    <p class="lead">Our mission at Safe Space is to provide accessible, compassionate, and confidential mental health resources and support for young individuals aged 15-35, empowering them to navigate their journey to wellness in a safe and supportive environment.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-4">
                    <div class="about-card">
                        <h4>
                            <i class="fas fa-heart"></i> Our Philosophy
                        </h4>
                        <p>We believe in the importance of mental well-being and strive to create a supportive community that destigmatizes mental health challenges. Our approach emphasizes personalized care, evidence-based practices, and ongoing support.</p>
                    </div>
                </div>
                <div class="col-md-6 mb-4">
                    <div class="about-card">
                        <h4>
                            <i class="fas fa-users"></i> Our Team
                        </h4>
                        <p>Our team consists of licensed therapists, mental health professionals, and wellness coaches dedicated to providing compassionate support. With diverse specializations, we're equipped to address a wide range of mental health concerns.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5 services-section">
        <div class="container">
            <h2 class="section-title">Our Services</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="card-header">
                            <h4><i class="fas fa-comments"></i> Counseling</h4>
                        </div>
                        <div class="card-body">
                            <p>Access to licensed therapists for personalized one-on-one therapy sessions that address your unique needs and circumstances.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="card-header">
                            <h4><i class="fas fa-tools"></i> Mental Health Tools</h4>
                        </div>
                        <div class="card-body">
                            <p>Comprehensive resources designed to help you monitor, understand, and improve your mental well-being on a daily basis.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="service-card">
                        <div class="card-header">
                            <h4><i class="fas fa-hands-helping"></i> Community Support</h4>
                        </div>
                        <div class="card-body">
                            <p>Connect with others who understand what you're going through in our moderated, supportive online community spaces.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Access Services Button -->
            <div class="text-center mt-5">
                <a href="../static/service.php" class="btn btn-primary px-4 py-2">Access Our Services</a>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section id="testimonials" class="py-5">
        <div class="container">
            <h2 class="section-title">What Our Community Says</h2>
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial">
                        <p>"This platform has been a lifesaver during my difficult times. The counseling services and supportive community have provided me with the tools I needed to manage my anxiety."</p>
                        <cite>— Evelyn R., Member since 2024</cite>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial">
                        <p>"I found comfort and understanding in the community forums during a particularly challenging period in my life. It helped me realize I wasn't alone in my struggles."</p>
                        <cite>— David K., Member since 2025</cite>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4">
                    <div class="testimonial">
                        <p>"The professional counseling services helped me develop effective strategies to manage my depression. I've seen remarkable improvements in my daily life and relationships."</p>
                        <cite>— Sarah T., Member since 2025</cite>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Placeholder -->
    <div id="footer-placeholder"></div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    
    <script>
        // Load header and footer
        fetch('../static/header.php')
            .then(response => response.text())
            .then(data => document.getElementById('header-container').innerHTML = data)
            .catch(err => console.log('Error loading header:', err));
        
        fetch('../static/footer.php')
            .then(response => response.text())
            .then(data => document.getElementById('footer-placeholder').innerHTML = data)
            .catch(err => console.log('Error loading footer:', err));
        
        // Initialize Swiper
        document.addEventListener("DOMContentLoaded", function () {
            var swiper = new Swiper(".hero-swiper", {
                loop: true,
                effect: "fade",
                speed: 1000,
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                pagination: {
                    el: ".swiper-pagination",
                    clickable: true,
                },
            });
        });
    </script>
</body>
</html>