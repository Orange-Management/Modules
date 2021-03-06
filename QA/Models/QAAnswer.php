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

use Modules\Admin\Models\Account;
use Modules\Admin\Models\NullAccount;

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
     * @var int
     * @since 1.0.0
     */
    protected int $id = 0;

    private int $status = QAAnswerStatus::ACTIVE;

    /**
     * Answer.
     *
     * @var string
     * @since 1.0.0
     */
    private $answer = '';

    /**
     * Answer raw.
     *
     * @var string
     * @since 1.0.0
     */
    private $answerRaw = '';

    /**
     * Question
     *
     * @var QAQuestion
     * @since 1.0.0
     */
    private QAQuestion $question;

    /**
     * Is accepted answer.
     *
     * @var bool
     * @since 1.0.0
     */
    private bool $isAccepted = false;

    /**
     * Created by.
     *
     * @var Account
     * @since 1.0.0
     */
    private Account $createdBy;

    /**
     * Created at.
     *
     * @var \DateTime
     * @since 1.0.0
     */
    private \DateTime $createdAt;

    /**
     * Constructor.
     *
     * @since 1.0.0
     */
    public function __construct()
    {
        $this->createdAt = new \DateTime('now');
        $this->createdBy = new NullAccount();
        $this->question  = new NullQAQuestion();
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

    /**
     * Get the answer
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getAnswer() : string
    {
        return $this->answer;
    }

    /**
     * Set the answer
     *
     * @param string $answer Answer
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setAnswer(string $answer) : void
    {
        $this->answer = $answer;
    }

    /**
     * Get the question
     *
     * @return QAQuestion
     *
     * @since 1.0.0
     */
    public function getQuestion() : QAQuestion
    {
        return $this->question;
    }

    /**
     * Set the question
     *
     * @param QAQuestion $question Question
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setQuestion(QAQuestion $question) : void
    {
        $this->question = $question;
    }

    /**
     * Get the status
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
     * Set the status
     *
     * @param int $status Status
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
     * Set the answer as accepted
     *
     * @param bool $accepted Accepted
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setAccepted(bool $accepted) : void
    {
        $this->isAccepted = $accepted;
    }

    /**
     * Is the answer accepted
     *
     * @return bool
     *
     * @since 1.0.0
     */
    public function isAccepted() : bool
    {
        return $this->isAccepted;
    }

    /**
     * Get created by
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
     * Set created by
     *
     * @param Account $account Creator
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setCreatedBy(Account $account) : void
    {
        $this->createdBy = $account;
    }

    /**
     * Get created at
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
