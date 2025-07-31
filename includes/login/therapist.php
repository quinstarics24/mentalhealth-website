<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapist Selection | Professional Mental Health Services</title>
    <meta name="description" content="Find and connect with experienced therapists online. Specialized support for depression, anxiety, trauma, and relationship issues.">
    
    <!-- Favicon -->
    <link rel="icon" href="/favicon.ico" sizes="any">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
    integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Custom Styles -->
    <style>
        :root {
            --primary: #5569d4;
            --primary-hover: #0077b6;
            --secondary: #35b88f;
            --secondary-hover: #2ca37c;
            --light-bg: #f5f7fd;
            --dark-text: #2d3748;
            --light-text: #718096;
            --card-shadow: 0 10px 25px rgba(85, 105, 212, 0.1);
            --hover-shadow: 0 15px 35px rgba(85, 105, 212, 0.15);
            --card-border-radius: 16px;
            --btn-border-radius: 8px;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Open Sans', sans-serif;
            color: var(--dark-text);
            line-height: 1.7;
        }
        
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
        }
        
        .page-header {
            padding: 4rem 0 2rem;
            background: linear-gradient(135deg, rgba(74, 95, 212, 0.9) 0%, rgba(53, 184, 143, 0.9) 100%);
            color: white;
            margin-bottom: 3rem;
            border-radius: 0 0 50px 50px;
            box-shadow: 0 5px 20px rgba(85, 105, 212, 0.2);
        }
        
        .page-header h1 {
            font-size: 2.8rem;
            margin-bottom: 0.5rem;
        }
        
        .page-header p {
            font-size: 1.2rem;
            opacity: 0.9;
            max-width: 700px;
            margin: 0 auto;
        }
        
        .therapist-card {
            border-radius: var(--card-border-radius);
            box-shadow: var(--card-shadow);
            transition: all 0.3s ease;
            overflow: hidden;
            background-color: #fff;
            border: none;
            height: 100%;
            position: relative;
        }
        
        .therapist-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--hover-shadow);
        }
        
        .card-img-top {
            height: 260px;
            object-fit: cover;
        }
        
        .specialty-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background-color: rgba(255, 255, 255, 0.9);
            color: var(--primary);
            font-size: 0.75rem;
            padding: 5px 10px;
            border-radius: 20px;
            font-weight: 600;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }
        
        .card-body {
            padding: 1.75rem;
        }
        
        .card-title {
            font-size: 1.4rem;
            margin-bottom: 0.5rem;
            color: var(--primary);
        }
        
        .card-subtitle {
            color: var(--light-text);
            font-size: 0.95rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
        }
        
        .card-subtitle i {
            margin-right: 6px;
            color: var(--secondary);
        }
        
        .btn-custom {
            border-radius: var(--btn-border-radius);
            font-weight: 600;
            padding: 0.75rem 1.25rem;
            transition: all 0.2s ease;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--primary-hover);
            border-color: var(--primary-hover);
            box-shadow: 0 5px 15px rgba(85, 105, 212, 0.3);
        }
        
        .btn-success {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }
        
        .btn-success:hover, .btn-success:focus {
            background-color: var(--secondary-hover);
            border-color: var(--secondary-hover);
            box-shadow: 0 5px 15px rgba(53, 184, 143, 0.3);
        }
        
        .btn-group-card {
            display: flex;
            gap: 10px;
        }
        
        .btn-group-card .btn {
            flex: 1;
        }
        
        .modal-content {
            border-radius: 16px;
            box-shadow: 0 15px 50px rgba(0, 0, 0, 0.15);
            border: none;
            overflow: hidden;
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--secondary) 100%);
            color: white;
            border-bottom: none;
            padding: 1.5rem;
        }
        
        .modal-title {
            font-size: 1.4rem;
            font-weight: 700;
        }
        
        .modal-body {
            padding: 2rem;
        }
        
        .modal-profile-img {
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .therapist-info {
            margin-top: 1.5rem;
        }
        
        .therapist-info p {
            margin-bottom: 1rem;
        }
        
        .therapist-info strong {
            color: var(--primary);
            font-weight: 600;
        }
        
        .specialty-list {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            margin: 0.5rem 0;
        }
        
        .specialty-tag {
            background-color: rgba(85, 105, 212, 0.1);
            color: var(--primary);
            font-size: 0.8rem;
            padding: 4px 12px;
            border-radius: 20px;
            font-weight: 600;
        }
        
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
            position: relative;
        }
        
        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 4px;
            background: linear-gradient(to right, var(--primary), var(--secondary));
            margin: 1rem auto 0;
            border-radius: 2px;
        }
        
     
        
        /* Accessibility Improvements */
        .btn:focus, button:focus {
            box-shadow: 0 0 0 3px rgba(85, 105, 212, 0.3);
        }
        
        /* Responsive Adjustments */
        @media (max-width: 992px) {
            .page-header {
                padding: 3rem 0 1.5rem;
            }
            
            .page-header h1 {
                font-size: 2.2rem;
            }
        }
        
        @media (max-width: 768px) {
            .card-img-top {
                height: 220px;
            }
            
            .page-header {
                border-radius: 0 0 30px 30px;
            }
            
            .btn-group-card {
                flex-direction: column;
            }
            
            .page-header h1 {
                font-size: 2rem;
            }
        }
        
        /* Animation Effects */
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .therapist-card {
            animation: fadeIn 0.5s ease-out forwards;
        }
        
        .therapist-card:nth-child(1) { animation-delay: 0.1s; }
        .therapist-card:nth-child(2) { animation-delay: 0.2s; }
        .therapist-card:nth-child(3) { animation-delay: 0.3s; }
    </style>
