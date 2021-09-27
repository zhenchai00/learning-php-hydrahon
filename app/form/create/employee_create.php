<h2>CREATE</h2>
<h3>Add Employee</h3>
<p>Please insert the new Employee first name and last name.</p>
<form id="createform" method="post">
    <label for="firstname">First Name: </label>
    <input type="text" name="firstname" id="firstname">
    <label for="lastname">Last Name: </label>
    <input type="text" name="lastname" id="lastname">
    <br>
    <input class="btn btn-primary mb-1" type="submit" name="submit" value="Submit">
</form>

<script>
    $(document).ready(function() {
        $('#createform').submit(function(event) {
            event.preventDefault();

            var firstname = $('#firstname').val();
            var lastname = $('#lastname').val();

            $.post('../lib/action.php', {
                page: page,
                aot: aot,
                action: 'create',
                firstname: firstname,
                lastname: lastname
            }, function(data, status, xhr) {
                $('#content').html(data.message + data.list);
            }, 'json');
        })
    });
</script>
