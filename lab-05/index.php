<?php
// index.php
session_start();

// Setup a temporary SQLite database in memory (or a temp file)
// In a real scenario, this would be a persistent MySQL/PostgreSQL server
try {
    $db = new SQLite3('/tmp/ctf_users.db');
    
    // Create table and insert a dummy admin (only runs once)
    $db->exec("CREATE TABLE IF NOT EXISTS users (id INTEGER PRIMARY KEY, username TEXT, password TEXT)");
    
    // Check if admin exists, if not, create one with a random secure password
    $check = $db->querySingle("SELECT count(*) FROM users WHERE username='admin'");
    if ($check == 0) {
        $db->exec("INSERT INTO users (username, password) VALUES ('admin', '5up3r_S3cr3t_P4ssw0rd_You_Wont_Guess')");
    }

} catch (Exception $e) {
    die("Database error: " . $e->getMessage());
}

$message = "";
$flag = "CTF{SQL_1nj3ct10n_Is_A_Cl4ss1c}";

// Handle Login
if (isset($_POST['username']) && isset($_POST['password'])) {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    // VULNERABILITY:
    // The inputs are concatenated directly into the query string.
    // Intended: SELECT * FROM users WHERE username = 'alice' AND password = '123'
    // Exploit:  SELECT * FROM users WHERE username = 'admin' --' AND password = '...'
    
    $query = "SELECT * FROM users WHERE username = '$user' AND password = '$pass'";
    
    // Debug output (helpful for learning)
    $debug_query = htmlspecialchars($query);

    // Execute query
    $result = $db->query($query);
    
    if ($result) {
        $row = $result->fetchArray();
        if ($row) {
            // Login Successful
            $_SESSION['user'] = $row['username'];
        } else {
            $message = "Invalid username or password.";
        }
    } else {
        $message = "SQL Error (You broke the query!)";
    }
}

// Logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Login Portal</title>
    <style>
        body { font-family: monospace; background: #0d1117; color: #c9d1d9; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .login-box { background: #161b22; padding: 2rem; border: 1px solid #30363d; border-radius: 6px; width: 350px; }
        h2 { text-align: center; color: #58a6ff; }
        input { width: 100%; padding: 10px; margin: 10px 0; background: #0d1117; border: 1px solid #30363d; color: white; box-sizing: border-box; }
        button { width: 100%; padding: 10px; background: #238636; color: white; border: none; cursor: pointer; font-weight: bold; }
        button:hover { background: #2ea043; }
        .error { color: #f85149; text-align: center; margin-bottom: 10px; }
        .success { color: #3fb950; text-align: center; }
        .debug { font-size: 0.8em; color: #8b949e; margin-top: 20px; border-top: 1px solid #30363d; padding-top: 10px; }
        code { color: #e3b341; }
    </style>
</head>
<body>

    <div class="login-box">
        <?php if (isset($_SESSION['user'])): ?>
            
            <h2>✅ Access Granted</h2>
            <p class="success">Welcome, <strong><?= htmlspecialchars($_SESSION['user']) ?></strong>!</p>
            <p>Here is your secret flag:</p>
            <div style="background: #21262d; padding: 10px; border: 1px dashed #30363d; text-align: center;">
                <code><?= $flag ?></code>
            </div>
            <br>
            <a href="?logout" style="color: #58a6ff; display: block; text-align: center;">Logout</a>

        <?php else: ?>

            <h2>🔒 Secure Login</h2>
            <?php if ($message): ?>
                <div class="error"><?= $message ?></div>
            <?php endif; ?>
            
            <form method="POST">
                <label>Username</label>
                <input type="text" name="username" placeholder="admin">
                
                <label>Password</label>
                <input type="password" name="password" placeholder="********">
                
                <button type="submit">Login</button>
            </form>

            <?php if (isset($debug_query)): ?>
                <div class="debug">
                    <strong>Last Query Executed:</strong><br>
                    <code><?= $debug_query ?></code>
                </div>
            <?php endif; ?>

        <?php endif; ?>
    </div>

</body>
</html>