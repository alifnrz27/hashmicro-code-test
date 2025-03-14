<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use App\Models\Score;
use Exception;

class ScoreService{

    public function getAllScore(){
        try {
            $scores = Score::all();
            return ResponseHelper::response(200, 'Scores found.', $scores);
        } catch (Exception $e) {
            return ResponseHelper::response(500, 'Internal server error.', ['error' => $e->getMessage()]);
        }
    }

    public function getScoreByKey($key, $value){
        try {
            $score = Score::where($key, $value)->first();
            if (!$score) {
                return ResponseHelper::response(404, 'Score not found.');
            }
            return ResponseHelper::response(200, 'Score found.', $score);
        } catch (Exception $e) {
            return ResponseHelper::response(500, 'Internal server error.', ['error' => $e->getMessage()]);
        }
    }

    public function store(array $data){
        try {
            $score = Score::create([
                'student_name' => $data['student_name'],
                'subjects' => json_encode($data['subjects'])
            ]);
            return ResponseHelper::response(200, 'Score added successfully.', $score);
        } catch (Exception $e) {
            return ResponseHelper::response(500, 'Internal server error.', ['error' => $e->getMessage()]);
        }
    }

    public function update(array $data, $score_id){
        try {
            $score = Score::find($score_id);
            if (!$score) {
                return ResponseHelper::response(404, 'Score not found.');
            }
            $score->update([
                'student_name' => $data['student_name'],
                'subjects' => json_encode($data['subjects'])
            ]);
            return ResponseHelper::response(200, 'Score updated successfully.', $score);
        } catch (Exception $e) {
            return ResponseHelper::response(500, 'Internal server error.', ['error' => $e->getMessage()]);
        }
    }

    public function destroy($score_id)
    {
        try {
            $score = Score::find($score_id);
            if (!$score) {
                return ResponseHelper::response(404, 'Score not found.');
            }
            $score->delete();
            return ResponseHelper::response(200, 'Score deleted successfully.');
        } catch (Exception $e) {
            return ResponseHelper::response(500, 'Internal server error.', ['error' => $e->getMessage()]);
        }
    }
}