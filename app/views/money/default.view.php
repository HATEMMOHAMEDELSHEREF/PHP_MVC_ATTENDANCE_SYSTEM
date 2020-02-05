<div class="container">
    <div class="row">
        <div class="col-xs-12 student-heading">
            <div class="col-xs-4 title-zone">
                <div class="track-panel">
                    <h3>Student Paids <span class="badge-primary">20</span></h3>
                </div>
            </div>
            <div class="col-xs-8 qr-zone">
                <h3 style="margin-top: 20px;">
                    <button class="btn btn-primary" id="add-student-paid-btn">
                        <i class="fa fa-plus"></i> Add New Paid
                    </button> </h3>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 trackss">

            <div class="col-xs-12 tracks">
                <table class="table table-striped table-responsive " id="student-table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Student ID</td>
                        <td>Student Name</td>
                        <td>Track Name</td>
                        <td>Date</td>
                        <td>Money</td>
                        <td>Controllers</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>2917</td>
                        <td>Ahmed Mohamed</td>
                        <td>JavaFX</td>
                        <td>2/2/1698</td>
                        <td>50 L.E</td>
                        <td>
                            <a href="#"><i class="fa fa-edit"></i></a>
                            <a href="#"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>1097</td>
                        <td>Ahmed Mohamed</td>
                        <td>JavaFX</td>
                        <td>2/2/1698</td>
                        <td>80 L.E</td>
                        <td>
                            <a href="#"><i class="fa fa-edit"></i></a>
                            <a href="#"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>798</td>
                        <td>Ahmed Mohamed</td>
                        <td>JavaFX</td>
                        <td>2/2/1698</td>
                        <td>10 L.E</td>
                        <td>
                            <a href="#" id="edit-student-paid-btn"><i class="fa fa-edit"></i></a>
                            <a href="#"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

    <div class="row">
        <div class="col-xs-12 student-heading">
            <div class="col-xs-4 title-zone">
                <div class="track-panel">
                    <h3>Student Paids Status <span class="badge-success">20</span> <span class="badge-danger">20</span></h3>
                </div>
            </div>
            <div class="col-xs-8 qr-zone">
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 trackss">

            <div class="col-xs-12 tracks">
                <table class="table table-hover table-responsive " id="student-paids-table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Student ID</td>
                        <td>Student Name</td>
                        <td>Track Name</td>
                        <td>Money</td>
                        <td>Status</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="bg-mysuccess">
                        <td>1</td>
                        <td>1025</td>
                        <td>Ahmed Mohamed</td>
                        <td>JavaFX</td>
                        <td>50/50 L.E</td>
                        <td class="text-success"><i class="fa fa-check-circle-o"></i></td>
                    </tr>
                    <tr class="bg-mydanger">
                        <td>1</td>
                        <td>1269</td>
                        <td>Ahmed Mohamed</td>
                        <td>JavaFX</td>
                        <td>30/50 L.E</td>
                        <td class="text-danger"><i class="fa fa-times-circle-o"></i></td>
                    </tr>
                    <tr class="bg-mysuccess">
                        <td>1</td>
                        <td>798</td>
                        <td>Ahmed Mohamed</td>
                        <td>JavaFX</td>
                        <td>50/50 L.E</td>
                        <td class="text-success"><i class="fa fa-check-circle-o"></i></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>
    </div>

</div>
<!-- /#page-content-wrapper -->


<div class="modal fade" id="modal-of-student-paid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modal-paid-title"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form autocomplete="off" novalidate>
                    <div class="form-group">
                        <canvas id="preview" width="450px" height="300px"></canvas>
                        <script>
                            function dwQRReader(qrdata){
                                $('#student-id-from-qr').val(qrdata);
                            }
                        </script>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" id="student-id-from-qr" placeholder="Search for...">
                        <span class="input-group-btn">
                               <button class="btn btn-info" type="button" id="scan-with-qr-cam-btn">Scan!</button>
                            </span>
                    </div>
                    <span id="user-name-from-qr">hatem mohamed elsheref</span>
                    <div class="form-group">
                        <label><span class="text-dark">Student Tracks</span></label>
                        <select class="form-control">
                            <option selected disabled>Select Track</option>
                            <option>C++</option>
                            <option>FrontEnd</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label><span class="text-dark">Money</span></label>
                        <input type="text" class="form-control"  placeholder="The Money">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="button" class="btn "></button>
            </div>
        </div>
    </div>
</div>
