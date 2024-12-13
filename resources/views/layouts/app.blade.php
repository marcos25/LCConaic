<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
</head>
<body>
    <style>
        body {
            /* https://source.unsplash.com/twukN12EN7c/1920x1080 */
            /* background: url('/Imagenes/lcc_bg.jpeg') no-repeat center center fixed; */
            /* background: linear-gradient(to right, #00E633, #33AEFF); */
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }
        @media (pointer: coarse) and (hover: none) {
           
            header video {
                display: none;
            }
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
            /*table-layout:fixed;*/
            overflow: auto;


            
        }
        th{
            text-align: center;
        }

        .list-group{
            max-height: 300px;
            margin-bottom: 10px;
            overflow:scroll;
            
            -webkit-overflow-scrolling: touch;
        }
        .panel-primary{
            width: 50%;
        }

        .pretty-btn {
            color: black; 
            background-color: hsl(360, 100%, 73%, 0.5); 
            border-color: black;
        }

        .background-style {
            background-color:hsl(192, 100%, 75%,0.8);
        }
        
    </style>
    
    <!-- Navigation --> 
    <nav class="navbar navbar-expand-lg navbar-dark bg-light static-top mb-5 shadow">
        @include('includes.navbar')
    </nav>

    <div class="container">
        @yield('content')
    </div>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/js/bootstrap.bundle.js"></script>
</body>
</html>