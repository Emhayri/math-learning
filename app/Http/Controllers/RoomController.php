<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    // Start quiz based on mode and level
    public function startQuiz(Request $request)
    {
        $mode = $request->input('mode', 'campuran');
        $level = $request->input('level');
        $number = $request->input('number', null);
        $digitBeforeSymbol = $request->input('digitBeforeSymbol', null);
        $digitAfterSymbol = $request->input('digitAfterSymbol', null);

        // Log untuk memeriksa nilai number
        logger("Mode: $mode, Level: $level, Number: $number");

        // Simpan mode di session
        session(['mode' => $mode, 'number' => $number]);

        // Inisialisasi array untuk soal dan jawaban
        $num1Array = [];
        $num2Array = [];
        $correctAnswers = [];
        $operations = [];
        $computerAnswers = [];

        // Dapatkan rentang digit berdasarkan level
        $digitRange = $this->getDigitRangeForLevel($level);

        // Buat 10 soal
        for ($i = 0; $i < 10; $i++) {
            if ($mode === 'perkalian' && $number !== null) {
                $num1 = $number;
                $num2 = $this->generateRandomNumber($digitRange);
                $operation = '×';
                $correctAnswer = $num1 * $num2;
            } elseif ($mode !== 'perkalian' && $digitBeforeSymbol && $digitAfterSymbol) {
                // Mode bukan perkalian dengan digitBeforeSymbol dan digitAfterSymbol
                [$num1, $num2] = $this->generateFixedDigitNumber($digitBeforeSymbol, $digitAfterSymbol);

                // Tentukan operasi berdasarkan mode
                switch ($mode) {
                    case 'pertambahan':
                        $operation = '+';
                        $correctAnswer = $num1 + $num2;
                        break;
                    case 'pengurangan':
                        $operation = '-';
                        $correctAnswer = $num1 - $num2;
                        break;
                    case 'perkalian':
                        $operation = '×';
                        $correctAnswer = $num1 * $num2;
                        break;
                    case 'pembagian':
                        $operation = ':';
                        $num2 = $num2 === 0 ? 1 : $num2; // Hindari pembagian dengan nol
                        $correctAnswer = $num1 / $num2;
                        break;
                    default:
                        // Untuk mode campuran, pilih operasi acak
                        $operationTypes = ['+', '-', '×', ':'];
                        $operation = $operationTypes[array_rand($operationTypes)];

                        // Hitung jawaban berdasarkan operasi yang dipilih
                        if ($operation === '+') {
                            $correctAnswer = $num1 + $num2;
                        } elseif ($operation === '-') {
                            $correctAnswer = $num1 - $num2;
                        } elseif ($operation === '×') {
                            $correctAnswer = $num1 * $num2;
                        } else { // Pembagian
                            $num2 = $num2 === 0 ? 1 : $num2;
                            $correctAnswer = $num1 / $num2;
                        }
                        break;
                }
            } else {
                // Jika bukan mode perkalian khusus, gunakan angka acak untuk keduanya
                $num1 = $this->generateRandomNumber($digitRange);
                $num2 = $this->generateRandomNumber($digitRange);

                // Tentukan operasi berdasarkan mode
                switch ($mode) {
                    case 'pertambahan':
                        $operation = '+';
                        $correctAnswer = $num1 + $num2;
                        break;
                    case 'pengurangan':
                        $operation = '-';
                        $correctAnswer = $num1 - $num2;
                        break;
                    case 'perkalian':
                        $operation = '×';
                        $correctAnswer = $num1 * $num2;
                        break;
                    case 'pembagian':
                        $operation = ':';
                        $num2 = $num2 === 0 ? 1 : $num2; // Hindari pembagian dengan nol
                        $correctAnswer = $num1 / $num2;
                        break;
                    default:
                        // Untuk mode campuran, pilih operasi acak
                        $operationTypes = ['+', '-', '×', ':'];
                        $operation = $operationTypes[array_rand($operationTypes)];

                        // Hitung jawaban berdasarkan operasi yang dipilih
                        if ($operation === '+') {
                            $correctAnswer = $num1 + $num2;
                        } elseif ($operation === '-') {
                            $correctAnswer = $num1 - $num2;
                        } elseif ($operation === '×') {
                            $correctAnswer = $num1 * $num2;
                        } else { // Pembagian
                            $num2 = $num2 === 0 ? 1 : $num2;
                            $correctAnswer = $num1 / $num2;
                        }
                        break;
                }
            }

            // Simpan nilai soal dan jawaban
            $num1Array[] = $num1;
            $num2Array[] = $num2;
            $operations[] = $operation;
            $correctAnswers[] = $correctAnswer;

            // Buat jawaban komputer yang mendekati jawaban yang benar
            $computerAnswers[] = rand($correctAnswer - 10, $correctAnswer + 10);
        }

        // Simpan soal dan jawaban di session
        session([
            'num1Array' => $num1Array,
            'num2Array' => $num2Array,
            'correctAnswers' => $correctAnswers,
            'computerAnswers' => $computerAnswers,
            'operations' => $operations,
        ]);

        return view('quiz', compact('num1Array', 'num2Array', 'mode', 'level', 'operations'));
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
    private function calculateCorrectAnswer($num1, $num2, $mode)
    {
        switch ($mode) {
            case 'pertambahan':
                return $num1 + $num2;
            case 'pengurangan':
                return $num1 - $num2;
            case 'perkalian':
                return $num1 * $num2;
            case 'pembagian':
                return round($num1 / $num2, 2); // Rounded to 2 decimal places
            default:
                return $num1 + $num2;  // Default to addition if mode is unrecognized
        }
    }

    // Handle quiz submission and calculate results
    public function submitQuiz(Request $request)
    {
        $answers = $request->input('answers');
        $startTime = $request->input('start_time');
        $endTime = round(microtime(true) * 1000);
        $timeTaken = ($endTime - $startTime) / 1000;

        // Retrieve data from session
        $mode = session('mode');
        $num1Array = session('num1Array');
        $num2Array = session('num2Array');
        $operations = session('operations');
        $correctAnswers = session('correctAnswers');

        $score = 0;
        $computerScore = 0;
        $results = [];

        if ($mode === 'computer') {
            $computerAnswers = session('computerAnswers', []);
        }

        foreach ($correctAnswers as $index => $correctAnswer) {
            $userAnswer = $answers[$index];
            $isCorrect = ($userAnswer == $correctAnswer);
            if ($isCorrect) {
                $score++;
            }

            if ($mode === 'computer') {
                $computerAnswer = $computerAnswers[$index] ?? 'N/A';
                $isComputerCorrect = ($computerAnswer == $correctAnswer);
                if ($isComputerCorrect) {
                    $computerScore++;
                }
            }

            // Store results with full question details
            $results[] = [
                'num1' => $num1Array[$index],
                'operation' => $operations[$index],
                'num2' => $num2Array[$index],
                'user_answer' => $userAnswer,
                'computer_answer' => $computerAnswer ?? 'N/A',
                'correct_answer' => $correctAnswer,
                'correct' => $isCorrect
            ];
        }

        $finalScore = round(($score / count($correctAnswers)) * 100);
        if ($mode === 'computer') {
            $computerFinalScore = round(($computerScore / count($correctAnswers)) * 100);
        } else {
            $computerFinalScore = null;
        }

        return view('quiz-result', [
            'score' => $finalScore,
            'timeTaken' => $timeTaken,
            'results' => $results,
            'computerScore' => $computerFinalScore,
            'totalQuestions' => count($correctAnswers),
            'mode' => $mode
        ]);
    }
}
