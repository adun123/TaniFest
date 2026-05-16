<x-app-layout>
    <section class="market-container py-10">
        <div class="market-card p-5 sm:p-8">
            <div class="mb-8 text-center"><p class="market-eyebrow">Account settings</p><h1 class="market-heading">Pengaturan</h1><p class="mt-3 text-[#66725f]">Kelola profil, alamat pengiriman, serta keamanan akun Tani Feast.</p></div>
            <div class="mb-6 grid gap-3 border-b border-[#dfe8cf] pb-4 md:grid-cols-3">
                <button onclick="showTab('profileTab')" class="tab-btn rounded-full px-6 py-3 text-center font-black text-[#3f503c]" id="btnProfile">User Profile</button>
                <button onclick="showTab('alamatTab')" class="tab-btn rounded-full px-6 py-3 text-center font-black text-[#3f503c]" id="btnAlamat">Alamat</button>
                <button onclick="showTab('privacyTab')" class="tab-btn rounded-full px-6 py-3 text-center font-black text-[#3f503c]" id="btnPrivacy">Keamanan dan Privasi</button>
            </div>
            <div class="space-y-4"><div id="profileTab" class="tab-content">@include('profile.partials.update-profile-information-form')</div><div id="alamatTab" class="tab-content hidden">@include('profile.alamat')</div><div id="privacyTab" class="tab-content hidden">@include('profile.privacy')</div></div>
            <script>function showTab(tabId) { document.querySelectorAll('.tab-content').forEach(tab => tab.classList.add('hidden')); document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('bg-green-600', 'text-white', 'font-semibold', 'rounded-t-md')); document.getElementById(tabId).classList.remove('hidden'); let buttonId = 'btn' + tabId.charAt(0).toUpperCase() + tabId.slice(1).replace('Tab', ''); document.getElementById(buttonId).classList.add('bg-green-600', 'text-white', 'font-semibold', 'rounded-t-md'); } window.onload = () => showTab('profileTab');</script>
        </div>
    </section>
</x-app-layout>
