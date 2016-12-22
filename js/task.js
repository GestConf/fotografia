$(document).ready(function () {
    $('#IdTask').change(function () {
        var id = $(this).val();
        var taskName = $('.tasks-dropdown option:selected').text();
        var task = {'Id': id, 'Name': taskName};
        buildTaskListItem(task);
        $(this).val('');
    });
});