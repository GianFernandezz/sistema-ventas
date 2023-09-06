<?php

namespace App\Controllers\Reports;

use CodeIgniter\Controller;
use App\Models\SaleModel;
use App\Models\SaleDetailModel;


// ! REPORTE PDF
use Dompdf\Dompdf;
// IMG
use Dompdf\Options;

// TODO: REPORTE EXCEL
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class ReportDateSale extends Controller
{
  /**
	 * Instance of the main Request object.
	 *
	 * @var HTTP\IncomingRequest
	 */
	protected $request;

  public function saleFilterDate($fechaInicio = null,$fechaFin = null)
  {
    // Variables para las fechas
    $fecha1 = $fechaInicio == null ? date('Y-m-01') : $fechaInicio;
    $fecha2 = $fechaFin == null ? date('Y-m-t') : $fechaFin;

    $saleModel = new SaleModel();
    $data["sales"] = $saleModel->getSales($fecha1, $fecha2);

    echo view('Layout/head');
    echo view('Layout/aside');
    echo view('Report\SaleDate\rptDateSale', $data);
    echo view('Layout/footer');
    echo view('js/reportdate/rptDateSale');
  }
  
  public function filter()
  {
    $fechaInicio = $this->request->getVar('fechaInicio');
    $fechaFin = $this->request->getVar('fechaFin');
    return $this->saleFilterDate($fechaInicio, $fechaFin);
  }

  public function detail($id)
  {
    $saleDetailModel = new SaleDetailModel();
		$data = [
			"sale" =>  $saleDetailModel->readSale($id),
			"saledetails" => $saleDetailModel->readSaleDetails($id)
		];

    echo view('Layout/head');
		echo view('Layout/aside');
		echo view('Report\SaleDate\detailSale', $data);
		echo view('Layout/footer');
		echo view('js/sale');

  }
  // ? -> TABLA DE VENTAS
  public function exportPdfSale($fechaInicio = null,$fechaFin = null)
  {
    $saleModel = new SaleModel();
    // * -> Va la consulta de la DB
    // VARIABLES -> PARA EL FILTRO DE FECHAS 
    $fecha1 = $fechaInicio == null ? date('Y-m-01') : $fechaInicio;
    $fecha2 = $fechaFin == null ? date('Y-m-t') : $fechaFin;
    $data["sales"] = $saleModel->getSales($fecha1,$fecha2);

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
    $dompdf->stream('Ventas.pdf', ['Attachment' => 1]);
  }
  // ? -> TABLA DE VENTAS
  public function exportExcelSale($fechaInicio = null,$fechaFin = null)
  {
    $model = new SaleModel();
    $spreadsheet = new Spreadsheet();
    $spreadsheet
    ->getProperties()
    ->setCreator("MiniMarket")
    ->setTitle('Reporte de Ventas')
    ->setSubject('Report Sale')
    ->setDescription('Esto es un reporte de las ventas del SIS');
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

    // $result = $model->readSales();

    $hojaExcel->setCellValue("A1", "CLIENTE");
    $hojaExcel->setCellValue("B1", "FECHA DE VENTA");
    $hojaExcel->setCellValue("C1", "SUB-TOTAL");
    $hojaExcel->setCellValue("D1", "TOTAL");
    $hojaExcel->setCellValue("E1", "COMPROVANTE");

    $count = 2;
    // VARIABLES -> PARA EL FILTRO DE FECHAS 
    $fecha1 = $fechaInicio == null ? date('Y-m-01') : $fechaInicio;
    $fecha2 = $fechaFin == null ? date('Y-m-t') : $fechaFin;
    // LLAMO A LA FUNCION DE LA CONSULTA DE DB
    $result = $model->getSales($fecha1, $fecha2);

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

}
