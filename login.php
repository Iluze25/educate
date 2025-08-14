<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        include 'service/process_sign.php';
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Poppins', sans-serif; }
        .card-hover { transition: all 0.3s ease; }
        .card-hover:hover { transform: translateY(-5px); box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1); }
        .gradient-bg { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
        .feature-icon { transition: transform 0.3s ease; }
        .feature-icon:hover { transform: scale(1.1); }
    </style>
</head>
<body>
    <!-- Login Page -->
    <div id="loginPage" class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-500 via-purple-600 to-indigo-700">
        <div class="bg-white rounded-2xl shadow-2xl p-8 w-full max-w-md">
            <div class="text-center mb-8">
                <div class="text-6xl mb-4">📚</div>
                <h1 class="text-3xl font-bold text-gray-800 mb-2">Portal Guru SD</h1>
                <p class="text-gray-600">Masuk ke Dashboard Pembelajaran</p>
            </div>
            
            <form method="POST" id="loginForm" class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Username</label>
                    <input name="username" id="username" type="text" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan username" required>
                </div>
                
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input name="password" id="password" type="password" class="w-full p-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500" placeholder="Masukkan password" required>
                </div>
                
                <button type="submit" class="w-full bg-gradient-to-r from-blue-500 to-purple-600 text-white py-3 rounded-lg hover:from-blue-600 hover:to-purple-700 transition-all duration-300 font-medium">
                    Masuk
                </button>
            </form>
            
            <div class="mt-4 text-center">
                <button onclick="showSignup()" class="text-blue-600 hover:text-blue-800 text-sm underline">
                    Belum punya akun? Daftar di sini
                </button>
            </div>
            
            <div class="mt-6 p-4 bg-blue-50 rounded-lg">
                <p class="text-sm text-blue-800 font-medium mb-2">Demo Login:</p>
                <div class="text-xs text-blue-600 space-y-1">
                    <p><strong>Guru Kelas 5A:</strong> guru1 / guru123</p>
                    <p><strong>Guru Kelas 5B:</strong> guru2 / guru456</p>
                    <p><strong>Kepala Sekolah:</strong> kepsek / kepsek123</p>
                    <p><strong>Admin:</strong> admin / admin123</p>
                </div>
            </div>
            
            <div id="loginError" class="mt-4 p-3 bg-red-50 border border-red-200 rounded-lg text-red-700 text-sm hidden">
                Username atau password salah!
            </div>
        </div>
    </div>
</body>
</html>