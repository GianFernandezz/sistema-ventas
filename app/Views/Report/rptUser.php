
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
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
        <h1 id="titulo">Lista de Usuarios</h1>
    </header>
      
    <table class="border-table">
		<thead>
			<tr>
				<th>Img</th>
				<th>Usuario</th>
				<th>UserName</th>
				<th>Email</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($users as $usuario):?>
			<tr>
                <td><img src="assets/img/profile/user.png" width="60" height="60"></td>
                <td><?= $usuario['full_name']?></td>
                <td><?= $usuario['username']?></td>
                <td><?= $usuario['email']?></td>
			</tr>
			<?php endforeach;?>
		</tbody>
	</table>
       
</body>
</html>

				
			
