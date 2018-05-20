app.service('studentService', function ($http, API_URL) {

    return {

        list: function () {
            return $http.get(API_URL + "students");
        },
        
        delete : function (id) {
            return $http({
                method: 'DELETE',
                data: 'id=' + id,
                headers: {'Content-Type': 'application/x-www-form-urlencoded'},
                url: API_URL + 'students/' + id
            })
        },

        update: function(url, formData) {
            return $http.post(url, formData, {
                transformRequest: angular.identity,
                headers: {'Content-Type': undefined}
            })
        },

        get: function (id) {
           return $http.get(API_URL + 'students/' + id);
        }
    }
});