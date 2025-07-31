<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SafeSpace Admin Dashboard</title>
  <!-- Fonts and Icons -->
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <style>
    body {
  font-family: 'Inter', sans-serif;
  background-color: #f8f9fa;
  margin: 0;
  padding: 0;
  display: flex;
  flex-direction: column;
}

/* Sidebar */
.sidenav {
  height: 100vh;
  position: fixed;
  width: 250px;
  background-color: #ffffff;
  border-right: 1px solid #e9ecef;
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  transition: transform 0.3s ease-in-out;
}

.sidenav .nav-link {
  display: flex;
  align-items: center;
  font-size: 16px;
  padding: 15px 20px;
  color: #333;
  transition: all 0.3s ease;
  border-radius: 8px;
  margin: 5px 15px;
}

.sidenav .nav-link.active {
  background-color: rgb(133, 174, 228);
  color: #fff !important;
  font-weight: 500;
}

.sidenav .nav-link:hover {
  background-color: #e9ecef;
  color: rgb(92, 135, 184) !important;
}

.sidenav .nav-link i {
  font-size: 18px;
  margin-right: 10px;
}

/* Main Content */
.main-content {
  margin-left: 260px;
  padding: 30px;
  transition: margin-left 0.3s ease-in-out;
}

.main-content h1 {
  font-size: 28px;
  font-weight: bold;
  margin-bottom: 20px;
}

/* Cards */
.card {
  box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  border-radius: 8px;
  padding: 20px;
  margin-bottom: 20px;
}

.card h5 {
  font-weight: 600;
  font-size: 18px;
}

.btn-custom {
  font-size: 14px;
  font-weight: 500;
}


/* Responsive Design */
@media (max-width: 1024px) {
  .main-content {
    margin-left: 200px;
    padding: 20px;
  }

  .sidenav {
    width: 200px;
  }
}

@media (max-width: 768px) {
  .sidenav {
    width: 100%;
    height: auto;
    position: relative;
  }

  .sidenav .nav-link {
    justify-content: center;
  }

  .main-content {
    margin-left: 0;
    padding: 15px;
  }
}

@media (max-width: 480px) {
  .sidenav {
    display: none; /* Hide sidebar on small screens */
  }

  .main-content {
    margin-left: 0;
    padding: 10px;
  }

  .notification-card {
    padding: 15px;
  }
}

/* Toggle Sidebar for Small Screens */
.menu-toggle {
  display: none;
  font-size: 24px;
  position: absolute;
  top: 15px;
  left: 15px;
  cursor: pointer;
}

@media (max-width: 768px) {
  .menu-toggle {
    display: block;
  }

  .sidenav {
    transform: translateX(-100%);
  }

  .sidenav.open {
    transform: translateX(0);
  }
}

  </style>
</head>

<body>
  <!-- Sidebar -->
  <div class="sidenav">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a href="dashboard.php" class="nav-link active">
          <i class="fas fa-home"></i>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a href="user.php" class="nav-link">
          <i class="fas fa-users"></i>
          Manage Users
        </a>
      </li>
      
      <li class="nav-item">
        <a href="donation.php" class="nav-link">
          <i class="fas fa-donate"></i>
          Donations
        </a>
      </li>
      <li class="nav-item">
    <a href="payment.php" class="nav-link">
        <i class="fas fa-credit-card"></i>  
        Payments
    </a>
</li>

      <li class="nav-item">
        <a href="resources.php" class="nav-link">
          <i class="fas fa-book-open"></i>
          Resources
        </a>
      </li>
      
      <li class="nav-item">
        <a href="../admin/logout.php" class="nav-link">
          <i class="fas fa-sign-out-alt"></i>
          Logout
        </a>
      </li>
    </ul>
  </div>
