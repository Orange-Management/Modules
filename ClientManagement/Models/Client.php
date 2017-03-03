<?php
/**
 * Orange Management
 *
 * PHP Version 7.1
 *
 * @category   TBD
 * @package    TBD
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://orange-management.com
 */
declare(strict_types=1);
namespace Modules\Profile\Models;

use Modules\Profile\Models\Account;

/**
 * Account class.
 *
 * @category   Modules
 * @package    Modules\Admin
 * @author     OMS Development Team <dev@oms.com>
 * @author     Dennis Eichhorn <d.eichhorn@oms.com>
 * @license    OMS License 1.0
 * @link       http://orange-management.com
 * @since      1.0.0
 */
class Client extends Account
{
	private $number = 0;

	private $numberReverse = 0;

	private $status = 0;

	private $type = 0;

	private $taxId = '';

	private $info = '';

	private $createdAt = null;

	public function __construct(int $id = 0) 
	{
		$this->createdAt = new \DateTime('now');

		parent::__construct($id);
	}

	public function getNumber() : int
	{
		return $this->number;
	}

	public function setNumber(int $number) /* : void */
	{
		$this->number = $number;
	}

	public function getReverseNumber() 
	{
		return $this->numberReverse;
	}

	public function setReverseNumber($rev_no) /* : void */
	{
		if(!is_scalar($rev_no)) {
			throw new \Exception();
		}

		$this->numberReverse = $rev_no;
	}

	public function getStatus() : int
	{
		return $this->status;
	}

	public function setStatus(int $status) /* : void */
	{
		$this->status = $status;
	}

	public function getType() : int
	{
		return $this->type;
	}

	public function setType(int $type) /* : void */
	{
		$this->type = $type;
	}

	public function getTaxId() : string
	{
		return $this->taxId;
	}

	public function setTaxId(string $taxId) /* : void */
	{
		$this->taxId = $taxId;
	}

	public function getInfo() : string
	{
		return $this->info;
	}

	public function setInfo(string $info)  /* : void */
	{
		return $this->info;
	}

	public function getCreatedAt() : \DateTime
	{
		return $this->createdAt;
	}
}
