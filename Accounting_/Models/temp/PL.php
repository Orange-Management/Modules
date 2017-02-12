<?php

class PL {
	private $name = '';

	private $structure = [];

	public function addStructureElement(StructureElementInterface $element, int $position = -1)
	{
		if(count($structure) >= $position) {
			$this->structure = array_merge(array_slice($this->structure, 0, $position - 1, false), [$element], array_slice($this->structure, $position-1, count($this->structure) - 1, false));
		} else {
			$this->structure[] = $element;			
		}
	}

	public function getStructure() : array 
	{
		return $this->structure;
	}

	public function getAccountValues() : array 
	{
		$values = [];
		foreach($this->structure as $element) {
			$values += $element->getValues();
		}
	}

	public function getAccountsById(int $id) : array
	{
		$accounts = $this->get($id);

		if(!isset($accounts)) {
			return [];
		}

		if($accounts instanceof Account) {
			return [$accounts];
		}

		return $accounts->getAccounts();
	}

	public function get(int $id)
	{
		if(isset($this->structure[$id])) {
			return $this->structure[$id];
		}

		$found = null;
		foreach($this->structure as $element) {
			$found = $element->get($id);

			if(isset($found)) {
				return $found;
			}
		}

		return $found;
	}

	public function getTotal(int $id, int $costCenter = null) : Money
	{
		return isset($costCenter) ? $this->structure[$id]->getTotalCostCenter($costCenter) : $this->structure[$id]->getTotal();
	}
}
