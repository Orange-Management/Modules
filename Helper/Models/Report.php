<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\Helper\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\Helper\Models;

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;
use Modules\Helper\Admin\Install\Media;
use Modules\Media\Models\Collection;
use Modules\Media\Models\NullCollection;

/**
 * Report model.
 *
 * @package Modules\Helper\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class Report implements \JsonSerializable
{
    /**
     * Report Id.
     *
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    /**
     * Report status.
     *
     * @var int
     * @since 1.0.0
     */
    private int $status = HelperStatus::INACTIVE;

    /**
     * Report title.
     *
     * @var string
     * @since 1.0.0
     */
    private string $title = '';

    /**
     * Report description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $description = '';

    /**
     * Report description.
     *
     * @var string
     * @since 1.0.0
     */
    private string $descriptionRaw = '';

    /**
     * Report created at.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    protected \DateTime $createdAt;

    /**
     * Report created by.
     *
     * @var Account
     * @since 1.0.0
     */
    private Account $createdBy;

    /**
     * Report template.
     *
     * @var Template
     * @since 1.0.0
     */
    private Template $template;

    /**
     * Report source.
     *
     * @var Collection
     * @since 1.0.0
     */
    private Collection $source;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdBy = new NullAccount();
        $this->createdAt = new \DateTime('now');
        $this->template  = new NullTemplate();
        $this->source    = new NullCollection();
    }

    /**
     * Get model id.
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
     * Get the activity status
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
     * Set the activity status
     *
     * @param int $status Report status
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setStatus(int $status) : void
    {
        $this->status = $status;
    }

    /**
     * Get title,
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
     * Set the title
     *
     * @param string $title Title
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTitle(string $title) : void
    {
        $this->title = $title;
    }

    /**
     * Get description
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
     * Set the description
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
     * Get raw description
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
     * Set raw description
     *
     * @param string $descriptionRaw Description
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setDescriptionRaw(string $descriptionRaw) : void
    {
        $this->descriptionRaw = $descriptionRaw;
    }

    /**
     * Get created datetime
     *
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt;
    }

    /**
     * Get creator
     *
     * @return Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy() : Account
    {
        return $this->createdBy;
    }

    /**
     * Set creator
     *
     * @param Account $creator Created by
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
     * Get template this report belongs to
     *
     * @return Template
     *
     * @since 1.0.0
     */
    public function getTemplate() : Template
    {
        return $this->template;
    }

    /**
     * Set template this report belongs to
     *
     * @param Template $template Report template
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTemplate(Template $template) : void
    {
        $this->template = $template;
    }

    /**
     * Set source media for the report
     *
     * @param Collection $source Report source
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setSource(Collection $source) : void
    {
        $this->source = $source;
    }

    /**
     * Get source media for the report
     *
     * @return Collection
     *
     * @since 1.0.0
     */
    public function getSource() : Collection
    {
        return $this->source;
    }

    /**
     * {@inheritdoc}
     */
    public function toArray() : array
    {
        return [
            'id'             => $this->id,
            'createdBy'      => $this->createdBy,
            'createdAt'      => $this->createdAt,
            'name'           => $this->title,
            'description'    => $this->description,
            'descriptionRaw' => $this->descriptionRaw,
            'status'         => $this->status,
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
