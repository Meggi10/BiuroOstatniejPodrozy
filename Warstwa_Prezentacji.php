<?php
require_once 'Warstwa_Biznesowa.php';

class Warstwa_prezentacji {
    private $warstwa_biznesowa;
    
    public function __construct() {
        $this->warstwa_biznesowa = new Warstwa_biznesowa();
    }
    
    public function zalogowano() {
        return $this->warstwa_biznesowa->wb_sprawdz_admin();
    }
    
    public function wyswietl_pasek_nawigacji() {
        $aktywna_strona = basename($_SERVER['PHP_SELF']);
        
        echo '<nav class="navbar">
            <div class="container">
                <div class="logo">Biuro Ostatniej Podróży</div>
                <ul class="nav-links">
                    <li><a href="index.php"' . ($aktywna_strona == 'index.php' ? ' class="active"' : '') . '>Strona Główna</a></li>
                    <li><a href="ksiazki.php"' . ($aktywna_strona == 'ksiazki.php' ? ' class="active"' : '') . '>Książki</a></li>
                    <li><a href="autor.php"' . ($aktywna_strona == 'autor.php' ? ' class="active"' : '') . '>O Autorze</a></li>
                    <li><a href="wywiady.php"' . ($aktywna_strona == 'wywiady.php' ? ' class="active"' : '') . '>Wywiady</a></li>
                    <li><a href="kontakt.php"' . ($aktywna_strona == 'kontakt.php' ? ' class="active"' : '') . '>Kontakt</a></li>';
        
        if ($this->zalogowano()) {
            echo '<li><a href="admin.php"' . ($aktywna_strona == 'admin.php' ? ' class="active"' : '') . '>Panel Admina</a></li>
                  <li><a href="logout.php">Wyloguj</a></li>';
        } else {
            echo '<li><a href="login.php"' . ($aktywna_strona == 'login.php' ? ' class="active"' : '') . '>Logowanie</a></li>';
        }
        
        echo '</ul>
            </div>
        </nav>';
    }
    
    public function wyswietl_liste_ksiazek() {
        $ksiazki = $this->warstwa_biznesowa->wb_pobierz_wszystkie_ksiazki();
        
        if (empty($ksiazki)) {
            echo '<p style="text-align: center; color: #ccc; margin-top: 3rem;">Brak książek w bazie danych.</p>';
            return;
        }
        
        echo '<div class="books-grid">';
        foreach ($ksiazki as $ksiazka) {
            $this->wyswietl_ksiazke($ksiazka);
        }
        echo '</div>';
    }
    
    public function wyswietl_liste_ksiazek_po_nazwie($tytul) {
        $ksiazki = $this->warstwa_biznesowa->wb_wyszukaj_ksiazke($tytul);
        
        if (empty($ksiazki)) {
            echo '<p style="text-align: center; color: #ccc; margin-top: 3rem;">
                Nie znaleziono książek pasujących do zapytania: "' . htmlspecialchars($tytul) . '"
                <br><a href="ksiazki.php" style="color: #ff4444; margin-top: 1rem; display: inline-block;">Wyczyść wyszukiwanie</a>
            </p>';
            return;
        }
        
        echo '<p style="text-align: center; color: #ccc; margin-bottom: 2rem;">
            Znaleziono ' . count($ksiazki) . ' wyników dla: "' . htmlspecialchars($tytul) . '"
            <a href="ksiazki.php" style="color: #ff4444; margin-left: 1rem;">Wyczyść wyszukiwanie</a>
        </p>';
        
        echo '<div class="books-grid">';
        foreach ($ksiazki as $ksiazka) {
            $this->wyswietl_ksiazke($ksiazka);
        }
        echo '</div>';
    }
    
private function wyswietl_ksiazke($ksiazka) {
    $okladka_url = 'okladka.php?id=' . $ksiazka['id'];
    
    echo '<div class="book-card">
        <img src="' . htmlspecialchars($okladka_url) . '" 
             alt="' . htmlspecialchars($ksiazka['tytul']) . '" 
             class="book-cover"
             onerror="this.src=\'data:image/svg+xml,%3Csvg xmlns=%22http://www.w3.org/2000/svg%22 width=%22250%22 height=%22350%22%3E%3Crect fill=%22%231a1a1a%22 width=%22250%22 height=%22350%22/%3E%3Ctext x=%2250%25%22 y=%2250%25%22 font-size=%2220%22 fill=%22%23ff4444%22 text-anchor=%22middle%22 dy=%22.3em%22%3E' . rawurlencode($ksiazka['tytul']) . '%3C/text%3E%3C/svg%3E\'">
        <div class="book-info">
            <h3>' . htmlspecialchars($ksiazka['tytul']) . '</h3>
            <p class="year">' . htmlspecialchars($ksiazka['rok']) . ' | ' . htmlspecialchars($ksiazka['wydawnictwo']) . '</p>
            <p class="author">' . htmlspecialchars($ksiazka['autor']) . '</p>
            <span class="genre">' . htmlspecialchars($ksiazka['gatunek']) . '</span>
            <p class="description">' . htmlspecialchars($ksiazka['opis']) . '</p>
        </div>
    </div>';
}

    
    public function wyszukaj_ksiazke() {
        echo '<div class="search-box">
            <form method="GET" action="ksiazki.php">
                <input type="text" 
                       name="search" 
                       placeholder="Wyszukaj książkę po tytule..." 
                       value="' . (isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '') . '">
            </form>
        </div>';
    }
    
