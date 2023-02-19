<<<<<<< HEAD
<?php
    include_once 'test2.php';
?>

<!DOCTYPE html>
<html>
<head>
<script type="text/javascript" src="script.js"></script>
    <title></title>
</head>
<body>
<main>
    ananas
</main>
<table>
    <tr>
        <th>GFG UserHandle</th>
        <th>Practice Problems</th>
        <th>Coding Score</th>
        <th>GFG Articles</th>
    </tr>
    <!-- PHP CODE TO FETCH DATA FROM ROWS -->
    <?php
        // LOOP TILL END OF DATA
        while($rows=$result->fetch_assoc())
        {
    ?>
    <tr>
        <!-- FETCHING DATA FROM EACH ROW OF EVERY COLUMN -->
        <td><?php echo $rows['username'];?></td>
        <td><?php echo $rows['problems'];?></td>
        <td><?php echo $rows['score'];?></td>
        <td><?php echo $rows['articles'];?></td>
    </tr>
    <?php
        }
    ?>
</table>

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
