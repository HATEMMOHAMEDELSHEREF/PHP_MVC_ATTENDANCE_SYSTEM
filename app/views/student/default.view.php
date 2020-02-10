<div class="container">
    <div class="row">
        <div class="col-xs-12 student-heading">
            <?php
            if (isset($_SESSION['student'])){
                echo '<div class="alert alert-'.$_SESSION['student']['Type'].' '.$_SESSION['student']['Type'].'-operation" style="visibility: hidden" id="MESSAGE">
                '.$_SESSION['student']['Msg'].'
                </div>';
                unset($_SESSION['student']);
            }
            ?>
            <div class="col-xs-4 title-zone">
                <div class="track-panel">
                    <h3>Students <span class="badge-primary">20</span></h3>
                </div>
            </div>
            <div class="col-xs-8 qr-zone">
                <h3>
                    <canvas  id="qr"></canvas>
                </h3>

            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 trackss">

            <div class="col-xs-12 tracks">
                <table class="table table-striped table-responsive " id="student-table">
                    <thead>
                    <tr>
                        <td>ID</td>
                        <td>Student</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Track</td>
                        <td>Controllers</td>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>1</td>
                        <td>Ahmed Mohamed</td>
                        <td>ahmedmohamed@gmail.com</td>
                        <td>+2010134688</td>
                        <td>JavaFX</td>
                        <td>
                            <a href="#"><i class="fa fa-edit"></i></a>
                            <a href="#"><i class="fa fa-trash"></i></a>
                            <a href="#"><i class="fa fa-qrcode"></i></a>
                            <a href="#"><i class="fa fa-money"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Ahmed Mohamed</td>
                        <td>ahmedmohamed@gmail.com</td>
                        <td>+2010134688</td>
                        <td>FrontEnd</td>
                        <td>
                            <a href="#"><i class="fa fa-edit"></i></a>
                            <a href="#"><i class="fa fa-trash"></i></a>
                            <a href="#"><i class="fa fa-qrcode"></i></a>
                            <a href="#"><i class="fa fa-money"></i></a>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Ahmed Mohamed</td>
                        <td>ahmedmohamed@gmail.com</td>
                        <td>+2010134688</td>
                        <td>BackEnd</td>
                        <td>
                            <a href="#" id="edit-btn" ><i class="fa fa-edit"></i></a>
                            <a href="#"><i class="fa fa-trash"></i></a>
                            <a href="#" id="show-qr-btn"><i class="fa fa-qrcode"></i></a>
                            <a href="#"><i class="fa fa-money"></i></a>
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