    public function wyswietl_informacje_o_autorze() {
        $autor = $this->warstwa_biznesowa->wb_pobierz_informacje_o_autorze();
        
        if (!$autor) {
            echo '<p>Brak informacji o autorze.</p>';
            return;
        }
        
        echo '<div class="bio-section">
            <h2>Biografia</h2>
            <p>' . nl2br(htmlspecialchars($autor['biografia'])) . '</p>
        </div>
        
        <div class="bio-section">
            <h2>Ciekawostki</h2>
            <p>' . nl2br(htmlspecialchars($autor['ciekawostki'])) . '</p>
        </div>
        
        <div class="bio-section">
            <h2>Dokonania</h2>
            <p>' . nl2br(htmlspecialchars($autor['dokonania'])) . '</p>
        </div>';
    }
    
    public function wyswietl_kontakt() {
        $kontakt = $this->warstwa_biznesowa->wb_pobierz_informacje_o_kontakcie();
        
        echo '<div class="bio-section">
            <h2>Informacje kontaktowe</h2>
            <p><strong>Email:</strong><br>' . htmlspecialchars($kontakt['email']) . '</p>
            
            <p><strong>Agencja literacka:</strong><br>
            Agencja "Mroczne Pióro"<br>
            ul. Literacka 13<br>
            31-147 Kraków<br>
            Tel: +48 22 123 45 67</p>
        </div>
        
        <div class="bio-section">
            <h2>Media społecznościowe</h2>
            <p>
                <strong>Facebook:</strong> /HenrykVonSolivagantOficjalny<br>
                <strong>Instagram:</strong> @vonsolivagant<br>
                <strong>Twitter:</strong> @HvonSolivagant
            </p>
        </div>';
    }
    
    public function wyswietl_liste_wywiadow() {
        $wywiady = $this->warstwa_biznesowa->wb_pobierz_wszystkie_wywiady();
        
        if (empty($wywiady)) {
            echo '<p style="text-align: center; color: #ccc;">Brak dostępnych wywiadów.</p>';
            return;
        }
        
        echo '<div class="interviews-list">';
        foreach ($wywiady as $wywiad) {
            echo '<div class="interview-card" onclick="toggleInterview(' . $wywiad['id'] . ')">
                <h3>' . htmlspecialchars($wywiad['tytul']) . '</h3>
                <div class="interview-content" id="interview-' . $wywiad['id'] . '">
                    ' . nl2br(htmlspecialchars($wywiad['tresc'])) . '
                </div>
            </div>';
        }
        echo '</div>';
    }
    
    public function wyswietl_komunikat($wiadomosc, $typ = 'info') {
        $klasa = 'message';
        if ($typ == 'error') {
            $klasa .= ' error';
        } else if ($typ == 'success') {
            $klasa .= ' success';
        }
        
        echo '<div class="' . $klasa . '">' . htmlspecialchars($wiadomosc) . '</div>';
    }
    
    public function dodaj_nowa_ksiazke($tytul, $opis, $rok, $gatunek, $autor, $wydawnictwo, $plik_okladki = null) {
        $okladka_dane = null;
        
        if ($plik_okladki && $plik_okladki['error'] == 0) {
            $okladka_dane = file_get_contents($plik_okladki['tmp_name']);
        }
        
        return $this->warstwa_biznesowa->wb_dodaj_ksiazke($tytul, $opis, $rok, $gatunek, $autor, $wydawnictwo, $okladka_dane);
    }
    
    public function wyswietl_o_autorze() {
        $this->wyswietl_informacje_o_autorze();
    }
    
    public function wyswietl_zawartosc_ksiazki($parametry_ksiazki) {
        $this->wyswietl_ksiazke($parametry_ksiazki);
    }
}
?>