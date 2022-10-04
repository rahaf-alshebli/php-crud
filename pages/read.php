<?php 
    require_once('../includes/config.php');
    require_once('../includes/config.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details</title>
    
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <?php 
        $id = $_GET['view'];
        $getData = $conn->query("SELECT * FROM employees WHERE id = '$id'");
        
        $data = $getData->fetch();
    ?>
    <div class="userContainer">
        <div class="details">
            <div class="recentUsers">
                <div class="cardHeader">
                    <h2>User Details</h2>
                </div>
                <table>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Salary</th>
                    </tr>
                    <tr>
                        <td><?php echo $data['id']; ?></td>
                        <td class="readName">
                            <div class="userImage">
                                <img src="../images/<?php echo $data['Image']; ?>" alt="user image">
                            </div>
                            <div class="userName">
                                <?php echo $data['Name']; ?>
                            </div>
                        </td>
                        <td><?php echo $data['Address']; ?></td>
                        <td><?php echo $data['Salary']; ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <p><a href="index.php" class="btn btn-primary">Back</a></p>

</body>
</html>