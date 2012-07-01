<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class FM {

	private $src;
	private $FileMaker;

	private $database;
	private $host;
	private $username;
	private $password;

	public $find;
	public $result;
	public $records;

	public function __construct($options = array()){
		// FileMaker.php is a legacy library and has many deprecated functions...we'll ignore these errors.
		error_reporting(ini_get('error_reporting') ^ 8192);

		// Get our `src` directory where the FileMaker.php and associated core files are located.
		$this->src = dirname(dirname(__FILE__)) . '/src';
		
		// Load in FileMaker.php
		require_once($this->src .'/FileMaker.php');

		// Create our new instance and local reference.
		$this->FileMaker = $FileMaker = new FileMaker();

		foreach($options as $property => $value){
			if (property_exists($this, $property)) $this->$property = $value;
		}

		// Connect to the FileMaker server...
		$this->set_connection_properties();

	}

	public function set_connection_properties(){
		$this->FileMaker->setProperty('database', $this->database);
		$this->FileMaker->setProperty('hostspec', $this->host);
		$this->FileMaker->setProperty('username', $this->username);
		$this->FileMaker->setProperty('password', $this->password);
	}

	public function newFindCommand($layout){
		$this->find =  $this->FileMaker->newFindCommand($layout);
		return $this->process($this->find, 'newFindCommand');
	}


	public function execute(){
		$this->result = $this->find->execute();
		return $this->process($this->result, 'execute');
	}

	public function getRecords(){
		$this->records = $this->result->getRecords();
		return $this->process($this->records, 'getRecords');
	}

	private function process($data, $from = ''){
		if(FileMaker::isError($data)){
			echo 'FileMaker Error : '. $from .' : '. $data->getMessage() . PHP_EOL;
			exit;
		} else {
			return $data;
		}
	}

}