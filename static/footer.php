<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe Space - Contact</title>

    <!-- Bootstrap Offline CSS -->
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        /* General Footer Styling */
        .footer {
            background:rgb(6, 14, 37);
            color: #fff;
            padding: 60px 0;
            border-radius: 10px 10px 0 0;
        }

        .footer .logo {
            font-size: 3rem;
            font-weight: bold;
            text-transform: uppercase;
            color: #ffffff;
            transition: all 0.3s ease;
        }

        .footer .logo:hover {
            transform: scale(1.1);
          
        }

        .footer p {
            font-size: 1rem;
            color: #bfbfbf;
        }

        .footer h5 {
            font-size: 1.3rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 20px;
            transition: text-shadow 0.3s ease;
        }

        .footer h5:hover {
            text-shadow: 0px 0px 10px rgba(144, 224, 239, 0.8);
        }

        .footer .links {
            list-style: none;
            padding: 0;
        }

        .footer .links li {
            margin-bottom: 10px;
        }

        .footer .links li a {
            text-decoration: none;
            color: #bfbfbf;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .footer .links li a:hover {
            color: #90e0ef;
            transform: translateX(5px);
        }

        .footer .icons a {
            font-size: 1.5rem;
            color: #749adb;
            margin-right: 15px;
            transition: all 0.3s ease;
        }

        .footer .icons a:hover {
            color: #90e0ef;
            transform: scale(1.2);
        }

        .footer .copyright {
            text-align: center;
            font-size: 0.9rem;
            margin-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding-top: 20px;
            color: #bfbfbf;
        }

        .footer .copyright a {
            color: #90e0ef;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .footer .copyright a:hover {
            color: #fff;
            text-decoration: underline;
        }

        .footer .crafted {
            font-size: 0.9rem;
            color: #bfbfbf;
        }

        .footer .crafted i {
            color: #ff4757;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .footer .row {
                text-align: center;
            }
            .footer .icons {
                margin-top: 10px;
            }
        }
    </style>
</head>

<body>

   <!-- Footer Section -->
<footer class="footer">
    <div class="container">
        <div class="row text-center text-md-start">
            <!-- Logo & Tagline -->
            <div class="col-md-4 mb-4">
                <h3 class="logo"><span style="color: #fff;">SAFE</span><span style="color: #ffc107;">SPACE</span></h3>
                <p>Empowering young minds, providing <br>support, and fostering resilience.</p>
            </div>
            <!-- Main Links -->
            <div class="col-md-2 mb-4">
                <h5>Main</h5>
                <ul class="list-unstyled links">
                    <li><a href="../root/index.php">Home</a></li>
                    <li><a href="../static/service.php">Services</a></li>
                    <li><a href="../static/contact.php">contact</a></li>
                </ul>
            </div>

            <!-- Quick Links -->
            <div class="col-md-2 mb-4">
                <h5>Quick Links</h5>
                <ul class="list-unstyled links">
                    <li><a href="../static/gethelp.php">Get Help</a></li>
                    <li><a href="../authentification/login.php">Therapists</a></li>
                    <li><a href="../static/Faq.php">FAQ</a></li>
                
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="col-md-4 mb-4">
                <h5>Contact Us</h5>
                <ul class="list-unstyled links">
                    <li><a href="https://www.google.com/maps/place/Yaounde,+Cameroon" target="_blank"><i class="fas fa-map-marker-alt"></i> Yaoundé, Cameroon</a></li>
                    <li><a href="tel:+237671319479"><i class="fas fa-phone-alt"></i> +237 671-319-479</a></li>
                    <li><a href="mailto:safespace@gmail.com"><i class="fas fa-envelope"></i> quinngwina@gmail.com</a></li>
                </ul>
                <div class="icons">
                    <a href="https://facebook.com" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    <a href="https://wa.me/+237671319479" target="_blank"><i class="fab fa-whatsapp"></i></a>
                    <a href="https://instagram.com" target="_blank"><i class="fab fa-instagram"></i></a>
                    <a href="https://www.linkedin.com" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                </div>
            </div>
        </div>
    </div>

    <!-- Copyright & Credits -->
    <div class="text-center copyright">
    <p>&copy; 2025 Safe Space. All rights reserved. | <a href="../static/privacy.php">Privacy Policy</a></p>

 
    </p>
    <p class="crafted">Handcrafted with <i class="fas fa-heart"></i> by <strong><a href="https://wa.me/671319479" target="_blank">Quinstarics</a></strong>.</p>

</div>
</footer>

<!-- Bootstrap JS -->
<script src="../assets/js/bootstrap.bundle.min.js"></script>

</body>
</html>
