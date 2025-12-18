<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Perusahaan</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50">
    <nav class="bg-white shadow-sm border-b">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16 items-center">
                <div class="text-xl font-bold text-orange-600">Logo Perusahaan</div>
                <div class="flex items-center gap-4">
                    <span class="text-gray-600">Halo, {{ auth()->user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm text-red-600 hover:underline">Keluar</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow rounded-lg p-6">
            <h2 class="text-2xl font-bold text-gray-800 mb-4">Selamat Datang di Portal Karyawan</h2>
            <p class="text-gray-600">Ini adalah halaman khusus untuk user/karyawan. Di sini kamu bisa melihat pengumuman dan agenda perusahaan.</p>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <div class="border rounded-lg p-4 hover:shadow-md transition">
                    <h3 class="font-semibold text-lg">📅 Agenda Terbaru</h3>
                    <p class="text-sm text-gray-500 mt-2">Lihat jadwal kegiatan minggu ini.</p>
                </div>
                <div class="border rounded-lg p-4 hover:shadow-md transition">
                    <h3 class="font-semibold text-lg">📝 Catatan</h3>
                    <p class="text-sm text-gray-500 mt-2">Akses dokumen dan catatan internal.</p>
                </div>
                <div class="border rounded-lg p-4 hover:shadow-md transition">
                    <h3 class="font-semibold text-lg">🖼️ Poster</h3>
                    <p class="text-sm text-gray-500 mt-2">Informasi visual perusahaan.</p>
                </div>
            </div>
        </div>
    </main>
</body>
</html>