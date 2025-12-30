<?php
class Warstwa_dostepu_do_danych_konfiguracja {
    public $adres_ip_serwera_BD = "localhost:3306";
    public $nazwa_BD = "BiuroOstatnejPodrozy";
    public $login_BD = "";
    public $haslo_BD = "";
    
    private $polaczenie;
    
    public function __construct() {
        $this->polaczenie = new PDO('sqlite:biuro.db');
        $this->polaczenie->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $this->polaczenie->exec("PRAGMA encoding = 'UTF-8'");
        $this->inicjalizuj_baze();
    }
    
    private function inicjalizuj_baze() {
        $this->polaczenie->exec("CREATE TABLE IF NOT EXISTS Ksiazki (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            tytul TEXT NOT NULL,
            opis TEXT NOT NULL,
            rok INTEGER NOT NULL,
            gatunek TEXT NOT NULL,
            autor TEXT DEFAULT 'Henryk von Solivagant',
            wydawnictwo TEXT NOT NULL,
            okladka_dane_binarne BLOB
        )");
        
        $this->polaczenie->exec("CREATE TABLE IF NOT EXISTS Admin (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL
        )");
        
        $this->polaczenie->exec("CREATE TABLE IF NOT EXISTS Kontakt (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            email TEXT NOT NULL
        )");
        
        $this->polaczenie->exec("CREATE TABLE IF NOT EXISTS Autor (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            nazwa TEXT NOT NULL,
            biografia TEXT,
            ciekawostki TEXT,
            dokonania TEXT
        )");
        
        $this->polaczenie->exec("CREATE TABLE IF NOT EXISTS Wywiady (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            tytul TEXT NOT NULL,
            tresc TEXT NOT NULL
        )");
        
        try {
            $stmt = $this->polaczenie->prepare("INSERT INTO Admin (username, password) VALUES (?, ?)");
            $stmt->execute(['admin', password_hash('admin123', PASSWORD_DEFAULT)]);
        } catch (PDOException $e) {
        }
        
        $count = $this->polaczenie->query("SELECT COUNT(*) FROM Ksiazki")->fetchColumn();
        if ($count == 0) {
            $this->dodaj_przykladowe_dane();
        }
    }
    
    private function dodaj_przykladowe_dane() {
        $this->polaczenie->exec("INSERT INTO Autor (nazwa, biografia, ciekawostki, dokonania) VALUES (
            'Henryk von Solivagant',
            'Henryk von Solivagant urodził się w 1975 roku w małej miejscowości na pograniczu polsko-czeskim. Od najmłodszych lat fascynowały go opowieści o duchach, legendy ludowe i tajemnice ukryte w cieniach historii. Jego dzieciństwo upłynęło w starym dworze, którego korytarze i zakamarki stały się inspiracją dla wielu późniejszych utworów.',
            'Zbiera stare rękopisy i dokumenty historyczne. Pisze głównie nocą w swoim gabinecie. Jest pasjonatem klasycznej muzyki i malarstwa romantycznego.',
            'Autor siedmiu powieści i jednego zbioru opowiadań. Nagroda im. Lovecrafta 2022. Tłumaczenia na 12 języków.'
        )");
        
        $this->polaczenie->exec("INSERT INTO Kontakt (email) VALUES ('kontakt@biuro-ostatniej-podrozy.pl')");
        
        $ksiazki = [
            [
                'Ostatnia Podróż',
                'Mroczna opowieść o grupie turystów, którzy odkrywają, że ich wycieczka do opuszczonego sanatorium to coś więcej niż zwykła przygoda. W labiryncie korytarzy czai się zło, które czekało na nich od dziesięcioleci. Książka łączy elementy horroru psychologicznego z atmosferyczną narracją.',
                2019,
                'Horror psychologiczny',
                'Henryk von Solivagant',
                'Wydawnictwo Mroczne Kartki'
            ],
            [
                'Cienie Przeszłości',
                'Historia profesora historii, który podczas badań nad starożytnym kodeksem uwalnia siły, których istnienia wcześniej nie podejrzewał. Granica między rzeczywistością a koszmarem zaczyna się zacierać. Autor mistrzowsko buduje napięcie, prowadząc czytelnika przez labirynt tajemnic.',
                2020,
                'Horror mistyczny',
                'Henryk von Solivagant',
                'Dom Wydawniczy Nox'
            ],
            [
                'Szept w Ciemności',
                'Małe miasteczko skrywa mroczną tajemnicę. Kiedy młoda dziennikarka przyjeżdża zbadać serię tajemniczych zniknięć, odkrywa, że prawda jest o wiele bardziej przerażająca niż mogłaby sobie wyobrazić. Nagroda im. Lovecrafta 2022.',
                2021,
                'Horror',
                'Henryk von Solivagant',
                'Wydawnictwo Mroczne Kartki'
            ]
        ];
        
        $stmt = $this->polaczenie->prepare("INSERT INTO Ksiazki (tytul, opis, rok, gatunek, autor, wydawnictwo) VALUES (?, ?, ?, ?, ?, ?)");
        foreach ($ksiazki as $ksiazka) {
            $stmt->execute($ksiazka);
        }
        
        $wywiady = [
            [
                'O procesie twórczym i inspiracjach',
                'Magazyn "Mroczne Karty" - Czerwiec 2023

**Pytanie:** Skąd czerpie Pan inspiracje do swoich mrocznych historii?

**Henryk von Solivagant:** To zawsze połączenie kilku elementów. Po pierwsze, historia i folklor lokalny - spędzam wiele czasu na badaniu starych legend i opowieści ludowych. Po drugie, miejsca. Odwiedzam opuszczone dwory, stare cmentarze, ruiny. Tam czuje się atmosferę, która później próbuję odtworzyć w książkach.'
            ],
            [
                'O gatunku horror i jego przyszłości',
                'Portal "Literatura Grozy" - Październik 2022

**Pytanie:** Jak postrzega Pan aktualny stan literatury grozy?

**Henryk von Solivagant:** Uważam, że przeżywamy renesans horroru, szczególnie horroru psychologicznego. Czytelnicy są coraz bardziej wyrafinowani - nie wystarczy już samo straszenie.'
            ]
        ];
        
        $stmt = $this->polaczenie->prepare("INSERT INTO Wywiady (tytul, tresc) VALUES (?, ?)");
        foreach ($wywiady as $wywiad) {
            $stmt->execute($wywiad);
        }
    }
    
