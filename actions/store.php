<?php

require_once '../classes/Db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $title = $_POST['title'];
    $client = $_POST['client'];
    $location = $_POST['location'];
    $contract_amount = $_POST['contract_amount'];
    $contract_package = $_POST['contract_package'];
    $status = $_POST['status'];

    $sql = "INSERT INTO projects (title, location, client, contract_package, contract_amount, status) 
                VALUES (:title, :location, :client, :contract_package, :contract_amount, :status)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':location', $location);
    $stmt->bindParam(':client', $client);
    $stmt->bindParam(':contract_package', $contract_package);
    $stmt->bindParam(':contract_amount', $contract_amount);
    $stmt->bindParam(':status', $status);
    $stmt->execute();

    $projectId = $conn->lastInsertId();

    if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
        $uploadedImages = $_FILES['images'];
        $validImageTypes = ['image/jpeg', 'image/png', 'image/gif'];

        $projectDir = '../assets/image/projects/';
        if (!file_exists($projectDir)) {
            mkdir($projectDir, 0777, true);
        }

        foreach ($uploadedImages['name'] as $index => $fileName) {
            $fileTmpName = $uploadedImages['tmp_name'][$index];

            if ($uploadedImages['error'][$index] === 0) {
                $uniqueFileName = uniqid('', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                $destination = $projectDir . '/' . $uniqueFileName;

                if (in_array(mime_content_type($fileTmpName), $validImageTypes)) {
                    if (move_uploaded_file($fileTmpName, $destination)) {
                        $imageSql = "INSERT INTO project_images (project_id, image_path) VALUES (:project_id, :image_path)";
                        $imageStmt = $conn->prepare($imageSql);
                        $imageStmt->bindParam(':project_id', $projectId);
                        $imageStmt->bindParam(':image_path', $uniqueFileName);
                        $imageStmt->execute();
                    } else {
                        echo "Error uploading file: " . $fileName;
                    }
                } else {
                    echo "Invalid file type: " . $fileName;
                }
            } else {
                echo "Error with file upload for: " . $fileName;
            }
        }
    } else {
        echo "No images selected for upload.";
    }

    header("Location: ../projects");
}
