<h2>UPDATE</h2>
<h3>Update Employee</h3>
<p>
    Please insert the Employee ID you wanted to update.<br>
    If only need to update first name, please insert at text box label first name.<br>
    Last name can be left it blank.
</p>
<form action="action/actionupdate.php" method="post">
    <label for="employeeid">Employee ID: </label>
    <input type="text" name="employeeid" id="employeeId">
    <label for="updatefirstname">First Name: </label>
    <input type="text" name="updatefirstname" id="updatefirstname">
    <label for="updatelastname">Last Name: </label>
    <input type="text" name="updatelastname" id="updatelastname">
    <br>
    <input class="btn btn-primary mb-3" type="submit" name="submit" value="Submit">
</form>