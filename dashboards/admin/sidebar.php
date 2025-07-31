<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .sidebar {
            min-height: 100vh;
            width: 250px;
            background: linear-gradient(180deg, #3a7bd5, #00d2ff);
            transition: all 0.3s;
        }
        .sidebar-collapsed {
            width: 70px;
        }
        .logo-container {
            padding: 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
        }
        .logo-text {
            color: white;
            font-weight: bold;
            font-size: 22px;
            text-decoration: none;
        }
        .logo-text .highlight {
            color: #f1c40f;
        }
        .nav-link {
            color: rgba(255, 255, 255, 0.9);
            padding: 10px 15px;
            display: flex;
            align-items: center;
            transition: all 0.3s;
        }
        .nav-link:hover, .nav-link.active {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
        }
        .nav-link i {
            font-size: 18px;
            margin-right: 10px;
            width: 24px;
            text-align: center;
        }
        .sidebar-collapsed .nav-link span {
            display: none;
        }
        .sidebar-toggle {
            position: absolute;
            top: 10px;
            right: -45px;
            background-color: #3a7bd5;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 8px 12px;
            transition: all 0.3s;
            z-index: 100;
        }
        .sidebar-toggle:hover {
            background-color: #00d2ff;
        }
        .content-wrapper {
            margin-left: 250px;
            transition: all 0.3s;
        }
        .content-expanded {
            margin-left: 70px;
        }
        .user-profile {
            padding: 15px;
            display: flex;
            align-items: center;
            color: white;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            margin-top: auto;
        }
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.2);
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 10px;
        }
        .sidebar-collapsed .user-info {
            display: none;
        }
        .notification-badge {
            position: absolute;
            right: 15px;
            background-color: #f1c40f;
            color: #333;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 10px;
            font-weight: bold;
        }
        @media (max-width: 992px) {
            .sidebar {
                margin-left: -250px;
                position: fixed;
                z-index: 999;
            }
            .sidebar.show {
                margin-left: 0;
            }
            .content-wrapper, .content-expanded {
                margin-left: 0;
            }
            .sidebar-toggle {
                left: 10px;
                top: 10px;
                position: fixed;
            }
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar" id="sidebar">
            <div class="logo-container">
                <a href="../../root/index.php" class="logo-text">
                    SAFE<span class="highlight">SPACE</span>
                </a>
            </div>
            <ul class="nav flex-column mt-3">
                <li class="nav-item"><a href="admin.php" class="nav-link active"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
                <li class="nav-item"><a href="manage_users.php" class="nav-link"><i class="fas fa-users"></i><span>Manage Users</span></a></li>
                <li class="nav-item"><a href="manage_professional.php" class="nav-link"><i class="fas fa-user-md"></i><span>Manage Professionals</span></a></li>
                <li class="nav-item"><a href="contact_messages.php" class="nav-link position-relative">
                    <i class="fas fa-envelope"></i><span>Contact Messages</span>
                   
                </a></li>
                <li class="nav-item"><a href="view_session.php" class="nav-link"><i class="fas fa-calendar-check"></i><span>View Sessions</span></a></li>
                <li class="nav-item"><a href="payment.php" class="nav-link"><i class="fas fa-credit-card"></i><span>Payments</span></a></li>
                <li class="nav-item mt-3"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i><span>Logout</span></a></li>
            </ul>
            <div class="user-profile mt-auto">
                <div class="user-avatar"><i class="fas fa-user"></i></div>
                <div class="user-info"><div class="fw-bold">Admin User</div><small>Administrator</small></div>
            </div>
        </div>
        
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        document.getElementById('sidebar-toggle').addEventListener('click', function() {
            const sidebar = document.getElementById('sidebar');
            const content = document.getElementById('content');
            if (window.innerWidth > 992) {
                sidebar.classList.toggle('sidebar-collapsed');
                content.classList.toggle('content-expanded');
            } else {
                sidebar.classList.toggle('show');
            }
        });
        window.addEventListener('resize', function() {
            document.getElementById('sidebar').classList.remove('sidebar-collapsed');
            document.getElementById('content').classList.remove('content-expanded');
        });
    </script>
</body>
</html>