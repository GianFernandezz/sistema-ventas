<main class="main-content position-relative border-radius-lg">
	<!-- Navbar -->
	<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" data-scroll="false">
		<div class="container-fluid py-1 px-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
					<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Paginas</a></li>
					<li class="breadcrumb-item text-sm text-white active" aria-current="page">Venta</li>
				</ol>
				<h6 class="font-weight-bolder text-white mb-0">Venta</h6>
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
		<div class="row document-detail justify-content-md-center">
			<div class="col-lg-10 col-md-12">
				<div class="text-end nprt">
					<button class="btn bg-gradient-dark mb-2" onclick="window.history.back()">Regresar</button>
					<a onclick={window.print()} class="btn bg-gradient-success mb-2"><i class="fa-solid fa-print"></i> Imprimir</a>
				</div>

				<div class="card mb-5 mt-2">
					<div class="card-header pb-0">
						<div class="d-flex">
							<div class="header">
								<h3 class="mb-1">Sitema ventas CI2</h3>
								<p><strong>Direccion: </strong> Av. sistema ventas 102</p>
								<p><strong>Teléfono: </strong> 969798 </p>
							</div>
							<div class="ms-auto my-auto mt-lg-0 mt-2">
								<img height="64" src="<?= base_url('assets/img/logo-ct-dark.svg');?>">
							</div>
						</div>
					</div>
					<div class="card-body pt-3">
						<div class="row">
							<div class="col-md-6">
								<p><strong>Cliente:</strong> <?= $sale->client;?></p>
								<p><strong><?= $sale->type_document;?>:</strong> <?= $sale->num_document;?></p>
								<p><strong>Email:</strong> <?= $sale->email;?></p>
								<p><strong>Teléfono/Celular:</strong> <?= $sale->phone_number;?></p>
							</div>
							<div class="col-md-6 text-end">
								<p><strong><?= $sale->voucher;?></strong></p>
								<p><strong>Fecha:</strong> <?= date("Y-m-d", strtotime($sale->date));?></p>
							</div>
							<div class="col-md-12">
								<div class="table-responsive">
									<table class="table align-items-center mt-5">
										<thead>
											<tr>
												<th class="ps-2">Cantidad</th>
												<th class="ps-2">Producto</th>
												<th class="ps-2">Precio</th>
												<th class="ps-2">Importe</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach($saledetails as $detail):?>
											<tr>
												<td width="10%"><span><?= $detail->cant;?></span></td>
												<td><span><?= $detail->product;?></span></td>
												<td width="10%"><span><?= $detail->pricesale;?></span></td>
												<td width="10%"><span><?= $detail->amount;?></span></td>
											</tr>
											<?php endforeach;?>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-9"></div>
							<div class="col-md-3 footer">
								<p><strong>Subtotal:</strong> <?= $sale->subtotal;?></p>
								<p><strong>Descuento:</strong> <?= $sale->igv;?></p>
								<p><strong>IGV:</strong> <?= $sale->igv;?></p>
								<div class="input-group mt-3 mb-2 pricing">
									<div class="btn btn-outline-secondary mb-0">Total</div>
									<p type="text" class="form-control" style="color: #344767 !important;">S/. <?= $sale->total;?></p>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>