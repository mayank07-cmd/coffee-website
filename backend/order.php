<?php
session_start();
include 'db.php';

if (!isset($_SESSION['user_id'])) {
  header("Location: login.php");
  exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $coffee = $_POST['coffee'];
  $food = $_POST['food'];
  $qty = $_POST['quantity'];
  $user_id = $_SESSION['user_id'];

  $stmt = $conn->prepare("INSERT INTO orders (user_id, coffee_type, food_item, quantity) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("issi", $user_id, $coffee, $food, $qty);

  if ($stmt->execute()) {
    header("Location: order_success.php");
    exit;
  } else {
    echo "<script>alert('Error placing order!');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Order Coffee - Coffee Shop</title>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
<style>
  :root {
    --primary-color: #3b141c; /* deep brown */
    --accent-color: #f3961c;  /* golden */
    --bg-color: #ffffff;      /* white background */
    --card-color: #3b141c;    /* brown center card */
    --text-light: #fff3e6;    /* light text inside card */
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

  .order-container {
    background: var(--card-color);
    border-radius: 20px;
    padding: 45px 40px;
    width: 420px;
    box-shadow: 0 12px 35px rgba(0, 0, 0, 0.2);
    text-align: center;
    animation: fadeIn 0.8s ease-in-out;
  }

  .coffee-icon {
    font-size: 3em;
    margin-bottom: 10px;
    color: var(--accent-color);
    animation: float 2s ease-in-out infinite alternate;
  }

  h2 {
    font-size: 1.8em;
    color: var(--accent-color);
    margin-bottom: 10px;
  }

  p {
    color: var(--text-light);
    margin-bottom: 25px;
    font-size: 0.95em;
  }

  label {
    display: block;
    text-align: left;
    margin-top: 15px;
    font-weight: 500;
    color: var(--text-light);
  }

  select, input[type="number"] {
    width: 100%;
    padding: 12px 15px;
    margin-top: 8px;
    border: none;
    border-radius: 8px;
    background: rgba(255,255,255,0.1);
    color: var(--text-light);
    font-size: 1em;
    outline: none;
    transition: 0.3s ease;
  }

  select:focus, input:focus {
    border: 1.5px solid var(--accent-color);
    background: rgba(255,255,255,0.15);
  }

  option {
    color: var(--primary-color);
  }

  button {
    width: 100%;
    padding: 12px;
    margin-top: 25px;
    background: var(--accent-color);
    color: var(--primary-color);
    font-weight: 600;
    border: none;
    border-radius: 30px;
    cursor: pointer;
    font-size: 1em;
    transition: 0.3s ease;
  }

  button:hover {
    background: transparent;
    color: var(--accent-color);
    border: 2px solid var(--accent-color);
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(243,150,28,0.4);
  }

  a.logout {
    display: inline-block;
    margin-top: 15px;
    color: var(--accent-color);
    font-weight: 500;
    text-decoration: none;
    transition: 0.3s;
  }

  a.logout:hover {
    color: var(--text-light);
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
  <div class="order-container">
    <div class="coffee-icon">☕</div>
    <h2>Hello, <?php echo htmlspecialchars($_SESSION['user_name']); ?> 👋</h2>
    <p>Pick your favorite coffee and snack!</p>

    <form method="POST">
      <label for="coffee">Coffee Type</label>
      <select name="coffee" id="coffee" required>
        <option value="Espresso">Espresso</option>
        <option value="Mocha">Macchiato</option>
        <option value="Cappuccino">Cappuccino</option>
        <option value="Latte">Latte</option>
        <option value="Mocha">Mocha</option>
        <option value="Mocha">Americano</option>
      </select>

      <label for="food">Food Item</label>
      <select name="food" id="food" required>
        <option value="Croissant">Croissant</option>
        <option value="Donut">Donut</option>
        <option value="Donut">Muffins</option>
        <option value="Sandwich">Sandwich</option>
        <option value="Burger">Burger</option>
        <option value="Burger">Tiramisu</option>
      </select>

      <label for="quantity">Quantity</label>
      <input type="number" name="quantity" id="quantity" min="1" value="1" required>

      <button type="submit">Place Order ☕</button>
      <a href="logout.php" class="logout">Logout</a>
    </form>
  </div>
</body>
</html>
