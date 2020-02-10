<?php


return array(
    'HEADER_RESOURCES'=>array(
        'CSS'=>array(
            'BOOTSTRAP'              =>CSS.'bootstrap.min.css',
            'DATATABLE'              =>CSS.'datatable.css',
            'SIDEBAR'                =>CSS.'simple-sidebar.css',
            'FONT'                   =>CSS.'font-awesome.css',
            'SWEETMODAL'             =>CSS.'jquery.sweet-modal.css',
            'MYSTYLE'                =>CSS.'mystyle.css'
        ),
        'JS'=>array(
            'JQUERY'                 =>JS.'jquery.min.js',
//            'QRGENERATOR_FIRST'      =>JS.'qrious.js',
//            'QRREADER_FIRST'         =>JS.'jsQR.js',
//            'QRREADER_SECOND'        =>JS.'dw-qrscan.js'
        )
    ),
    'TEMPLATE_RESOURCES'=>array(
        'HEADER'                      =>TEMPLATE_PATH.'temp_1_header.php',
        'BODY_START'                  =>TEMPLATE_PATH.'temp_2_body_start.php',
        'SIDEBAR'                     =>TEMPLATE_PATH.'temp_3_sidebar.php',
        'NAVBAR'                      =>TEMPLATE_PATH.'temp_4_navbar.php',
        'BODY_END'                    =>TEMPLATE_PATH.'temp_5_body_end.php',
        'FOOTER'                      =>TEMPLATE_PATH.'temp_6_footer.php'
    ),
    'FOOTER_RESOURCES'=>array(
        'JS'=>array(
            'JQUERY'                 =>JS.'jquery.min.js',
            'BOOTSTRAP'              =>JS.'bootstrap.bundle.min.js',
            'DATATABLE'              =>JS.'datatable.js',
            'JQUERYDATATABLE'        =>JS.'jquery-datatable.js',
            'SWEETMODAL'             =>JS.'jquery.sweet-modal.js',
            'MAIN'                   =>JS.'main.js',
            'CUSTOM'                 =>JS.'custom.js',
        )
    )
);
