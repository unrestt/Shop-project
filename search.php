<?php
if (isset($_GET['q'])) {
    $query = $_GET['q'];
    $conn = new mysqli("localhost", "root", "", "kutnik_store");
    if ($conn->connect_error) {
        die("Błąd połączenia: " . $conn->connect_error);
    }


    $stmt = $conn->prepare("SELECT id, nazwa, image_url_1 FROM items WHERE nazwa LIKE ? LIMIT 5");
    $searchTerm = '%' . $query . '%';
    $stmt->bind_param('s', $searchTerm);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $id = $row['id'];
        $image_url = $row['image_url_1'];
        $nazwa = $row['nazwa'];

        echo '<a class="div_a" href="produkt.php?id=' . $id . '"><div class="single-search-product">';
        echo '<img src="' . $image_url . '" alt="' . $nazwa . '"';
        echo '<p>' . $nazwa . '</p>';
        echo '<br>';
        echo '</div></a>';
    }

    $stmt->close();
    $conn->close();
}
?>