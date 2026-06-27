<x-app-layout>

<div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">

    <!-- Header -->
    <div class="flex flex-col md:flex-row md:justify-between md:items-center gap-4 mb-6">

        <div>

            <h2 class="text-xl font-semibold text-slate-800">
                Asset Categories
            </h2>

            <p class="text-sm text-slate-500 mt-1">
                Manage asset category data.
            </p>

        </div>

        <a
            href="/admin/asset-categories/create"
            class="inline-flex items-center justify-center bg-slate-900 hover:bg-slate-800 text-white px-5 py-3 rounded-xl transition"
        >
            + Add Category
        </a>

    </div>
    @if (session('success'))
        <div class="mb-6 p-4 rounded-xl bg-green-50 border border-green-200 text-green-800 text-sm font-medium flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-3 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('success') }}
        </div>
    @endif

    @if (session('info'))
        <div class="mb-6 p-4 rounded-xl bg-blue-50 border border-blue-200 text-blue-800 text-sm font-medium flex items-center shadow-sm">
            <svg class="w-5 h-5 mr-3 text-blue-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            {{ session('info') }}
        </div>
    @endif

    <!-- Table -->
    <div class="overflow-x-auto">

        <table class="w-full">

            <thead class="bg-slate-50">

                <tr>

                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">
                        Category Code
                    </th>

                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">
                        Category Name
                    </th>

                    <th class="px-4 py-3 text-left text-sm font-semibold text-slate-600">
                        Description
                    </th>

                    <th class="px-4 py-3 text-center text-sm font-semibold text-slate-600">
                        Action
                    </th>

                </tr>

            </thead>

            <tbody>

                @forelse($categories as $category)

                    <tr class="border-t border-slate-100 hover:bg-slate-50 transition">

                        <td class="px-4 py-4 font-medium text-slate-700">
                            {{ $category->kode_kategori }}
                        </td>

                        <td class="px-4 py-4 text-slate-700">
                            {{ $category->nama_kategori }}
                        </td>

                        <td class="px-4 py-4 text-slate-700 max-w-md">
                            {{ $category->deskripsi ?? '-' }}
                        </td>

                        <td class="px-4 py-4">

                            <div class="flex justify-center gap-2">

                                <a
                                    href="/admin/asset-categories/{{ $category->id }}/edit"
                                    class="inline-flex items-center px-3 py-2 bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition text-sm font-medium"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="/admin/asset-categories/{{ $category->id }}"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                >

                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="inline-flex items-center px-3 py-2 bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition text-sm font-medium"
                                    >
                                        Delete
                                    </button>

                                </form>

                            </div>

                        </td>

                    </tr>

                @empty

                    <tr>

                        <td
                            colspan="4"
                            class="text-center py-8 text-slate-500"
                        >
                            No asset categories found
                        </td>

                    </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


</x-app-layout>
