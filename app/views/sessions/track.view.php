

<script src="/js/jquery.min.js"></script>
<script>
    function loadSessions(){
       var id=<?=$_SESSION['user_auth']['Data']->instructor_id;?>;
       var sessions;

        $.ajax({
            url:'https://www.mufix.com/sessions/getSessions',
            method:'POST',
            data:{'id':id},
           success:function (data) {

            sessions=JSON.parse(data);
           var num=0;
            var output="";
               $.each(sessions.Data,function (key,value) {
                   num++;
                   output+="<tr><td>"+value.session_id+"</td>";
                   output+="<td>"+value.session_name+"</td>";
                   output+="<td>"+value.instructor_name+"</td>";
                   output+="<td>"+value.session_date.substr(0,10)+"</td>";
                   output+="<td>"+value.track_name+"</td>";
                   output+="<td>"+value.place_name+"</td>";
                   switch (value.session_status) {
                       case 'pending':
                           output+="<td class='text-primary font-cap-bold'>"+value.session_status+"</td>";
                           output+="<td><a href='/sessions/edit/"+value.session_id+"' id='edit-session-btn'><i class='fa fa-edit'></i></a>";
                           output+="<a href='/sessions/delete/"+value.session_id+"' onclick='return (confirm(\"Do You Sure To Remove This Session\"))?true:false'><i class='fa fa-trash'></i></a></td>";
                           output+="<td><button class='btn btn-primary' onclick='start("+value.session_id+','+value.track_id+");'>Start</button></td>";

                           break;
                       case 'finished':
                           output+="<td class='text-danger font-cap-bold'>"+value.session_status+"</td>";
                           output+="<td><a href='/sessions/edit/"+value.session_id+"' id='edit-session-btn'><i class='fa fa-edit'></i></a>";
                           output+="<a href='/sessions/delete/"+value.session_id+"' onclick='return (confirm(\"Do You Sure To Remove This Session\"))?true:false'><i class='fa fa-trash'></i></a></td>";
                           output+="<td><button class='btn btn-danger' disabled>Finished</button></td>";

                           break;
                       case 'running':
                           output+="<td class='text-success font-cap-bold'>"+value.session_status+"</td>";
                           output+="<td><a href='/sessions/edit/"+value.session_id+"' id='edit-session-btn'><i class='fa fa-edit'></i></a> ";
                           output+="<a href='/sessions/delete/"+value.session_id+"' onclick='return (confirm(\"Do You Sure To Remove This Session\"))?true:false'><i class='fa fa-trash'></i></a> ";
                           output+="<a href='/absense/startabsense/'><i class='fa fa-toggle-on'></i></a> ";
                           output+="<a href='#'><i class='fa fa-power-off' id='endsession' data-value='"+value.session_id+"'></i></a></td>";
                           output+="<td><button class='btn btn-success' disabled>Runnin</button></td>";
                           break;
                       default:
                           output+="<td class='text-danger font-cap-bold'>"+value.session_status+"</td>";
                           output+="<td><a href='/sessions/edit/"+value.session_id+"' id='edit-session-btn'><i class='fa fa-edit'></i></a>";
                           output+="<a href='/sessions/delete/"+value.session_id+"' onclick='return (confirm(\"Do You Sure To Remove This Session\"))?true:false'><i class='fa fa-trash'></i></a></td>";
                           output+="<td><button class='btn btn-danger' disabled>Finished</button></td>";
                           break;
                   }
               });
               $('#sessions').html(output);
               $('#numofsessions').html(num);


           }
        });
    }
    function start(session_id,track_id) {
        $.ajax({
            url:'https://www.mufix.com/sessions/startsession',
            method:'POST',
            data:{'session_id':session_id,'track_id':track_id},
            success:function (data) {
                window.location.href="/absense/startabsense";
            }
        });

        return false;
    }
    $(document).ready(function () {
       $('#endsession').click(function (e) {
           e.preventDefault();
           var id=$('#endsession').data('value');
       $.ajax({
               url:'https://www.mufix.com/sessions/endsession',
               method:'POST',
               data:{'session_id':id},
               success:function (data) {
                   loadSessions();
               }
           });
       });
    });
    loadSessions();
</script>




<div class="container">
    <div class="row">
        <div class="col-xs-12">
            <?php
            if (isset($_SESSION['session'])){
                echo '<div class="alert alert-'.$_SESSION['session']['Type'].' '.$_SESSION['session']['Type'].'-operation" style="visibility: hidden" id="MESSAGE">
                '.$_SESSION['session']['Msg'].'
                </div>';
                unset($_SESSION['session']);
            }
            ?>
            <div class="track-panel">
                <h3>My Sessions <span class="badge-primary" id="numofsessions"></span></h3>
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
                        <td>Absense State</td>
                    </tr>
                    </thead>
                    <tbody id="sessions">
                    </tbody>
                </table>
            </div>
        </div>
        <div class="clearfix"></div>

    </div>
</div>
<!-- /#page-content-wrapper -->