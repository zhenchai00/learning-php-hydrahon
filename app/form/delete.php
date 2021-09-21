<h2>DELETE</h2>
<h3>Delete Employee</h3>
<p>Please insert the Employee ID you wanted to remove.</p>
<form id="deleteform"  method="post">
    <label for="employeeid">Employee ID: </label>
    <input type="text" name="employeeid" id="employeeid">
    <input class="btn btn-primary mb-3" type="submit" name="submit" value="Submit">
</form>

<script>
    $(document).ready(function() {
        $('#deleteform').submit(function(event) {
            event.preventDefault();

            var id = $('#employeeid').val();

            $.post('../lib/action.php', {
                action: 'delete',
                id: id
            }, function(data, status, xhr) {
                $('#content').html(data.message + data.list);
            }, 'json');
        })
    });
</script>
