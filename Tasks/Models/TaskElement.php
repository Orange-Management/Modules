<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Tasks\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Tasks\Models;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\Group;
use Modules\Admin\Models\NullAccount;
use Modules\Media\Models\Media;
use phpOMS\Stdlib\Base\Exception\InvalidEnumValue;

/**
 * Task element class.
 *
 * @package Modules\Tasks\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class TaskElement implements \JsonSerializable
{
    /**
     * Id.
     *
     * @var int
     * @since 1.0.0
     */
    private int $id = 0;

    /**
     * Description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Description raw.
     *
     * @var string
     * @since 1.0.0
     */
    private string $descriptionRaw = '';

    /**
     * Task.
     *
     * @var int
     * @since 1.0.0
     */
    private int $task = 0;

    /**
     * Creator.
     *
     * @var Account
     * @since 1.0.0
     */
    private Account $createdBy;

    /**
     * Created.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private \DateTime $createdAt;

    /**
     * Status.
     *
     * @var int
     * @since 1.0.0
     */
    private int $status = TaskStatus::OPEN;

    /**
     * Due.
     *
     * @var null|\DateTime
     * @since 1.0.0
     */
    private ?\DateTime $due = null;

    /**
     * Priority
     *
     * @var int
     * @since 1.0.0
     */
    protected int $priority = TaskPriority::NONE;

    /**
     * Media.
     *
     * @var Media[]
     * @since 1.0.0
     */
    private array $media = [];

    /**
     * Accounts who received this task element.
     *
     * @var AccountRelation[]
     * @since 1.0.0
     */
    protected array $accRelation = [];

    /**
     * Groups who received this task element.
     *
     * @var GroupRelation[]
     * @since 1.0.0
     */
    protected array $grpRelation = [];

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->due = new \DateTime('now');
        $this->due->modify('+1 day');
        $this->createdAt = new \DateTime('now');
        $this->createdBy = new NullAccount();
    }

    /**
     * Get id
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
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @return Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy() : Account
    {
        return $this->createdBy;
    }

    /**
     * Set created by
     *
     * @param Account $creator Creator
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreatedBy(Account $creator) : void
    {
        $this->createdBy = $creator;
    }

    /**
     * Get all media
     *
     * @return Media[]
     *
     * @since 1.0.0
     */
    public function getMedia() : array
    {
        return $this->media;
    }

    /**
     * Add media
     *
     * @param Media $media Media to add
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addMedia(Media $media) : void
    {
        $this->media[] = $media;
    }

    /**
     * Get description
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set description
     *
     * @param string $description Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescription(string $description) : void
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
     * Set description
     *
     * @param string $description Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescriptionRaw(string $description) : void
    {
        $this->descriptionRaw = $description;
    }

    /**
     * Get due date
     *
     * @return null|\DateTime
     *
     * @since 1.0.0
     */
    public function getDue() : ?\DateTime
    {
        return $this->due;
    }

    /**
     * Set due date
     *
     * @param null|\DateTime $due Due date
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDue(?\DateTime $due) : void
    {
        $this->due = $due;
    }

    /**
     * Get priority
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getPriority() : int
    {
        return $this->priority;
    }

    /**
     * Set priority
     *
     * @param int $priority Task priority
     *
     * @return void
     *
     * @throws InvalidEnumValue
     *
     * @since 1.0.0
     */
    public function setPriority(int $priority) : void
    {
        if (!TaskPriority::isValidValue($priority)) {
            throw new InvalidEnumValue((string) $priority);
        }

        $this->priority = $priority;
    }

    /**
     * Get to
     *
     * @return RelationAbstract[]
     *
     * @since 1.0.0
     */
    public function getTo() : array
    {
        $to = [];

        foreach ($this->accRelation as $acc) {
            if ($acc->getDuty() === DutyType::TO) {
                $to[] = $acc;
            }
        }

        foreach ($this->grpRelation as $grp) {
            if ($grp->getDuty() === DutyType::TO) {
                $to[] = $grp;
            }
        }

        return $to;
    }

    /**
     * Check if user is in to
     *
     * @param int $id User id
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function isToAccount(int $id) : bool
    {
        foreach ($this->accRelation as $acc) {
            if (($acc->getDuty() === DutyType::TO
                    && ($acc->getRelation() instanceof Account) && $acc->getRelation()->getId() === $id)
                || ($acc->getDuty() === DutyType::TO
                    && $acc->getRelation() === $id)
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if group is in to
     *
     * @param int $id Group id
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function isToGroup(int $id) : bool
    {
        foreach ($this->grpRelation as $grp) {
            if (($grp->getDuty() === DutyType::TO
                    && ($grp->getRelation() instanceof Group) && $grp->getRelation()->getId() === $id)
                || ($grp->getDuty() === DutyType::TO
                    && $grp->getRelation() === $id)
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if user is in cc
     *
     * @param int $id User id
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function isCCAccount(int $id) : bool
    {
        foreach ($this->accRelation as $acc) {
            if (($acc->getDuty() === DutyType::CC
                    && ($acc->getRelation() instanceof Account) && $acc->getRelation()->getId() === $id)
                || ($acc->getDuty() === DutyType::CC
                    && $acc->getRelation() === $id)
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Check if group is in cc
     *
     * @param int $id Group id
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function isCCGroup(int $id) : bool
    {
        foreach ($this->grpRelation as $grp) {
            if (($grp->getDuty() === DutyType::CC
                    && ($grp->getRelation() instanceof Group) && $grp->getRelation()->getId() === $id)
                || ($grp->getDuty() === DutyType::CC
                    && $grp->getRelation() === $id)
            ) {
                return true;
            }
        }

        return false;
    }

    /**
     * Add to
     *
     * @param Group|Account $to To
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addTo($to) : void
    {
        if ($to instanceof Group) {
            $this->addGroupTo($to);
        } elseif (($to instanceof Account)) {
            $this->addAccountTo($to);
        }
    }

    /**
     * Add group as to
     *
     * @param Group $group Group
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addGroupTo(Group $group) : void
    {
        $groupId = $group->getId();

        foreach ($this->grpRelation as $grp) {
            $grpId = !\is_int($grp->getRelation()) ? $grp->getRelation()->getId() : $grp->getRelation();

            if ($grpId === $groupId && $grp->getDuty() === DutyType::TO) {
                return;
            }
        }

        $this->grpRelation[] = new GroupRelation($group, DutyType::TO);
    }

    /**
     * Add account as to
     *
     * @param Account $account Account
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addAccountTo(Account $account) : void
    {
        $accountId = $account->getId();

        foreach ($this->accRelation as $acc) {
            $accId = !\is_int($acc->getRelation()) ? $acc->getRelation()->getId() : $acc->getRelation();

            if ($accId === $accountId && $acc->getDuty() === DutyType::TO) {
                return;
            }
        }

        $this->accRelation[] = new AccountRelation($account, DutyType::TO);
    }

    /**
     * Get cc
     *
     * @return RelationAbstract[]
     *
     * @since 1.0.0
     */
    public function getCC() : array
    {
        $cc = [];

        foreach ($this->accRelation as $acc) {
            if ($acc->getDuty() === DutyType::CC) {
                $cc[] = $acc;
            }
        }

        foreach ($this->grpRelation as $grp) {
            if ($grp->getDuty() === DutyType::CC) {
                $cc[] = $grp;
            }
        }

        return $cc;
    }

    /**
     * Add cc
     *
     * @param Group|Account $cc CC
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addCC($cc) : void
    {
        if ($cc instanceof Group) {
            $this->addGroupCC($cc);
        } elseif (($cc instanceof Account)) {
            $this->addAccountCC($cc);
        }
    }

    /**
     * Add group as cc
     *
     * @param Group $group Group
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addGroupCC(Group $group) : void
    {
        $groupId = $group->getId();

        foreach ($this->grpRelation as $grp) {
            $grpId = !\is_int($grp->getRelation()) ? $grp->getRelation()->getId() : $grp->getRelation();

            if ($grpId === $groupId && $grp->getDuty() === DutyType::CC) {
                return;
            }
        }

        $this->grpRelation[] = new GroupRelation($group, DutyType::CC);
    }

    /**
     * Add account as cc
     *
     * @param Account $account Account
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addAccountCC(Account $account) : void
    {
        $accountId = $account->getId();

        foreach ($this->accRelation as $acc) {
            $accId = !\is_int($acc->getRelation()) ? $acc->getRelation()->getId() : $acc->getRelation();

            if ($accId === $accountId && $acc->getDuty() === DutyType::CC) {
                return;
            }
        }

        $this->accRelation[] = new AccountRelation($account, DutyType::CC);
    }

    /**
     * Get status
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
     * Set Status
     *
     * @param int $status Task element status
     *
     * @return void
     *
     * @throws InvalidEnumValue
     *
     * @since 1.0.0
     */
    public function setStatus(int $status) : void
    {
        if (!TaskStatus::isValidValue($status)) {
            throw new InvalidEnumValue((string) $status);
        }

        $this->status = $status;
    }

    /**
     * Get task id
     *
     * @return int
     *
     * @since 1.0.0
     */
    public function getTask() : int
    {
        return $this->task;
    }

    /**
     * Set task i
     *
     * @param int $task Task id
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTask(int $task) : void
    {
        $this->task = $task;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'          => $this->id,
            'task'        => $this->task,
            'createdBy'   => $this->createdBy,
            'createdAt'   => $this->createdAt,
            'description' => $this->description,
            'status'      => $this->status,
            'to'          => $this->getTo(),
            'cc'          => $this->getCC(),
            'due'         => $this->due,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }
}
