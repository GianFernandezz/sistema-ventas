<main class="main-content position-relative border-radius-lg">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" data-scroll="false">
        <div class="container-fluid py-1 px-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Paginas</a></li>
                    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Compra</li>
                </ol>
                <h6 class="font-weight-bolder text-white mb-0">Compra (Ingresos)</h6>
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
                            <li><a class="dropdown-item border-radius-md" href="<?= base_url('perfil'); ?>"><i class="fa-solid fa-user me-1"></i> Ver perfil</a></li>
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
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <!-- <form id="saleDateForm" method="POST"> -->
                    <form action="/reporte-compras/filter" method="POST" id="purchaseDateForm">
                        <div class="row card-body">
                            <h4 class="text-center">REPORTES DE COMPRAS POR FECHA</h4>
                            <br><br><br>
                            <div class="form-group col-lg-4 ">
                                <input class="form-control" type="date" value="<?= date("Y-m-01") ?>" name="fechaInicio" id="fechaInicio" data-toggle="tooltip" data-placement="top" title="Desde:">
                            </div>
                            <div class="form-group col-lg-4 ">
                                <input class="form-control" type="date" value="<?= date("Y-m-t") ?>" name="fechaFin" id="fechaFin" data-toggle="tooltip" data-placement="top" title="Hasta:">
                            </div>
                            <div class="col-lg-4">
                                <button class="btn btn-primary" id="exportData" data-toggle="tooltip" data-placement="top" title="Filtrar Compras"><i class="fa-solid fa-filter me-2"></i>Filtro</button>
                                <a class="btn btn-danger" id="exportPdfPurchase" data-toggle="tooltip" data-placement="top" title="Exportar en PDF"><i class="fa-solid fa-file-pdf me-2" ></i>PDF</a>
                                <a class="btn btn-success" id="exportExcelPurchase" data-toggle="tooltip" data-placement="top" title="Exportar en Excel"><i class="fa-solid fa-file-excel me-2"></i>Excel</a> 
                            </div>
                        </div>
                    </form>
                </div>
                <!-- <div class="card-body px-0 pb-0"> -->
                <div class="card">
                    <div class="table-responsive">
                        <br>
                        <table class="table align-items-center mb-0" id="data-list">
                            <thead>
                                <tr>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7">Proveedor</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Fecha</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Total</th>
                                    <th class="text-uppercase text-secondary text-xs font-weight-bolder opacity-7 ps-2">Comprovante</th>
                                    <th class="text-secondary opacity-7"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($purchases as $purchase) : ?>
                                    <tr>
                                        <td><span class="text-xs font-weight-bold ps-3"><?= $purchase->supplier; ?></span></td>
                                        <td><span class="text-xs font-weight-bold"><?= date("Y-m-d", strtotime($purchase->date)); ?></span></td>
                                        <td><span class="text-xs font-weight-bold"><?= $purchase->total; ?></span></td>
                                        <td><span class="text-xs font-weight-bold"><?= $purchase->voucher; ?></span></td>

                                        <td>
                                            <div class="ms-auto text-lg d-flex px-2">
                                                <div><a class="btn btn-link px-2 mb-0 bg-gradient-warning btn-sm" data-toggle="tooltip" data-placement="top" title="Ver detalle" href="<?= base_url('reporte-compras/detail/' . $purchase->id); ?>"><i class="fa-solid fa-eye"></i></a></div>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>