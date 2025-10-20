<?php
session_start();
if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Successful - Coffee Shop</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
  :root {
    --primary-color: #3b141c; 
    --accent-color: #f3961c;  
    --bg-color: #ffffff;      
    --text-light: #fff3e6;    
  }

  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }

  body {
    min-height: 100vh;
    background: var(--bg-color);
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .success-container {
    background: var(--primary-color);
    border-radius: 20px;
    padding: 50px 45px;
    width: 420px;
    text-align: center;
    color: var(--text-light);
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
    animation: fadeIn 0.8s ease-in-out;
  }

  .coffee-icon {
    font-size: 3.5em;
    margin-bottom: 15px;
    color: var(--accent-color);
    animation: float 2s ease-in-out infinite alternate;
  }

  h2 {
    color: var(--accent-color);
    font-size: 2em;
    margin-bottom: 10px;
  }

  p {
    font-size: 1.05em;
    margin-bottom: 25px;
    color: var(--text-light);
  }

  .buttons {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .buttons a {
    display: inline-block;
    padding: 12px;
    border-radius: 30px;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
  }

  .btn-home {
    background: var(--accent-color);
    color: var(--primary-color);
  }

  .btn-home:hover {
    background: transparent;
    border: 2px solid var(--accent-color);
    color: var(--accent-color);
    transform: translateY(-2px);
  }

  .btn-logout {
    background: transparent;
    border: 2px solid var(--accent-color);
    color: var(--accent-color);
  }

  .btn-logout:hover {
    background: var(--accent-color);
    color: var(--primary-color);
    transform: translateY(-2px);
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
  <div class="success-container">
    <div class="coffee-icon">☕</div>
    <h2>Order Successful!</h2>
    <p>Thank you, <strong><?php echo htmlspecialchars($_SESSION['user_name']); ?></strong>!<br>
    Your delicious coffee and snacks are on the way ☕🍩</p>

    <div class="buttons">
      <a href="order.php" class="btn-home">Place Another Order</a>
      <a href="logout.php" class="btn-logout">Logout</a>
    </div>
  </div>
</body>
</html>
