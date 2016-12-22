$(document).ready(function () {
    $('.login-btn').click(function (e) {
        e.preventDefault();
        var username = $('#user').val();
        var password = $('#password').val();

        $.ajax({
            type: "POST",
            url: '../user/login',
            data: {'username': username, 'password': password},
            success: function (data) {
                // If trial version is expired
                if (data.status && data.status == 'EXPIRED') {
                    $('#user').removeAttr('disabled');
                    $('#password').removeAttr('disabled');
                    $('.login-btn').html('Entrar');
                    $('#trial-expired').removeClass('hide').addClass('has-error').html(data.message);
                    return;
                }

                $('#login').html('<h1>Bienvenido</h1><p>Iniciando sesion...</p>');
                setTimeout(function () {
                    var controller;
                    if (data.UserType === 'SuperUser') {
                        controller = adminUrl;
                    } else {
                        controller = '../dashboard';
                    }
                    window.location.href = controller;
                }, 1800);
            },
            error: function (response) {
                $('#user').removeAttr('disabled');
                $('#password').removeAttr('disabled');
                $('#loginForm').addClass('has-error');
                $('#bad-credentials').removeClass('hide');
                $('.login-btn').html('Entrar');
            },
            dataType: 'JSON'
        });

        $('#user').attr('disabled', true);
        $('#password').attr('disabled', true);
        $('#loginForm').removeClass('has-error');
        $('#bad-credentials').addClass('hide');
        $('#trial-expired').addClass('hide');
        $('.login-btn').html('Validando...');
    });

    $(".btn-recover-password").click(function (e) {
        var email = $("#email").val();

        var url = "../user/recoverPassword";
        var data = {"email": email};
        services.user.recover(url, data, function (response) {
            console.log(response.status);
            if (response.status == "success") {
                var alert = '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Info!</strong> Se ha enviado informacion a tu correo electronico</div>';
                $("#alert-recover").html(alert);
            } else if (response.status == "error") {
                var alert = '<div class="alert alert-warning"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> El Correo Electronico no Existe, Intente Nuevamente</div>';
                $("#alert-recover").html(alert);
            }
        });
    });

    $(".btn-qr").click(function (e) {
        e.preventDefault();
        var id = jQuery(this).attr("data-id");
        var url = jQuery(this).attr("data-url");
        var img = "http://chart.googleapis.com/chart?chs=180x180&cht=qr&chl=" + url + "gallery/photos/" + id;

        $('#qr-img').html('<img src=' + img + '>');
    });

    $(".btn-pedido").click(function (e) {
        e.preventDefault();
        var id = jQuery(this).attr("data-id");

        var url = "../order/insert";
        var data = {"id": id};

        services.order.save(url, data, function (response) {
            if (response.status == 'success') {
                var alert = '<div class="alert alert-success"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Info!</strong> Se ha enviado su Pedido</div>';
                $("#alert-order").html(alert);
            } else if (response.status == "error") {
                var alert = '<div class="alert alert-warning"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Error!</strong> Intente Nuevamente</div>';
                $("#alert-order").html(alert);
            } else if (response.status == "info") {
                var alert = '<div class="alert alert-info"> <a href="#" class="close" data-dismiss="alert">&times;</a><strong>Info!</strong> Ya se ha registrado un Pedido con la Imagen Seleccionada</div>';
                $("#alert-order").html(alert);
            }
        });
    });

    $('.dashboard-menu').click(function (e) {
        e.preventDefault();
        var $this = jQuery(this);
        jQuery('.nav-stacked').find('*').removeClass('active');
        $this.addClass('active');
        jQuery('.dashboard-content').html($this.html());
    });

    /*
     * Bootstrap Switch Checkboxes
     */


    jQuery(".switch-checkbox").bootstrapSwitch({
        onText: 'Si',
        offText: 'No'
    }
    );
    jQuery(".switch-checkbox").bootstrapSwitch('state');


    // Notifications Loading
    jQuery('[notifications-bar]').loadNotifications();

});

/**
 * 
 * @param {input} input
 * Load Image Selected in #preview
 */
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#preview').attr('src', e.target.result);
            $("#preview").show();
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/** * Build FullName given First and Last Name * * @returns {string} */
function setFullName() {
    var firstName = jQuery('#firstname').val();
    var lastName = jQuery('#lastname').val();
    var fullName = firstName + ' ' + lastName;
    jQuery('#fullname').val(fullName);
}

/**
 * Redirect to URL
 *
 * @param to
 */
function redirect(to)
{
    window.location.href = to;
}

/**
 * Serialize form to an Javascript Object
 */
(function ($) {
    $.fn.serializeAll = function () {
        var rselectTextarea = /^(?:select|textarea)/i;
        var rinput = /^(?:color|date|datetime|datetime-local|email|file|hidden|month|number|password|range|search|tel|text|time|url|week)$/i;
        var rCRLF = /\r?\n/g;
        var o = {};

        var arr = this.map(function () {
            return this.elements ? jQuery.makeArray(this.elements) : this;
        })
                .filter(function () {
                    return this.name && !this.disabled &&
                            (this.checked || rselectTextarea.test(this.nodeName) ||
                                    rinput.test(this.type));
                })
                .map(function (i, elem) {
                    var val = jQuery(this).val();

                    return val == null ?
                            null :
                            jQuery.isArray(val) ?
                            jQuery.map(val, function (val, i) {
                                return {name: elem.name, value: val.replace(rCRLF, "\r\n")};
                            }) :
                            {name: elem.name, value: val.replace(rCRLF, "\r\n")};
                }).get();

        $.each(arr, function () {
            if (o[this.name]) {
                if (!o[this.name].push) {
                    o[this.name] = [o[this.name]];
                }
                o[this.name].push(this.value || "");
            } else {
                o[this.name] = this.value || "";
            }
        });
        return o;
    }
})(jQuery);

(function ($) {
    $.fn.loadPhaseProcesses = function () {
        this.filter('#process-list-selected').each(function () {
            var phaseId = $('[name="Id"]').val();
            var getUrl = baseUrl + 'phase/' + phaseId + '/processes';
            services.phase.get(getUrl, function (response) {
                if (response.type == 'success') {
                    $.each(response.data, function (k, process) {
                        buildProcessListItem(process);
                    });
                }
            });
        });
    }
})(jQuery);

(function ($) {
    $.fn.loadTasksProcesses = function () {
        this.filter('#tasks-list-selected').each(function () {
            var processId = $('[name="Id"]').val();
            var getUrl = baseUrl + 'process/' + processId + '/tasks';
            services.process.get(getUrl, function (response) {
                if (response.type == 'success') {
                    $.each(response.data, function (k, task) {
                        console.log(task);
                        buildTaskListItem(task);
                    });
                }
            });
        });
    }
})(jQuery);

// Notifications Plugin
(function ($) {
    $.fn.loadNotifications = function () {
        this.filter('[notifications-bar]').each(function () {
            services.notifications.get(baseUrl + 'notifications', function (response) {
                buildPendingTasks(response.pendingTasks);
                buildExpiredTasks(response.expiredTasks);
            });
        });
    }
})(jQuery);