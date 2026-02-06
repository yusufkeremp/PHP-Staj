<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Günlük Kalori İhtiyacı Hesaplayıcı</title>
    <style>
        body {
            font-family: 'Inter', -apple-system, sans-serif;
            background-color: #f4f7f6;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            padding: 20px;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
            width: 100%;
            max-width: 400px;
        }
        h2 { color: #2d3436; text-align: center; margin-bottom: 25px; }
        .form-group { margin-bottom: 15px; }
        label { display: block; margin-bottom: 8px; font-weight: 500; color: #636e72; }
        input, select {
            width: 100%;
            padding: 12px;
            border: 1px solid #dfe6e9;
            border-radius: 8px;
            box-sizing: border-box;
            background: #fafafa;
        }
        .gender-group { display: flex; gap: 10px; margin-bottom: 15px; }
        .gender-option { flex: 1; text-align: center; }
        .gender-option input { display: none; }
        .gender-option label {
            padding: 10px;
            border: 1px solid #dfe6e9;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }
        .gender-option input:checked + label {
            background-color: #00b894;
            color: white;
            border-color: #00b894;
        }
        button {
            width: 100%;
            padding: 14px;
            background-color: #00b894;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 10px;
        }
        button:hover { background-color: #009475; }
        .sonuc {
            margin-top: 25px;
            background: #f0fff4;
            border: 1px solid #c6f6d5;
            padding: 20px;
            border-radius: 10px;
            text-align: center;
        }
        .kalori-deger { font-size: 28px; font-weight: bold; color: #2d3436; }
        .kalori-etiket { color: #00b894; font-size: 14px; text-transform: uppercase; letter-spacing: 1px; }
    </style>
</head>
<body>

<div class="container">
    <h2>Kalori Hesapla</h2>
    <form method="POST">
        <div class="form-group">
            <label>Cinsiyet</label>
            <div class="gender-group">
                <div class="gender-option">
                    <input type="radio" name="cinsiyet" id="erkek" value="erkek" checked>
                    <label for="erkek">Erkek</label>
                </div>
                <div class="gender-option">
                    <input type="radio" name="cinsiyet" id="kadin" value="kadin">
                    <label for="kadin">Kadın</label>
                </div>
            </div>
        </div>

        <div class="form-group">
            <label>Yaş</label>
            <input type="number" name="yas" placeholder="Örn: 25" required>
        </div>

        <div class="form-group">
            <label>Kilo (kg)</label>
            <input type="number" name="kilo" placeholder="Örn: 70" required step="0.1">
        </div>

        <div class="form-group">
            <label>Boy (cm)</label>
            <input type="number" name="boy" placeholder="Örn: 175" required>
        </div>

        <div class="form-group">
            <label>Hareket Seviyesi</label>
            <select name="aktivite">
                <option value="1.2">Hareketsiz (Egzersiz yok)</option>
                <option value="1.375">Hafif Hareketli (Haftada 1-3 gün)</option>
                <option value="1.55">Orta Hareketli (Haftada 3-5 gün)</option>
                <option value="1.725">Çok Hareketli (Haftada 6-7 gün)</option>
                <option value="1.9">Ekstra Hareketli (Ağır iş/spor)</option>
            </select>
        </div>

        <button type="submit" name="hesapla">Hesapla</button>
    </form>

    <?php
    if (isset($_POST['hesapla'])) {
        $cinsiyet = $_POST['cinsiyet'];
        $yas = $_POST['yas'];
        $kilo = $_POST['kilo'];
        $boy = $_POST['boy'];
        $aktivite = $_POST['aktivite'];

        // BMR (Bazal Metabolizma Hızı) Hesaplama - Harris-Benedict Formülü
        if ($cinsiyet == "erkek") {
            $bmr = 88.362 + (13.397 * $kilo) + (4.799 * $boy) - (5.677 * $yas);
        } else {
            $bmr = 447.593 + (9.247 * $kilo) + (3.098 * $boy) - (4.330 * $yas);
        }

        // Günlük toplam harcanan enerji (TDEE)
        $günlük_kalori = $bmr * $aktivite;
        $günlük_kalori = round($günlük_kalori);

        echo "
        <div class='sonuc'>
            <div class='kalori-etiket'>Günlük İhtiyaç</div>
            <div class='kalori-deger'>$günlük_kalori kcal</div>
            <p style='color: #636e72; font-size: 13px; margin-top: 10px;'>
                Kilonuzu korumak için almanız gereken günlük yaklaşık kalori miktarıdır.
            </p>
        </div>";
    }
    ?>
</div>

</body>
</html>
