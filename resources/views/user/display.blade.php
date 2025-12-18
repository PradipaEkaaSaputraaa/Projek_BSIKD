<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Signage BSIKD</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Animasi Running Text yang Mulus dan Selalu Berjalan */
        @keyframes marquee {
            0% { transform: translateX(100%); }
            100% { transform: translateX(-100%); }
        }
        .animate-marquee {
            display: inline-block;
            animation: marquee 10s linear infinite; /* Durasi 30 detik agar lebih lambat & nyaman dibaca */
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
            font-family: ui-sans-serif, system-ui, sans-serif;
        }

        .portrait-container {
            width: 56.25vh; /* Rasio 9:16 */
            height: 100vh;
            background-color: #000;
            display: flex;
            flex-direction: column;
            position: relative;
        }

        /* Animasi Transisi Fade untuk Poster */
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

        main::-webkit-scrollbar { display: none; }
    </style>
</head>
<body>

    <div class="portrait-container">
        
        <header class="absolute top-0 right-0 p-8 z-50 text-right bg-gradient-to-l from-black/70 to-transparent w-full">
            <h2 id="clock" class="text-4xl font-mono font-bold text-white drop-shadow-2xl leading-none">00:00:00</h2>
            <p class="text-[10px] font-bold uppercase tracking-[0.2em] text-yellow-400 drop-shadow-lg mt-1">
                {{ now()->translatedFormat('d F Y') }}
            </p>
        </header>

        <main class="flex-grow w-full h-full overflow-hidden relative bg-black">
            @forelse($posters as $p)
                <div class="slide">
                    @if($p->path_poster)
                        <img src="{{ asset('storage/' . $p->path_poster) }}" class="w-full h-full object-cover">
                    @endif
                </div>
            @empty
                <div class="h-full flex items-center justify-center text-slate-500 italic text-sm">
                    <p>Menunggu konten poster...</p>
                </div>
            @endforelse
        </main>

        <footer class="absolute bottom-0 left-0 w-full h-[6vh] flex items-center overflow-hidden z-50 bg-gradient-to-t from-black/80 to-transparent">
            <div class="animate-marquee w-full">
                <span class="text-xl font-semibold text-white uppercase flex items-center">
                    @if($runningTexts->count() > 0)
                        @foreach($runningTexts as $rt)
                            <span class="mx-6 text-yellow-500 text-lg">●</span> 
                            {{ $rt->isitext }} 
                        @endforeach
                        @foreach($runningTexts as $rt)
                            <span class="mx-6 text-yellow-500 text-lg">●</span> 
                            {{ $rt->isitext }} 
                        @endforeach
                    @else
                        <span class="mx-10">Selamat Datang di Portal Informasi Digital BSIKD</span>
                    @endif
                </span>
            </div>
        </footer>

    </div>

    <script>
        // Realtime Clock
        function updateClock() {
            const now = new Date();
            document.getElementById('clock').textContent = 
                now.getHours().toString().padStart(2, '0') + ":" + 
                now.getMinutes().toString().padStart(2, '0') + ":" + 
                now.getSeconds().toString().padStart(2, '0');
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Slideshow Logic
        let slideIndex = 0;
        const slides = document.querySelectorAll(".slide");

        function showSlides() {
            if (slides.length <= 1) {
                if(slides.length === 1) slides[0].classList.add("active");
                return;
            }

            slides.forEach(slide => slide.classList.remove("active"));

            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }

            slides[slideIndex - 1].classList.add("active");

            // Ganti gambar setiap 8 detik
            setTimeout(showSlides, 8000); 
        }

        showSlides();

        // Auto Refresh halaman setiap 10 menit untuk ambil data terbaru dari database
        setTimeout(() => { window.location.reload(); }, 600000);
    </script>
</body>
</html>