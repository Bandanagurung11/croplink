<?php include("./db/config.php") ?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in</title>
    <link rel="stylesheet" href="login.css">
</head>

<body>
    <div class="main">
        <div class="background">
            <div class="shape"></div>
            <div class="shape"></div>
        </div>
        <form method="post">
            <h3>Forgot Password</h3>
            <label for="username">Phone Number</label>
            <input type="text" placeholder="phone number" id="username" name="phonenumber">
            <label for="password">password</label>
            <input type="password" placeholder="New password" id="password" name="password">
            <label for="uppsw">Confirm password</label>
            <input type="password" placeholder=" Confirm password" id="passwd" name="confirmpassword">
            <button name="register">
                Update Password
            </button>
    </div>

    </form>
</body>

</html>

<?php
include("./db/config.php");

if (isset($_POST['register'])) {
    $phonenumber = mysqli_real_escape_string($conn, $_POST['phonenumber']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmpassword = mysqli_real_escape_string($conn, $_POST['confirmpassword']);

    $query = "SELECT 'farmer' AS user_type, farmer_id AS id, NULL AS buyer_id 
    FROM farmerregistration
    WHERE farmer_phone = '$phonenumber'
    UNION
    SELECT 'buyer' AS user_type, NULL AS id, buyer_id 
    FROM buyerregistration
    WHERE buyer_phone = '$phonenumber'";

    $run_query = mysqli_query($conn, $query);
    $count_rows = mysqli_num_rows($run_query);

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
        if ($count_rows != 0) {
            $update_query = "update farmerregistration set farmer_password = '$encryption' 
                                 where farmer_phone = '$phonenumber' ";

            $run_query = mysqli_query($conn, $update_query);

            echo "<script>alert('Password Updated Successfully');</script>";
            echo "<script>window.open('login.php','_self')</script>";
        } else if ($count_rows == 0) {
            echo "<script>alert('password must be same');</script>";
        }
    } else {
        echo "<script>alert('Please Enter valid phone number');</script>";
    }
}

?>