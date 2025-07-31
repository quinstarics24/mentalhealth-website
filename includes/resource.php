<?php
// Initialize the session
session_start();

// Check if the user is logged in, if not then redirect them to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: welcome.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mental Health Resources & Support</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-bg: rgb(246, 246, 246);
            --secondary-blue: rgb(26, 134, 228);
            --light-blue: rgb(73, 67, 67);
            --accent-blue: rgb(56, 152, 226);
            --deep-blue: rgb(148, 188, 226);
            --text-dark: rgb(30, 30, 31);
            --text-light: rgb(45, 46, 48);
            --alert-red: #dc3545;
            --success-green: #28a745;
            --card-bg: rgba(255, 255, 255, 0.9);
        }
        
        body {
            background: var(--primary-bg);
            color: var(--text-dark);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            overflow-x: hidden;
        }
        
        .page-container {
            position: relative;
            width: 100%;
            min-height: 100vh;
            padding: 2rem;
        }
        
        .ambient-stars {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
        }
        
        .star {
            position: absolute;
            background-color: var(--accent-blue);
            border-radius: 50%;
            opacity: 0.4;
            animation: twinkle 4s infinite ease-in-out;
        }
        
        @keyframes twinkle {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.5; }
        }
        
        .page-header {
            position: relative;
            text-align: center;
            padding: 2.5rem;
            background: linear-gradient(135deg, rgba(56, 152, 226, 0.1), rgba(148, 188, 226, 0.2));
            backdrop-filter: blur(10px);
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-dark);
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            color: var(--light-blue);
            margin-top: 0;
        }
        
        .emergency-alert {
            background-color: rgba(220, 53, 69, 0.1);
            border-left: 5px solid var(--alert-red);
            padding: 1.5rem;
            border-radius: 8px;
            margin-bottom: 2rem;
            backdrop-filter: blur(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .emergency-title {
            color: var(--alert-red);
            font-size: 1.5rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .content-container {
            position: relative;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .resource-card {
            background: var(--card-bg);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.8rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .resource-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.15);
        }
        
        .resource-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--accent-blue);
        }
        
        .resource-title {
            font-size: 1.3rem;
            color: var(--text-dark);
            margin-bottom: 1rem;
            font-weight: 600;
        }
        
        .resource-description {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .resource-contact {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--light-blue);
            margin-bottom: 0.75rem;
            font-weight: 500;
        }
        
        .resource-contact i {
            width: 20px;
            text-align: center;
        }
        
        .action-button {
            background: linear-gradient(to right, var(--accent-blue), var(--secondary-blue));
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            display: inline-block;
            margin-top: 0.5rem;
        }
        
        .action-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            color: white;
        }
        
        .chat-module {
            background: linear-gradient(135deg, rgba(56, 152, 226, 0.1), rgba(148, 188, 226, 0.2));
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2.5rem;
            margin-bottom: 2.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            text-align: center;
        }
        
        .chat-title {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--text-dark);
        }
        
        .chat-description {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .chat-button {
            background: linear-gradient(to right, var(--success-green), var(--accent-blue));
            padding: 1rem 2.5rem;
            font-size: 1.1rem;
        }
        
        .nav-back {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--light-blue);
            text-decoration: none;
            font-weight: 500;
            margin-top: 2rem;
            transition: color 0.3s ease;
        }
        
        .nav-back:hover {
            color: var(--text-dark);
        }
        
        .video-preview {
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
        
        .section-title {
            font-size: 1.8rem;
            font-weight: 600;
            margin: 1.5rem 0;
            color: var(--text-dark);
            text-align: center;
            position: relative;
            z-index: 1;
        }
        
        .article-date {
            font-size: 0.9rem;
            color: var(--light-blue);
            margin-bottom: 0.5rem;
        }
        
        .article-source {
            font-style: italic;
            color: var(--light-blue);
            margin-bottom: 1rem;
        }
        
        .category-tag {
            display: inline-block;
            padding: 0.3rem 0.8rem;
            background: rgba(56, 152, 226, 0.1);
            color: var(--accent-blue);
            border-radius: 20px;
            font-size: 0.8rem;
            margin-right: 0.5rem;
            margin-bottom: 0.5rem;
        }
        
        @media (max-width: 768px) {
            .page-title {
                font-size: 2rem;
            }
            
            .content-container {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>

    <!-- header-->
    <?php include 'header.php'; ?>

    <div class="page-container">
        <div class="ambient-stars">
            <?php for($i = 0; $i < 100; $i++): ?>
                <div class="star" style="
                    left: <?php echo rand(0, 100); ?>vw;
                    top: <?php echo rand(0, 100); ?>vh;
                    width: <?php echo rand(1, 3); ?>px;
                    height: <?php echo rand(1, 3); ?>px;
                    animation-delay: -<?php echo rand(0, 4); ?>s;
                "></div>
            <?php endfor; ?>
        </div>
        
        <div class="page-header">
            <h1 class="page-title">Mental Health Resources & Support</h1>
            <p class="page-subtitle">Professional help is available 24/7 - You are never alone in your journey</p>
        </div>
        
        <div class="emergency-alert">
            <h3 class="emergency-title"><i class="fas fa-exclamation-triangle"></i> Emergency Situations</h3>
            <p>If you or someone you know is in immediate danger or experiencing a life-threatening emergency, please call <strong>911</strong> or go to your nearest emergency room immediately. For mental health crisis support, call or text 988 to reach the Suicide and Crisis Lifeline - available 24/7.</p>
        </div>
        
        <h2 class="section-title">Educational Videos</h2>
        <div class="content-container">
            <!-- Understanding Anxiety Video -->
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-video"></i>
                </div>
                <h3 class="resource-title">Understanding Anxiety: Symptoms, Causes, and Treatments</h3>
                <p class="resource-description">
                    Dr. Craig Sawchuk, a clinical psychologist at Mayo Clinic, discusses the symptoms, causes, and treatments of anxiety disorders.
                </p>
                <div class="video-preview">
                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/UR6ZUJsnV1E" frameborder="0" allowfullscreen></iframe>
                </div>
                <a href="https://www.youtube.com/watch?v=UR6ZUJsnV1E" class="action-button" target="_blank">Watch Now</a>
            </div>

            <!-- Coping with Depression Video -->
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-video"></i>
                </div>
                <h3 class="resource-title">Depression: How to Recognize it and How to Treat it</h3>
                <p class="resource-description">
                    This webinar provides insights into recognizing and treating depression, offering valuable information for those seeking help.
                </p>
                <div class="video-preview">
                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/MUXh5k0J4MY" frameborder="0" allowfullscreen></iframe>
                </div>
                <a href="https://www.youtube.com/watch?v=MUXh5k0J4MY" class="action-button" target="_blank">Watch Now</a>
            </div>

            <!-- How to Deal With Anxiety Video -->
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-video"></i>
                </div>
                <h3 class="resource-title">How to Deal With Anxiety - The Step-by-Step Guide</h3>
                <p class="resource-description">
                    This video provides a step-by-step guide on managing anxiety, including practical techniques and exercises.
                </p>
                <div class="video-preview">
                    <iframe width="100%" height="200" src="https://www.youtube.com/embed/PxjxY9VilCs" frameborder="0" allowfullscreen></iframe>
                </div>
                <a href="https://www.youtube.com/watch?v=PxjxY9VilCs" class="action-button" target="_blank">Watch Now</a>
            </div>
        </div>

        <h2 class="section-title">Professional Articles</h2>
        <div class="content-container">
            <!-- Article 1 -->
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div>
                    <span class="category-tag">Anxiety</span>
                    <span class="category-tag">Research</span>
                </div>
                <h3 class="resource-title">The Neuroscience of Anxiety: What Happens in Your Brain When You're Anxious</h3>
                <p class="article-date">Published: February 12, 2025</p>
                <p class="article-source">Source: Journal of Psychological Research</p>
                <p class="resource-description">
                    This article explores the neurological mechanisms behind anxiety, including the amygdala's role, stress hormone production, and how understanding these processes can improve treatment approaches.
                </p>
                <a href="articles/neuroscience-anxiety.php" class="action-button">Read Article</a>
            </div>
            
            <!-- Article 2 -->
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div>
                    <span class="category-tag">Depression</span>
                    <span class="category-tag">Treatment</span>
                </div>
                <h3 class="resource-title">Beyond Medication: Integrated Approaches to Managing Depression</h3>
                <p class="article-date">Published: January 8, 2025</p>
                <p class="article-source">Source: Cameroon Journal of Psychiatry</p>
                <p class="resource-description">
                    A comprehensive review of evidence-based treatments for depression that go beyond medication, including cognitive behavioral therapy, mindfulness practices, exercise, nutrition, and light therapy.
                </p>
                <a href="articles/integrated-depression-treatment.php" class="action-button">Read Article</a>
            </div>
            
            <!-- Article 3 -->
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-newspaper"></i>
                </div>
                <div>
                    <span class="category-tag">Stress</span>
                    <span class="category-tag">Coping Skills</span>
                </div>
                <h3 class="resource-title">The Science of Resilience: Building Mental Strength in Difficult Times</h3>
                <p class="article-date">Published: March 5, 2025</p>
                <p class="article-source">Source: Harvard Health Publishing</p>
                <p class="resource-description">
                    This article examines the psychological factors that contribute to resilience, along with practical strategies for developing greater mental strength when facing challenges and adversity.
                </p>
                <a href="articles/resilience-science.php" class="action-button">Read Article</a>
            </div>
        </div>

        <div class="chat-module">
            <h2 class="chat-title">Speak with a Crisis Counselor Now</h2>
            <p class="chat-description">
                Our trained crisis counselors are available 24/7 to provide immediate support through secure chat. All conversations are confidential and you can remain anonymous if you wish.
            </p>
            <a href="chat.php" class="action-button chat-button">
                <i class="fas fa-comment-dots"></i> Start Chat Now
            </a>
        </div>
        
        <h2 class="section-title">Additional Resources</h2>
        <div class="content-container">
            <!-- Self-Help Resources -->
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-book-medical"></i>
                </div>
                <h3 class="resource-title">Self-Help Resources</h3>
                <p class="resource-description">
                    Access evidence-based tools and techniques that can help you manage your symptoms and develop effective coping strategies.
                </p>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Grounding Techniques for Anxiety</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Creating a Personal Safety Plan</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Guided Mindfulness Exercises</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Sleep Hygiene Guidelines</span>
                </div>
                <a href="resources.php" class="action-button">View Resources</a>
            </div>
            
            <!-- Crisis Assessment -->
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3 class="resource-title">Mental Health Assessment</h3>
                <p class="resource-description">
                    Take a confidential assessment to help determine your current mental health needs and receive personalized recommendations for support.
                </p>
                <div class="resource-contact">
                    <i class="fas fa-clock"></i>
                    <span>Time: Approximately 5 minutes</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-lock"></i>
                    <span>Private & Confidential</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-chart-line"></i>
                    <span>Immediate Results & Resources</span>
                </div>
                <a href="assessment.php" class="action-button">Take Assessment</a>
            </div>
            
            <!-- For Loved Ones -->
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3 class="resource-title">Supporting Loved Ones</h3>
                <p class="resource-description">
                    Resources for family members and friends who want to effectively support someone experiencing mental health challenges.
                </p>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>How to Support Someone in Crisis</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Recognizing Warning Signs</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Self-Care for Caregivers</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Communication Strategies</span>
                </div>
                <a href="supporters.php" class="action-button">Learn More</a>
            </div>

           
        </div>
        
    </div>
 <!-- Footer Placeholder -->
 <div id="footer-placeholder"></div>

<!-- Scripts -->

<script>
   
    fetch('../static/footer.php')
        .then(response => response.text())
        .then(data => document.getElementById('footer-placeholder').innerHTML = data)
        .catch(err => console.log('Error loading footer:', err));
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>