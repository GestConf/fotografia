$(document).ready(function () {

    $('#process-list-selected').loadPhaseProcesses();

    $('#update-phase-btn').click(function(e) {
        e.preventDefault();
        var postUrl = baseUrl + 'phase/put';
        var form = $('#phaseForm');
        var formData = form.serializeAll();

        services.phase.update(postUrl, formData, function(response) {
            if (response.type == 'success') {
                console.log('none');
                redirect(baseUrl + 'phase');
            }

            // TODO: make a generic Error/Success Messages settimeout funcionality
        });
    });

    $('#save-phase-btn').click(function(e) {
        e.preventDefault();
        var postUrl = baseUrl + 'phase/post';
        var form = $('#phaseForm');
        var formData = form.serializeAll();

        services.phase.update(postUrl, formData, function(response) {
            if (response.type == 'success') {
                console.log('none');
                redirect(baseUrl + 'phase');
            }

            // TODO: make a generic Error/Success Messages settimeout funcionality
        });
    });

    $('#btnSaveHarvest').click(function(e) {
        e.preventDefault();
        var form = $(this).parent().parent().find('#harvestForm');
        var formData = form.serializeAll();

        services.phase.harvest.save(baseUrl + 'phase/harvest/save', formData, function(response) {
            redirect(baseUrl + 'phase/' + response.IdPhase + '/details');
        });
    });

    $('.get-harvest-modal').click(function(e) {
        e.preventDefault();
        var idHarvest = $(this).closest('ul').attr('data-harvest-id');

        services.phase.get(baseUrl + 'phase/harvest/' + idHarvest + '/details', function(response) {
            var form = $('#harvest-modal').find('#harvestForm');

            form.find('[name="Id"]').val(response.Id);
            form.find('[name="IdPhase"]').val(response.IdPhase);
            form.find('[name="Farming"]').val(response.Farming);
            form.find('[name="Total"]').val(response.Total);
            form.find('[name="Notes"]').val(response.Notes);
            form.find('[name="Action"]').val('update');
        });

    })

    $('.btn-delete-harvest').click(function(e) {
        e.preventDefault();
        var harvestId = $(this).attr('data-id');
        $('#btnDeleteHarvest').attr('data-id', harvestId);
    })
});