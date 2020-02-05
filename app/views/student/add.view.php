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
                <script src="js/qrious.js"></script>
                <script src="js/jquery.min.js"></script>

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
                    // alert(image);
                </script>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-xs-12 trackss">
            <div class="col-xs-12 add-track">
                <form autocomplete="off" novalidate>

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
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                        </select>
                    </div>
                    <label><span class="text-dark">Tracks</label>
                    <div class="tracks-choice">
                        <div class="row">
                            <div class="track-item">
                                <div class="funkyradio-danger">
                                    <div class="funkyradio-md">
                                        <input type="checkbox" name="radio-md" id="radio-md-1" value="1">
                                        <label for="radio-md-1">JAVAFX</label>
                                    </div>
                                </div>
                            </div>
                            <div class="track-item">
                                <div class="funkyradio-danger">
                                    <div class="funkyradio-md">
                                        <input type="checkbox" name="radio-md" id="radio-md-2" value="1">
                                        <label for="radio-md-2">C++</label>
                                    </div>
                                </div>
                            </div>
                            <div class="track-item">
                                <div class="funkyradio-danger">
                                    <div class="funkyradio-md">
                                        <input type="checkbox" name="radio-md" id="radio-md-3" value="1">
                                        <label for="radio-md-3">FrontEnd</label>
                                    </div>
                                </div>
                            </div>
                            <div class="track-item">
                                <div class="funkyradio-danger">
                                    <div class="funkyradio-md">
                                        <input type="checkbox" name="radio-md" id="radio-md-4" value="1">
                                        <label for="radio-md-4">BackEnd</label>
                                    </div>
                                </div>
                            </div>
                            <div class="track-item">
                                <div class="funkyradio-danger">
                                    <div class="funkyradio-md">
                                        <input type="checkbox" name="radio-md" id="radio-md-5" value="1">
                                        <label for="radio-md-5">AI & Machine Learning</label>
                                    </div>
                                </div>
                            </div>
                            <div class="track-item">
                                <div class="funkyradio-danger">
                                    <div class="funkyradio-md">
                                        <input type="checkbox" name="radio-md" id="radio-md-6" value="1">
                                        <label for="radio-md-6">Problem Solving</label>
                                    </div>
                                </div>
                            </div>
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
