<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Safe Space</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <style>
    body {
      font-family: 'Arial', sans-serif;
    }

    /* Sticky Navbar */
    .navbar {
      background: linear-gradient(90deg, #007bff, #0056b3);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      padding: 1.8rem 1rem;
      position: sticky;
      width: 100%;
      top: 0;
      z-index: 1000;
    }

    /* Enlarged Logo */
    .navbar-brand {
      font-size: 3.5rem; 
      font-weight: bold;
      transition: transform 0.3s ease, color 0.3s ease;
      color: #000;
    }

    .navbar-brand:hover {
      transform: scale(1.05);
      color: rgb(255, 238, 7);
    }

    /* Enlarged Navbar Text */
    .nav-link {
      font-size: 2.3rem; 
      font-weight: bold;
      padding: 1rem 1.5rem; /* More spacing */
      transition: color 0.3s ease, transform 0.3s ease;
      color: #fff;
    }

    .nav-link:hover {
      color: #ffc107;
      transform: scale(1.05);
    }


    .login-container {
      margin-left: 1.5rem;
    }

    .dropdown button {
      background-color: #ffc107; 
      color: black;
      padding: 12px 20px;
      border: none;
      font-size: 18px;
      border-radius: 5px;
      display: flex;
      align-items: center;
      gap: 0.5rem;
    }

    .dropdown-menu {
      background-color: orange;
      min-width: 180px;
      box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.2);
      border-radius: 5px;
    }

    .dropdown-menu a {
      color: black;
      padding: 12px 18px;
      text-decoration: none;
    }

    .dropdown-menu a:hover {
      background-color: #f1f1f1;
    }

    .dropdown:hover .dropdown-menu {
      display: block;
    }
  </style>
</head>
<body>

  <header>
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container">
        <!-- Enlarged Logo -->
        <a class="navbar-brand" href="../root/index.php">
          SAFE<span class="text-warning">SPACE</span>
        </a>

        <!-- Hamburger Menu -->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarNav"
          aria-controls="navbarNav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto me-3">
            <li class="nav-item">
              <a class="nav-link" href="../root/index.php">
                <i class="fas fa-home"></i> Home
              </a>
            </li>
        
            <li class="nav-item">
              <a class="nav-link" href="../static/service.php">
                <i class="fas fa-concierge-bell"></i> Services
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../static/contact.php">
                <i class="fas fa-envelope"></i> Contact
              </a>
            </li>

            <!-- Shifted Login Button -->
            <div class="login-container text-center">
              <div class="dropdown">
                <button class="btn btn-warning dropdown-toggle" type="button" id="loginDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                  <i class="fas fa-sign-in-alt"></i> Login
                </button>
                <ul class="dropdown-menu" aria-labelledby="loginDropdown">
                  <li>
                    <a class="dropdown-item" href="../authentification/login.php">
                      <i class="fas fa-user"></i> Login as User
                    </a>
                  </li>
                  <li>
                    <a class="dropdown-item" href="../logincode.php">
                      <i class="fas fa-user-shield"></i> Login as Admin
                    </a>
                  </li>
                </ul>
              </div>
            </div>

          </ul>
        </div>
      </div>
    </nav>
  </header>

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      var navbarToggler = document.querySelector(".navbar-toggler");
      var navbarCollapse = document.querySelector("#navbarNav");

      // Toggle navbar on button click
      navbarToggler.addEventListener("click", function () {
        navbarToggler.classList.toggle("collapsed");
      });

      // Close menu when clicking outside
      document.addEventListener("click", function (event) {
        if (!navbarCollapse.contains(event.target) && !navbarToggler.contains(event.target)) {
          navbarCollapse.classList.remove("show");
        }
      });
    });
  </script>
</body>
</html>
