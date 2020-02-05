
<div class="container absent-wrapper">
    <div class="row  row-absent">
        <span class="clearfix"></span>
        <div class="col-xs-6">
            <form class="form-data" >
                <div class="form-group">
                    <label>Student ID</label>
                    <input type="text" class="form-control"  value="101" disabled>
                </div>
                <div class="form-group">
                    <label>Student Name</label>
                    <input type="text" class="form-control"  value="Hatem Mohamed Elsheref" disabled>
                </div>
                <div class="form-group">
                    <label for="trackname">Tracks</label>
                    <input type="text" class="form-control"  value="JAVAFX-FrontEnd" disabled>
                </div>
                <div class="form-group">
                    <label for="date">Register Date</label>
                    <input type="text" class="form-control"  value="1/5/2020" disabled>
                </div>
                <div class="form-group">
                    <button class="btn btn-success form-control scan-absense-btn" id="scan-absense-btn"> SCAN </button>
                    <button class="btn btn-danger form-control"> STOP & RELOAD </button>
                </div>
            </form>
        </div>
        <span class="clearfix"></span>
        <div class="col-xs-6">
            <div class="scan-qr-to-take-absent">
                <canvas id="preview"></canvas>
                <script>
                    function dwQRReader(qrdata){
                        alert(qrdata);
                    }
                </script>
            </div>
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
                            <a href="#"><i class="fa fa-trash"></i></a>
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
                            <a href="#"><i class="fa fa-trash"></i></a>
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
                            <a href="#"><i class="fa fa-trash"></i></a>
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

