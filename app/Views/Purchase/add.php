<main class="main-content position-relative border-radius-lg" id="purchase">
	<!-- Navbar -->
	<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" data-scroll="false" @click="searchproducts=''">
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
	<div class="container-fluid py-4" @click="searchproducts=''">
		<div class="row">
			<div class="col-12" >
				<div class="card mb-4">
					<div class="card-header pb-0">
						<h6>Compra de productos</h6>
					</div>
					
					<div class="card-body">
						<div class="row">
							<div class="col-md-5">
								<div class="autocomplete dropdown">
									<div class="search-input">
										<span class="h4"><i class="fa-solid fa-magnifying-glass-plus"></i></span>
										<input placeholder="Buscar productos..." type="text" v-model="searchproducts" data-bs-toggle="dropdown">
										<ul class="dropdown-menu px-2 py-3 mt-2 list">
											<h6>Mostrando {{ searchProducts().length }} de {{ products.length }} productos</h6>
											<li v-for="item in searchProducts()"><a class="dropdown-item border-radius-md" @click="addProduct(item.id, item.name, item.pricepurchase, item.pricesale)">{{ item.name }}</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-7">
								<div class="d-md-flex">
									<div class="dropdown ms-auto my-auto">
										<button class="btn bg-gradient-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">{{ voucher.name }}</button>
										<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton">
											<li><a class="dropdown-item" @click="purchase.voucher_id = 1, voucher.name = 'Factura ', voucher.igv = 18">Factura</a></li>
											<li><a class="dropdown-item" @click="purchase.voucher_id = 2, voucher.name = 'Boleta ', voucher.igv = 0">Boleta</a></li>
										</ul>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="btn-group dropup search-list">
									<button class="btn btn-icon btn-3 bg-gradient-default" type="button" data-bs-toggle="dropdown">
										<span class="btn-inner-icon"><i class="fa-solid fa-user-plus"></i></span>
										<span class="btn-inner-text ms-2">{{ supplier }}</span>
									</button>
									<ul class="dropdown-menu px-2 py-3" aria-labelledby="dropdownMenuButton">
										<input class="form-control" placeholder="Buscar..." v-model="searchsuppliers">
										<h5 class="mt-2 mb-2 ms-2">Proveedores</h5>
										<li v-for="(item, index) in searchSuppliers()"><a class="dropdown-item border-radius-md" @click="purchase.supplier_id = item.id, supplier = item.name, searchsuppliers=''">{{ item.name }}</a></li>
									</ul>
								</div>
								<div class="table-responsive">
									<table class="table align-items-center">
										<thead>
											<tr>
												<th class="text-uppercase text-xs font-weight-bolder opacity-7">Producto</th>
												<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-1">Cantidad</th>
												<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-1">P. Compra</th>
												<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-1">P. Venta</th>
												<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-1">Importe</th>
												<th></th>
											</tr>
										</thead>
										<tbody>
											<tr v-for="(item, index) in purchasedetails">
												<td class="px-4 text-xs font-weight-bold">{{ item.product }}</td>
												<td width="10%"><input :value="item.cant" @input="item.cant = integerValue($event)" placeholder="0"></td>
												<td width="10%"><input :value="item.pricepurchase" @input="item.pricepurchase = currencyValue($event)" placeholder="0.00"></td>
												<td width="10%"><input :value="item.pricesale" @input="item.pricesale = currencyValue($event)" placeholder="0.00" :class="item.infopricesale = Math.floor(item.pricesale/item.pricepurchase)"></td>
												<td width="10%">{{ item.amount = (item.cant*item.pricepurchase).toFixed(2) }}</td>
												<td class="text-lg" width="10%">
													<button class="btn btn-icon btn-2 bg-gradient-danger" @click="purchasedetails.splice(index, 1)">
														<span class="btn-inner-icon"><i class="fa-solid fa-trash"></i></span>
													</button>
												</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group mt-5 pricing">
									<div class="btn btn-outline-secondary mb-0">Sub total</div>
									<input type="text" class="form-control" disabled :value="purchase.subtotal = subtotal()">
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group mt-5 pricing">
									<div class="btn btn-outline-secondary mb-0">IGV</div>
									<input type="text" class="form-control" disabled :value="purchase.igv = igv()">
								</div>
							</div>
							<div class="col-md-3">
								<div class="input-group mt-5 pricing">
									<div class="btn btn-outline-secondary mb-0">Total</div>
									<input type="text" class="form-control" disabled :value="purchase.total = total()">
								</div>
							</div>
							<div class="col-md-3">
								<div class="d-md-flex">
									<div class="ms-auto my-auto mt-lg-0">
										<div class="ms-auto my-auto">
											<button class="btn bg-gradient-success mt-5" @click="savePurchase()">Registrar</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="position-fixed end-1 z-index-2 top-0 end-0">
					<div class="toast fade p-2 mt-2 bg-white" :class="{ show: errors.purchasedetail }">
						<div class="toast-header border-0">
							<i class="fa-solid fa-exclamation text-danger"></i>
							<span class="me-auto text-gradient text-danger font-weight-bold">Error de compra</span>
							<small class="text-body">0 min ago</small>
							<i class="fas fa-times text-md ms-3 cursor-pointer" aria-label="Close" @click="errors.purchasedetail=''"></i>
						</div>
						<hr class="horizontal dark m-0">
						<div class="toast-body">{{ errors.purchasedetail }}</div>
					</div>
					<div class="toast fade p-2 mt-2 bg-white" :class="{ show: errors.supplier }">
						<div class="toast-header border-0">
							<i class="fa-solid fa-exclamation text-danger"></i>
							<span class="me-auto text-gradient text-danger font-weight-bold">Error de compra</span>
							<small class="text-body">0 min ago</small>
							<i class="fas fa-times text-md ms-3 cursor-pointer" aria-label="Close" @click="errors.supplier=''"></i>
						</div>
						<hr class="horizontal dark m-0">
						<div class="toast-body">{{ errors.supplier }}</div>
					</div>
				</div>

			</div>
		</div>