<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\QA\Models
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\QA\Models;

/**
 * Answer class.
 *
 * @package Modules\QA\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class QAAnswer implements \JsonSerializable
{
    /**
     * ID.
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $id = 0;

    private int $status = QAAnswerStatus::ACTIVE;

    private $answer = '';

    private $question = 0;

    private $isAccepted = false;

    private $createdBy = 0;

    private $createdAt = null;

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
     * Get id.
     *
     * @return int Model id
     *
     * @since 1.0.0
     */
    public function getId() : int
    {
        return $this->id;
    }

    public function getAnswer() : string
    {
        return $this->answer;
    }

    public function setAnswer(string $answer) : void
    {
        $this->answer = $answer;
    }

    public function getQuestion() : int
    {
        return $this->question;
    }

    public function setQuestion(int $question) : void
    {
        $this->question = $question;
    }

    public function getStatus() : int
    {
        return $this->status;
    }

    public function setStatus(int $status) : void
    {
        $this->status = $status;
    }

    public function setAccepted(bool $accepted) : void
    {
        $this->isAccepted = $accepted;
    }

    public function isAccepted() : bool
    {
        return $this->isAccepted;
    }

    /**
     * Get created by
     *
     * @return int|\phpOMS\Account\Account
     *
     * @since 1.0.0
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    public function setCreatedBy($id) : void
    {
        $this->createdBy = $id;
    }

    /**
     * Get created at date time
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
     * {@inheritdoc}
     */
    public function jsonSerialize() : array
    {
        return [];
    }
}
