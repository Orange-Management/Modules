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
    private int $id = 0;

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
     * @var int
     * @since 1.0.0
     */
    private $createdBy = 0;

    /**
     * Report template.
     *
     * @var null|int|Media
     * @since 1.0.0
     */
    private $template = 0;

    /**
     * Report source.
     *
     * @var int|\Modules\Media\Models\Collection
     * @since 1.0.0
     */
    private $source = 0;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    /**
     * @return int
     *
     * @since 1.0.0
     */
    public function getStatus() : int
    {
        return $this->status;
    }

    /**
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
     * @return string
     *
     * @since 1.0.0
     */
    public function getTitle() : string
    {
        return $this->title;
    }

    /**
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
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescription() : string
    {
        return $this->description;
    }

    /**
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
     * @return string
     *
     * @since 1.0.0
     */
    public function getDescriptionRaw() : string
    {
        return $this->descriptionRaw;
    }

    /**
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
     * @return \DateTime
     *
     * @since 1.0.0
     */
    public function getCreatedAt() : \DateTime
    {
        return $this->createdAt ?? new \DateTime('now');
    }

    /**
     * @return int|\phpOMS\Account\Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * @param mixed $creator Created by
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreatedBy($creator) : void
    {
        $this->createdBy = $creator;
    }

    /**
     * @return mixed
     *
     * @since 1.0.0
     */
    public function getTemplate()
    {
        return $this->template;
    }

    /**
     * @param mixed $template Report template
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setTemplate($template) : void
    {
        $this->template = $template;
    }

    /**
     * @param \Modules\Media\Models\Collection|int $source Report source
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setSource($source) : void
    {
        $this->source = $source;
    }

    /**
     * @return \Modules\Media\Models\Collection|int
     *
     * @since 1.0.0
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * @return array
     *
     * @since 1.0.0
     */
    public function toArray() : array
    {
        return [
            'id'          => $this->id,
            'createdBy'   => $this->createdBy,
            'createdAt'   => $this->createdAt,
            'name'        => $this->title,
            'description' => $this->description,
            'status'      => $this->status,
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
