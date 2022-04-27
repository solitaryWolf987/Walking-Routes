<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
        <title>Pet Forum</title>
        <style>
            header {
                background-color: white;
                opacity: 0.7;
                padding: 1px;
                text-align: left;
                font-size: 25px;
                color: black;
            }
            body {
                font-family: 'Nunito', sans-serif;
                color: white;
                background-image: url(/images/picture2.jpg);
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: 100% 100%;
            }

            header ul {
                float: right;
                border: 2px solid white;
                list-style-type: none;
                padding: 0;   
            }
            article {
                float: left;
                padding: 20px;
                width: 70%;
            }
            section::after {
                content: "";
                display: table;
                clear: both;
            }
            @media (max-width: 600px) {
                nav, article {
                width: 100%;
                height: auto;
            }

}
        </style>

    <!-- Main home page before logging in-->
    </head>
    <body>
        <nav class="navbar navbar-expand-lg  navbar-dark bg-dark">
            <a class="navbar-brand" href="/">Walking Routes</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item" style="float:right;">
                    <a class="nav-link " href="{{ route('login') }}" >Sign In</a>
                </li>
                <li class="nav-item" style="float:right;">
                    <a class="nav-link " href="{{ route('register') }}" >Register</a>
                </li>
                </ul>
            </div>
        </nav>
    
        <section>
            Creating new walks for all the family!
        </section>
        
    </body>
</html>