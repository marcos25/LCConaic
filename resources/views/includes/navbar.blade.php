<div class="container">
    <a style="color:black !important;" class="navbar-brand" href="/"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a style="color:black !important;" class="nav-link" href="/">Inicio</a>
            </li>
            @if (auth()->user()->categoria)
                <li class="nav-item">
                    <a style="color:black !important;" class="nav-link" id="home" href="{{route('categorias.show', auth()->user()->categoria->id)}}" disabled="">Área</a>
                </li>
                
            @endif
            <li class="nav-item active">
                <a style="color:black !important;" class="nav-link" href="/notificaciones">Notificaciones</a>
            </li>
        </ul>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
                <a style="color:black !important;" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ auth()->user()->nombre }} 
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" style = "color:black !important;" href="{{ route('academico.editPerfil', auth()->user()->id) }}">Perfil</a>
                    @if (auth()->user()->privilegio == 1)
                            <a style="color:black !important;" class="dropdown-item" id="categorias" href="/categorias" disabled="">Áreas</a>
                            
                            <a style="color:black !important;" class="dropdown-item" id="categorias" href="/notificacion/lista" disabled="">Notificaciones</a>
                         
                            <a style="color:black !important;" class="dropdown-item" href="/academicos">Usuarios</a>

                    @endif
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item" >Cerrar sesión</button>
                    </form>
                </div>
            </li>
        </ul>
        
    </div>
</div>
