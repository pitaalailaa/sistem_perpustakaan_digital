<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Sistem Perpustakaan Digital</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(225deg, #0f172a 25%, #1e3a8a 50%, #0f172a 75%);
        }

        /* CONTAINER */
        .container {
            text-align: center;
        }

        /* HEADER */
        .header-login {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 15px;
            margin-bottom: 20px;
        }

        .header-login img {
            width: 60px;
        }

        .judul {
            text-align: left;
        }

        .judul h2 {
            margin: 0;
            color: white;
            font-size: 20px;
        }

        .judul span {
            color: #3b82f6;
            font-weight: bold;
        }

        /* CARD */
        .card {
            background-color: #617da334;
            padding: 40px;
            border-radius: 15px;
            width: 350px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.5);
        }

        /* TEXT */
        .card h3 {
            color: white;
            margin-bottom: 5px;
        }

        .card p {
            color: #cbd5e1;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* INPUT */
        input {
            width: 100%;
            padding: 12px;
            margin: 10px 0;
            border-radius: 8px;
            border: none;
            background-color: #082148d0;
            color: white;
            box-sizing: border-box;
        }

        /* BUTTON */
        button {
            width: 100%;
            padding: 12px;
            margin-top: 15px;
            border-radius: 8px;
            border: none;
            background-color: #2563eb;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #1d4ed8;
        }

        /* LINK */
        .link {
            margin-top: 15px;
            color: white;
            font-size: 14px;
        }

        .link a {
            color: #3b82f6;
            text-decoration: none;
        }

        /* ERROR */
        .error {
            color: #f87171;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <div class="container">

        <!-- HEADER -->
        <div class="header-login">
            <img src="{{ asset('images/logoperpus.png') }}" alt="Logo">

            <div class="judul">
                <h2>Sistem</h2>
                <span>Perpustakaan Digital</span>
            </div>
        </div>

        <!-- CARD -->
        <div class="card">
            <h3>Login</h3>
            <p>Masuk ke akun Anda untuk mengakses Sistem Perpustakaan Digital</p>

            @if (session('error'))
                <div class="error">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <input type="email" name="email" placeholder="Email" required>
                <input type="password" name="password" placeholder="Password" required>

                <button type="submit">Login</button>
            </form>

            <div class="link">
                Belum punya akun? <a href="/register">Register</a>
            </div>
        </div>

        @if (session('success'))
            <div style="color:lightgreen; margin-top:10px;">
                {{ session('success') }}
            </div>
        @endif

    </div>

</body>

</html>
