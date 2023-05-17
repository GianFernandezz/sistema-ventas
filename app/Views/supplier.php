<main class="main-content position-relative border-radius-lg" id="supplier">
	<!-- Navbar -->
	<nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" data-scroll="false">
		<div class="container-fluid py-1 px-3">
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
					<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white">Paginas</a></li>
					<li class="breadcrumb-item text-sm text-white active" aria-current="page">Proveedor</li>
				</ol>
				<h6 class="font-weight-bolder text-white mb-0">Proveedor</h6>
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
			<div class="col-lg-10 col-md-12">
				
				<!-- Supplier List -->
				<div class="card mb-4">
					<div class="card-header pb-0">
						<div class="d-lg-flex">
							<div>
								<h5 class="mb-0">Todas los proveedores</h5>
							</div>
							<div class="ms-auto my-auto mt-lg-0 mt-4">
								<div class="ms-auto my-auto">
									<button class="btn bg-gradient-primary btn-sm mb-0" data-bs-toggle="modal" data-bs-target="#modalAdd" @click="resetValues"><i class="fa-solid fa-plus"></i> Nuevo</button>
								</div>
							</div>
						</div>
					</div>
					<div class="card-body px-0 pb-0">
						<div class="table-head">
							<select class="form-select" v-model="range" v-on:change="page=1">
								<option value="5">5</option>
								<option value="10">10</option>
								<option value="15">15</option>
							</select>
							<input class="form-control" placeholder="Buscar..." v-model="search" v-on:keypress="page=1"/>
						</div>
						<div class="table-responsive">
							<table class="table align-items-center">
								<thead>
									<tr>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7">Proveedor</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">RUC</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">N° Cel/Tel</th>
										<th class="text-uppercase text-xs font-weight-bolder opacity-7 ps-2">Email</th>
										<th></th>
									</tr>
								</thead>
								<tbody>
									<tr v-for="(item, index) in rows()">
										<td width="24%" class="px-4 text-xs font-weight-bold">{{ item.name }}</td>
										<td width="15%"><span class="text-xs font-weight-bold">{{ item.ruc }}</span></td>
										<td width="15%"><span class="text-xs font-weight-bold">{{ item.phone_number }}</span></td>
										<td><span class="text-xs font-weight-bold">{{ item.email }}</span></td>

										<td>
											<div class="ms-auto text-lg d-flex px-2">
												<div><a class="btn btn-link px-3 mb-0 bg-gradient-primary btn-sm me-2" data-bs-toggle="modal" data-bs-target="#modalEdit" @click="readSupplier(index)"><i class="fas fa-pencil-alt me-2"></i>Edit</a></div>
												<div><a class="btn btn-link px-3 mb-0 bg-gradient-danger btn-sm" @click="deleteSupplier(item.id)"><i class="fa fa-trash me-2"></i>Delete</a></div>
											</div>
										</td>

										<!-- <td class="text-lg" width="6%">
											<span type="button" id="options" data-bs-toggle="dropdown"><i class="fa-solid fa-list"></i></span>
											<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="options">
												<li><a class="dropdown-item" data-bs-toggle="modal" data-bs-target="#modalEdit" @click="readSupplier(index)">Editar</a></li>
												<li><a class="dropdown-item" @click="deleteSupplier(item.id)">Eliminar</a></li>
											</ul>
										</td> -->

									</tr>
								</tbody>
							</table>
						</div>

						<div class="table-pagination" v-if="before > 1">
							<ul>
								<li @click="page=page-1" :class="{ hide: page === 1 }"><</li>
								<li @click="page=page-2" :class="{ hide: page - 2 < 1 }">{{ page-2 }}</li>
								<li @click="page=page-1" :class="{ hide: page - 1 < 1 }">{{ page-1 }}</li>
								<li class="active">{{ page }}</li>
								<li @click="page=page+1" :class="{ hide: page + 1 > before }">{{ page+1 }}</li>
								<li @click="page=page+2" :class="{ hide: page + 2 > before }">{{ page+2 }}</li>
								<li @click="page=page+1" :class="{ hide: page === before }">></li>
							</ul>
						</div>
					</div>
				</div>

				<!-- Modal Supplier Add -->
				<div class="modal fade" ref="modalAdd" id="modalAdd" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<form @submit.prevent="saveSupplier">
								<div class="modal-body">

									<h4 class="mb-4 mt-2" style="color: #344767 !important;">Nuevo proveedor</h4>
									<div class="form-group">
										<label for="example-text-input" class="form-control-label" style="color: #344767 !important;">Nombre<span class="text-danger"> *</span></label>
										<input v-model="name" class="form-control" type="text" placeholder="Nombre del proveedor" :class="{ 'is-invalid': errors.name }">
										<div class="invalid-feedback">{{ errors.name }}</div>
									</div>

									<div class=" row">
										<div class="col-md-6"> 
											<div class="form-group">
												<label for="example-text-input" class="form-control-label" style="color: #344767 !important;">RUC<span class="text-danger"> *</span></label>
												<input v-model="ruc" class="form-control" type="text" placeholder="RUC del proveedor" :class="{ 'is-invalid': errors.ruc }">
												<div class="invalid-feedback">{{ errors.ruc }}</div>
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="example-text-input" class="form-control-label" style="color: #344767 !important;">N° Celular/Teléfono<span class="text-danger"> *</span></label>
												<input v-model="phonenumber" class="form-control" type="text" placeholder="N° Celular/Teléfono" :class="{ 'is-invalid': errors.phonenumber }">
												<div class="invalid-feedback">{{ errors.phonenumber }}</div>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="example-text-input" class="form-control-label" style="color: #344767 !important;">Correo electrónico<span class="text-danger"> *</span></label>
										<input v-model="email" class="form-control" type="text" placeholder="Correo electrónico del proveedor" :class="{ 'is-invalid': errors.email }">
										<div class="invalid-feedback">{{ errors.email }}</div>
									</div>

									<div class="button-row d-flex mt-4 mb-5">
										<button class="btn bg-gradient-success ms-auto mb-0" type="submit">Guardar</button>
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>

				<!-- Modal Supplier Edit -->
				<div class="modal fade" ref="modalEdit" id="modalEdit" tabindex="-1" role="dialog" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
						<div class="modal-content">
							<form @submit.prevent="updateSupplier">
								<div class="modal-body">

									<h4 class="mb-4 mt-2" style="color: #344767 !important;">Actualizar proveedor</h4>
									<div class="form-group">
										<label for="example-text-input" class="form-control-label" style="color: #344767 !important;">Nombre<span class="text-danger"> *</span></label>
										<input v-model="name" class="form-control" type="text" placeholder="Nombre del proveedor" :class="{ 'is-invalid': errors.name }">
										<div class="invalid-feedback">{{ errors.name }}</div>
									</div>

									<div class=" row">
										<div class="col-md-6"> 
											<div class="form-group">
												<label for="example-text-input" class="form-control-label" style="color: #344767 !important;">RUC<span class="text-danger"> *</span></label>
												<input v-model="ruc" class="form-control" type="text" placeholder="RUC del proveedor" :class="{ 'is-invalid': errors.ruc }">
												<div class="invalid-feedback">{{ errors.ruc }}</div>
											</div>
										</div>

										<div class="col-md-6"> 
											<div class="form-group">
												<label for="example-text-input" class="form-control-label" style="color: #344767 !important;">N° Celular/Teléfono<span class="text-danger"> *</span></label>
												<input v-model="phonenumber" class="form-control" type="text" placeholder="N° Celular/Teléfono" :class="{ 'is-invalid': errors.phonenumber }">
												<div class="invalid-feedback">{{ errors.phonenumber }}</div>
											</div>
										</div>
									</div>

									<div class="form-group">
										<label for="example-text-input" class="form-control-label" style="color: #344767 !important;">Correo electrónico<span class="text-danger"> *</span></label>
										<input v-model="email" class="form-control" type="text" placeholder="Correo electrónico del proveedor" :class="{ 'is-invalid': errors.email }">
										<div class="invalid-feedback">{{ errors.email }}</div>
									</div>

									<div class="button-row d-flex mt-4 mb-5">
										<button class="btn bg-gradient-success ms-auto mb-0" type="submit">Guardar</button>
									</div>

								</div>
							</form>
						</div>
					</div>
				</div>

			</div>
		</div>