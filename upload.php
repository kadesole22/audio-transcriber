<?php
if($_SERVER['REQUEST_METHOD'] == 'POST') { 
    if(isset($_FILES['audioFile']) && $_FILES['audioFile']['error'] == 0){
        $uploadDir = 'uploads/';
        $uploadFile = $uploadDir . basename($_FILES['audioFile']['name']);

        if (move_uploaded_file($_FILES['audioFile']['tmp_name'], $uploadFile)) {
            echo "File is valid, and was successfully uploaded.\n";

            // Call the Python script
            $command = escapeshellcmd("python3 transcribe.py " . escapeshellarg($uploadFile));

            $output = shell_exec($command);

            if($output === null) {
                echo "Transcription failed!";
            } else {
                // Display the transcription result
                echo "<h2>Transcription Result:</h2>";
                echo "<p>" . nl2br(htmlspecialchars($output)) . "</p>";
            }
        } else {
            echo "File upload failed!";
        }
    } else {
        echo "No file uploaded or there was an upload error!";
    }
}
?>
