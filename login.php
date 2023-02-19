<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css"/>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href='https://fonts.googleapis.com/css?family=Wire+One|Raleway:300' rel="stylesheet">
    <title>Log In</title>
</head>
<body id="loginpage">
    <div class="loginbox">
        <h1>Login</h1>
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required maxlength="20">

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required maxlength="20">

            <button onclick="send_login_request()" type="submit">Login</button>
          </div>
          <p>Don't have an account? <a href="signup.php">Sign up</a></p>
          <button><a href="index.php">Back</a></button>
    </div>



</body>

<script>
function send_login_request() {
    var username = document.getElementsByName('uname')[0].value;
    var password = document.getElementsByName('psw')[0].value;
    console.log(usernamee)
    console.log(password)
    var result = "<?php login('" + username + "', '" + password + "'); ?>";
}

</script>

</html>


<?php
function login($username, $password) {
    try {
      $data = createPostRequest('Login', 'Hack', 'hacksussexDB', ['username' => $username, 'password' => $password]);
      if ($data['document'] == null) {
        echo "\033[31mIncorrect user login username and/or password\033[0m\n";
        return;
      } else {
        $userId = $data['document']['userInfo'][0]['_id'];
        echo "user id is $userId\n";
        $userInfo = grabUserInfo($userId);
        if ($userInfo['document']['foodbank'] == 1) {
          echo "Food bank login\n";
          echo $userInfo['document']['foodBankName'] . "\n";
          grabinventoryItems($userId);
        }
      }
    } catch (Exception $error) {
      echo "\033[31mWe have an error in login\033[0m\n";
      echo "\033[31m" . $error->getMessage() . "\033[0m\n";
    }
  }
