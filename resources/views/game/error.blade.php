<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connection Lost</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Prompt:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #000; color: #e5e5e5; }
        h1, h2 { font-family: 'Cinzel', serif; }
        .glitch {
            animation: glitch 1s infinite;
        }
        @keyframes glitch {
            0%, 100% { transform: translate(0); }
            25% { transform: translate(-2px, 2px); }
            50% { transform: translate(2px, -2px); }
            75% { transform: translate(-2px, -2px); }
        }
    </style>
</head>
<body class="h-screen flex flex-col items-center justify-center relative overflow-hidden p-8">

    <div class="absolute inset-0 z-0 opacity-10 bg-[url('https://images.unsplash.com/photo-1518066000714-58c45f1a2c0a?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center grayscale"></div>
    <div class="absolute inset-0 z-10 bg-gradient-to-b from-black via-transparent to-black"></div>

    <div class="z-20 max-w-2xl text-center space-y-8">
        
        <div class="mb-8">
            <div class="text-6xl mb-4 glitch">⚠️</div>
            <h1 class="text-4xl md:text-6xl font-bold text-red-900/80 mb-4">
                CONNECTION SEVERED
            </h1>
        </div>

        @php
            $errorMessages = [
                'timeout' => [
                    'title' => 'The Void Watcher is Silent',
                    'desc' => 'การเชื่อมต่อกับมิติอื่นขาดหาย... ผู้เฝ้ามองไม่ตอบสนอง บางทีอาจเป็นเพราะกระแสพลังงานที่อ่อนแอเกินไป',
                ],
                'rate_limit' => [
                    'title' => 'Too Many Souls Seeking Answers',
                    'desc' => 'ผู้เฝ้ามองกำลังวิเคราะห์วิญญาณอื่นอยู่... พลังงานมิติเต็มขีดความสามารถ กรุณารอสักครู่แล้วลองใหม่อีกครั้ง',
                ],
                'server_error' => [
                    'title' => 'The Void Rejects the Call',
                    'desc' => 'เกิดความผิดพลาดในมิติแห่งความว่างเปล่า... พลังงานมืดรบกวนการสื่อสาร',
                ],
                'json_error' => [
                    'title' => 'Corrupted Vision',
                    'desc' => 'นิมิตที่ได้รับกลับมาผิดเพี้ยน... ไม่สามารถตีความหมายได้ เหมือนภาษาที่ไม่มีใครเข้าใจ',
                ],
                'unknown' => [
                    'title' => 'Unknown Disturbance',
                    'desc' => 'เกิดสิ่งผิดปกติที่ไม่อาจอธิบายได้... บางทีอาจเป็นเพราะอิทธิพลจากมิติอื่น',
                ],
            ];

            $errorType = request()->query('type', 'unknown');
            $error = $errorMessages[$errorType] ?? $errorMessages['unknown'];
        @endphp

        <div class="space-y-4 text-lg text-neutral-400">
            <h2 class="text-2xl text-white font-serif">{{ $error['title'] }}</h2>
            <p class="leading-relaxed">{{ $error['desc'] }}</p>
        </div>

        <div class="pt-8 flex flex-col md:flex-row gap-4 justify-center">
            <a href="{{ route('game.analyze') }}" 
               class="px-8 py-3 border border-neutral-600 text-neutral-300 hover:text-white hover:border-white hover:bg-neutral-900 transition duration-500 uppercase tracking-widest text-sm">
                ↻ Try Again
            </a>
            <a href="{{ route('game.start') }}" 
               class="px-8 py-3 bg-neutral-900 border border-neutral-700 text-neutral-400 hover:text-white hover:border-white transition duration-500 uppercase tracking-widest text-sm">
                Return to Start
            </a>
        </div>

        <p class="text-xs text-neutral-700 pt-8">
            Error Code: <span class="font-mono">{{ strtoupper($errorType) }}</span>
        </p>

    </div>

    <script src="{{ asset('js/game-transition.js') }}"></script>
</body>
</html>
