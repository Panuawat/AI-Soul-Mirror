<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Soul Identity</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Prompt:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #050505; color: #e5e5e5; }
        h1, h2, .rpg-font { font-family: 'Cinzel', serif; }
        .stat-bar-bg { background: #333; height: 6px; width: 100%; border-radius: 3px; overflow: hidden; }
        .stat-bar-fill { background: #fff; height: 100%; transition: width 1.5s ease-out; }
        .character-card {
            background: linear-gradient(145deg, #1a1a1a, #0a0a0a);
            border: 1px solid #333;
            box-shadow: 0 0 40px rgba(0,0,0,0.8);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')]">

    <div class="character-card max-w-4xl w-full grid grid-cols-1 md:grid-cols-2 rounded-xl overflow-hidden">
        
        {{-- 1. ส่วนรูปภาพตัวละคร (ด้านซ้าย) --}}
        <div class="relative bg-black h-96 md:h-auto flex items-center justify-center overflow-hidden">
            {{-- เราสามารถใช้ prompt จาก AI มาเจนรูปตรงนี้ได้ในอนาคต ตอนนี้ใช้ Placeholder ไปก่อน --}}
            <div class="absolute inset-0 opacity-50 bg-[url('https://images.unsplash.com/photo-1635322966219-b75ed372eb01?q=80&w=1964&auto=format&fit=crop')] bg-cover bg-center grayscale mix-blend-overlay"></div>
            
            <div class="z-10 text-center p-6">
                <h3 class="text-neutral-500 tracking-[0.3em] text-sm uppercase mb-2">Soul Class</h3>
                <h1 class="text-4xl md:text-5xl font-bold text-white mb-2 rpg-font">{{ $characterData['class_name'] }}</h1>
                <p class="text-xl text-neutral-400 italic">"{{ $characterData['title'] }}"</p>
            </div>
        </div>

        {{-- 2. ส่วนข้อมูล Stat และคำอธิบาย (ด้านขวา) --}}
        <div class="p-8 md:p-12 flex flex-col justify-between">
            
            <div>
                <h2 class="text-2xl font-bold text-white mb-6 border-b border-neutral-800 pb-4">Soul Analysis</h2>
                <p class="text-neutral-400 leading-relaxed mb-8 text-lg">
                    {{ $characterData['description'] }}
                </p>

                {{-- Stats Grid --}}
                <div class="space-y-5">
                    @foreach($characterData['stats'] as $stat => $value)
                        <div>
                            <div class="flex justify-between text-xs uppercase tracking-widest text-neutral-500 mb-1">
                                <span>{{ $stat }}</span>
                                <span>{{ $value }}/10</span>
                            </div>
                            <div class="stat-bar-bg">
                                <div class="stat-bar-fill" style="width: {{ $value * 10 }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-10 pt-6 border-t border-neutral-800 text-center md:text-right">
                <a href="{{ route('game.start') }}" class="inline-block text-sm text-neutral-500 hover:text-white transition uppercase tracking-widest">
                    ↻ Reincarnate (Play Again)
                </a>
            </div>
        </div>

    </div>

    <script src="{{ asset('js/game-audio.js') }}"></script>
    <script src="{{ asset('js/game-transition.js') }}"></script>
    <script>
        if(window.gameAudio) {
            window.gameAudio.init();
            setTimeout(() => {
                window.gameAudio.playReveal();
            }, 500);
        }
    </script>
</body>
</html>