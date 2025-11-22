<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>The Ritual...</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;700&family=Prompt:wght@300;400&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Prompt', sans-serif; background-color: #000; color: #e5e5e5; }
        h1, h2 { font-family: 'Cinzel', serif; }
        .pulse-text { animation: pulse 2s infinite; }
        @keyframes pulse {
            0% { opacity: 0.3; }
            50% { opacity: 1; text-shadow: 0 0 20px rgba(255, 255, 255, 0.5); }
            100% { opacity: 0.3; }
        }
        .loader {
            width: 80px;
            height: 80px;
            border: 2px solid #333;
            border-top: 2px solid #fff;
            border-radius: 50%;
            animation: spin 1.5s linear infinite;
        }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body class="h-screen flex flex-col items-center justify-center relative overflow-hidden">

    {{-- Background Effect --}}
    <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20"></div>
    
    <div class="z-10 flex flex-col items-center space-y-8">
        <div class="loader"></div>
        
        <div class="text-center">
            <h1 class="text-3xl md:text-4xl font-bold text-white tracking-widest pulse-text mb-2">
                PERFORMING THE RITUAL
            </h1>
            <p class="text-neutral-500 text-sm tracking-widest uppercase">
                Communing with the Void Watcher...
            </p>
        </div>
    </div>

    <script src="{{ asset('js/game-transition.js') }}"></script>
    <script>
        // Redirect to analyze route after a short delay
        setTimeout(() => {
            window.location.href = "{{ route('game.analyze') }}";
        }, 3000); // 3 seconds delay
    </script>
</body>
</html>
