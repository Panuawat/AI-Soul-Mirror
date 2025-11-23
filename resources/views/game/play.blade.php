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
        .card-glass {
            background: rgba(20, 20, 20, 0.8);
            border: 1px solid #333;
            backdrop-filter: blur(5px);
        }
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
        /* Loading Overlay */
        #media-loader {
            transition: opacity 0.5s ease-out;
        }
    </style>
    
    {{-- Preload Next Image --}}
    @if(isset($nextImage))
        <link rel="preload" as="image" href="{{ $nextImage }}">
    @endif
</head>
<body class="min-h-screen flex flex-col md:flex-row">

    {{-- Hidden Preloader for Next Image --}}
    @if(isset($nextImage))
        <img src="{{ $nextImage }}" style="display:none;" alt="preload">
    @endif

    {{-- 1. ส่วนรูปภาพ/วิดีโอ (ด้านซ้าย/บน) --}}
    <div class="w-full md:w-1/2 relative h-[50vh] md:h-auto bg-black overflow-hidden group">
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

    <script src="{{ asset('js/game-audio.js') }}?v={{ time() }}"></script>
    <script src="{{ asset('js/game-transition.js') }}"></script>
    <script>
        // Start ambience if already initialized
        if(window.gameAudio) {
            try {
                window.gameAudio.init();
            } catch(e) { console.error("Audio init failed", e); }
        }

        // Hide loader when media is ready
        function hideLoader() {
            const loader = document.getElementById('media-loader');
            if(loader) {
                loader.style.opacity = '0';
                setTimeout(() => loader.remove(), 500);
            }
        }
        
        // Fallback to hide loader after 3s
        setTimeout(hideLoader, 3000);

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
                timer = setTimeout(typeWriter, 30); // Speed: 30ms per char
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

        // Safety fallback: Show form after 5 seconds anyway
        setTimeout(showForm, 5000);

        // Start typing
        if(textElement && formElement) {
            typeWriter();
        } else {
            console.error("Elements not found");
            showForm();
        }
    </script>
</body>
</html>