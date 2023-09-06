<?php

namespace App\Controllers\Reports;

use CodeIgniter\Controller;
use App\Models\PurchaseModel;
use App\Models\PurchaseDetailModel;


// ! REPORTE PDF
use Dompdf\Dompdf;
// IMG
use Dompdf\Options;

// TODO: REPORTE EXCEL
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Color;

class ReportDatePurchase extends Controller
{
  /**
	 * Instance of the main Request object.
	 *
	 * @var HTTP\IncomingRequest
	 */
	protected $request;

  public function purchaseFilterDate($fechaInicio = null,$fechaFin = null)
  {
    // Variables para las fechas
    $fecha1 = $fechaInicio == null ? date('Y-m-01') : $fechaInicio;
    $fecha2 = $fechaFin == null ? date('Y-m-t') : $fechaFin;

    $purchaseModel = new PurchaseModel();
    $data["purchases"] = $purchaseModel->getPurchases($fecha1,$fecha2);

    echo view('Layout/head');
    echo view('Layout/aside');
    echo view('Report\PurchaseDate\rptDatePurchase', $data);
    echo view('Layout/footer');
    echo view('js/reportdate/rptDatePurchase');
  }

  public function filter()
  {
    $fechaInicio = $this->request->getVar('fechaInicio');
    $fechaFin = $this->request->getVar('fechaFin');
    return $this->purchaseFilterDate($fechaInicio, $fechaFin);
  }
  
  public function detail($id)
  {
    $purchaseDetailModel = new PurchaseDetailModel();
		$data = [
			"purchase" =>  $purchaseDetailModel->readPurchase($id),
			"purchasedetails" => $purchaseDetailModel->readPurchaseDetails($id)
		];

		echo view('Layout/head');
		echo view('Layout/aside');
		echo view('Report\PurchaseDate\detailPurchase', $data);
		echo view('Layout/footer');
		echo view('js/purchase');

  }
  // ? -> TABLA DE COMPRAS
  public function exportPdfPurchase($fechaInicio = null,$fechaFin = null)
  {
    $purchaseModel = new PurchaseModel();
    // * -> Va la consulta de la DB
    // VARIABLES -> PARA EL FILTRO DE FECHAS 
    $fecha1 = $fechaInicio == null ? date('Y-m-01') : $fechaInicio;
    $fecha2 = $fechaFin == null ? date('Y-m-t') : $fechaFin;
    $data["purchases"] = $purchaseModel->getPurchases($fecha1,$fecha2);

    //PROCESO PARA LA IMG  
    $options = new Options();
    $options->set('chroot', realpath(''));

    // $options->set('isRemoteEnabled', true);

    // instantiate and use the dompdf class
    $dompdf = new Dompdf($options);

    // Cargar lavista de la TABLA PRODUCTOS
    $tablaSale = view('Report/rptPurchase', $data);

    $dompdf->loadHtml($tablaSale);

    // (Optional) Setup the paper size and orientation -> landscape o portrait
    $dompdf->setPaper('A4', 'portrait');

    // Render the HTML as PDF
    $dompdf->render();

    /**Attachment -> Si colocamos 1 hara que por defecto los PDF se descarguen
     * en lugar de presentarse en la pantalla */
    $dompdf->stream('Compras.pdf', ['Attachment' => 1]);
  }
  // ? -> TABLA DE COMPRAS
  public function exportExcelPurchase($fechaInicio = null,$fechaFin = null)
  {
    $model = new PurchaseModel();
    $spreadsheet = new Spreadsheet();
    $spreadsheet
    ->getProperties()
    ->setCreator("MiniMarket")
    ->setTitle('Reporte de Compras')
    ->setSubject('Report Purchase')
    ->setDescription('Este es un reporte de las compras del SIS');
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

    // $result = $model->readPurchases();

    $hojaExcel->setCellValue("A1", "PROVEEDOR");
    $hojaExcel->setCellValue("B1", "FECHA DE COMPRA");
    $hojaExcel->setCellValue("C1", "TOTAL");
    $hojaExcel->setCellValue("D1", "COMPROVANTE");

    $count = 2;
    // VARIABLES -> PARA EL FILTRO DE FECHAS 
    $fecha1 = $fechaInicio == null ? date('Y-m-01') : $fechaInicio;
    $fecha2 = $fechaFin == null ? date('Y-m-t') : $fechaFin;
    // LLAMO A LA FUNCION DE LA CONSULTA DE DB
    $result = $model->getPurchases($fecha1, $fecha2);

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


}
