<!-- @author Septiviana Savitri
@class : restoransController
Kelas ini berisi kode untuk mengontrol atribut apa saja yang ada di restoran yang akan ditampilkan di panel admin -->
<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class restoransController extends CrudController{

    public function all($entity){
        parent::all($entity); 

        $this->filter = \DataFilter::source(new \App\Restorans());
			//$this->filter->add('categoryId','Category','select')->options(\App\Category::lists("name", "id")->all()); // Filter with Select List
			$this->filter->add('nama', 'Nama', 'text'); // Filter by String
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);

			$this->grid->add('id', 'id');
			$this->grid->add('nama', 'Nama');
			$this->grid->add('no_telepon', 'Telepon');
			$this->grid->add('lokasi', 'Lokasi');
			$this->grid->add('deskripsi', 'Deskripsi');
			$this->grid->add('tax', 'Tax');
			$this->grid->add('rate', 'Rate');
			
			$this->addStylesToGrid();

			$this->grid->paginate(10);

			//$this->grid->add('name', 'Name', true); // allow ordering by this column
			$this->grid->orderBy('id','asc'); //default orderby

                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);

        	$this->edit = \DataEdit::source(new \App\Restorans());

			$this->edit->label('Edit Restoran');

			$this->edit->add('id', 'ID', 'text');

			$this->edit->add('nama', 'Nama', 'text');
		
			$this->edit->add('no_telepon', 'Telepon', 'text');

			$this->edit->add('lokasi', 'Lokasi', 'text');
		
			$this->edit->add('deskripsi', 'Deskripsi', 'text');

			$this->edit->add('tax', 'Tax', 'text');
		
			$this->edit->add('rate', 'Rate', 'text');
       
        return $this->returnEditView();
    }    
}
