<?php 
namespace App\Models;
use CodeIgniter\Model;

class CategoryModel extends Model {

	public function readCategorys(){
		$results = $this->db
		->table('category c')
		->select('c.id, c.name, c.description')
		->get()
		->getResultArray();

		return json_encode($results);
    }

	public function readCategory($id){
		$results = $this->db
		->table('category')
		->where('id', $id)
		->get()
		->getRowObject();

		return $results;
    }

	///////////////EXCEL////////////////////////////
	// ESTO ES PARA REPORTE EXCEL
	public function selectCategory()
    {
        $builder = $this->db->table("category");
        $builder->select("*");
        $result = $builder->get();

        return $result->getResult();
    }
	// ESTO ES PARA REPORTE EXCEL | END |

	public function selectRow($id)
    {
        $builder = $this->db->table("category");
        $builder->select("*");
        $builder->where("id", $id);
        $result = $builder->get();
        // echo $this->db->getLastQuery();

        return $result->getRow();

        // "SELECT * FROM mytable WHERE key = '1213'";
    }
	///////////////EXCEL-END////////////////////////////
    public function createCategory($data){
		$this->db
		->table('category')
		->set($data)
		->insert();
	}
	///////////////EXCEL////////////////////////////
	public function updateCategoryExcel($id, $data){
		$builder = $this->db->table("category");
        $query =  $builder->where("id", $id);
        return  $query->update($data);
	}
	///////////////EXCEL-END////////////////////////////
	public function updateCategory($id, $data){
		$this->db
		->table('category')
		->set($data)
		->where('id', $id)
		->update();
	}

	public function deleteCategory($id){
		$this->db
		->table('category')
		->where('id', $id)
		->delete();

		return $this->db->affectedRows();
	}

}