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
    
    <h3>Add Task Page</h3>
    
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
            <label for="task_name">Task Name:</label>
            <input type="text" class="form-control" id="task_name" name="task_name" placeholder="Type your Task Name" required>
        </div>
        
        <div class="form-group">
            <label for="task_description">Task Description:</label>
            <textarea class="form-control" id="task_description" name="task_description" placeholder="Type Task Description"></textarea>
        </div>
        
        <div class="form-group">
            <label for="list_id">Select List:</label>
            <select class="form-control" id="list_id" name="list_id">
                <?php 
                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
                    
                    $sql = "SELECT * FROM tbl_list";
                    $res = mysqli_query($conn, $sql);
                    
                    if($res==true)
                    {
                        $count_rows = mysqli_num_rows($res);
                        
                        if($count_rows>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $list_id = $row['list_id'];
                                $list_name = $row['list_name'];
                                echo "<option value='$list_id'>$list_name</option>";
                            }
                        }
                        else
                        {
                            echo "<option value='0'>None</option>";
                        }
                    }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="priority">Priority:</label>
            <select class="form-control" id="priority" name="priority">
                <option value="High">High</option>
                <option value="Medium">Medium</option>
                <option value="Low">Low</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="deadline">Deadline:</label>
            <input type="date" class="form-control" id="deadline" name="deadline">
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
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];
        
        $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn2));
        $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error($conn2));
        
        $sql2 = "INSERT INTO tal_tasks SET 
            task_name = '$task_name',
            task_description = '$task_description',
            list_id = $list_id,
            priority = '$priority',
            deadline = '$deadline'";
        
        $res2 = mysqli_query($conn2, $sql2);
        
        if($res2==true)
        {
            $_SESSION['add'] = "Task Added Successfully.";
            header('location:'.SITEURL);
        }
        else
        {
            $_SESSION['add_fail'] = "Failed to Add Task";
            header('location:'.SITEURL.'add-task.php');
        }
    }
?>
