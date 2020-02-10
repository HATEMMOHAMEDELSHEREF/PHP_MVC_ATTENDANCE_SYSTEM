
<div class="container absent-wrapper">
    <div class="row  row-absent">
        <span class="clearfix"></span>
        <div class="col-xs-6">
            <form class="form-data" autocomplete="off" novalidate>
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
                    <button class="btn btn-success form-control scan-absense-btn sm-btn" id="scan-student-info-btn"> SCAN </button>
                    <button class="btn btn-danger form-control scan-absense-btn sm-btn" id="stop-student-info-btn" disabled> Reload </button>
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
                    $('#stop-student-info-btn').click(function (e) {
                        window.location.reload();

                    });
                    DWTQR('preview');
                    $('#scan-student-info-btn').click(function (e) {
                        dwStartScan();
                        e.preventDefault();
                        $('#stop-student-info-btn').attr('disabled',false);
                        $(this).attr('disabled',true);
                    });
                    function dwQRReader(qrdata){
                        $.ajax({
                            url: 'https://www.mufix.com/student/parse',
                            method: 'post',
                            data: {data: qrdata},
                            success: function (data) {
                                console.log(JSON.parse(data));
                                if ((JSON.parse(data)).Status==true){
                                    good();
                                    var Student=JSON.parse(data).Data[0];
                                    $('#student_id').val(Student.student_id);
                                    $('#student_name').val(Student.student_name);
                                    $('#student_email').val(Student.student_email);
                                    $('#student_phone').val(Student.student_phone);
                                    $('#student_reg_date').val(Student.student_register_date);
                                }else{
                                    test();
                                }

                            }
                        });
                    }
                </script>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

