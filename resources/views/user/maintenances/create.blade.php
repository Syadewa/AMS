<x-app-layout>

    <div class="max-w-3xl">
        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <h1 class="text-2xl font-bold mb-6">
            Report Maintenance
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
            action="/user/maintenances"
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

                    @foreach($assignments as $assignment)

                        <option
                            value="{{ $assignment->asset->id }}"
                        >

                            {{ $assignment->asset->kode_asset }}
                            -
                            {{ $assignment->asset->nama_asset }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-4">

                <label class="block mb-2">
                    Keluhan
                </label>

                <textarea
                    name="keluhan"
                    rows="5"
                    class="w-full border rounded-lg"
                >{{ old('keluhan') }}</textarea>

            </div>

            <button
                type="submit"
                class="bg-blue-600 text-white px-4 py-2 rounded-lg"
            >
                Submit Request
            </button>

        </form>
    </div>
    </div>

</x-app-layout>