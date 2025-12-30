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
    <title>Wywiady - Biuro Ostatniej Podróży</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php $prezentacja->wyswietl_pasek_nawigacji(); ?>

    <section class="content-section">
        <h1>Wywiady z Henrykiem von Solivagantem</h1>
        <?php $prezentacja->wyswietl_liste_wywiadow(); ?>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2026 Biuro Ostatniej Podróży. Wszystkie prawa zastrzeżone.</p>
            <p>Projekt: Magdalena Mykieta, Magdalena Leśniewska, Izabela Protas, Tomasz Prądziński</p>
        </div>
    </footer>

    <script>
        function toggleInterview(id) {
            const content = document.getElementById('interview-' + id);
            content.classList.toggle('active');
        }
    </script>
</body>
</html>