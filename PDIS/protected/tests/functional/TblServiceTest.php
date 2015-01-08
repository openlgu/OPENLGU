<?php

class TblServiceTest extends WebTestCase
{
	public $fixtures=array(
		'tblServices'=>'TblService',
	);

	public function testShow()
	{
		$this->open('?r=tblService/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=tblService/create');
	}

	public function testUpdate()
	{
		$this->open('?r=tblService/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=tblService/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=tblService/index');
	}

	public function testAdmin()
	{
		$this->open('?r=tblService/admin');
	}
}
