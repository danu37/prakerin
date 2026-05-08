
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Login Admin PKL</title>

  <script src="https://cdn.tailwindcss.com"></script>

  <style>
    body{
      font-family: 'Poppins', sans-serif;
    }
  </style>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center">

  <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid md:grid-cols-2">

    <!-- LEFT -->
    <div class="bg-blue-600 text-white p-10 flex flex-col justify-center">

      <h1 class="text-4xl font-bold mb-4">
        Sistem PKL SMK
      </h1>

      <p class="text-blue-100 leading-relaxed">
        Kelola data siswa, industri, penempatan PKL,
        dan jurnal kegiatan dengan mudah dan modern.
      </p>

      <div class="mt-10">
        <img 
          src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png"
          class="w-60 mx-auto"
        >
      </div>

    </div>

    <!-- RIGHT -->
    <div class="p-10 flex items-center">

      <div class="w-full">

        <div class="mb-8">
          <h2 class="text-3xl font-bold text-slate-800">
            Login Admin
          </h2>

          <p class="text-slate-500 mt-2">
            Silakan masuk untuk melanjutkan
          </p>
        </div>

        <form class="space-y-5">

          <!-- EMAIL -->
          <div>
            <label class="block mb-2 text-slate-700">
              Username
            </label>

            <input 
              type="text"
              placeholder="Masukkan username"
              class="w-full border border-slate-300 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500"
            >
          </div>

          <!-- PASSWORD -->
          <div>
            <label class="block mb-2 text-slate-700">
              Password
            </label>

            <input 
              type="password"
              placeholder="Masukkan password"
              class="w-full border border-slate-300 rounded-xl px-4 py-3 outline-none focus:ring-2 focus:ring-blue-500"
            >
          </div>

          <!-- REMEMBER -->
          <div class="flex items-center justify-between text-sm">

            <label class="flex items-center gap-2 text-slate-600">
              <input type="checkbox">
              Remember me
            </label>

            <a href="#" class="text-blue-600 hover:underline">
              Lupa password?
            </a>

          </div>

          <!-- BUTTON -->
          <button 
            type="submit"
            class="w-full bg-blue-600 hover:bg-blue-700 transition text-white py-3 rounded-xl font-semibold"
          >
            Login
          </button>

        </form>

      </div>

    </div>

  </div>

</body>
</html>

