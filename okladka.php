<?php
require_once 'Warstwa_Dostepu_Do_Danych.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header('Content-Type: image/svg+xml');
    echo '<svg xmlns="http://www.w3.org/2000/svg" width="250" height="350">
        <rect fill="#1a1a1a" width="250" height="350"/>
        <text x="50%" y="50%" font-size="20" fill="#ff4444" text-anchor="middle" dy=".3em">Brak okładki</text>
    </svg>';
    exit;
}

$id = (int)$_GET['id'];
$warstwa_danych = new Warstwa_dostepu_do_danych_konfiguracja();
$okladka = $warstwa_danych->wd_pobierz_okladke($id);

if ($okladka) {
    // Wykryj typ obrazu
    $finfo = new finfo(FILEINFO_MIME_TYPE);
    $mime = $finfo->buffer($okladka);
    
    header('Content-Type: ' . $mime);
    header('Content-Length: ' . strlen($okladka));
    header('Cache-Control: public, max-age=31536000');
    echo $okladka;
} else {
    // Zwróć domyślny obrazek SVG
    header('Content-Type: image/svg+xml');
    echo '<svg xmlns="http://www.w3.org/2000/svg" width="250" height="350">
        <rect fill="#1a1a1a" width="250" height="350"/>
        <text x="50%" y="50%" font-size="16" fill="#ff4444" text-anchor="middle" dy=".3em">Brak okładki</text>
    </svg>';
}
?>