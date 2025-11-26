<?php
$errors = [];
$username = $email = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST["username"]);
    $email = trim($_POST["email"]);
    $password = $_POST["password"];
    $confirm = $_POST["confirm_password"];

    // Validation
    if (!$username) $errors[] = "Username is required.";
    if (!$email) $errors[] = "Email is required.";
    elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) $errors[] = "Invalid email.";
    if (!$password) $errors[] = "Password is required.";
    elseif (strlen($password) < 6) $errors[] = "Password must be at least 6 characters.";
    if ($password !== $confirm) $errors[] = "Passwords do not match.";

    // If no errors
    if (empty($errors)) {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        echo "<p style='color:green;'>Registration successful!</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<style>
body { font-family: Arial; background: #f9f9f9; }
.container { width: 400px; margin: 50px auto; background: #fff; padding: 20px; border-radius: 6px; box-shadow: 0 0 8px rgba(0,0,0,0.1); }
.error { color: red; }
input[type=text], input[type=email], input[type=password] { width: 95%; padding: 8px; margin: 6px 0; }
input[type=submit] { width: 100%; padding: 10px; background: #4CAF50; color: white; border: none; cursor: pointer; }
input[type=submit]:hover { background: #45a049; }
</style>
</head>
<body>
<div class="container">
<h2>Register</h2>

<?php if ($errors): ?>
<div class="error"><ul>
<?php foreach ($errors as $e) echo "<li>$e</li>"; ?>
</ul></div>
<?php endif; ?>

<form method="POST">
    <label>Username:</label>
    <input type="text" name="username" value="<?= htmlspecialchars($username) ?>">

    <label>Email:</label>
    <input type="email" name="email" value="<?= htmlspecialchars($email) ?>">

    <label>Password:</label>
    <input type="password" name="password">

    <label>Confirm Password:</label>
    <input type="password" name="confirm_password">

    <input type="submit" value="Register">
</form>
</div>
</body>
</html>

