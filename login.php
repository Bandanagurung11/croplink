<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>log in</title>
  <link rel="stylesheet" href="login.css" />
</head>

<body>
  <div class="main">
    <div class="background">
      <div class="shape"></div>
      <div class="shape"></div>
    </div>
    <form method="post">
      <h3>log in here</h3>
      <label for="username"> Phone Number</label>
      <input type="text" placeholder="Phone Number" id="username" name="phone" required />
      <label for="password">Password</label>
      <input type="password" name="password" id="password" placeholder="Password" required />
      <!--
        <span id="togglePassword" onclick="togglePasswordVisibility()">👁️</span>

      <script>
        function togglePasswordVisibility() {
          const password = document.querySelector("#password");
          const toggleIcon = document.querySelector("#togglePassword");

          if (password.getAttribute("type") === "password") {
            password.setAttribute("type", "text");
            toggleIcon.textContent = "👁️"; // Use an open eye emoji
          } else {
            password.setAttribute("type", "password");
            toggleIcon.textContent = "👁️"; // Use a crossed-out eye emoji
          }
        }
      </script>-->


      <button name="login">log in</button>
      <div class="social">
        <div class="go">
          <span class="try"><a href="forgotpassword.php">forgot password</a></span>
        </div>
      </div>
      <br /><br />
      <div class="fb">
        Did you have an account?
        <span class="try"><a href=" sgn.html ">sign up</a></span>
      </div>
    </form>
  </div>
</body>

</html>

<?php

session_start();

include("./db/config.php");

if (isset($_POST['login'])) {
  $phone = $_POST['phone'];
  $password = $_POST['password'];

  $ciphering = "AES-128-CTR";
  $iv_length = openssl_cipher_iv_length($ciphering);
  $options = 0;
  $encryption_iv = '2345678910111211';
  $encryption_key = "DE";

  $encryption = openssl_encrypt(
    $password,
    $ciphering,
    $encryption_key,
    $options,
    $encryption_iv
  );

  $query = "SELECT 'buyer' AS user_type, buyer_id AS id, buyer_addr AS addr, buyer_username AS username 
  FROM buyerregistration
  WHERE buyer_phone = ? AND buyer_password = ?
  UNION
  SELECT 'farmer' AS user_type, farmer_id AS id, NULL AS address, farmer_username AS username 
  FROM farmerregistration
  WHERE farmer_phone = ? AND farmer_password = ?";

  $stmt = $conn->prepare($query);
  $stmt->bind_param("ssss", $phone, $encryption, $phone, $encryption);
  $stmt->execute();
  $result = $stmt->get_result();
  $row = $result->fetch_assoc();

  if ($row) {
    $_SESSION['user_name'] = $row['username']; // Set the matched username in the session
    $_SESSION['user_type'] = $row['user_type'];
    $_SESSION['user_address'] = $row['addr'];


    if ($_SESSION['user_type'] == 'buyer') {
      $_SESSION['role'] = 'buyer';
      echo "<script>window.open('buyerprofile/home.php','_self')</script>";
      exit;
    } elseif ($_SESSION['user_type'] == 'farmer') {
      $_SESSION['role'] = 'farmer';
      echo "<script>window.open('farmerprofile/fhome.php','_self')</script>";
      exit;
    }
  } else {
    echo "<script>alert('Please Enter Valid Details');</script>";
    echo "<script>window.open('login.php','_self')</script>";
  }

  $stmt->close();
}

if (isset($_GET['logout'])) {
  session_destroy();
  header("Location: login.php");
  exit;
}

$conn->close();

?>