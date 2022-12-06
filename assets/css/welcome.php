<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: login.php");
    exit;
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
<div class="registration-form">
        

        <?php 
        if(!empty($login_err)){
            echo '<div class="alert alert-danger">' . $login_err . '</div>';
        }        
        ?>

        <form>
            <h1 class="my-1">Welcome, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
            <h2>Choose What you want to do!</h2>
            <!-- Username input -->
            <div class="mt-3">
                <p>Contact Management</p>
                <a href="addNew.php" class="btn btn-success">Add Contacts</a>
                <a href="contactlist.php" class="btn btn-success">View/Manage</a>
            </div>
            <div class="mt-5">
                <p class="mt-3">Account Management</p>
                <a href="reset-password.php" class="btn btn-success">Reset Password</a>
                <a href="logout.php" class="btn btn-success ml-3">Sign Out</a>
            </div>
            
        </form>
    </div>

</body>
</html>