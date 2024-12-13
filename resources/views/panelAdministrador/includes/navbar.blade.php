<div class="container">
    <a style="color:white;" class="navbar-brand" href="/">CONAIC</a>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
    </button>

    <!-- Top Navigation: Left Menu -->
    <ul class="nav navbar-nav navbar-left navbar-top-links">
        <li class="nav-item">
            <a style="color:white;" class="nav-link" href="/"> Inicio</a>
        </li>
        @if (auth()->user()->categoria)
            <li class="nav-item">
                <a style="color:white;" class="nav-link" id="home" href="{{route('categorias.show', auth()->user()->categoria->id)}}" >Mi categoría</a>
            </li>
            <li class="nav-item">
                <a style="color:white;" class="nav-link" id="evidencias" href="/evidencias" >Subir Evidencias</a>
            </li>
        @endif
    </ul>

    <!-- Top Navigation: Right Menu -->
    <ul class="nav navbar-right navbar-top-links">



        <li class="dropdown">
            <a style="color:white;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ auth()->user()->nombre }} <b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <a class="dropdown-item" style = "color:black !important;" href="{{ route('academico.editPerfil', auth()->user()->id) }}">Editar Perfil</a>
                @if (auth()->user()->privilegio == 1)
                    <a style="color:black !important;" class="dropdown-item" id="categorias" href="/categorias" disabled="">Manejo de Categorías</a>
                    <a style="color:black !important;" class="dropdown-item" id="categorias" href="/panelAdministrador" disabled="">Panel de Administrador</a>
                    <a style="color:black !important;" class="dropdown-item" href="/academicos">Manejo de Académicos</a>
                @endif
                <li class="divider"></li>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button class="dropdown-item">Cerrar sesión</button>
                </form>
            </ul>
        </li>
    </ul>
</div>


    <!-- Sidebar -->
    <div style="margin-top: 1px;" class="navbar-default sidebar" role="navigation">
        <div class="sidebar-nav navbar-collapse">

            <ul class="nav" id="side-menu">
                <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                                <span class="input-group-btn">
                                    <a href="/recomendacionesAdministrador" style="background-color:#286090 !important;" class="btn btn-primary btn-xs btn-block" type="button">
                                        Recomendaciones
                                    </a>
                                </span>
                            
                        </div> 
                        <br>
                        <div class="input-group custom-search-form">
    
                                <span class="input-group-btn">
                                    <a href="panelAdministrador" style="background-color:#286090 !important;" class="btn btn-primary btn-xs btn-block" type="button">
                                        Planes de acción
                                    </a>
                                </span>
                        </div>
                </li>
                
                @if($categorias->count() > 0)
                <br>
                    <li>
                        <p style="text-align: center;"> Categorías: </p>
                    </li>
                    @foreach ($categorias as $categoria)
                        <li>
                            <a href="{{route('categorias.show',$categoria->id)}}" class="active"><i class="fa fa fa-book fa-fw"></i> {{$categoria->nombre}}</a>
                        </li>
                    @endforeach
                @else
                <br>
                    <li>
                        <p style="text-align: center;">No hay categorías disponibles</p>
                    </li>
                @endif
                
            </ul>

        </div>
    </div>

