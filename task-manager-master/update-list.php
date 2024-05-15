<?php 
    include('config/constants.php'); 

    //Get the Current Values of Selected List
    if(isset($_GET['list_id']))
    {
        //Get the List ID value
        $list_id = $_GET['list_id'];
        
        //Connect to Database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
        
        //Select Database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
        
        //Query to Get the Values from Database
        $sql = "SELECT * FROM tbl_list WHERE list_id=$list_id";
        
        //Execute Query
        $res = mysqli_query($conn, $sql);
        
        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Get the Value from Database
            $row = mysqli_fetch_assoc($res); //Value is in array

            //Create Individual Variable to save the data
            $list_name = $row['list_name'];
            $list_description = $row['list_description'];
        }
        else
        {
            //Go Back to Manage List Page
            header('location:'.SITEURL.'manage-list.php');
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager with PHP and MySQL</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
</head>
<body>

<div class="container mt-4">
    <h1 class="text-center">Homework Manager</h1>

    <div class="mb-4">
        <a class="btn btn-secondary" href="<?php echo SITEURL; ?>">Home</a>
        <a class="btn btn-secondary" href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
    </div>
    
    <h3>Update List Page</h3>
    
    <p>
        <?php 
            if(isset($_SESSION['update_fail']))
            {
                echo '<div class="alert alert-danger">'.$_SESSION['update_fail'].'</div>';
                unset($_SESSION['update_fail']);
            }
        ?>
    </p>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="list_name">List Name:</label>
            <input type="text" class="form-control" id="list_name" name="list_name" value="<?php echo $list_name; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="list_description">List Description:</label>
            <textarea class="form-control" id="list_description" name="list_description"><?php echo $list_description; ?></textarea>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary btn-lg">UPDATE</button>
    </form>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php 
    if(isset($_POST['submit']))
    {
        $list_name = $_POST['list_name'];
        $list_description = $_POST['list_description'];
        
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn2));
        $db_select2 = mysqli_select_db($conn2, DB_NAME);
        
        $sql2 = "UPDATE tbl_list SET 
            list_name = '$list_name',
            list_description = '$list_description' 
            WHERE list_id=$list_id";
        
        $res2 = mysqli_query($conn2, $sql2);
        
        if($res2==true)
        {
            $_SESSION['update'] = "List Updated Successfully";
            header('location:'.SITEURL.'manage-list.php');
        }
        else
        {
            $_SESSION['update_fail'] = "Failed to Update List";
            header('location:'.SITEURL.'update-list.php?list_id='.$list_id);
        }
    }
?>
