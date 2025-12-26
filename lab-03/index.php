<?php
// index.php
$output = "";

if (isset($_POST['target'])) {
    $target = $_POST['target'];
    
    // VULNERABILITY:
    // The script takes the user input ($target) and directly concatenates it
    // into a shell command without escaping or validation.
    // Intended command: ping -c 3 <ip>
    // Injected command: ping -c 3 8.8.8.8; ls -la
    $cmd = "ping -c 3 " . $target;
    
    // Execute the command
    $output = shell_exec($cmd);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>NetTool Pro v1.0</title>
    <style>
        body { font-family: monospace; background: #1a1a1a; color: #00ff00; padding: 2rem; }
        .container { max-width: 600px; margin: 0 auto; border: 1px solid #333; padding: 2rem; }
        input[type="text"] { width: 70%; padding: 10px; background: #333; color: white; border: none; }
        button { padding: 10px 20px; background: #00ff00; color: black; border: none; cursor: pointer; font-weight: bold; }
        pre { background: #111; padding: 15px; border: 1px dashed #444; white-space: pre-wrap; }
        h1 { margin-top: 0; }
    </style>
</head>
<body>
    <div class="container">
        <h1>📡 Connectivity Tester</h1>
        <p>Enter an IP address to verify server connectivity.</p>
        
        <form method="POST">
            <input type="text" name="target" placeholder="e.g., 8.8.8.8" required>
            <button type="submit">PING</button>
        </form>

        <?php if ($output): ?>
            <h3>Terminal Output:</h3>
            <pre><?= htmlspecialchars($output) ?></pre>
        <?php endif; ?>
    </div>
</body>
</html>