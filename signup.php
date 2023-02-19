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
    <title>Sign up</title>
</head>
<body id="loginpage">
    <div class="loginbox">
        <h1>Sign up</h1>
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required maxlength="20">
      
            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required maxlength="20">
            <label>
                <input type="checkbox" name="seekingfood"> I'm seeking food
              </label>
              <label>
                <input type="checkbox" name="donatingfood"> I'm donating food
              </label>
              <label>
                <input type="checkbox" name="afoodbank"> I'm a foodbank
              </label>
              <button onclick="send_login_request('uname','psw', getSelectedCheckboxValue())" type="submit">Sign up</button>
            <p>Already have an account? <a href="login.php">Log in</a></p>

            <button><a href="index.php">Back</a></button>
          </div>

    </div>
    
</body>
<script>
function getSelectedCheckboxValue() {
  var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
  var values = [];
  checkboxes.forEach(function(checkbox) {
    switch(checkbox.name) {
      case "seekingfood":
        values.push(0);
        break;
      case "donatingfood":
        values.push(2);
        break;
      case "afoodbank":
        values.push(1);
        break;
    }
  });
  return values;
}

function send_login_request(username, password, foodbank) {
  var result = "<?php addNewUser($username, $password, $foodbank); ?>"
}
</script>

</html>
<?php
function addNewUser($username, $password, $foodbank) {
  $url = 'https://eu-west-2.aws.data.mongodb-api.com/app/data-wugsm/endpoint/data/v1/action/create';
  $data = array(
    'collection' => 'userInfo',
    'database' => 'Hack',
    'dataSource' => 'hacksussexDB',
    'document' => array(
      'username' => $username,
      'password' => $password,
      'foodbank' => $foodbank
    )
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
