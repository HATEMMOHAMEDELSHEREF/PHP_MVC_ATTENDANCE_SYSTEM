<div class="container">
    <div class="row">
        <div class="col-xs-12">
            </div>
            <div class="track-panel">
                <h3>Add Instructors </h3>
                <span class="text-danger hideme"><i class="fa fa-asterisk"></i> This Fields Are Required</span>
            </div>

        </div>
        <div class="col-xs-12 trackss">
            <div class="col-xs-12 add-track">
                <form autocomplete="off" novalidate method="post" action="/instructor/add" enctype="multipart/form-data">
                    <div class="col-xs-6 tracks-left-side">
                        <div class="form-group">
                            <label><span class="text-dark">Instructor Name <span class="text-danger hideme "><i class="fa fa-asterisk"></i></span></span></label>
                            <input type="text" name="instructor_name" class="form-control" id="instructor_name"  placeholder="Instructor Name">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Instructor Email <span class="text-danger hideme "><i class="fa fa-asterisk"></i></span></span></label>
                            <input type="text" name="instructor_email" class="form-control" id="instructor_email"  placeholder="Instructor Email">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Instructor Phone <span class="text-danger hideme "><i class="fa fa-asterisk"></i></span></span></label>
                            <input type="text" name="instructor_phone" class="form-control" id="instructor_phone"  placeholder="Instructor Phone">
                        </div>

                    </div>
                    <div class="col-xs-6 tracks-right-side">
                        <div class="form-group">
                            <label><span class="text-dark">Instructor Avatar</span></label>
                            <input type="file" name="instructor_avatar" class="form-control"  placeholder="Instructor Avatar">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Instructor Password <span class="text-danger hideme "><i class="fa fa-asterisk"></i></span></span></label>
                            <input type="password" name="instructor_password" id="instructor_password" class="form-control"  placeholder="Instructor Password">
                        </div>
                        <div class="form-group">
                            <label><span class="text-dark">Save</span></label>
                            <button type="submit" class="btn btn-primary form-control" id="add_instructor">Save</button>
                        </div>
                    </div>


                </form>
            </div>

        </div>

    </div>
</div>
<!-- /#page-content-wrapper -->


