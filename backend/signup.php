<?php 
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST['name'];
  $email = $_POST['email'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

  $check = $conn->prepare("SELECT * FROM users WHERE email=?");
  $check->bind_param("s", $email);
  $check->execute();
  $result = $check->get_result();

  if ($result->num_rows > 0) {
    echo "<script>alert('Email already exists! Please login.'); window.location.href='login.php';</script>";
  } else {
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $password);

    if ($stmt->execute()) {
      echo "<script>alert('Signup successful! Redirecting to order page...'); window.location.href='order.php';</script>";
    } else {
      echo "<script>alert('Error while signing up! Try again.');</script>";
    }
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Sign Up - Coffee Shop</title>
  <style>
    :root {
      --primary-color: #3b141c; /* Coffee brown */
      --secondary-color: #f3961c;
      --white-color: #ffffff;
    }

    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: "Poppins", sans-serif;
    }

    body {
      height: 100vh;
      background-color: var(--white-color); /* white background */
      display: flex;
      justify-content: center;
      align-items: center;
      color: var(--white-color);
    }

    .form-container {
      background: var(--primary-color); /* brown card */
      border-radius: 20px;
      padding: 50px 60px;
      width: 400px;
      text-align: center;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
      transition: all 0.3s ease-in-out;
      animation: fadeIn 1s ease-in-out;
    }

    .form-container:hover {
      box-shadow: 0 10px 40px rgba(243, 150, 28, 0.3);
      transform: translateY(-2px);
    }

    .coffee-icon {
      font-size: 3em;
      margin-bottom: 10px;
      animation: float 2s ease-in-out infinite alternate;
      color: var(--secondary-color);
    }

    h2 {
      font-size: 1.8em;
      margin-bottom: 20px;
      color: var(--secondary-color);
      font-weight: 600;
      letter-spacing: 1px;
    }

    input {
      width: 100%;
      padding: 12px 15px;
      margin: 12px 0;
      border: none;
      border-radius: 8px;
      background: rgba(255, 255, 255, 0.9);
      color: #000;
      font-size: 1em;
      outline: none;
      transition: 0.3s;
    }

    input::placeholder {
      color: rgba(0, 0, 0, 0.6);
    }

    input:focus {
      border: 1px solid var(--secondary-color);
      background: #fff;
    }

    button {
      width: 100%;
      padding: 12px;
      margin-top: 15px;
      background: var(--secondary-color);
      color: var(--primary-color);
      font-weight: 700;
      border: none;
      border-radius: 25px;
      cursor: pointer;
      font-size: 1em;
      transition: all 0.3s ease;
    }

    button:hover {
      background: transparent;
      color: var(--secondary-color);
      border: 1px solid var(--secondary-color);
      transform: scale(1.05);
    }

    p {
      margin-top: 20px;
      color: #f3d6b0;
      font-size: 0.95em;
    }

    a {
      color: var(--secondary-color);
      font-weight: 600;
      text-decoration: none;
      transition: 0.3s;
    }

    a:hover {
      color: var(--white-color);
      text-decoration: underline;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(-20px); }
      to { opacity: 1; transform: translateY(0); }
    }

    @keyframes float {
      from { transform: translateY(0); }
      to { transform: translateY(-8px); }
    }
  </style>
</head>
<body>
  <div class="form-container">
    <div class="coffee-icon">☕</div>
    <h2>Create Your Coffee Account</h2>
    <form method="POST">
      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email Address" required>
      <input type="password" name="password" placeholder="Password" required>
      <button type="submit">Sign Up</button>
      <p>Already have an account? <a href="login.php">Login</a></p>
    </form>
  </div>
</body>
</html>
