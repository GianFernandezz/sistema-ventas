
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Producto</title>
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
                <img class="logo" src="assets/img/product/product.png">
                <h1 id="titulo">Lista de Productos</h1>
            </header>
      

    <table class="border-table">
        <thead>
        <tr>
			<th>Img</th>
			<th>Producto</th>
			<th>COD Barrras</th>
			<th>Categoria</th>
			<th>Precio</th>
			<th>Stock</th>
		</tr>
        </thead>
        <tbody>
        <?php 
            foreach($productos as $product){  ?>
            
            <tr>
                <!-- // ! Problemas con las img de los productos -->
                <!-- <td><img src="<?php echo base_url()?>assets/img/product/<?=$product['picture'];?>"></td> -->
                <td><img src="assets/img/product/product.png" width="60" height="60"></td>
        
                <td><?= $product['name'];?></td>
                <td><?= $product['barcode'];?></td>
                <td><?= $product['category'];?></td>
                <td><?= 'S./ '.$product['pricesale'];?></td>
                <td><?= $product['stock']?></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
            
</body>
</html>

				
			
