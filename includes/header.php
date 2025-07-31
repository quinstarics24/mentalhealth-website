<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Therapy Session - SafeSpace</title>
    <meta name="description" content="Book a therapy session with our experienced mental health professionals">
    <link rel="icon" href="/favicon.ico" sizes="any">

    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&family=Open+Sans:wght@400;600&display=swap" rel="stylesheet">

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

        .navbar {
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
        }

        .navbar-brand {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.8rem;
            letter-spacing: -0.025em;
        }

        .navbar .navbar-nav .nav-link {
            color: var(--dark-text);
            font-weight: 500;
            font-size: 1.1rem;
        }

        .navbar .navbar-nav .nav-link:hover {
            color: var(--primary);
        }

        .navbar .navbar-toggler-icon {
            background-color: var(--primary);
        }

        .navbar .btn-logout {
            background-color: var(--primary);
            color: white;
            border-radius: var(--btn-border-radius);
            padding: 8px 20px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .navbar .btn-logout:hover {
            background-color: var(--primary-hover);
            color: white;
            transition: background-color 0.3s ease;
        }

        .navbar .btn-logout .fas {
            margin-right: 8px;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand" href="../root/index.php">
                SAFE<span class="text-warning">SPACE</span>
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="user_notification.php">
                            <i class="fas fa-bell"></i> Notifications
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="btn btn-logout" href="../root/index.php">
                            <i class="fas fa-sign-out-alt me-2"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-cu5jzU8XEr9oynlo73fBz4zPTHtG9H5wtiOt9ESs8o6nAWIpu+cxHbttb6Hr6ozMl" crossorigin="anonymous"></script>
</body>
</html>
