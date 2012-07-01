#FM
###A rough CodeIgniter library wrapper for the FileMaker.php library.

##PLEASE NOTE:

This code was created solely for migrating data from a legacy FileMaker database application. 
It is in no means complete or intended to be an end-all solution for using FileMaker as a CodeIgniter datasource.

##Instructions

Simply copy the contents of your ```FM_API_for_PHP_Standalone.zip``` into the src directory, and see the usage example below.

##Usage

Basic usage example:

```php
		public function FM(){
			$this->load->add_package_path(APPPATH.'third_party/FileMaker/');
			$this->load->library('fm', array(
				'host' => 'host.filemaker.example',
				'database' => 'exampleDB',
				'username' => 'myUsername',
				'password' => '123456'
			), 'FM');

			$this->FM->newFindCommand('myLayout');
			$this->FM->execute();
			$records = $this->FM->getRecords();

			var_dump($records)
		}
```



