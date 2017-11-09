<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;
use Cake\Routing\Router;

class UserController extends AppController{
	//public static $connect = ConnectionManager::get('default');
	public function view($id){
		$connect = ConnectionManager::get('default');
		$user = $connect->execute("select * from user where id=:id", ["id"=>$id])->fetchAll('assoc');
		print_r($user);
		//print_r($user);
	}

	public function add(){
		$params = $this->request->getData();
		print_r($params['name']);
		$connect = ConnectionManager::get('default');
		$connect->execute('insert into user(name, profile_id) values(:name, :profile_id)', ['name'=>$params['name'], 'profile_id'=>$params['profile_id']]);
		return $this->response->withStringBody("post done");
	}

	public function edit(){
		if(!$this->request->is('put')){
			return $this->response->withStringBody('method wrong');
		}
		$params = $this->request->getData();
		//print_r($params);
		ConnectionManager::get('default')->execute("update user set name=:name where id=:id", ['name'=>$params['name'], 'id'=>$params['id']]);
		return $this->response->withStringBody("put method done\n");
	}
	public function remove(){
		if(!$this->request->is('delete')){
			return $this->response->withStringBody('method wrong');
		}
		$params = $this->request->getData();
		ConnectionManager::get('default')->execute('delete from user where id=:id', ['id'=>$params['id']]);
		return $this->response->withStringBody("delete method done\n");
	}
}
