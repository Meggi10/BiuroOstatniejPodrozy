<?php
session_start();
require_once 'Database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    $db = new Database();
    
    if ($db->verifyAdmin($username, $password)) {
        $_SESSION['admin'] = $username;
        header('Location: admin.php');
        exit;
    } else {
        $error = 'Nieprawidłowa nazwa użytkownika lub hasło';
    }
}

// Jeśli już zalogowany, przekieruj do panelu admina
if (isset($_SESSION['admin'])) {
    header('Location: admin.php');
    exit;
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
    <nav class="navbar">
        <div class="container">
            <div class="logo">Biuro Ostatniej Podróży</div>
            <ul class="nav-links">
                <li><a href="index.php">Strona Główna</a></li>
                <li><a href="ksiazki.php">Książki</a></li>
                <li><a href="autor.php">O Autorze</a></li>
                <li><a href="wywiady.php">Wywiady</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
                <li><a href="login.php" class="active">Logowanie</a></li>
            </ul>
        </div>
    </nav>

    <div class="form-container">
        <h1 style="text-align: center; color: #ff4444; margin-bottom: 2rem;">Panel Administratora</h1>
        
        <?php if ($error): ?>
            <div class="message error"><?php echo htmlspecialchars($error); ?></div>
        <?php endif; ?>
        
        <form method="POST" action="login.php">
            <div class="form-group">
                <label for="username">Nazwa użytkownika</label>
                <input type="text" id="username" name="username" required>
            </div>
            
            <div class="form-group">
                <label for="password">Hasło</label>
                <input type="password" id="password" name="password" required>
            </div>
            
            <button type="submit" class="btn-primary" style="width: 100%;">Zaloguj się</button>
        </form>
        
        <!--<p style="text-align: center; margin-top: 2rem; color: #999; font-size: 0.9rem;">
            Domyślne dane logowania:<br>
            Login: <strong>admin</strong><br>
            Hasło: <strong>admin123</strong>
        </p>-->
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2026 Biuro Ostatniej Podróży. Wszystkie prawa zastrzeżone.</p>
            <p>Projekt: Magdalena Mykieta, Magdalena Leśniewska, Izabela Protas, Tomasz Prądziński</p>
        </div>
    </footer>
</body>
</html>