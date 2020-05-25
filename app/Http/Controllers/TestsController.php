<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class TestsController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        View::share('user', Auth::user());
    }

    public function results() {
        $user = Auth::user();
        View::share('user', $user);

       $results = \App\TestsResults::where('user_id', $user->id)->get();

        return view('pages.results', [
            'results' => $results,
        ]);
    }

    public function tests() {
        $user = Auth::user();
        View::share('user', $user);

       $tests = \App\Test::where('organization_id', $user->organization_id)->where('is_active', 1)->get();
        return view('pages.tests', [ 'tests' => $tests ]);
    }

    public function test($id) {
        View::share('user', Auth::user());

        $test = \App\Test::find($id);
        $questions = \App\TestQuestions::where('test_id', $id)->get();

        return view('pages.test', [
            'test' => $test,
            'questions' => $questions
        ]);
    }

    public function postTest(Request $request, $id) {
        View::share('user', Auth::user());

        $questions = \App\TestQuestions::where('test_id', $id)->get();
        $correctAnswersCount = 0;

        foreach ($questions as $question) {
            $answer = $request->get($question->id);
            if ((int) $answer === $question->correct_answer_id) {
                $correctAnswersCount++;
            }
        }

        $testResults = new \App\TestsResults();
        $testResults->spent_time = $request->get('spentTime');
        $testResults->correct = $correctAnswersCount;
        $testResults->mark = round($correctAnswersCount / count($questions)  * 10);
        $testResults->test_id = (int) $id;
        $testResults->user_id = $request->user()->id;
        $testResults->save();

        return view('pages.testComplete', [
            'totalCount' => count($questions),
            'correctCount' => $correctAnswersCount
        ]);
    }
}
