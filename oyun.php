<?php
session_start();

if (!isset($_SESSION['hedef_sayi']) || isset($_POST['yeni_oyun'])) {
    $_SESSION['hedef_sayi'] = rand(1, 100);
    $_SESSION['tahmin_sayisi'] = 0;
    $_SESSION['mesaj'] = "1 ile 100 arasında bir sayı tuttum. Hadi tahmin et!";
    $_SESSION['durum'] = "devam";
    $_SESSION['gecmis'] = [];
}


if (isset($_POST['tahmin_et']) && $_SESSION['durum'] == "devam") {
    $tahmin = (int)$_POST['sayi'];
    $_SESSION['tahmin_sayisi']++;
    $_SESSION['gecmis'][] = $tahmin;

    if ($tahmin < $_SESSION['hedef_sayi']) {
        $_SESSION['mesaj'] = "🔼 Daha BÜYÜK bir sayı söyle! ($tahmin çok küçük)";
    } elseif ($tahmin > $_SESSION['hedef_sayi']) {
        $_SESSION['mesaj'] = "🔽 Daha KÜÇÜK bir sayı söyle! ($tahmin çok büyük)";
    } else {
        $_SESSION['mesaj'] = "🎉 TEBRİKLER! Sayıyı buldun: " . $_SESSION['hedef_sayi'];
        $_SESSION['durum'] = "kazan";
    }
}
?>

<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Sayı Tahmin Oyunu</title>
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f7f9fc; color: #333; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .oyun-kutusu { background: white; padding: 40px; border-radius: 12px; text-align: center; width: 350px; border: 1px solid #e1e4e8; box-shadow: 0 4px 12px rgba(0,0,0,0.05); }
        h1 { margin-top: 0; color: #333; font-size: 24px; font-weight: 600; margin-bottom: 25px; }
        .mesaj { font-size: 16px; margin-bottom: 25px; color: #555; background: #f1f3f5; padding: 15px; border-radius: 8px; }
        input[type="number"] { padding: 12px; width: 60%; border-radius: 6px; border: 1px solid #d1d5db; font-size: 16px; text-align: center; outline: none; transition: border-color 0.2s; }
        input[type="number"]:focus { border-color: #3b82f6; }
        button { padding: 12px 20px; font-size: 16px; border: none; border-radius: 6px; cursor: pointer; transition: background 0.2s; font-weight: 500; }
        .btn-tahmin { background: #3b82f6; color: white; margin-left: 8px; }
        .btn-tahmin:hover { background: #2563eb; }
        .btn-reset { background: white; color: #6b7280; border: 1px solid #d1d5db; margin-top: 25px; width: 100%; }
        .btn-reset:hover { background: #f9fafb; color: #374151; }
        .gecmis { margin-top: 25px; font-size: 13px; color: #9ca3af; }
        .gecmis span { display: inline-block; background: #e5e7eb; color: #4b5563; padding: 4px 8px; margin: 3px; border-radius: 4px; font-weight: 500; }
    </style>
</head>
<body>

    <div class="oyun-kutusu">
        <h1>Sayı Tahmin</h1>
        
        <div class="mesaj">
            <?php echo $_SESSION['mesaj']; ?>
        </div>

        <?php if ($_SESSION['durum'] == "devam"): ?>
            <form method="POST">
                <input type="number" name="sayi" placeholder="Tahminin?" required autofocus min="1" max="100">
                <button type="submit" name="tahmin_et" class="btn-tahmin">Dene</button>
            </form>
        <?php else: ?>
            <div style="font-size: 50px;">🏆</div>
            <p>Toplam <b><?php echo $_SESSION['tahmin_sayisi']; ?></b> denemede buldun!</p>
        <?php endif; ?>

        <!-- GEÇMİŞ TAHMİNLER -->
        <?php if (!empty($_SESSION['gecmis'])): ?>
            <div class="gecmis">
                Denemelerin: <br>
                <?php foreach ($_SESSION['gecmis'] as $g): ?>
                    <span><?php echo $g; ?></span>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <form method="POST">
            <button type="submit" name="yeni_oyun" class="btn-reset">🔄 Yeni Oyun Başlat</button>
        </form>
    </div>

</body>
</html>
