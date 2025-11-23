<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prologue: The Great Collapse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Prompt:wght@200;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #020202; color: #e5e5e5; }
        h1, h2 { font-family: 'Cinzel', serif; }
        
        /* Animation Classes */
        .fade-in { 
            opacity: 0; 
            will-change: opacity, transform;
            animation: fadeIn 3s ease-out forwards; 
        }
        
        /* ลำดับการปรากฏของเนื้อเรื่อง */
        .delay-title { animation-delay: 0.5s; }
        .delay-1 { animation-delay: 3s; }
        .delay-2 { animation-delay: 8s; }
        .delay-3 { animation-delay: 13s; }
        .delay-4 { animation-delay: 18s; }
        .delay-btn { animation-delay: 22s; }
        
        @keyframes fadeIn { 
            from { opacity: 0; transform: translateY(10px); } 
            to { opacity: 1; transform: translateY(0); } 
        }

        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.8);
            letter-spacing: 0.3em;
        }
        
        /* Vignette & Scanlines Effect */
        .overlay {
            background: radial-gradient(circle, transparent 40%, #000000 100%);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center relative overflow-y-auto px-6 py-12">

    {{-- Background Image --}}
    <div class="fixed inset-0 z-0 opacity-25 bg-[url('https://images.unsplash.com/photo-1519074069444-1ba4fff66d16?q=80&w=1974&auto=format&fit=crop')] bg-cover bg-center grayscale transform scale-105 animate-[pulse_10s_infinite]"></div>
    
    {{-- Dark Overlay --}}
    <div class="fixed inset-0 z-10 bg-gradient-to-b from-black via-black/80 to-black"></div>
    <div class="fixed inset-0 z-10 overlay pointer-events-none"></div>

    <div class="z-20 max-w-4xl text-center space-y-12 relative">
        
        {{-- Title --}}
        <div class="fade-in delay-title">
            <p class="text-xs md:text-sm tracking-[0.5em] text-neutral-600 uppercase mb-4">The Chronicle of the End</p>
            <h1 class="text-5xl md:text-7xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-white to-neutral-700 tracking-widest drop-shadow-lg">
                THE GREAT COLLAPSE
            </h1>
        </div>

        {{-- Story Content --}}
        <div class="space-y-10 text-lg md:text-2xl text-neutral-400 leading-relaxed font-light">
            
            <p class="fade-in delay-1 border-l-2 border-neutral-800 pl-6 italic text-neutral-500">
                "กาลครั้งหนึ่ง... นานจนไม่อาจจดจำ โลกใบนี้เคยอาบไล้ด้วยแสงตะวันและเกียรติยศ 
                ทวยเทพและมนุษย์ต่างเดินเคียงข้างกันภายใต้ท้องฟ้าสีคราม..."
            </p>

            <p class="fade-in delay-2">
                แต่แล้ว <span class="text-red-900/80 font-semibold">รอยแยกแห่งมิติ</span> ก็ฉีกกระชากท้องฟ้า 
                ความมืดมิดที่ไร้ก้นบึ้งหลั่งไหลเข้ามาดั่งมหาสมุทรสีดำ 
                กลืนกินดวงดารา อารยธรรม และทุกสรรพชีวิตให้หายไปในพริบตา
            </p>

            <p class="fade-in delay-3">
                บัดนี้... สิ่งที่เหลืออยู่มีเพียง <span class="text-white font-serif">"The Void"</span> 
                ความว่างเปล่าอันเงียบงันที่ไร้ซึ่งจุดจบ 
                และเศษซากวิญญาณที่แตกสลาย ล่องลอยอยู่อย่างไร้จุดหมาย
            </p>

            <p class="fade-in delay-4 text-white/90 border-t border-neutral-900 pt-8 mt-8">
                คุณตื่นขึ้นท่ามกลางความมืดนั้น... ไร้ซึ่งกายหยาบ ไร้ซึ่งนามเรียกขาน<br>
                มีเพียงสัญชาตญาณและเสียงกระซิบแผ่วเบาจากผู้เฝ้ามองเท่านั้น...<br>
                ที่จะพาคุณค้นพบว่า <span class="underline decoration-neutral-700 decoration-1 underline-offset-4">แท้จริงแล้วคุณคือใคร</span>
            </p>
        </div>

        {{-- Button --}}
        <div class="pt-20 fade-in delay-btn pb-10">
            <a href="{{ route('game.begin') }}" 
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prologue: The Great Collapse</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Prompt:wght@200;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #020202; color: #e5e5e5; }
        h1, h2 { font-family: 'Cinzel', serif; }
        
        /* Animation Classes */
        .fade-in { 
            opacity: 0; 
            will-change: opacity, transform;
            animation: fadeIn 3s ease-out forwards; 
        }
        
        /* ลำดับการปรากฏของเนื้อเรื่อง */
        .delay-title { animation-delay: 0.5s; }
        .delay-1 { animation-delay: 3s; }
        .delay-2 { animation-delay: 8s; }
        .delay-3 { animation-delay: 13s; }
        .delay-4 { animation-delay: 18s; }
        .delay-btn { animation-delay: 22s; }
        
        @keyframes fadeIn { 
            from { opacity: 0; transform: translateY(10px); } 
            to { opacity: 1; transform: translateY(0); } 
        }

        .btn-glow:hover {
            box-shadow: 0 0 30px rgba(255, 255, 255, 0.15);
            border-color: rgba(255, 255, 255, 0.8);
            letter-spacing: 0.3em;
        }
        
        /* Vignette & Scanlines Effect */
        .overlay {
            background: radial-gradient(circle, transparent 40%, #000000 100%);
        }
    </style>
</head>
<body class="min-h-screen flex flex-col items-center justify-center relative overflow-y-auto px-6 py-12">

    {{-- Background Image --}}
    <div class="fixed inset-0 z-0 opacity-25 bg-[url('https://images.unsplash.com/photo-1519074069444-1ba4fff66d16?q=80&w=1974&auto=format&fit=crop')] bg-cover bg-center grayscale transform scale-105 animate-[pulse_10s_infinite]"></div>
    
    {{-- Dark Overlay --}}
    <div class="fixed inset-0 z-10 bg-gradient-to-b from-black via-black/80 to-black"></div>
    <div class="fixed inset-0 z-10 overlay pointer-events-none"></div>

    <div class="z-20 max-w-4xl text-center space-y-12 relative">
        
        {{-- Title --}}
        <div class="fade-in delay-title">
            <p class="text-xs md:text-sm tracking-[0.5em] text-neutral-600 uppercase mb-4">The Chronicle of the End</p>
            <h1 class="text-5xl md:text-7xl font-bold text-transparent bg-clip-text bg-gradient-to-b from-white to-neutral-700 tracking-widest drop-shadow-lg">
                THE GREAT COLLAPSE
            </h1>
        </div>

        {{-- Story Content --}}
        <div class="space-y-10 text-lg md:text-2xl text-neutral-400 leading-relaxed font-light">
            
            <p class="fade-in delay-1 border-l-2 border-neutral-800 pl-6 italic text-neutral-500">
                "กาลครั้งหนึ่ง... นานจนไม่อาจจดจำ โลกใบนี้เคยอาบไล้ด้วยแสงตะวันและเกียรติยศ 
                ทวยเทพและมนุษย์ต่างเดินเคียงข้างกันภายใต้ท้องฟ้าสีคราม..."
            </p>

            <p class="fade-in delay-2">
                แต่แล้ว <span class="text-red-900/80 font-semibold">รอยแยกแห่งมิติ</span> ก็ฉีกกระชากท้องฟ้า 
                ความมืดมิดที่ไร้ก้นบึ้งหลั่งไหลเข้ามาดั่งมหาสมุทรสีดำ 
                กลืนกินดวงดารา อารยธรรม และทุกสรรพชีวิตให้หายไปในพริบตา
            </p>

            <p class="fade-in delay-3">
                บัดนี้... สิ่งที่เหลืออยู่มีเพียง <span class="text-white font-serif">"The Void"</span> 
                ความว่างเปล่าอันเงียบงันที่ไร้ซึ่งจุดจบ 
                และเศษซากวิญญาณที่แตกสลาย ล่องลอยอยู่อย่างไร้จุดหมาย
            </p>

            <p class="fade-in delay-4 text-white/90 border-t border-neutral-900 pt-8 mt-8">
                คุณตื่นขึ้นท่ามกลางความมืดนั้น... ไร้ซึ่งกายหยาบ ไร้ซึ่งนามเรียกขาน<br>
                มีเพียงสัญชาตญาณและเสียงกระซิบแผ่วเบาจากผู้เฝ้ามองเท่านั้น...<br>
                ที่จะพาคุณค้นพบว่า <span class="underline decoration-neutral-700 decoration-1 underline-offset-4">แท้จริงแล้วคุณคือใคร</span>
            </p>
        </div>

        {{-- Button --}}
        <div class="pt-20 fade-in delay-btn pb-10">
            <a href="{{ route('game.begin') }}" 
                </p>
            </div>
        </div>

    </div>

</body>
</html>