<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Routing\Router;
use Cake\Log\Log;
use Cake\Database\Connection;

Log::config('queries', [
'className' => 'File',
'path' => LOGS,
'file' => 'queries.log',
'scopes' => ['queriesLog']
]);

class DbController extends AppController{
	public function update(){
		if(!$this->request->is('put')){
			return $this->response->withStringBody("put method required\n");
		}
		$params = $this->request->getData();
		//ConnectionManager::get("default")->execute("update user set name=:name where id=:id", ['name'=>$params['name'], 'id'=>$params['id']]);
		ConnectionManager::get('default')->update('user', ['name'=>$params['name']], ['id'=>$params['id']]);
		return $this->response->withStringBody("done\n");
	}

	public function insert(){
		if(!$this->request->is('post')){
			return $this->response->withStringBody("post method required\n");
		}
		$params = $this->request->getData();
		ConnectionManager::get('default')->insert('user', ['name'=>$params['name'], 'profile_id'=>$params['profile_id']]);
		return $this->response->withStringBody("insert data done\n");
	}

	public function remove(){
		if(!$this->request->is('delete')){
			return $this->response->withStringBody("delete method required\n");
		}
		$params = $this->request->getData();
		$result = ConnectionManager::get('default')->delete('user', ['id'=>$params['id']]);
		return $this->response->withStringBody("delete done with $result \n");
	}

	public function view($id){
		$connection = ConnectionManager::get('default');
		$query = $connection->newQuery();
		$user = $query->select('name')->from('user');
		foreach($user as $v){
			print_r($v);
		}

		print_r($connection->execute("select name from user where id=:id", ['id'=>$id])->fetchAll('assoc'));
		return $this->response->withStringBody("view done\n");
	}

	public function view1($id){
		//get all users
		$users = TableRegistry::get('user')->find();
		
		$user = TableRegistry::get('user')->find()->where(['id'=>$id]);

	        foreach ($user as $v){
			print_r($v->name);
		}
		
		return $this->response->withStringBody("view1 done\n");
	}
	//count affected rows
	public function rows(){
		$conn = ConnectionManager::get('default');
		$users = $conn->execute('select name from user')->fetchAll();
		$rows = $conn->execute("select name from user")->rowCount();
		print_r($rows);
		foreach($users as $user){
			print_r($user);
		}
		return $this->response->withStringBody("done\n");
	}

	public function logging(){
		$conn = ConnectionManager::get('default');
		$conn->logQueries(true);
		$query = $conn->newQuery();
		$users = $query->select('name')->from('user');
		//打印出查询的sql语句
		print_r($query->sql());
		//默认调用toString()方法
		echo $query;
		echo "<br>";
		foreach($users as $user){
			print_r($user);
		}
		return $this->response->withStringBody('done');
	}
	











}

