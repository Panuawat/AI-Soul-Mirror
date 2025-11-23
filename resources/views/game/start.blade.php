<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Echoes of the Void</title>
    <script src="https://cdn.tailwindcss.com"></script>
    {{-- ใช้ฟอนต์ Cinzel สำหรับหัวข้อให้ดูมีความเป็นแฟนตาซีโบราณ --}}
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Prompt:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #0a0a0a; color: #d4d4d4; }
        h1, h2, h3 { font-family: 'Cinzel', serif; }
        .void-btn {
            background: transparent;
            border: 1px solid #525252;
            color: #d4d4d4;
            transition: all 0.5s ease;
        }
        .void-btn:hover {
            background: #d4d4d4;
            color: #0a0a0a;
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.2);
            border-color: #d4d4d4;
        }
        .fade-in { animation: fadeIn 3s ease-in; }
        @keyframes fadeIn { from { opacity: 0; } to { opacity: 1; } }
    </style>
</head>
<body class="h-screen w-full flex flex-col items-center justify-center overflow-hidden relative">
    
    {{-- Background Image (หมอกควัน/ป่า) --}}
    <div class="absolute inset-0 z-0 opacity-30 bg-[url('https://images.unsplash.com/photo-1518066000714-58c45f1a2c0a?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center grayscale"></div>
    <div class="absolute inset-0 z-10 bg-gradient-to-t from-[#0a0a0a] via-transparent to-[#0a0a0a]"></div>

    <div class="z-20 text-center space-y-8 p-6 max-w-3xl fade-in">
        <p class="text-sm tracking-[0.5em] text-neutral-500 uppercase">The Psychological RPG</p>
        
        <h1 class="text-6xl md:text-8xl font-bold text-white drop-shadow-2xl tracking-wider">
            ECHOES <br> <span class="text-neutral-600 text-4xl md:text-6xl">OF THE VOID</span>
        </h1>

        <p class="text-lg text-neutral-400 leading-relaxed max-w-xl mx-auto">
            "คุณตื่นขึ้นมาในโลกที่ไร้สีสัน... ไร้ความทรงจำ... 
            มีเพียงสัญชาตญาณและการตัดสินใจเท่านั้นที่จะบอกได้ว่า 
            <span class="text-white border-b border-neutral-600">วิญญาณของคุณมีรูปร่างเป็นเช่นไร</span>"
        </p>

        <div class="pt-10 space-y-4">
            <a href="{{ route('game.start') }}" class="void-btn px-10 py-4 text-xl rounded-sm tracking-widest uppercase block w-full md:w-auto">
                เข้าสู่มิติ (Start Journey)
            </a>
            
            <button id="mute-btn" onclick="gameAudio.toggleMute()" class="text-neutral-500 hover:text-white text-sm uppercase tracking-widest transition">
                🔊 Audio On
            </button>
        </div>

        {{-- Recommendations --}}
        <div class="mt-8 text-neutral-500 text-xs font-light tracking-wider space-y-2 opacity-60">
            <p class="flex items-center justify-center gap-2">
                <span class="inline-block w-1 h-1 bg-neutral-600 rounded-full"></span>
                แนะนำให้กด <span class="border border-neutral-700 px-1 rounded text-neutral-400">F11</span> เพื่อประสบการณ์เต็มจอ
            </p>
            <p class="flex items-center justify-center gap-2">
                <span class="inline-block w-1 h-1 bg-neutral-600 rounded-full"></span>
                ควรสวมหูฟัง 🎧 เพื่อบรรยากาศที่สมบูรณ์
            </p>
        </div>
    </div>

    <div class="absolute top-6 right-6 z-20 text-right space-y-1">
        <p class="text-neutral-500 text-xs uppercase tracking-[0.2em] animate-pulse">
            <span class="text-neutral-300 font-serif text-lg">{{ number_format($lostSouls ?? 0) }}</span> 
            <br> Lost Souls
        </p>
    </div>

    <div class="absolute bottom-6 z-20 text-center w-full">
        <div class="text-[10px] text-neutral-800 uppercase tracking-widest opacity-50">
            Power by Gemini 2.5 Flash & Laravel
        </div>
    </div>

    {{-- Feedback Button --}}
    <button onclick="toggleFeedbackModal()" class="fixed bottom-6 right-6 z-50 bg-neutral-800 hover:bg-neutral-700 text-white px-6 py-3 rounded-lg border border-neutral-600 transition shadow-lg">
        💬 ให้ Feedback
    </button>

    {{-- Feedback Modal --}}
    <div id="feedback-modal" class="fixed inset-0 bg-black bg-opacity-80 z-50 flex items-center justify-center p-4" style="display: none;">
        <div class="bg-neutral-900 border border-neutral-700 rounded-xl p-8 max-w-md w-full">
            <h3 class="text-2xl font-bold text-white mb-4">ส่ง Feedback</h3>
            <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4">
                @csrf
                
                <div>
                    <label class="block text-sm text-neutral-400 mb-2">อีเมล (ถ้าต้องการให้เราติดต่อกลับ)</label>
                    <input type="email" name="email" class="w-full bg-neutral-800 border border-neutral-700 rounded px-4 py-2 text-white focus:outline-none focus:border-white">
                </div>
                
                <div>
                    <label class="block text-sm text-neutral-400 mb-2">ความคิดเห็น *</label>
                    <textarea name="message" rows="4" required class="w-full bg-neutral-800 border border-neutral-700 rounded px-4 py-2 text-white focus:outline-none focus:border-white" placeholder="บอกเราว่าคุณรู้สึกยังไงกับประสบการณ์นี้..."></textarea>
                </div>
                
                <div class="flex gap-4">
                    <button type="submit" class="flex-1 bg-white text-black px-6 py-3 rounded font-bold hover:bg-neutral-300 transition">
                        ส่ง
                    </button>
                    <button type="button" onclick="toggleFeedbackModal()" class="px-6 py-3 text-neutral-400 hover:text-white transition">
                        ยกเลิก
                    </button>
                </div>
            </form>
        </div>
    </div>
    
    <script src="{{ asset('js/game-audio.js') }}"></script>
    <script>
        // Auto-start audio on page load
        document.addEventListener('DOMContentLoaded', function() {
            if (window.gameAudio) {
                gameAudio.init();
            }
        });
        
        // Toggle feedback modal
        function toggleFeedbackModal() {
            const modal = document.getElementById('feedback-modal');
            if(modal.style.display === 'none') {
                modal.style.display = 'flex';
            } else {
                modal.style.display = 'none';
            }
        }
    </script>
    <script src="{{ asset('js/game-transition.js') }}"></script>
</body>
</html>