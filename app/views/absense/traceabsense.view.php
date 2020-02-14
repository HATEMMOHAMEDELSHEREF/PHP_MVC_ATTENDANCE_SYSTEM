
<div class="container absent-wrapper">
    <div class="row  row-absent">
        <span class="clearfix"></span>
        <div class="col-xs-6">
            <form class="form-data" autocomplete="off" novalidate>
                <div class="form-group">
                    <button class="btn btn-danger form-control scan-absense-btn sm-btn-close"  id="close-student-info-btn"><i class="fa fa-power-off"></i></button>

                </div>
                <div class="form-group">
                    <label for="student_id">Student ID</label>
                    <input type="text" class="form-control"  value="" id="student_id" disabled>
                </div>
                <div class="form-group">
                    <label for="student_name">Student Name</label>
                    <input type="text" class="form-control"  value="" id="student_name" disabled>
                </div>
                <div class="form-group">
                    <label for="student_email">Student Email</label>
                    <input type="text" class="form-control"  value="" id="student_email" disabled>
                </div>
                <div class="form-group">
                    <label for="student_phone">Student Phone</label>
                    <input type="text" class="form-control"   id="student_phone" disabled>
                </div>
                <div class="form-group">
                    <label for="student_reg_date">Date</label>
                    <input type="text" class="form-control" id="student_reg_date"  value="" disabled>
                </div>
                <div class="form-group">
                    <button class="btn btn-info form-control scan-absense-btn sm-btn"    id="scan-student-info-btn"><i class="fa fa-search"></i></button>
                    <button class="btn btn-primary form-control scan-absense-btn sm-btn" id="refresh-student-info-btn" disabled><i class="fa fa-refresh"></i></button>
                </div>
            </form>
        </div>

        <span class="clearfix"></span>
        <div class="col-xs-6">
            <div class="scan-qr-to-take-absent">
                <canvas id="preview"></canvas>
                <script src="/js/jquery.min.js"></script>
                <script src="/js/jsQR.js"></script>
                <script src="/js/dw-qrscan.js"></script>
                <script>
                    $('#refresh-student-info-btn').click(function (e) {
                        // window.location.reload();
                        dwStartScan();
                        return false;
                    });
                    DWTQR('preview');
                    $('#scan-student-info-btn').click(function (e) {
                        dwStartScan();
                        e.preventDefault();
                        $('#refresh-student-info-btn').attr('disabled',false);
                        $(this).attr('disabled',true);
                    });
                    function dwQRReader(qrdata){
                        $.ajax({
                            url: 'https://www.mufix.com/student/parse',
                            method: 'post',
                            data: {data: qrdata},
                            success: function (data) {

                                if ((JSON.parse(data)).Status==true){
                                    var Student=JSON.parse(data).Data[0];
                                    $('#edit-student-info-btn').removeClass('disabled');
                                    $('#remove-student-info-btn').removeClass('disabled');
                                    $('#edit-student-info-btn').attr('href','/student/edit/'+Student.student_id);
                                    $('#remove-student-info-btn').attr('href','/student/delete/'+Student.student_id);
                                    $('#student_id').val(Student.student_id);
                                    $('#student_name').val(Student.student_name);
                                    $('#student_email').val(Student.student_email);
                                    $('#student_phone').val(Student.student_phone);
                                    $('#student_reg_date').val(Student.student_register_date);
                                    FoundStudent();
                                }else{
                                    $('#edit-student-info-btn').addClass('disabled');
                                    $('#remove-student-info-btn').addClass('disabled');
                                    $('#student_id').val('NOT FOUND USER');
                                    $('#student_name').val('NOT FOUND USER');
                                    $('#student_email').val('NOT FOUND USER');
                                    $('#student_phone').val('NOT FOUND USER');
                                    $('#student_reg_date').val('NOT FOUND USER');
                                    NotFoundStudent();
                                }

                            }
                        });
                    }
                </script>
            </div>
        </div>
        <div class="col-xs-12 trackss">
            <table class="table table-striped">
                <thead>
               <tr>
                   <td>Track Name</td>
                   <td>Attended</td>
                   <td>Absent</td>
                   <td>Total</td>
               </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Front End</td>
                    <td>7</td>
                    <td>3</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>Back End</td>
                    <td>7</td>
                    <td>3</td>
                    <td>10</td>
                </tr>
                <tr>
                    <td>Problem Solving</td>
                    <td>7</td>
                    <td>3</td>
                    <td>10</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="col-xs-12 trackss">

            <div class="col-xs-12 tracks">
                <table class="table table-striped table-responsive " id="student-absense-trace-table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Student Name</td>
                        <td>Date</td>
                        <td>Track</td>
                        <td>Status</td>
                        <td>Controllers</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>2</td>
                        <td>Ali Mahmoud</td>
                        <td>1/8/2020</td>
                        <td>BackEnd</td>
                        <td class="text-success">Attended</td>
                        <td>
                            <a href="#" id="edit-session-btn"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Ali Mahmoud</td>
                        <td>1/8/2020</td>
                        <td>BackEnd</td>
                        <td class="text-success">Attended</td>
                        <td>
                            <a href="#" id="edit-session-btn"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Ali Mahmoud</td>
                        <td>1/8/2020</td>
                        <td>BackEnd</td>
                        <td class="text-success">Attended</td>
                        <td>
                            <a href="#" id="edit-session-btn"><i class="fa fa-edit"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>
</div>
<!-- /#page-content-wrapper -->

