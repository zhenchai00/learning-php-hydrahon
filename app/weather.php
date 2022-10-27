<!DOCTYPE html>
<html id="top-of-site" lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- CSS -->
    <link rel="stylesheet" href="resources/bootstrap5.0.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="resources/css/style.css">

    <!-- JS -->
    <script src="https://kit.fontawesome.com/0a72f56f5c.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="resources/bootstrap5.0.2/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="resources/js/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="main.js"></script>
</head>

<body>
    <nav class="navbar navbar-expand navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#list">Learning</a>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navListing" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Listing
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navListing">
                            <li class="dropdown-item"><a href="?page=employee&aot=list#list">Listing Employee</a></li>
                            <li class="dropdown-item"><a href="?page=department&aot=list#list">Listing Department</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navCreate" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Create
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navCreate">
                            <li class="dropdown-item"><a href="?page=employee&aot=create#create">Create Employee</a></li>
                            <li class="dropdown-item"><a href="?page=department&aot=create#create">Create Department</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navUpdate" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Update
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navUpdate">
                            <li class="dropdown-item"><a href="?page=employee&aot=update#update">Update Employee</a></li>
                            <li class="dropdown-item"><a href="?page=department&aot=update#update">Update Department</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navDelete" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Delete
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navDelete">
                            <li class="dropdown-item"><a href="?page=employee&aot=delete#delete">Delete Employee</a></li>
                            <li class="dropdown-item"><a href="?page=department&aot=delete#delete">Delete Department</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="weather.php">Weather Forecast</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" id="content"></div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-xs-12">
            <h3>Weather Forecast</h3>
        </div>
        <div class="col-lg-6 col-md-6 col-xs-12">
            <form id="table-forecast-selection" class="form-inline pull-right">

            </form>
        </div>
    </div>
    
    <footer>
        <a id="to-top" class="top-of-site-link" href="#">
            <i class="fas fa-angle-up"></i>
        </a>
    </footer>

    <script type="text/javascript">
        var page = '<?php echo $_GET["page"];?>';
        var aot = '<?php echo $_GET["aot"]; ?>'
    </script>
</body>

</html>

<?php
    require_once('brain.php');
?>