<?php 
    //Include constants.php
    include('config/constants.php');
    //echo "Delete List Page";
    
    if(isset($_GET['list_id']))
    {
        //Delete the List from database
        $list_id = $_GET['list_id'];
        
        //Connect the Database
        $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
        $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
        
        $sql = "DELETE FROM tbl_list WHERE list_id=$list_id";
        
        //Execute The Query
        $res = mysqli_query($conn, $sql);
        
        //Check whether the query executed successfully or not
        if($res==true)
        {
            //Query Executed Successfully which means list is deleted successfully
            $_SESSION['delete'] = "List Deleted Successfully";
            
            //Redirect to Manage List Page
            header('location:'.SITEURL.'manage-list.php');
        }
        else
        {
            //Failed to Delete List
            $_SESSION['delete_fail'] = "Failed to Delete List.";
            header('location:'.SITEURL.'manage-list.php');
        }
    }
    else
    {
        //Redirect to Manage List Page
        header('location:'.SITEURL.'manage-list.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete List</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-info" role="alert">
            Processing list deletion...
        </div>
    </div>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
