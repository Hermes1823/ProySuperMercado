
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>Atlantis Lite - Bootstrap 4 Admin Dashboard</title>
        <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />

        <title>SUPERMERCADO</title>
        <link rel="icon" href="assets/img/icon.ico" type="image/x-icon"/>
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="select2-dark-adminlte-theme.css">


        <!-- Fonts and icons -->
        <script src="assets/js/plugin/webfont/webfont.min.js"></script>
        <script>
            WebFont.load({
                google: {"families":["Lato:300,400,700,900"]},
                custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['/assets/css/fonts.min.css']},
                active: function() {
                    sessionStorage.fonts = true;
                }
            });
        </script>
         <!-- Custom fonts for this template-->
        <link href="{{asset('vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
        <link
            href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
            rel="stylesheet">

        <!-- CSS Files -->
        <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
        <link rel="stylesheet" href="/assets/css/atlantis.min.css">

        <!-- CSS Just for demo purpose, don't include it in your project -->
        <link rel="stylesheet" href="/assets/css/demo.css">
        <meta name="csrf-token" content="{{ csrf_token() }}">


        <script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/highcharts-3d.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>
<script src="https://code.highcharts.com/modules/accessibility.js"></script>
        @yield('css')
        @livewireStyles
    </head>
    <body data-background-color="dark">

        <div class="wrapper">
            <div class="main-header">
                <!-- Logo Header -->
                <div class="logo-header" data-background-color="dark2" >

                    <a href="{{route('dashboard')}}" class="logo" style="margin-right: auto;margin-left:auto">
                        <img src="/imagenes/logo.jpg" alt="navbar brand" class="navbar-brand"

                         style="max-width:60px; height: auto;border-radius: 6px"
                        >
                    </a>
                    <button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon">
                            <i class="icon-menu"></i>
                        </span>
                    </button>
                    <button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
                    <div class="nav-toggle">
                        <button class="btn btn-toggle toggle-sidebar">
                            <i class="icon-menu"></i>
                        </button>
                    </div>
                </div>
                <!-- End Logo Header -->

                <!-- Navbar Header -->
                <nav class="navbar navbar-header navbar-expand-lg" data-background-color="dark">


                    <div class="container-fluid">
                        @yield('buscar')
                        <ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
                            <li class="nav-item toggle-nav-search hidden-caret">
                                <a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
                                    <i class="fa fa-search"></i>
                                </a>
                            </li>

                            {{-- Menu deplegable de Usuario --}}
                            <li class="nav-item dropdown hidden-caret">
                                <a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
                                    
                                </a>
                                <ul class="dropdown-menu dropdown-user animated fadeIn">
                                    <div class="dropdown-user-scroll scrollbar-outer">
                                        <li>
                                            <div class="user-box">
                                                
                                                <div class="u-text">
                                                    <h2>{{ Auth::user()->name }}</h2>
                                                    <p class="text-muted">{{ Auth::user()->email }}</p>

                                                    <form action="{{route('usuarioo.update',Auth::user()->id)}}" method="POST" enctype="multipart/form-data">
                                                        @method('PUT')
                                                        @csrf
                                                        <div class="d-flex">
                                                            <label for="archivo" class="bg-primary editar_foto p-2 rounded text-white">Editar</label>
                                                            <input type="file" name="file_fotoPerfil" style="display: none" id="archivo"
                                                                   value="{{ old('file_fotoPerfil') }}" x-data="showImagePerfil()" @change="showPreview(event)" accept="image/*">
                                                            <br>
                                                            <button class="btn btn-outline-secondary p-2 mx-1">Guardar</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item" href="{{route('indexU')}}"  >
                                                <i class="  fa-sm fa-fw mr-2 text-gray-400"></i>
                                                Listar Empleados
                                            </a>
                                            <div class="dropdown-divider"></div>
                                            <a class="dropdown-item btn btn-danger" href="#" data-toggle="modal" data-target="#logoutModal">
                                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                                <span> SALIR </span>
                                            </a>
                                        </li>
                                    </div>
                                </ul>
                            </li>

                        </ul>
                    </div>
                </nav>
                <!-- End Navbar -->
            </div>

            <!-- Sidebar -->
            <div class="sidebar sidebar-style-2" data-background-color="dark2">
                <div class="sidebar-wrapper scrollbar scrollbar-inner">
                    <div class="sidebar-content">
                        <div class="user">
                            
                            <div class="info">
                                <a href="{{route('dashboard')}}" class="nav-link">
                                    <span>
                                        <span>Nombre:</span>
                                        <span><b style="color: white">{{ Auth::user()->name }}</b></span>
                                        <span>Cargo:</span>
                                        <span class="user-level" style="color: white">{{ Auth::user()->rol }}</span>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <ul class="nav nav-primary">
                            <li class="nav-section">
                                <span class="sidebar-mini-icon">
                                    <i class="fa fa-ellipsis-h"></i>
                                </span>
                                <h4 class="text-section">MENÚ PRINCIPAL</h4>
                            </li>
                            @if (Auth::user()->idrol != 3)
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#productos">
                                    <i class="fas fa-layer-group"></i>
                                    <p>Mantenedores Principales</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="productos">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="{{ route('product.index') }}">
                                                <span class="sub-item">Productos</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        @endif
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#base">
                                    <i class="fas fa-layer-group"></i>
                                    <p>Subsistema Almacén</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="base">
                                    <ul class="nav nav-collapse">

                                        <li>
                                            <a href="{{route('Almacen.index')}}">
                                                <span class="sub-item">Almacen</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('Montacarga.index')}}">
                                                <span class="sub-item">Montacargas</span>
                                            </a>
                                        </li>


                                        <li>
                                            <a href="{{route('Almacenero.index')}}">
                                                <span class="sub-item">Detalle Almacen</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#compras">
                                    <i class="fas fa-shopping-basket" style="color: #ffffff;"></i>
                                    <p>Subsistema Compras</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="compras">
                                    <ul class="nav nav-collapse">

                                        <li>
                                            <a href="{{route('requisitionOrders.index')}}">
                                                <span class="sub-item">Órdenes de Requisición</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('solicitud-cotizacion.index')}}">
                                                <span class="sub-item">Solicitudes de cotización</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>

                            </li>

                            <li class="nav-item">
                                <a data-toggle="collapse" href="#RRHH">
                                    <i class="fas fa-layer-group"></i>
                                    <p>Subsistema RRHH</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="RRHH">
                                    <ul class="nav nav-collapse">

                                        <li>
                                            <a href="{{route('postulante.index')}}">
                                                <span class="sub-item">Postulantes</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('convocatoria.index')}}">
                                                <span class="sub-item">Convocatorias</span>
                                            </a>
                                        </li>


                                        <li>
                                            <a href="{{route('postulante.index')}}">
                                                <span class="sub-item">Resultados</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li class="nav-item">
                                <a data-toggle="collapse" href="#marketing">
                                    <i class="fas fa-shopping-basket" style="color: #ffffff;"></i>
                                    <p>Subsistema Marketing</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="marketing">
                                    <ul class="nav nav-collapse">

                                        <li>
                                            <a href="{{ route('segundo') }}" class="btn btn-primary">tienda online</a>

                                        </li>


                                        <li>
                                            <a href="{{route('cliente.index')}}">
                                                <span class="sub-item">Clientes</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('cliente.index')}}">
                                                <span class="sub-item">Clientes</span>
                                            </a>
                                            
                                        </li>

                                        <li>
                                            <a href="{{route('cupon.index')}}">
                                                <span class="sub-item">Cupones</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('pregunta.index')}}">
                                                <span class="sub-item">Preguntas de encuesta</span>
                                            </a>
                                        </li>


                                        <li>
                                            <a href="{{route('detalleencuesta.index')}}">
                                                <span class="sub-item">Encuestas de satisfaccion</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="#">
                                                <span class="sub-item">Respuestas de encuesta</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{route('promocion.index')}}">
                                                <span class="sub-item">Promociones</span>
                                            </a>
                                        </li>

                                    </ul>
                                </div>
                            </li>

                            



                            <li class="nav-item">
                                <a data-toggle="collapse" href="#config">
                                    <i class="fas fa-cog"></i>
                                    <p>Configuracion</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="config">
                                    <ul class="nav nav-collapse">

                                        <li>
                                            <a href="{{route('Roles.index')}}">
                                                <span class="sub-item">Roles</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('indexU')}}">
                                                <span class="sub-item">Usuarios</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#report">
                                    <i class="fas fa-chart-bar"></i>
                                    <p>Reportes</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="report">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="{{route('Informe.index')}}">
                                                <span class="sub-item">Informe del almacén</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{route('reporte-subcompras')}}">
                                                <span class="sub-item">Módulo de compras</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>   
                            </li>
                            <li class="nav-item">
                                <a data-toggle="collapse" href="#sidebarLayouts">
                                    <i class="fas fa-th-list"></i>
                                    <p>Sidebar Layouts</p>
                                    <span class="caret"></span>
                                </a>
                                <div class="collapse" id="sidebarLayouts">
                                    <ul class="nav nav-collapse">
                                        <li>
                                            <a href="static-sidebar.html">
                                                <span class="sub-item">Static Sidebar</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="icon-menu.html">
                                                <span class="sub-item">Icon Menu</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- End Sidebar -->

            <div class="main-panel">
                <div class="content">
                    <div class="page-inner">
                        <div class="mt-2 mb-4">
                           <!-- <h2 class="text-white pb-2">Bienvenido al supermercado Barat</h2> -->
                            @yield('contenido')
                        </div>
                    </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav class="pull-left">
                            <ul class="nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="https://www.themekita.com">
                                        ThemeKita
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Help
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">
                                        Licenses
                                    </a>
                                </li>
                            </ul>
                        </nav>
                        <div class="copyright ml-auto">
                            2018, made with <i class="fa fa-heart heart text-danger"></i> by <a href="https://www.themekita.com">ThemeKita</a>
                        </div>
                    </div>
                </footer>
            </div>

            <!-- Custom template | don't include it in your project! -->
            <div class="custom-template">
                <div class="title">Settings</div>
                <div class="custom-content">
                    <div class="switcher">
                        <div class="switch-block">
                            <h4>Logo Header</h4>
                            <div class="btnSwitch">
                                <button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="blue"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
                                <br/>
                                <button type="button" class="selected changeLogoHeaderColor" data-color="dark2"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
                                <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
                            </div>
                        </div>
                        <div class="switch-block">
                            <h4>Navbar Header</h4>
                            <div class="btnSwitch">
                                <button type="button" class="selected changeTopBarColor" data-color="dark"></button>
                                <button type="button" class="changeTopBarColor" data-color="blue"></button>
                                <button type="button" class="changeTopBarColor" data-color="purple"></button>
                                <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
                                <button type="button" class="changeTopBarColor" data-color="green"></button>
                                <button type="button" class="changeTopBarColor" data-color="orange"></button>
                                <button type="button" class="changeTopBarColor" data-color="red"></button>
                                <button type="button" class="changeTopBarColor" data-color="white"></button>
                                <br/>
                                <button type="button" class="changeTopBarColor" data-color="dark2"></button>
                                <button type="button" class="changeTopBarColor" data-color="blue2"></button>
                                <button type="button" class="changeTopBarColor" data-color="purple2"></button>
                                <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
                                <button type="button" class="changeTopBarColor" data-color="green2"></button>
                                <button type="button" class="changeTopBarColor" data-color="orange2"></button>
                                <button type="button" class="changeTopBarColor" data-color="red2"></button>
                            </div>
                        </div>
                        <div class="switch-block">
                            <h4>Sidebar</h4>
                            <div class="btnSwitch">
                                <button type="button" class="changeSideBarColor" data-color="white"></button>
                                <button type="button" class="changeSideBarColor" data-color="dark"></button>
                                <button type="button" class="selected changeSideBarColor" data-color="dark2"></button>
                            </div>
                        </div>
                        <div class="switch-block">
                            <h4>Background</h4>
                            <div class="btnSwitch">
                                <button type="button" class="changeBackgroundColor" data-color="bg2"></button>
                                <button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
                                <button type="button" class="changeBackgroundColor" data-color="bg3"></button>
                                <button type="button" class="selected changeBackgroundColor" data-color="dark"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="custom-toggle">
                    <i class="flaticon-settings"></i>
                </div>
            </div>
            <!-- End Custom template -->
            <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                    <div class="modal-footer">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <x-dropdown-link :href="route('logout')"
                                    onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                {{ __('salir') }}
                            </x-dropdown-link>
                        </form>
                    </div>
                </div>
            </div>
        </div>
            </div>
        <!--   Core JS Files   -->
        <script src="/assets/js/core/jquery.3.2.1.min.js"></>
        <script src="/assets/js/core/popper.min.js"></script>
        <script src="/assets/js/core/bootstrap.min.js"></script>

        <!-- jQuery UI -->
        <script src="/assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
        <script src="/assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

        <!-- jQuery Scrollbar -->
        <script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


        <!-- Chart JS -->
        <script src="/assets/js/plugin/chart.js/chart.min.js"></script>

        <!-- jQuery Sparkline -->
        <script src="/assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

        <!-- Chart Circle -->
        <script src="/assets/js/plugin/chart-circle/circles.min.js"></script>

        <!-- Datatables -->
        <script src="/assets/js/plugin/datatables/datatables.min.js"></script>

        <!-- Bootstrap Notify -->
        <script src="/assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

        <!-- jQuery Vector Maps -->
        <script src="{{asset('assets/js/plugin/jqvmap/jquery.vmap.min.js')}}"></script>
        <script src="{{asset('assets/js/plugin/jqvmap/maps/jquery.vmap.world.js')}}"></script>

        <!-- Sweet Alert -->
        <script src="/assets/js/plugin/sweetalert/sweetalert.min.js"></script>

        <!-- Atlantis JS -->
        <script src="{{asset('assets/js/atlantis.min.js')}}"></script>

        <!-- Atlantis DEMO methods, don't include it in your project! -->
        <script src="{{asset('assets/js/setting-demo.js')}}"></script>
        <script src="{{asset('assets/js/demo.js')}}"></script>
        <script>
            $('#lineChart').sparkline([102,109,120,99,110,105,115], {
                type: 'line',
                height: '70',
                width: '100%',
                lineWidth: '2',
                lineColor: 'rgba(255, 255, 255, .5)',
                fillColor: 'rgba(255, 255, 255, .15)'
            });

            $('#lineChart2').sparkline([99,125,122,105,110,124,115], {
                type: 'line',
                height: '70',
                width: '100%',
                lineWidth: '2',
                lineColor: 'rgba(255, 255, 255, .5)',
                fillColor: 'rgba(255, 255, 255, .15)'
            });

            $('#lineChart3').sparkline([105,103,123,100,95,105,115], {
                type: 'line',
                height: '70',
                width: '100%',
                lineWidth: '2',
                lineColor: 'rgba(255, 255, 255, .5)',
                fillColor: 'rgba(255, 255, 255, .15)'
            });
        </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
    <script>
        function showImagePerfil() {
            return {
                showPreview(event) {
                    if (event.target.files.length > 0) {
                        var src = URL.createObjectURL(event.target.files[0]);
                        var preview = document.getElementById("preview2");
                        preview.src = src;
                        preview.style.display = "block";
                    }
                }
            }
        }
    </script>

<script type="text/javascript">
    $(document).ready(function() {
        setTimeout(function() {
            $(".emergente").fadeOut(750);
        },1500);
    });

</script>
<script src="https://kit.fontawesome.com/f9bb7aa434.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@yield('js')
@livewireScripts
</body>
    </html>

