<?php
namespace App\Controller;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use Cake\Log\Log;

class PlayerController extends AppController{
    public function name(){
    	$this->render();
    }

    public function age(){
        $users = TableRegistry::get("t_administrator");
	$query = $users->find();
	$string="";
	foreach ($query as $row){
	    $string.=$row->name." ";
        }

	$connection = ConnectionManager::get('default');
	print_r($result=$connection->execute("select name from user limit 4;")->fetchAll());
	foreach($result as $arr){
		print_r($arr);
	}
	
	//多数据库配置测试
	$connection2 = ConnectionManager::get("workflow_db");
	print_r($connection2);

	print_r($connection2->execute("select * from t_admin limit 3;")->fetchAll("assoc"));
	return $this->response->withStringBody($string);
    }

	public function param(){
		print_r($this->request->getParam('pass'));
		return $this->response->withStringbody("good");
	}
	
	//原生sql语句测试
	public function rawSql(){
		echo 1;
		$connection = ConnectionManager::get("default");
		$connection->update("profile", "age=age+10");
		
	}	

	public function logging(){
		Log::write("debug", "log in something");
		Log::write("warning", "log a warning");
		Log::write("error", "log in some error");
	}


}
