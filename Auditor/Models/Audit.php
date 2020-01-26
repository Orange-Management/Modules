<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Auditor\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Auditor\Models;

use phpOMS\Account\Account;

/**
 * Audit class.
 *
 * @package Modules\Auditor\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Audit
{
    /**
     * Audit id.
     *
     * @var int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Audit type.
     *
     * @var int
     * @since 1.0.0
     */
    private int $type;

    /**
     * Audit subtype.
     *
     * @var int
     * @since 1.0.0
     */
    private int $subtype;

    /**
     * Audit module.
     *
     * @var null|string
     * @since 1.0.0
     */
    private ?string $module;

    /**
     * Audit reference.
     *
     * This could be used to reference other model ids
     *
     * @var null|string
     * @since 1.0.0
     */
    private ?string $ref;

    /**
     * Audit content.
     *
     * Additional audit information
     *
     * @var null|string
     * @since 1.0.0
     */
    private ?string $content;

    /**
     * Old value.
     *
     * @var null|string
     * @since 1.0.0
     */
    private ?string $old;

    /**
     * New value.
     *
     * @var null|string
     * @since 1.0.0
     */
    private ?string $new;

    /**
     * Account.
     *
     * @var Account|int
     * @since 1.0.0
     */
    private $createdBy;

    /**
     * Created at.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private \DateTime $createdAt;

    /**
     * Ip of creator.
     *
     * @var int
     * @since 1.0.0
     */
    private int $ip = 0;

    /**
     * Constructor.
     *
     * @parram Account     $account Account of the creator
     * @parram null|string $old     Old value
     * @parram null|string $new     New value
     * @parram int         $type    Type of the audit
     * @parram int         $subtype Subtype of the audit
     * @parram null|string $module  Module id
     * @parram null|string $content Additional audit information
     *
     * @since 1.0.0
     */
    public function __construct(
        $account = 0,
        string $old = null,
        string $new = null,
        int $type = 0,
        int $subtype = 0,
        string $module = null,
        string $ref = null,
        string $content = null
    ) {
        $this->createdAt = new \DateTime('now');
        $this->createdBy = $account;
        $this->old       = $old;
        $this->new       = $new;
        $this->type      = $type;
        $this->subtype   = $subtype;
        $this->module    = $module;
        $this->ref       = $ref;
        $this->content   = $content;
    }

    /**
     * Get id.
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * Get type.
     *
     * @return int
     *
     * @since 1.0.0
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
     * @since 1.0.0
     */
    public function getSubType() : int
    {
        return $this->subtype;
    }

    /**
     * Get Module.
     *
     * @return null|string
     *
     * @since 1.0.0
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
     * @return null|string
     *
     * @since 1.0.0
     */
    public function getRef() : ?string
    {
        return $this->ref;
    }

    /**
     * Get content.
     *
     * @return null|string
     *
     * @since 1.0.0
     */
    public function getContent() : ?string
    {
        return $this->content;
    }

    /**
     * Get old value.
     *
     * @return null|string
     *
     * @since 1.0.0
     */
    public function getOld() : ?string
    {
        return $this->old;
    }

    /**
     * Get new value.
     *
     * @return null|string
     *
     * @since 1.0.0
     */
    public function getNew() : ?string
    {
        return $this->new;
    }

    /**
     * Get created by.
     *
     * @return Account|int
     *
     * @since 1.0.0
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
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }
}
