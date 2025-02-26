<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Thank You for Subscribing</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <style>
        body {
            background: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Poppins', sans-serif;
            text-align: center;
        }

        .card {
            background: white;
            border-radius: 15px;
            padding: 30px;
            max-width: 400px;
            width: 100%;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border: none;
        }

        .icon-container {
            font-size: 60px;
            color: #007bff;
            margin-bottom: 15px;
        }

        h2 {
            color: #333;
            font-size: 24px;
            font-weight: bold;
        }

        p {
            color: #555;
            font-size: 16px;
        }

        .btn-custom {
            background: #007bff;
            border: none;
            padding: 12px 20px;
            font-size: 18px;
            border-radius: 30px;
            transition: 0.3s;
            color: white;
            font-weight: bold;
        }

        .btn-custom:hover {
            background: #0056b3;
            transform: scale(1.05);
        }

        .footer-text {
            margin-top: 20px;
            font-size: 14px;
            color: #777;
        }
    </style>
</head>
<body>

    <div class="card">
        <div class="icon-container">
            <i class="fas fa-envelope-open-text"></i>
        </div>
        <h2>Thank You for Subscribing!</h2>
        <p>You will receive the latest updates, giveaways, and special offers directly in your inbox.</p>
        <a href="http://127.0.0.1:8000/home" class="btn btn-custom mt-3">
            <i class="fas fa-home"></i> Visit Our Website
        </a>
        <p class="footer-text">info@FundusImageAnalysis.com</p>
    </div>

</body>
</html>
