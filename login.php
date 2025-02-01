<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - SIM Persediaan</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/font-awesome@4.7.0/css/font-awesome.min.css">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

      .container {
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 40px;
            max-width: 400px;
        }

      .form-group label {
            font-weight: bold;
        }

      .form-control {
            border-radius: 5px;
            border: 1px solid #ced4da;
            transition: border-color 0.3s ease;
        }

      .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }

      .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
            border-radius: 5px;
            transition: background-color 0.3s ease, transform 0.2s ease;
        }

      .btn-primary:hover {
            background-color: #0069d9;
            transform: translateY(-2px);
        }

      .fa {
            margin-right: 5px;
        }

      .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
            display: none; /* Sembunyikan overlay saat awal */
        }

      .loading-spinner {
            border: 8px solid #f3f3f3;
            border-radius: 50%;
            border-top: 8px solid #3498db;
            width: 40px;
            height: 40px;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>
</head>
<body>

    <div class="loading-overlay">
        <div class="loading-spinner"></div>
    </div>

    <div class="container">
        <h2 class="text-center mb-4"><i class="fa fa-lock"></i> Login</h2>
        <form id="loginForm" action="" method="post">
            <div class="form-group mb-3">
                <label for="username">Username:</label>
                <input type="text" class="form-control" id="username" name="username" required>
            </div>
            <div class="form-group mb-3">
                <label for="password">Password:</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in"></i> Login</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.1/dist/jquery.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#loginForm').submit(function(event) {
                event.preventDefault(); // Mencegah submit form secara default

                // Tampilkan loading overlay
                $('.loading-overlay').show();

                $.ajax({
                    url: 'login_process.php', // Ganti dengan file yang menangani proses login
                    type: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        // Sembunyikan loading overlay
                        $('.loading-overlay').hide();

                        if (response == 'success') {
                            // Login berhasil, arahkan ke halaman index
                            window.location.href = 'index.php';
                        } else {
                            // Login gagal, tampilkan pesan error
                            alert(response);
                        }
                    },
                    error: function() {
                        // Sembunyikan loading overlay
                        $('.loading-overlay').hide();

                        // Tampilkan pesan error jika terjadi kesalahan
                        alert('Terjadi kesalahan saat login.');
                    }
                });
            });
        });
    </script>
</body>
</html>