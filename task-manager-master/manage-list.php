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
    </div>
    
    <h3>Manage Lists Page</h3>
    
    <p>
        <?php 
            if(isset($_SESSION['add']))
            {
                echo '<div class="alert alert-success">'.$_SESSION['add'].'</div>';
                unset($_SESSION['add']);
            }
            
            if(isset($_SESSION['delete']))
            {
                echo '<div class="alert alert-success">'.$_SESSION['delete'].'</div>';
                unset($_SESSION['delete']);
            }
            
            if(isset($_SESSION['update']))
            {
                echo '<div class="alert alert-success">'.$_SESSION['update'].'</div>';
                unset($_SESSION['update']);
            }
            
            if(isset($_SESSION['delete_fail']))
            {
                echo '<div class="alert alert-danger">'.$_SESSION['delete_fail'].'</div>';
                unset($_SESSION['delete_fail']);
            }
        ?>
    </p>
    
    <!-- Table to display lists starts here -->
    <div class="mb-4">
        <a class="btn btn-primary" href="<?php echo SITEURL; ?>add-list.php">Add List</a>
    </div>
    
    <table class="table table-bordered">
        <thead class="thead-dark">
            <tr>
                <th>S.N.</th>
                <th>List Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
                $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
                
                $sql = "SELECT * FROM tbl_list";
                $res = mysqli_query($conn, $sql);
                
                if($res==true)
                {
                    $count_rows = mysqli_num_rows($res);
                    $sn = 1;
                    
                    if($count_rows>0)
                    {
                        while($row=mysqli_fetch_assoc($res))
                        {
                            $list_id = $row['list_id'];
                            $list_name = $row['list_name'];
                            ?>
                            <tr>
                                <td><?php echo $sn++; ?>. </td>
                                <td><?php echo $list_name; ?></td>
                                <td>
                                    <a class="btn btn-warning btn-sm" href="<?php echo SITEURL; ?>update-list.php?list_id=<?php echo $list_id; ?>">Update</a> 
                                    <a class="btn btn-danger btn-sm" href="<?php echo SITEURL; ?>delete-list.php?list_id=<?php echo $list_id; ?>">Delete</a>
                                </td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td colspan="3" class="text-center">No List Added Yet.</td>
                        </tr>
                        <?php
                    }
                }
            ?>
        </tbody>
    </table>
    <!-- Table to display lists ends here -->
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
