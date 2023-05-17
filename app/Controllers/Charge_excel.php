<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use CodeIgniter\Controller;

// require ROOTPATH . 'vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Reader\Csv;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx as excel;

// use PhpOffice\PhpSpreadsheet\Style\Border;
// use PhpOffice\PhpSpreadsheet\Style\Color;

class Charge_excel extends Controller
{
	/**
	* Instance of the main Request object.
	*
	* @var CLIRequest|IncomingRequest
	*/
  protected $request;
  public function __construct()
  {
	// 

  }

	public function index()
	{
		echo view('layout/head');
		echo view('layout/aside');
		echo view('charge_excel');
		echo view('layout/footer');
		// echo view('js/profile');
	}
	// Ver si lo uso si no simplemente con un DOWNLOAD y listo
	public function formatoExcel()
	{
		// header('Content-Type: application/vnd.ms-excel');
		// header('Content-Disposition: attachment;filename="Formato-Categorias.xlsx"');
		// $spreadsheet = new Spreadsheet();

		// //Propiedades del archivo
		// $spreadsheet
		// ->getProperties()
		// ->setCreator('Gian Fernandez')
		// ->setTitle('Formato para Categorias')
		// ->setDescription('En este archivo excel podras llenar la data de las categorias');
		// $spreadsheet->getActiveSheet()->getStyle('A1:B1')->getFont()->setBold(true)->setSize(12);
		// $spreadsheet->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal('center');
		// $spreadsheet->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
		// $spreadsheet->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);

		// // Border | Color
		// $spreadsheet
		// ->getActiveSheet()
		// ->getStyle('A1:B20')
		// ->getBorders()
		// // ->getOutline()
		// ->getAllBorders()
		// ->setBorderStyle(Border::BORDER_THICK)
		// ->setColor(new Color('FFFF0000'));
		
        // $sheet = $spreadsheet->getActiveSheet();
		// $sheet->setTitle("Categorias");
        // $sheet->setCellValue('A1', 'Nombre Categoria');
        // $sheet->setCellValue('B1', 'Descripcion');
        // $writer = new Xlsx($spreadsheet);
        // $writer->save('php://output');
		// exit;
	}

	// NUeva FORMA CON MODAL
	// public function import(){
	// 	$file = $this->request->getFile('fileCategorias');
	// 	$ext = $file->getExtension();
	// 	if($ext === "xls")
	// 		$reader = new Xls();
	// 	else $reader = new Xlsx();

	// 	$spreadsheet = $reader->load($file);
	// 	$sheet = $spreadsheet->getActiveSheet()->toArray();

	// 	foreach ($sheet as $index => $item) {
	// 		if($index === 0) continue;
	// 		$this->categoryModel->save([
	// 			'name' => $item[1],
	// 			'description' => $item[2],
	// 		]);
	// 	}
	// }

	// public function categoriaImport()
	// {
	// 	$fileCategorias = $_FILES['fileCategorias']['name'];
	// 	$extension = pathinfo($fileCategorias,PATHINFO_EXTENSION);

	// 	if($extension == 'csv')
	// 	{
	// 		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Csv();
	// 	} else if($extension == 'xls')
	// 	{
	// 		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
	// 	} else
	// 	{
	// 		$reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
	// 	}
	// 	$spreadsheet = $reader->load($_FILES['fileCategorias']['tmp_name']);
	// 	$sheetdata = $spreadsheet->getActiveSheet()->toArray();
	// 	// echo ('<pre>');
	// 	// print_r($sheetdata);
	// 	$sheetcount = count($sheetdata);
	// 	if($sheetcount > 1)
	// 	{
	// 		$data = array();
	// 		for ($i=1; $i < $sheetcount; $i++) { 
	// 			$categoria_name = $sheetdata[$i][1];
	// 			$categoria_description = $sheetdata[$i][2];

	// 			$data[] = array(
	// 				'name' => $categoria_name,
	// 				'description' => $categoria_description,
	// 			);
	// 		}
	// 		$categoryModel = new CategoryModel();

	// 		$categoryModel->createCategory($data);
	// 		$response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
	// 		echo json_encode($response);
	// 	}
	// }

	// UPLOAD DEL COD

	public function categoriaImport()
    {
        $model = new CategoryModel();

        if ($this->request->getMethod() == "post") {
            $rules = $this->validate([
                'fileCategorias' => 'uploaded[fileCategorias]|max_size[fileCategorias,500]|ext_in[fileCategorias,csv,xlsx]',
            ]);
            if ($rules == true) {
                $fileCategorias =  $this->request->getFile('fileCategorias');
                $name = $fileCategorias->getName();
                $tempName = $fileCategorias->getTempName();
                $arr_file = explode(".", $name);
                $extension = end($arr_file);
                if ('csv' == $extension) {
                    $reader = new Csv();
                } else {
                    $reader = new excel();
					// Si funciona AGREGAR LA OTRA EXTEN.. DE EXCEL
                }
                $spreadsheet = $reader->load($tempName);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                if (!empty($sheetData)) {
                    for ($i = 1; $i < count($sheetData); $i++) {
                        $name = $sheetData[$i][0];
                        $description = $sheetData[$i][1];
                        // $email = $sheetData[$i][2];
                        // $address = $sheetData[$i][3];
                        // $postal = $sheetData[$i][4];
                        // $postal = $sheetData[$i][5];
                        // $country = $sheetData[$i][6];
                        $id = $sheetData[$i][2];
                        $data = [
                            'name' => $name,
                            'description' => $description,
                            // 'email' => $email,
                            // 'address' => $address,
                            // 'postalZip' => $postal,
                            // 'region' => $postal,
                            // 'country' => $country,
                        ];
                        $fetchSingleData = $model->selectRow($id);

                        if (!empty($fetchSingleData)) {
                            $model->updateCategoryExcel($id, $data);
                        } else {
                            $model->createCategory($data);
							
                        }
                    }
					// ALERTA DE CONFIRMACION
					// $session->setFlashdata("success", "Los datos se guardaron correctamente!");
    
            		// echo json_encode("success");
                    return redirect()->to(site_url("/carga_excel"));
					// echo "<script>
					// 	Swal.fire({
					// 		position: 'top-end',
					// 		icon: 'success',
					// 		title: 'Your work has been saved',
					// 		showConfirmButton: false,
					// 		timer: 1500
					// 	});
					// 	window.location.href = '/carga_excel';
					// </script>";
					
                } else {
					
                    return view("charge_excel");
                }
            } else {
                return view("charge_excel");
            }
        } else {
            return view("charge_excel");
        }
    }
	
}