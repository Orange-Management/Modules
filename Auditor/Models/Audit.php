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

final class Audit
{
    private $id = 0;

    private $type = 0;

    private $subtype = 0;

    private $module = 0;

    private $ref = '';

    private $content = '';

    private $old = '';

    private $new = '';

    private $createdBy = 0;

    private $createdAt = null;

    public function __construct(
        Account $account,
        string $old,
        string $new,
        int $type = 0,
        int $subtype = 0,
        string $module = null,
        string $content = null
    ) {
        $this->createdAt = new \DateTime('now');
    }

    public function getType() : int
    {
        return $this->type;
    }

    public function getSubType() : int
    {
        return $this->subtype;
    }

    public function getModule() : int
    {
        return $this->module;
    }

    public function getRef() : string
    {
        return $this->ref;
    }

    public function getContent() : string
    {
        return $this->content;
    }

    public function getOld() : string
    {
        return $this->old;
    }

    public function getNew() : string
    {
        return $this->new;
    }

    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }
}
