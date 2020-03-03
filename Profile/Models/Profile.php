<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Profile\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Profile\Models;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
use Modules\Media\Models\Media;
use Modules\Media\Models\NullMedia;

use phpOMS\Stdlib\Base\Location;

/**
 * Profile class.
 *
 * @package Modules\Profile\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Profile implements \JsonSerializable
{
    /**
     * Id.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Profile image.
     *
     * @var Media
     * @since 1.0.0
     */
    protected Media $image;

    /**
     * Birthday.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    protected \DateTime $birthday;

    /**
     * Account.
     *
     * @var Account
     * @since 1.0.0
     */
    protected Account $account;

    /**
     * Location data.
     *
     * @var Location[]
     * @since 1.0.0
     */
    protected array $location = [];

    /**
     * Contact data.
     *
     * @var ContactElement[]
     * @since 1.0.0
     */
    protected array $contactElements = [];

    /**
     * Constructor.
     *
     * @param null|Account $account Account to initialize this profile with
     *
     * @since 1.0.0
     */
    public function __construct(Account $account = null)
    {
        $this->image    = new NullMedia();
        $this->birthday = new \DateTime('now');
        $this->account  = $account ?? new Account();
    }

    /**
     * Get account id.
     *
     * @return int Account id
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get account locations.
     *
     * @return Location[]
     *
     * @since 1.0.0
     */
    public function getLocation() : array
    {
        return $this->location;
    }

    /**
     * Add location.
     *
     * @param Location $location Location
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addLocation(Location $location) : void
    {
        $this->location[] = $location;
    }

    /**
     * Get account contact element.
     *
     * @return ContactElement[]
     *
     * @since 1.0.0
     */
    public function getContactElements() : array
    {
        return $this->contactElements;
    }

    /**
     * Add contact element.
     *
     * @param ContactElement $contactElements Contact Element
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addContactElements(ContactElement $contactElements) : void
    {
        $this->contactElements[] = $contactElements;
    }

    /**
     * Get account image.
     *
     * @return Media
     *
     * @since 1.0.0
     */
    public function getImage() : Media
    {
        return $this->image ?? new NullMedia();
    }

    /**
     * Set account image.
     *
     * @param Media $image Profile image
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setImage(Media $image) : void
    {
        $this->image = $image;
    }

    /**
     * Set account.
     *
     * @param Account $account Profile account
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setAccount(Account $account) : void
    {
        $this->account = $account;
    }

    /**
     * Get account.
     *
     * @return Account
     *
     * @since 1.0.0
     */
    public function getAccount() : Account
    {
        return $this->account ?? new NullAccount();
    }

    /**
     * Set birthday.
     *
     * @param \DateTime $birthday Birthday
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setBirthday(\DateTime $birthday) : void
    {
        $this->birthday = $birthday;
    }

    /**
     * Get birthday.
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getBirthday() : \DateTime
    {
        return $this->birthday;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return [
            'id'             => $this->id,
            'account'        => $this->account,
            'image'          => $this->image,
            'location'       => $this->location,
            'contactelement' => $this->contactElements,
        ];
    }
}
