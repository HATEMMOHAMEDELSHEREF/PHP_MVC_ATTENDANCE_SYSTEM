<?php

extract($this->Data);

?>


<div class="container mr-top">
    <div class="row">
        <div class="col-xl-3 col-md-6 pull-left">
            <div class="card bg-primary text-white mb-4">
                <div class="card-body"><i class="fa fa-male fa-2x"></i><span class="dash-title">Instructors (<?php echo $instructors;?>)</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/instructor/default">View Details</a>
                    <div class="small text-white">

                         <i class="fa fa-angle-right"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 pull-left">
            <div class="card bg-danger text-white mb-4">
                <div class="card-body"><i class="fa fa-group fa-2x"></i><span class="dash-title">students (<?php echo $students;?>)</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/student/showall">View Details</a>
                    <div class="small text-white">

                        <i class="fa fa-angle-right"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 pull-left">
            <div class="card bg-info text-white mb-4">
                <div class="card-body"><i class="fa fa-road fa-2x"></i><span class="dash-title">Tracks (<?php echo $tracks;?>)</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/tracks/default">View Details</a>
                    <div class="small text-white">

                        <i class="fa fa-angle-right"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 pull-left">
            <div class="card bg-owner text-white mb-4">
                <div class="card-body"><i class="fa fa-bullhorn fa-2x"></i><span class="dash-title">events (<?php echo 0?>)</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/events/default">View Details</a>
                    <div class="small text-white">

                        <i class="fa fa-angle-right"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 pull-left">
            <div class="card bg-warning text-white mb-4">
                <div class="card-body"><i class="fa fa-building fa-2x"></i><span class="dash-title">Places (<?php echo $places;?>)</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/places/default">View Details</a>
                    <div class="small text-white">

                        <i class="fa fa-angle-right"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 pull-left">
            <div class="card bg-secondary text-white mb-4">
                <div class="card-body"><i class="fa fa-qrcode fa-2x"></i><span class="dash-title">QR CODE (<?php echo $qr;?>)</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/student/default">View Details</a>
                    <div class="small text-white">

                        <i class="fa fa-angle-right"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 pull-left">
            <div class="card bg-success text-white mb-4">
                <div class="card-body"><i class="fa fa-money fa-2x"></i><span class="dash-title"> Money (<?php echo '0 LE';?>)</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/money/default">View Details</a>
                    <div class="small text-white">

                        <i class="fa fa-angle-right"></i> </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6 pull-left">
            <div class="card bg-dark text-white mb-4">
                <div class="card-body"><i class="fa fa-legal fa-2x"></i><span class="dash-title">admins (<?php echo $admins;?>)</span></div>
                <div class="card-footer d-flex align-items-center justify-content-between">
                    <a class="small text-white stretched-link" href="/instructors/admins">View Details</a>
                    <div class="small text-white">

                        <i class="fa fa-angle-right"></i> </div>
                </div>
            </div>
        </div>
    </div>
</div>