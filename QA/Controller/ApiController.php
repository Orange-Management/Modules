<?php
/**
 * Orange Management
 *
 * PHP Version 7.2
 *
 * @package    Modules\QA
 * @copyright  Dennis Eichhorn
 * @license    OMS License 1.0
 * @version    1.0.0
 * @link       https://orange-management.org
 */
declare(strict_types=1);

namespace Modules\QA\Controller;

use Modules\QA\Models\QAQuestionMapper;
use phpOMS\Message\RequestAbstract;
use phpOMS\Message\ResponseAbstract;

/**
 * Task class.
 *
 * @package    Modules\QA
 * @license    OMS License 1.0
 * @link       https://orange-management.org
 * @since      1.0.0
 */
final class ApiController extends Controller
{
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

    public function createQAAnswerFromRquest(RequestAbstract $request) : QAAnswer
    {
        $mardkownParser = new Markdown();

        $answer = new QAAnswer();
        $answer->setName((string) $request->getData('title'));
        $answer->setQuestion((string) $request->getData('plain'));
        $answer->setQuestion((int) $request->getData('question'));
        $answer->setStatus((int) $request->getData('status'));

        return $answer;
    }

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

    public function createQACategoryFromRquest(RequestAbstract $request) : QACategory
    {
        $mardkownParser = new Markdown();

        $category = new QACategory();
        $category->setName((string) $request->getData('title'));
        $category->setParent((int) $request->getData('parent'));

        return $category;
    }

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
