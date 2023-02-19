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