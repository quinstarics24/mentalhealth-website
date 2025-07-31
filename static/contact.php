


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Safe Space - Contact</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <style>
        :root {
            --primary-color:rgb(59, 101, 226);
            --secondary-color: #f8f9fc;
            --dark-color: #5a5c69;
            --light-color: #f8f9fa;
        }
        
        body {
            font-family: 'Nunito', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background-color: var(--secondary-color);
        }
        
        .contact-card {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin: 3rem 0;
        }
        
        .contact-info {
            background: linear-gradient(to right, rgb(82, 147, 226), rgb(236, 228, 223));;
            color: white;
            height: 100%;
            padding: 2.5rem;
        }
        
        .contact-form {
            background: white;
            padding: 2.5rem;
        }
        
        .contact-form h2 {
            color: var(--dark-color);
            margin-bottom: 1rem;
            font-weight: 700;
        }
        
        .contact-info h3 {
            font-weight: 700;
            margin-bottom: 1.5rem;
        }
        
        .contact-info p {
            margin-bottom: 1.2rem;
        }
        
        .social-icons a {
            color: white;
            margin-right: 1rem;
            font-size: 1.2rem;
            transition: opacity 0.3s;
        }
        
        .social-icons a:hover {
            opacity: 0.8;
        }
        
        .submit-btn {
            background-color: var(--primary-color);
            color: white;
            border: none;
            padding: 0.6rem 1.5rem;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s;
        }
        
        .submit-btn:hover {
            background-color: #375ad3;
            box-shadow: 0 0.15rem 0.5rem 0 rgba(58, 59, 69, 0.2);
        }
        
        .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.25rem rgba(78, 115, 223, 0.25);
        }
        
        .contact-info-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .contact-info-item i {
            margin-right: 15px;
            font-size: 1.2rem;
        }
    </style>
</head>
<body>
<?php
session_start();
if (isset($_SESSION['success'])) {
    echo "<div class='alert alert-success text-center'>" . $_SESSION['success'] . "</div>";
    unset($_SESSION['success']);
}
if (isset($_SESSION['error'])) {
    echo "<div class='alert alert-danger text-center'>" . $_SESSION['error'] . "</div>";
    unset($_SESSION['error']);
}
?>



    <!-- Header Section -->
    <div id="header-container"></div>

    <!-- Contact Section -->
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="contact-card">
                    <div class="row g-0">
                        <!-- Contact Form -->
                        <div class="col-md-8">
                            <div class="contact-form">
                                <h2>Get In Touch</h2>
                                <p class="text-muted mb-4">Don't be shy. Give us a call or drop us a line. Let's make some magic together!</p>
                                
                                <form action="../static/submit-contact.php" method="POST">
                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <input type="text" class="form-control" name="first_name" placeholder="First Name" required>
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" class="form-control" name="last_name" placeholder="Last Name" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row mb-3">
                                        <div class="col-md-6 mb-3 mb-md-0">
                                            <input type="tel" class="form-control" name="phone" placeholder="Phone">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                                        </div>
                                    </div>
                                    
                                    <div class="mb-4">
                                        <textarea class="form-control" name="message" rows="5" placeholder="How can we help?" required></textarea>
                                    </div>
                                    
                                    <button class="submit-btn" type="submit">
                                        Submit <i class="fas fa-paper-plane ms-2"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        
                        <!-- Contact Info -->
                        <div class="col-md-4">
                            <div class="contact-info d-flex flex-column">
                                <h3>Contact Info</h3>
                                
                                <div class="contact-info-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>(+237) 671-319-479</span>
                                </div>
                                
                                <div class="contact-info-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>info@safespace.com</span>
                                </div>
                                
                                <div class="mt-auto">
                                    <hr class="my-4 opacity-25">
                                    <h5 class="mb-3">Connect With Us</h5>
                                    <div class="social-icons">
                                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                                        <a href="#"><i class="fab fa-instagram"></i></a>
                                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Placeholder -->
    <div id="footer-placeholder"></div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    
    <!-- Load Header and Footer -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Load header
            fetch("../static/header.php")
                .then(response => response.text())
                .then(data => {
                    document.getElementById("header-container").innerHTML = data;
                })
                .catch(error => console.error('Error loading header:', error));
            
            // Load footer
            fetch('../static/footer.php')
                .then(response => response.text())
                .then(data => document.getElementById('footer-placeholder').innerHTML = data)
                .catch(err => console.error('Error loading footer:', err));
        });
    </script>
</body>
</html>