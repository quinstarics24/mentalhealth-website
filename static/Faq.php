<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ - Safe Space</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <style>
        /* Body Styling */
        body {
            background-color: #f8f9fa;
            font-family: 'Arial', sans-serif;
            color: #333;
        }

        /* FAQ Section Styling */
        .faq {
            margin: 40px auto;
            max-width: 800px;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .faq h2 {
            font-size: 2rem;
            text-align: center;
            color: #007bff;
            margin-bottom: 20px;
        }

        /* FAQ List Styling */
        .faq ul {
            padding-left: 0;
            list-style-type: none;
        }

        .faq li {
            margin-bottom: 15px;
        }

        .question {
            font-weight: bold;
            font-size: 1.2rem;
            cursor: pointer;
            color: #007bff;
            background-color: #f1f1f1;
            padding: 15px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .question:hover {
            background-color: #007bff;
            color: white;
        }

        .answer {
            display: none;
            padding: 15px;
            margin-top: 10px;
            font-size: 1rem;
            color: #555;
            background-color: #f9f9f9;
            border-left: 4px solid #007bff;
            border-radius: 5px;
            transition: max-height 0.3s ease-out, padding 0.3s ease-out;
        }

        .answer.show {
            display: block;
            max-height: 300px;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        /* Small Text Styling */
        small {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #007bff;
            font-size: 1.1rem;
        }
    </style>
</head>

<body>
     <!-- Placeholder for Header -->
 <div id="header-container"></div>

    <div class="faq">
        <h2>Frequently Asked Questions</h2>
        <ul>
            <li>
                <div class="question" onclick="toggleAnswer(0)">What is Safe Space?</div>
                <div class="answer">Safe Space is an online platform designed to support young people facing mental health challenges. We provide access to resources, counseling, and a supportive community, all focused on mental wellness and personal growth.</div>
            </li>
            <li>
                <div class="question" onclick="toggleAnswer(1)">Is Safe Space confidential?</div>
                <div class="answer">Yes, Safe Space prioritizes confidentiality. Our platform uses end-to-end encryption, and trained moderators ensure user anonymity.</div>
            </li>
            <li>
                <div class="question" onclick="toggleAnswer(2)">How can I join the Safe Space community?</div>
                <div class="answer">Joining Safe Space is easy. Simply sign up on our website with your email to create an account, and you’ll gain access to a range of resources, support groups, and wellness tools to help you navigate your mental health journey.</div>
            </li>
            <li>
                <div class="question" onclick="toggleAnswer(3)">Can I remain anonymous?</div>
                <div class="answer">Yes, you can choose to remain anonymous. However, sharing your identity can facilitate more personalized support.</div>
            </li>
            <li>
                <div class="question" onclick="toggleAnswer(4)">Where can I access Safe Space services?</div>
                <div class="answer">Safe Space is accessible on any device with internet access, including smartphones, tablets, and computers (via web browsers), as well as public libraries and community centers with internet access.</div>
            </li>
            <li>
                <div class="question" onclick="toggleAnswer(5)">How do I cancel my Safe Space membership?</div>
                <div class="answer">To cancel your Safe Space membership: Go to your account settings on our website. Select "Cancel Membership" under your profile options and follow the on-screen instructions to confirm your cancellation.</div>
            </li>
            <li>
                <div class="question" onclick="toggleAnswer(6)">What types of resources are available on Safe Space?</div>
                <div class="answer">Safe Space offers a variety of mental health and wellness resources, including self-help guides, therapeutic articles, licensed counselors, support groups, and resources specifically tailored for young adults aged 15-35.</div>
            </li>
            <li>
                <div class="question" onclick="toggleAnswer(7)">Is Safe Space suitable for young users?</div>
                <div class="answer">Safe Space is designed with young users in mind. We offer a secure and supportive environment where teens and young adults can access mental health resources. Our parental controls allow guardians to manage access and ensure content is age-appropriate.</div>
            </li>
        </ul>

        <small>Ready to prioritize your mental health? Join the Safe Space community.</small>
       
    </div>

    <script>
        function toggleAnswer(index) {
            const answers = document.querySelectorAll('.answer');
            answers[index].classList.toggle('show');
        }
    </script>
    <script src="../assets/js/loadheader.js"></script>
   
     <script>
        document.addEventListener("DOMContentLoaded", function () {
            const headerContainer = document.getElementById("header-container");
    
            // Load header content from header.html
            fetch("header.php")
                .then(response => response.text())
                .then(data => {
                    headerContainer.innerHTML = data;
                })
                .catch(error => console.error('Error loading header:', error));
        });
    </script>

    <div id="footer-placeholder"></div>

    <script> 
        // Fetch and insert footer HTML
        fetch('footer.php')
            .then(response => response.text())
            .then(data => document.getElementById('footer-placeholder').innerHTML = data)
            .catch(err => console.log('Error loading footer:', err));
        
     </script>


<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
