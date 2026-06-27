<x-app-layout>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <h1 class="text-2xl font-bold mb-6">
            Create Disposal Request
        </h1>

        @if($errors->any())

            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-4">

                <ul>

                    @foreach($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form
            method="POST"
            action="/admin/disposals"
        >

            @csrf

            <div class="mb-4">

                <label class="block mb-2">
                    Asset
                </label>

                <select
                    name="asset_id"
                    class="w-full border rounded-lg"
                >

                    <option value="">
                        Select Asset
                    </option>

                    @foreach($assets as $asset)

                        <option
                            value="{{ $asset->id }}"
                        >

                            {{ $asset->kode_asset }}
                            -
                            {{ $asset->nama_asset }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Type Disposal
                </label>

                <select
                    name="jenis_pelepasan"
                    class="w-full border rounded-lg"
                >

                    <option value="">
                        Select Type
                    </option>

                    <option value="dijual">
                        Dijual
                    </option>

                    <option value="dihibahkan">
                        Dihibahkan
                    </option>

                    <option value="dimusnahkan">
                        Dimusnahkan
                    </option>

                </select>

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Reason
                </label>

                <textarea
                    name="alasan"
                    rows="4"
                    class="w-full border rounded-lg"
                >{{ old('alasan') }}</textarea>

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Notes
                </label>

                <textarea
                    name="notes"
                    rows="3"
                    class="w-full border rounded-lg"
                >{{ old('notes') }}</textarea>

            </div>
        
        <div class="flex gap-3">

            <button
                type="submit"
                class="bg-red-600 text-white px-4 py-2 rounded-lg"
            >
                Save
            </button>

             <a 
                href="/admin/assets"
                class="bg-slate-200 hover:bg-slate-300 text-slate-700 px-6 py-3 rounded-xl transition"
            >
                Cancel
            </a>
            
        </div>    

        </form>
        </div>

    </div>

</x-app-layout>