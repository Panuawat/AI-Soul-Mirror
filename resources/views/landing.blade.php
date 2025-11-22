<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Soul Mirror</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Prompt:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #000; color: #e5e5e5; }
        h1, h2 { font-family: 'Cinzel', serif; }
        .mirror-effect {
            position: relative;
            overflow: hidden;
        }
        .mirror-effect::after {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0) 50%, rgba(255,255,255,0.1) 100%);
            pointer-events: none;
        }
        .btn-glow:hover {
            box-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
        }
    </style>
</head>
<body class="h-screen flex flex-col items-center justify-center relative overflow-hidden">

    {{-- Background Video/Image --}}
    <div class="absolute inset-0 z-0 opacity-40">
        <img src="https://images.unsplash.com/photo-1534447677768-be436bb09401?q=80&w=2094&auto=format&fit=crop" class="w-full h-full object-cover grayscale" alt="Background">
    </div>
    <div class="absolute inset-0 z-10 bg-gradient-to-b from-black via-transparent to-black"></div>

    <div class="z-20 text-center space-y-10 p-6 max-w-4xl fade-in">
        
        <div class="space-y-2">
            <p class="text-neutral-500 tracking-[0.5em] text-sm uppercase">Project: Soul Mirror</p>
            <h1 class="text-6xl md:text-9xl font-bold text-white tracking-tighter mix-blend-overlay opacity-90">
                REFLECTIONS
            </h1>
        </div>

        <p class="text-xl md:text-2xl text-neutral-400 max-w-2xl mx-auto leading-relaxed font-light">
            "กระจกไม่ได้สะท้อนเพียงแค่รูปกาย... <br>แต่มันสะท้อนถึง <span class="text-white font-normal">เศษเสี้ยวของวิญญาณ</span> ที่คุณพยายามซ่อนเร้น"
        </p>

        <div class="pt-12">
            <a href="{{ route('game.start') }}" class="group relative inline-flex items-center justify-center px-12 py-4 overflow-hidden font-medium text-white transition duration-300 ease-out border border-neutral-600 rounded-full shadow-md group">
                <span class="absolute inset-0 flex items-center justify-center w-full h-full text-white duration-300 -translate-x-full bg-neutral-800 group-hover:translate-x-0 ease">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </span>
                <span class="absolute flex items-center justify-center w-full h-full text-white transition-all duration-300 transform group-hover:translate-x-full ease">ENTER THE VOID</span>
                <span class="relative invisible">ENTER THE VOID</span>
            </a>
        </div>

    </div>

    <div class="absolute bottom-8 z-20 flex space-x-6 text-neutral-600 text-xs tracking-widest uppercase">
        <span>AI Analysis</span>
        <span>•</span>
        <span>Psychological RPG</span>
        <span>•</span>
        <span>Dark Fantasy</span>
    </div>

    <script src="{{ asset('js/game-transition.js') }}"></script>
</body>
</html>
