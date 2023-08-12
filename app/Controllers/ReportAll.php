<?php

namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;

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
    // $categoryModel = new CategoryModel();
    // $data = array(
    //     'categorys' => $this->$categoryModel->readCategorys()
    // );

    // echo view('Report/rptCategory', $data);

  }

  // ! ******************REPORTES EN PDF****************** //

  // ? -> TABLA DE CATEGORIAS
  public function rptCategory()
  {

    $categoryModel = new CategoryModel();


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

    // Output the generated PDF to Browser
    // $dompdf->stream('Categorias.pdf');

    /**Attachment -> Si colocamos 1 hara que por defecto los PDF se descarguen
     * en lugar de presentarse en la pantalla */
    $dompdf->stream('Categorias.pdf', ['Attachment' => 0]);
  }
  // ? -> TABLA DE PRODUCTOS
  public function rptProduct()
  {

    $productModel = new ProductModel();

    // * -> Va la consulta de la DB
    $dataProducto = $productModel->dataProduct();

    $data["productos"] = $dataProducto->getResultArray();

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

    // Output the generated PDF to Browser
    // $dompdf->stream('Categorias.pdf');

    /**Attachment -> Si colocamos 1 hara que por defecto los PDF se descarguen
     * en lugar de presentarse en la pantalla */
    $dompdf->stream('Productos.pdf', ['Attachment' => 0]);
  }
  // ! ******************REPORTES EN PDF | END****************** //

  // TODO ******************REPORTES EN EXCEL****************** //

  // ? -> TABLA DE CATEGORIAS
  public function downloadCategory()
  {
    $model = new CategoryModel();
    $spreadsheet = new Spreadsheet();
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

    $hojaExcel->setCellValue("A1", "Categoria");
    $hojaExcel->setCellValue("B1", "Descripcion");
    // $sheet->setCellValue("C1", "email");
    // $sheet->setCellValue("D1", "address");
    // $sheet->setCellValue("E1", "postalZip");
    // $sheet->setCellValue("F1", "region");
    // $sheet->setCellValue("G1", "country");
    $hojaExcel->setCellValue("C1", "id");
    $count = 2;

    foreach ($result as $row) {
      $hojaExcel->setCellValue("A" . $count, $row->name);
      $hojaExcel->setCellValue("B" . $count, $row->description);
      // $sheet->setCellValue("C" . $count, $row->email);
      // $sheet->setCellValue("D" . $count, $row->address);
      // $sheet->setCellValue("E" . $count, $row->postalZip);
      // $sheet->setCellValue("F" . $count, $row->region);
      // $sheet->setCellValue("G" . $count, $row->country);
      $hojaExcel->setCellValue("C" . $count, $row->id);
      $count++;
    }
    $writer = new Xlsx($spreadsheet);
    $writer->save("data.xlsx");
    return $this->response->download("data.xlsx", null)->setFileName("Categoria.xlsx");
  }
}
