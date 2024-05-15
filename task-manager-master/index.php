<?php 
    include('config/constants.php');
?>

<!DOCTYPE html>
<html>

<head>
    <title>Task Manager with PHP and MySQL</title>
    <!-- Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo SITEURL; ?>css/style.css" />
</head>

<body>

<div class="container mt-4">
    <h1 class="text-center">Homework Manager</h1>

    <!-- Menu Starts Here -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="<?php echo SITEURL; ?>">Home</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav mr-auto">
                <?php 
                    $conn2 = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn2));
                    $db_select2 = mysqli_select_db($conn2, DB_NAME) or die(mysqli_error($conn2));
                    
                    $sql2 = "SELECT * FROM tbl_list";
                    $res2 = mysqli_query($conn2, $sql2);
                    
                    if($res2==true)
                    {
                        while($row2=mysqli_fetch_assoc($res2))
                        {
                            $list_id = $row2['list_id'];
                            $list_name = $row2['list_name'];
                            ?>
                            <li class="nav-item">
                                <a class="nav-link" href="<?php echo SITEURL; ?>list-task.php?list_id=<?php echo $list_id; ?>"><?php echo $list_name; ?></a>
                            </li>
                            <?php
                        }
                    }
                ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo SITEURL; ?>manage-list.php">Manage Lists</a>
                </li>
            </ul>
        </div>
    </nav>
    <!-- Menu Ends Here -->

    <!-- Tasks Starts Here -->
    <div class="mt-4">
        <div class="alert alert-info">
            <?php 
                if(isset($_SESSION['add'])) {
                    echo $_SESSION['add'];
                    unset($_SESSION['add']);
                }
                if(isset($_SESSION['delete'])) {
                    echo $_SESSION['delete'];
                    unset($_SESSION['delete']);
                }
                if(isset($_SESSION['update'])) {
                    echo $_SESSION['update'];
                    unset($_SESSION['update']);
                }
                if(isset($_SESSION['delete_fail'])) {
                    echo $_SESSION['delete_fail'];
                    unset($_SESSION['delete_fail']);
                }
            ?>
        </div>
        <a class="btn btn-primary mb-3" href="<?php echo SITEURL; ?>add-task.php">Add Task</a>
        
        <table class="table table-bordered">
            <thead class="thead-dark">
                <tr>
                    <th>S.N.</th>
                    <th>Task Name</th>
                    <th>Priority</th>
                    <th>Deadline</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysqli_error($conn));
                    $db_select = mysqli_select_db($conn, DB_NAME) or die(mysqli_error($conn));
                    
                    $sql = "SELECT * FROM tal_tasks";
                    $res = mysqli_query($conn, $sql);
                    
                    if($res==true)
                    {
                        $count_rows = mysqli_num_rows($res);
                        $sn=1;
                        
                        if($count_rows>0)
                        {
                            while($row=mysqli_fetch_assoc($res))
                            {
                                $task_id = $row['task_id'];
                                $task_name = $row['task_name'];
                                $priority = $row['priority'];
                                $deadline = $row['deadline'];
                                ?>
                                <tr>
                                    <td><?php echo $sn++; ?>. </td>
                                    <td><?php echo $task_name; ?></td>
                                    <td><?php echo $priority; ?></td>
                                    <td><?php echo $deadline; ?></td>
                                    <td>
                                        <a class="btn btn-warning btn-sm" href="<?php echo SITEURL; ?>update-task.php?task_id=<?php echo $task_id; ?>">Update</a>
                                        <a class="btn btn-danger btn-sm" href="<?php echo SITEURL; ?>delete-task.php?task_id=<?php echo $task_id; ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        else
                        {
                            ?>
                            <tr>
                                <td colspan="5" class="text-center">No Task Added Yet.</td>
                            </tr>
                            <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Tasks Ends Here -->
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
