<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Asset Detail - Secured</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-100 min-h-screen flex items-center justify-center p-6">

    <div class="max-w-2xl w-full bg-white rounded-2xl shadow-sm p-8">

        <div class="mb-8 flex justify-between items-start">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">
                    Asset Information
                </h1>
                <p class="text-sm text-amber-600 mt-2 font-medium flex items-center gap-1">
                    🔒 Internal Secured Verification
                </p>
            </div>
            <a href="/dashboard" class="text-sm bg-slate-100 hover:bg-slate-200 text-slate-600 px-4 py-2 rounded-xl transition">
                Dashboard
            </a>
        </div>

        <div class="space-y-5">

            <div>
                <p class="text-sm text-slate-500">Kode Asset</p>
                <h2 class="text-lg font-semibold text-slate-800">
                    {{ $asset->kode_asset }}
                </h2>
            </div>

            <div>
                <p class="text-sm text-slate-500">Nama Asset</p>
                <h2 class="text-lg font-semibold text-slate-800">
                    {{ $asset->nama_asset }}
                </h2>
            </div>

            <div>
                <p class="text-sm text-slate-500">Kategori</p>
                <h2 class="text-lg font-semibold text-slate-800">
                    {{ $asset->category->nama_kategori ?? 'Tidak Ada Kategori' }}
                </h2>
            </div>

            <div>
                <p class="text-sm text-slate-500">Department Location</p>
                <h2 class="text-lg font-semibold text-slate-800">
                    {{ $asset->department->nama_department ?? 'Belum Ditentukan (Individual)' }}
                </h2>
            </div>

            <div>
                <p class="text-sm text-slate-500">Status Asset</p>
                <div class="mt-2">
                    @if($asset->status_asset == 'aktif')
                        <span class="inline-block px-4 py-1.5 rounded-xl bg-emerald-100 text-emerald-800 text-sm font-medium">
                            Active
                        </span>
                    @elseif($asset->status_asset == 'rusak')
                        <span class="inline-block px-4 py-1.5 rounded-xl bg-rose-100 text-rose-800 text-sm font-medium">
                            Under Maintenance (Rusak)
                        </span>
                    @else
                        <span class="inline-block px-4 py-1.5 rounded-xl bg-slate-200 text-slate-700 text-sm font-medium">
                            {{ ucfirst($asset->status_asset) }}
                        </span>
                    @endif
                </div>
            </div>

        </div>

    </div>

</body>
</html>