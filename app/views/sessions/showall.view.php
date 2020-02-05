<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <div class="track-panel">
                <h3>Sessions <span class="badge-primary">20</span></h3>
            </div>
        </div>

        <div class="col-xs-12 trackss">

            <div class="col-xs-12 tracks">
                <table class="table table-striped table-responsive " id="session-table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Session Name</td>
                        <td>Instructor</td>
                        <td>Date</td>
                        <td>Track</td>
                        <td>Place</td>
                        <td>Status</td>
                        <td>Controllers</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>2</td>
                        <td>PHP Basics</td>
                        <td>Ali Mahmoud</td>
                        <td>1/8/2020</td>
                        <td>BackEnd</td>
                        <td>Hall 2</td>
                        <td class="text-success">Running</td>
                        <td>
                            <a href="#" id="edit-session-btn"><i class="fa fa-edit"></i></a>
                            <a href="#"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>PHP Basics</td>
                        <td>Ali Mahmoud</td>
                        <td>1/8/2020</td>
                        <td>BackEnd</td>
                        <td>Hall 2</td>
                        <td class="text-danger">Finished</td>
                        <td>
                            <a href="#" id="edit-session-btn"><i class="fa fa-edit"></i></a>
                            <a href="#"><i class="fa fa-trash"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>PHP Basics</td>
                        <td>Ali Mahmoud</td>
                        <td>1/8/2020</td>
                        <td>BackEnd</td>
                        <td>Hall 2</td>
                        <td class="text-success">Running</td>
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

<div class="modal fade" id="modal-of-edit-session" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" >Edit Session</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>

            </div>
            <div class="modal-body">
                <form autocomplete="off" novalidate>
                    <div class="form-group">
                        <label><span class="text-dark">Session Name</span></label>
                        <input type="text" class="form-control"  placeholder="Session Name">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <a type="button" href="/sessions/edit/5" class="btn btn-success">Update</a>
            </div>
        </div>
    </div>
</div>
