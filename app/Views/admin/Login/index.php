<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Admin</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .login-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 300px;
        }

        .login-container h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }

        .btn-login {
            background-color: #2980B9;
            color: #ffffff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }

        .btn-login:hover {
            background-color: #3498DB;
        }

        .message {
            margin-bottom: 20px;
            color: red;
        }

        .success {
            margin-bottom: 20px;
            color: green;
        }
    </style>
</head>

<body>
    <div class="login-container">
        <h1>Selamat Datang</h1>

        <!-- Menampilkan pesan kesalahan khusus untuk username -->
        <?php if (session()->getFlashdata('errUsername')) : ?>
            <div class="message"><?= session()->getFlashdata('errUsername') ?></div>
        <?php endif; ?>

        <!-- Menampilkan pesan kesalahan khusus untuk password -->
        <?php if (session()->getFlashdata('errPassword')) : ?>
            <div class="message"><?= session()->getFlashdata('errPassword') ?></div>
        <?php endif; ?>

        <!-- Menampilkan pesan sukses -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="success"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <form action="<?= site_url('login/process') ?>" method="post">
            <div class="form-group">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </div>
            <div class="form-group">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </div>
            <button type="submit" class="btn-login">Login</button>
        </form>
    </div