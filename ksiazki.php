<?php
session_start();
require_once 'Warstwa_Prezentacji.php';

$prezentacja = new Warstwa_prezentacji();
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
    <?php $prezentacja->wyswietl_pasek_nawigacji(); ?>

    <section class="books-section">
        <div class="container">
            <h1 style="text-align: center; color: #ff4444; margin-bottom: 2rem;">Katalog Książek</h1>
            
            <?php $prezentacja->wyszukaj_ksiazke(); ?>

            <?php 
            if (isset($_GET['search']) && !empty($_GET['search'])) {
                $prezentacja->wyswietl_liste_ksiazek_po_nazwie($_GET['search']);
            } else {
                $prezentacja->wyswietl_liste_ksiazek();
            }
            ?>
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
        
        if (searchInput) {
            searchInput.addEventListener('input', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(() => {
                    this.form.submit();
                }, 500);
            });
        }
    </script>
</body>
</html>