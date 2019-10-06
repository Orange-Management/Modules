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
 * Task class.
 *
 * @package Modules\QA\Models
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 */
class QAQuestion implements \JsonSerializable
{
    /**
     * ID.
     *
     * @var   int
     * @since 1.0.0
     */
    protected int $id = 0;
    /**
     * Name.
     *
     * @var   string
     * @since 1.0.0
     */
    private string $name = '';

    private int $status = QAQuestionStatus::ACTIVE;

    private $question = '';

    private $category = 0;

    private $language = '';

    private $createdBy = 0;

    private $createdAt = null;

    private $badges = [];

    private $answers = [];

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

    public function hasAccepted() : bool
    {
        foreach ($this->answers as $answer) {
            if ($answer->isAccepted()) {
                return true;
            }
        }

        return false;
    }

    public function getLanguage() : string
    {
        return $this->language;
    }

    public function setLanguage(string $language) : void
    {
        $this->language = $language;
    }

    public function isAnswered() : bool
    {
        foreach ($this->answers as $answer) {
            if ($answer->isAccepted()) {
                return true;
            }
        }

        return false;
    }

    /**
     * Get name
     *
     * @return string
     *
     * @since 1.0.0
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * Set name
     *
     * @param string $name Name
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function setName(string $name) : void
    {
        $this->name = $name;
    }

    public function getQuestion() : string
    {
        return $this->question;
    }

    public function setQuestion(string $question) : void
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

    public function getCategory()
    {
        return $this->category;
    }

    public function setCategory(int $category) : void
    {
        $this->category = $category;
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

    /**
     * Set created by
     *
     * @param mixed $id Created by
     *
     * @return void
     *
     * @since 1.0.0
     */
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
     * Get badges
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getBadges() : array
    {
        return $this->badges;
    }

    /**
     * Add badge to question
     *
     * @param int|QABadge $badge Badge
     */
    public function addBadge($badge) : void
    {
        $this->badges[] = $badge;
    }

    /**
     * Get answers
     *
     * @return array
     *
     * @since 1.0.0
     */
    public function getAnswers() : array
    {
        return $this->answers;
    }

    /**
     * Add answer to question
     *
     * @param int|QAAnswer $answer Answer to the question
     *
     * @return void
     *
     * @since 1.0.0
     */
    public function addAnswer($answer) : void
    {
        $this->answers[] = $answer;
    }

    /**
     * {@inheritdoc}
     */
    public function jsonSerialize() : array
    {
        return [];
    }
}
