<?php

namespace App\Controllers\Reports;

use CodeIgniter\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use App\Models\PurchaseModel;
use App\Models\SupplierModel;
use App\Models\ClientModel;
use App\Models\SaleModel;
use App\Models\UserManagementModel;

// ! REPORTE PDF
use Dompdf\Dompdf;
// IMG
use Dompdf\Options;

// TODO: REPORTE EXCEL
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class ReportAll extends Controller
{
  /**
   * Instance of the main Request object.
   *
   * @var CLIRequest|IncomingRequest
   */
  protected $request;

  public function index()
  {
    // 
  }

  // ! ******************REPORTES EN PDF****************** //

  // ? -> TABLA DE CATEGORIAS
  public function rptCategory()
  {
    $categoryModel = new CategoryModel();
    // * -> Va la consulta de la DB
    $dataCategoria = $categoryModel->dataCategory();
    $data["categorias"] = $dataCategoria->getResultArray();

    //PROCESO PARA LA IMG  
    $options = new Options();
    $options->set('chroot', realpath(''));

    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);

    // Cargar lavista de la TABLA CATEGORIA
    $tablaCategory = view('Report/rptCategory', $data);

    $dompdf->loadHtml($tablaCategory);

    // (Optional) Setup the paper size and orientation -> landscape o portrait
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    /**Attachment -> Si colocamos 1 hara que por defecto los PDF se descarguen
     * en lugar de presentarse en la pantalla */
    $dompdf->stream('Categorias.pdf', ['Attachment' => 0]);
  }
  // ? -> TABLA DE PRODUCTOS
  public function rptProduct()
  {
    $productModel = new ProductModel();
    // * -> Va la consulta de la DB
    $productModel = new ProductModel();
    $data["products"] = $productModel->readProducts();

    //PROCESO PARA LA IMG  
    $options = new Options();
    $options->set('chroot', realpath(''));

    // $options->set('isRemoteEnabled', true);

    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);

    // Cargar lavista de la TABLA PRODUCTOS
    $tablaProduct = view('Report/rptProduct', $data);

    $dompdf->loadHtml($tablaProduct);

    // (Optional) Setup the paper size and orientation -> landscape o portrait
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    /**Attachment -> Si colocamos 1 hara que por defecto los PDF se descarguen
     * en lugar de presentarse en la pantalla */
    $dompdf->stream('Productos.pdf', ['Attachment' => 0]);
  }
  // ? -> TABLA DE COMPRAS
  public function rptPurchase()
  {
    $purchaseModel = new PurchaseModel();
    // * -> Va la consulta de la DB
    $data["purchases"] = $purchaseModel->readPurchases();

    //PROCESO PARA LA IMG  
    $options = new Options();
    $options->set('chroot', realpath(''));

    // $options->set('isRemoteEnabled', true);

    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);

    // Cargar lavista de la TABLA PRODUCTOS
    $tablaPurchase = view('Report/rptPurchase', $data);

    $dompdf->loadHtml($tablaPurchase);

    // (Optional) Setup the paper size and orientation -> landscape o portrait
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    /**Attachment -> Si colocamos 1 hara que por defecto los PDF se descarguen
     * en lugar de presentarse en la pantalla */
    $dompdf->stream('Compras.pdf', ['Attachment' => 0]);
  }
  // ? -> TABLA DE PROVEEDORES
  public function rptSupplier()
  {
    $supplierModel = new SupplierModel();
    // * -> Va la consulta de la DB
    $dataSupplier = $supplierModel->dataSupplier();
    $data["suppliers"] = $dataSupplier->getResultArray();

    //PROCESO PARA LA IMG  
    $options = new Options();
    $options->set('chroot', realpath(''));

    // $options->set('isRemoteEnabled', true);

    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);

    // Cargar lavista de la TABLA PRODUCTOS
    $tablaSupplier = view('Report/rptSupplier', $data);

    $dompdf->loadHtml($tablaSupplier);

    // (Optional) Setup the paper size and orientation -> landscape o portrait
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    /**Attachment -> Si colocamos 1 hara que por defecto los PDF se descarguen
     * en lugar de presentarse en la pantalla */
    $dompdf->stream('Proveedores.pdf', ['Attachment' => 0]);
  }
  // ? -> TABLA DE CLIENTES
  public function rptClient()
  {
    $clientModel = new ClientModel();
    // * -> Va la consulta de la DB
    $dataClient = $clientModel->dataClient();
    $data["clients"] = $dataClient->getResultArray();

    //PROCESO PARA LA IMG  
    $options = new Options();
    $options->set('chroot', realpath(''));

    // $options->set('isRemoteEnabled', true);

    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);

    // Cargar lavista de la TABLA PRODUCTOS
    $tablaClient = view('Report/rptClient', $data);

    $dompdf->loadHtml($tablaClient);

    // (Optional) Setup the paper size and orientation -> landscape o portrait
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    /**Attachment -> Si colocamos 1 hara que por defecto los PDF se descarguen
     * en lugar de presentarse en la pantalla */
    $dompdf->stream('Clientes.pdf', ['Attachment' => 0]);
  }
  // ? -> TABLA DE VENTAS
  public function rptSale()
  {
    $saleModel = new SaleModel();
    // * -> Va la consulta de la DB
    $data["sales"] = $saleModel->readSales();

    //PROCESO PARA LA IMG  
    $options = new Options();
    $options->set('chroot', realpath(''));

    // $options->set('isRemoteEnabled', true);

    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);

    // Cargar lavista de la TABLA PRODUCTOS
    $tablaSale = view('Report/rptSale', $data);

    $dompdf->loadHtml($tablaSale);

    // (Optional) Setup the paper size and orientation -> landscape o portrait
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    /**Attachment -> Si colocamos 1 hara que por defecto los PDF se descarguen
     * en lugar de presentarse en la pantalla */
    $dompdf->stream('Ventas.pdf', ['Attachment' => 0]);
  }
  // ? -> TABLA DE USUARIOS
  public function rptUser()
  {
    $userManagementModel = new UserManagementModel();
    // * -> Va la consulta de la DB
    $dataUser = $userManagementModel->dataUser();
    $data["users"] = $dataUser->getResultArray();

    //PROCESO PARA LA IMG  
    $options = new Options();
    $options->set('chroot', realpath(''));

    // $options->set('isRemoteEnabled', true);

    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);

    // Cargar lavista de la TABLA PRODUCTOS
    $tablaUser = view('Report/rptUser', $data);

    $dompdf->loadHtml($tablaUser);

    // (Optional) Setup the paper size and orientation -> landscape o portrait
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    /**Attachment -> Si colocamos 1 hara que por defecto los PDF se descarguen
     * en lugar de presentarse en la pantalla */
    $dompdf->stream('Usuarios.pdf', ['Attachment' => 0]);
  }

  // ! ******************REPORTES EN PDF | END****************** //

  // TODO ******************REPORTES EN EXCEL****************** //

  // ? -> TABLA DE CATEGORIAS
  public function downloadExcelCategory()
  {
    $model = new CategoryModel();
    $spreadsheet = new Spreadsheet();
    $spreadsheet
    ->getProperties()
    ->setCreator("MiniMarket")
    ->setTitle('Reporte de Categorias')
    ->setSubject('Report Category')
    ->setDescription('Esta es un reporte de las categorias del SIS');
    $hojaExcel = $spreadsheet->getActiveSheet();

    $hojaExcel->getStyle('A1:C1')->getFont()->setBold(true)->setSize(12);
    $hojaExcel->getStyle('A1:C1')->getAlignment()->setHorizontal('center');
    $hojaExcel->getColumnDimension('A')->setAutoSize(true);
    $hojaExcel->getColumnDimension('B')->setAutoSize(true);

    $hojaExcel->getStyle('A1:C1')->getFill()
      ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
      ->getStartColor()->setARGB('FFFF0000');

    $hojaExcel->getStyle('A1:C1')->getFont()->getColor()->setARGB('FFFFFFFF');

    // Border | Color
    // $hojaExcel
    // ->getStyle('A1')
    // ->getBorders()
    // // ->getOutline()
    // ->getAllBorders()
    // ->setBorderStyle(Border::BORDER_THICK)
    // ->setColor(new Color('FF000000'));

    $result = $model->selectCategory();

    $hojaExcel->setCellValue("A1", "CATEGORIA");
    $hojaExcel->setCellValue("B1", "DESCRIPCION");
    $hojaExcel->setCellValue("C1", "ID");
    $count = 2;

    foreach ($result as $row) {
      $hojaExcel->setCellValue("A" . $count, $row->name);
      $hojaExcel->setCellValue("B" . $count, $row->description);
      $hojaExcel->setCellValue("C" . $count, $row->id);
      // Centrar todos los campos con DATA.
      $hojaExcel->getStyle($count)->getAlignment()->setHorizontal('center');
      $count++;
    }
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Categorias.xlsx"');
    $writer->save('php://output');
    exit;
    // * GUADAR EN EL DISCO 
    // $writer->save("data.xlsx");
    // return $this->response->download("data.xlsx", null)->setFileName("Categoria.xlsx");
  }
  // ? -> TABLA DE PRODUCTOS
  public function downloadExcelProduct()
  {
    $model = new ProductModel();
    $spreadsheet = new Spreadsheet();
    $spreadsheet
    ->getProperties()
    ->setCreator("MiniMarket")
    ->setTitle('Reporte de Productos')
    ->setSubject('Report Product')
    ->setDescription('Esta es un reporte de las productos del SIS');
    $hojaExcel = $spreadsheet->getActiveSheet();

    $hojaExcel->getStyle('A1:E1')->getFont()->setBold(true)->setSize(12);
    $hojaExcel->getStyle('A1:E1')->getAlignment()->setHorizontal('center');
    // Para el autodimensionamiento (expansión automática de celdas)
    $hojaExcel->getColumnDimension('A')->setAutoSize(true);
    $hojaExcel->getColumnDimension('B')->setAutoSize(true);
    $hojaExcel->getColumnDimension('C')->setAutoSize(true);
    $hojaExcel->getColumnDimension('D')->setAutoSize(true);
    $hojaExcel->getColumnDimension('E')->setAutoSize(true);

    $hojaExcel->getStyle('A1:E1')->getFill()
      ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
      ->getStartColor()->setARGB('FFFF0000');

    $hojaExcel->getStyle('A1:E1')->getFont()->getColor()->setARGB('FFFFFFFF');

    $result = $model->readProducts();

    $hojaExcel->setCellValue("A1", "PRODUCTO");
    $hojaExcel->setCellValue("B1", "COD BARRAS");
    $hojaExcel->setCellValue("C1", "CATEGORIA");
    $hojaExcel->setCellValue("D1", "PRECIO");
    $hojaExcel->setCellValue("E1", "STOCK");

    // $hojaExcel->setCellValue("F1", "id");
    $count = 2;

    foreach ($result as $row) {
      $hojaExcel->setCellValue("A" . $count, $row->name);
      $hojaExcel->setCellValue("B" . $count, $row->barcode);
      $hojaExcel->setCellValue("C" . $count, $row->category);
      $hojaExcel->setCellValue("D" . $count, 'S/. '.$row->pricesale);
      $hojaExcel->setCellValue("E" . $count, $row->stock);
      // Centrar todos los campos con DATA.
      $hojaExcel->getStyle($count)->getAlignment()->setHorizontal('center');

      // $hojaExcel->setCellValue("F" . $count, $row->id);
      $count++;
    }
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Productos.xlsx"');
    $writer->save('php://output');
    exit;
    // * GUADAR EN EL DISCO 
    // $writer->save("data.xlsx");
    // return $this->response->download("data.xlsx", null)->setFileName("Categoria.xlsx");
  }
  // ? -> TABLA DE COMPRAS
  public function downloadExcelPurchase()
  {
    $model = new PurchaseModel();
    $spreadsheet = new Spreadsheet();
    $spreadsheet
    ->getProperties()
    ->setCreator("MiniMarket")
    ->setTitle('Reporte de Compras')
    ->setSubject('Report Purchase')
    ->setDescription('Esta es un reporte de las compras del SIS');
    $hojaExcel = $spreadsheet->getActiveSheet();

    $hojaExcel->getStyle('A1:D1')->getFont()->setBold(true)->setSize(12);
    $hojaExcel->getStyle('A1:D1')->getAlignment()->setHorizontal('center');
    // Para el autodimensionamiento (expansión automática de celdas)
    $hojaExcel->getColumnDimension('A')->setAutoSize(true);
    $hojaExcel->getColumnDimension('B')->setAutoSize(true);
    $hojaExcel->getColumnDimension('C')->setAutoSize(true);
    $hojaExcel->getColumnDimension('D')->setAutoSize(true);

    $hojaExcel->getStyle('A1:D1')->getFill()
      ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
      ->getStartColor()->setARGB('FFFF0000');

    $hojaExcel->getStyle('A1:D1')->getFont()->getColor()->setARGB('FFFFFFFF');

    $result = $model->readPurchases();

    $hojaExcel->setCellValue("A1", "PROVEEDOR");
    $hojaExcel->setCellValue("B1", "FECHA DE COMPRA");
    $hojaExcel->setCellValue("C1", "TOTAL");
    $hojaExcel->setCellValue("D1", "COMPROVANTE");

    $count = 2;

    foreach ($result as $row) {
      $hojaExcel->setCellValue("A" . $count, $row->supplier);
      $hojaExcel->setCellValue("B" . $count, $row->date);
      $hojaExcel->setCellValue("C" . $count, 'S/. '.$row->total);
      $hojaExcel->setCellValue("D" . $count, $row->voucher);
      // Centrar todos los campos con DATA.
      $hojaExcel->getStyle($count)->getAlignment()->setHorizontal('center');

      // $hojaExcel->setCellValue("F" . $count, $row->id);
      $count++;
    }
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Compras.xlsx"');
    $writer->save('php://output');
    exit;
    // * GUADAR EN EL DISCO 
    // $writer->save("data.xlsx");
    // return $this->response->download("data.xlsx", null)->setFileName("Categoria.xlsx");
  }
  // ? -> TABLA DE PROVEEDORES
  public function downloadExcelSupplier()
  {
    $model = new SupplierModel();
    $spreadsheet = new Spreadsheet();
    $spreadsheet
    ->getProperties()
    ->setCreator("MiniMarket")
    ->setTitle('Reporte de Proveedores')
    ->setSubject('Report Suppliers')
    ->setDescription('Esta es un reporte de los proveedores del SIS');
    $hojaExcel = $spreadsheet->getActiveSheet();

    $hojaExcel->getStyle('A1:D1')->getFont()->setBold(true)->setSize(12);
    $hojaExcel->getStyle('A1:D1')->getAlignment()->setHorizontal('center');
    // Para el autodimensionamiento (expansión automática de celdas)
    $hojaExcel->getColumnDimension('A')->setAutoSize(true);
    $hojaExcel->getColumnDimension('B')->setAutoSize(true);
    $hojaExcel->getColumnDimension('C')->setAutoSize(true);
    $hojaExcel->getColumnDimension('D')->setAutoSize(true);

    $hojaExcel->getStyle('A1:D1')->getFill()
      ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
      ->getStartColor()->setARGB('FFFF0000');

    $hojaExcel->getStyle('A1:D1')->getFont()->getColor()->setARGB('FFFFFFFF');

    // LLAMAMOS EL SQL DE LA DB
    $result = $model->selectSupplier();

    $hojaExcel->setCellValue("A1", "PROVEEDOR");
    $hojaExcel->setCellValue("B1", "RUC");
    $hojaExcel->setCellValue("C1", "CELULAR");
    $hojaExcel->setCellValue("D1", "EMAIL");

    $count = 2;

    foreach ($result as $row) {
      $hojaExcel->setCellValue("A" . $count, $row->name);
      $hojaExcel->setCellValue("B" . $count, $row->ruc);
      $hojaExcel->setCellValue("C" . $count, $row->phone_number);
      $hojaExcel->setCellValue("D" . $count, $row->email);
      // Centrar todos los campos con DATA.
      $hojaExcel->getStyle($count)->getAlignment()->setHorizontal('center');
      // Formato de numero normal -> para que no se acorte 
      $hojaExcel->getStyle("B")->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);

      // $hojaExcel->setCellValue("F" . $count, $row->id);
      $count++;
    }
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Proveedores.xlsx"');
    $writer->save('php://output');
    exit;
    // * GUADAR EN EL DISCO 
    // $writer->save("data.xlsx");
    // return $this->response->download("data.xlsx", null)->setFileName("Categoria.xlsx");
  }
  // ? -> TABLA DE CLIENTES
  public function downloadExcelClient()
  {
    $model = new ClientModel();
    $spreadsheet = new Spreadsheet();
    $spreadsheet
    ->getProperties()
    ->setCreator("MiniMarket")
    ->setTitle('Reporte de Clientes')
    ->setSubject('Report Clients')
    ->setDescription('Esta es un reporte de los clientes del SIS');
    $hojaExcel = $spreadsheet->getActiveSheet();

    $hojaExcel->getStyle('A1:F1')->getFont()->setBold(true)->setSize(12);
    $hojaExcel->getStyle('A1:F1')->getAlignment()->setHorizontal('center');
    // Para el autodimensionamiento (expansión automática de celdas)
    $hojaExcel->getColumnDimension('A')->setAutoSize(true);
    $hojaExcel->getColumnDimension('B')->setAutoSize(true);
    $hojaExcel->getColumnDimension('C')->setAutoSize(true);
    $hojaExcel->getColumnDimension('D')->setAutoSize(true);
    $hojaExcel->getColumnDimension('E')->setAutoSize(true);
    $hojaExcel->getColumnDimension('F')->setAutoSize(true);

    $hojaExcel->getStyle('A1:F1')->getFill()
      ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
      ->getStartColor()->setARGB('FFFF0000');

    $hojaExcel->getStyle('A1:F1')->getFont()->getColor()->setARGB('FFFFFFFF');

    // LLAMAMOS EL SQL DE LA DB
    $result = $model->selectClient();

    $hojaExcel->setCellValue("A1", "CLIENTE");
    $hojaExcel->setCellValue("B1", "T. DOCUMENTO");
    $hojaExcel->setCellValue("C1", "N° DOCUMENTO");
    $hojaExcel->setCellValue("D1", "DIRECCION");
    $hojaExcel->setCellValue("E1", "CELULAR");
    $hojaExcel->setCellValue("F1", "EMAIL");

    $count = 2;

    foreach ($result as $row) {
      $hojaExcel->setCellValue("A" . $count, $row->name);
      $hojaExcel->setCellValue("B" . $count, $row->type_document);
      $hojaExcel->setCellValue("C" . $count, $row->num_document);
      $hojaExcel->setCellValue("D" . $count, $row->address);
      $hojaExcel->setCellValue("E" . $count, $row->phone_number);
      $hojaExcel->setCellValue("F" . $count, $row->email);
      // Centrar todos los campos con DATA.
      $hojaExcel->getStyle($count)->getAlignment()->setHorizontal('center');
      // Formato de numero normal -> para que no se acorte 
      $hojaExcel->getStyle("C")->getNumberFormat()->setFormatCode(\PhpOffice\PhpSpreadsheet\Style\NumberFormat::FORMAT_NUMBER);

      // $hojaExcel->setCellValue("F" . $count, $row->id);
      $count++;
    }
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Clientes.xlsx"');
    $writer->save('php://output');
    exit;
    // * GUADAR EN EL DISCO 
    // $writer->save("data.xlsx");
    // return $this->response->download("data.xlsx", null)->setFileName("Categoria.xlsx");
  }
  // ? -> TABLA DE VENTAS
  public function downloadExcelSale()
  {
    $model = new SaleModel();
    $spreadsheet = new Spreadsheet();
    $spreadsheet
    ->getProperties()
    ->setCreator("MiniMarket")
    ->setTitle('Reporte de Ventas')
    ->setSubject('Report Sale')
    ->setDescription('Esta es un reporte de las ventas del SIS');
    $hojaExcel = $spreadsheet->getActiveSheet();

    $hojaExcel->getStyle('A1:E1')->getFont()->setBold(true)->setSize(12);
    $hojaExcel->getStyle('A1:E1')->getAlignment()->setHorizontal('center');
    // Para el autodimensionamiento (expansión automática de celdas)
    $hojaExcel->getColumnDimension('A')->setAutoSize(true);
    $hojaExcel->getColumnDimension('B')->setAutoSize(true);
    $hojaExcel->getColumnDimension('C')->setAutoSize(true);
    $hojaExcel->getColumnDimension('D')->setAutoSize(true);
    $hojaExcel->getColumnDimension('E')->setAutoSize(true);

    $hojaExcel->getStyle('A1:E1')->getFill()
      ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
      ->getStartColor()->setARGB('FFFF0000');

    $hojaExcel->getStyle('A1:E1')->getFont()->getColor()->setARGB('FFFFFFFF');

    $result = $model->readSales();

    $hojaExcel->setCellValue("A1", "CLIENTE");
    $hojaExcel->setCellValue("B1", "FECHA DE VENTA");
    $hojaExcel->setCellValue("C1", "SUB-TOTAL");
    $hojaExcel->setCellValue("D1", "TOTAL");
    $hojaExcel->setCellValue("E1", "COMPROVANTE");

    $count = 2;

    foreach ($result as $row) {
      $hojaExcel->setCellValue("A" . $count, $row->client);
      $hojaExcel->setCellValue("B" . $count, $row->date);
      $hojaExcel->setCellValue("C" . $count, 'S/. '.$row->subtotal);
      $hojaExcel->setCellValue("D" . $count, 'S/. '.$row->total);
      $hojaExcel->setCellValue("E" . $count, $row->voucher);
      // Centrar todos los campos con DATA.
      $hojaExcel->getStyle($count)->getAlignment()->setHorizontal('center');

      // $hojaExcel->setCellValue("F" . $count, $row->id);
      $count++;
    }
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Ventas.xlsx"');
    $writer->save('php://output');
    exit;
    // * GUADAR EN EL DISCO 
    // $writer->save("data.xlsx");
    // return $this->response->download("data.xlsx", null)->setFileName("Categoria.xlsx");
  }
  // ? -> TABLA DE USUARIOS
  public function downloadExcelUser()
  {
    $model = new UserManagementModel();
    $spreadsheet = new Spreadsheet();
    $spreadsheet
    ->getProperties()
    ->setCreator("MiniMarket")
    ->setTitle('Reporte de Usuarios')
    ->setSubject('Report Users')
    ->setDescription('Esta es un reporte de las usuarios del SIS');
    $hojaExcel = $spreadsheet->getActiveSheet();

    $hojaExcel->getStyle('A1:C1')->getFont()->setBold(true)->setSize(12);
    $hojaExcel->getStyle('A1:C1')->getAlignment()->setHorizontal('center');
    // Para el autodimensionamiento (expansión automática de celdas)
    $hojaExcel->getColumnDimension('A')->setAutoSize(true);
    $hojaExcel->getColumnDimension('B')->setAutoSize(true);
    $hojaExcel->getColumnDimension('C')->setAutoSize(true);

    $hojaExcel->getStyle('A1:C1')->getFill()
      ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
      ->getStartColor()->setARGB('FFFF0000');

    $hojaExcel->getStyle('A1:C1')->getFont()->getColor()->setARGB('FFFFFFFF');

    $result = $model->selectUser();

    $hojaExcel->setCellValue("A1", "USUARIO");
    $hojaExcel->setCellValue("B1", "USERNAME");
    $hojaExcel->setCellValue("C1", "EMAIL");


    $count = 2;

    foreach ($result as $row) {
      $hojaExcel->setCellValue("A" . $count, $row->full_name);
      $hojaExcel->setCellValue("B" . $count, $row->username);
      $hojaExcel->setCellValue("C" . $count, $row->email);
      // Centrar todos los campos con DATA.
      $hojaExcel->getStyle($count)->getAlignment()->setHorizontal('center');

      // $hojaExcel->setCellValue("F" . $count, $row->id);
      $count++;
    }
    $writer = new Xlsx($spreadsheet);
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Usuarios.xlsx"');
    $writer->save('php://output');
    exit;
    // * GUADAR EN EL DISCO 
    // $writer->save("data.xlsx");
    // return $this->response->download("data.xlsx", null)->setFileName("Categoria.xlsx");
  }

  // TODO ******************REPORTES EN EXCEL | END****************** //
}
