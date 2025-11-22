<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ผลการสะท้อนวิญญาณ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #0f172a; color: #e2e8f0; }
        .mystic-card {
            background: rgba(30, 41, 59, 0.8);
            backdrop-filter: blur(15px);
            border: 1px solid rgba(148, 163, 184, 0.2);
            box-shadow: 0 0 50px rgba(99, 102, 241, 0.2);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-[url('https://images.unsplash.com/photo-1519681393798-38e43269d877?q=80&w=2070&auto=format&fit=crop')] bg-cover bg-center bg-fixed">
    <div class="absolute inset-0 bg-black/80"></div>

    <div class="relative w-full max-w-3xl p-6">
        <div class="mystic-card rounded-2xl p-10 shadow-2xl border-t-4 border-indigo-500">
            <div class="text-center mb-8">
                <h2 class="text-3xl font-bold text-indigo-300 mb-2">✨ สิ่งที่กระจกมองเห็นในตัวคุณ ✨</h2>
                <div class="h-1 w-20 bg-gradient-to-r from-indigo-500 to-purple-500 mx-auto rounded-full"></div>
            </div>

            <div class="prose prose-invert max-w-none text-lg leading-relaxed text-slate-200">
                {{-- แสดงผลลัพธ์ที่แปลงจาก Markdown เป็น HTML --}}
                {!! Str::markdown($analysis) !!}
            </div>

            <div class="mt-10 text-center border-t border-slate-700 pt-6">
                <a href="{{ route('soul.index') }}" class="text-indigo-400 hover:text-indigo-300 transition underline decoration-dotted">
                    ← กลับไปถามกระจกใหม่อีกครั้ง
                </a>
            </div>
        </div>
    </div>
</body>
</html>