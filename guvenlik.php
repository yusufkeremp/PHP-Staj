<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>GET Methodu</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #f8f9fa; padding: 20px; }
        .uyari { background: #fff3cd; border: 1px solid #ffeeba; padding: 15px; border-radius: 8px; margin-bottom: 20px; color: #856404; }
        .grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 15px; }
        .kart { background: white; padding: 15px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); border: 1px solid #ddd; }
        .kart h4 { margin: 0 0 10px 0; color: #007bff; }
        .pagination { margin-top: 30px; text-align: center; }
        .pagination a { padding: 8px 16px; background: #007bff; color: white; text-decoration: none; border-radius: 4px; margin: 0 5px; }
        .pagination a:hover { background: #0056b3; }
        code { background: #e9ecef; padding: 2px 5px; border-radius: 4px; color: #e83e8c; }
    </style>
</head>
<body>

    <?php
    $tum_gonderiler = [];
    for ($i = 1; $i <= 1000; $i++) {
        $tum_gonderiler[] = [
            "id" => $i,
            "baslik" => "Gönderi İçeriği #$i",
            "detay" => "Bu gönderi GET methodu testi içindir."
        ];
    }

    $sayfa = isset($_GET['sayfa']) ? $_GET['sayfa'] : 1;
    $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;

    $baslangic = ($sayfa - 1) * $limit;
    $gosterilecekler = array_slice($tum_gonderiler, $baslangic, $limit);

    echo "<h3>Şu an gösterilen: <code>$limit</code> adet gönderi. (Sayfa: $sayfa)</h3>";
    ?>

    <div class="grid">
        <?php foreach ($gosterilecekler as $post): ?>
            <div class="kart">
                <h4><?php echo $post['baslik']; ?></h4>
                <p><?php echo $post['detay']; ?></p>
                <small>ID: <?php echo $post['id']; ?></small>
            </div>
        <?php endforeach; ?>
    </div>

    <div class="pagination">
        <?php 
        $toplam_sayfa = ceil(count($tum_gonderiler) / $limit);
        for ($s = 1; $s <= min($toplam_sayfa, 10); $s++): ?>
            <a href="?sayfa=<?php echo $s; ?>&limit=<?php echo $limit; ?>"><?php echo $s; ?></a>
        <?php endfor; ?>
    </div>

</body>
</html>
