<?php
class Database {
    private $db;
    
    public function __construct() {
        try {
            $this->db = new PDO('sqlite:biuro.db');
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->initDatabase();
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }
    
    private function initDatabase() {
        $this->db->exec("CREATE TABLE IF NOT EXISTS ksiazki (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            tytul TEXT NOT NULL,
            opis TEXT NOT NULL,
            rok INTEGER NOT NULL,
            gatunek TEXT NOT NULL,
            autor TEXT DEFAULT 'Henryk von Solivagant',
            wydawnictwo TEXT NOT NULL,
            okladka TEXT NOT NULL
        )");
        
        $this->db->exec("CREATE TABLE IF NOT EXISTS admin (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            username TEXT UNIQUE NOT NULL,
            password TEXT NOT NULL
        )");
        
        $this->db->exec("INSERT OR IGNORE INTO admin (username, password) 
                        VALUES ('admin', '" . password_hash('admin123', PASSWORD_DEFAULT) . "')");
        
        $count = $this->db->query("SELECT COUNT(*) FROM ksiazki")->fetchColumn();
        if ($count == 0) {
            $this->addSampleBooks();
        }
    }
    
    private function addSampleBooks() {
        $books = [
            [
                'tytul' => 'Ostatnia Podróż',
                'opis' => 'Mroczna opowieść o grupie turystów, którzy odkrywają, że ich wycieczka do opuszczonego sanatorium to coś więcej niż zwykła przygoda. W labiryncie korytarzy czai się zło, które czekało na nich od dziesięcioleci.',
                'rok' => 2019,
                'gatunek' => 'Horror psychologiczny',
                'wydawnictwo' => 'Wydawnictwo Mroczne Kartki'
            ],
            [
                'tytul' => 'Cienie Przeszłości',
                'opis' => 'Historia profesora historii, który podczas badań nad starożytnym kodeksem uwalnia siły, których istnienia wcześniej nie podejrzewał. Granica między rzeczywistością a koszmarem zaczyna się zacierać.',
                'rok' => 2020,
                'gatunek' => 'Horror mistyczny',
                'wydawnictwo' => 'Dom Wydawniczy Nox'
            ],
            [
                'tytul' => 'Szept w Ciemności',
                'opis' => 'Małe miasteczko skrywa mroczną tajemnicę. Kiedy młoda dziennikarka przyjeżdża zbadać serię tajemniczych zniknięć, odkrywa, że prawda jest o wiele bardziej przerażająca niż mogłaby sobie wyobrazić.',
                'rok' => 2021,
                'gatunek' => 'Horror',
                'wydawnictwo' => 'Wydawnictwo Mroczne Kartki'
            ]
        ];
        
        $stmt = $this->db->prepare("INSERT INTO ksiazki (tytul, opis, rok, gatunek, wydawnictwo, okladka) 
                                    VALUES (:tytul, :opis, :rok, :gatunek, :wydawnictwo, :okladka)");
        
        foreach ($books as $book) {
            $stmt->execute([
                ':tytul' => $book['tytul'],
                ':opis' => $book['opis'],
                ':rok' => $book['rok'],
                ':gatunek' => $book['gatunek'],
                ':wydawnictwo' => $book['wydawnictwo'],
                ':okladka' => 'placeholder.jpg'
            ]);
        }
    }
    
    public function getAllBooks() {
        $stmt = $this->db->query("SELECT * FROM ksiazki ORDER BY rok DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function searchBooks($query) {
        $stmt = $this->db->prepare("SELECT * FROM ksiazki 
                                    WHERE tytul LIKE :query 
                                    OR opis LIKE :query 
                                    OR gatunek LIKE :query
                                    ORDER BY rok DESC");
        $stmt->execute([':query' => "%$query%"]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addBook($data) {
        $stmt = $this->db->prepare("INSERT INTO ksiazki 
                                    (tytul, opis, rok, gatunek, autor, wydawnictwo, okladka) 
                                    VALUES (:tytul, :opis, :rok, :gatunek, :autor, :wydawnictwo, :okladka)");
        return $stmt->execute($data);
    }
    
    public function verifyAdmin($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM admin WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $admin = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($admin && password_verify($password, $admin['password'])) {
            return true;
        }
        return false;
    }
}
?>