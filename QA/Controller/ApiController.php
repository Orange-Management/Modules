<?php
/**
 * Orange Management
 *
 * PHP Version 7.4
 *
 * @package   Modules\QA
 * @copyright Dennis Eichhorn
 * @license   OMS License 1.0
 * @version   1.0.0
 * @link      https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\QA\Controller;

use Modules\QA\Models\QAQuestionMapper;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;
use phpOMS\Model\Message\FormValidation;
use Modules\QA\Models\QAQuestion;
use phpOMS\Utils\Parser\Markdown\Markdown;
use Modules\QA\Models\QAQuestionStatus;
use Modules\QA\Models\QAAnswer;
use Modules\QA\Models\QAAnswerStatus;
use Modules\QA\Models\QACategoryMapper;
use Modules\QA\Models\QACategory;

/**
 * Task class.
 *
 * @package Modules\QA
 * @license OMS License 1.0
 * @link    https://orange-management.org
 * @since   1.0.0
 *
 * @todo Orange-Management/Modules#70
 *  There is no voting implemented right now, this needs to be added (visually and model/database)
 *
 * @todo Orange-Management/Modules#78
 *  Edit functionality
 *  Currently nothing can be edited (change)
 */
final class ApiController extends Controller
{
    /**
     * Api method to create a question
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiQAQuestionCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateQAQuestionCreate($request))) {
            $response->set('qa_question_create', new FormValidation($val));

            return;
        }

        $question = $this->createQAQuestionFromRquest($request);
        QAQuestionMapper::create($question);
        $response->set('question', $question->jsonSerialize());
    }

    /**
     * Method to create question from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return QAQuestion Returns the created question from the request
     *
     * @since 1.0.0
     */
    public function createQAQuestionFromRquest(RequestAbstract $request) : QAQuestion
    {
        $mardkownParser = new Markdown();

        $question = new QAQuestion();
        $question->setName((string) $request->getData('title'));
        $question->setQuestion((string) $request->getData('plain'));
        $question->setLanguage((string) $request->getData('language'));
        $question->setCategory((int) $request->getData('category'));
        $question->setStatus((int) $request->getData('status'));
        $question->setBadges((array) $request->getData('badges'));

        return $question;
    }

    /**
     * Validate question create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateQAQuestionCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['plain'] = empty($request->getData('plain')))
            || ($val['language'] = empty($request->getData('language')))
            || ($val['category'] = empty($request->getData('category')))
            || ($val['badges'] = empty($request->getData('badges')))
            || ($val['status'] = (
                $request->getData('status') !== null
                && !QAQuestionStatus::isValidValue((int) $request->getData('status'))
            ))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create a answer
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiQAAnswerCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateQAAnswerCreate($request))) {
            $response->set('qa_answer_create', new FormValidation($val));

            return;
        }

        $answer = $this->createQAAnswerFromRquest($request);
        QAAnswerMapper::create($answer);
        $response->set('answer', $answer->jsonSerialize());
    }

    /**
     * Method to create answer from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return QAAnswer Returns the created answer from the request
     *
     * @since 1.0.0
     */
    public function createQAAnswerFromRquest(RequestAbstract $request) : QAAnswer
    {
        $mardkownParser = new Markdown();

        $answer = new QAAnswer();
        $answer->setName((string) $request->getData('title'));
        $answer->setAnswer((string) $request->getData('plain'));
        $answer->setQuestion((int) $request->getData('question'));
        $answer->setStatus((int) $request->getData('status'));

        return $answer;
    }

    /**
     * Validate answer create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateQAAnswerCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['plain'] = empty($request->getData('plain')))
            || ($val['question'] = empty($request->getData('question')))
            || ($val['status'] = (
                $request->getData('status') !== null
                && !QAAnswerStatus::isValidValue((int) $request->getData('status'))
            ))
        ) {
            return $val;
        }

        return [];
    }

    /**
     * Api method to create a category
     *
     * @param RequestAbstract  $request  Request
     * @param ResponseAbstract $response Response
     * @param mixed            $data     Generic data
     *
     * @return void
     *
     * @api
     *
     * @since 1.0.0
     */
    public function apiQACategoryCreate(RequestAbstract $request, ResponseAbstract $response, $data = null) : void
    {
        if (!empty($val = $this->validateQACategoryCreate($request))) {
            $response->set('qa_category_create', new FormValidation($val));

            return;
        }

        $category = $this->createQACategoryFromRquest($request);
        QACategoryMapper::create($category);
        $response->set('category', $category->jsonSerialize());
    }

    /**
     * Method to create category from request.
     *
     * @param RequestAbstract $request Request
     *
     * @return QACategory Returns the created category from the request
     *
     * @since 1.0.0
     */
    public function createQACategoryFromRquest(RequestAbstract $request) : QACategory
    {
        $mardkownParser = new Markdown();

        $category = new QACategory();
        $category->setName((string) $request->getData('title'));
        $category->setParent((int) $request->getData('parent'));

        return $category;
    }

    /**
     * Validate category create request
     *
     * @param RequestAbstract $request Request
     *
     * @return array<string, bool> Returns the validation array of the request
     *
     * @since 1.0.0
     */
    private function validateQACategoryCreate(RequestAbstract $request) : array
    {
        $val = [];
        if (($val['title'] = empty($request->getData('title')))
            || ($val['parent'] = empty($request->getData('parent')))
        ) {
            return $val;
        }

        return [];
    }
}
