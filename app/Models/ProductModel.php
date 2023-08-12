<?php 
namespace App\Models;
use CodeIgniter\Model;

class ProductModel extends Model {

	public function readCategories(){
		$results = $this->db
		->table('category')
		->get()
		->getResultArray();

		return json_encode($results);
    }
	
	public function readProducts(){
		$results = $this->db
		->table('product p')
		->select("p.id, p.name, p.barcode, p.price_sale as pricesale, p.stock, p.picture, c.name as category")
		->join("category c","p.category_id=c.id")
		->where('p.barcode !=', '')
		->get()
		->getResultObject();

		return $results;
    }
	// ! -> EST ES PARA REPORTE PDF

	public function dataProduct(){
		$sqlProduct = $this->db->query("SELECT p.id, p.name, p.barcode, p.price_sale as pricesale, p.stock, p.picture, c.name as category FROM product p 
		INNER JOIN category c ON p.category_id=c.id");
       	return $sqlProduct;
	}
	// ! -> EST ES PARA REPORTE PDF | END

	public function readProduct($id){
		$results = $this->db
		->table('product p')
		->select("p.*, c.id as categoryid, c.name as category")
		->join("category c","p.category_id=c.id")
		->where('p.id', $id)
		->get()
		->getRowObject();

		return $results;
    }

	public function checkProduct($id){
		$results = $this->db
		->table('product')
		->where('name', $id)
		->get()
		->getRowObject();

		return $results;
	}

	public function newProduct($data){
		$this->db
		->table('product')
		->set($data)
		->insert();

		return $this->db->insertID();
	}

	// TODO -> /////////////EXCEL////////////////////////////
	public function selectRow($id)
    {
        $builder = $this->db->table("product");
        $builder->select("*");
        $builder->where("id", $id);
        $result = $builder->get();
        // echo $this->db->getLastQuery();

        return $result->getRow();
    }
	// TODO -> /////////////EXCEL END////////////////////////////
	
	public function createProduct($id, $data){
		$this->db
		->table('product')
		->set($data)
		->where('id', $id)
		->update();
	}

	// TODO -> /////////////EXCEL////////////////////////////
	public function updateProductExcel($id, $data){
		$builder = $this->db->table("product");
        $query =  $builder->where("id", $id);
        return  $query->update($data);
	}
	// TODO -> /////////////EXCEL END////////////////////////////

	public function updateProduct($id, $data){
		$this->db
		->table('product')
		->set($data)
		->where('id', $id)
		->update();
	}

	public function deleteProduct($id){
		$this->db
		->table('product')
		->where('id', $id)
		->delete();

		return $this->db->affectedRows();
	}

}