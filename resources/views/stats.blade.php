<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visitor Stats - AI Soul Mirror</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:wght@300;400;600&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #0f0f0f; color: #e5e5e5; }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-neutral-900 border border-neutral-800 rounded-lg p-8 shadow-2xl">
        <h1 class="text-2xl font-bold text-white mb-6 text-center">📊 Visitor Statistics</h1>
        
        <div class="space-y-6">
            <div class="bg-neutral-800 p-6 rounded-lg border border-neutral-700 text-center">
                <p class="text-neutral-400 text-sm uppercase tracking-wider mb-2">Total Visits</p>
                <p class="text-5xl font-bold text-white">{{ number_format($totalVisits) }}</p>
            </div>

            <div class="bg-neutral-800 p-6 rounded-lg border border-neutral-700 text-center">
                <p class="text-neutral-400 text-sm uppercase tracking-wider mb-2">Visits Today</p>
                <p class="text-4xl font-bold text-green-400">{{ number_format($todayVisits) }}</p>
            </div>

            @if($lastVisit)
            <div class="text-center text-xs text-neutral-500 pt-4 border-t border-neutral-800">
                Last visit: {{ $lastVisit->created_at->diffForHumans() }}
            </div>
            @endif
        </div>

        {{-- Feedback Section --}}
        <div class="mt-10 pt-8 border-t border-neutral-800">
            <h2 class="text-xl font-bold text-neutral-300 mb-4 text-center font-serif">🔮 Whisper to the Creator</h2>
            
            @if(session('success'))
                <div class="bg-green-900/20 border border-green-800 text-green-400 p-3 rounded text-sm text-center mb-4">
                    {{ session('success') }}
                </div>
            @endif

            <form action="{{ route('feedback.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <textarea name="message" rows="3" required
                        class="w-full bg-black/50 border border-neutral-700 rounded p-3 text-neutral-300 placeholder-neutral-600 focus:border-neutral-500 focus:outline-none transition text-sm"
                        placeholder="เจ้าปรารถนาสิ่งใด... (What do you desire?)"></textarea>
                </div>
                <button type="submit" class="w-full bg-neutral-800 hover:bg-neutral-700 text-neutral-300 border border-neutral-700 py-2 rounded transition uppercase tracking-widest text-xs">
                    ส่งกระแสจิต (Transmit Thought)
                </button>
            </form>
        </div>

        <div class="mt-8 text-center">
            <a href="/" class="text-neutral-500 hover:text-white transition underline decoration-neutral-800 underline-offset-4 text-sm">← Return to the Void</a>
        </div>
    </div>
</body>
</html>
