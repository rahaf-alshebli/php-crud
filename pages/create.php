<?php 
    require_once('../includes/config.php');
    
    $query = $conn->query("SELECT * FROM employees");
    
    $data = $query->fetch();
    

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
            <form action="" class="userForm" method="POST" enctype='multipart/form-data'>
                <div class="row">
                    <div class="col-25">
                        <label for="fname">Name</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="fname" name="name" placeholder="Enter your Name" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="address">Address</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="address" name="address" placeholder="Enter address" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="salary">Salary</label>
                    </div>
                    <div class="col-75">
                        <input type="text" id="salary" name="salary" placeholder="Enter Salary" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-25">
                        <label for="image">Image</label>
                    </div>
                    <div class="col-75">
                        <input type="file" id="image" name='image' />
                    </div>
                </div>
                <button class="changebutton">Add User</button>
            </form>
            
            <?php 
                if(isset($_POST['name']))
                {
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

                   if(isset($_POST["name"]) && !empty($_FILES["image"]["name"]))
                   {
                       // Allow certain file formats
                       $allowTypes = array('jpg','png','jpeg','gif','pdf');
                       if(in_array($fileType, $allowTypes))
                       {
                           // Upload file to server
                           if(move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath))
                           {
                               // Insert image file name into database
                                $insert = $conn->query("INSERT INTO employees (Name, Address, Salary, Image) VALUES ('$name', '$address', '$salary', '$fileName')");
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