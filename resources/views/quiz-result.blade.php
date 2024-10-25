<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
            color: #343a40;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        h1, h2 {
            text-align: center;
        }

        .results-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        .results-table th, .results-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
        }

        .results-table th {
            background-color: #007bff;
            color: white;
        }

        .correct {
            background-color: #d4edda;
            color: #155724;
        }

        .incorrect {
            background-color: #f8d7da;
            color: #721c24;
        }

        .score {
            font-size: 24px;
            margin-bottom: 20px;
            text-align: center;
        }

        .time-taken {
            font-size: 18px;
            margin-bottom: 20px;
            text-align: center;
        }

        .back-btn {
            display: block;
            margin: 20px auto;
            padding: 15px;
            background-color: #28a745;
            color: white;
            text-align: center;
            border-radius: 8px;
            text-decoration: none;
            font-size: 16px;
        }

        .back-btn:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Quiz Results</h1>
    
        @if($mode === 'play_with_computer')
            <div class="score">
                <strong>Your Score: {{ $score }}%</strong><br>
                <strong>Computer Score: {{ $computerScore }}%</strong>
            </div>
        @else
            <div class="score">
                <strong>Your Score: {{ $score }}%</strong>
            </div>
        @endif
    
        <div class="time-taken">
            <strong>Time Taken: {{ $timeTaken }} seconds</strong>
        </div>
    
        <table class="results-table">
            <thead>
                <tr>
                    <th>Question</th>
                    <th>Your Answer</th>
                    @if($mode === 'play_with_computer')
                        <th>Computer Answer</th>
                    @endif
                    <th>Correct Answer</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($results as $result)
                <tr class="{{ $result['correct'] ? 'correct' : 'incorrect' }}">
                    <td>{{ $result['question'] }}</td>
                    <td>{{ $result['user_answer'] }}</td>
                    @if($mode === 'play_with_computer')
                        <td>{{ $result['computer_answer'] }}</td>
                    @endif
                    <td>{{ $result['correct_answer'] }}</td>
                    <td>{{ $result['correct'] ? 'Correct' : 'Incorrect' }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    
        <a href="/" class="back-btn">Back to Home</a>
    </div>
    
    

</body>
</html>
