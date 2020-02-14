<script>
    function AttendedSuccessfuly(){
        $.sweetModal({
            content: 'OK.',
            title: 'Attended Successfully ',
            icon: $.sweetModal.ICON_SUCCESS,
            theme: $.sweetModal.THEME_LIGHT,
            buttons: {
                'That\'s fine': {
                    classes: 'redB'
                }
            }
        });
    }
    function AlreadyAttended(){
        $.sweetModal({
            content: 'OK.',
            title: 'Student Already Attended Here ',
            icon: $.sweetModal.ICON_SUCCESS,
            theme: $.sweetModal.THEME_LIGHT,
            buttons: {
                'That\'s fine': {
                    classes: 'redB'
                }
            }
        });
    }
    function NotInTrack() {
        $.sweetModal({
            content: 'NO.',
            title: 'Student Not Found In This Track',
            icon: $.sweetModal.ICON_ERROR,
            theme: $.sweetModal.THEME_DARK,
            buttons: {
                'Cancel': {
                    classes: 'redB'
                }
            }

        });
    }
    function NotFoundStudent() {
        $.sweetModal({
            content: 'NO.',
            title: 'Student Not Found Here',
            icon: $.sweetModal.ICON_ERROR,
            theme: $.sweetModal.THEME_DARK,
            buttons: {
                'Cancel': {
                    classes: 'redB'
                }
            }

        });
    }

</script>
<div class="container absent-wrapper">
    <div class="row  row-absent">
        <span class="clearfix"></span>
        <span class="clearfix"></span>
<!--        <div class="col-xs-6">-->
<!--            <form class="form-data" autocomplete="off" novalidate>-->
<!--                <div class="form-group">-->
<!--                    <button style="margin-right: 20px" class="btn btn-danger form-control scan-absense-btn sm-btn"    id="close-student-info-btn"><i class="fa fa-power-off"></i></button>-->
<!--                </div>-->
                <!--                <div class="form-group">-->
                <!--                    <br>-->
                <!--                    <br>-->
                <!--                    <label for="student_id">Student ID</label>-->
                <!--                    <input type="text" class="form-control"  value="" id="student_id" disabled>-->
                <!--                </div>-->
                <!--                <div class="form-group">-->
                <!--                    <label for="student_name">Student Name</label>-->
                <!--                    <input type="text" class="form-control"  value="" id="student_name" disabled>-->
                <!--                </div>-->
                <!--                <div class="form-group">-->
                <!--                    <label for="student_email">Student Email</label>-->
                <!--                    <input type="text" class="form-control"  value="" id="student_email" disabled>-->
                <!--                </div>-->
                <!--                <div class="form-group">-->
                <!--                    <label for="student_phone">Student Phone</label>-->
                <!--                    <input type="text" class="form-control"   id="student_phone" disabled>-->
                <!--                </div>-->
                <!--                <div class="form-group">-->
                <!--                    <label for="student_reg_date">Date</label>-->
                <!--                    <input type="text" class="form-control" id="student_reg_date"  value="" disabled>-->
                <!--                </div>-->
<!--                <div class="form-group">-->
<!--                    <button class="btn btn-info form-control scan-absense-btn sm-btn"    id="scan-student-info-btn"><i class="fa fa-search"></i></button>-->
<!--                    <button class="btn btn-primary form-control scan-absense-btn sm-btn" id="refresh-student-info-btn" disabled><i class="fa fa-refresh"></i></button>-->
<!--                </div>-->
<!--            </form>-->
<!--        </div>-->
        <div class="col-xs-6">

<form>
    <h2>Absense OF Session <?=$_SESSION['__SESSION__NAME'];?></h2>
    <div class="form-group" id="scan-controlleres">
        <button style="margin-right: 20px" class="btn btn-danger form-control scan-absense-btn sm-btn"    id="close-student-info-btn"><i class="fa fa-power-off"></i></button>
        <button class="btn btn-info form-control scan-absense-btn sm-btn"    id="scan-student-info-btn"><i class="fa fa-search"></i></button>
        <button class="btn btn-primary form-control scan-absense-btn sm-btn" id="refresh-student-info-btn" disabled><i class="fa fa-refresh"></i></button>
    </div>

</form>
            <div class="scan-qr-to-take-absent" id="scan-controller-canvas">
                <canvas id="preview"></canvas>
                <script src="/js/jquery.min.js"></script>
                <script src="/js/jsQR.js"></script>
                <script src="/js/dw-qrscan.js"></script>
                <script>
                    $("close-student-info-btn").click(function () {
                        window.location.reload();

                    });
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
                            url: 'https://www.mufix.com/absense/takeabsense',
                            method: 'post',
                            data: {data: qrdata},
                            success: function (data) {
                                console.log(JSON.parse(data));
                                result=JSON.parse(data);
                                if (result.Status==true){
                                    if (result.func==1){
                                        AlreadyAttended();
                                    } else{
                                       AttendedSuccessfuly();
                                    }
                                } else{
                                    if ((JSON.parse(data)).func==1){
                                        NotFoundStudent();
                                    }else if ((JSON.parse(data)).func==2){
                                        NotFoundStudent();
                                    }else if ((JSON.parse(data)).func==3){
                                        NotInTrack();
                                    }else{

                                    }
                                }
                            }
                        });
                    }
                </script>
            </div>
        </div>

        <!-- /#page-content-wrapper -->

