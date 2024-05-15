<?php 
    include('config/constants.php');
    
    //Check task_id in URL
    if(isset($_GET['task_id']))
    {
        //Delete the Task from Database
        //Get the Task ID
        $task_id = $_GET['task_id'];
        
        //Connect Database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
        
        //Select Database
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
        
        //SQL Query to DELETE TASK
        $sql = "DELETE FROM tal_tasks WHERE task_id=$task_id";
        
        //Execute Query
        $res = mysqli_query($conn, $sql);
        
        //Check if the Query Executed Successfully or Not
        if($res==true)
        {
            //Query Executed Successfully and Task Deleted
            $_SESSION['delete'] = "Task Deleted Successfully.";
            
            //redirect to Homepage
            header('location:'.SITEURL);
        }
        else
        {
            //Failed to Delete Task
            $_SESSION['delete_fail'] = "Failed to Delete Task";
            
            //Redirect to Home Page
            header('location:'.SITEURL);
        }
        
    }
    else
    {
        //Redirect to Home
        header('location:'.SITEURL);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Task</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-info" role="alert">
            Processing task deletion...
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
