<body class="g-sidenav-show bg-gray-100 prt">
	<div class="min-height-300 bg-secondary position-absolute w-100 prt"></div>
	<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4" id="sidenav-main">
		<div class="sidenav-scrollbar">
			<div class="sidenav-header">
				<a class="navbar-brand m-0" href="<?= base_url('dashboard');?>">
					<img src="<?= base_url('assets/img/logo-ct-dark.svg');?>" class="navbar-brand-img h-100">
					<span class="ms-1 font-weight-bold">Sistema Ventas CI2</span>
				</a>
			</div>
			<hr class="horizontal dark mt-0">
			<div class="collapse navbar-collapse w-auto h-auto ps" id="sidenav-collapse-main">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" href="<?= base_url('dashboard');?>" :class="dashboardClass">
							<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="ni ni-tv-2 text-success text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-1">Dashboard</span>
						</a>
					</li>
					<li class="nav-item">
						<a data-bs-toggle="collapse" href="#store" class="nav-link" aria-expanded="false">
							<div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
								<i class="fa-solid fa-box text-dark text-sm"></i>
							</div>
							<span class="nav-link-text ms-2">Almacen</span>
						</a>
						<div class="collapse" id="store">
							<ul class="nav ms-4">
								<li class="nav-item"><a class="nav-link" href="<?= base_url('categoria');?>"><span class="sidenav-normal">Categorias</span></a></li>
								<li class="nav-item"><a class="nav-link" href="<?= base_url('producto');?>"><span class="sidenav-normal">Productos</span></a></li>
								<li class="nav-item"><a class="nav-link" href="<?= base_url('carga_excel');?>"><span class="sidenav-normal">Carga Excel</span></a></li>
							</ul>
						</div>
					</li>
					<li class="nav-item">
						<a data-bs-toggle="collapse" href="#buy" class="nav-link" aria-expanded="false">
							<div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
								<i class="fa-solid fa-truck-fast text-dark text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-2">Compras</span>
						</a>
						<div class="collapse" id="buy">
							<ul class="nav ms-4">
								<li class="nav-item"><a class="nav-link" href="<?= base_url('proveedor');?>"><span class="sidenav-normal">Proveedores</span></a></li>
								<li class="nav-item"><a class="nav-link" href="<?= base_url('compra');?>"><span class="sidenav-normal">Compras</span></a></li>
							</ul>
						</div>
					</li>
					<li class="nav-item">
						<a data-bs-toggle="collapse" href="#sale" class="nav-link" aria-expanded="false">
							<div class="icon icon-shape icon-sm text-center d-flex align-items-center justify-content-center">
								<i class="fa-solid fa-cart-shopping text-dark text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text ms-2">Ventas</span>
						</a>
						<div class="collapse" id="sale">
							<ul class="nav ms-4">
								<li class="nav-item"><a class="nav-link" href="<?= base_url('cliente');?>"><span class="sidenav-normal">Clientes</span></a>
								</li>
								<li class="nav-item"><a class="nav-link" href="<?= base_url('venta');?>"><span class="sidenav-normal">Ventas</span></a></li>
							</ul>
						</div>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="<?= base_url('usuario');?>">
							<div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
								<i class="fa-solid fa-users-gear text-dark text-sm opacity-10"></i>
							</div>
							<span class="nav-link-text me-6">Usuarios</span>
							<span class="badge bg-gradient-success">New</span>
						</a>
					</li>
				</ul>
			</div>
			<div class="sidenav-footer mx-3 ">
				<div class="card card-plain shadow-none" id="sidenavCard">
					<img class="w-50 mx-auto" src="<?= base_url('assets/img/illustrations/icon-documentation.svg');?>">
					<div class="card-body text-center p-3 w-100 pt-0">
						<div class="docs-info">
							<h6 class="mb-0">Argon Dashboard</h6>
							<p class="text-xs font-weight-bold mb-0">Bootstrap 5 Admin Template</p>
						</div>
					</div>
				</div>
				<a class="btn btn-dark btn-sm mb-0 w-100" href="https://www.creative-tim.com/product/argon-dashboard">Ver template</a>
			</div>
		</div>
	</aside>