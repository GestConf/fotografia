var services = {
    user: {
        recover: function (url, data, done) {
            api.post(url, data, done);
        }
    },
    order: {
        save: function (url, data, done) {
            api.post(url, data, done);
        }
    }
};