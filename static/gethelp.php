<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Get Help - Safe Space</title>
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <!-- Swiper CSS -->
  <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.min.css" />
  <style>
    :root {
      --primary-color: #4e73df;
      --secondary-color: #6c757d;
      --success-color: #1cc88a;
      --danger-color: #e74a3b;
      --warning-color:rgb(97, 72, 7);
      --light-color: #f8f9fc;
    }
    
    body {
      font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
      background-color: #f8f9fc;
      color: #5a5c69;
    }
    
    .page-header {
      background: linear-gradient(to right, rgb(82, 147, 226), rgb(236, 228, 223));
      color: white;
      padding: 2rem 0;
      position: relative;
      margin-bottom: 2rem;
    }
    
    .page-header::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 0;
      right: 0;
      height: 50px;
      background: linear-gradient(to bottom right, transparent 49%, white 50%);
    }
    
    .emergency-card {
      border-left: 5px solid var(--danger-color);
      border-radius: 0.75rem;
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
      transition: transform 0.3s ease;
    }
    
    .emergency-card:hover {
      transform: translateY(-5px);
    }
    
    .help-card {
      background-color: white;
      transition: all 0.3s ease;
      height: 100%;
      border-radius: 1rem;
      overflow: hidden;
      border: none;
    }
    
    .help-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .service-card {
      border: none;
      border-radius: 1rem;
      overflow: hidden;
      transition: all 0.3s ease;
      height: 100%;
    }
    
    .service-card:hover {
      transform: translateY(-5px);
      box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    
    .card-header-custom {
      border-bottom: 1px solid rgba(0,0,0,0.125);
      border-radius: 1rem 1rem 0 0 !important;
    }
    
    .main-header {
      position: relative;
      padding-bottom: 1rem;
      margin-bottom: 2rem;
      text-align: center;
      color: var(--primary-color);
    }
    
    .main-header:after {
      content: '';
      position: absolute;
      width: 50px;
      height: 3px;
      background-color: var(--primary-color);
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
    }
    
    .swiper-container {
      padding: 2rem 1rem;
    }
    
    .swiper-pagination-bullet-active {
      background-color: var(--primary-color);
    }
    
    .btn-primary {
      background-color: var(--primary-color);
      border-color: var(--primary-color);
    }
    
    .text-primary {
      color: var(--primary-color) !important;
    }
    
    .bg-primary {
      background-color: var(--primary-color) !important;
    }
    
    .list-group-item i {
      color: var(--success-color);
    }
    
    #help-yourself {
      background-color: #f8f9fc;
      padding: 4rem 0;
      position: relative;
    }
    
    #help-yourself-specific-disorders {
      background-color: white;
      padding: 4rem 0;
    }
    
    .crisis-icon {
      width: 50px;
      height: 50px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50%;
      background-color: var(--danger-color);
      color: white;
      font-size: 1.5rem;
      margin-right: 1rem;
    }
  </style>
</head>

