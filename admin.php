<?php
session_start();
require_once 'Warstwa_Prezentacji.php';

$prezentacja = new Warstwa_prezentacji();

// Sprawdź czy użytkownik jest zalogowany
if (!$prezentacja->zalogowano()) {
    header('Location: login.php');
    exit;
}

$message = '';
$messageType = '';

// Obsługa dodawania książki
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['add_book'])) {
    $tytul = $_POST['tytul'] ?? '';
    $opis = $_POST['opis'] ?? '';
    $rok = $_POST['rok'] ?? '';
    $gatunek = $_POST['gatunek'] ?? '';
    $autor = $_POST['autor'] ?? 'Henryk von Solivagant';
    $wydawnictwo = $_POST['wydawnictwo'] ?? '';
    
    $plik_okladki = null;
    if (isset($_FILES['okladka']) && $_FILES['okladka']['error'] == 0) {
        $plik_okladki = $_FILES['okladka'];
    }
    
    if ($prezentacja->dodaj_nowa_ksiazke($tytul, $opis, $rok, $gatunek, $autor, $wydawnictwo, $plik_okladki)) {
        $message = 'Książka została dodana pomyślnie!';
        $messageType = 'success';
    } else {
        $message = 'Wystąpił błąd podczas dodawania książki. Sprawdź czy wszystkie pola są poprawnie wypełnione.';
        $messageType = 'error';
    }
}
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
    <?php $prezentacja->wyswietl_pasek_nawigacji(); ?>

    <div class="form-container" style="max-width: 800px;">
        <h1 style="text-align: center; color: #ff4444; margin-bottom: 1rem;">Panel Administratora</h1>
        <p style="text-align: center; color: #ccc; margin-bottom: 2rem;">
            Zalogowany jako: <strong><?php echo htmlspecialchars($_SESSION['username'] ?? 'admin'); ?></strong>
        </p>
        
        <?php if ($message): ?>
            <?php $prezentacja->wyswietl_komunikat($message, $messageType); ?>
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
                    Plik zostanie zapisany w bazie danych jako dane binarne.
                </p>
            </div>
            
            <button type="submit" name="add_book" class="btn-primary" style="width: 100%;">
                Dodaj książkę
            </button>
        </form>
        
        <h2 style="color: #ff4444; margin: 3rem 0 1.5rem;">Lista książek w bazie</h2>
        <?php $prezentacja->wyswietl_liste_ksiazek(); ?>
    </div>

    <footer>
        <div class="container">
            <p>&copy; 2026 Biuro Ostatniej Podróży. Wszystkie prawa zastrzeżone.</p>
            <p>Projekt: Magdalena Mykieta, Magdalena Leśniewska, Izabela Protas, Tomasz Prądziński</p>
        </div>
    </footer>
</body>
</html>