<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $question->title }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Prompt:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #0f0f0f; color: #e5e5e5; }
        h1, h2 { font-family: 'Cinzel', serif; }
        .choice-btn {
            text-align: left;
            transition: all 0.3s;
            border-left: 3px solid transparent;
        }
        .choice-btn:hover {
            background-color: rgba(255, 255, 255, 0.05);
            border-left-color: #d4d4d4;
            padding-left: 1.5rem;
        }
        
        /* Loading Spinner Styles */
        .media-loader {
            transition: opacity 0.5s ease-out;
        }
        @keyframes spin {
            to { transform: rotate(360deg); }
        }
        .animate-spin {
            animation: spin 1s linear infinite;
        }
        
        /* Skip Button Styles */
        .skip-button-container {
            transition: all 0.3s ease;
        }
        .skip-button-container:hover .skip-hint {
            opacity: 1;
            transform: translateY(0);
        }
        .skip-hint {
            opacity: 0;
            transform: translateY(10px);
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="min-h-screen flex flex-col md:flex-row">

    {{-- 1. ส่วนรูปภาพ/วิดีโอ (ด้านซ้าย/บน) --}}
    <div class="w-full md:w-1/2 relative h-[50vh] md:h-auto bg-black overflow-hidden group">
        
        {{-- Loading Spinner Overlay --}}
        <div id="media-loader" class="media-loader absolute inset-0 z-20 flex items-center justify-center bg-black">
            <div class="w-12 h-12 border-4 border-neutral-800 border-t-white rounded-full animate-spin"></div>
        </div>
        
        {{-- Video or Image --}}
        @if($question->video_path)
            <video autoplay loop muted playsinline class="absolute inset-0 w-full h-full object-cover opacity-80 transition-transform duration-[10s] group-hover:scale-110" oncanplay="hideMediaLoader()">
                <source src="{{ asset($question->video_path) }}" type="video/mp4">
            </video>
        @elseif($question->image_path)
            <img src="{{ asset($question->image_path) }}" alt="Scenario" class="absolute inset-0 w-full h-full object-cover opacity-80 transition-transform duration-[10s] group-hover:scale-110" onload="hideMediaLoader()">
        @endif
        
        {{-- Overlay Gradient --}}
        <div class="absolute inset-0 bg-gradient-to-t from-[#0f0f0f] to-transparent md:bg-gradient-to-r"></div>
        
        {{-- Title & Progress --}}
        <div class="absolute bottom-6 left-6 md:bottom-12 md:left-12 z-10 w-full pr-12">
            <div class="flex items-center space-x-4 mb-2">
                <span class="text-neutral-500 text-sm tracking-widest uppercase">Scenario {{ $currentQuestionNumber }} / {{ $totalQuestions }}</span>
                <div class="h-[2px] flex-1 bg-neutral-800 max-w-[100px]">
                    <div class="h-full bg-white" style="width: {{ ($currentQuestionNumber / $totalQuestions) * 100 }}%"></div>
                </div>
            </div>
            <h1 class="text-4xl md:text-5xl font-bold text-white mt-2 leading-tight">{{ $question->title }}</h1>
        </div>
    </div>

    {{-- 2. ส่วนเนื้อเรื่องและตัวเลือก (ด้านขวา/ล่าง) --}}
    <div class="w-full md:w-1/2 p-8 md:p-16 flex flex-col justify-center bg-[#0f0f0f]">
        
        <div class="max-w-lg mx-auto w-full fade-in">
            <p id="scenario-text" class="text-lg md:text-xl text-neutral-300 leading-relaxed mb-10 border-l-2 border-neutral-700 pl-6 py-2 cursor-pointer" onclick="skipTypewriter()">
                {{-- Text will be inserted here by JS --}}
            </p>

            <form action="{{ route('game.submit', $question->id) }}" method="POST" class="space-y-4 fade-in-delayed" style="opacity: 0;">
                @csrf
                
                <p class="text-sm text-neutral-500 uppercase tracking-wider mb-4">การตัดสินใจของคุณ (Your Choice)</p>

                @foreach($question->choices as $choice)
                    <label class="block cursor-pointer" onmouseenter="window.gameAudio && window.gameAudio.playHover()" onclick="window.gameAudio && window.gameAudio.playClick()">
                        <input type="radio" name="choice_id" value="{{ $choice->id }}" class="peer sr-only" required>
                        <div class="choice-btn p-5 rounded bg-neutral-900 border border-neutral-800 peer-checked:border-white peer-checked:bg-neutral-800 peer-checked:text-white text-neutral-400">
                            <span class="text-lg">{{ $choice->text }}</span>
                        </div>
                    </label>
                @endforeach

                <div class="pt-8 text-right">
                    <button type="submit" class="bg-white text-black px-8 py-3 font-bold uppercase tracking-widest hover:bg-neutral-300 transition" onclick="window.gameAudio && window.gameAudio.playClick()">
                        ยืนยัน (Confirm) →
                    </button>
                </div>
            </form>
        </div>

    </div>

    {{-- Skip to Result Button --}}
    <div id="skip-button-container" class="skip-button-container fixed bottom-6 right-6 z-50" style="display: none;">
        <div class="skip-hint text-xs text-neutral-500 mb-2 text-right">
            💡 คลิกที่นี่เพื่อข้ามไปดูผลทดสอบทันที
        </div>
        <button onclick="window.location.href='{{ route('game.analyze') }}'" class="bg-neutral-800 hover:bg-neutral-700 text-white px-6 py-3 rounded-lg border border-neutral-600 transition shadow-lg">
            <span class="text-sm">ข้ามไปผลทดสอบ →</span>
        </button>
    </div>

    {{-- Toggle Skip Button (Hidden) --}}
    <button id="show-skip-toggle" onclick="toggleSkipButton()" class="fixed bottom-6 right-6 z-40 bg-neutral-900 hover:bg-neutral-800 text-neutral-400 w-12 h-12 rounded-full border border-neutral-700 transition shadow-lg flex items-center justify-center" title="แสดง/ซ่อน ปุ่มข้ามไปผล">
        <span class="text-xl">⚡</span>
    </button>

    <script src="{{ asset('js/game-audio.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/game-transition.js') }}"></script>
    <script>
        // Start ambience if already initialized
        if(window.gameAudio) {
            try {
                window.gameAudio.init();
            } catch(e) { console.error("Audio init failed", e); }
        }

        // Hide media loader when media is ready
        function hideMediaLoader() {
            const loader = document.getElementById('media-loader');
            if(loader) {
                loader.style.opacity = '0';
                setTimeout(() => loader.remove(), 500);
            }
        }
        
        // Fallback: hide loader after 3 seconds
        setTimeout(hideMediaLoader, 3000);

        // Toggle skip button visibility
        function toggleSkipButton() {
            const skipContainer = document.getElementById('skip-button-container');
            if(skipContainer.style.display === 'none') {
                skipContainer.style.display = 'block';
            } else {
                skipContainer.style.display = 'none';
            }
        }

        // Typewriter Effect
        const text = @json($question->scenario ?? '');
        const textElement = document.getElementById('scenario-text');
        const formElement = document.querySelector('.fade-in-delayed');
        let index = 0;
        let isTyping = true;
        let timer;

        function typeWriter() {
            if (!text) {
                showForm();
                return;
            }
            
            if (index < text.length) {
                textElement.innerHTML += text.charAt(index);
                index++;
                timer = setTimeout(typeWriter, 30);
            } else {
                isTyping = false;
                showForm();
            }
        }

        function skipTypewriter() {
            if (isTyping) {
                clearTimeout(timer);
                textElement.innerHTML = text;
                isTyping = false;
                showForm();
            }
        }

        function showForm() {
            if(formElement) {
                formElement.style.transition = "opacity 1s ease-in";
                formElement.style.opacity = "1";
            }
        }

        setTimeout(showForm, 5000);

        if(textElement && formElement) {
            typeWriter();
        } else {
            showForm();
        }
    </script>
</body>
</html>