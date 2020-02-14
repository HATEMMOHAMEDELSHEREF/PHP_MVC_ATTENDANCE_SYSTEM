<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Hatem Mohamed Elsheref">

    <title>Forget Password</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/auth.min.css" rel="stylesheet">

</head>
<body>
<div class="container">
    <div class="row">
        <div class="col-sm-6 col-md-4 centralize">
            <div class="account-wall">
                <div id="my-tab-content" class="tab-content">
                    <div class="tab-pane active" id="login">
                        <form class="form-signin" method="post" action="/authentication/forget">
                            <?php
                            if (isset($_SESSION['forget-msg'])){
                                echo '<label class="col-form-label text-danger"> * '. $_SESSION['forget-msg'].'</label>';
                            }
                            ?>
                            <input type="text" class="form-control" name="user_email" placeholder="Emaill Address ..."  autofocus>
                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Send" />
                        </form>

                        <div id="tabs" data-tabs="tabs">
                            <p class="text-center"><a href="/authentication/login">Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>>
</body>
</html>