<?php
// index.php
$message = '';
$upload_dir = 'uploads/';

// Ensure upload directory exists
if (!file_exists($upload_dir)) {
    mkdir($upload_dir, 0777, true);
}

if (isset($_POST['submit'])) {
    $target_file = $upload_dir . basename($_FILES["fileToUpload"]["name"]);
    
    // VULNERABILITY:
    // The script moves the uploaded file to the public directory
    // WITHOUT checking the file extension or MIME type.
    // A user can upload 'evil.php' and then access it via the browser.
    
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $message = "<div class='success'>File uploaded! <a href='" . $target_file . "'>Click here to view it</a></div>";
    } else {
        $message = "<div class='error'>Sorry, there was an error uploading your file.</div>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Image Gallery Upload</title>
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background: #f0f2f5; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .card { background: white; padding: 2rem; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); width: 400px; }
        h1 { margin-top: 0; color: #333; font-size: 1.5rem; }
        input[type="file"] { margin: 1rem 0; display: block; width: 100%; }
        button { background: #007bff; color: white; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; width: 100%; font-size: 1rem; }
        button:hover { background: #0056b3; }
        .success { color: #155724; background-color: #d4edda; border-color: #c3e6cb; padding: 10px; margin-top: 10px; border-radius: 4px; word-break: break-all;}
        .error { color: #721c24; background-color: #f8d7da; border-color: #f5c6cb; padding: 10px; margin-top: 10px; border-radius: 4px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>📸 Public Gallery Upload</h1>
        <p>Share your photos with the community.</p>
        
        <form action="" method="post" enctype="multipart/form-data">
            <input type="file" name="fileToUpload" id="fileToUpload" required>
            <button type="submit" name="submit" value="Upload Image">Upload Image</button>
        </form>
        
        <?= $message ?>
    </div>
</body>
</html>