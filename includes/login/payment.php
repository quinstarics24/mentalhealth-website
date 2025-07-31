<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - Safe Space</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background-color: #f0f2f5;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }

        .container {
            max-width: 800px;
            margin-top: 50px;
        }

        .payment-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            margin-bottom: 20px;
        }

        .btn-primary {
            width: 100%;
            padding: 12px;
            font-size: 1.1rem;
        }
    </style>
</head>
<body>

    <div class="container">
        <h2 class="text-center">Pay for Services</h2>
        <div class="payment-form">
            <form action="process-mtn-payment.php" method="POST">
                <div class="form-group">
                    <label for="service">Select Service</label>
                    <select class="form-control" id="service" name="service" required>
                        <option value="video_consultation">On-Demand Video Consultation (10,000 FCFA)</option>
                        <option value="helpline">counseling session(1500 FCFA)</option>
                        <option value="subscription">Monthly Subscription (20,000 FCFA)</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter your full name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Enter your phone number" required>
                </div>

                <button type="submit" class="btn btn-primary">Pay via MTN Mobile Money</button>
            </form>
        </div>
    </div>

</body>
</html>
