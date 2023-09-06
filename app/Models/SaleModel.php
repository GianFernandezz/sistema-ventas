<?php 
namespace App\Models;
use CodeIgniter\Model;

class SaleModel extends Model {
	
	// ! -> Se uso para report PDF and EXCEL
	public function readSales(){
		$results = $this->db
		->table('sale s')
		->select('s.id, s.subtotal, s.total, s.date, c.name as client, v.name as voucher')
		->join('client c','c.id=s.client_id')
		->join('voucher v','v.id=s.voucher_id')
		->get()
		->getResultObject();

		return $results;
    }
	// ! -> Se uso para report PDF and EXCEL | END

	public function readProducts(){
		$results = $this->db
		->table('product')
		->select('id, name, price_sale pricesale, stock, barcode')
		->where('barcode !=','')
		->where('stock >','0')
		->get()
		->getResultArray();

		return $results;
    }

	public function readClients(){
		$results = $this->db
		->table('client')
		->select('id, name, num_document as numdocument')
		->get()
		->getResultArray();

		return json_encode($results);
    }

    public function createSale($data){
		$this->db
		->table('sale')
		->set($data)
		->insert();

		return $this->db->insertID();
	}

	public function createSaleDetails($data){
		$this->db
		->table('sale_detail')
		->set($data)
		->insert();
	}

	public function updateProduct($id, $cant){
		$this->db
		->table('product')
		->set('stock', 'stock-'.$cant, false)
		->where('id', $id)
		->update();
	}
	// ? -> Reporte para Filtrar por fechas PDF and EXCEL
	public function getSales($fechaInicio, $fechaFin){
		$results = $this->db
		->table('sale s')
		->select('s.id, s.subtotal, s.total, s.date, c.name as client, v.name as voucher')
		->join('client c','c.id=s.client_id')
		->join('voucher v','v.id=s.voucher_id')
		->where('s.date >=',$fechaInicio)
		->where('s.date <=',$fechaFin)
		->orderBy('s.id')
		->get()
		->getResultObject();

		return $results;
    }
	// ? -> Reporte para Filtrar por fechas PDF and EXCEL | END
}