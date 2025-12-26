<?php
// index.php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';

// VULNERABILITY:
// The script blindly includes the file specified in the 'page' parameter.
// It does not sanitize input or prevent directory traversal (../).
?>
<!DOCTYPE html>
<html>
<head><title>CTF LFI Challenge</title></head>
<body>
    <h1>File Viewer 1.0</h1>
    <p>Select a page:</p>
    <a href="?page=about.php">About</a> | 
    <a href="?page=contact.php">Contact</a>
    <hr>
    <div>
        <?php
            // Simulate legitimate pages
            if($page == 'home') {
                echo "Welcome to the home page!";
            } elseif($page == 'about.php') {
                echo "This is a vulnerable lab for educational purposes.";
            } elseif($page == 'contact.php') {
                echo "Contact admin@localhost for help.";
            } else {
                // The exploit happens here
                include($page);
            }
        ?>
    </div>
</body>
</html>