<main class="main-content position-relative border-radius-lg" id="profile">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="javascript:;">Paginas</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Cargar Excel</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Cargar Excel</h6>
            </nav>
            <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4">
                <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                    <div class="input-group-search">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input type="text" class="form-control" placeholder="Buscar...">
                    </div>
                </div>
                <!-- MODO DARK -->
                <div class="px-3 d-flex align-items-center">
                    <div class="bx bxs-moon text-white" style="font-size: 22px; cursor: pointer;" id="dark-version" onclick="darkMode(this)"></div>
                </div>
                <ul class="navbar-nav justify-content-end">
                    <li class="nav-item dropdown auth-dropdown px-3 d-flex align-items-center">
                        <a class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="<?= auth()->user()->picture; ?>" class="profile-img rounded-circle img-fluid border border-2 border-white me-1">
                            <span class="d-sm-inline d-none "><?= auth()->user()->full_name; ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item border-radius-md" :href=""><i class="fa-solid fa-user me-1"></i> Ver perfil</a></li>
                            <form method="POST" action="<?= route_to('logout'); ?>">
                                <li><button class="dropdown-item border-radius-md" type="submit"><i class="fa-solid fa-right-from-bracket me-1"></i> Cerrar sessión</button></li>
                            </form>
                        </ul>
                    </li>
                    <li class="nav-item d-xl-none ps-0 d-flex align-items-center">
                        <a class="nav-link text-white p-0" onclick="toggleSidenav()">
                            <div class="sidenav-toggler-inner">
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                                <i class="sidenav-toggler-line bg-white"></i>
                            </div>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- End Navbar -->
    <div class="container-fluid py-4">
        <div class="col-lg-12 col-md-12">
            <div class="card mb-4">
                <div class="row">
                    <div class="col-lg-4">

                        <div class="position-relative">
                            <div class="blur-shadow-image p-3">
                                <img class="w-100 rounded-3 shadow-lg" height="350px" src="<?= base_url('assets/img/charge-excel.png'); ?>">
                            </div>
                        </div>

                    </div>
                    <div class="col-lg-7 ps-0 my-auto">
                        <div class="card-body text-left">
                            <div class="p-md-0 pt-3">
                                <h5 class="font-weight-bolder mb-0"><?= auth()->user()->full_name; ?></h5>
                                <p class="text-uppercase text-sm font-weight-bold mb-2">Vendedor 1</p>
                            </div>
                            <p class="mb-4">Success is not final, failure is not fatal: it is the courage to continue that counts...
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae omnis quos sequi, itaque modi blanditiis excepturi doloremque consequuntur repudiandae sit.
                            </p>
                            <a type="button" class="btn bg-gradient-success mb-2" href="<?= base_url('charge_excel/formatoExcel'); ?>" target="_blank">
                                <i class="fa-solid fa-file-excel fa-xl me-1"></i>
                                Descargar formato Excel
                            </a>
                            <a type="button" class="btn bg-gradient-success mb-2" href="<?= base_url('assets/excel/template-categoria.xlsx'); ?>" download="formato-data-cat.xlsx" target="_blank">
                                <i class="fa-solid fa-file-excel fa-xl me-1"></i>
                                Descargar formato Excel | template
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        
            <!-- PARTE DE FORM PARA SELECCIONAR ARCHIVO XLSX -->
            <div class="row">
                <div class="col-lg-6">
                    <div class="card mb-4">
                        <div class="row">
                            <div class="card-body">
                                <h4 class="card-title text-info text-gradient">Seleccionar Archivo de Carga (Excel):
                                <span class="text-gradient text-success text-uppercase text-lg font-weight-bold my-2">Categoria</span>
                                </h4>
                                
                                <br>
                                
                                <form method="post" action="<?= base_url('charge_excel/categoriaImport'); ?>"  enctype="multipart/form-data" id="form_carga_categorias">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <input type="file" name="fileCategorias" id="fileCategorias" class="form-control" accept=".xls, .xlsx">
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="submit" value="Cargar Categoria" class="btn btn-primary" id="btnCargar">
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- ./ end card-body -->
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="card mb-2">
                        <div class="row">
                            <div class="card-body">
                                <h4 class="card-title text-info text-gradient">Seleccionar Archivo de Carga (Excel):
                                <span class="text-gradient text-success text-uppercase text-lg font-weight-bold my-2">Producto</span>
                                </h4>
                                <br>
                                <form method="post" enctype="multipart/form-data" id="form_carga_productos">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <input type="file" name="fileProductos" id="fileProductos" class="form-control" accept=".xls, .xlsx">
                                        </div>
                                        <div class="col-lg-2">
                                            <input type="submit" value="Cargar Productos" class="btn btn-primary" id="btnCargar">
                                        </div>
                                    </div>
                                </form>
                            </div> <!-- ./ end card-body -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="card bg-gradient-default">
                <div class="card-body">
                    <h3 class="card-title text-info text-gradient">Testimonial</h3>
                    <blockquote class="blockquote text-white mb-0">
                        <p class="text-dark ms-3">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                        <footer class="blockquote-footer text-gradient text-info text-sm ms-3">Someone famous in <cite title="Source Title">Source Title</cite></footer>
                    </blockquote>
                </div>
            </div>