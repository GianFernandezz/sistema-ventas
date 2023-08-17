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
							<img src="<?= auth()->user()->picture;?>" class="profile-img rounded-circle img-fluid border border-2 border-white me-1">
							<span class="d-sm-inline d-none "><?= auth()->user()->full_name;?></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-end px-2 py-3" aria-labelledby="dropdownMenuButton">
							<li><a class="dropdown-item border-radius-md" href="<?= base_url('perfil');?>"><i class="fa-solid fa-user me-1"></i> Ver perfil</a></li>
							<form method="POST" action="<?= route_to('logout');?>">
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
					<div class="card-header pb-0">
						<div class="d-md-flex">
							<div>
								<h5 class="mb-0">Todos las compras</h5>
							</div>
							<!-- //? BOTONES PARA REPORTES (Excel | PDF) -->
							<div class="ms-auto my-auto mt-lg-0 mt-4">								
								<a href="<?= base_url('reportall/downloadExcelPurchase'); ?>" class="btn bg-gradient-default me-4" data-toggle="tooltip" data-placement="top" title="Reporte Excel">
									<img src="<?= base_url('assets/img/excel.png'); ?>" alt="Download-Excel">
								</a>	
								<a href="<?= base_url('reportall/rptPurchase'); ?>" class="btn bg-gradient-default" data-toggle="tooltip" data-placement="top" title="Reporte PDF" target="_blank">
									<img src="<?= base_url('assets/img/pdf.png'); ?>" alt="Download-PDF">
								</a>							
							</div>
							<!-- //? END -- BOTONES PARA REPORTES (Excel | PDF) -->
							<div class="ms-auto my-auto mt-lg-0 mt-4">
								<div class="ms-auto my-auto">
									<a href="<?= base_url('nueva-compra');?>" class="btn bg-gradient-primary btn-sm mb-0"><i class="fa-solid fa-plus"></i> Nuevo</a>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body px-0 pb-0">
						<div class="table-responsive">
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
									<?php foreach($purchases as $purchase):?>
									<tr>
										<td><span class="text-xs font-weight-bold ps-3"><?= $purchase->supplier;?></span></td>
										<td><span class="text-xs font-weight-bold"><?= date("Y-m-d", strtotime($purchase->date));?></span></td>
										<td><span class="text-xs font-weight-bold"><?= $purchase->total;?></span></td>
										<td><span class="text-xs font-weight-bold"><?= $purchase->voucher;?></span></td>

										<td>
											<div class="ms-auto text-lg d-flex px-2">
												<div><a class="btn btn-link px-2 mb-0 bg-gradient-warning btn-sm" rel="tooltip" title="Ver detalle" href="<?= base_url('detalle-compra/'.$purchase->id);?>"><i class='bx bxs-file-find mt-1' style="font-size: 24px;"></i></a></div>
											</div>
										</td>

										<!-- <td class="text-lg pe-5">
											<span type="button" id="options" data-bs-toggle="dropdown"><i class="fa-solid fa-list"></i></span>
											<ul class="dropdown-menu" aria-labelledby="options">
												<li><a class="dropdown-item" href="<?= base_url('detalle-compra/'.$purchase->id);?>">Ver detalle</a></li>
											</ul>
										</td> -->


									</tr>
									<?php endforeach;?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>