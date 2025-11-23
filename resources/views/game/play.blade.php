<!DOCTYPE html>
<html lang="th">
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