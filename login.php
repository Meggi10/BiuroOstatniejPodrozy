<?php
session_start();
require_once 'Warstwa_Prezentacji.php';

$prezentacja = new Warstwa_prezentacji();

// Jeśli już zalogowany, przekieruj do panelu admina
if ($prezentacja->zalogowano()) {
    header('Location: admin.php');
    exit;
}

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $warstwa_biznesowa = new Warstwa_biznesowa();
    
    if ($warstwa_biznesowa->wb_admin_login($username, $password)) {
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Nieprawidłowa nazwa użytkownika lub hasło';
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logowanie - Biuro Ostatniej Podróży</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php $prezentacja->wyswietl_pasek_nawigacji(); ?>

    <div class="form-container">
        <h1 style="text-align: center; color: #ff4444; margin-bottom: 2rem;">Panel Administratora</h1>
        
        <?php if ($error): ?>
            <?php $prezentacja->wyswietl_komunikat($error, 'error'); ?>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Nazwa użytkownika</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>
            
            <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn-primary" style="width: 100%;">Zaloguj się</button>
        </form>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2026 Biuro Ostatniej Podróży. Wszystkie prawa zastrzeżone.</p>
            <p>Projekt: Magdalena Mykieta, Magdalena Leśniewska, Izabela Protas, Tomasz Prądziński</p>
        </div>
    </footer>
</body>
</html>