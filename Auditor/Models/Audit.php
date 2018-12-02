<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\Auditor
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       http://website.orange-management.de
 */
declare(strict_types=1);

namespace Modules\Auditor\Models;

use phpOMS\Account\Account;

/**
 * Audit class.
 *
 * @package    Modules\Auditor
 * @license    OMS License 1.0
 * @link       http://website.orange-management.de
 * @since      1.0.0
 */
class Audit
{
    /**
     * Audit id.
     *
     * @var int
     * @since 1.0.0
     */
    private $id = 0;

    /**
     * Audit account.
     *
     * @var int|Account
     * @since 1.0.0
     */
    private $account = 0;

    /**
     * Audit type.
     *
     * @var int
     * @since 1.0.0
     */
    private $type = 0;

    /**
     * Audit subtype.
     *
     * @var int
     * @since 1.0.0
     */
    private $subtype = 0;

    /**
     * Audit module.
     *
     * @var string|null
     * @since 1.0.0
     */
    private $module = null;

    /**
     * Audit reference.
     *
     * This could be used to reference other model ids
     *
     * @var string|null
     * @since 1.0.0
     */
    private $ref = null;

    /**
     * Audit content.
     *
     * Additional audit information
     *
     * @var string|null
     * @since 1.0.0
     */
    private $content = null;

    /**
     * Old value.
     *
     * @var string|null
     * @since 1.0.0
     */
    private $old = null;

    /**
     * New value.
     *
     * @var string|null
     * @since 1.0.0
     */
    private $new = null;

    /**
     * Account.
     *
     * @var Account|int
     * @since 1.0.0
     */
    private $createdBy = 0;

    /**
     * Created at.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private $createdAt = null;

    /**
     * Ip of creator.
     *
     * @var int
     * @since 1.0.0
     */
    private $ip = 0;

    /**
     * Constructor.
     *
     * @parram Account $account Account of the creator
     * @parram string  $old     Old value
     * @parram string  $new     New value
     * @parram int     $type    Type of the audit
     * @parram int     $subtype Subtype of the audit
     * @parram string  $module  Module id
     * @parram string  $content Additional audit information
     *
     * @since  1.0.0
     */
    public function __construct(
        Account $account,
        ?string $old,
        ?string $new,
        int $type = 0,
        int $subtype = 0,
        string $module = null,
        string $ref = null,
        string $content = null
    ) {
        $this->createdAt = new \DateTime('now');
        $this->account   = $account;
        $this->old       = $old;
        $this->new       = $new;
        $this->type      = $type;
        $this->subtype   = $subtype;
        $this->module    = $module;
        $this->ref       = $ref;
        $this->content   = $content;
    }

    /**
     * Get type.
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getType() : int
    {
        return $this->type;
    }

    /**
     * Get subtype.
     *
     * @return int
     *
     * @since  1.0.0
     */
    public function getSubType() : int
    {
        return $this->subtype;
    }

    /**
     * Get Module.
     *
     * @return string|null
     *
     * @since  1.0.0
     */
    public function getModule() : ?string
    {
        return $this->module;
    }

    /**
     * Get reference.
     *
     * If existing this can be a reference to another model
     *
     * @return string|null
     *
     * @since  1.0.0
     */
    public function getRef() : ?string
    {
        return $this->ref;
    }

    /**
     * Get content.
     *
     * @return string|null
     *
     * @since  1.0.0
     */
    public function getContent() : ?string
    {
        return $this->content;
    }

    /**
     * Get old value.
     *
     * @return string|null
     *
     * @since  1.0.0
     */
    public function getOld() : ?string
    {
        return $this->old;
    }

    /**
     * Get new value.
     *
     * @return string|null
     *
     * @since  1.0.0
     */
    public function getNew() : ?string
    {
        return $this->new;
    }

    /**
     * Get created by.
     *
     * @return int|Account
     *
     * @since  1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Get created at.
     *
     * @return \DateTime
     *
     * @since  1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }
}
