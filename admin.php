<?php
session_start();
require_once 'Database.php';

if (!isset($_SESSION['admin'])) {
    header('Location: login.php');
    exit;
}

$message = '';
$messageType = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_book'])) {
    $tytul = $_POST['tytul'] ?? '';
    $opis = $_POST['opis'] ?? '';
    $rok = $_POST['rok'] ?? '';
    $gatunek = $_POST['gatunek'] ?? '';
    $autor = $_POST['autor'] ?? 'Henryk von Solivagant';
    $wydawnictwo = $_POST['wydawnictwo'] ?? '';
    
    $okladka = 'placeholder.jpg';
    if (isset($_FILES['okladka']) && $_FILES['okladka']['error'] == 0) {
        $uploadDir = 'uploads/';
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileName = time() . '_' . basename($_FILES['okladka']['name']);
        $uploadFile = $uploadDir . $fileName;
        
        if (move_uploaded_file($_FILES['okladka']['tmp_name'], $uploadFile)) {
            $okladka = $uploadFile;
        }
    }
    
    if ($tytul && $opis && $rok && $gatunek && $wydawnictwo) {
        $db = new Database();
        $data = [
            ':tytul' => $tytul,
            ':opis' => $opis,
            ':rok' => $rok,
            ':gatunek' => $gatunek,
            ':autor' => $autor,
            ':wydawnictwo' => $wydawnictwo,
            ':okladka' => $okladka
        ];
        
        if ($db->addBook($data)) {
            $message = 'Książka została dodana pomyślnie!';
            $messageType = 'success';
        } else {
            $message = 'Wystąpił błąd podczas dodawania książki.';
            $messageType = 'error';
        }
    } else {
        $message = 'Proszę wypełnić wszystkie wymagane pola.';
        $messageType = 'error';
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: index.php');
    exit;
}

$db = new Database();
$books = $db->getAllBooks();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel Administratora - Biuro Ostatniej Podróży</title>
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
                <li><a href="admin.php" class="active">Panel Admina</a></li>
                <li><a href="?logout=1">Wyloguj</a></li>
            </ul>
        </div>
    </nav>

    <div class="form-container" style="max-width: 800px;">
        <h1 style="text-align: center; color: #ff4444; margin-bottom: 1rem;">Panel Administratora</h1>
        <p style="text-align: center; color: #ccc; margin-bottom: 2rem;">
            Zalogowany jako: <strong><?php echo htmlspecialchars($_SESSION['admin']); ?></strong>
        </p>
        
        <?php if ($message): ?>
            <div class="message <?php echo $messageType; ?>"><?php echo htmlspecialchars($message); ?></div>
        <?php endif; ?>
        
        <h2 style="color: #ff4444; margin-bottom: 1.5rem;">Dodaj nową książkę</h2>
        
        <form method="POST" action="admin.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="tytul">Tytuł *</label>
                <input type="text" id="tytul" name="tytul" required>
            </div>
            
            <div class="form-group">
                <label for="opis">Opis / Streszczenie *</label>
                <textarea id="opis" name="opis" required></textarea>
            </div>
            
            <div class="form-group">
                <label for="rok">Rok wydania *</label>
                <input type="number" id="rok" name="rok" min="1900" max="2100" required>
            </div>
            
            <div class="form-group">
                <label for="gatunek">Gatunek literacki *</label>
                <input type="text" id="gatunek" name="gatunek" placeholder="np. Horror psychologiczny" required>
            </div>
            
            <div class="form-group">
                <label for="autor">Autor</label>
                <input type="text" id="autor" name="autor" value="Henryk von Solivagant">
            </div>
            
            <div class="form-group">
                <label for="wydawnictwo">Wydawnictwo *</label>
                <input type="text" id="wydawnictwo" name="wydawnictwo" required>
            </div>
            
            <div class="form-group">
                <label for="okladka">Zdjęcie okładki</label>
                <input type="file" id="okladka" name="okladka" accept="image/*">
                <p style="color: #999; font-size: 0.85rem; margin-top: 0.5rem;">
                    Jeśli nie zostanie wybrane zdjęcie, użyta zostanie domyślna okładka.
                </p>
            </div>
            
            <button type="submit" name="add_book" class="btn-primary" style="width: 100%;">
                Dodaj książkę
            </button>
        </form>
        
        <h2 style="color: #ff4444; margin: 3rem 0 1.5rem;">Lista książek (<?php echo count($books); ?>)</h2>
        <div class="books-grid">
            <?php foreach ($books as $book): ?>
                <div class="book-card">
                    <img src="<?php echo htmlspecialchars($book['okladka']); ?>" 
                         alt="<?php echo htmlspecialchars($book['tytul']); ?>" 
                         class="book-cover"
                         onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22250%22 height=%22350%22%3E%3Crect fill=%22%231a1a1a%22 width=%22250%22 height=%22350%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2216%22 fill=%22%23ff4444%22 text-anchor=%22middle%22 dy=%22.3em%22%3E<?php echo htmlspecialchars($book['tytul']); ?>%3C/text%3E%3C/svg%3E'">
                    <div class="book-info">
                        <h3><?php echo htmlspecialchars($book['tytul']); ?></h3>
                        <p class="year"><?php echo htmlspecialchars($book['rok']); ?></p>
                        <span class="genre"><?php echo htmlspecialchars($book['gatunek']); ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2026 Biuro Ostatniej Podróży. Wszystkie prawa zastrzeżone.</p>
            <p>Projekt: Magdalena Mykieta, Magdalena Leśniewska, Izabela Protas, Tomasz Prądziński</p>
        </div>
    </footer>
</body>
</html>