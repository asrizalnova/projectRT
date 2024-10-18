<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Kartu Keluarga (KK)</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f0f4f8;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            width: 400px;
        }

        h2 {
            text-align: center;
            color: #2980B9;
            margin-bottom: 20px;
            font-size: 24px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
            color: #333;
            font-size: 14px;
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: #2980B9;
        }

        .btn-submit {
            background-color: #2980B9;
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            width: 100%;
        }

        .btn-submit:hover {
            background-color: #3498DB;
        }

        .btn-submit:active {
            background-color: #1C6EA4;
        }

        .message {
            text-align: center;
            margin-top: 15px;
            color: green;
        }

        .error-message {
            text-align: center;
            margin-top: 15px;
            color: red;
        }
    </style>
</head>

<body>

    <div class="container">
        <h2>Buat Kartu Keluarga (KK)</h2>

        <!-- Tampilkan pesan sukses atau error -->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="message"><?= session()->getFlashdata('success') ?></div>
        <?php elseif (session()->getFlashdata('error')) : ?>
            <div class="error-message"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>

        <form action="<?= site_url('kk/store') ?>" method="post">
            <div class="form-group">
                <label for="noKK">Nomor Kartu Keluarga:</label>
                <input type="text" id="noKK" name="noKK" placeholder="Masukkan nomor KK" required>
            </div>
            <div class="form-group">
                <label for="namaKK">Nama Kepala Keluarga:</label>
                <input type="text" id="namaKK" name="namaKK" placeholder="Masukkan nama kepala keluarga" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <select name="status" id="status">
                    <option value="menetap" <?= old('status') == 'menetap' ? 'selected' : '' ?>>Menetap</option>
                    <option value="pindah" <?= old('status') == 'pindah' ? 'selected' : '' ?>>Pindah</option>
                </select><br><br>
            </div>
            <button type="submit" class="btn-submit">Simpan</button>
        </form>
    </div>

</body>

</html>