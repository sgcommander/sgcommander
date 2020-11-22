<?php
	Class ConfigTest Extends PHPUnit_Framework_TestCase
	{
		public function testSet(){
			$config = new Config();
			
			$config->set(array(
							'key1' => 'value1',
							'key2' => 'value2'
						)
			);
			
			$config->set(array(
									'key3' => 'value3',
									'key2' => 'value4'
								)
			);
			
			return $config;
		}
		
		/**
		* @depends testSet
		*/
		public function testGet($config){
			$this->assertEquals($config->get('key1'), 'value1', 'Check values');
			$this->assertEquals($config->get('key3'), 'value3', 'Check values');
			$this->assertEquals($config->get('key2'), 'value4', 'Check overwrite value');
			$this->assertEquals($config->get('key_not_exists'), NULL, 'Check unknow key');
		}
		
		/**
		* @depends testSet
		*/
		public function testDel($config){
			$config->del('key1');
			$config->del(array('key2', 'key3'));
			
			$this->assertEquals($config->get('key1'), NULL, 'Check deleted values');
			$this->assertEquals($config->get('key2'), NULL, 'Check multiple deleted values');
			$this->assertEquals($config->get('key3'), NULL, 'Check multiple deleted values');
		}
	}
?>
