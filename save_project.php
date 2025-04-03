<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['project_title'];
    $overview = $_POST['overview'];
    $recipient = $_POST['recipient'];
    $narrative_summary = $_POST['narrative_summary'];
    $research_agenda = isset($_POST['research_agenda']) ? implode(', ', $_POST['research_agenda']) : '';

    // File Uploads
    function uploadFile($file, $target_dir) {
        $target_file = $target_dir . basename($file["name"]);
        if (move_uploaded_file($file["tmp_name"], $target_file)) {
            return $target_file;
        }
        return null;
    }

    $imrad = uploadFile($_FILES["imrad"], "uploads/");
    $system_guides = uploadFile($_FILES["system_guides"], "uploads/");

    // Insert Project
    $stmt = $conn->prepare("INSERT INTO capstone_projects (project_title, overview, imrad, system_guides, recipient, research_agenda, narrative_summary) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $title, $overview, $imrad, $system_guides, $recipient, $research_agenda, $narrative_summary);
    $stmt->execute();
    $project_id = $stmt->insert_id;
    $stmt->close();

    // Insert Team Members
    if (!empty($_POST['team_name'])) {
        $profile_picture = uploadFile($_FILES["profile_picture"], "uploads/");
        $name = $_POST['team_name'];
        $roles = isset($_POST['roles']) ? implode(', ', $_POST['roles']) : '';

        $stmt = $conn->prepare("INSERT INTO team_members (project_id, profile_picture, name, roles) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("isss", $project_id, $profile_picture, $name, $roles);
        $stmt->execute();
        $stmt->close();
    }

    // Insert Gallery
    if (!empty($_FILES['gallery']['name'][0])) {
        foreach ($_FILES['gallery']['name'] as $key => $val) {
            $photo = uploadFile(["name" => $_FILES['gallery']['name'][$key], "tmp_name" => $_FILES['gallery']['tmp_name'][$key]], "uploads/");
            $stmt = $conn->prepare("INSERT INTO gallery (project_id, photo) VALUES (?, ?)");
            $stmt->bind_param("is", $project_id, $photo);
            $stmt->execute();
        }
        $stmt->close();
    }

    echo "<script>alert('Project is created'); window.location.href='index.php';</script>";
}
?>
