<?php

namespace App\Http\Controllers\Score;

use App\Http\Controllers\Controller;
use App\Models\Score;
use App\Services\ScoreService;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    protected $scoreService;

    public function __construct(ScoreService $scoreService)
    {
        $this->scoreService = $scoreService;
    }

    public function index() {
        $response = $this->scoreService->getAllScore();

        if ($response['code'] == 200) {
            $data['scores'] = $response['data'];
            return view('scores.index', $data);
        }

        return redirect()->back()->with('error', $response['message']);        
    }

    public function create() {
        return view('scores.form');
    }

    public function store(Request $request) {
        $response = $this->scoreService->store($request->all());

        if ($response['code'] == 200) {
            return redirect()->route('scores.index')->with('success', 'Score added successfully!');
        }

        return redirect()->back()->with('error', $response['message']);        
    }

    public function edit($score_id) {
        $response = $this->scoreService->getScoreByKey('id', $score_id);

        if ($response['code'] == 200) {
            $data['score'] = $response['data'];
            return view('scores.form', $data);
        }

        return redirect()->back()->with('error', $response['message']);
    }

    public function update(Request $request, $score_id) {
        $response = $this->scoreService->update($request->all(), $score_id);

        if ($response['code'] == 200) {
            return redirect()->route('scores.index')->with('success', 'Score updated successfully!');
        }

        return redirect()->back()->with('error', $response['message']);
    }

    public function destroy($score_id) {
        $response = $this->scoreService->destroy($score_id);

        if ($response['code'] == 200) {
            return redirect(route('scores.index'))->with('success', $response['message']);
        }

        return redirect()->back()->with('error', $response['message']);
    }
}
