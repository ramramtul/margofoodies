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

			$this->grid->orderBy('id','desc');


        
                 
        return $this->returnView();
    }
    
    public function  edit($entity){
        
        parent::edit($entity);
        	$this->edit = \DataEdit::source(new \App\Reviews());
        	$results = \App\Reviews::all()->last()->id ;
			
			
			$this->edit->add('id', '', 'auto')->insertValue($results + 1);

			$this->edit->label('Validasi Review');

			$this->edit->add('status', 'status', 'radiogroup')->option('0', 'Tidak Valid')->option('1', 'Valid');
       
			$this->edit->show('isi_review', 'isi_review', 'text');  
       
       
        return $this->returnEditView();
    }    
}
