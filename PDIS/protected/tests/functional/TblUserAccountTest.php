<?php

class TblUserAccountTest extends WebTestCase
{
	public $fixtures=array(
		'tblUserAccounts'=>'TblUserAccount',
	);

	public function testShow()
	{
		$this->open('?r=tblUserAccount/view&id=1');
	}

	public function testCreate()
	{
		$this->open('?r=tblUserAccount/create');
	}

	public function testUpdate()
	{
		$this->open('?r=tblUserAccount/update&id=1');
	}

	public function testDelete()
	{
		$this->open('?r=tblUserAccount/view&id=1');
	}

	public function testList()
	{
		$this->open('?r=tblUserAccount/index');
	}

	public function testAdmin()
	{
		$this->open('?r=tblUserAccount/admin');
	}
}