<body>
  <!-- Placeholder for Header -->
  <div id="header-container"></div>

  <!-- Header Section -->
  <header class="page-header">
    <div class="container text-center">
      <h1 class="display-4 fw-bold mb-3">Get Help</h1>
      <p class="lead fs-4">Professional support when you need it most</p>
      <a href="#emergency-support" class="btn btn-light btn-lg rounded-pill shadow mt-3">
        <i class="fas fa-exclamation-triangle text-danger me-2"></i>Emergency Support
      </a>
    </div>
  </header>

  <div class="container mb-5">
    <!-- Emergency Section -->
    <div id="emergency-support" class="card emergency-card mb-5">
      <div class="card-body p-4">
        <h2 class="card-title text-danger mb-4">
          <i class="fas fa-exclamation-triangle me-2"></i>Immediate Support
        </h2>
        <p class="fw-bold fs-5 mb-4">If you're experiencing a mental health emergency or are in crisis:</p>
        <div class="row g-4 mt-2">
          <div class="col-md-6">
            <div class="d-flex align-items-center">
              <div class="crisis-icon">
                <i class="fas fa-phone"></i>
              </div>
              <div>
                <span class="fw-bold d-block">Call 988</span>
                <span class="text-muted">Suicide & Crisis Lifeline (24/7)</span>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center">
              <div class="crisis-icon">
                <i class="fas fa-comment-dots"></i>
              </div>
              <div>
                <span class="fw-bold d-block">Text HOME to 741741</span>
                <span class="text-muted">Crisis Text Line (24/7)</span>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center">
              <div class="crisis-icon">
                <i class="fas fa-ambulance"></i>
              </div>
              <div>
                <span class="fw-bold d-block">Call 911</span>
                <span class="text-muted">For immediate danger situations</span>
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="d-flex align-items-center">
              <div class="crisis-icon">
                <i class="fas fa-shield-alt"></i>
              </div>
              <div>
                <span class="fw-bold d-block">Veterans Crisis Line</span>
                <span class="text-muted">Call 988, press 1</span>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Help Yourself Section -->
    <section id="help-yourself" class="py-5 rounded-3 shadow-sm">
      <div class="container">
        <h2 class="main-header">What to do if you are struggling with mental health problems?</h2>

        <!-- Swiper Container -->
        <div class="swiper-container">
          <div class="swiper-wrapper">

            <!-- First Slide -->
            <div class="swiper-slide">
              <div class="row help-card align-items-center p-4 rounded shadow-sm">
                <div class="col-md-6 order-md-2">
                  <img src="../assets/images/riding.png" alt="People riding bicycles" class="img-fluid rounded mb-3">
                </div>
                <div class="col-md-6 order-md-1">
                  <h4 class="card-title mb-3 text-primary">Look After Your Physical Health</h4>
                  <p class="card-text">Looking after your physical health can make a significant difference to your mental wellbeing. Regular exercise, a balanced diet, and a disciplined sleeping schedule can boost your self-esteem and help your concentration.</p>
            
                </div>
              </div>
            </div>

            <!-- Second Slide -->
            <div class="swiper-slide">
              <div class="row help-card align-items-center p-4 rounded shadow-sm">
                <div class="col-md-6 order-md-2">
                  <img src="../assets/images/water.png" alt="Drinking water" class="img-fluid rounded mb-3">
                </div>
                <div class="col-md-6 order-md-1">
                  <h4 class="card-title mb-3 text-primary">Avoid Alcohol and Drugs</h4>
                  <p class="card-text">Drinking alcohol is not a safe way to cope with mental health difficulties. Both men and women should stay within the alcohol limits of 14 units per week. Try healthier alternatives like water, herbal teas, or exercise.</p>
            
                </div>
              </div>
            </div>

            <!-- Third Slide -->
            <div class="swiper-slide">
              <div class="row help-card align-items-center p-4 rounded shadow-sm">
                <div class="col-md-6 order-md-2">
                  <img src="../assets/images/LADY.png" alt="Two women talking" class="img-fluid rounded mb-3">
                </div>
                <div class="col-md-6 order-md-1">
                  <h4 class="card-title mb-3 text-primary">Talking About Your Feelings</h4>
                  <p class="card-text">Talking about your feelings is not a sign of weakness but rather a sign of taking charge of your wellbeing. Reach out to family, friends, or a professional to share what you're going through.</p>
              
                </div>
              </div>
            </div>

            <!-- Fourth Slide -->
            <div class="swiper-slide">
              <div class="row help-card align-items-center p-4 rounded shadow-sm">
                <div class="col-md-6 order-md-2">
                  <img src="../assets/images/break.png" alt="People on a beach" class="img-fluid rounded mb-3">
                </div>
                <div class="col-md-6 order-md-1">
                  <h4 class="card-title mb-3 text-primary">Taking a Break</h4>
                  <p class="card-text">Sometimes a change of scenery can be enough to de-stress you. Listen to your body and take breaks when needed to recharge. Even a short walk or moments of mindfulness can make a difference.</p>
       
                </div>
              </div>
            </div>

            <!-- Fifth Slide -->
            <div class="swiper-slide">
              <div class="row help-card align-items-center p-4 rounded shadow-sm">
                <div class="col-md-6 order-md-2">
                  <img src="../assets/images/help.png" alt="Two people holding hands" class="img-fluid rounded mb-3">
                </div>
                <div class="col-md-6 order-md-1">
                  <h4 class="card-title mb-3 text-primary">Asking for Help</h4>
                  <p class="card-text">If you are feeling overwhelmed, don't hesitate to ask for help. Seek a support group, counselor, or a professional. Remember that reaching out is a sign of strength, not weakness.</p>
              
                </div>
              </div>
            </div>

          </div>

          <!-- Add Pagination -->
          <div class="swiper-pagination"></div>
          
          <!-- Add Navigation -->
          <!-- <div class="swiper-button-next text-primary"></div>
          <div class="swiper-button-prev text-primary"></div> -->
        </div>
      </div>
    </section>

    <section id="help-yourself-specific-disorders" class="py-5 mt-5 rounded-3 shadow-sm">
      <div class="container">
        <div class="main-header text-center mb-5">
          <h2 class="display-5 fw-bold text-primary">Learning to Cope with Different Forms of Mental Disorders</h2>
          <p class="text-muted mt-3">Practical strategies to help manage symptoms and improve wellbeing</p>
        </div>

        <div class="row g-4 mt-3">
          <!-- Anxiety -->
          <div class="col-lg-4">
            <div class="card service-card shadow-sm h-100">
              <div class="card-header-custom text-center bg-light py-4">
                <i class="fas fa-heartbeat text-primary fs-3 mb-3 d-block"></i>
                <h4 class="fw-bold">Anxiety</h4>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Practice Deep Breathing Exercises</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Engage in Regular Physical Exercise</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Challenge Negative Thought Patterns</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Reduce Caffeine and Alcohol Intake</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Consider Cognitive Behavioral Therapy</span>
                  </li>
                </ul>

              </div>
            </div>
          </div>

          <!-- Depression -->
          <div class="col-lg-4">
            <div class="card service-card shadow-sm h-100">
              <div class="card-header-custom text-center bg-light py-4">
                <i class="fas fa-sun text-warning fs-3 mb-3 d-block"></i>
                <h4 class="fw-bold">Depression</h4>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Maintain a Nutritious Diet</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Open Up to Someone You Trust</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Practice Self-Compassion Daily</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Maintain Regular Physical Activity</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Set Small, Achievable Daily Goals</span>
                  </li>
                </ul>
              </div>
            </div>
          </div>

          <!-- Frustration -->
          <div class="col-lg-4">
            <div class="card service-card shadow-sm h-100">
              <div class="card-header-custom text-center bg-light py-4">
                <i class="fas fa-hand-holding-heart text-danger fs-3 mb-3 d-block"></i>
                <h4 class="fw-bold">Frustration</h4>
              </div>
              <div class="card-body">
                <ul class="list-group list-group-flush">
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Practice Staying Focused and Calm</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Incorporate Mindfulness Techniques</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Take Scheduled Breaks When Needed</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Try Progressive Relaxation Methods</span>
                  </li>
                  <li class="list-group-item border-0 py-3 d-flex align-items-center">
                    <i class="fas fa-check me-3"></i>
                    <span>Express Emotions Through Journaling</span>
                  </li>
                </ul>
                
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Get Professional Help Section -->
    <section class="py-5 mt-5">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6">
            <h2 class="text-primary mb-4">Need Professional Support?</h2>
            <p class="lead mb-4">Our network of qualified mental health professionals is ready to help you navigate your journey to wellness.</p>
            <div class="d-flex flex-column gap-3 mb-4">
              <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-circle p-3 me-3">
                  <i class="fas fa-user-md"></i>
                </div>
                <div>
                  <h5 class="mb-1">Licensed Therapists</h5>
                  <p class="text-muted mb-0">Connect with experienced professionals</p>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-circle p-3 me-3">
                  <i class="fas fa-calendar-check"></i>
                </div>
                <div>
                  <h5 class="mb-1">Flexible Scheduling</h5>
                  <p class="text-muted mb-0">Find appointments that work for you</p>
                </div>
              </div>
              <div class="d-flex align-items-center">
                <div class="bg-primary text-white rounded-circle p-3 me-3">
                  <i class="fas fa-laptop"></i>
                </div>
                <div>
                  <h5 class="mb-1">Virtual Sessions</h5>
                  <p class="text-muted mb-0">Get help from the comfort of your home</p>
                </div>
              </div>
            </div>
            <a href="../authentification/login.php" class="btn btn-primary btn-lg rounded-pill">Find a Therapist</a>
          </div>
          <div class="col-lg-6 mt-4 mt-lg-0">
            <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
              <div class="card-body p-0">
              <img src="../assets/images/image.jpeg"  alt="Professional therapy session" class="img-fluid w-100">
                <div class="p-4">
                  <h4>Your Path to Recovery Starts Here</h4>
                  <p class="mb-0">Taking the first step is often the hardest. We're here to make it easier.</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

  <!-- Footer Placeholder -->
  <div id="footer-placeholder"></div>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script>

  <!-- Custom Scripts -->
  <script>
    document.addEventListener("DOMContentLoaded", function () {
      // Load header
      fetch("header.php")
        .then(response => response.text())
        .then(data => {
          document.getElementById('header-container').innerHTML = data;
        })
        .catch(error => console.error('Error loading header:', error));

      // Load footer
      fetch('footer.php')
        .then(response => response.text())
        .then(data => document.getElementById('footer-placeholder').innerHTML = data)
        .catch(err => console.log('Error loading footer:', err));

      // Initialize Swiper
      var swiper = new Swiper('.swiper-container', {
        loop: true,
        autoplay: {
          delay: 5000,
          disableOnInteraction: false,
        },
        speed: 800,
        effect: 'slide',
        pagination: {
          el: '.swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: '.swiper-button-next',
          prevEl: '.swiper-button-prev',
        },
        breakpoints: {
          640: {
            slidesPerView: 1,
            spaceBetween: 20,
          },
          768: {
            slidesPerView: 1,
            spaceBetween: 30,
          },
        }
      });

      // Smooth scrolling for anchor links
      document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
          e.preventDefault();
          document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
          });
        });
      });
    });
  </script>
</body>

</html>