</head>
<body>
    <header class="page-header">
        <div class="container text-center">
            <h1>Find Your Ideal Therapist</h1>
            <p class="lead">Connect with qualified mental health professionals for personalized support on your journey to wellness.</p>
        </div>
    </header>
    
    <div class="container">
        <h2 class="section-title">Our Expert Therapists</h2>
        
        <div class="row g-4">
            <!-- Therapist 1 -->
            <div class="col-lg-4 col-md-6">
                <div class="card therapist-card">
                    <div class="specialty-badge">
                        <i class="fas fa-certificate me-1"></i> Top Rated
                    </div>
                    <img src="/api/placeholder/400/320" class="card-img-top" alt="Dr. ANEBOM ODETTE, Mental Health Specialist">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Dr. ANEBOM ODETTE </h5>
                        <p class="card-subtitle">
                            <i class="fas fa-brain"></i> Mental Health Specialist
                        </p>
                        <p class="card-text mb-4">Specializing in anxiety and depression treatment using evidence-based approaches including CBT and mindfulness techniques.</p>
                        <div class="btn-group-card mt-auto">
                            <button type="button" class="btn btn-primary btn-custom" data-bs-toggle="modal" data-bs-target="#detailsModal1">
                                <i class="fas fa-info-circle me-2"></i> Details
                            </button>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Therapist 2 -->
            <div class="col-lg-4 col-md-6">
                <div class="card therapist-card">
                    <div class="specialty-badge">
                        <i class="fas fa-star me-1"></i> Experienced
                    </div>
                    <img src="/api/placeholder/400/320" class="card-img-top" alt="Dr. CHENWI BLAISE, Depression & Anxiety Expert">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Dr. CHENWI BLAISE</h5>
                        <p class="card-subtitle">
                            <i class="fas fa-heartbeat"></i> Depression & Anxiety Expert
                        </p>
                        <p class="card-text mb-4">Helping patients overcome depression and anxiety with personalized treatment plans and supportive therapy.</p>
                        <div class="btn-group-card mt-auto">
                            <button type="button" class="btn btn-primary btn-custom" data-bs-toggle="modal" data-bs-target="#detailsModal2">
                                <i class="fas fa-info-circle me-2"></i> Details
                            </button>
            
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Therapist 3 -->
            <div class="col-lg-4 col-md-6">
                <div class="card therapist-card">
                    <div class="specialty-badge">
                        <i class="fas fa-award me-1"></i> Certified
                    </div>
                    <img src="/api/placeholder/400/320" class="card-img-top" alt="Dr.CHE LINDA , Trauma & Relationship Counselor">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Dr. CHE LINDA </h5>
                        <p class="card-subtitle">
                            <i class="fas fa-hands-helping"></i> Trauma & Relationship Counselor
                        </p>
                        <p class="card-text mb-4">Specialized in trauma recovery and relationship counseling with EMDR certification and compassionate approach.</p>
                        <div class="btn-group-card mt-auto">
                            <button type="button" class="btn btn-primary btn-custom" data-bs-toggle="modal" data-bs-target="#detailsModal3">
                                <i class="fas fa-info-circle me-2"></i> Details
                            </button>
                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Structure for Details (Therapist 1) -->
    <div class="modal fade" id="detailsModal1" tabindex="-1" aria-labelledby="detailsModal1Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModal1Label">Dr. ANEBOM ODETTE </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
            
                        <div class="col-md-8">
                            <div class="therapist-info">
                                <p>Dr. ANEBOM ODETTE is a renowned mental health specialist with 10+ years of experience in therapy and counseling. She specializes in Cognitive Behavioral Therapy (CBT) and mindfulness-based techniques.</p>
                                
                                <p><strong>Specialties:</strong></p>
                                <div class="specialty-list">
                                    <span class="specialty-tag">Anxiety</span>
                                    <span class="specialty-tag">Depression</span>
                                    <span class="specialty-tag">Stress Management</span>
                                </div>
                                
                                <p><strong>Education:</strong> Ph.D. in Clinical Psychology, University of BOTSWANA</p>
                                <p><strong>License:</strong> Licensed Clinical Psychologist (LCP)</p>
                                <p><strong>Languages:</strong> English, French</p>
                                <p><strong>Session Format:</strong> Video, Phone, or Chat</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="payment.php" class="btn btn-success">Book Session</a>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Modal Structure for Details (Therapist 2) -->
    <div class="modal fade" id="detailsModal2" tabindex="-1" aria-labelledby="detailsModal2Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModal2Label">Dr. CHENWI BLAISE</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-8">
                            <div class="therapist-info">
                                <p>Dr. CHENWI BLAISE specializes in treating depression and anxiety, helping patients regain control of their lives. He uses a patient-centered approach, tailoring therapy to individual needs.</p>
                                
                                <p><strong>Specialties:</strong></p>
                                <div class="specialty-list">
                                    <span class="specialty-tag">Depression</span>
                                    <span class="specialty-tag">Anxiety</span>
                                    <span class="specialty-tag">Panic Disorders</span>
                                </div>
                                
                                <p><strong>Education:</strong> Psy.D. in Counseling Psychology, University Dschang</p>
                                <p><strong>License:</strong> Licensed Professional Counselor (LPC)</p>
                                <p><strong>Languages:</strong> English, French</p>
                                <p><strong>Session Format:</strong> Video, Phone, or In-Person</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="payment.php" class="btn btn-success">Book Session</a>
                </div>
            </div>
        </div>
    </div>
    
   <!-- Modal Structure for Details (Therapist 3) -->
   <div class="modal fade" id="detailsModal3" tabindex="-1" aria-labelledby="detailsModal3Label" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModal3Label">Dr.CHE LINDA </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
    
                        <div class="col-md-8">
                            <div class="therapist-info">
                                <p>Dr. CHE LINDA specializes in trauma and relationship counseling, helping individuals and couples heal and build stronger connections. She is certified in EMDR therapy.</p>
                                
                                <p><strong>Specialties:</strong></p>
                                <div class="specialty-list">
                                    <span class="specialty-tag">Trauma</span>
                                    <span class="specialty-tag">Relationship Issues</span>
                                    <span class="specialty-tag">Family Counseling</span>
                                </div>
                                
                                <p><strong>Education:</strong> M.S. in Marriage and Family Therapy, University of Buea</p>
                                <p><strong>License:</strong> Licensed Marriage and Family Therapist (LMFT)</p>
                                <p><strong>Languages:</strong> English</p>
                                <p><strong>Session Format:</strong> Video, In-Person</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <a href="payment.php" class="btn btn-success">Book Session</a>
                </div>
            </div>
        </div>

    
    </div>
    <div class="nav-controls">
            <a href="reset-password.php" class="nav-button" title="Reset Password">
                <i class="fas fa-key"></i>
            </a>
            <a href="logout.php" class="nav-button" title="Sign Out">
                <i class="fas fa-power-off"></i>
            </a>
        </div>
    
   
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>
</html>