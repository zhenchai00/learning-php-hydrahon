<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS -->
    <link rel="stylesheet" href="resources/bootstrap5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">

    <!-- JS -->
    <script type="text/javascript" src="resources/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#list">Learning</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <!-- <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#list">Home</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="#list">Listing Employee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#create">Create Employee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#update">Update Employee</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#delete">Delete Employee</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" id="content"></div>
</body>

</html>

<?php
    require_once('brain.php');
?>