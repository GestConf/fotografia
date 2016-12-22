var api = {
    get: function (url, done) {
        $.ajax({
            url: url,
            method: "GET"
        }).done(done);
    },
    post: function (url, data, done) {
        $.ajax({
            url: url,
            dataType: "json",
            method: "POST",
            data: data
        }).done(done);
    },
    put: function (url, data, done) {
        $.ajax({
            url: url,
            dataType: "json",
            method: "PUT",
            data: data
        }).done(done);
    },
    delete: function (url, id) {

    }
}