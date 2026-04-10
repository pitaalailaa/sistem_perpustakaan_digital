<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Sistem Perpustakaan Digital</title>

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

        /* HEADER (LOGO + JUDUL) */
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
            background-color: #16a34a;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #15803d;
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
            <h3>Register Anggota</h3>
            <p>Buat akun anggota, lalu login memakai email dan password yang sudah didaftarkan</p>

            <form method="POST" action="/register">
                @csrf

                <input type="email" name="email" placeholder="Email" required>
                <input type="text" name="name" placeholder="Username" required>
                <input type="text" name="kelas" placeholder="Kelas (opsional)">
                <input type="text" name="no_telp" placeholder="No Telp (opsional)">
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirmation" placeholder="Konfirmasi Password" required>

                <button type="submit">Register</button>
            </form>

            <div class="link">
                Sudah punya akun? <a href="/login">Login</a>
            </div>
        </div>

    </div>

</body>

</html>
