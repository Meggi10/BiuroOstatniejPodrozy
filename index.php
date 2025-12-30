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
    <title>Biuro Ostatniej Podróży - Henryk von Solivagant</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php $prezentacja->wyswietl_pasek_nawigacji(); ?>

    <header class="hero">
        <div class="hero-content">
            <h1>Henryk von Solivagant</h1>
            <p class="subtitle">Mistrz grozy i niepokoju</p>
            <p class="description">
                Witaj w mrocznym świecie Henryka von Solivaganta – autora, który zaprowadzi Cię 
                w najbardziej niepokojące zakamarki ludzkiej psychiki. Jego książki to nie tylko 
                opowieści grozy, ale głębokie studia nad naturą strachu i tajemnicy.
            </p>
            <a href="ksiazki.php" class="btn-primary">Odkryj Książki</a>
        </div>
    </header>

    <section class="features">
        <div class="container">
            <div class="feature-grid">
                <div class="feature-card">
                    <div class="feature-icon">📚</div>
                    <h3>Katalog Książek</h3>
                    <p>Przeglądaj pełen katalog dzieł autora z możliwością wyszukiwania</p>
                    <a href="ksiazki.php" class="btn-secondary">Zobacz książki</a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">✍️</div>
                    <h3>O Autorze</h3>
                    <p>Poznaj biografię i inspiracje twórcze Henryka von Solivaganta</p>
                    <a href="autor.php" class="btn-secondary">Czytaj więcej</a>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🎙️</div>
                    <h3>Wywiady</h3>
                    <p>Transkrypcje rozmów z autorem o jego procesie twórczym</p>
                    <a href="wywiady.php" class="btn-secondary">Przeczytaj</a>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <p>&copy; 2026 Biuro Ostatniej Podróży. Wszystkie prawa zastrzeżone.</p>
            <p>Projekt: Magdalena Mykieta, Magdalena Leśniewska, Izabela Protas, Tomasz Prądziński</p>
        </div>
    </footer>
</body>
</html>