<?php
session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>signup</title>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
    <link href="/dist/styles.css" rel="stylesheet">
    <style>
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap");
      body {
        font-family: "Poppins", sans-serif;
      }
      .card-hover {
        transition: all 0.3s ease;
      }
      .card-hover:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1);
      }
      .gradient-bg {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      }
      .feature-icon {
        transition: transform 0.3s ease;
      }
      .feature-icon:hover {
        transform: scale(1.1);
      }
    </style>
  </head>
  <body>
    <!-- Signup Page -->
    <div
      id="signupPage"
      class="min-h-screen flex items-center justify-center bg-gradient-to-br from-green-500 via-teal-600 to-blue-700"
    >
      <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
        <div class="text-center mb-8">
          <div class="text-6xl mb-4">👨‍🏫</div>
          <h1 class="text-3xl font-bold text-gray-800 mb-2">
            Daftar Akun Baru
          </h1>
          <p class="text-gray-600">Buat akun guru untuk mengakses portal</p>
        </div>

        <form id="signupForm" class="space-y-6" action="service/process_signup.php" method="POST">
          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
              >Nama Lengkap</label
            >
            <input
              id="signupName"
              type="text"
              class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
              placeholder="Contoh: Bu Sari Wijayanti"
              name="name"
              required
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
              >Username</label
            >
            <input
              id="signupUsername"
              type="text"
              class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
              placeholder="Contoh: sari_guru"
              name="username"
              required
            />
            <p class="text-xs text-gray-500 mt-1">
              Username harus unik dan minimal 4 karakter
            </p>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
              >Password</label
            >
            <input
              id="signupPassword"
              type="password"
              class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
              placeholder="Minimal 6 karakter"
              name="password"
              required
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
              >Konfirmasi Password</label
            >
            <input
              id="signupPasswordConfirm"
              type="password"
              class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
              placeholder="Ulangi password" name="confirm_password"
              required
            />
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
              >Permission</label
            >
            <select
              id="signupRole"
              class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-green-500"
              name="premission"
              required
            >
              <option value="">-- Pilih Kategori --</option>
              <option value="Guru">Guru</option>
              <option value="Administrator">Administrator</option>
            </select>
          </div>

          <div>
            <label class="block text-sm font-medium text-gray-700 mb-2"
              >Avatar</label
            >
            <div class="flex space-x-3">
              <button
                type="button"
                onclick="selectAvatar('👩‍🏫')"
                class="avatar-btn p-3 border-2 border-gray-300 rounded-lg hover:border-green-500 transition-colors"
              >
                👩‍🏫
              </button>
              <button
                type="button"
                onclick="selectAvatar('👨‍🏫')"
                class="avatar-btn p-3 border-2 border-gray-300 rounded-lg hover:border-green-500 transition-colors"
              >
                👨‍🏫
              </button>
              <button
                type="button"
                onclick="selectAvatar('👩‍💼')"
                class="avatar-btn p-3 border-2 border-gray-300 rounded-lg hover:border-green-500 transition-colors"
              >
                👩‍💼
              </button>
              <button
                type="button"
                onclick="selectAvatar('👨‍💼')"
                class="avatar-btn p-3 border-2 border-gray-300 rounded-lg hover:border-green-500 transition-colors"
              >
                👨‍💼
              </button>
              <button
                type="button"
                onclick="selectAvatar('👤')"
                class="avatar-btn p-3 border-2 border-gray-300 rounded-lg hover:border-green-500 transition-colors"
              >
                👤
              </button>
            </div>
            <input type="hidden" id="selectedAvatar" value="👩‍🏫" />
          </div>

          <button
            type="submit"
            class="w-full bg-gradient-to-r from-green-500 to-teal-600 text-white py-3 rounded-lg hover:from-green-600 hover:to-teal-700 transition-all duration-300 font-medium"
          >
            Daftar Akun
          </button>
        </form>

        <div class="mt-4 text-center">
          <button
            onclick="showLogin()"
            class="text-green-600 hover:text-green-800 text-sm underline"
          >
            Sudah punya akun? Masuk di sini
          </button>
        </div>

        <div
          id="signupError"
          class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm hidden"
        >
          <!-- Error message will be shown here -->
        </div>

        <div
          id="signupSuccess"
          class="mt-4 p-3 bg-green-50 border border-green-200 rounded-lg text-green-700 text-sm hidden"
        >
          <!-- Success message will be shown here -->
        </div>
      </div>
    </div>
    <script src="script.js"></script>
  </body>
</html>
