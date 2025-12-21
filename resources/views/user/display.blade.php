<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Signage BSIKD</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@400;700;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi Marquee */
        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }

        .marquee-container {
            display: flex;
            width: max-content;
            animation: marquee 40s linear infinite;
        }

        .marquee-content {
            display: flex;
            white-space: nowrap;
        }
        
        body {
            background-color: #000;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            cursor: none;
            /* Font default untuk konten lainnya */
            font-family: ui-sans-serif, system-ui, sans-serif;
        }

        .portrait-container {
            width: 56.25vh; 
            height: 100vh;
            background: #000;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        .slide {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            z-index: 10;
        }

        .slide.active {
            opacity: 1;
            z-index: 20;
        }

        .glass-clock {
            background: rgba(0, 0, 0, 0.7);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            border-right: 1px solid rgba(255, 255, 255, 0.2);
            padding: 1rem 2.5rem 1rem 1.5rem;
            border-radius: 0 1.5rem 0 0;
        }

        .modern-card {
            background: rgba(15, 23, 42, 0.6);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }

        .modern-footer {
            background: #ffffff;
            box-shadow: 0 -4px 30px rgba(0, 0, 0, 0.6);
        }

        /* GAYA FONT SOURCE SANS PRO UNTUK RUNNING TEXT */
        .running-text-style {
            font-family: 'Source Sans 3', sans-serif; /* Nama terbaru dari Source Sans Pro di Google Fonts */
            letter-spacing: 0.5px;
            text-transform: none; /* Atur 'uppercase' jika ingin huruf kapital semua */
        }

        .pulse-dot {
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {
            0%, 100% { transform: scale(1); opacity: 1; }
            50% { transform: scale(1.3); opacity: 0.5; }
        }
    </style>
</head>
<body>

    <div class="portrait-container">
        <main class="flex-grow w-full h-full relative overflow-hidden">
            
            <div class="slide active bg-slate-900">
                <div class="absolute top-0 left-0 w-full h-[60%] overflow-hidden">
                    <img src="{{ asset('images/foto_kampus.jpg') }}" class="w-full h-full object-cover" alt="Kampus BSIKD">
                    <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/40 to-[#0f172a]"></div>
                </div>

                <div class="relative z-10 p-8 pt-16 flex flex-col gap-6">
                    <div class="text-center mb-2">
                        <h2 class="text-4xl font-black text-white tracking-tighter uppercase drop-shadow-[0_4px_8px_rgba(0,0,0,0.9)]">
                            Informasi Kampus
                        </h2>
                        <div class="flex justify-center mt-2">
                            <div class="h-1.5 w-20 bg-yellow-500 rounded-full shadow-lg shadow-yellow-500/50"></div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        @forelse($agendas as $agenda)
                        <div class="modern-card p-4 rounded-2xl shadow-2xl">
                            <h3 class="text-white font-bold text-base mb-2 leading-snug drop-shadow-md">
                                {{ $agenda->isi_agenda }}
                            </h3>
                            <div class="flex gap-4 text-[11px] font-mono font-bold uppercase tracking-widest text-blue-400">
                                <span>📅 {{ $agenda->tgl }}</span>
                                <span>⏰ {{ $agenda->jam }}</span>
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>

                    <div class="space-y-4">
                        @forelse($notes as $note)
                        <div class="modern-card p-5 rounded-2xl border-l-4 border-yellow-500 shadow-2xl">
                            <div class="flex items-center gap-2 mb-2">
                                <span class="px-2 py-0.5 bg-yellow-500 rounded text-black font-black text-[10px]">PENGUMUMAN</span>
                                <h4 class="text-yellow-400 font-black text-xs uppercase tracking-widest">{{ $note->judul_note }}</h4>
                            </div>
                            <div class="text-white text-[14px] italic leading-relaxed font-medium drop-shadow-md">
                                {!! $note->isi !!}
                            </div>
                        </div>
                        @empty
                        @endforelse
                    </div>
                </div>
            </div>

            @foreach($posters as $p)
                <div class="slide">
                    @if($p->path_poster)
                        <img src="{{ asset('storage/' . $p->path_poster) }}" class="w-full h-full object-cover">
                    @endif
                </div>
            @endforeach
        </main>

        <div class="absolute bottom-[5vh] left-0 z-50">
            <div class="glass-clock shadow-2xl">
                <h2 id="clock" class="text-4xl font-mono font-bold text-white leading-none tracking-tighter">00:00:00</h2>
                <p class="text-[11px] font-black uppercase tracking-[0.2em] text-yellow-400 mt-1">
                    {{ now()->translatedFormat('d F Y') }}
                </p>
            </div>
        </div>

        <footer class="h-[5vh] w-full modern-footer flex items-center overflow-hidden z-50">
            <div class="marquee-container">
                <div class="marquee-content">
                    @foreach($runningTexts as $rt)
                        <span class="running-text-style text-base font-bold text-slate-900 flex items-center mx-10">
                            <span class="mr-3 w-3 h-3 bg-red-600 rounded-full pulse-dot"></span> 
                            {{ $rt->isitext }}
                        </span>
                    @endforeach
                </div>
                <div class="marquee-content">
                    @foreach($runningTexts as $rt)
                        <span class="running-text-style text-base font-bold text-slate-900 flex items-center mx-10">
                            <span class="mr-3 w-3 h-3 bg-red-600 rounded-full pulse-dot"></span> 
                            {{ $rt->isitext }}
                        </span>
                    @endforeach
                </div>
            </div>
        </footer>
    </div>

    <script>
        function updateClock() {
            const now = new Date();
            const h = String(now.getHours()).padStart(2, '0');
            const m = String(now.getMinutes()).padStart(2, '0');
            const s = String(now.getSeconds()).padStart(2, '0');
            document.getElementById('clock').textContent = `${h}:${m}:${s}`;
        }
        setInterval(updateClock, 1000);
        updateClock();

        let slideIndex = 0;
        const slides = document.querySelectorAll(".slide");

        function showSlides() {
            if (slides.length <= 1) return;
            slides.forEach(s => { s.classList.remove("active"); s.style.opacity = "0"; });
            slideIndex++;
            if (slideIndex > slides.length) slideIndex = 1;
            const currentSlide = slides[slideIndex - 1];
            currentSlide.classList.add("active");
            currentSlide.style.opacity = "1";
            let duration = (slideIndex === 1) ? 15000 : 3000;
            setTimeout(showSlides, duration);
        }

        window.onload = () => { if (slides.length > 1) setTimeout(showSlides, 15000); };
        setTimeout(() => { window.location.reload(); }, 600000);
    </script>
</body>
</html>