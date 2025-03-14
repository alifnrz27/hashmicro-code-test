<?php

namespace App\Http\Controllers\CharacterMatch;

use App\Http\Controllers\Controller;
use App\Services\CharacterMatchService;
use App\Validation\CharacterMatchValidation;
use Illuminate\Http\Request;

class CharacterMatchController extends Controller
{

    protected $characterMatchService;

    public function __construct(CharacterMatchService $characterMatchService)
    {
        $this->characterMatchService = $characterMatchService;
    }

    public function index(){
        return view('character-match.index');
    }

    public function check(Request $request){
        $validationResponse = CharacterMatchValidation::validate($request);

        if ($validationResponse['code'] !== 200) {
            return redirect()->back()->withErrors($validationResponse['data']);
        }
        
        $response = $this->characterMatchService->calculateMatch($request->input1, $request->input2);

        if ($response['code'] == 200) {
            return redirect()->back()->with('success', $response['message'] . ' with percentage: ' . $response['data']['match_percentage'] . '%');
        }

        return redirect()->back()->with('error', $response['message']);
    }
}
