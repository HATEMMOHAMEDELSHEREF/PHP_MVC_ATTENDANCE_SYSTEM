
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
                    <a  class="btn btn-success form-control scan-absense-btn sm-btn disabled" id="edit-student-info-btn" ><i class="fa fa-edit"></i></a>
                    <a class="btn btn-danger form-control scan-absense-btn sm-btn disabled"
                       id="remove-student-info-btn" onclick="return (confirm('Do You Sure To Remove This Student'))?true:false"
                    ><i class="fa fa-trash"></i></a>
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
        <!-- /#page-content-wrapper -->

