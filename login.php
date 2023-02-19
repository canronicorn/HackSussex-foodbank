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
  alert("Work");
    var username = document.getElementsByName('uname')[0].value;
    var password = document.getElementsByName('psw')[0].value;
    console.log(usernamee)
    console.log(password)
    var result = "<?php login('" + username + "', '" + password + "'); ?>";
    return false;
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

  function createPostRequest($collection, $database, $dataSource, $filter) {
    $url = 'https://eu-west-2.aws.data.mongodb-api.com/app/data-wugsm/endpoint/data/v1/action/findOne';
    $data = array(
      'collection' => $collection,
      'database' => $database,
      'dataSource' => $dataSource,
      'filter' => $filter
    );
    $headers = array(
      'Content-Type: application/json',
      'Access-Control-Request-Headers: *',
      'api-key: KrXM0dT8X5oZLZRqvKu69knfpZzF4ouo9WDug2HxpAHJ5Z7eoNSVJCVsCpkWXYz9'
    );
  
    $options = array(
      'http' => array(
        'header' => $headers,
        'method' => 'POST',
        'content' => json_encode($data),
      ),
    );
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);
  }
  
  function grabUserInfo($userId) {
    $data = createPostRequest('userInfo', 'Hack', 'hacksussexDB', array('_id' => array('$oid' => $userId)));
    return $data;
  }
  
  function grabinventoryItems($userId) {
    $url = 'https://eu-west-2.aws.data.mongodb-api.com/app/data-wugsm/endpoint/data/v1/action/find';
    $data = array(
      'collection' => 'inventory',
      'database' => 'Hack',
      'dataSource' => 'hacksussexDB',
      'filter' => array('userInfo.0._id' => array('$oid' => $userId))
    );
    $headers = array(
      'Content-Type: application/json',
      'Access-Control-Request-Headers: *',
      'api-key: KrXM0dT8X5oZLZRqvKu69knfpZzF4ouo9WDug2HxpAHJ5Z7eoNSVJCVsCpkWXYz9'
    );
  
    $options = array(
      'http' => array(
        'header' => $headers,
        'method' => 'POST',
        'content' => json_encode($data),
      ),
    );
    $context  = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $data = json_decode($response, true);
    $count = 0;
    foreach ($data['documents'] as $item) {
      print_r($item);
      $count++;
    }
    print_r($count);
  }