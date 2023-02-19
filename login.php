<?php

function login($username, $password) {
    $data = createPostRequest('userInfo', 'Hack', 'hacksussexDB', ['username' => $username, 'password' => $password]);

    if (empty($data['document'])) {
        echo "\033[31mIncorrect username and/or password\033[0m\n";
        return;
    }

    $userId = $data['document']['userInfo'][0]['_id'];
    echo "User ID is $userId\n";

    $foodBankName = $data['document']['foodBankName'];
    if ($data['document']['foodbank'] == 1) {
        echo "$foodBankName\n";
        grabinventoryItems($userId);
    }
}

function createPostRequest($collection, $database, $dataSource, $filter) {
    $url = 'https://eu-west-2.aws.data.mongodb-api.com/app/data-wugsm/endpoint/data/v1/action/findOne';
    $data = [
        'collection' => $collection,
        'database' => $database,
        'dataSource' => $dataSource,
        'filter' => $filter,
    ];
    $options = [
        'http' => [
            'header' => [
                'Content-Type: application/json',
                'Access-Control-Request-Headers: *',
                'api-key: KrXM0dT8X5oZLZRqvKu69knfpZzF4ouo9WDug2HxpAHJ5Z7eoNSVJCVsCpkWXYz9',
            ],
            'method' => 'POST',
            'content' => json_encode($data),
        ],
    ];
    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    return json_decode($response, true);
}

function grabinventoryItems($userId) {
    $data = createPostRequest('inventory', 'Hack', 'hacksussexDB', ['userInfo.0._id' => ['$oid' => $userId]]);
    $items = $data['documents'];
    $count = count($items);

    foreach ($items as $item) {
        print_r($item);
    }
    echo "Inventory count: $count\n";
}
?>


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

<script>
function sendLoginRequest() {
  alert("Work");
    // var username = document.getElementsByName('uname')[0].value;
    var username = "smith1023";
    // var password = document.getElementsByName('psw')[0].value;
    var password ="smithPassword";
    console.log(usernamee)
    console.log(password)
    var result = "<?php login('" + username + "', '" + password + "'); ?>";
    return false;
}

</script>


</head>
<body id="loginpage">
    <div class="loginbox">
        <h1>Login</h1>
        <div class="container">
            <label for="uname"><b>Username</b></label>
            <input type="text" placeholder="Enter Username" name="uname" required maxlength="20">

            <label for="psw"><b>Password</b></label>
            <input type="password" placeholder="Enter Password" name="psw" required maxlength="20">

            <button onclick="sendLoginRequest()" type="submit">Login</button>
          </div>
          <p>Don't have an account? <a href="signup.php">Sign up</a></p>
          <button><a href="index.php">Back</a></button>
    </div>



</body>


</html>
