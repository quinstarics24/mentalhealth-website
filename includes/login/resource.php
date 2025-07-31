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
    <title>Crisis Support Resources</title>
    <!-- Add Bootstrap CSS link -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Add Font Awesome CSS link for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        :root {
            --primary-blue: #1a4c7c;
            --secondary-blue: #2a6ca5;
            --light-blue: #a8d0f0;
            --accent-blue: #70b5e8;
            --deep-blue: #0d2b4b;
            --text-white: #f8f9fa;
            --text-light: #e9ecef;
            --alert-red: #dc3545;
            --success-green: #28a745;
        }
        
        body {
            background: linear-gradient(135deg, var(--deep-blue), var(--primary-blue));
            color: var(--text-white);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
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
            background-color: #ffffff;
            border-radius: 50%;
            opacity: 0.7;
            animation: twinkle 4s infinite ease-in-out;
        }
        
        @keyframes twinkle {
            0%, 100% { opacity: 0.2; }
            50% { opacity: 0.8; }
        }
        
        .page-header {
            position: relative;
            text-align: center;
            padding: 2rem;
            background: rgba(26, 76, 124, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .page-title {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--text-white);
        }
        
        .page-subtitle {
            font-size: 1.2rem;
            color: var(--light-blue);
            margin-top: 0;
        }
        
        .emergency-alert {
            background-color: rgba(220, 53, 69, 0.2);
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
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-bottom: 2rem;
        }
        
        .resource-card {
            background: rgba(42, 108, 165, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 1.5rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .resource-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 35px rgba(0, 0, 0, 0.3);
        }
        
        .resource-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--accent-blue);
        }
        
        .resource-title {
            font-size: 1.3rem;
            color: var(--text-white);
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
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .resource-contact i {
            width: 20px;
            text-align: center;
        }
        
        .action-button {
            background: linear-gradient(to right, var(--accent-blue), var(--secondary-blue));
            color: var(--text-white);
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
            background: rgba(26, 76, 124, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
        }
        
        .chat-title {
            font-size: 1.8rem;
            margin-bottom: 1rem;
            color: var(--text-white);
        }
        
        .chat-description {
            color: var(--text-light);
            margin-bottom: 1.5rem;
            max-width: 800px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .chat-button {
            background: linear-gradient(to right, var(--success-green), var(--secondary-blue));
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
            color: var(--text-white);
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
            <h1 class="page-title">Crisis Support Resources</h1>
            <p class="page-subtitle">Help is available 24/7 - You are not alone</p>
        </div>
        
        <div class="emergency-alert">
            <h3 class="emergency-title"><i class="fas fa-exclamation-triangle"></i> Emergency Situations</h3>
            <p>If you or someone you know is in immediate danger or experiencing a life-threatening emergency, please call <strong>911</strong> or go to your nearest emergency room immediately.</p>
        </div>
        
        <div class="content-container">
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-phone"></i>
                </div>
                <h3 class="resource-title">Crisis Hotlines</h3>
                <p class="resource-description">
                    Trained crisis counselors are available to speak with you 24/7 and provide immediate support, guidance, and resources.
                </p>
                <div class="resource-contact">
                    <i class="fas fa-phone-alt"></i>
                    <span>National Suicide Prevention Lifeline: 988</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-phone-alt"></i>
                    <span>Crisis Text Line: Text HOME to 741741</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-phone-alt"></i>
                    <span>Veterans Crisis Line: 988, Press 1</span>
                </div>
                <a href="tel:988" class="action-button">Call Now</a>
            </div>
            
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-hospital"></i>
                </div>
                <h3 class="resource-title">Local Crisis Centers</h3>
                <p class="resource-description">
                    Mental health crisis centers provide in-person support and evaluation. These centers offer walk-in services without an appointment.
                </p>
                <div class="resource-contact">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Community Behavioral Health: 123 Main St</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>City Mental Health Center: 456 Oak Ave</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-clock"></i>
                    <span>Hours: 24/7, Walk-ins Welcome</span>
                </div>
                <a href="map.php" class="action-button">Find Nearest</a>
            </div>
            
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-users"></i>
                </div>
                <h3 class="resource-title">Support Groups</h3>
                <p class="resource-description">
                    Connecting with others who understand what you're going through can provide comfort and practical advice during difficult times.
                </p>
                <div class="resource-contact">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Mental Health Peer Support: Mon/Wed 7PM</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Family Support Group: Tuesdays 6PM</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Community Center: 789 Pine St</span>
                </div>
                <a href="groups.php" class="action-button">Join Group</a>
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
        
        <div class="content-container">
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-book-medical"></i>
                </div>
                <h3 class="resource-title">Self-Help Resources</h3>
                <p class="resource-description">
                    Access tools and techniques that can help you manage your symptoms and develop coping strategies.
                </p>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Grounding Techniques</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Safety Planning</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Mindfulness Exercises</span>
                </div>
                <a href="resources.php" class="action-button">View Resources</a>
            </div>
            
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-clipboard-list"></i>
                </div>
                <h3 class="resource-title">Crisis Assessment</h3>
                <p class="resource-description">
                    Take a confidential assessment to help determine your current mental health needs and receive personalized recommendations.
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
                    <span>Immediate Results</span>
                </div>
                <a href="assessment.php" class="action-button">Take Assessment</a>
            </div>
            
            <div class="resource-card">
                <div class="resource-icon">
                    <i class="fas fa-hand-holding-heart"></i>
                </div>
                <h3 class="resource-title">For Loved Ones</h3>
                <p class="resource-description">
                    Resources for family members and friends who want to support someone experiencing a mental health crisis.
                </p>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>How to Support Someone in Crisis</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Warning Signs to Watch For</span>
                </div>
                <div class="resource-contact">
                    <i class="fas fa-file-alt"></i>
                    <span>Self-Care for Caregivers</span>
                </div>
                <a href="supporters.php" class="action-button">Learn More</a>
            </div>
        </div>
        
        <div style="text-align: center;">
            <a href="index.php" class="nav-back">
                <i class="fas fa-arrow-left"></i> Return to Dashboard
            </a>
        </div>
    </div>

    
    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>