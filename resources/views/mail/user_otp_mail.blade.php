<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Code Email</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .envelope {
            width: 400px;
            background-color: #f8f9fa; 
            padding: 20px;
            border: 1px solid #ced4da;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            position: relative; 
            margin: 0 auto; 
            margin-top: 50px; 
        }

        .envelope::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            width: 50px;
            height: 30px;
            background-color: #f8f9fa;
            border: 1px solid #ced4da;
            border-bottom: none;
            border-radius: 0 0 50% 50%;
            transform: translateX(-50%);
        }

        .envelope::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            width: 50px;
            height: 50px;
            background-color: #f8f9fa; 
            border: 1px solid #ced4da;
            border-top: none;
            border-radius: 50%;
            transform: translateX(-50%);
        }
        
        .content {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="envelope">
                    <h1 class="text-center">OTP CODE SENDING</h1>
                    <div class="content">
                        <h3>Hello:</h3>
                        <p>{{ $email }}</p>
                        <h3>Your one-time OTP Code:</h3>
                        <p>{{ $otp }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
