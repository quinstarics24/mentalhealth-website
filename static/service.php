<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe Space - Professional Support Services</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">
    <style>
        :root {
            --primary-color: #2c3e50;
            --secondary-color: #34495e;
            --accent-color: #3498db;
            --light-bg: #f4f6f7;
            --text-color: #333;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--light-bg);
            color: var(--text-color);
            line-height: 1.6;
        }

        .services-section {
            padding: 6rem 0;
        }

        .section-title {
            color: var(--primary-color);
            margin-bottom: 2rem;
            position: relative;
            text-align: center;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 70px;
            height: 4px;
            background: var(--accent-color);
            margin: 1rem auto;
        }

        .service-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            margin-bottom: 2rem;
            transition: all 0.3s ease;
            overflow: hidden;
        }

        .service-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
        }

        .service-img {
            height: 250px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .service-card:hover .service-img {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            color: var(--primary-color);
            margin-bottom: 1rem;
        }

        .section-desc {
            color: var(--secondary-color);
            max-width: 800px;
            margin: 0 auto 2.5rem;
            text-align: center;
        }

        .premium-features {
            background: linear-gradient(135deg, #f6f8f9 0%, #e5ebee 100%);
            border-left: 5px solid var(--accent-color);
        }

        .feature-item {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }

        .feature-item i {
            color: var(--accent-color);
            margin-right: 1rem;
            font-size: 1.2rem;
        }

        .explore-btn {
            background-color: var(--accent-color);
            border: none;
            padding: 12px 24px;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .explore-btn:hover {
            background-color: #2980b9;
            transform: translateY(-3px);
        }

        @media (max-width: 768px) {
            .services-section {
                padding: 3rem 0;
            }
        }
    </style>
</head>
<body>
    <!-- Header Placeholder -->
    <div id="header-container" class="header-placeholder"></div>

    <!-- Services Section -->
    <section id="services" class="services-section">
        <div class="container">
            <div class="text-center">
                <h1 class="display-5 fw-bold section-title">Our Professional Services</h1>
                <p class="lead section-desc">Comprehensive mental health support tailored to your unique journey. Our expert services are designed to provide compassionate, confidential care.</p>
            </div>
            
            <div class="row g-4">
                <!-- Service Item 1 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card service-card h-100">
                        <img src="../assets/images/counseling.jpeg" class="card-img-top service-img" alt="Mental Health Counseling">
                        <div class="card-body">
                            <h3 class="card-title h4 fw-bold">Professional Counseling</h3>
                            <p class="card-text text-muted">Personalized counseling sessions with licensed professionals to help you navigate anxiety, stress, and personal challenges.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Service Item 2 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card service-card h-100">
                        <img src="../assets/images/peer.jpeg" class="card-img-top service-img" alt="Peer Support Groups">
                        <div class="card-body">
                            <h3 class="card-title h4 fw-bold">Supportive Community</h3>
                            <p class="card-text text-muted">Structured support groups that foster connection, understanding, and mutual growth in a safe, non-judgmental environment.</p>
                        </div>
                    </div>
                </div>
                
                <!-- Service Item 3 -->
                <div class="col-md-6 col-lg-4">
                    <div class="card service-card h-100">
                        <img src="../assets/images/crises.jpeg" class="card-img-top service-img" alt="Crisis Intervention">
                        <div class="card-body">
                            <h3 class="card-title h4 fw-bold">Urgent Support</h3>
                            <p class="card-text text-muted">Immediate, compassionate intervention for individuals experiencing acute emotional or psychological distress.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Premium Services -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="card service-card">
                        <div class="card-body premium-features">
                            <div class="row align-items-center">
                                <div class="col-md-7">
                                    <h3 class="card-title h4 fw-bold">Elevated Support Services</h3>
                                    <div class="feature-item">
                                        <i class="fas fa-user-friends"></i> 
                                        <span>Personalized Coaching: Customized one-to-one guidance</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-video"></i> 
                                        <span>Flexible Therapy: Remote sessions via video or phone</span>
                                    </div>
                                    <div class="feature-item">
                                        <i class="fas fa-user-md"></i> 
                                        <span>Specialized Consultations: Access to expert mental health professionals</span>
                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <img src="../assets/images/image4.jpeg" class="img-fluid rounded" alt="Premium Services">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="../authentification/login.php" class="btn explore-btn btn-primary">Explore Our Services</a>
            </div>
        </div>
    </section>

    <!-- Footer Placeholder -->
    <div id="footer-placeholder"></div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const headerContainer = document.getElementById("header-container");
    
            // Load header content from header.html
            fetch("header.php")
                .then(response => response.text())
                .then(data => {
                    headerContainer.innerHTML = data;
                })
                .catch(error => console.error('Error loading header:', error));
                
            // Load footer content
            fetch('footer.php')
                .then(response => response.text())
                .then(data => document.getElementById('footer-placeholder').innerHTML = data)
                .catch(err => console.log('Error loading footer:', err));
        });
    </script>
</body>
</html>