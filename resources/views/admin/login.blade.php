<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/admin/reset.css">
    <link rel="stylesheet" href="css/admin/supersized.css">
    <link rel="stylesheet" href="css/admin/style.css">
</head>

<body>
    <div class="page-container">
        <h1>Login</h1>
        <form method="post" action="{{url('/admin-login-login')}}">
            {{csrf_field()}}
            <input type="text" name="name" id='admin_name' class="username" placeholder="Username">
            <input type="password" name="password" id='admin_pwd' class="password" placeholder="Password">

            <button type="submit" id='button'>It's too late to explain. poke me</button>
            <div class="error">
                @if(count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </form>
        <div class="connect">
            <p>We sell milk powder together</p>
        </div>
    </div>
    <div align="center" style="margin-top: 2%">
        @if(count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>

    <!-- Javascript -->
    <script src="js/jquery-1.9.1.min.js"></script>
    <script src="js/supersized.3.2.7.min.js"></script>
    <script src="js/supersized-init.js"></script>
</body>
</html>



