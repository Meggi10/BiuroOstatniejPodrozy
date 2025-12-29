<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontakt - Biuro Ostatniej Podróży</title>
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
                <li><a href="kontakt.php" class="active">Kontakt</a></li>
                <li><a href="<?php echo isset($_SESSION['admin']) ? 'admin.php' : 'login.php'; ?>">
                    <?php echo isset($_SESSION['admin']) ? 'Panel Admina' : 'Logowanie'; ?>
                </a></li>
            </ul>
        </div>
    </nav>

    <section class="content-section">
        <h1>Kontakt</h1>
        
        <div class="bio-section">
            <h2>Informacje kontaktowe</h2>
            <p>
                <strong>Email wydawnictwa:</strong><br>
                kontakt@biuro-ostatniej-podrozy.pl
            </p>
            <p>
                <strong>Email literacki:</strong><br>
                henryk.vonsolivagant@literatura.pl
            </p>
            <p>
                <strong>Agencja literacka:</strong><br>
                Agencja "Mroczne Pióro"<br>
                ul. Literacka 13<br>
                00-001 Warszawa<br>
                Tel: +48 22 123 45 67
            </p>
        </div>

        <div class="bio-section">
            <h2>Media społecznościowe</h2>
            <p>
                Śledź najnowsze informacje o publikacjach, spotkaniach autorskich i projektach:
            </p>
            <p>
                <strong>Facebook:</strong> /HenrykVonSolivagantOficjalny<br>
                <strong>Instagram:</strong> @vonsolivagant<br>
                <strong>Twitter:</strong> @HvonSolivagant
            </p>
        </div>

        <div class="bio-section">
            <h2>Spotkania autorskie</h2>
            <p>
                Henryk von Solivagant sporadycznie uczestniczy w spotkaniach autorskich i 
                festiwalach literackich. Informacje o nadchodzących wydarzeniach publikowane 
                są na stronie oraz w mediach społecznościowych.
            </p>
            <p>
                Zaproszenia na spotkania autorskie, konferencje i panele dyskusyjne prosimy 
                kierować na adres agencji literackiej.
            </p>
        </div>

        <div class="bio-section">
            <h2>Dla mediów</h2>
            <p>
                Zapytania medialne, propozycje wywiadów i współpracy prosimy kierować na adres:<br>
                <strong>media@mroczne-pioro.pl</strong>
            </p>
            <p>
                Materiały prasowe, zdjęcia promocyjne i biografia autora dostępne są na życzenie.
            </p>
        </div>

        <div class="bio-section">
            <h2>Prawa autorskie i tłumaczenia</h2>
            <p>
                Zapytania dotyczące praw autorskich, tłumaczeń na języki obce oraz adaptacji 
                prosimy kierować do agencji literackiej "Mroczne Pióro".
            </p>
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