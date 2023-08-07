<?php

namespace App\Controllers;

use App\Models\CategoryModel;
use App\Models\ProductModel;
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
		echo view('Js/charge');
	}

	// IMPORTAR DATA Excel a MSQL

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
							// $response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
							// echo json_encode($response);
                        }
                    }
					
                    return redirect()->to(site_url("/carga_excel"));
					
					
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

	public function productoImport()
    {
        $model = new ProductModel();

        if ($this->request->getMethod() == "post") {
            $rules = $this->validate([
                'fileProductos' => 'uploaded[fileProductos]|max_size[fileProductos,500]|ext_in[fileProductos,csv,xlsx]',
            ]);
            if ($rules == true) {
                $fileProductos =  $this->request->getFile('fileProductos');
                $name = $fileProductos->getName();
                $tempName = $fileProductos->getTempName();
                $arr_file = explode(".", $name);
                $extension = end($arr_file);
                if ('csv' == $extension) {
                    $reader = new Csv();
                } else {
                    $reader = new excel();
                }
                $spreadsheet = $reader->load($tempName);
                $sheetData = $spreadsheet->getActiveSheet()->toArray();
                if (!empty($sheetData)) {
                    for ($i = 1; $i < count($sheetData); $i++) {
                        $barcode = $sheetData[$i][0];
                        $name = $sheetData[$i][1];
                        $description = $sheetData[$i][2];
                        $pricePurchase = $sheetData[$i][3];
                        $priceSale = $sheetData[$i][4];
                        $stock = $sheetData[$i][5];
                        // $picture = $sheetData[$i][6];
                        $categoryId = $sheetData[$i][6];
                        $id = $sheetData[$i][7];
                        $data = [
                            'barcode' => $barcode,
                            'name' => $name,
                            'description' => $description,
                            'price_purchase' => $pricePurchase,
                            'price_sale' => $priceSale,
                            'stock' => $stock,
                            // 'picture' => $picture,
                            'category_id' => $categoryId,
                        ];
                        $fetchSingleData = $model->selectRow($id);

                        if (!empty($fetchSingleData)) {
                            $model->updateProductExcel($id, $data);
                        } else {
                            $model->newProduct($data);
							// $response = ['type' => "success", 'message' => "Los datos se guardaron correctamente!"];
							// echo json_encode($response);
                        }
                    }
					
                    return redirect()->to(site_url("/carga_excel"));
					
					
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