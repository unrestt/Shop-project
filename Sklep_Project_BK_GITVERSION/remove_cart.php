<?php
session_start();
$conn = new mysqli("localhost", "root", "", "kutnik_store");

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Błąd połączenia z bazą danych.']));
}

$data = json_decode(file_get_contents("php://input"), true);
$item_id = $data['item_id'];
$rozmiar = $data['rozmiar'];

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "DELETE FROM koszyk WHERE user_id = ? AND item_id = ? AND rozmiar = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("iis", $user_id, $item_id, $rozmiar);
    
    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Nie udało się usunąć produktu.']);
    }

    $stmt->close();
}

$conn->close();
?>

