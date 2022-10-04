<?php 

require_once('../includes/config.php');


if(isset($_GET['delete']))
{
    $deleteID = $_GET['delete'];
    
    $DELETE = $conn->query("DELETE FROM employees WHERE id = '$deleteID'");

    if($DELETE)
    {
        ?>
        <script>
            alert("User has been Deleted successfully");
            window.location.href = "../index.php";
        </script>
        <?php    
    }
    else
    {
        ?>
        <script>
            alert("Error Deleting record: ".<?php mysqli_error($conn)?>);
            window.location.href = "../index.php";
        </script>
        <?php
    }
}
?>
