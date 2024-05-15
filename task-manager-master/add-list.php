<?php 
    include('config/constants.php');
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
    
    <h3>Add List Page</h3>
    
    <p>
        <?php 
            if(isset($_SESSION['add_fail']))
            {
                echo '<div class="alert alert-danger">'.$_SESSION['add_fail'].'</div>';
                unset($_SESSION['add_fail']);
            }
        ?>
    </p>
    
    <form method="POST" action="">
        <div class="form-group">
            <label for="list_name">List Name:</label>
            <input type="text" class="form-control" id="list_name" name="list_name" placeholder="Type list name here" required>
        </div>
        
        <div class="form-group">
            <label for="list_description">List Description:</label>
            <textarea class="form-control" id="list_description" name="list_description" placeholder="Type List Description Here"></textarea>
        </div>
        
        <button type="submit" name="submit" class="btn btn-primary btn-lg">SAVE</button>
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
        
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
        $db_select = mysqli_select_db($conn, DB_NAME);
        
        $sql = "INSERT INTO tbl_list SET 
            list_name = '$list_name',
            list_description = '$list_description'";
        
        $res = mysqli_query($conn, $sql);
        
        if($res==true)
        {
            $_SESSION['add'] = "List Added Successfully";
            header('location:'.SITEURL.'manage-list.php');
        }
        else
        {
            $_SESSION['add_fail'] = "Failed to Add List";
            header('location:'.SITEURL.'add-list.php');
        }
    }
?>
