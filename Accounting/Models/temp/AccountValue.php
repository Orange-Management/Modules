<?php

class AccountValue {
	private $account = 0;
	private $costCenter = 0;
	private $date = null;
	private $value = null;
	private $contraAccount = 0;
	private $text = '';
	private $postingId = 0;

	public function __construct($account, $costCenter, \DateTime $date, Money $value)
	{
		$this->account = $account;
		$this->costCenter = $costCenter;
		$this->date = $date;
		$this->value = $value;
	}

	public function getAccount()
	{
		return $this->account;
	}

	public function getCostCenter() 
	{
		return $this->costCenter;
	}

	public function getDate()
	{
		return $this->date;
	}

	public function getValue() : Money
	{
		return $this->value;
	}

	public static function group($values) : array
	{
		$accounts = [];

		foreach($values as $value) {
			if(!isset($accounts[$value->getAccount()])) {
				$accounts[$value->getAccount()] = [];
			}

			if(!isset($accounts[$value->getAccount()][$value->getCostCenter()])) {
				$accounts[$value->getAccount()][$value->getCostCenter()] = [];
			}

			$accounts[$value->getAccount()][$value->getCostCenter()] = $value;
		}

		return $accounts;
	}
}
