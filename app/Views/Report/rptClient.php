
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clientes</title>
    <style>
        .border-table{
            font-family: Arial, Helvetica, sans-serif;
            width: 100%;
            border-collapse: collapse;
            text-align: center;
            font-size: 12px;
        }
        .border-table th{
            border: 1 solid #000;
            font-weight: bold;
            background-color: #e1e1e1;
        }
        .border-table td{
            border: 1 solid #000;
        }
        #cabecera {
            background: #FFFBB9;
            border: 2px solid #0a3fee;
            padding: 10px;
        }
        @page {
                margin: 1cm 1.5cm;
            }

        .logo{
            width: 150px;
            height: 150px;
            border: 2px solid #ee930a;
            margin-top: 27px;
            vertical-align: middle;
        }

        #titulo{
            font-family: Arial, Helvetica, sans-serif;
            display: inline-block;
            /* font-size: 24px; */
            /* text-align: center; */
            /* width: calc(100% - 228px); */
            margin: 0;
            transform: translate(40%, -90%);
        }
    </style>
</head>


<body>  
    <header id="cabecera">
        <img class="logo" src="assets/img/charge-excel.png">
        <h1 id="titulo">Lista de Clientes</h1>
    </header>
      
    <table class="border-table">
		<thead>
			<tr>
				<th>Cliente</th>
				<th>T.Documento</th>
				<th>N°Documento</th>
				<th>Celular</th>
				<th>Direccion</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($clients as $cliente):?>
			<tr>
                <td><?= $cliente['name'];?></td>
                <td><?= $cliente['type_document'];?></td>
                <td><?= $cliente['num_document'];?></td>
                <td><?= $cliente['phone_number'];?></td>
                <td><?= $cliente['address'];?></td>
                <td><?= $cliente['email'];?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
       
</body>
</html>

				
			
