<?php
session_start();

$message_order = "";
$conn = new mysqli("localhost", "root", "", "kutnik_store");

if ($conn->connect_error) {
    die("Błąd połączenia: " . $conn->connect_error);
}

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

    $query = "INSERT INTO zamowienia (user_id, data_zamowienia, calk_kwota, status) VALUES (?, NOW(), 0, 'w trakcie')";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $zamowienie_id = $stmt->insert_id;

    $query = "SELECT koszyk.item_id, koszyk.rozmiar, koszyk.ilosc, items.cena
              FROM koszyk 
              INNER JOIN items ON koszyk.item_id = items.id
              WHERE koszyk.user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $total_price = 0;

    while ($row = $result->fetch_assoc()) {
        $item_id = $row['item_id'];
        $rozmiar = $row['rozmiar'];
        $ilosc = $row['ilosc'];
        $cena = $row['cena'];
        $subtotal = $cena * $ilosc;

        $query = "INSERT INTO przedmioty_zamowione (zamowienie_id, item_id, ilosc, cena) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("iiii", $zamowienie_id, $item_id, $ilosc, $cena);
        $stmt->execute();

        $total_price += $subtotal;
    }

    $query = "UPDATE zamowienia SET calk_kwota = ? WHERE id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("di", $total_price, $zamowienie_id);
    $stmt->execute();

    $query = "DELETE FROM koszyk WHERE user_id = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    if ($stmt->execute()) {
        $_SESSION['message_order'] = "Zamówienie zostało złożone pomyślnie!";
        header("Location: koszyk.php");
        exit();
    }
    
    
    echo "Zamówienie zostało złożone pomyślnie!";
} else {
    echo "Nie jesteś zalogowany.";
}

$conn->close();
?>
