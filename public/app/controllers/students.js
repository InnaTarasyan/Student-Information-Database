app.controller('studentsController',  function($scope, API_URL, studentService) {

    studentService.list()
        .then(function (response) {
            $scope.students = response['data'];
    });

    $scope.countries = ['Armenia', 'Russia',
         'Finland'
    ];

    $scope.selected_subjects = [];
    $scope.select2Options = {
        'multiple': true,
        'simple_tags': true,
        'tags': ['Math', 'Literature', 'Physics', 'Chemistry']  // Can be empty list.
    };

    $scope.fileNameChanged = function (ele) {

        var files = ele.files;

        $scope.file = files ? files[0] : undefined;

        var oFReader = new FileReader();
        oFReader.readAsDataURL(files[0]);

        oFReader.onload = function (oFREvent) {
            document.getElementById("img").src = oFREvent.target.result;
        };

        $scope.$apply();
    };


    //show modal form
    $scope.toggle = function(modalstate, id) {
        $scope.modalstate = modalstate;

        switch (modalstate) {
            case 'add':
                $scope.form_title = "Add New Student";
                $scope.student = null;
                $('#sel').select2('val', '');
                break;
            case 'edit':
                $scope.form_title = "Student Detail";
                $scope.id = id;
                studentService.get(id)
                    .then(function(response) {
                        $scope.student = response['data'];
                        $('#sel').select2('val', response['data'].country);
                        $scope.selected_subjects = JSON.parse(response['data'].selected_subjects);
                    });
                break;
            default:
                break;
        }
        $('#myModal').modal('show');
    };


    //save new record / update existing record
    $scope.save = function(modalstate, id) {

        var url = API_URL + "students";

        //append student id to the URL if the form is in edit mode
        if (modalstate === 'edit'){
            url += "/" + id;
        }

        var formData = new FormData();
        formData.append('file', $scope.file);
        formData.append('name', $scope.student.name);
        formData.append('admission_date', $scope.student.admission_date);
        formData.append('email', $scope.student.email);
        formData.append('faculty', $scope.student.faculty);
        formData.append('major', $scope.student.major);
        formData.append('country', $scope.student.country);
        formData.append('selected_subjects', JSON.stringify($scope.selected_subjects));
        if($scope.file){
            formData.append('filename', $scope.file.name);
        }

        studentService.update(url, formData)
            .then(function (response) {
            location.reload();
        });

    };

    //delete record
    $scope.confirmDelete = function(id) {
        var isConfirmDelete = confirm('Are you sure you want this record?');
        if (isConfirmDelete) {
            studentService.delete(id).
            then(function(data) {
                location.reload();
            });
        } else {
            return false;
        }
    }

});
