<?php
session_start();
require_once 'Database.php';

$db = new Database();
$books = $db->getAllBooks();
$searchQuery = '';

if (isset($_GET['search']) && !empty($_GET['search'])) {
    $searchQuery = $_GET['search'];
    $books = $db->searchBooks($searchQuery);
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Książki - Biuro Ostatniej Podróży</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">Biuro Ostatniej Podróży</div>
            <ul class="nav-links">
                <li><a href="index.php">Strona Główna</a></li>
                <li><a href="ksiazki.php" class="active">Książki</a></li>
                <li><a href="autor.php">O Autorze</a></li>
                <li><a href="wywiady.php">Wywiady</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
                <li><a href="<?php echo isset($_SESSION['admin']) ? 'admin.php' : 'login.php'; ?>">
                    <?php echo isset($_SESSION['admin']) ? 'Panel Admina' : 'Logowanie'; ?>
                </a></li>
            </ul>
        </div>
    </nav>

    <section class="books-section">
        <div class="container">
            <h1 style="text-align: center; color: #ff4444; margin-bottom: 2rem;">Katalog Książek</h1>
            
            <div class="search-box">
                <form method="GET" action="ksiazki.php">
                    <input type="text" 
                           name="search" 
                           placeholder="Wyszukaj książkę po tytule, opisie lub gatunku..." 
                           value="<?php echo htmlspecialchars($searchQuery); ?>">
                </form>
            </div>

            <?php if (!empty($searchQuery)): ?>
                <p style="text-align: center; color: #ccc; margin-bottom: 2rem;">
                    Znaleziono <?php echo count($books); ?> wyników dla: "<?php echo htmlspecialchars($searchQuery); ?>"
                    <a href="ksiazki.php" style="color: #ff4444; margin-left: 1rem;">Wyczyść wyszukiwanie</a>
                </p>
            <?php endif; ?>

            <div class="books-grid">
                <?php foreach ($books as $book): ?>
                    <div class="book-card">
                        <img src="<?php echo htmlspecialchars($book['okladka']); ?>" 
                             alt="<?php echo htmlspecialchars($book['tytul']); ?>" 
                             class="book-cover"
                             onerror="this.src='data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22250%22 height=%22350%22%3E%3Crect fill=%22%231a1a1a%22 width=%22250%22 height=%22350%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2220%22 fill=%22%23ff4444%22 text-anchor=%22middle%22 dy=%22.3em%22%3E<?php echo htmlspecialchars($book['tytul']); ?>%3C/text%3E%3C/svg%3E'">
                        <div class="book-info">
                            <h3><?php echo htmlspecialchars($book['tytul']); ?></h3>
                            <p class="year"><?php echo htmlspecialchars($book['rok']); ?> | <?php echo htmlspecialchars($book['wydawnictwo']); ?></p>
                            <span class="genre"><?php echo htmlspecialchars($book['gatunek']); ?></span>
                            <p class="description"><?php echo htmlspecialchars($book['opis']); ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if (empty($books)): ?>
                <p style="text-align: center; color: #ccc; margin-top: 3rem;">
                    Nie znaleziono książek pasujących do zapytania.
                </p>
            <?php endif; ?>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2026 Biuro Ostatniej Podróży. Wszystkie prawa zastrzeżone.</p>
            <p>Projekt: Magdalena Mykieta, Magdalena Leśniewska, Izabela Protas, Tomasz Prądziński</p>
        </div>
    </footer>

    <script>
        let searchTimeout;
        const searchInput = document.querySelector('input[name="search"]');
        
        searchInput.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => {
                this.form.submit();
            }, 500);
        });
    </script>
</body>
</html>