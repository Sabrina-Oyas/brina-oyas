<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Brina Oyas - @yield('title')</title>
    <style>
        body, html { margin: 0; padding: 0; min-height: 100vh; font-family: 'Segoe UI', sans-serif; background-color: #f4f7f6; }
        
        .navbar { background: #333; color: white; padding: 15px 30px; display: flex; justify-content: space-between; align-items: center; }
        .navbar a { color: white; text-decoration: none; margin-left: 20px; font-weight: 500; }
        .navbar .brand { font-size: 1.5em; font-weight: bold; margin-left: 0; color: #28a745; }

        /* IMAGE DE FOND RÉTABLIE ICI */
        .auth-bg { 
            background: url('/images/unnamed.jpg') no-repeat center center fixed; 
            background-size: cover; 
        }
        
        .main-wrapper { display: flex; justify-content: center; align-items: center; min-height: 90vh; padding: 20px; }
        .glass-card { background: rgba(255, 255, 255, 0.95); padding: 35px; border-radius: 15px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); width: 100%; max-width: 450px; }
        
        .form-group { margin-bottom: 15px; }
        .form-group label { display: block; margin-bottom: 5px; font-weight: bold; color: #333; }
        .form-group input { width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 6px; box-sizing: border-box; }
        
        .btn { padding: 10px 20px; border-radius: 6px; border: none; font-weight: bold; cursor: pointer; text-decoration: none; display: inline-block; text-align: center; }
        .btn-primary { background: #28a745; color: white; }
        .btn-secondary { background: #6c757d; color: white; }
        .button-group { display: flex; flex-direction: column; gap: 10px; margin-top: 20px; }
        .hint { font-size: 0.8em; color: #28a745; mt: 5px; }
    </style>
</head>
<body class="@yield('body-class')">
    <div class="main-wrapper">
        <div class="glass-card">
            @yield('content')
        </div>
    </div>
</body>
</html>