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

  function main() {
    $username = "SammyUser";
    $password = "myPassword1234";
    login($username, $password);
  }

  main();
