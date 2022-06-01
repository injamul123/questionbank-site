<?php
/*session_start();

if (!isset($_SESSION['user']) || !isset($_SESSION['name']) || !isset($_SESSION['role'])) {
    $_SESSION['error'] = "You must login first";
    header('Location: ./index.php');
    exit();
}*/
?>
<!doctype html>
<html lang="en">

<head>
    <title>Question Bank Management System</title>

    <link rel="stylesheet" href="./res/css/bootstrap.min.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css"
        rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="./res/css/font-awesome.css">
    <link href="./res/css/style.css" type="text/css" rel="stylesheet">
</head>

<body>
    <div id="top-nav" class="navbar navbar-inverse navbar-static-top" >
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Question Bank Management System</a>
            </div>
            <div class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <li>
                        <a role="button"><i class="fa fa-user-circle"></i> </a>
                    </li>
                    <li><a href="./logout.php"><i class="fa fa-sign-out"></i> Logout</a></li>
                </ul>
            </div>
        </div>
    </div>
