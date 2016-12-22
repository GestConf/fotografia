$(document).ready(function () {
    $('#IdProcess').change(function() {
        var id = $(this).val();
        var processName = $('.process-dropdown option:selected').text();
        var process = {'idProcess': id, 'name': processName};
        buildProcessListItem(process);
        $(this).val('');
    });

    $('#tasks-list-selected').loadTasksProcesses();

    /*$('#update-process-btn').click(function(e) {
        e.preventDefault();
        var postUrl = baseUrl + 'process/put';
        var form = $('#processForm');
        var formData = form.serializeAll();

        services.process.update(postUrl, formData, function(response) {
            if (response.type == 'success') {
                redirect(baseUrl + 'process');
            }

            // TODO: make a generic Error/Success Messages settimeout funcionality
        });
    });*/

    /*$('#save-process-btn').click(function(e) {
        e.preventDefault();
        var postUrl = baseUrl + 'process/post';
        var form = $('#processForm');
        var formData = form.serializeAll();

        services.process.add(postUrl, formData, function(response) {
            if (response.type == 'success') {
                redirect(baseUrl + 'process');
            }

            // TODO: make a generic Error/Success Messages settimeout funcionality
        });
    });*/

    jQuery('.save-cost').click(function(e) {
        e.preventDefault();
        var postUrl  = baseUrl + 'cost/post';
        var form     = jQuery('#costForm');
        var formData = form.serializeAll();

        services.cost.save(postUrl, formData, function(response) {
            var cost = response.data;
            var processDetailUrl = baseUrl + 'process/' + cost.IdPhaseProcess + '/details';
            if (response.type == 'success') {
                //buildCostRow(response.data);
                redirect(processDetailUrl);
            } else if (response.type == 'updated') {
                //jQuery('.process-costs-list').load(baseUrl + 'process/' + cost.IdProcess + '/costs/view');
                redirect(processDetailUrl);
            }
        });
    });
    
    jQuery('.save-task').click(function (e){
        e.preventDefault();
        var postUrl = baseUrl + "processtask/post";
        var form = jQuery("#taskForm");
        var formData = form.serializeAll();
        
        services.processtask.save(postUrl, formData, function (response){
            var processTask = response.data;
            var processDetailUrl = baseUrl + 'process/' + processTask.IdPhaseProcess + '/details';
            if (response.type == 'success') {
                //buildCostRow(response.data);
                redirect(processDetailUrl);
            } else if (response.type == 'updated') {
                //jQuery('.process-costs-list').load(baseUrl + 'process/' + cost.IdProcess + '/costs/view');
                redirect(processDetailUrl);
            }
        });
    });

    jQuery('ul.cost-actions').on('click', '.get-cost-modal', function(e) {
        e.preventDefault();
        var costId = jQuery(this).closest('ul').attr('data-cost-id');
        var getUrl = baseUrl + 'cost/' + costId + '/get';
        services.cost.get(getUrl, function(response) {
           if (response.type == 'success') {
               fillCostForm(response.data);
           }
        });
    });

    jQuery('.add-cost-modal').click(function(e) {
        e.preventDefault();
        var cost = {};
        fillCostForm(cost);
    });

    jQuery('.delete-cost').click(function(e) {
        e.preventDefault();
        console.log('asdasd');
    });

    jQuery('.edit-task-status').click(function(e) {
        e.preventDefault();
        var form          = jQuery('#taskStatusForm');
        var taskId        = jQuery(this).attr('data-task-id');
        var currentStatus = jQuery(this).attr('data-current-status');

        form.find('[name="Id"]').val(taskId);
        form.find('[name=Status]').val(currentStatus);
    });

    jQuery('.save-task-status').click(function(e) {
        e.preventDefault();
        var form      = jQuery('#taskStatusForm');
        var formData  = form.serializeAll();
        var idPhaseProcess = formData.IdPhaseProcess;
        var url       = baseUrl + 'process/' + idPhaseProcess + '/task/' + formData.Id + '/status';
        services.task.status.update(url, formData, function(response) {
            if (response.type == 'success') {
                redirect(baseUrl + 'process/' + idPhaseProcess + '/details');
            }
        });
    });

    jQuery('.edit-task-date').click(function(e) {
        e.preventDefault();
        var form     = jQuery('#taskDateForm');
        var taskId   = jQuery(this).attr('data-task-id');
        var date     = jQuery(this).attr('data-task-date');
        var dateType = jQuery(this).attr('data-date-type');

        form.find('[name="Id"]').val(taskId);
        form.find('[name=Date]').val(date);
        form.find('[name=DateType]').val(dateType);
        
        $('#date').datepicker('update', date);
    });

    jQuery('.save-task-date').click(function(e) {
        e.preventDefault();
        var form      = jQuery('#taskDateForm');
        var formData  = form.serializeAll();
        var idPhaseProcess = formData.IdPhaseProcess;
        var url       = baseUrl + 'process/' + idPhaseProcess + '/task/' + formData.Id + '/date';

        services.task.date.update(url, formData, function(response) {
            if (response.type == 'success') {
                redirect(baseUrl + 'process/' + idPhaseProcess + '/details');
            }
        });
    });
    
    jQuery(".delete-process-details").click(function (e){
        e.preventDefault();
        var form = jQuery("#processDetailsForm");
        var formData = form.serializeAll();
        var idPhaseProcess = formData.IdPhaseProcess;
        var url = baseUrl + "phase/" + idPhaseProcess + "/process/delete";
        
        services.phasedetails.deleteprocess(url, formData, function (response){
            var data = response.data;
            if(response.type == "success"){
                redirect(baseUrl + "phase/" + data.IdPhase + "/details");
            }else if(response.type == "error"){
                showModal(data.tasksProcess, data.costs);
            }
        });
    });

    jQuery("#btnDeletePhase").click(function (e){
        e.preventDefault();

        var form = jQuery("#phaseForm");
        var formData = form.serializeAll();
        var idPhase = formData.IdPhase;

        var url = baseUrl + "phase/" + idPhase + "/delete";

        services.phase.delete(url, formData, function (response){
            var data = response.data;

            if(response.type == "success"){
                redirect(baseUrl + "process");
            }else if(response.type == "404"){
                redirect(baseUrl + "error/404");
            }else if(response.type == "error"){
                showModalDeletePhase(data);
            }
        });
    });

    jQuery("#btnDeleteProcess").click(function (e){
        e.preventDefault();
        var form = jQuery("#processForm");
        var formData = form.serializeAll();
        var idProcess = formData.IdProcess;

        var url = baseUrl + "process/" + idProcess + "/delete";

        services.process.delete(url, formData, function (response){
            var data = response.data;

            if(response.type == "success"){
                redirect(baseUrl + "process");
            }else if(response.type == "404"){
                redirect(baseUrl + "error/404");
            }else if(response.type == "error"){
                showModalDeleteProcess(data);
            }
        });
    });
});