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

use Modules\Admin\Models\Account;
use Modules\Media\Models\Media;
use Modules\Media\Models\NullMedia;

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
class Profile
{
	private $id = 0;

	private $image = null;

	private $birthday = null;

	private $account = null;

	private $location = [];

	public function __construct() 
	{
		$this->image = new NullMedia();
		$this->birthday = new \DateTime('now');
		$this->account = new Account();
	}

	public function getId() : int
	{
		return $this->id;
	}

	public function getLocation() : array
	{
		return $this->location;
	}

	public function addLocation(Location $location) 
	{
		$this->location[] = $location;
	}

	public function getImage() : Media
	{
		return $this->image;
	}

	public function setImage(Media $image) /* : void */
	{
		$this->image = $image;
	}

	public function setAccount(Account $account) /* : void */
	{
		$this->account = $account;
	}

	public function getAccount() : Account
	{
		return $this->account;
	}

	public function setBirthday(\DateTime $birthday) /* : void */
	{
		$this->birthday = $birthday;
	}

	public function getBirthday() : \DateTime
	{
		return $this->birthday;
	}
}
