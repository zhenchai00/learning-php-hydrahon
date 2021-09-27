<h2>UPDATE</h2>
<h3>Update Employee</h3>
<p>
    Please insert the Employee ID you wanted to update.<br>
    If only need to update first name, please insert at text box label first name.<br>
    Last name can be left it blank.
</p>
<form id="updateform" method="post">
    <label for="employeeid">Employee ID: </label>
    <input type="text" name="employeeid" id="employeeId">
    <label for="firstname">First Name: </label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name: </label>
    <input type="text" name="lastname" id="lastname">
    <br>
    <input class="btn btn-primary mb-3" type="submit" name="submit" value="Submit">
</form>

<script>
    $(document).ready(function() {
        $('#updateform').submit(function(event) {
            event.preventDefault();

            var id = $('#employeeId').val();
            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();

            $.post('../lib/action.php', {
                page: page,
                aot: aot,
                action: 'update',
                id: id,
                firstname: firstname,
                lastname: lastname
            }, function(data, status, xhr) {
                $('#content').html(data.message + data.list);
            }, 'json');
        })
    });
</script>