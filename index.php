<?php
// Initialize the session
require 'assets/php/session.php';
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

<?php include_once 'assets/php/navbar.php'; ?>

<div class="registration-form">
        <?php
if (!empty($login_err)) {
    echo '<div class="alert alert-danger">' . $login_err . '</div>';
}
?>
        <form class="form">
            <div class="m-3">
                <h1 class="my-1">Welcome, <b><?php echo htmlspecialchars($_SESSION["username"]); ?></h1>
                <h2><?php echo ($_SESSION["admin"]) ? "You are an Admin" : "Options" ?></h2>
            </div>
            <div class="container">
                <div class="row row-col-2 m-4">
                    <div class="col"><a href="add-contacts.php" class="btn btn-primary w-100">Add Contacts</a></div>
                    <div class="col"><a href="contactlist.php" class="btn btn-primary w-100">View/Manage</a></div>
                </div>
                <div class="row row-col-2 m-4">
                    <div class="col"><a href="reset-password.php" class="btn btn-primary w-100">Reset Password</a></div>
                    <div class="col"><a href="logout.php" class="btn btn-primary w-100">Sign Out</a></div>
                </div>
                <div class="row row-col-2 m-4">
                    <div class="col"><a href="register.php" class="btn btn-primary w-100">Create New User</a></div>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" 
    crossorigin="anonymous"></script>

</body>
</html>