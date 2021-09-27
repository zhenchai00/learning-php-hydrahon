<h2>CREATE</h2>
<h3>Add Employee to Department</h3>
<p>Please insert the new Employee ID to relevant Department.</p>
<form id="createform" method="post">
    <label for="departmentName">Department Name: </label>
    <input type="text" name="departmentName" id="departmentName">
    <label for="id">Employee's ID: </label>
    <input type="text" name="id" id="id">
    <br>
    <input class="btn btn-primary mb-1" type="submit" name="submit" value="Submit">
</form>

<script>
    $(document).ready(function() {
        $('#createform').submit(function(event) {
            event.preventDefault();

            var departmentName = $('#departmentName').val();
            var id = $('#id').val();

            $.post('../lib/action.php', {
                page: page,
                aot: aot,
                action: 'create',
                departmentName: departmentName,
                id: id
            }, function(data, status, xhr) {
                $('#content').html(data.message + data.list);
            }, 'json');
        })
    });
</script>
