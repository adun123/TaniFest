<div class="max-w-6xl mx-auto px-4 py-6 grid grid-cols-1 md:grid-cols-3 gap-6">
  <!-- Sidebar -->
  <div class="border p-6 rounded-md flex flex-col justify-between">
    <div>
      <h3 class="text-gray-600 text-lg">Hai {{ Auth::user()->name }},</h3>
      <p class="text-gray-800 text-xl font-semibold">Atur <span class="font-bold">Keamanan Akun</span> anda disini</p>
      
      <button class="mt-6 w-full bg-green-600 text-white py-2 rounded-md">Aktivitas Login</button>
    </div>

    <!-- Logout Button -->
    <form method="POST" action="{{ route('logout') }}" class="mt-8">
      @csrf
      <button type="submit" class="border border-green-500 text-green-600 flex items-center gap-2 px-4 py-2 rounded-md hover:bg-green-50">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a2 2 0 002 2h3a2 2 0 002-2V7a2 2 0 00-2-2h-3a2 2 0 00-2 2v1" />
        </svg>
        Logout
      </button>
    </form>
  </div>

  <!-- Main Content -->
  <div class="md:col-span-2 border p-6 rounded-md">
    <h2 class="text-2xl font-bold mb-4">Aktivitas Login</h2>
    <p class="flex items-center gap-2 text-sm text-gray-600 mb-4">
      <span class="w-3 h-3 rounded-full bg-green-500 inline-block"></span>
      Bila terdapat aktivitas tidak dikenal, segera klik “Keluar” dan ubah kata sandi
    </p>

    <div class="mb-6">
      <p class="font-semibold text-gray-800">Aktivitas login saat ini</p>
      <div class="flex items-center gap-4 mt-2">
        <div class="w-6 h-6 bg-green-500"></div>
        <div>
          <p class="font-medium">Chrome di Windows 10</p>
          <p class="text-sm text-gray-500">182.253.194.48</p>
          <span class="inline-block mt-1 text-xs text-white bg-green-600 px-2 py-0.5 rounded">Sedang aktif</span>
        </div>
      </div>
    </div>

    <hr class="my-4">

    <div>
      <p class="font-semibold text-gray-800">Riwayat dalam 30 hari terakhir</p>
      <div class="flex items-center gap-4 mt-2">
        <div class="w-6 h-6 bg-green-500"></div>
        <div>
          <p class="font-medium">Chrome di Windows 10</p>
          <p class="text-sm text-gray-500">182.253.194.50</p>
          <p class="text-sm text-gray-400">Aktif 24 Mei 2024, 19.17</p>
        </div>
      </div>
    </div>
  </div>
</div>
