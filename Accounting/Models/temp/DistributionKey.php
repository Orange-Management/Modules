<?php

class DistributionKey {
	private $fromAccount = 0;
	private $fromCostCenter = 0;

	private $toAccount = 0;
	private $toCostCenter = 0;

	private $percentage = 1.0;

	public function __construct(int $fromAC, int $fromCC, int $toAC, int $toCC) {
		$this->fromAccount = $fromAC;
		$this->fromCostCenter = $fromCC;
		$this->toAccount = $toAC;
		$this->toCostCenter = $toCC;
	}

	public function getFromAccount() : int
	{
		return $this->fromAccount;
	}

	public function getFromCostCenter() : int
	{
		return $this->fromCostCenter;
	}

	public function distribute(AccountValue $value) : AccountValue
	{
		if($value->getAccount() !== $this->fromAccount) {
			throw new \Exception('Bad account.');
		}

		if($value->getCostCenter() !== $this->fromCostCenter) {
			throw new \Exception('Bad costcenter.');
		}

		return new AccountValue($this->toAccount, $this->toCostCenter, $value->getDate(), $value->getValue() * $this->percentage);
	}
}
