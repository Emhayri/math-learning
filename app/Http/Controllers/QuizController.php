<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    // Start quiz based on mode and level
    
    // Controller: QuizController.php

    public function startQuiz(Request $request)
    {
        $mode = $request->input('mode');
        $level = $request->input('level');

        // Simpan mode di session
    session(['mode' => $mode]);
    
        // Generate questions and store correct answers
        $questions = [];
        $correctAnswers = [];
        $computerAnswers = [];
    
        $digitRange = $this->getDigitRangeForLevel($level);
    
        for ($i = 0; $i < 10; $i++) {
            $num1 = $this->generateRandomNumber($digitRange);
            $num2 = $this->generateRandomNumber($digitRange);
    
            $question = $this->generateQuestionByMode($num1, $num2, $mode);
            $questions[] = $question;
    
            // Store the correct answer for each question
            $correctAnswers[] = $this->calculateCorrectAnswer($num1, $num2, $mode);
    
            // Computer answers by generating random answers close to the correct one
            $computerAnswers[] = rand($correctAnswers[$i] - 10, $correctAnswers[$i] + 10);
        }
    
        // Store questions and correct answers in session
        session([
            'questions' => $questions,
            'correctAnswers' => $correctAnswers,
            'computerAnswers' => $computerAnswers,
        ]);
    
        return view('quiz', compact('questions', 'mode', 'level'));
    }
    


    // Get the digit range for the selected level
    private function getDigitRangeForLevel($level)
    {
        switch ($level) {
            case 'mudah':
                return [1, 2];  // Easy: 1-2 digits
            case 'medium':
                return [4, 3];  // Intermediate: 3-4 digits
            case 'sulit':
                return [7, 5];  // Hard: 5-7 digits
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
        switch ($mode) {
            case 'pertambahan':
                return "$num1 + $num2 = ?";
            case 'pengurangan':
                return "$num1 - $num2 = ?";
            case 'perkalian':
                return "$num1 * $num2 = ?";
            case 'pembagian':
                return "$num1 ÷ $num2 = ?";
            default:
                return "$num1 + $num2 = ?";  // Default to addition
        }
    }

    private function getRandomOperation()
{
    // Daftar operasi yang mungkin
    $operations = ['pertambahan', 'pengurangan', 'perkalian', 'pembagian'];

    // Pilih satu operasi secara acak
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
                return $num1 + $num2;  // Default to addition
        }
    }

    // Handle quiz submission and calculate results
    public function submitQuiz(Request $request)
{
    $answers = $request->input('answers');
    $startTime = $request->input('start_time');
    $endTime = round(microtime(true) * 1000);
    $timeTaken = ($endTime - $startTime) / 1000;

    // Ambil mode dari session
    $mode = session('mode'); // Asumsikan Anda sudah menyimpan 'mode' di session saat memulai kuis
    $questions = session('questions');
    $correctAnswers = session('correctAnswers');

    $score = 0;
    $computerScore = 0;
    $results = [];

    // Jika mode adalah "play_with_computer", ambil jawaban komputer
    if ($mode === 'play_with_computer') {
        $computerAnswers = session('computerAnswers', []); // Pastikan array ini ada
    }

    foreach ($questions as $index => $question) {
        $userAnswer = $answers[$index];
        $correctAnswer = $correctAnswers[$index];

        // Cek apakah jawaban pengguna benar
        $isCorrect = ($userAnswer == $correctAnswer);
        if ($isCorrect) {
            $score++;
        }

        // Jika mode adalah "play_with_computer", olah juga jawaban komputer
        if ($mode === 'play_with_computer') {
            $computerAnswer = $computerAnswers[$index] ?? null;  // Ambil jawaban komputer jika ada
            $isComputerCorrect = ($computerAnswer == $correctAnswer);

            if ($computerAnswer !== null && $isComputerCorrect) {
                $computerScore++;
            }

            $results[] = [
                'question' => $question,
                'user_answer' => $userAnswer,
                'correct_answer' => $correctAnswer,
                'computer_answer' => $computerAnswer,
                'correct' => $isCorrect
            ];
        } else {
            // Hanya untuk mode non-komputer (tanpa jawaban komputer)
            $results[] = [
                'question' => $question,
                'user_answer' => $userAnswer,
                'correct_answer' => $correctAnswer,
                'correct' => $isCorrect
            ];
        }
    }

    $finalScore = round(($score / count($questions)) * 100);

    // Hitung skor komputer hanya jika mode "play_with_computer"
    if ($mode === 'play_with_computer') {
        $computerFinalScore = round(($computerScore / count($questions)) * 100);
    } else {
        $computerFinalScore = null; // Tidak relevan jika bukan mode komputer
    }

    // Kirim variabel mode ke view bersama dengan variabel lain
    return view('quiz-result', [
        'score' => $finalScore,
        'timeTaken' => $timeTaken,
        'results' => $results,
        'computerScore' => $computerFinalScore, // Akan null jika bukan mode komputer
        'totalQuestions' => count($questions),
        'mode' => $mode // Kirim mode ke tampilan hasil
    ]);
}

}

