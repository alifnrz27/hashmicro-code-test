<?php

namespace App\Services;

use App\Helpers\ResponseHelper;
use Exception;

class CharacterMatchService
{
    public function calculateMatch($input1, $input2)
    {
        try {
            $input1 = strtoupper($input1);
            $input2 = strtoupper($input2);

            $input1Chars = str_split($input1);
            $totalChars = count($input1Chars);

            if ($totalChars === 0) {
                return ResponseHelper::response(200, 'Calculate successfully', ['match_percentage' => 0]);
            }

            $matchedChars = 0;
            $alreadyCheck = [];
            foreach ($input1Chars as $char) {
                if (in_array($char, $alreadyCheck)) {
                    continue;
                }else{
                    if (strpos($input2, $char) !== false) {
                        $matchedChars++;
                    }
                    $alreadyCheck[] = $char;
                }
                
            }

            $matchPercentage = round(($matchedChars / $totalChars) * 100, 2);

            return ResponseHelper::response(200, 'Calculate successfully', ['match_percentage' => $matchPercentage]);
        } catch (Exception $e) {
            return ResponseHelper::response(500, 'Internal server error.', ['error' => $e->getMessage()]);
        }
    }

}
