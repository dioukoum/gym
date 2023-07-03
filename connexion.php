<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=gym', "root", "");
} catch (Exception $e) {
    die($e->getMessage());
}
