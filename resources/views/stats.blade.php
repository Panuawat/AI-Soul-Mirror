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

        <div class="mt-8 text-center">
            <a href="/" class="text-neutral-400 hover:text-white transition underline decoration-neutral-700 underline-offset-4">← Back to Game</a>
        </div>
    </div>
</body>
</html>
