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

$(document).ready(function () {
   $('#scan-absense-btn').click(function () {
       DWTQR('preview');
       dwStartScan();
test();
       return false;
   });
});
function test() {
    $.sweetModal({
        content: 'NO.',
        title: 'Not Found Here',
        icon: $.sweetModal.ICON_ERROR,
        theme: $.sweetModal.THEME_DARK,
        buttons: {
            'That\'s fine': {
                classes: 'redB'
            }
        }

    });
}


// $.sweetModal({
//     content: 'OK.',
//     title: 'Attended Successfully',
//     icon: $.sweetModal.ICON_SUCCESS,
//     theme: $.sweetModal.THEME_LIGHT,
//     buttons: {
//         'That\'s fine': {
//             classes: 'redB'
//         }
//     }
// });
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
    $('#show-qr-btn').click(function () {
        $('#recipient-name').val('hatem mohamed elsheref');
        $('#modal-of-show-qr').modal('show');

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