<?php

namespace App\Http\Controllers;

use App\Organization;
use App\OrganizationMembers;
use App\QuestionAnswers;
use App\Test;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function __construct()
    {

    }

    public function tests() {
        $user = Auth::user();
        View::share('user', $user);

        $tests = \App\Test::where('organization_id', $user->organization_id)->get();
        return view('admin.tests', [ 'tests' => $tests ]);
    }

    public function patchTest(Request $request, $id) {
        $test = \App\Test::find($id);
        $test->is_active = $request->get('is_active') === "on";
        $test->save();

        return redirect('admin/tests');
    }

    public function removeTest($id) {
        \App\Test::find($id)->delete();
        \App\TestsResults::where('test_id', $id)->delete();
        \App\TestQuestions::where('test_id', $id)->delete();
        \App\TestQuestions::where('test_id', $id)->answers->delete(); //TODO delete related answers here

        return redirect('admin/tests');
    }

    public function editTest($id) {
        View::share('user', Auth::user());

        $test = Test::find($id);
        return view('admin.testForm', [
            'test' => $test
        ]);
    }

    public function postEditedTest(Request $request, $id) {
        $test = \App\Test::find($id);
        $test->name = $request->get('testName');
        $test->description = $request->get('testDescription');

        if ($request->get('availableTime')) {
            $test->available_time = $request->get('availableTime');
        }

        $test->save();

        // delete removed test
        $questionsIds = $test->questions()->pluck('id')->toArray();
        $removedIds = array_diff($questionsIds, array_keys($request->get('questions')));
        foreach ($removedIds as $questionId) {
            \App\TestQuestions::find($questionId)->delete();
            QuestionAnswers::where('question_id', $questionId)->delete();
        }

        // existing questions modification
        foreach ($request->get('questions') as $question_id => $question) {
            $testQuestion = \App\TestQuestions::find($question_id);
            $testQuestion->question = $question;
            $testQuestion->correct_answer_id = $request->get('correct_answers')[$question_id];
            $testQuestion->save();
        }

        // existing answers modification
        foreach ($request->get('answers') as $answer_id => $answer) {
            $questionAnswer = \App\QuestionAnswers::find($answer_id);
            $questionAnswer->answer = $answer;
            $questionAnswer->save();
        }

        // new questions and answers creation
        $newQuestions = $request->get('newQuestions') ?: [];
        foreach ($newQuestions as $index => $question) {
            $testQuestion = new \App\TestQuestions();
            $testQuestion->question = $question;
            $testQuestion->test_id = $test->id;
            $testQuestion->type_id = 1; // TODO add another types Radio type
            $testQuestion->save();

            foreach ($request->get('newAnswers')[$index] as $key => $answer) {
                $questionAnswer = new \App\QuestionAnswers();
                $questionAnswer->answer = $answer;
                $questionAnswer->question_id = $testQuestion->id;
                $questionAnswer->save();

                if ($key === (int) $request->get('newCorrectAnswers')[$index]) {
                    $testQuestion->correct_answer_id = $questionAnswer->id;
                    $testQuestion->save();
                }
            }
        }

        return redirect('admin/tests');
    }

    public function newTest() {
        View::share('user', Auth::user());
        return view('admin.testForm', [ 'test' => null ]);
    }

    public function postNewTest(Request $request) {
        // test creation
        $newTest = new \App\Test();
        $newTest->name = $request->get('testName');
        $newTest->description = $request->get('testDescription');
        $newTest->is_active = false;
        $newTest->organization_id = $request->user()->organization_id;

        if ($request->get('availableTime')) {
            $newTest->available_time = $request->get('availableTime');
        }

        $newTest->save();

        $newQuestions = $request->get('newQuestions') ?: [];
        foreach ($newQuestions as $index => $question) {
            $testQuestion = new \App\TestQuestions();
            $testQuestion->question = $question;
            $testQuestion->test_id = $newTest->id;
            $testQuestion->type_id = 1; // TODO add another types Radio type
            $testQuestion->save();

            foreach ($request->get('newAnswers')[$index] as $key => $answer) {
                $questionAnswer = new \App\QuestionAnswers();
                $questionAnswer->answer = $answer;
                $questionAnswer->question_id = $testQuestion->id;
                $questionAnswer->save();

                if ($key === (int) $request->get('newCorrectAnswers')[$index]) {
                    $testQuestion->correct_answer_id = $questionAnswer->id;
                    $testQuestion->save();
                }
            }
        }

        return redirect('admin/tests');
    }

    public function results() {
        View::share('user', Auth::user());

        $results = \App\TestsResults::whereHas('test', function ($query) {
            $query->where('organization_id', Auth::user()->organization_id);
        })->get();

        return view('admin.results', [
            'results' => $results
        ]);
    }

    public function showMembers() {
        $user = Auth::user();
        View::share('user', $user);

        $organization = Organization::find($user->organization_id);
        $members = OrganizationMembers::where('organization_id', $organization->id)->get();

        return view('admin.members', [
            'random_code' => Str::random(20),
            'organization' => $organization,
            'members' => $members
        ]);
    }

    public function addMember(Request $request) {
        $user = Auth::user();
        View::share('user', $user);

        if ($request->get('personal_code')) {
            $member = new OrganizationMembers();
            $member->personal_code = $request->get('personal_code');
            $member->organization_id = $user->organization_id;
            $member->save();
        }

        return redirect('admin/members');
    }

    public function editOrganization(Request $request) {
        $organization = Organization::find($request->user()->organization_id);

        if ($request->get('organizationName')) {
            $organization->name = $request->get('organizationName');
        }

        if ($request->get('organizationAddress')) {
            $organization->address = $request->get('organizationAddress');
        }

        $organization->save();

        return redirect('admin/members');
    }
}
