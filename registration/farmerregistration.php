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
      <h3>Farmer registration</h3>
      <label for="name"> Full Name</label>
      <input type="text" placeholder="Enter your name" id="name" name="name" required />

      <label for="phone">Phone</label>
      <input type="number" placeholder="phone number" maxlength="10" size="10" id="phone" name="phonenumber" required />

      <label for="adress">Present Address</label>
      <textarea type="text" id="present_address" rows="4" name="address" placeholder="  Address" required></textarea>

      <label for="province">Province</label>
      <input type="number" placeholder="your province" id="porvince" name="province" max="7" min="1" required />

      <label for="district">District:</label>
      <input type="text" name="district" id="district" placeholder="type your district name" required>

      <label for="district">Bank Account no:</label>
      <input type="text" name="bank" id="bank" placeholder="type your bank account" required>

      <label for="store">Store Name</label>
      <input type="text" id="str" name="storename" />

      <label for="username">User Name</label>
      <input type="text" id="username" name="username" class="form-control" required />

      <label for="password">password</label>
      <input type="password" name="password" autocomplete="current-password" placeholder="password" id="password" required>

      <label for="confirm password"> Confirm password</label>
      <input type="password" placeholder=" Confirm password" id="cfmpassword" name="confirmpassword" />

      <button name="register">Register</button>
  </div>
  </form>
  </div>
</body>

</html>

<?php

include("../db/config.php");

$ciphering = "AES-128-CTR";
$iv_length = openssl_cipher_iv_length($ciphering);
$options = 0;
$encryption_iv = '2345678910111211';
$encryption_key = "DE";

if (isset($_POST['register'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);
  $district = mysqli_real_escape_string($conn, $_POST['district']);
  $state = mysqli_real_escape_string($conn, $_POST['province']);
  $bank = mysqli_real_escape_string($conn, $_POST['bank']);
  $storename = mysqli_real_escape_string($conn, $_POST['storename']);

  $encryption = openssl_encrypt(
    $password,
    $ciphering,
    $encryption_key,
    $options,
    $encryption_iv
  );
  // echo $encryption;

  if (strcmp($password, $confirmpassword) == 0) {

    $query = "insert into farmerregistration (farmer_name, farmer_phone,
                farmer_address, farmer_province, farmer_district, farmer_username,
                farmer_password, farmer_bank, farmer_strname) 
                values ('$name','$phonenumber','$address',
                '$state','$district', '$username',
                '$encryption', '$bank', '$storename')";

    $run_register_query = mysqli_query($conn, $query);
    echo "<script>alert('you registered as farmer');</script>";
    echo "<script>window.open('../login.php','_self')</script>";
  } else if (strcmp($password, $confirmpassword) != 0) {
    echo "<script>
                  alert('Password and Confirm Password Should be same');
                </script>";
  }
}


?>