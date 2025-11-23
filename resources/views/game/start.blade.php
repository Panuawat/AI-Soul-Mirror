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
    
    <script src="{{ asset('js/game-audio.js') }}"></script>
    <script src="{{ asset('js/game-transition.js') }}"></script>
</body>
</html>