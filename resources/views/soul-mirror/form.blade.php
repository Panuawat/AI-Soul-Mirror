<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AI Soul Mirror - กระจกสะท้อนวิญญาณ</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #0f172a; color: #e2e8f0; }
        .mystic-card {
            background: rgba(30, 41, 59, 0.7);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(148, 163, 184, 0.1);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.5);
        }
        .mystic-input {
            background: rgba(15, 23, 42, 0.6);
            border: 1px solid #334155;
            color: #f1f5f9;
        }
        .mystic-input:focus {
            outline: none;
            border-color: #818cf8;
            box-shadow: 0 0 15px rgba(129, 140, 248, 0.3);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center bg-[url('https://images.unsplash.com/photo-1534447677768-be436bb09401?q=80&w=2094&auto=format&fit=crop')] bg-cover bg-center bg-no-repeat bg-fixed">
    <div class="absolute inset-0 bg-black/70"></div>

    <div class="relative w-full max-w-2xl p-6">
        <div class="mystic-card rounded-2xl p-8 shadow-2xl">
            <div class="text-center mb-8">
                <h1 class="text-4xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-indigo-400 to-cyan-400 mb-2">
                    AI Soul Mirror
                </h1>
                <p class="text-slate-400">จงตอบคำถามด้วยสัญชาตญาณแรกของคุณ... แล้วกระจกจะเผยตัวตนที่ซ่อนอยู่</p>
            </div>

            <form action="{{ route('soul.analyze') }}" method="POST" class="space-y-6">
                @csrf
                
                <div class="space-y-2">
                    <label class="block text-lg font-semibold text-indigo-300">1. ถ้าโลกแตกพรุ่งนี้ สิ่งสุดท้ายที่คุณจะทำคืออะไร?</label>
                    <textarea name="q1" rows="2" class="mystic-input w-full rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 transition" required placeholder="พิมพ์คำตอบของคุณ..."></textarea>
                </div>

                <div class="space-y-2">
                    <label class="block text-lg font-semibold text-indigo-300">2. สีอะไรที่อธิบายอารมณ์ของคุณในช่วงนี้ได้ดีที่สุด และทำไม?</label>
                    <textarea name="q2" rows="2" class="mystic-input w-full rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 transition" required placeholder="เช่น สีเทา เพราะ..."></textarea>
                </div>

                <div class="space-y-2">
                    <label class="block text-lg font-semibold text-indigo-300">3. สัตว์ชนิดใดที่คุณคิดว่าเหมือนตัวคุณที่สุด (ไม่ใช่สัตว์ที่คุณชอบ)?</label>
                    <textarea name="q3" rows="2" class="mystic-input w-full rounded-lg p-3 focus:ring-2 focus:ring-indigo-500 transition" required placeholder="อธิบายเหตุผลสั้นๆ..."></textarea>
                </div>

                <div class="pt-4 text-center">
                    <button type="submit" class="bg-gradient-to-r from-indigo-600 to-purple-600 hover:from-indigo-500 hover:to-purple-500 text-white font-bold py-3 px-8 rounded-full shadow-lg transform hover:scale-105 transition duration-300 ease-in-out ring-1 ring-white/20">
                        🔮 เผยตัวตนของฉัน
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>