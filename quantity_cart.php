<?php
session_start();

$conn = new mysqli("localhost", "root", "", "kutnik_store");

if ($conn->connect_error) {
  die("Błąd połączenia: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
  $itemId = $_POST['itemId'];
  $rozmiar = $_POST['rozmiar'];
  $newQuantity = $_POST['newQuantity'];

  $query = "UPDATE koszyk SET ilosc = $newQuantity WHERE item_id = $itemId AND user_id = $user_id AND rozmiar = '$rozmiar'";

  $result = $conn->query($query);

  if (!$result) {
    die("Błąd aktualizacji koszyka: " . $conn->error);
  }
}

$conn->close();
?>