<x-app-layout>
  

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            {{-- Breadcrumb & Tabs --}}
            <div class="bg-white shadow sm:rounded-lg p-6">
                {{-- Breadcrumb --}}
                {{-- <nav class="text-sm text-gray-500 mb-4" aria-label="Breadcrumb">
                    <ol class="flex space-x-2">
                        <li>
                            <a href="{{ route('customer.dashboard') }}" class="hover:underline text-blue-600">Home</a>
                            <span class="mx-2">/</span>
                        </li>
                        <li class="text-gray-600">Pengaturan</li>
                    </ol>
                </nav> --}}

                {{-- Heading --}}
                <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Pengaturan</h2>

                {{-- Tabs --}}
                <div class="flex justify-between mb-6 border-b border-gray-300 space-x-4">
                    <button onclick="showTab('profileTab')" class="tab-btn px-6 py-2 w-full text-center" id="btnProfile">
                        User Profile
                    </button>
                    <button onclick="showTab('alamatTab')" class="tab-btn px-6 py-2 w-full text-center" id="btnAlamat">
                        Alamat
                    </button>
                    <button onclick="showTab('privacyTab')" class="tab-btn px-6 py-2 w-full text-center" id="btnPrivacy">
                        Keamanan dan Privasi
                    </button>
                </div>


                {{-- Tab Contents --}}
                <div class=" p-6 rounded-lg  space-y-4">
                    <div id="profileTab" class="tab-content">
                        {{-- Isi konten tab User Profile --}}
                        
                        @include('profile.partials.update-profile-information-form')
                    </div>

                    <div id="alamatTab" class="tab-content hidden">
                        {{-- Isi konten tab Alamat --}}
                       
                        @include('profile.alamat')
                    </div>

                    <div id="privacyTab" class="tab-content hidden">
                        {{-- Isi konten tab Keamanan dan Privasi --}}
                        
                        @include('profile.privacy')
                    </div>
                </div>

            {{-- Script tabs --}}
            <script>
                function showTab(tabId) {
                    // Sembunyikan semua tab
                    document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden'));
                    // Hilangkan warna aktif di semua tombol
                    document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('bg-green-600', 'text-white', 'font-semibold', 'rounded-t-md'));

                    // Tampilkan tab yang dipilih
                    document.getElementById(tabId).classList.remove('hidden');

                    // Tambahkan warna aktif ke tombol yang diklik
                    let buttonId = 'btn' + tabId.charAt(0).toUpperCase() + tabId.slice(1).replace('Tab', '');
                    document.getElementById(buttonId).classList.add('bg-green-600', 'text-white', 'font-semibold', 'rounded-t-md');
                }

                // Tampilkan default tab saat halaman pertama kali dibuka
                window.onload = () => showTab('profileTab');
            </script>
            </div>

            {{-- Konten Form Profile --}}
            </div>

            
        </div>
    </div>
</x-app-layout>

{{-- Konten Form Profile
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-5xl mx-auto">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div> --}}