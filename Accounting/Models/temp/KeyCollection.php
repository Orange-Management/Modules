<?php

class KeyCollection {
	private $fromAccount = 0;

	private $distributionKeys = [];

	public function __construct(int $account, array $distributionKeys = []) {
		$this->fromAccount = $account;
		$this->distributionKeys = $distributionKeys;
	}

	public function getAccount() : int
	{
		return $this->fromAccount;
	}

	public function addKey(DistributionKey $key) 
	{
		$this->distributionKeys[$key->getFromCostCenter()] = $key;
	}

	public function distribute(array $accountValues) : array
	{
		$values = [];
		foreach($accountValues as $value) {
			$values[] = $this->distributionKeys[$value->getCostCenter()]->distribute($value);
		}

		return $values;
	}
}
