<?php

class Account implements StructureElementInterface {
	private $id = 0;
	private $name = '';
	private $account = 0;
	private $values = [];
	private $total = [];

	private $type = 0; // GUV/Bilanz
	private $assigned = 0; // Ertrags/Aufwandskonto | active/passive
	private $currency = 0; // Currency type
	private $tax = 0;
	private $hasOP = false;
	private $activity = true;
	private $hasCostCenter = true;
	private $hasCostObject = true;
	private $defaultCostCenter = 0;
	private $isFixedCostCenter = false;
	private $isVirtual = false;
	private $isCashback = false;

	private $isOutdated = false;

	public function __construct(int $account, string $name, array $values = []) 
	{
		$this->account = $account;
		$this->name = $name;
		$this->values = [];

		if(!empty($values)) {
			$this->isOutdated = true;
		}
	}

	public function getId()
	{
		return $this->id;
	}

	public function getName() : string
	{
		return $this->name;
	}

	public function addValue(AccountValue $value) 
	{
		$this->values[] = $value;
		$this->isOutdated = true;
	}

	public function getValues() : array
	{
		return $this->values;
	}

	public function getTotal() : Money
	{
		if($this->isOutdated) {
			$this->parseValues();
		}

		$total = new Money(0);

		foreach($this->total as $costCenter) {
			$total->add($costCenter);
		}

		return $total;
	}

	public function getTotalCostCenter(int $costCenter) : Money
	{
		if($this->isOutdated) {
			$this->parseValues();
		}

		return $this->total[$costCenter] ?? new Money(0);
	}

	private function parseValues() : array
	{
		$this->total = [];
		foreach($this->values as $value) {
			if(!isset($this->total[$value->getCostCenter()])) {
				$this->total[$value->getCostCenter()] = new Money(0);
			}

			$this->total[$value->getCostCenter()]->add($value->getValue());
		}

		$this->isOutdated = false;

		return $this->total;
	}
}
