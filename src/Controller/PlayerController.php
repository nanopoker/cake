<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;

class PlayerController extends AppController{
    public function name(){
    	$this->render();
    }

    public function age(){
        $users = TableRegistry::get("user");
	$query = $users->find();
	$string="";
	foreach ($query as $row){
	    echo $row->name;
	    $string.=$row->name." ";
        }
	return $this->response->withStringBody($string);
    }

	public function param(){
		print_r($this->request->getParam('pass'));
		return $this->response->withStringbody("good");
	}
}
