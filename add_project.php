<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Capstone Project</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
</head>
<body>

    <h2>Add Capstone Project</h2>

    <form action="save_project.php" method="POST" enctype="multipart/form-data" class="form-container">

        <!-- Project Overview Section -->
        <div class="form-section">
            <h3>Project Overview</h3>
            <label>Project Title:</label>
            <input type="text" name="project_title" required>

            <label>Overview (Max 500 words):</label>
            <textarea name="overview" maxlength="3000" required></textarea>

            <label>IMRAD (PDF):</label>
            <input type="file" name="imrad" accept="application/pdf">

            <label>System Guides (PDF):</label>
            <input type="file" name="system_guides" accept="application/pdf">

            <label>Recipient:</label>
            <input type="text" name="recipient" required>

            <h4>Research Agenda</h4>
            <div class="checkbox-group">
                <label><input type="checkbox" name="research_agenda[]" value="IoT"> IoT</label>
                <label><input type="checkbox" name="research_agenda[]" value="WebBased"> Web Based</label>
                <!-- Add more research agenda items as needed -->
            </div>
        </div>

        <!-- Team Composition Section -->
        <div class="form-section">
            <h3>Team Composition</h3>
            <label>Profile Picture:</label>
            <input type="file" name="profile_picture" accept="image/*">
            
            <label>Name:</label>
            <input type="text" name="team_name" placeholder="Last Name, First Name, MI, Suffix" required>
            
            <h4>Roles</h4>
            <div class="checkbox-group">
                <label><input type="checkbox" name="roles[]" value="Leader"> Leader</label>
                <label><input type="checkbox" name="roles[]" value="Developer"> Developer</label>
                <!-- Add more roles as needed -->
            </div>
        </div>

        <!-- Documentation Section -->
        <div class="form-section">
            <h3>Documentation</h3>
            <label>Narrative Summary (Max 2500 words):</label>
            <textarea name="narrative_summary" maxlength="2500"></textarea>
        </div>

        <!-- Gallery Section -->
        <div class="form-section">
            <h3>Gallery</h3>
            <label>Upload Images (Max 15, 5MB each):</label>
            <input type="file" name="gallery[]" accept="image/*" multiple>
            
            <label>Image Description (Max 50 words per image):</label>
            <textarea name="image_description[]" maxlength="50" placeholder="Description of image"></textarea>
        </div>

        <!-- Submit Button -->
        <div class="button-container">
            <button type="submit">Save</button>
        </div>

    </form>

</body>
</html>
