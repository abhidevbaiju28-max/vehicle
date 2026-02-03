<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - NSS College Rajakumari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-slate-900 min-h-screen flex items-center justify-center p-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden p-8">
            <div class="text-center mb-8">
                <h1 class="text-2xl font-bold text-gray-900">NSS Admin Portal</h1>
                <p class="text-gray-500 text-sm mt-1">Please sign in to manage permits</p>
            </div>

            <form id="loginForm" class="space-y-6">
                <?= csrf_field() ?>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="username" required class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" name="password" required class="mt-1 block w-full px-4 py-3 rounded-lg border border-gray-300 focus:ring-2 focus:ring-blue-500 focus:border-transparent outline-none transition">
                </div>
                <div>
                    <button type="submit" id="submitBtn" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg shadow-lg transform active:scale-95 transition-all">
                        Sign In
                    </button>
                </div>
                <p id="msg" class="text-center text-sm font-medium"></p>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('loginForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            const btn = document.getElementById('submitBtn');
            const msg = document.getElementById('msg');
            const formData = new FormData(this);

            btn.disabled = true;
            btn.innerHTML = 'Securing session...';
            msg.className = 'text-center text-sm font-medium text-gray-500';
            msg.textContent = '';

            try {
                const response = await fetch('<?= base_url('nssapprover/auth') ?>', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                const result = await response.json();

                if (response.ok) {
                    msg.classList.add('text-green-600');
                    msg.textContent = 'Success! Redirecting...';
                    window.location.href = '<?= base_url('nssapprover/dashboard') ?>';
                } else {
                    msg.classList.add('text-red-600');
                    msg.textContent = result.message || 'Invalid credentials';
                }
            } catch (error) {
                msg.classList.add('text-red-600');
                msg.textContent = 'Server connection error.';
            } finally {
                btn.disabled = false;
                btn.innerHTML = 'Sign In';
            }
        });
    </script>
</body>
</html>
