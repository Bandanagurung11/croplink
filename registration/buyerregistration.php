<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>log in</title>
  <link rel="stylesheet" href="registration.css" />
</head>

<body>
  <div class="main">
    <div class="background">
      <div class="shape"></div>
      <div class="shape"></div>
    </div>
    <form method="post">
      <h3>Buyer registration</h3>
      <label for="name">Full Name</label>
      <input type="text" placeholder="Enter your name" id="name" name="name" required />

      <label for="phone">Phone</label>
      <input type="number" placeholder="phone number" id="phn" name="phone" required />
      <label for="email">Email ID</label>
      <input type="email" placeholder=".....@gmail.com" id="eml" name="email" />

      <label for="district">Bank Account no:</label>
      <input type="text" name="bank" id="district" placeholder="type your bank account">

      <label for="adress">Present Address</label>
      <input type="comment" placeholder="type your full address" id="add" name="address" />
      <label for="store">Store Name</label>
      <input type="text" id="str" name="store" />
      <label for="username">User Name</label>
      <input type="text" placeholder="Full name" id="username" name="username" required />

      <label for="password">password</label>
      <input type="password" placeholder="password" id="password" name="password" required />
      <label for="confirm password"> Confirm password</label>
      <input type="password" placeholder=" Confirm password" id="cfmpassword" name="confirmpassword" required />
      <button name="register">Resgister</button>
    </form>
  </div>
</body>

</html>
<?php
session_start();

include("../db/config.php");

if (isset($_POST['register'])) {

  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $phonenumber = mysqli_real_escape_string($conn, $_POST['phone']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $mail = mysqli_real_escape_string($conn, $_POST['email']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $store = mysqli_real_escape_string($conn, $_POST['store']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);
  $bank = mysqli_real_escape_string($conn, $_POST['bank']);

  $_SESSION['buyer_name'] = $username;

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

  if (strcmp($password, $confirmpassword) == 0) {

    $query = "insert into buyerregistration (buyer_name,buyer_phone,buyer_addr,buyer_store,
		buyer_mail,buyer_username,buyer_password,buyer_bank) 
		values ('$name','$phonenumber','$address','$store',
		'$mail','$username','$encryption', '$bank')";

    $run_register_query = mysqli_query($conn, $query);
    echo "<script>alert('you registered as buyer');</script>";
    echo "<script>window.open('../login.php','_self')</script>";
  } else if (strcmp($password, $confirmpassword) != 0) {
    echo "<script>
			alert('Password and Confirm Password Should be same');
		</script>";
  }
}


?>