<?php 
    require_once('../includes/config.php');
    
    if(isset($_GET['edit']))
    {
        $id = $_GET['edit'];
    }
    

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
    
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="details">
        <div class="recentUsers">
            <div class="cardHeader">
                <h2>Add User</h2>
            </div>
            <form action="" class="userForm" method="POST" enctype="multipart/form-data">
                <?php
                     $getData = $conn->query("SELECT * FROM employees WHERE id = '$id'");
                     
                     $data = $getData->fetch();
                     
                ?>
                
                <div class="row">
                    <div class="col-25">
                        <label for="id">Id</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="id" name="id" value="<?php echo $data['id']; ?>" readonly>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="name" value="<?php echo $data['Name']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="address">Address</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="address" name="address" value="<?php echo $data['Address']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="salary">Salary</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="salary" name="salary" value="<?php echo $data['Salary']; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="image">Image</label>
                    </div>
                    <div class="col-75">
                        <input type="file" id="image" name="image">
                    </div>
                </div>
                <button class="changebutton">Edit User</button>
            </form>
            <?php 
                if(isset($_POST['name']))
                {
                    $id = $_POST['id'];
                    $name = $_POST['name'];
                    $address = $_POST['address'];
                    $salary = $_POST['salary'];
                    //$image = $_POST['image'];
                    
                    $statusMsg = '';
                    
                    // File upload path
                    $targetDir = "../images/";
                    $fileName = basename($_FILES["image"]["name"]);
                    $targetFilePath = $targetDir . $fileName;
                    $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);

                    if(isset($_POST["name"]) && !empty($_FILES["image"]["name"])){
                        // Allow certain file formats
                        $allowTypes = array('jpg','png','jpeg','gif','pdf');
                        if(in_array($fileType, $allowTypes)){
                            // Upload file to server
                            if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)){
                                // Insert image file name into database
                                $insert = $conn->query("UPDATE employees SET id = '$id', Name = '$name', Address = '$address', Salary = '$salary', Image = '$fileName' WHERE id = '$id'");
                                if($insert){
                                    $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                                    header("Location: ../index.php");
                                }else{
                                    $statusMsg = "File upload failed, please try again.";
                                } 
                            }else{
                                $statusMsg = "Sorry, there was an error uploading your file.";
                            }
                        }else{
                            $statusMsg = 'Sorry, only JPG, JPEG, PNG, GIF, & PDF files are allowed to upload.';
                        }
                    }else{
                        $statusMsg = 'Please select a file to upload.';
                    }

                    // Display status message
                    echo $statusMsg;
                }
            ?>
        </div>
    </div>
</body>
</html>