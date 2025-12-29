<?php
session_start();
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>O Autorze - Biuro Ostatniej Podróży</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar">
        <div class="container">
            <div class="logo">Biuro Ostatniej Podróży</div>
            <ul class="nav-links">
                <li><a href="index.php">Strona Główna</a></li>
                <li><a href="ksiazki.php">Książki</a></li>
                <li><a href="autor.php" class="active">O Autorze</a></li>
                <li><a href="wywiady.php">Wywiady</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
                <li><a href="<?php echo isset($_SESSION['admin']) ? 'admin.php' : 'login.php'; ?>">
                    <?php echo isset($_SESSION['admin']) ? 'Panel Admina' : 'Logowanie'; ?>
                </a></li>
            </ul>
        </div>
    </nav>

    <section class="content-section">
        <h1>Henryk von Solivagant</h1>
        
        <div class="bio-section">
            <h2>Biografia</h2>
            <p>
                Henryk von Solivagant urodził się w 1975 roku w małej miejscowości na pograniczu 
                polsko-czeskim. Od najmłodszych lat fascynowały go opowieści o duchach, legendy 
                ludowe i tajemnice ukryte w cieniach historii. Jego dzieciństwo upłynęło w starym 
                dworze, którego korytarze i zakamarki stały się inspiracją dla wielu późniejszych 
                utworów.
            </p>
            <p>
                Studiował historię i antropologię kulturową na Uniwersytecie Jagiellońskim, 
                specjalizując się w folklorze słowiańskim i mitologii. To właśnie podczas badań 
                terenowych w opuszczonych wioskach Karpat narodził się pomysł na jego pierwszą 
                powieść "Ostatnia Podróż".
            </p>
        </div>

        <div class="bio-section">
            <h2>Twórczość</h2>
            <p>
                Von Solivagant debiutował w 2019 roku powieścią "Ostatnia Podróż", która natychmiast 
                zyskała uznanie krytyków i czytelników. Jego styl charakteryzuje się głębokim 
                psychologizmem, atmosferycznym opisem miejsc oraz umiejętnym budowaniem napięcia.
            </p>
            <p>
                Autor nie poprzestaje na prostym straszeniu - jego książki to studia nad ludzką 
                psychiką, konfrontacją ze strachem i naturą zła. Często sięga po motywy 
                folklorystyczne, łącząc je z współczesnymi lękami i problemami społecznymi.
            </p>
            <p>
                Do tej pory opublikował siedem powieści oraz zbiór opowiadań. Jego książki zostały 
                przetłumaczone na dwanaście języków, a "Szept w Ciemności" otrzymał prestiżową 
                nagrodę im. Lovecrafta w 2022 roku.
            </p>
        </div>

        <div class="bio-section">
            <h2>Inspiracje i Proces Twórczy</h2>
            <p>
                Von Solivagant przyznaje, że największy wpływ na jego twórczość mieli klasycy 
                horroru: H.P. Lovecraft, Edgar Allan Poe oraz współczesny Stephen King. Z polskich 
                autorów wymienia Stefana Grabińskiego i Andrzeja Sapkowskiego.
            </p>
            <p>
                Proces pisarski autora jest niezwykle metodyczny. Każdą książkę poprzedzają miesiące 
                badań - zarówno lokalnych legend, jak i miejsc, które stają się tłem dla akcji. 
                Von Solivagant osobiście odwiedza wszystkie lokacje opisywane w swoich powieściach, 
                fotografuje je i rozmawia z lokalnymi mieszkańcami.
            </p>
            <p>
                Pisze głównie nocą, w swoim gabinecie w odnowionym dworze rodzinnym. Jak sam 
                przyznaje, cisza i ciemność pomagają mu w tworzeniu odpowiedniej atmosfery i 
                wczuwaniu się w emocje swoich bohaterów.
            </p>
        </div>

        <div class="bio-section">
            <h2>Życie Prywatne</h2>
            <p>
                Henryk von Solivagant mieszka w rodzinnym dworze, który po latach renowacji stał się 
                nie tylko jego domem, ale i miejscem pracy. Prowadzi stosunkowo zamknięte życie, 
                rzadko udzielając wywiadów czy pojawiając się publicznie.
            </p>
            <p>
                W wolnym czasie zbiera stare rękopisy i dokumenty historyczne, szczególnie te 
                dotyczące lokalnego folkloru. Jest również pasjonatem klasycznej muzyki i malarstwa 
                romantycznego. Jego prywatna kolekcja obrazów z XIX wieku jest imponująca.
            </p>
            <p>
                Mimo powściągliwości w kontaktach medialnych, autor jest bardzo zaangażowany w 
                działalność charytatywną, wspierając lokalne biblioteki i inicjatywy edukacyjne 
                promujące czytelnictwo wśród młodzieży.
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