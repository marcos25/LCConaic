<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">

        <title>Panel Administrador</title>
        <style>
            .dropdown-item {
                display: block;
                width: 100%;
                padding: 0.25rem 1.5rem;
                clear: both;
                font-weight: 400;
            
                text-align: inherit;
                white-space: nowrap;
                background-color: transparent;
                border: 0;
            }

            .dropdown-item:hover, .dropdown-item:focus {
                color: #16181b;
                text-decoration: none;
                background-color: #f8f9fa;
            }

            .dropdown-item.active, .dropdown-item:active {
                color: #fff;
                text-decoration: none;
                
            }

            .dropdown-item.disabled, .dropdown-item:disabled {
                color: #6c757d;
                pointer-events: none;
                background-color: transparent;
            }
        </style>

        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

        <!-- Bootstrap Core CSS -->
        <link href="/css/estilosAdmin/bootstrap.min.css" rel="stylesheet">

        <!-- MetisMenu CSS -->
        <link href="/css/estilosAdmin/metisMenu.min.css" rel="stylesheet">

        <!-- Timeline CSS -->
        <link href="/css/estilosAdmin/timeline.css" rel="stylesheet">

        <!-- Custom CSS -->
        <link href="/css/estilosAdmin/startmin.css" rel="stylesheet">

        <!-- Morris Charts CSS -->
        <link href="/css/estilosAdmin/morris.css" rel="stylesheet">

        <!-- Custom Fonts -->
        <link href="/css/estilosAdmin/font-awesome.min.css" rel="stylesheet" type="text/css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body>

        <div id="wrapper">

            <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
                @include('panelAdministrador.includes.navbar')
            </nav>

            @yield('content')
            
        </div>

        <!-- jQuery -->
        <script src="/js/estilosAdmin/jquery.min.js"></script>

        <!-- Bootstrap Core JavaScript -->
        <script src="/js/estilosAdmin/bootstrap.min.js"></script>

        <!-- Metis Menu Plugin JavaScript -->
        <script src="/js/estilosAdmin/metisMenu.min.js"></script>

        <!-- Custom Theme JavaScript -->
        <script src="/js/estilosAdmin/startmin.js"></script>

    </body>
</html>