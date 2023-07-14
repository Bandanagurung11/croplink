<?php include("./db/config.php") ?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>log in</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <div class="background">
        <div class="shape"></div>
        <div class="shape"></div>
    </div>
    <form mathod="post">
        <h3>log in here</h3>
        <label for="username">name</label>
        <input type="text" placeholder="email or phone" id="username" name="n1">
        <label for="password">password</label>
        <input type="password" placeholder="password" id="password" name="psw">
        <button>log in</button>
        <div class="social">
            <div class="go">
                <span class="try"><a href="#">forgot password</a></span>
            </div>          
        </div>
        <br><br>
        <div class="fb">
            Did you have an account?
            <span class="try"><a href=" sgn.html ">sign up</a></span>
        </div>

    </form>
</body>
</html>
