<?php include 'templates/header.php'; ?>

<!-- List employee table -->
<h2>READ</h2>
<h3>List New Employee</h3>
<a href="../lib/query/listing.php">View data Listing</a>
<!-- End list data -->

<br>

<!-- Insert new row of data -->
<h2>CREATE</h2>
<h3>Add Employee</h3>
<p>Please insert the new Employee first name and last name.</p>
<form action="../lib/query/insert.php" method="post">
    <label for="firstname">First Name: </label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name: </label>
    <input type="text" name="lastname" id="lastname">
    <br>
    <input type="submit" name="submit" value="Submit">
</form>
<!-- End insert new row  -->

<br>

<!-- Update rows data with condition -->
<h2>UPDATE</h2>
<h3>Update Employee</h3>
<p>
    Please insert the Employee ID you wanted to update.<br>
    If only need to update first name, please insert at text box label first name.<br>
    Last name can be left it blank.
</p>
<form action="../lib/query/update.php" method="post">
    <label for="employeeid">Employee ID: </label>
    <input type="text" name="employeeid" id="employeeId">
    <label for="updatefirstname">First Name: </label>
    <input type="text" name="updatefirstname" id="updatefirstname">
    <label for="updatelastname">Last Name: </label>
    <input type="text" name="updatelastname" id="updatelastname">
    <br>
    <input type="submit" name="submit" value="Submit">
</form>
<!-- End update rows data -->

<br>

<!-- Drop rows data with condition -->
<h2>DELETE</h2>
<h3>Delete Employee</h3>
<p>Please insert the Employee ID you wanted to remove.</p>
<form action="../lib/query/delete.php" method="post">
    <label for="employeeid">Employee ID: </label>
    <input type="text" name="employeeid" id="employeeId">
    <input type="submit" name="submit" value="Submit">
</form>
<!-- End drop rows data -->

<?php include 'templates/footer.php' ?>