<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Loading Screen</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <style>
        /* Màn hình loading với logo - Căn giữa hoàn hảo */
        #loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(15px);
            display: none;
            z-index: 9999;
            overflow: hidden;
        }
        
        #loading-overlay.show {
            display: flex !important;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        .loading-content {
            text-align: center;
            color: #333;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }
        
        .loading-logo {
            width: 120px;
            height: 120px;
            margin-bottom: 25px;
            border-radius: 50%;
            box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            animation: logoFloat 3s ease-in-out infinite;
            border: 4px solid #f8f9fa;
            object-fit: cover;
            display: inline-block;
        }
        
        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 3px solid #e3e3e3;
            border-top: 3px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 20px auto;
        }
        
        .loading-text {
            font-size: 16px;
            font-weight: 600;
            margin-top: 15px;
            color: #6c757d;
            animation: textPulse 2s ease-in-out infinite;
            white-space: nowrap;
        }
        
        .loading-progress {
            width: 200px;
            height: 4px;
            background: #e9ecef;
            border-radius: 2px;
            margin: 20px auto 10px;
            overflow: hidden;
        }
        
        .loading-progress-bar {
            width: 0%;
            height: 100%;
            background: linear-gradient(90deg, #007bff, #0056b3);
            border-radius: 2px;
            animation: progressBar 2s ease-in-out infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        @keyframes logoFloat {
            0%, 100% { 
                transform: translateY(0px) scale(1);
                box-shadow: 0 15px 40px rgba(0,0,0,0.15);
            }
            50% { 
                transform: translateY(-10px) scale(1.05);
                box-shadow: 0 25px 50px rgba(0,0,0,0.2);
            }
        }
        
        @keyframes textPulse {
            0%, 100% { opacity: 0.7; }
            50% { opacity: 1; }
        }
        
        @keyframes progressBar {
            0% { width: 0%; }
            50% { width: 70%; }
            100% { width: 100%; }
        }
        
        /* Test page styles */
        body {
            font-family: Arial, sans-serif;
            padding: 50px;
            background: #f8f9fa;
        }
        
        .test-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .btn {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 10px;
            font-size: 16px;
        }
        
        .btn:hover {
            background: #0056b3;
        }
    </style>
</head>
<body>
    <!-- Màn hình loading -->
    <div id="loading-overlay">
        <div class="loading-content">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" class="loading-logo">
            <div class="loading-spinner"></div>
            <div class="loading-progress">
                <div class="loading-progress-bar"></div>
            </div>
            <div class="loading-text">Đang tải...</div>
        </div>
    </div>

    <div class="test-container">
        <h1>Test Màn Hình Loading</h1>
        <p>Click các nút bên dưới để test màn hình loading:</p>
        
        <button class="btn" onclick="showTestLoading()">Hiển thị Loading</button>
        <button class="btn" onclick="hideTestLoading()">Ẩn Loading</button>
        <button class="btn" onclick="testAutoHide()">Test Auto Hide (3s)</button>
        
        <h3>Thông tin:</h3>
        <ul>
            <li>Loading sử dụng <code>display: table</code> và <code>vertical-align: middle</code></li>
            <li>Logo có animation float lên xuống</li>
            <li>Spinner xoay liên tục</li>
            <li>Thanh tiến trình có animation</li>
            <li>Text có hiệu ứng pulse</li>
        </ul>
    </div>

    <script>
        function showTestLoading() {
            $('#loading-overlay').addClass('show').fadeIn(300);
        }
        
        function hideTestLoading() {
            $('#loading-overlay').removeClass('show').fadeOut(300);
        }
        
        function testAutoHide() {
            showTestLoading();
            setTimeout(function() {
                hideTestLoading();
            }, 3000);
        }
    </script>
</body>
</html>
