<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;
use Cake\Routing\Router;

class BookController extends AppController{
	public function view($number, $id, $year){
		$connection = ConnectionManager::get('default');
		$result = $connection->execute("select * from t_administrator where id=:id", ["id"=>$number])->fetchAll();
		print_r($result);
		

		var_dump($number);	

		var_dump($id);

		var_dump($year);

		var_dump($this->request->pass);

		var_dump($this->request['pass']);

		var_dump($this->request->params['pass']);

		var_dump($this->request->query['timing']);

		return $this->response->withStringBody("hello\n");
	}

	public function add($name){
		print_r($this->request->getData());
		//$connection = ConnectionManager::get("default");
		//$result = $connection->execute("insert into t_administrator(name) values(':name')", ["name"=>$name]);
		//$this->User->newEntity($this->request->getData());
		$this->set(['code'=>1, 'message'=>'end', '_serialize'=>['code', 'message']]);
		//return $this->response->withStringBody("bye\n");
	}

	public function lookup($id){
		$connection = ConnectionManager::get("default");
		$user = $connection->execute("select name from user where id=:id", ["id"=>$id])->fetchAll("assoc");
		$this->set([
			'user'=>$user,
			'_serialize'=>['user']
		]);
		//return $this->response->withStringBody(2);
	}




}
