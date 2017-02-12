<?php

class Element extends StructureElementAbstract {
	private $id = 0;
	private $name = '';
	private $type = 0;

	private $action = '';

	private $children = [];

	public function getId()
	{
		return $this->id;
	}

	public function getName() : string
	{
		return $this->name;
	}

	public function getValues() : array
	{
		$values = [];
		foreach($this->children as $child) {
			if($child instanceof Account) {
				$values[$child->getAccount()] = $child->getValues();
			} else {
				$values += $child->getValues();
			}
		}

		return $values;
	}

	public function getAccounts() : array
	{
		$accounts = [];
		foreach($this->children as $child) {
			if($child instanceof Account) {
				$accounts[$child->getAccount()] = $child->getAccount();
			} else {
				$accounts += $child->getAccounts();
			}
		}

		return $accounts;
	}

	public function getTotal() 
	{
		$total = new Money(0);
		foreach($this->children as $child) {
			$total->add($child->getTotal());
		}

		return $total;
	}

	public function getTotalCostCenter(int $costCenter) 
	{
		$total = new Money(0);
		foreach($this->children as $child) {
			$total->add($child->getTotalCostCenter($costCenter));
		}

		return $total;
	}

	public function getChildren() : array 
	{
		return $this->children;
	}
}
