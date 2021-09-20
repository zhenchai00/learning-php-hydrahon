<h2>CREATE</h2>
<h3>Add Employee</h3>
<p>Please insert the new Employee first name and last name.</p>
<form id="createForm" action="action/actioncreate.php" method="post">
    <label for="firstname">First Name: </label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name: </label>
    <input type="text" name="lastname" id="lastname">
    <br>
    <input class="btn btn-primary mb-1" type="submit" name="submit" value="Submit">
</form>