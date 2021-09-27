<h2>UPDATE</h2>
<h3>Update Department's Employee</h3>
<p>
    Please insert the Employee ID you wanted to update.
</p>
<form id="updateform" method="post">
    <label for="employeeid">Employee ID: </label>
    <input type="text" name="employeeid" id="employeeId">
    <label for="departmentName">Department Name: </label>
    <input type="text" name="departmentName" id="departmentName">
    <br>
    <input class="btn btn-primary mb-3" type="submit" name="submit" value="Submit">
</form>

<script>
    $(document).ready(function() {
        $('#updateform').submit(function(event) {
            event.preventDefault();

            var id = $('#employeeId').val();
            var departmentName = $('#departmentName').val();

            $.post('../lib/action.php', {
                page: page,
                aot: aot,
                action: 'update',
                id: id,
                departmentName: departmentName,
            }, function(data, status, xhr) {
                $('#content').html(data.message + data.list);
            }, 'json');
        })
    });
</script>