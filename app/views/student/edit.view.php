<div class="container">
    <div class="row">
        <div class="col-xs-12 student-heading">
            <div class="col-xs-4 title-zone">
                <div class="track-panel">
                    <h3>Add New Students</h3>
                </div>
            </div>
            <div class="col-xs-8 qr-zone">
                <h3>
                    <canvas  id="qr"></canvas>
                </h3>
                <script src="/js/qrious.js"></script>
                <script>
                    var qr = new QRious({
                        element: document.getElementById('qr'),
                        value: 'hatemmohamedelsheref@10155',
                        background: 'white', // background color
                        foreground: '#1a588a', // foreground color
                        backgroundAlpha: 1,
                        foregroundAlpha: 1,
                        level: 'L', // Error correction level of the QR code (L, M, Q, H)
                        mime: 'image/png', // MIME type used to render the image for the QR code
                        size: 100, // Size of the QR code in pixels.
                        padding: 10 // padding in pixels
                    });
                    var canvas = document.getElementById("qr");
                    image = canvas.toDataURL("image/png", 1.0).replace("image/png", "image/octet-stream");

                </script>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 trackss">
            <div class="col-xs-12 add-track">
                <form autocomplete="off" novalidate method="post">

                    <div class="form-group">
                        <label><span class="text-dark">Student Name</span></label>
                        <input type="text" class="form-control"  placeholder="Student Name">
                    </div>
                    <div class="form-group">
                        <label><span class="text-dark">Student Email</span></label>
                        <input type="text" class="form-control"  placeholder="Student Email">
                    </div>
                    <div class="form-group">
                        <label><span class="text-dark">Student Phone</span></label>
                        <input type="text" class="form-control"  placeholder="Student Phone">
                    </div>

                    <div class="form-group">
                        <label><span class="text-dark">Student Level</span></label>
                        <select class="form-control">
                            <option selected disabled>Select Level</option>
                            <?php
                            $Levels=array(1,2,3,4);
                            foreach($Levels as $level):?>
                                <option value="<?=$level;?>"><?=$level;?></option>
                            <?php endforeach;?>
                        </select>
                    </div>
                    <label><span class="text-dark">Tracks</label>
                    <div class="tracks-choice">
                        <div class="row">
                            <?php
                            foreach ($tracks as $track):?>
                                <div class="track-item">
                                    <div class="funkyradio-danger">
                                        <div class="funkyradio-md">
                                            <input type="checkbox" name="tracks[]" id="radio-md-<?=$track->track_id;?>" value="<?=$track->track_id;?>">
                                            <label for="radio-md-<?=$track->track_id;?>"><?=$track->track_name;?></label>
                                        </div>
                                    </div>
                                </div>

                            <?php endforeach;?>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary form-control save-add-student">Save</button>
                    </div>
                </form>
            </div>


        </div>

    </div>
</div>
<!-- /#page-content-wrapper -->
