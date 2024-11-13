<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MatchHistory;


class QuizController extends Controller
{
    // Start quiz based on mode and level
    public function startQuiz(Request $request)
    {
        $mode = $request->input('mode', 'campuran');
        $level = $request->input('level');
        $advancedMode = $request->input('advancedMode', null);

        $questionCount = $request->input('questionCount', 10);
        session(['mode' => $mode, 'advancedMode' => $advancedMode]);

        $num1Array = [];
        $num2Array = [];
        $correctAnswers = [];
        $operations = [];
        $computerAnswers = [];

        $isDecimalMode = str_contains($advancedMode, 'desimal');
        $isFractionMode = str_contains($advancedMode, 'perpecahan');

        for ($i = 0; $i < $questionCount; $i++) {
            if ($isDecimalMode) {
                $num1 = $this->generateRandomDecimal();
                $num2 = $this->generateRandomDecimal();
            } elseif ($isFractionMode) {
                $num1 = $this->generateRandomFraction();
                $num2 = $this->generateRandomFraction();
            } else {
                $num1 = $this->generateRandomNumber();
                $num2 = $this->generateRandomNumber();
            }

            $operation = $this->getOperationSymbol($mode, $advancedMode);
            $correctAnswer = $isFractionMode
                ? $this->calculateFractionAnswer($num1, $num2, $operation)
                : ($isDecimalMode ? round($this->calculateCorrectAnswer($num1, $num2, $operation), 3) : $this->calculateCorrectAnswer($num1, $num2, $operation));

            $num1Array[] = $num1;
            $num2Array[] = $num2;
            $operations[] = $operation;
            $correctAnswers[] = $correctAnswer;
            $computerAnswers[] = is_numeric($correctAnswer) ? rand($correctAnswer - 10, $correctAnswer + 10) : null;
        }

        session([
            'num1Array' => $num1Array,
            'num2Array' => $num2Array,
            'correctAnswers' => $correctAnswers,
            'computerAnswers' => $computerAnswers,
            'operations' => $operations,
        ]);

        return view('quiz', compact('num1Array', 'num2Array', 'mode', 'level', 'operations'));
    }

    // Fungsi untuk menghasilkan angka desimal acak dengan 1-4 digit dan 0-3 angka desimal
    // Fungsi untuk menghasilkan angka desimal acak dengan 1-4 digit dan 0-3 angka di belakang koma
    private function generateRandomDecimal()
    {
        // Tentukan jumlah digit sebelum koma dengan peluang yang sama untuk 1, 2, atau 3 digit
        $digitChoice = rand(1, 3);

        switch ($digitChoice) {
            case 1:
                $wholePart = rand(1, 9);    // 1 digit sebelum koma
                break;
            case 2:
                $wholePart = rand(10, 99);  // 2 digit sebelum koma
                break;
            case 3:
                $wholePart = rand(100, 999); // 3 digit sebelum koma
                break;
        }

        // Tentukan jumlah digit di belakang koma dengan peluang yang sama untuk 0, 1, 2, atau 3 digit
        $decimalDigitChoice = rand(0, 3);

        switch ($decimalDigitChoice) {
            case 0:
                $decimalValue = $wholePart;  // Tidak ada digit desimal
                break;
            case 1:
                $decimalValue = $wholePart + rand(1, 9) / 10; // 1 digit di belakang koma
                break;
            case 2:
                $decimalValue = $wholePart + rand(10, 99) / 100; // 2 digit di belakang koma
                break;
            case 3:
                $decimalValue = $wholePart + rand(100, 999) / 1000; // 3 digit di belakang koma
                break;
        }

        // Hasilkan angka desimal dengan maksimal 3 angka di belakang koma
        return round($decimalValue, 3);
    }




    private function generateRandomFraction()
    {
        return [
            'numerator' => rand(1, 9),
            'denominator' => rand(1, 9),
        ];
    }
    private function calculateFractionAnswer($num1, $num2, $operation)
    {
        $numerator1 = $num1['numerator'];
        $denominator1 = $num1['denominator'];
        $numerator2 = $num2['numerator'];
        $denominator2 = $num2['denominator'];

        switch ($operation) {
            case '+':
                $numerator = ($numerator1 * $denominator2) + ($numerator2 * $denominator1);
                $denominator = $denominator1 * $denominator2;
                break;
            case '-':
                $numerator = ($numerator1 * $denominator2) - ($numerator2 * $denominator1);
                $denominator = $denominator1 * $denominator2;
                break;
            case 'x':
                $numerator = $numerator1 * $numerator2;
                $denominator = $denominator1 * $denominator2;
                break;
            case ':':
                $numerator = $numerator1 * $denominator2;
                $denominator = $denominator1 * $numerator2;
                break;
            default:
                throw new \Exception("Invalid operation for fractions: $operation");
        }

        $gcd = $this->getGCD($numerator, $denominator);
        return [
            'numerator' => $numerator,
            'denominator' => $denominator,
            'simplified' => [
                'numerator' => $numerator / $gcd,
                'denominator' => $denominator / $gcd,
            ],
        ];
    }