    public function wd_pobierz_wszystkie_ksiazki() {
        $stmt = $this->polaczenie->query("SELECT * FROM Ksiazki ORDER BY rok DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function wd_pobierz_ksiazki() {
        return $this->wd_pobierz_wszystkie_ksiazki();
    }
    
    public function wd_wyszukaj_ksiazke($tytul) {
        $stmt = $this->polaczenie->prepare("SELECT * FROM Ksiazki WHERE tytul LIKE ? ORDER BY rok DESC");
        $stmt->execute(["%$tytul%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function wd_pobierz_informacje_o_autorze() {
        $stmt = $this->polaczenie->query("SELECT * FROM Autor LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function wd_pobierz_informacje_o_kontakcie() {
        $stmt = $this->polaczenie->query("SELECT * FROM Kontakt LIMIT 1");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function wd_pobierz_wszystkie_wywiady() {
        $stmt = $this->polaczenie->query("SELECT * FROM Wywiady");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function wd_pobierz_wywiad_po_id($id) {
        $stmt = $this->polaczenie->prepare("SELECT * FROM Wywiady WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
    public function wd_sprawdz_admin() {
        return isset($_SESSION['admin']) && $_SESSION['admin'] === true;
    }
    
    public function wd_sprawdz_poprawnosc_i_login($username, $password) {
        $stmt = $this->polaczenie->prepare("SELECT * FROM Admin WHERE username = ?");
        $stmt->execute([$username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($admin && password_verify($password, $admin['password'])) {
            $_SESSION['admin'] = true;
            $_SESSION['username'] = $username;
            return true;
        }
        return false;
    }
    
    public function wd_dodaj_ksiazke($tytul, $opis, $rok, $gatunek, $autor, $wydawnictwo, $okladka_dane = null) {
        $stmt = $this->polaczenie->prepare(
            "INSERT INTO Ksiazki (tytul, opis, rok, gatunek, autor, wydawnictwo, okladka_dane_binarne) 
             VALUES (?, ?, ?, ?, ?, ?, ?)"
        );
        return $stmt->execute([$tytul, $opis, $rok, $gatunek, $autor, $wydawnictwo, $okladka_dane]);
    }
    
    public function wd_pobierz_okladke($id) {
        $stmt = $this->polaczenie->prepare("SELECT okladka_dane_binarne FROM Ksiazki WHERE id = ?");
        $stmt->execute([$id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['okladka_dane_binarne'] : null;
    }
}
?>