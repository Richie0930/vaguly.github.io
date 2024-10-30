<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['videoUrl'])) {
    $videoUrl = $_POST['videoUrl'];
    $allowedTypes = ['mp4', 'avi', 'mov', 'wmv'];

    // Check if the URL is valid and is a video URL
    $fileType = strtolower(pathinfo($videoUrl, PATHINFO_EXTENSION));
    
    if (in_array($fileType, $allowedTypes)) {
        $target_dir = "uploads/";
        $fileName = basename($videoUrl);
        $target_file = $target_dir . $fileName;

        // Use file_get_contents to get the video file
        $videoContent = file_get_contents($videoUrl);
        
        if ($videoContent) {
            file_put_contents($target_file, $videoContent);
            echo "The video has been uploaded from the URL: " . htmlspecialchars($videoUrl);
        } else {
            echo "Failed to retrieve the video.";
        }
    } else {
        echo "Sorry, only MP4, AVI, MOV & WMV URLs are allowed.";
    }
}
?>
