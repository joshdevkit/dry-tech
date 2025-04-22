<?php

require_once '../classes/Db.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    extract($_POST);
    $data = $_POST;

    $columns = implode(", ", array_keys($data));
    $placeholders = ":" . implode(", :", array_keys($data));

    $sql = "INSERT INTO contact_messages ($columns) VALUES ($placeholders)";
    $stmt = $conn->prepare($sql);
    $stmt->execute($data);

    if ($stmt) {
        return json_encode([
            "status" => true,
            'message' => "Inquiries successfully submitted"
        ]);
    }
}
