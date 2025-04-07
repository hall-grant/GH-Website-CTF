<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h1>Login</h1>
    <form method="POST" action="">
        Username: <input type="text" name="username"><br>
        Password: <input type="password" name="password"><br>
        <button type="submit">Login</button>
    </form>

    <?php
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Database connection (InfinityFree credentials)
        $conn = new mysqli(
            "sql113.infinityfree.com",  // Host
            "if0_38690920",             // Username
            "Gh409835",                 // Password
            "if0_38690920_allowed_users" // Database
        );

        // Improved connection error handling
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Vulnerable query (for debugging)
        $query = "SELECT * FROM users WHERE username = '$username' AND password = '$password'";
        echo "<p>Executed query: " . htmlspecialchars($query) . "</p>"; // Debug output

        $result = $conn->query($query);

        // Improved query error handling
        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            echo "<p>Flag: CTF{c0ngrant10ns_y0u_d1d_1t}</p>";
        } else {
            echo "<p>Invalid credentials</p>";
        }

        $conn->close();
    }
    ?>
</body>
</html>