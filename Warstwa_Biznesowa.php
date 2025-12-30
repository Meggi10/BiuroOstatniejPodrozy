<?php
require_once 'Warstwa_Dostepu_Do_Danych.php';

class Warstwa_biznesowa {
    private $warstwa_danych;
    
    public function __construct() {
        $this->warstwa_danych = new Warstwa_dostepu_do_danych_konfiguracja();
    }
    
    public function wb_pobierz_wszystkie_ksiazki() {
        return $this->warstwa_danych->wd_pobierz_wszystkie_ksiazki();
    }
    
    public function wb_wyszukaj_ksiazke($tytul) {
        if (empty($tytul)) {
            return [];
        }
        return $this->warstwa_danych->wd_wyszukaj_ksiazke($tytul);
    }
    
    public function wb_pobierz_informacje_o_autorze() {
        return $this->warstwa_danych->wd_pobierz_informacje_o_autorze();
    }
    
    public function wb_pobierz_informacje_o_kontakcie() {
        return $this->warstwa_danych->wd_pobierz_informacje_o_kontakcie();
    }
    
    public function wb_pobierz_wszystkie_wywiady() {
        return $this->warstwa_danych->wd_pobierz_wszystkie_wywiady();
    }
    
    public function wb_pobierz_wywiad_po_id($id) {
        if (!is_numeric($id) || $id < 1) {
            return null;
        }
        return $this->warstwa_danych->wd_pobierz_wywiad_po_id($id);
    }
    
    public function wb_admin_login($username, $password) {
        if (empty($username) || empty($password)) {
            return false;
        }
        return $this->warstwa_danych->wd_sprawdz_poprawnosc_i_login($username, $password);
    }
    
    public function wb_dodaj_ksiazke($tytul, $opis, $rok, $gatunek, $autor, $wydawnictwo, $okladka_dane = null) {
        if (empty($tytul) || empty($opis) || empty($rok) || empty($gatunek) || empty($autor) || empty($wydawnictwo)) {
            return false;
        }
        
        if (!is_numeric($rok) || $rok < 1900 || $rok > 2100) {
            return false;
        }
        
        return $this->warstwa_danych->wd_dodaj_ksiazke($tytul, $opis, $rok, $gatunek, $autor, $wydawnictwo, $okladka_dane);
    }
    
    public function wb_sprawdz_admin() {
        return $this->warstwa_danych->wd_sprawdz_admin();
    }
}
?>