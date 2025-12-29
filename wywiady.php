<?php
session_start();
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
    <nav class="navbar">
        <div class="container">
            <div class="logo">Biuro Ostatniej Podróży</div>
            <ul class="nav-links">
                <li><a href="index.php">Strona Główna</a></li>
                <li><a href="ksiazki.php">Książki</a></li>
                <li><a href="autor.php">O Autorze</a></li>
                <li><a href="wywiady.php" class="active">Wywiady</a></li>
                <li><a href="kontakt.php">Kontakt</a></li>
                <li><a href="<?php echo isset($_SESSION['admin']) ? 'admin.php' : 'login.php'; ?>">
                    <?php echo isset($_SESSION['admin']) ? 'Panel Admina' : 'Logowanie'; ?>
                </a></li>
            </ul>
        </div>
    </nav>

    <section class="content-section">
        <h1>Wywiady z Henrykiem von Solivagantem</h1>
        
        <div class="interviews-list">
            <div class="interview-card" onclick="toggleInterview(1)">
                <h3>O procesie twórczym i inspiracjach</h3>
                <p class="date">Magazyn "Mroczne Karty" - Czerwiec 2023</p>
                <p>Rozmowa o tym, skąd czerpie inspiracje i jak wygląda jego codzienna praca nad powieścią.</p>
                <div class="interview-content" id="interview-1">
                    <p><strong>Pytanie:</strong> Skąd czerpie Pan inspiracje do swoich mrocznych historii?</p>
                    <p><strong>Henryk von Solivagant:</strong> To zawsze połączenie kilku elementów. Po pierwsze, historia i folklor lokalny - spędzam wiele czasu na badaniu starych legend i opowieści ludowych. Po drugie, miejsca. Odwiedzam opuszczone dwory, stare cmentarze, ruiny. Tam czuje się atmosferę, która później próbuję odtworzyć w książkach. I wreszcie ludzka psychika - fascynuje mnie, jak strach manifestuje się w różnych ludziach.</p>
                    
                    <p><strong>P:</strong> Jak wygląda Pana typowy dzień pracy?</p>
                    <p><strong>HvS:</strong> Piszę głównie nocą, od jedenastej wieczorem do czwartej nad ranem. To wtedy mój umysł jest najbardziej otwarty na mroczne historie. Dzień poświęcam na badania, czytanie, odpowiadanie na maile. Ale prawdziwa magia dzieje się w nocy, w ciszy mojego gabinetu.</p>
                    
                    <p><strong>P:</strong> Który z Pana książek był najtrudniejszy do napisania?</p>
                    <p><strong>HvS:</strong> Zdecydowanie "Szept w Ciemności". Historia dotykała bardzo osobistych lęków i wymagała ode mnie głębokiego zagłębienia się w psychologię traumy. Niektóre sceny pisałem tygodniami, po kilka zdań dziennie. Ale właśnie ta trudność sprawiła, że jest to moja najbardziej dojrzała powieść.</p>
                </div>
            </div>

            <div class="interview-card" onclick="toggleInterview(2)">
                <h3>O gatunku horror i jego przyszłości</h3>
                <p class="date">Portal "Literatura Grozy" - Październik 2022</p>
                <p>Dyskusja na temat współczesnego horroru i jego miejsca w literaturze.</p>
                <div class="interview-content" id="interview-2">
                    <p><strong>Pytanie:</strong> Jak postrzega Pan aktualny stan literatury grozy?</p>
                    <p><strong>Henryk von Solivagant:</strong> Uważam, że przeżywamy renesans horroru, szczególnie horroru psychologicznego. Czytelnicy są coraz bardziej wyrafinowani - nie wystarczy już samo straszenie. Chcą głębi psychologicznej, metafor społecznych, prawdziwego literackiego mistrzostwa. I to właśnie starają się dostarczyć współcześni autorzy.</p>
                    
                    <p><strong>P:</strong> Co odróżnia dobry horror od przeciętnego?</p>
                    <p><strong>HvS:</strong> Dobry horror nie opiera się na jump scare'ach czy literackich odpowiednikach krwawych scen. Dobry horror buduje atmosferę, zagląda w najciemniejsze zakamarki ludzkiej duszy, zmusza do konfrontacji z własnymi lękami. To literatura, która pozostaje z czytelnikiem długo po zamknięciu książki.</p>
                    
                    <p><strong>P:</strong> Jaka jest przyszłość gatunku?</p>
                    <p><strong>HvS:</strong> Myślę, że horror będzie coraz bardziej interdyscyplinarny. Będziemy widzieć więcej połączeń z science fiction, fantastyką, literaturą obyczajową. Horror to doskonałe narzędzie do opowiadania o współczesnych lękach - zmianach klimatycznych, technologii, izolacji społecznej. Gatunek ma przed sobą świetlaną przyszłość.</p>
                </div>
            </div>

            <div class="interview-card" onclick="toggleInterview(3)">
                <h3>Rozmowa o "Ostatniej Podróży"</h3>
                <p class="date">Radio "Nocne Głosy" - Styczeń 2020</p>
                <p>Wywiad po publikacji debiutanckiej powieści autora.</p>
                <div class="interview-content" id="interview-3">
                    <p><strong>Pytanie:</strong> "Ostatnia Podróż" to Pana debiut. Jak to jest opublikować pierwszą powieść?</p>
                    <p><strong>Henryk von Solivagant:</strong> To niesamowite i przerażające jednocześnie. Przez lata ta historia istniała tylko w mojej głowie i na stronach manuskryptu. Teraz nagle żyje własnym życiem, ludzie ją czytają, interpretują, dyskutują. To piękne, ale też onieśmielające.</p>
                    
                    <p><strong>P:</strong> Dlaczego wybrał Pan właśnie opuszczone sanatorium jako miejsce akcji?</p>
                    <p><strong>HvS:</strong> Sanatorium to miejsce szczególne - zostało zbudowane, by leczyć, ratować życie. Kiedy zostaje opuszczone, ta pierwotna funkcja zostaje wypaczona. Pozostaje tylko echo cierpienia, żalu, czasem także nadziei. To doskonałe tło dla historii o tym, jak przeszłość nawiedza teraźniejszość.</p>
                    
                    <p><strong>P:</strong> Czy planuje Pan kontynuację?</p>
                    <p><strong>HvS:</strong> Każda moja książka to zamknięta opowieść. Nie planuję sequeli czy trylogii. Wolę za każdym razem zanurzyć się w nowym świecie, poznać nowych bohaterów, zbadać nowe lęki. Chociaż... nigdy nie mów nigdy.</p>
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

    <script>
        function toggleInterview(id) {
            const content = document.getElementById('interview-' + id);
            content.classList.toggle('active');
        }
    </script>
</body>
</html>