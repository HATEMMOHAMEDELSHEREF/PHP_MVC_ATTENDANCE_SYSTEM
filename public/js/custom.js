// $(document).ready(function() {
// $('#jquery-accordion-menu li a').click(function () {
// var path=$(this).attr('href');
// if (path=='#'){}
// else {$('#LOADDATAHERE').load(path);return false;}});
//
// $('#jquery-accordion-menu li ul li a').click(function () {
//     var path=$(this).attr('href');
//     if (path=='#'){}
//     else {$('#LOADDATAHERE').load(path);return false;}});
// });

/*
* turn on datatable plugin
* */




$(document).ready(function() {
    $('#edit-session-btn').click(function () {
        console.log('edit clicked');
        $('#recipient-name').val('hatem mohamed elsheref');
        $('#modal-of-edit-session').modal('show');

    });
} );


$(document).ready(function() {
    $('#student-table').DataTable();
} );
$(document).ready(function() {
    $('#session-table').DataTable();
} );
$(document).ready(function() {
    $('#student-absense-trace-table').DataTable();
} );
$(document).ready(function() {
    $('#student-paids-table').DataTable();
} );
$(function () {
    $('#edit-btn').click(function () {
        $('#recipient-name').val('hatem mohamed elsheref');
        $('#modal-of-edit-student').modal('show');

    });
});



$(function () {
    $('#edit-track-btn').click(function () {
        $('#recipient-name').val('hatem mohamed elsheref');
        $('#modal-of-edit-track').modal('show');

    });
});
$(function () {
    $('#edit-student-paid-btn').click(function () {
        var title="Edit Student Paid";
        $('#modal-paid-title').html(title);
        $('.modal-footer button:last-child').removeClass('btn-primary').addClass('btn-success').html('UPDATE');
        $('#modal-of-student-paid').modal('show');

    });
});

$(function () {
    $('#add-student-paid-btn').click(function () {
        var title="Add New Paid";
        $('#modal-paid-title').html(title);
        $('.modal-footer button:last-child').removeClass('btn-success').addClass('btn-primary').html('ADD');
        $('#modal-of-student-paid').modal('show');

    });
});


    $('#scan-with-qr-cam-btn').click(function () {
        var title="QR Scanner";
        $('#modal-qr-reader-title').html(title);
        $(this).removeClass('btn-info');
        $(this).addClass('btn-danger').html('stop');
        DWTQR('preview');
        dwStartScan();



    });

    
    $(document).ready(function () {
        $('#add_instructor').click(function () {
            if ($('#instructor_name').val().length==0){
                $('.hideme').addClass('showme');
                return false;
            }else if ($('#instructor_email').val().length==0){
                $('.hideme').addClass('showme');
                return false;
            }else if ($('#instructor_phone').val().length==0){
                $('.hideme').addClass('showme');
                return false;
            }else if ($('#instructor_password').val().length==0){
                $('.hideme').addClass('showme');
                return false;
            }

        });

    });


// $(document).ready(function () {
//     var qr = new QRious({
//         element: document.getElementById('qr'),
//         value: 'hatemmohamedelsheref@10155',
//         background: 'white', // background color
//         foreground: '#1a588a', // foreground color
//         backgroundAlpha: 1,
//         foregroundAlpha: 1,
//         level: 'L', // Error correction level of the QR code (L, M, Q, H)
//         mime: 'image/png', // MIME type used to render the image for the QR code
//         size: 100, // Size of the QR code in pixels.
//         padding: 10 // padding in pixels
//     });
//     var canvas = document.getElementById("qr");
//     image = canvas.toDataURL("image/png", 1.0).replace("image/png", "image/octet-stream");
//     alert(image);
//
// });
$(document).ready(function () {
    $('#MESSAGE').css('visibility','visible');
    $('#MESSAGE').fadeIn(function () {
        $('#MESSAGE').animate({
            width:'90%',
        },1000);
    });
    setTimeout(function () {
        $('#MESSAGE').fadeOut(1000);

    },5000);
});


/* Start Qr Scanner*/
// $(document).ready(function () {
//     $('#scan-student-info-btn').click(function (e) {
//         e.preventDefault();
//         DWTQR('preview');
//         dwStartScan();
//         alert('clicked');
//     });
// });
function NotFoundStudent() {
    $.sweetModal({
        content: 'NO.',
        title: 'Student Not Found Here',
        icon: $.sweetModal.ICON_ERROR,
        theme: $.sweetModal.THEME_DARK,
        buttons: {
            'Cancel': {
                classes: 'redB'
            }
        }

    });
}


function FoundStudent() {
    $.sweetModal({
        content: 'OK.',
        title: 'Student Founded ',
        icon: $.sweetModal.ICON_SUCCESS,
        theme: $.sweetModal.THEME_LIGHT,
        buttons: {
            'That\'s fine': {
                classes: 'redB'
            }
        }
    });
}


/* End Qr Scanner*/

/*
* Default Action Student Controller
* Show Qr Start
* */
$(function () {
    $('.show-qr-btn').click(function (e) {
        var path=$(this).data('value');
        $('#qr-image').attr('src',"/"+path);
        $('#modal-of-show-qr').modal('show');
        e.preventDefault();
    });

});
/*
* End Show QR
* */

/*
* Send Action Student Controller
* Send Mail Start
* */
$(function () {
    $('.send-mail').click(function (e) {
        var result=confirm('Do You Sure To Send Mail')
        if (result==true){
            var data=$(this).data('value').split('#');
            var email=data[0];
            var name=data[1];
            var qr=data[2];
            $.ajax({
                url:'https://mufix.com/student/sendmail',
                method:"post",
                data:{qr_path:qr,qr_email:email,qr_name:name},
                success:function(data){
                }
            });
        } else{
          return false
        }
    });
});
/*
* End Send Mail
* */








