<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'KiboAuto - Automotive Solutions')</title>
    <style>
        /* Reset styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        
        /* Email container */
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        
        /* Header section */
        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 30px 20px;
            text-align: center;
            position: relative;
        }
        
        .header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('{{ asset("images/nbc.png") }}') center/contain no-repeat;
            opacity: 0.1;
        }
        
        .logo {
            position: relative;
            z-index: 2;
        }
        
        .logo img {
            max-width: 120px;
            height: auto;
        }
        
        .logo h1 {
            color: #ffffff;
            font-size: 28px;
            font-weight: bold;
            margin: 10px 0 5px 0;
            text-shadow: 0 2px 4px rgba(0,0,0,0.3);
        }
        
        .logo p {
            color: #e8f4fd;
            font-size: 14px;
            margin: 0;
        }
        
        /* Promotional banner */
        .promo-banner {
            background: linear-gradient(45deg, #ff6b6b, #feca57);
            padding: 15px;
            text-align: center;
            color: white;
            font-weight: bold;
            font-size: 16px;
            position: relative;
            overflow: hidden;
        }
        
        .promo-banner::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: repeating-linear-gradient(
                45deg,
                transparent,
                transparent 10px,
                rgba(255,255,255,0.1) 10px,
                rgba(255,255,255,0.1) 20px
            );
            animation: shimmer 3s infinite;
        }
        
        @keyframes shimmer {
            0% { transform: translateX(-100%) translateY(-100%) rotate(45deg); }
            100% { transform: translateX(100%) translateY(100%) rotate(45deg); }
        }
        
        .promo-banner span {
            position: relative;
            z-index: 2;
        }
        
        /* Content area */
        .content {
            padding: 40px 30px;
            background-color: #ffffff;
        }
        
        .content h2 {
            color: #2c3e50;
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }
        
        .content h3 {
            color: #34495e;
            font-size: 18px;
            margin: 25px 0 15px 0;
            border-left: 4px solid #667eea;
            padding-left: 15px;
        }
        
        .content p {
            margin-bottom: 15px;
            color: #555;
        }
        
        /* Info boxes */
        .info-box {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            padding: 20px;
            margin: 20px 0;
            border-left: 4px solid #667eea;
        }
        
        .info-box.success {
            border-left-color: #28a745;
            background: #d4edda;
            color: #155724;
        }
        
        .info-box.warning {
            border-left-color: #ffc107;
            background: #fff3cd;
            color: #856404;
        }
        
        .info-box.danger {
            border-left-color: #dc3545;
            background: #f8d7da;
            color: #721c24;
        }
        
        /* Buttons */
        .btn {
            display: inline-block;
            padding: 12px 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: #ffffff;
            text-decoration: none;
            border-radius: 25px;
            font-weight: bold;
            text-align: center;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }
        
        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        }
        
        .btn-success {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
        }
        
        .btn-warning {
            background: linear-gradient(135deg, #ffc107 0%, #fd7e14 100%);
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }
        
        .btn-center {
            text-align: center;
            margin: 30px 0;
        }
        
        /* Tables */
        .table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .table th {
            background: #667eea;
            color: white;
            padding: 15px;
            text-align: left;
            font-weight: bold;
        }
        
        .table td {
            padding: 15px;
            border-bottom: 1px solid #e9ecef;
        }
        
        .table tr:hover {
            background-color: #f8f9fa;
        }
        
        /* Footer */
        .footer {
            background: #2c3e50;
            color: #ecf0f1;
            padding: 30px;
            text-align: center;
        }
        
        .footer h4 {
            color: #ffffff;
            margin-bottom: 15px;
        }
        
        .footer p {
            margin-bottom: 10px;
            font-size: 14px;
        }
        
        .footer a {
            color: #3498db;
            text-decoration: none;
        }
        
        .footer a:hover {
            color: #5dade2;
        }
        
        .social-links {
            margin: 20px 0;
        }
        
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            padding: 8px;
            background: #34495e;
            border-radius: 50%;
            color: white;
            text-decoration: none;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: #667eea;
            transform: translateY(-2px);
        }
        
        /* Responsive design */
        @media only screen and (max-width: 600px) {
            .email-container {
                margin: 0;
                border-radius: 0;
            }
            
            .header {
                padding: 20px 15px;
            }
            
            .content {
                padding: 30px 20px;
            }
            
            .footer {
                padding: 20px 15px;
            }
            
            .logo h1 {
                font-size: 24px;
            }
            
            .content h2 {
                font-size: 20px;
            }
        }
        
        /* Utility classes */
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .mt-20 { margin-top: 20px; }
        .mb-20 { margin-bottom: 20px; }
        .p-20 { padding: 20px; }
        .bold { font-weight: bold; }
        .highlight { background: #fff3cd; padding: 2px 4px; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <img src="{{ asset('logo.png') }}" alt="KiboAuto Logo" style="max-width: 80px; height: auto;">
                <h1>KiboAuto</h1>
                <p>Your Trusted Automotive Partner</p>
            </div>
        </div>
        
        <!-- Promotional Banner -->
        @hasSection('promo-banner')
        <div class="promo-banner">
            <span>@yield('promo-banner')</span>
        </div>
        @endif
        
        <!-- Main Content -->
        <div class="content">
            @yield('content')
        </div>
        
        <!-- Footer -->
        <div class="footer">
            <h4>KiboAuto - Automotive Solutions</h4>
            <p>Your one-stop destination for automotive services, spare parts, and financing solutions.</p>
            
          
            
            <p><strong>Contact Information:</strong></p>
            <p> Email: info@kiboauto.com |  Phone: +255 XXX XXX XXX</p>
            <p> Address: Your Business Address, Tanzania</p>
            
            <p style="margin-top: 20px; font-size: 12px; color: #95a5a6;">
                This email was sent from KiboAuto. If you have any questions, please contact our support team.
                <br>© {{ date('Y') }} KiboAuto. All rights reserved.
            </p>
        </div>
    </div>
</body>
</html>
