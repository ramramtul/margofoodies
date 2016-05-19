<!-- @author Septiviana Savitri
@class : reviewsController
Kelas ini berisi kode untuk mengontrol atribut apa saja yang ada di review yang akan ditampilkan di panel admin -->
<?php 

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use \Serverfireteam\Panel\CrudController;

use Illuminate\Http\Request;

class reviewsController extends CrudController{

    public function all($entity){
        parent::all($entity); 
        	$this->filter = \DataFilter::source(new \App\Reviews());
		
        	$this->filter->add('isi_review', 'isi_review', 'text'); // Filter by String
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);

			$this->grid->add('id', 'id');
			$this->grid->add('email', 'email');
			$this->grid->add('id_menu', 'id_menu');
			$this->grid->add('isi_review', 'isi_review');
			$this->grid->add('rate', 'rate');
			$this->grid->add('status', 'status');
			
			$this->addStylesToGrid();

			$this->grid->paginate(10);

			//$this->grid->add('name', 'Name', true); // allow ordering by this column
			$this->grid->orderBy('id','desc');


        /** Simple code of  filter and grid part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields


			$this->filter = \DataFilter::source(new \App\Category);
			$this->filter->add('name', 'Name', 'text');
			$this->filter->submit('search');
			$this->filter->reset('reset');
			$this->filter->build();

			$this->grid = \DataGrid::source($this->filter);
			$this->grid->add('name', 'Name');
			$this->grid->add('code', 'Code');
			$this->addStylesToGrid();

        */
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);
        	$this->edit = \DataEdit::source(new \App\Reviews());

			$this->edit->label('Validasi Review');

			$this->edit->add('status', 'status', 'radiogroup')->option('0', 'Tidak')->option('1', 'Ya');
       
			$this->edit->show('isi_review', 'isi_review', 'text');  
        /* Simple code of  edit part , List of all fields here : http://laravelpanel.com/docs/master/crud-fields
	
			$this->edit = \DataEdit::source(new \App\Category());

			$this->edit->label('Edit Category');

			$this->edit->add('name', 'Name', 'text');
		
			$this->edit->add('code', 'Code', 'text')->rule('required');


        */
       
        return $this->returnEditView();
    }    
}
