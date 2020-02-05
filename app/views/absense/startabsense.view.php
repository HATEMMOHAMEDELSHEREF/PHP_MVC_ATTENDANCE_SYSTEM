
<div class="container absent-wrapper">
    <div class="row  row-absent">
        <span class="clearfix"></span>
        <div class="col-xs-6">
            <form class="form-data" autocomplete="off" novalidate>
                <div class="form-group">
                    <label for="InstructorName">Instructor Name</label>
                    <input type="text" class="form-control"  value="Hatem Mohamed Elsheref" disabled>
                </div>
                <div class="form-group">
                    <label for="trackname">Track Name</label>
                    <select class="form-control" disabled>
                        <option selected disabled>BackEnd</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date">Date</label>
                    <input type="text" class="form-control"  value="1/5/2020" disabled>
                </div>
                <div class="form-group">
                    <label for="sessionname">Session Name</label>
                    <select class="form-control" disabled>
                        <option selected disabled>php basics</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success form-control scan-absense-btn" id="scan-absense-btn"> SCAN </button>
                    <button class="btn btn-danger form-control"> STOP </button>
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
        <!-- /#page-content-wrapper -->

