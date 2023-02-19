<?php

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
        if ($userInfo['document']['foodbank'] == true) {
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
  function main() {
    $username = "SammyUser";
    $password = "myPassword1234";
    login($username, $password);
  }
  
  main();
  