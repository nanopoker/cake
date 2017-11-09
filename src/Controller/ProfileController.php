<?php
namespace App\Controller;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;
use Cake\Routing\Router;
use Cake\ORM\TableRegistry;
use Cake\ORM\Table;

class ProfileController extends AppController{
	public function view($id){
		$profile = TableRegistry::get("profile");
		//print_r($profile);
		print_r($profile->table());

		$profile1 = $profile->find()->where(['id'=>$id]);
		//print_r($profile1);
		//print_r($profile1->age);
		foreach($profile1 as $v){
			print_r($v->age);
		}
		return $this->response->withStringBody("view done\n");
	}

	public function getall(){
		$profiles = TableRegistry::get("profile")->find()->order(['age'=>'desc']);
		foreach($profiles as $profile){
			print_r($profile->id);
		}

		print_r("\n");
		//print_r($profiles->all());
		$all = $profiles->all();
		foreach($all as $v){
			//print_r($v->age);
			echo $v->age.PHP_EOL;
			Log::write('debug', $v->age);
		}

		$admins = TableRegistry::get("t_administrator")->find()->toArray();
		//print_r($admins);
		foreach($admins as $admin){
			//print_r($admin->name);
			echo $admin->name.PHP_EOL;
		}
		return $this->response->withStringBody("getall done\n");
	}

	public function single(){
		$profile = TableRegistry::get('t_administrator');
		$first = $profile->find()->first();
		print_r($first);
		echo PHP_EOL;
		echo $first->name.PHP_EOL;
		$last = $profile->find()->last();
		echo $last->name.PHP_EOL;
		return $this->response->withStringBody("single done\n");
	}

	public function chain(){
		$admins = TableRegistry::get("t_administrator")->find();
		print_r($admins);
		//limit
		$limit = $admins->limit(4);
		foreach($limit as $admin){
			echo $admin->name.PHP_EOL;
		}
		
		echo "\n";
		//order
		$orders = $admins->order(['id'=>'desc'])->limit(2);
		foreach($orders as $order){
			echo $order->name.PHP_EOL;
		}

		echo "\n";

		//count
		echo $admins->count().PHP_EOL;

		echo "\n";

		echo $admins->sql().PHP_EOL;

		$wheres = $admins->where(['or'=>[['id'=>1], ['id'=>2]]]);
		foreach($wheres as $where){
			echo $where->name.PHP_EOL;
		}

		echo PHP_EOL;
		return $this->response->withStringBody("chain done\n");
	}
}
