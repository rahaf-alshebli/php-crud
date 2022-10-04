<?php 
    require_once('includes/config.php');
    require_once('main/index.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome Page</title>
    
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <section class="employeeContainer">
        <div class="details">
            <div class="recentUsers">
                <div class="cardHeader">
                    <h2>All Users</h2>
                    <a href="pages/create.php" class="btn">Add User</a>
                </div>
                <table>
                    <thead>
                        <th>#</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Salary</th>
                        <th>Action</th>
                    </thead>
                    <tbody>
                        <?php
                            $fetch_products = $conn->query("SELECT * FROM employees");
                            while($data = $fetch_products->fetch())
                            {
                        ?>
                        <tr>
                            <td><?php echo $data['id']; ?></td>
                            <td><?php echo $data['Name']; ?></td>
                            <td><?php echo $data['Address']; ?></td>
                            <td><?php echo $data['Salary']; ?></td>
                            <td>
                                <a href="pages/read.php?view=<?php echo $data['id']; ?>" class="status"><ion-icon name="eye-outline"></ion-icon></a>
                                <a href="pages/update.php?edit=<?php echo $data['id']; ?>"><ion-icon name="pencil-outline"></ion-icon></a>
                                <a href="pages/delete.php?delete=<?php echo $data['id']; ?>"><ion-icon name="trash-outline"></ion-icon></a>
                                
                            </td>
                        </tr>

                        <?php
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</body>
</html>