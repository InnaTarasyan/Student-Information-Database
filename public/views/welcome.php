<html lang="en-US" ng-app="studentRecords" xmlns="http://www.w3.org/1999/html">
  <head>
      <meta name="_token" content="{{ csrf_token() }}">
      <!-- CSS -->
      <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.css" rel="stylesheet">

      <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2.min.css" rel="stylesheet" />
  </head>
  <body>

      <h2 style="text-align: center">Students Database</h2>
      <div  ng-controller="studentsController">
          <!-- Table-to-load-the-data Part -->
          <table class="table table-bordered ">
              <thead>
              <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Admission Date</th>
                  <th>Faculty</th>
                  <th>Major</th>
                  <th>
                      <button id="btn-add" class="btn btn-info btn-xs" ng-click="toggle('add', 0)">Add New Student</button>
                  </th>
              </tr>
              </thead>
              <tbody>
              <tr ng-repeat="student in students">
                  <td>{{  student.id }}</td>
                  <td>{{ student.name }}</td>
                  <td>{{ student.email }}</td>
                  <td>{{ student.admission_date }}</td>
                  <td>{{ student.faculty }}</td>
                  <td>{{ student.major }}</td>
                  <td>
                      <button class="btn btn-success btn-xs btn-detail" ng-click="toggle('edit', student.id)">Edit</button>
                      <button class="btn btn-danger btn-xs btn-delete" ng-click="confirmDelete(student.id)">Delete</button>
                  </td>
              </tr>
              </tbody>
          </table>


          <!-- End of Table-to-load-the-data Part -->
          <!-- Modal (Pop up when detail button clicked) -->
          <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                          <h4 class="modal-title" id="myModalLabel">{{form_title}}</h4>
                      </div>
                      <div class="modal-body">
                          <form name="frmStudents" class="form-horizontal" novalidate="">
                              <div class="form-group error">
                                  <label class="col-sm-3 control-label">Name</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control has-error" id="name" name="name" placeholder="Fullname" value="{{name}}"
                                             ng-model="student.name" ng-required="true">
                                      <span class="help-inline"
                                            ng-show="frmStudents.name.$invalid && frmStudents.name.$touched">Name field is required</span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-3 control-label">Email</label>
                                  <div class="col-sm-9">
                                      <input type="email" class="form-control" id="email" name="email" placeholder="Email Address" value="{{email}}"
                                             ng-model="student.email" ng-required="true">
                                      <span class="help-inline"
                                            ng-show="frmStudents.email.$invalid && frmStudents.email.$touched">Valid Email field is required</span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-3 control-label">Admission Date</label>
                                  <div class="col-sm-9">
                                      <input class="date form-control" ng-required="true"  ng-model="student.admission_date"  type="text" id="admission_date" name="admission_date" placeholder="Admission date" value="{{admission_date}}" >
                                      <span class="help-inline"
                                            ng-show="frmStudents.admission_date.$invalid && frmStudents.admission_date.$touched">Admission date field is required</span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-3 control-label">Faculty</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="faculty" name="faculty" placeholder="Faculty" value="{{faculty}}"
                                             ng-model="student.faculty" ng-required="true">
                                      <span class="help-inline"
                                            ng-show="frmStudents.faculty.$invalid && frmStudents.faculty.$touched">Faculty field is required</span>
                                  </div>
                              </div>

                              <div class="form-group">
                                  <label class="col-sm-3 control-label">Major</label>
                                  <div class="col-sm-9">
                                      <input type="text" class="form-control" id="major" name="major" placeholder="major" value="{{major}}"
                                             ng-model="student.major" ng-required="true">
                                      <span class="help-inline"
                                            ng-show="frmStudents.major.$invalid && frmStudents.major.$touched">Major field is required</span>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-3 control-label">Country</label>
                                  <div class="col-sm-9">
                                      <select id="sel" ng-model="student.country" ui-select2="{ allowClear: true}" ui-select2  data-placeholder="Pick a Country">
                                          <option value="" ></option>
                                          <option ng-repeat="val in countries" value="{{val}}" ng-selected="{{val == student.country}}">{{val}}</option>
                                      </select>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-3 control-label">File</label>
                                  <div class="col-sm-9">
                                      <input type="file" class="form-control" id="file" name="file" placeholder="file" value="{{filename}}"
                                             onchange="angular.element(this).scope().fileNameChanged(this)"
                                             ng-model="student.filename" >

                                      <div style="padding-top: 10%" ng-if="student.file_original_name || file">
                                         <img id="img" style=" max-width:400px;max-height:400px;width:auto;height:auto;" ng-src="{{'images/' + student.file_original_name}}">
                                      </div>
                                      <span class="help-inline"
                                            ng-show="frmStudents.filename.$invalid && frmStudents.filename.$touched">File field is required</span>
                                  </div>
                              </div>
                              <div class="form-group">
                                 <label class="col-sm-3 control-label">Courses</label>
                                 <div class="col-sm-9">
                                    <input type="hidden" ui-select2="select2Options" ng-model="selected_subjects" style="width:100%;">
                                 </div>
                              </div>
                          </form>
                      </div>
                      <div class="modal-footer">
                          <button type="button" class="btn btn-primary" id="btn-save" ng-click="save(modalstate, id)" ng-disabled="frmStudents.$invalid">Save changes</button>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </body>
  <footer>
        <!-- JS -->
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js"></script>

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>


        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/js/bootstrap-datepicker.js"></script>

        <!-- ANGULAR -->
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.6.9/angular-route.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/angular.js/1.6.5/angular-animate.js"></script>

        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/3.5.4/select2.min.js"></script>

        <script src="<?= asset('libs/angular-select2.js') ?>"></script>

        <!-- AngularJS Application Scripts -->
        <script src="<?= asset('app/app.js') ?>"></script>
        <script src="<?= asset('app/services/services.js') ?>"></script>
        <script src="<?= asset('app/controllers/students.js') ?>"></script>
        <script type="text/javascript">
            $('#admission_date').datepicker({
              autoclose: true,
              format: 'dd-mm-yyyy'
           });
        </script>

   </footer>
</html>

