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
            background: url('/Imagenes/lcc_bg.jpeg') no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            background-size: cover;
            -o-background-size: cover;
        }
        @media (pointer: coarse) and (hover: none) {
            header {
                background: url('/archivos/lcc_bg.jpeg') black no-repeat center center scroll;
            }
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
    <div class="container">
        @yield('content')
    </div>
    <script type="text/javascript" src="/js/bootstrap.js"></script>
    <script type="text/javascript" src="/js/jquery-3.3.1.js"></script>
    <script type="text/javascript" src="/js/bootstrap.bundle.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            var URLactual = window.location.href;
            if(URLactual == "http://proyecto_is2.test/categorias/categorias"){
                window.location="http://proyecto_is2.test/categorias";
            }
            console.log(URLactual);
        });
        $(document).ready(function(){
            $("#categorias").change(function(){
                if(URLactual == "http://proyecto_is2.test/categorias" || URLactual == "http://proyecto_is2.test/categorias/create" || URLactual == "http://proyecto_is2.test/categorias/edit") {
                $("#categorias").prop("disabled", true);
                }else{
                $("#categorias").prop("disabled", false);
                }
            })
        });
    </script>
</body>
</html>