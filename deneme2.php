<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <title>Güvenlik</title>
    <style>
        body { font-family: 'Segoe UI', sans-serif; background: #e9ecef; padding: 20px; max-width: 1000px; margin: 0 auto; }
        h1 { text-align: center; color: #343a40; margin-bottom: 40px; }
        .grid-container { display: grid; grid-template-columns: repeat(auto-fit, minmax(400px, 1fr)); gap: 20px; }
        .card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 6px rgba(0,0,0,0.05); border-top: 5px solid #2ecc71; }
        .card.danger { border-top-color: #e74c3c; }
        .card.warning { border-top-color: #f1c40f; }
        .card.info { border-top-color: #3498db; }
        h3 { margin-top: 0; color: #2d3436; border-bottom: 1px solid #eee; padding-bottom: 10px; }
        .task { background: #fff3cd; color: #856404; padding: 10px; border-radius: 5px; font-size: 0.9em; margin-bottom: 15px; border-left: 4px solid #ffeeba; }
        .result { margin-top: 10px; padding: 10px; background: #2d3436; color: #00cec9; font-family: monospace; border-radius: 5px; font-size: 0.9em; }
        input, select, button { padding: 8px; border: 1px solid #ddd; border-radius: 4px; margin-top: 5px; }
        button { cursor: pointer; background: #eee; }
        button:hover { background: #ddd; }
        code { background: rgba(0,0,0,0.1); padding: 2px 4px; border-radius: 3px; font-family: monospace; color: #d63031; }
        .badge { display: inline-block; padding: 3px 6px; border-radius: 4px; color: white; font-size: 0.8em; margin-left: 5px; }
    </style>
</head>
<body>

    <h1>Web Güvenlik</h1>

    <div class="grid-container">

        <div class="card warning">
            <h3>1. HTML Engelini Aşmak</h3>
            <form method="POST">
                <input type="text" name="metin1" required minlength="10" placeholder="En az 10 karakter..." style="width: 70%;">
                <button type="submit" name="btn1">Gönder</button>
            </form>
            <?php if(isset($_POST['btn1'])) echo "<div class='result'>PHP Veriyi Aldı: '" . $_POST['metin1'] . "'</div>"; ?>
        </div>

        <div class="card warning">
            <h3>2. Kilitli Butonu Açmak</h3>
            <form method="POST">
                <button type="submit" name="btn2" disabled style="width:100%; color: #999;">⛔ Sistemi Sıfırla (Kilitli)</button>
            </form>
            <?php if(isset($_POST['btn2'])) echo "<div class='result'>⚠️ SİSTEM SIFIRLANDI! (Yetkisiz Erişim)</div>"; ?>
        </div>

        <div class="card danger">
            <h3>3. Yetki Yükseltme</h3>
            <div class="task"><code>'user'</code><code>'admin'</code></div>
            <form method="POST">
                <select name="role">
                    <option value="user">Standart Kullanıcı</option>
                    <option value="guest">Misafir</option>
                </select>
                <button type="submit" name="btn4">Giriş Yap</button>
            </form>
            <?php 
            if(isset($_POST['btn4'])) {
                if($_POST['role'] == 'admin') echo "<div class='result' style='color:#e74c3c'>🚨 TEBRİKLER ADMİN OLDUNUZ!</div>";
                else echo "<div class='result'>Standart giriş yapıldı. Yetki: " . $_POST['role'] . "</div>";
            }
            ?>
        </div>

        <div class="card info">
            <h3>4. IDOR (Veri Sızıntısı)</h3>
            <div class="task"><code>id = 1</code></div>
            <?php
            $notlar = [1 => "ADMİN ŞİFRESİ: 123456", 10 => "Öğrenci Notu: Bugün hava güzel."];
            $id = isset($_GET['lab_id']) ? $_GET['lab_id'] : 10;
            if(isset($notlar[$id])) echo "<div class='result'>NOT (ID $id): " . $notlar[$id] . "</div>";
            else echo "<div class='result'>Not bulunamadı.</div>";
            ?>
            <a href="?lab_id=10" style="font-size:12px;">Reset (Kendi ID'ne Dön)</a>
        </div>

        <div class="card info">
            <h3>5. Cookie (Çerez) Değiştirme</h3>
            <div class="task"><code>yetki</code><code>admin</code></div>
            <?php
            if(!isset($_COOKIE['yetki'])) {
                setcookie("yetki", "user", time() + 3600);
                $_COOKIE['yetki'] = "user";
            }
            
            if($_COOKIE['yetki'] == "admin") {
                echo "<div class='result' style='color:#fdcb6e'>👑 YÖNETİCİ PANELİNE HOŞGELDİNİZ!</div>";
            } else {
                echo "<div class='result'>Kısıtlı Alan. Mevcut Cookie: " . $_COOKIE['yetki'] . "</div>";
            }
            ?>
        </div>

        <div class="card danger">
            <h3>6. SQL Injection (Giriş Atlatma)</h3>
            <div class="task"><code>admin' OR '1'='1</code></div>
            <form method="POST">
                <input type="text" name="sqli_user" placeholder="Kullanıcı Adı"><br>
                <input type="password" name="sqli_pass" placeholder="Şifre"><br>
                <button type="submit" name="btn8" style="width:100%">Admin Girişi</button>
            </form>
            <?php 
            if(isset($_POST['btn8'])) {
                $u = $_POST['sqli_user'];
                
                if(strpos($u, "' OR '1'='1") !== false || ($u == "admin" && $_POST['sqli_pass'] == "1234")) {
                    echo "<div class='result' style='color:#e74c3c'>🔓 SİSTEM HACKLENDİ! Giriş Başarılı.</div>";
                } else {
                    echo "<div class='result'>❌ Hatalı kullanıcı adı veya şifre.</div>";
                }
            }
            ?>
        </div>

    </div>

</body>
</html>
