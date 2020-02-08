<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Hatem Mohamed Elsheref">

    <title>Login Now</title>

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
                        <img class="profile-img" src="/images/default_user.png" alt="">
                        <form class="form-signin" action="/authentication/login" method="post">
                            <input type="email" name="user_email" class="form-control" placeholder="Emaill Address ..." required autofocus>

                            <input type="password" name="user_password" class="form-control" placeholder="Password" required>
                            <input type="submit" class="btn btn-lg btn-primary btn-block" value="Login In" />
                        </form>

                        <div id="tabs" data-tabs="tabs">
                            <p class="text-center"><a href="/authentication/forget">Forget My Password?</a></p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
<script src="/js/jquery.min.js"></script>
<script src="/js/bootstrap.bundle.min.js"></script>
</body>
</html>