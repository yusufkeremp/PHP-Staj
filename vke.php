<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vücut Kitle Endeksi (VKE) Hesaplayıcı</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f0f2f5;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            width: 350px;
            text-align: center;
        }
        h2 { color: #2c3e50; margin-bottom: 20px; }
        .input-group { margin-bottom: 15px; text-align: left; }
        label { display: block; margin-bottom: 5px; color: #7f8c8d; font-size: 14px; }
        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-sizing: border-box;
            font-size: 16px;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s;
            margin-top: 10px;
        }
        button:hover { background-color: #2980b9; }
        .sonuc-kutusu {
            margin-top: 25px;
            padding: 15px;
            border-radius: 8px;
            display: none; 
        }
        .bmi-deger { font-size: 24px; font-weight: bold; display: block; }
        .bmi-durum { font-size: 18px; margin-top: 5px; display: block; }
    </style>
</head>
<body>

<div class="container">
    <h2>VKE Hesaplayıcı</h2>
    
    <form method="POST">
        <div class="input-group">
            <label>Kilonuz (kg):</label>
            <input type="number" name="kilo" placeholder="Örn: 75" required step="0.1">
        </div>
        
        <div class="input-group">
            <label>Boyunuz (cm):</label>
            <input type="number" name="boy" placeholder="Örn: 180" required>
        </div>
        
        <button type="submit" name="hesapla">Hesapla</button>
    </form>

    <?php
    if (isset($_POST['hesapla'])) {
        $kilo = $_POST['kilo'];
        $boy_cm = $_POST['boy'];
        $boy_m = $boy_cm / 100;
        
        if ($boy_m > 0) {
            $vke = $kilo / ($boy_m * $boy_m);
            $vke = round($vke, 1);

            $durum = "";
            $renk = "";
            $arkaplan = "";

            if ($vke < 18.5) {
                $durum = "Zayıf";
                $renk = "#2980b9";
                $arkaplan = "#eaf2f8";
            } elseif ($vke < 24.9) {
                $durum = "Normal Kilolu";
                $renk = "#27ae60";
                $arkaplan = "#e9f7ef";
            } elseif ($vke < 29.9) {
                $durum = "Fazla Kilolu";
                $renk = "#f39c12";
                $arkaplan = "#fef5e7";
            } elseif ($vke < 34.9) {
                $durum = "1. Derece Obezite";
                $renk = "#e67e22";
                $arkaplan = "#fef1e5";
            } else {
                $durum = "2. Derece Obezite";
                $renk = "#e74c3c";
                $arkaplan = "#fdedec";
            }

            echo "
            <style>.sonuc-kutusu { display: block !important; background-color: $arkaplan; border: 1px solid $renk; color: $renk; }</style>
            <div class='sonuc-kutusu'>
                <span class='bmi-deger'>VKE: $vke</span>
                <span class='bmi-durum'>$durum</span>
            </div>";
        }
    }
    ?>
</div>

</body>
</html>
