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
    <title>Mental Health Journey</title>
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
        
        .cosmic-container {
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
        
        .welcome-portal {
            position: relative;
            text-align: center;
            padding: 2rem;
            background: rgba(26, 76, 124, 0.3);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            margin-bottom: 3rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.2);
            z-index: 1;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .user-name {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            background: linear-gradient(to right, var(--light-blue), var(--text-white));
            -webkit-background-clip: text;
            background-clip: text;
            -webkit-text-fill-color: transparent;
            animation: glow 3s infinite alternate;
        }
        
        @keyframes glow {
            from { text-shadow: 0 0 5px rgba(168, 208, 240, 0.5); }
            to { text-shadow: 0 0 20px rgba(168, 208, 240, 0.8); }
        }
        
        .welcome-portal p {
            font-size: 1.2rem;
            color: var(--light-blue);
            margin-top: 0;
        }
        
        .journey-cards {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
            justify-content: center;
            position: relative;
            z-index: 1;
        }
        
        .support-module {
            background: linear-gradient(145deg, var(--secondary-blue), var(--primary-blue));
            border-radius: 15px;
            padding: 2rem;
            width: 100%;
            max-width: 350px;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .support-module:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.4);
        }
        
        .support-module::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(112, 181, 232, 0.1) 0%, rgba(26, 76, 124, 0) 70%);
            opacity: 0;
            transition: opacity 0.5s ease;
            pointer-events: none;
        }
        
        .support-module:hover::before {
            opacity: 1;
            animation: pulse 2s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(0.95); }
            50% { transform: scale(1); }
            100% { transform: scale(0.95); }
        }
        
        .module-icon {
            font-size: 3rem;
            color: var(--accent-blue);
            margin-bottom: 1.5rem;
            transition: transform 0.3s ease;
        }
        
        .support-module:hover .module-icon {
            transform: scale(1.2);
            color: var(--light-blue);
        }
        
        .module-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--text-white);
        }
        
        .module-content {
            font-size: 1rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
            color: var(--text-light);
            flex-grow: 1;
        }
        
        .cosmic-button {
            background: linear-gradient(to right, var(--accent-blue), var(--secondary-blue));
            color: var(--text-white);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            position: relative;
            overflow: hidden;
            z-index: 1;
            display: inline-block;
        }
        
        .cosmic-button::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 0;
            height: 100%;
            background: linear-gradient(to right, var(--secondary-blue), var(--deep-blue));
            transition: width 0.5s ease;
            z-index: -1;
            border-radius: 50px;
        }
        
        .cosmic-button:hover {
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 7px 20px rgba(0, 0, 0, 0.3);
        }
        
        .cosmic-button:hover::before {
            width: 100%;
        }
        
        .nav-controls {
            display: flex;
            justify-content: center;
            gap: 1.5rem;
            margin-top: 3rem;
            position: relative;
            z-index: 1;
        }
        
        .nav-button {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: linear-gradient(145deg, var(--secondary-blue), var(--primary-blue));
            color: var(--text-white);
            text-decoration: none;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .nav-button:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            background: var(--accent-blue);
            color: white;
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .journey-cards {
                flex-direction: column;
                align-items: center;
            }
            
            .support-module {
                max-width: 100%;
            }
            
            .welcome-portal {
                padding: 1.5rem;
            }
            
            .user-name {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <div class="cosmic-container">
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

        <div class="welcome-portal">
            <h1 class="user-name">Welcome <?php echo htmlspecialchars($_SESSION["username"]); ?>!</h1>
            <p>Your Path to Wellness</p>
        </div>

        <div class="journey-cards">
            <div class="support-module">
                <div class="module-icon">
                    <i class="fas fa-brain"></i>
                </div>
                <h2 class="module-title">Therapeutic Space</h2>
                <p class="module-content">
                    A private sanctuary where licensed therapists help guide you through life's challenges with understanding and expertise.
                </p>
                <a href="therapist.php" class="cosmic-button">Connect</a>
            </div>

            <div class="support-module">
                <div class="module-icon">
                    <i class="fas fa-hands-holding-circle"></i>
                </div>
                <h2 class="module-title">Community Circle</h2>
                <p class="module-content">
                    Find strength in shared experiences. Our support groups offer a space for connection and mutual understanding.
                </p>
                <a href="https://chat.whatsapp.com/D3rCNYxlMjh8TRNoFfblxj" class="cosmic-button">Join</a>
            </div>

            <div class="support-module">
                <div class="module-icon">
                    <i class="fas fa-shield-heart"></i>
                </div>
                <h2 class="module-title">Crisis Support</h2>
                <p class="module-content">
                    Immediate assistance available when you need it most. Our crisis team is here to provide support 24/7.
                </p>
                <a href="resource.php" class="cosmic-button">Access</a>
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
    </div>

    <!-- Add Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
</body>
</html>