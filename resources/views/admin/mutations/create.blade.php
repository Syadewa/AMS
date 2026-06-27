<x-app-layout>

    <div class="max-w-3xl">

        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm p-6">
        <h1 class="text-2xl font-bold mb-6">
            Create Asset Mutation
        </h1>

        @if ($errors->any())

            <div class="bg-red-100 text-red-700 p-4 mb-4">

                <ul>

                    @foreach ($errors->all() as $error)

                        <li>{{ $error }}</li>

                    @endforeach

                </ul>

            </div>

        @endif

        <form
            method="POST"
            action="/admin/mutations"
        >

            @csrf

            <div class="mb-4">

                <label>
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

                        <option value="{{ $asset->id }}"
                                data-type="{{ $asset->tipe_asset }}"
                                data-user="{{ optional($asset->assignments->first()?->user)->name }}"
                                data-department="{{ optional($asset->assignments->first()?->department)->nama_department }}"
                        >

                            {{ $asset->kode_asset }}
                            -
                            {{ $asset->nama_asset }}

                        </option>

                    @endforeach

                </select>

            </div>

            {{-- Current Assignment Info --}}
            <div
                id="current-holder-info"
                class="bg-slate-50 rounded-lg p-4 mb-4 hidden"
            >

                <h3 class="font-semibold mb-2">
                    Current Assignment
                </h3>

                <p id="current-user-row" class="hidden">
                    Current User :
                    <span id="current-user">-</span>
                </p>

                <p id="current-department-row" class="hidden">
                    Current Department :
                    <span id="current-department">-</span>
                </p>

            </div>

            <div id="to-user-section" class="mb-4 hidden">

                <label>
                    To User
                </label>

                <select
                    name="to_user_id"
                    class="w-full border rounded-lg"
                >

                    <option value="">
                        Select User
                    </option>

                    @foreach($users as $user)

                        <option value="{{ $user->id }}">

                            {{ $user->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div id="to-department-section" class="mb-4 hidden" >

                <label>
                    To Department
                </label>

                <select
                    name="to_department_id"
                    class="w-full border rounded-lg"
                >

                    <option value="">
                        Select Department
                    </option>

                    @foreach($departments as $department)

                        <option value="{{ $department->id_department }}">

                            {{ $department->nama_department }}

                        </option>

                    @endforeach

                </select>

            </div>

            <div class="mb-4">

                <label>
                    Mutation Date
                </label>

                <input
                    type="datetime-local"
                    name="tanggal_mutasi"
                    class="w-full border rounded-lg"
                >

            </div>

            <div class="mb-4">

                <label>
                    Notes
                </label>

                <textarea
                    name="notes"
                    class="w-full border rounded-lg"
                ></textarea>

            </div>

         <div class="flex gap-3" >   

            <button
                type="submit"
                class="bg-slate-900 text-white px-4 py-2 rounded-lg"
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

   <script>

        document
            .querySelector('select[name="asset_id"]')
            .addEventListener('change', function() {

                let selected =
                    this.options[this.selectedIndex];

                let user =
                    selected.dataset.user ?? '-';

                let department =
                    selected.dataset.department ?? '-';

                let assetType =
                    selected.dataset.type;

                if (!assetType) {
                    
                    userSection.classList.add('hidden');
                    departmentSection.classList.add('hidden');

                    return;
                }

                document
                    .getElementById('current-user')
                    .innerText = user || '-';

                document
                    .getElementById('current-department')
                    .innerText = department || '-';

                document
                    .getElementById('current-holder-info')
                    .classList.remove('hidden');

                let userSection =
                    document.getElementById('to-user-section');

                let departmentSection =
                    document.getElementById('to-department-section');
                
                let currentUserRow =
                    document.getElementById('current-user-row');

                let currentDepartmentRow =
                    document.getElementById('current-department-row');

                document.querySelector('select[name="to_user_id"]')
                    .value = '';
                
                document.querySelector('select[name="to_department_id"]')
                    .value = '';

                if (assetType === 'individual') {
                    userSection.classList.remove('hidden');
                    departmentSection.classList.add('hidden');

                    currentUserRow.classList.remove('hidden');
                    currentDepartmentRow.classList.add('hidden');

                } else if (assetType === 'shared') {
                    departmentSection.classList.remove('hidden');
                    userSection.classList.add('hidden');

                    currentDepartmentRow.classList.remove('hidden');
                    currentUserRow.classList.add('hidden');

                } 
            });

    </script>

</x-app-layout>