    private function getOperationSymbol($mode, $advancedMode = null)
    {
        if ($advancedMode) {
            return match($advancedMode) {
                'pertambahan_desimal', 'pertambahan_perpecahan' => '+',
                'pengurangan_desimal', 'pengurangan_perpecahan' => '-',
                'perkalian_desimal', 'perkalian_perpecahan' => '*',
                'pembagian_desimal', 'pembagian_perpecahan' => ':',
                default => throw new \Exception("Advanced mode tidak valid: $advancedMode"),
            };
        }

        return match($mode) {
            'pertambahan' => '+',
            'pengurangan' => '-',
            'perkalian' => 'x',
            'pembagian' => ':',
            default => '+',
        };
    }
    private function isCorrectFractionAnswer($userAnswer, $correctAnswer)
    {
        // Hapus spasi dan ganti koma dengan titik jika ada
        $userAnswer = str_replace([' ', ','], ['', '.'], $userAnswer);

        // Cek apakah jawaban pengguna dalam bentuk desimal
        if (is_numeric($userAnswer)) {
            // Hitung bentuk desimal dari jawaban yang benar
            $decimalAnswer = $correctAnswer['numerator'] / $correctAnswer['denominator'];
            $simplifiedDecimalAnswer = $correctAnswer['simplified']['numerator'] / $correctAnswer['simplified']['denominator'];

            // Periksa apakah jawaban pengguna mendekati desimal yang benar (dengan toleransi kecil)
            if (abs((float)$userAnswer - $decimalAnswer) < 0.001 || abs((float)$userAnswer - $simplifiedDecimalAnswer) < 0.001) {
                return true;
            }
        }

        // Cek apakah jawaban pengguna dalam bentuk pecahan (misalnya "2/3")
        $userParts = explode('/', $userAnswer);
        if (count($userParts) === 1) {
            $userNumerator = $userParts[0];
            $userDenominator = 1;
        } elseif (count($userParts) === 2) {
            [$userNumerator, $userDenominator] = $userParts;
        } else {
            return false; // Format tidak valid
        }

        // Cek jawaban dalam bentuk pecahan, baik dalam bentuk disederhanakan maupun tidak
        if (
            ($userNumerator == $correctAnswer['numerator'] && $userDenominator == $correctAnswer['denominator']) ||
            (isset($correctAnswer['simplified']) &&
                $userNumerator == $correctAnswer['simplified']['numerator'] &&
                $userDenominator == $correctAnswer['simplified']['denominator'])
        ) {
            return true;
        }

        return false;
    }







// Generate number with a specific digit count
private function generateFixedDigitNumber($digitCount)
{
    $min = pow(10, $digitCount - 1);
    $max = pow(10, $digitCount) - 1;
    return rand($min, $max);
}

    // Get the digit range for the selected level
    private function getDigitRangeForLevel($level)
    {
        switch ($level) {
            case 'mudah':
                return [1, 2];  // Easy: 1-2 digits
            case 'medium':
                return [2, 3];  // Intermediate: 3-4 digits
            case 'sulit':
                return [4, 5];  // Hard: 5-7 digits
            default:
                return [1, 2];  // Default to easy if level is unknown
        }
    }

    // Generate a random number based on the digit range
    private function generateRandomNumber($digitRange)
    {
        $min = pow(10, $digitRange[0] - 1);  // Minimum number (e.g., 1 for 1-digit, 100 for 3-digits)
        $max = pow(10, $digitRange[1]) - 1;  // Maximum number (e.g., 99 for 2-digit, 9999 for 4-digit)

        return rand($min, $max);  // Generate random number between min and max
    }

