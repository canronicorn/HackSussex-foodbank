<<<<<<< HEAD

<!DOCTYPE html>
<html>
<head>
    <title></title>
</head>
<body>



</body>
</html>
=======
<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:hacksussex-foodbank-sql.database.windows.net,1433; Database = hacksussex-foodbank-sqldatabase", "foodBankAdmin", "{your_password_here}");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "foodBankAdmin", "pwd" => "{your_password_here}", "Database" => "hacksussex-foodbank-sqldatabase", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:hacksussex-foodbank-sql.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);
?>
>>>>>>> master
