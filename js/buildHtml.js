function buildProcessListItem(process) {
    var container = $('#process-list-selected');
    var html = '<div class="process-list-item">';
    html += '<div class="alert alert-info alert-dismissible" role="alert">';
    html += '<input type="hidden" name="IdProcess[]" value="' + process.idProcess + '"/>';
    html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    html += '<span aria-hidden="true">&times;</span></button><strong>' + process.name + '</strong></div>';
    html += '</div>';

    container.append(html);
}

function buildTaskListItem(task) {
    var container = $('#tasks-list-selected');
    var html = '<div class="task-list-item">';
    html += '<div class="alert alert-info alert-dismissible" role="alert">';
    html += '<input type="hidden" name="IdTasks[]" value="' + task.Id + '"/>';
    html += '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
    html += '<span aria-hidden="true">&times;</span></button><strong><a href="' + baseUrl + 'task/edit/' + task.Id + '">' + task.Name + '</a></strong></div>';
    html += '</div>';

    container.append(html);
}

function buildCostRow(cost) {
    var table = $('#cost-table');
    var html = '<tr><td>' + cost.Concept + '</td><td>' + cost.Amount + '</td><td>' + cost.Notes + '</td>';
    html += '<td>' + buildActionsButton(cost) + '</td></tr>';
    table.append(html);
}

function buildActionsButton(cost) {
    var html = '<div class="btn-group cost-actions-group"><button type="button" class="btn btn-theme03">Acciones</button>';
    html += '<button type="button" class="btn btn-theme03 dropdown-toggle" data-toggle="dropdown">';
    html += '<span class="caret"></span><span class="sr-only">Toggle Dropdown</span></button>';
    html += '<ul class="dropdown-menu cost-actions" role="menu" data-cost-id="' + cost.Id + '"><li><a href="#" class="get-cost-modal" data-toggle="modal" data-target="#cost-modal"><i class="fa fa-pencil margin-after-icon"></i>Editar</a></li>';
    html += '<li class="divider"></li><li><a href="#"><i class="fa fa-trash-o margin-after-icon"></i>Eliminar</a></li>';
    html += '</ul></div>';

    return html;
}
function updateCostRow(cost) {

}

function fillCostForm(cost) {
    var form = jQuery('#costForm');
    form.find('[name="Id"]').val(cost.Id);
    form.find('[name="Concept"]').val(cost.Concept);
    form.find('[name="Amount"]').val(cost.Amount);
    form.find('[name="Notes"]').val(cost.Notes);
}

/**
 * Build HTML For Pending Tasks Notifications
 *
 * @param tasks
 */
function buildPendingTasks(tasks) {
    var countPendingTasks        = jQuery('.count-pending-tasks');
    var countPendingTasksMessage = jQuery('.count-pending-tasks-message');
    var pendingTasks             = jQuery('.pending-tasks');
    var pendingHtml              = '';

    jQuery.each(tasks.tasks, function(key, task) {
        pendingHtml += '<li><a href="' + baseUrl + 'process/' + task.IdPhaseProcess + '/details"><div class="task-info"><div class="desc">' + task.Name +' - Finaliza el ' + task.EndDate+ '</div>';
        pendingHtml += '</div></a> </li>';
    });

    pendingTasks.append(pendingHtml);
    countPendingTasksMessage.html('Tienes ' + tasks.count + ' tareas pendientes');
    countPendingTasks.html(tasks.count);
}

/**
 * Build HTML For Expired Tasks Notifications
 *
 * @param tasks
 */
function buildExpiredTasks(tasks) {
    var countExpiredTasks        = jQuery('.count-expired-tasks');
    var countExpiredTasksMessage = jQuery('.count-expired-tasks-message');
    var expiredTasks             = jQuery('.expired-tasks');
    var expiredHtml              = '';

    jQuery.each(tasks.tasks, function(key, task) {
        expiredHtml += '<li><a href="' + baseUrl + 'process/' + task.IdPhaseProcess + '/details"><span class="label label-danger"><i class="glyphicon glyphicon-time"></i></span> ' + task.Name;
        expiredHtml += '<span class="small italic"> (' + task.DaysExpired + ' expirada)</span></a></li>';
    });

    expiredTasks.append(expiredHtml);
    countExpiredTasksMessage.html('Tienes ' + tasks.count + ' tareas expiradas');
    countExpiredTasks.html(tasks.count);
}