    // Generate the question based on the mode (pertambahan, pengurangan, etc.)
    private function generateQuestionByMode($num1, $num2, $mode)
    {
        if ($mode === 'campuran') {
            $randomOperation = $this->getRandomOperation(); // Get a random operation
        } else {
            $randomOperation = $mode; // Use the provided mode
        }

        // Generate the question based on the operation
        switch ($randomOperation) {
            case 'pertambahan':
                $question = "$num1 + $num2 = ?";
                break;
            case 'pengurangan':
                $question = "$num1 - $num2 = ?";
                break;
            case 'perkalian':
                $question = "$num1 * $num2 = ?";
                break;
            case 'pembagian':
                $question = "$num1 ÷ $num2 = ?";
                break;
            default:
                // Jika tidak ada mode yang dipilih, gunakan mode campuran sebagai default
                $randomOperation = $this->getRandomOperation();  // Pilih operasi acak dari campuran
                switch ($randomOperation) {
                    case 'pertambahan':
                        $question = "$num1 + $num2 = ?";
                        break;
                    case 'pengurangan':
                        $question = "$num1 - $num2 = ?";
                        break;
                    case 'perkalian':
                        $question = "$num1 * $num2 = ?";
                        break;
                    case 'pembagian':
                        $question = "$num1 ÷ $num2 = ?";
                        break;
                }
        }

        // Return both the question and the selected operation
        return ['question' => $question, 'operation' => $randomOperation];
    }

    // Get a random operation (pertambahan, pengurangan, etc.)
    private function getRandomOperation()
    {
        $operations = ['pertambahan', 'pengurangan', 'perkalian', 'pembagian'];
        return $operations[array_rand($operations)];
    }

    // Calculate the correct answer based on the mode
    private function calculateCorrectAnswer($num1, $num2, $operation)
    {
        if (is_array($num1) && is_array($num2)) {
            return $this->calculateFractionAnswer($num1, $num2, $operation);
        }

        // Handle regular integer/decimal operations if not fractions
        switch ($operation) {
            case '+':
                return $num1 + $num2;
            case '-':
                return $num1 - $num2;
            case 'x':
                return $num1 * $num2;
            case ':':
                return $num2 != 0 ? round($num1 / $num2, 2) : 0;
            default:
                throw new \Exception("Invalid operation: $operation");
        }
    }

    // Helper function to find the greatest common divisor (GCD) for fraction simplification
    private function getGCD($a, $b)
    {
        return ($b == 0) ? abs($a) : $this->getGCD($b, $a % $b);
    }

    public function getMatchHistory()
    {
        $matchHistories = MatchHistory::all();
        return response()->json($matchHistories);
    }
    
    

    // Handle quiz submission and calculate results
    public function submitQuiz(Request $request)
    {
        $answers = $request->input('answers');
        $startTime = $request->input('start_time');
        $endTime = round(microtime(true) * 1000);
        $timeTaken = ($endTime - $startTime) / 1000;

        // Retrieve data from session
        $num1Array = session('num1Array');
        $num2Array = session('num2Array');
        $operations = session('operations');
        $correctAnswers = session('correctAnswers');

        $score = 0;
        $results = [];

        foreach ($correctAnswers as $index => $correctAnswer) {
            $userAnswer = $answers[$index];

            // Ganti koma dengan titik untuk mendukung format desimal yang berbeda
            $userAnswer = str_replace(',', '.', $userAnswer);

            $isFraction = is_array($num1Array[$index]) && is_array($num2Array[$index]); // Deteksi soal perpecahan

            if ($isFraction) {
                // Calculate the correct answer for the fraction question
                $fractionAnswer = $this->calculateFractionAnswer($num1Array[$index], $num2Array[$index], $operations[$index]);

                // Check if the user's answer is correct in either simplified or unsimplified form
                $isCorrect = $this->isCorrectFractionAnswer($userAnswer, $fractionAnswer);
            } else {
                // Regular integer/decimal check
                $isCorrect = ((float)$userAnswer == (float)$correctAnswer); // Cast to float for comparison
            }

            // Update score if correct
            if ($isCorrect) {
                $score++;
            }

            // Collect the question result data for display
            $results[] = [
                'num1' => $num1Array[$index],
                'operation' => $operations[$index],
                'num2' => $num2Array[$index],
                'user_answer' => $userAnswer,
                'correct_answer' => $isFraction ? "{$fractionAnswer['simplified']['numerator']}/{$fractionAnswer['simplified']['denominator']}" : $correctAnswer,
                'correct' => $isCorrect
            ];
        }

        $finalScore = round(($score / count($correctAnswers)) * 100);

        return view('quiz-result', [
            'score' => $finalScore,
            'timeTaken' => $timeTaken,
            'results' => $results,
            'totalQuestions' => count($correctAnswers)
        ]);
    }




}
