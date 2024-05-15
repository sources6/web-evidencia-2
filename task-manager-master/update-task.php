<?php 
    include('config/constants.php');
    
    // Check the Task ID in URL
    if(isset($_GET['task_id']))
    {
        // Get the Values from Database
        $task_id = $_GET['task_id'];
        
        // Connect Database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
        
        // Select Database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
        
        // SQL Query to Get the detail of selected task
        $sql = "SELECT * FROM tal_tasks WHERE task_id=$task_id";
        
        // Execute Query
        $res = mysqli_query($conn, $sql);
        
        // Check if the query executed successfully or not
        if($res==true)
        {
            // Query Executed
            $row = mysqli_fetch_assoc($res);
            
            // Get the Individual Value
            $task_name = $row['task_name'];
            $task_description = $row['task_description'];
            $list_id = $row['list_id'];
            $priority = $row['priority'];
            $deadline = $row['deadline'];
        }
    }
    else
    {
        // Redirect to Homepage
        header('location:'.SITEURL);
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
    </div>
    
    <h3>Update Task Page</h3>
    
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
            <label for="task_name">Task Name:</label>
            <input type="text" class="form-control" id="task_name" name="task_name" value="<?php echo $task_name; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="task_description">Task Description:</label>
            <textarea class="form-control" id="task_description" name="task_description" rows="4"><?php echo $task_description; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="list_id">Select List:</label>
            <select class="form-control" id="list_id" name="list_id">
                <?php 
                    // Connect Database
                    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn2));
                    
                    // Select Database
                    $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error($conn2));
                    
                    // SQL Query to GET Lists
                    $sql2 = "SELECT * FROM tbl_list";
                    
                    // Execute Query
                    $res2 = mysqli_query($conn2, $sql2);
                    
                    // Check if executed successfully or not
                    if($res2==true)
                    {
                        // Display the Lists
                        // Count Rows
                        $count_rows2 = mysqli_num_rows($res2);
                        
                        // Check whether list is added or not
                        if($count_rows2>0)
                        {
                            // Lists are Added
                            while($row2=mysqli_fetch_assoc($res2))
                            {
                                // Get individual value
                                $list_id_db = $row2['list_id'];
                                $list_name = $row2['list_name'];
                                ?>
                                <option <?php if($list_id_db==$list_id){echo "selected";} ?> value="<?php echo $list_id_db; ?>"><?php echo $list_name; ?></option>
                                <?php
                            }
                        }
                        else
                        {
                            // No List Added
                            // Display None as option
                            ?>
                            <option value="0">None</option>
                            <?php
                        }
                    }
                ?>
            </select>
        </div>
        
        <div class="form-group">
            <label for="priority">Priority:</label>
            <select class="form-control" id="priority" name="priority">
                <option <?php if($priority=="High"){echo "selected";} ?> value="High">High</option>
                <option <?php if($priority=="Medium"){echo "selected";} ?> value="Medium">Medium</option>
                <option <?php if($priority=="Low"){echo "selected";} ?> value="Low">Low</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="deadline">Deadline:</label>
            <input type="date" class="form-control" id="deadline" name="deadline" value="<?php echo $deadline; ?>">
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
    // Check if the button is clicked
    if(isset($_POST['submit']))
    {
        // Get the Values from Form
        $task_name = $_POST['task_name'];
        $task_description = $_POST['task_description'];
        $list_id = $_POST['list_id'];
        $priority = $_POST['priority'];
        $deadline = $_POST['deadline'];
        
        // Connect Database
        $conn3 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn3));
        
        // Select Database
        $db_select3 = mysqli_select_db($conn3, DB_NAME) or die(mysqli_error($conn3));
        
        // CREATE SQL Query to Update Task
        $sql3 = "UPDATE tal_tasks SET 
        task_name = '$task_name',
        task_description = '$task_description',
        list_id = '$list_id',
        priority = '$priority',
        deadline = '$deadline'
        WHERE task_id = $task_id";
        
        // Execute Query
        $res3 = mysqli_query($conn3, $sql3);
        
        // Check whether the Query Executed or Not
        if($res3==true)
        {
            // Query Executed and Task Updated
            $_SESSION['update'] = "Task Updated Successfully.";
            
            // Redirect to Home Page
            header('location:'.SITEURL);
        }
        else
        {
            // Failed to Update Task
            $_SESSION['update_fail'] = "Failed to Update Task";
            
            // Redirect to this Page
            header('location:'.SITEURL.'update-task.php?task_id='.$task_id);
        }
    }
?>
