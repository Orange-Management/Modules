<?php

class Distribution {
	private $keyCollections = [];

	public function __construct() {}

	public function addKey(DistributionKey $key, $from, $to) 
	{
		$keys = $this->normalizeKey($key, $from, $to);

		foreach($keys as $key) {
			if(!isset($this->keyCollections[$key->getFromAccount()])) {
				$this->keyCollections[$key->getFromAccount()] = new KeyCollection(account here);
			}

			$this->keyCollections[$key->getFromAccount()]->addKey($key);
		}
	}

	public function distribute($from, $to)
	{
		$accounts = $from->getAccountValues();
		$values = [];

		foreach($accounts as $account => $accountValues) {
			$values = array_merge($values, $this->keyCollections[$account]->distribute($accountValues));
		}

		$values = AccountValue::group($values);
		$to->setAccountValues($values);

		return $to;
	}

	private function normalizeKey(DistributionKey $key, $from, $to) : array
	{
		$accountsSource = $from->getAccountsById($key->getFromAccount());
		$accountDestination = $to->getAccountsById($key->getToAccount());
		$keys = [];

		foreach($accountsSource as $accountSource) {
			foreach($key as $rawKey) {
				$keys[$accountSource->getId()] = new DistributionKey(
					$accountSource->getId(),
					$rawKey->getFromCostCenters(), 
					$accountDestination, 
					$rawKey->getToCostCenters()
				);
			}
		}

		return $keys;
	}
}
