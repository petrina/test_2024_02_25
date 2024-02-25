<?php

namespace App\Services;

use App\Exceptions\BadRequestException;
use App\Exceptions\ServerErrorException;
use App\Models\Quiz;
use App\Models\User;
use Mockery\Exception;

class QuizService extends BaseQuizService
{
    public function listQuizes()
    {
        return Quiz::all();
    }

    public function showQuiz(int $id)
    {
        return $this->getQuizByIdOrException($id);
    }

    public function createQuiz(string $subject, int $userId, ?string $quizDate = null, ?string $location = null)
    {
        $this->checkRole('admin');
        $this->checkManager($userId);

        try {
            $quiz = new Quiz();
            $quiz->subject = $subject;
            $quiz->user_id = $userId;
            $quiz->quiz_date = $quizDate;
            $quiz->location = $location;
            $quiz->save();
            return $quiz;
        } catch (\Exception $e) {
            throw new ServerErrorException($e->getMessage());
        }
    }

    public function updateQuiz(int $quizId, string $subject, int $userId, ?string $quizDate = null, ?string $location = null)
    {
        $quiz = $this->getQuizByIdOrException($quizId);

        $this->checkRole('admin');
        $this->checkManager($userId);

        try {
            $quiz->subject = $subject;
            $quiz->user_id = $userId;
            $quiz->quiz_date = $quizDate;
            $quiz->location = $location;
            $quiz->save();
            return $quiz;
        } catch(\Exception $e) {
            throw new ServerErrorException($e->getMessage());
        }
    }

    public function deleteQuiz(int $quizId)
    {
        $this->checkRole('admin');

        try {
            Quiz::destroy($quizId);
            return true;
        } catch (\Exception $e) {
            throw new ServerErrorException($e->getMessage());
        }
    }

    public function setGrade(int $quizId, int $grade)
    {
        $this->checkRole('manager');
        $quiz = $this->getQuizByIdOrException($quizId);
        try {
            $quiz->grade = $grade;
            $quiz->save();
            return $quiz;
        } catch (\Exception $e) {
            throw new ServerErrorException($e->getMessage());
        }
    }
}
