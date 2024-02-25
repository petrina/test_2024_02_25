<?php

namespace App\Http\Controllers;

use App\Http\Requests\Quiz\CreateQuizRequest;
use App\Http\Requests\Quiz\SetGradeQuizRequest;
use App\Http\Requests\Quiz\UpdateQuizRequest;
use App\Services\QuizService;
use Illuminate\Http\Request;

class QuizController extends BaseController
{
    public function __construct(private QuizService $quizService)
    {
    }

    public function index()
    {
        $this->jsonResponse($this->quizService->listQuizes());
    }

    public function show(int $id)
    {
        $this->jsonResponse($this->quizService->showQuiz($id));
    }

    public function store(CreateQuizRequest $request)
    {
        $this->jsonResponse(
            $this->quizService->createQuiz(
                $request->subject,
                $request->user_id,
                $request->quiz_date,
                $request->location
            ),
            201
        );
    }

    public function update(UpdateQuizRequest $request, int $id)
    {
        $this->jsonResponse($this->quizService->updateQuiz(
            $id,
            $request->subject,
            $request->user_id,
            $request->quiz_date,
            $request->location
        ));
    }

    public function destroy(int $id)
    {
        $this->quizService->deleteQuiz($id);
        response('', 204)
            ->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*')
            ->send();
    }

    public function setGrade(SetGradeQuizRequest $request, int $id)
    {
        $this->jsonResponse($this->quizService->setGrade($id, $request->grade));
    }
}
