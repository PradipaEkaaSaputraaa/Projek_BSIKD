<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Digital Signage BSIKD - Top Aligned Poster</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@600;700;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body, html {
            background: #000;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
            font-family: 'Source Sans 3', sans-serif;
        }

        .portrait-container {
            width: 100%;
            height: 100%;
            position: relative;
            display: flex;
            flex-direction: column;
        }

        /* 1. SLIDESHOW LAYER */
        .slides-wrapper {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 7vh; /* Berhenti sebelum running text */
            z-index: 1;
        }

        .slide {
            position: absolute;
            inset: 0;
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
            display: flex;
            justify-content: center;
            /* REVISI: Mepet ke atas */
            align-items: flex-start; 
        }

        .slide.active { opacity: 1; }

        .slide img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }

        /* Latar belakang slide utama tetap cover */
        #slide-info { align-items: center; }
        #slide-info img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.4;
        }

        /* 2. UI LAYER (AGENDA & NOTES) */
        .main-ui-layer {
            position: relative;
            z-index: 10;
            height: 93vh;
            display: flex;
            flex-direction: column;
            pointer-events: none;
            transition: opacity 0.8s ease-in-out;
        }

        .content-padding { padding-left: 3rem; padding-right: 3rem; }

        /* Agenda & Notes Container */
        .top-content-area {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .agenda-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .info-card {
            background: linear-gradient(to bottom right, #1e3a8a, #1e40af);
            border-left: 8px solid #3b82f6;
            border-radius: 1.2rem;
            padding: 1.2rem;
        }

        .notes-gate-container {
            flex-grow: 1;
            position: relative;
            overflow: hidden;
            margin-top: 2rem;
            mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent);
            -webkit-mask-image: linear-gradient(to bottom, transparent, black 10%, black 90%, transparent);
        }

        /* 3. JAM PERMANEN (DI AREA HITAM BAWAH) */
        .permanent-clock-area {
            position: absolute;
            bottom: 9vh; /* Di atas running text */
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
            z-index: 20;
            pointer-events: none;
        }

        #clock {
            font-size: 5rem;
            font-weight: 900;
            color: white;
            line-height: 1;
            text-shadow: 0 0 20px rgba(0,0,0,0.8);
        }

        .date-text {
            font-size: 1.8rem;
            font-weight: 800;
            color: #fbbf24;
            letter-spacing: 0.2em;
            text-shadow: 0 0 10px rgba(0,0,0,0.8);
        }

        /* 4. FOOTER */
        footer {
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 7vh;
            background: white;
            border-top: 6px solid #fbbf24;
            z-index: 100;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .marquee-content {
            display: flex;
            width: max-content;
            animation: marquee 50s linear infinite;
        }

        @keyframes marquee {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
    </style>
</head>
<body>

    <div class="portrait-container">
        
        <div class="slides-wrapper">
            <div class="slide active" id="slide-info">
                <img src="{{ asset('images/foto_kampus.jpg') }}">
                <div class="absolute inset-0 bg-gradient-to-b from-slate-900/40 via-slate-900/60 to-slate-950"></div>
            </div>
            @foreach($posters as $p)
                <div class="slide">
                    <img src="{{ asset('storage/' . $p->path_poster) }}">
                </div>
            @endforeach
        </div>

        <div class="main-ui-layer" id="ui-container">
            <div class="top-content-area content-padding">
                <div class="pt-12 text-center">
                    <h2 class="text-3xl font-black text-white uppercase tracking-widest">Informasi Kampus</h2>
                    <div class="h-1 w-20 bg-yellow-500 mx-auto mt-2 rounded-full"></div>
                </div>

                <div class="agenda-grid">
                    @foreach($agendas as $agenda)
                        <div class="info-card">
                            <h3 class="text-white font-bold text-xl leading-tight">{{ $agenda->isi_agenda }}</h3>
                            <p class="text-blue-300 text-xs mt-1">📅 {{ $agenda->tgl }} | ⏰ {{ $agenda->jam }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="notes-gate-container">
                    <div class="notes-scroll-content">
                        @foreach($notes as $note)
                            <div class="bg-yellow-400 rounded-2xl p-6 mb-6 text-black">
                                <h4 class="font-black text-2xl uppercase mb-1">{{ $note->judul_note }}</h4>
                                <div class="text-xl">{!! $note->isi !!}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="permanent-clock-area">
            <h2 id="clock">00:00:00</h2>
            <p class="date-text uppercase">{{ now()->translatedFormat('d F Y') }}</p>
        </div>

        <footer>
            <div class="marquee-content">
                @foreach($runningTexts as $rt)
                    <span class="text-2xl font-black text-slate-900 mx-14 uppercase flex items-center whitespace-nowrap">
                        <div class="mr-4 w-5 h-5 bg-red-600 rounded-full animate-pulse"></div> {{ $rt->isitext }}
                    </span>
                @endforeach
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
        const uiContainer = document.getElementById("ui-container");

        function showSlides() {
            if (slides.length <= 1) return;
            
            slides.forEach(s => s.classList.remove("active"));
            slideIndex = (slideIndex + 1) % slides.length;
            slides[slideIndex].classList.add("active");
            
            // UI Agenda/Notes hanya muncul di slide info, tapi Jam tetap ada di bawah
            if (slides[slideIndex].id === 'slide-info') {
                uiContainer.style.opacity = "1";
            } else {
                uiContainer.style.opacity = "0";
            }

            let duration = slides[slideIndex].id === 'slide-info' ? 60000 : 15000;
            setTimeout(showSlides, duration);
        }

        if (slides.length > 1) {
            setTimeout(showSlides, 60000);
        }
    </script>
</body>
</html>