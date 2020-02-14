<div class="clearfix"></div>

<div class="container">
    <div class="row">
        <div class="col-md-7 ">

            <div class="panel panel-default">
                <div class="panel-heading"><h1></h1></div>
                <div class="panel-body">

                    <div class="box box-info">

                        <div class="box-body">
                            <div class="col-sm-6">
                                <div  align="center"> <img alt="User Pic" src="/<?= $_SESSION['user_auth']['Data']->instructor_avatar;?>" id="profile-image1" class="img-circle img-responsive">
                                </div>
                                <br>
                            </div>
                            <div class="col-sm-6">
                                <h4 style="color:#1A588A;"><?= $_SESSION['user_auth']['Data']->instructor_name;?> </h4></span>
                                <a href="/instructor/edit/<?= $_SESSION['user_auth']['Data']->instructor_id;?>" class="btn btn-success"><i class="fa fa-edit"></i> Edit</a>
                            </div>
                            <div class="clearfix"></div>
                            <hr style="margin:5px 0 5px 0;">


                            <div class="col-sm-3 col-xs-4 tital pull-left " >Email : </div>
                            <div class="col-sm-8 col-xs-7 "><?= $_SESSION['user_auth']['Data']->instructor_email;?></div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>
                            <div class="col-sm-3 col-xs-4 tital pull-left" >Phone : </div>
                            <div class="col-sm-8"> <?= $_SESSION['user_auth']['Data']->instructor_phone;?></div>
                            <div class="clearfix"></div>
                            <div class="bot-border"></div>
                            <div class="col-sm-3 col-xs-4 tital pull-left" >Role:</div>
                            <div class="col-sm-8"><?= $_SESSION['user_auth']['Data']->instructor_role;?></div>


                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->

                    </div>


                </div>
            </div>
        </div>

    </div>
</div>



<div class="clearfix"></div>