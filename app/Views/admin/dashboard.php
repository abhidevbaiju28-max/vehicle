<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - NSS College Rajakumari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-100 min-h-screen">
    <!-- Navbar -->
    <nav class="bg-white shadow-sm px-4 sm:px-6 py-4 flex flex-col sm:flex-row justify-between items-center space-y-3 sm:space-y-0 sticky top-0 z-50">
        <h1 class="text-lg sm:text-xl font-extrabold text-blue-600">NSS College Approver</h1>
        <div class="flex items-center space-x-4">
            <span class="text-xs font-bold text-gray-500 bg-gray-100 px-3 py-1 rounded-full">Admin: <?= session()->get('username') ?></span>
            <a href="<?= base_url('nssapprover/logout') ?>" class="text-xs font-extrabold text-red-500 hover:text-red-700 uppercase tracking-tighter">Logout</a>
        </div>
    </nav>

    <div class="px-3 sm:px-6 py-4 sm:py-8 min-h-[calc(100vh-64px)] flex flex-col">
        <!-- Filters -->
        <div class="bg-white rounded-2xl shadow-sm p-4 sm:p-6 mb-6">
            <form action="<?= base_url('nssapprover/dashboard') ?>" method="GET">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
                <div class="lg:col-span-2">
                    <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Search Student</label>
                    <input type="text" name="search" value="<?= $_GET['search'] ?? '' ?>" placeholder="Name or Registration..." class="w-full text-sm border-gray-100 rounded-xl p-3 bg-gray-50 outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                </div>
                <div>
                    <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Vehicle No</label>
                    <input type="text" name="vehicle_no" value="<?= $_GET['vehicle_no'] ?? '' ?>" placeholder="KL-00-XX-0000" class="w-full text-sm border-gray-100 rounded-xl p-3 bg-gray-50 outline-none focus:ring-2 focus:ring-blue-500 transition-all uppercase">
                </div>
                <div>
                    <label class="block text-[10px] font-extrabold text-gray-400 uppercase tracking-widest mb-1.5 ml-1">Status</label>
                    <select name="status" class="w-full text-sm border-gray-100 rounded-xl p-3 bg-gray-50 outline-none focus:ring-2 focus:ring-blue-500 transition-all">
                        <option value="">All Status</option>
                        <option value="pending" <?= ($_GET['status'] ?? '') === 'pending' ? 'selected' : '' ?>>Pending</option>
                        <option value="approved" <?= ($_GET['status'] ?? '') === 'approved' ? 'selected' : '' ?>>Approved</option>
                        <option value="rejected" <?= ($_GET['status'] ?? '') === 'rejected' ? 'selected' : '' ?>>Rejected</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <a href="<?= base_url('nssapprover/dashboard') ?>" class="bg-gray-100 text-gray-500 px-4 py-3 rounded-xl hover:bg-gray-200 transition flex items-center space-x-2" title="Reset Filters">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                        <span class="text-sm font-bold">Reset</span>
                    </a>
                </div>
            </div>
            </form>
        </div>

        <!-- Table Container -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse min-w-[800px]">
                    <thead class="bg-gray-50 border-b border-gray-100">
                        <tr>
                            <th class="px-5 py-4 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Student Info</th>
                            <th class="px-5 py-4 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Academic</th>
                            <th class="px-5 py-4 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Vehicle</th>
                            <th class="px-5 py-4 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest">Attachments</th>
                            <th class="px-5 py-4 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest text-center">Status</th>
                            <th class="px-5 py-4 text-[10px] font-extrabold text-gray-400 uppercase tracking-widest text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        <?php if(empty($permits)): ?>
                            <tr><td colspan="6" class="px-6 py-16 text-center text-gray-400">No applications were found matching your criteria.</td></tr>
                        <?php endif; ?>
                        <?php foreach($permits as $p): ?>
                        <tr class="hover:bg-blue-50/30 transition-colors">
                            <td class="px-5 py-5">
                                <div class="font-extrabold text-gray-900 text-sm"><?= $p['student_name'] ?></div>
                                <div class="text-[10px] font-bold text-blue-500 bg-blue-50 px-2 py-0.5 rounded-full inline-block mt-1">ID: #<?= str_pad($p['id'], 5, '0', STR_PAD_LEFT) ?></div>
                            </td>
                            <td class="px-5 py-5">
                                <div class="text-sm font-bold text-gray-700"><?= $p['course_year'] ?></div>
                                <div class="text-[10px] text-gray-400 font-bold uppercase tracking-tighter">Class: <?= $p['class_number'] ?></div>
                            </td>
                            <td class="px-5 py-5">
                                <div class="text-sm font-black text-blue-700 tracking-tight italic"><?= $p['vehicle_number'] ?></div>
                                <div class="text-[10px] text-gray-400 font-bold truncate max-w-[120px]">Own: <?= $p['rc_owner_name'] ?></div>
                            </td>
                            <td class="px-5 py-5">
                                <div class="flex flex-wrap gap-1.5">
                                    <?php foreach(['rc_file' => 'RC', 'license_file' => 'LIC', 'insurance_file' => 'INS', 'pollution_file' => 'POL', 'consent_file' => 'CNT'] as $file => $label): ?>
                                        <?php if($p[$file]): ?>
                                            <a href="<?= base_url('files/'.$p[$file]) ?>" target="_blank" class="text-[9px] bg-white px-2 py-1 rounded-md font-black text-gray-600 hover:text-blue-600 hover:border-blue-200 border border-gray-200 transition-all uppercase shadow-sm">
                                                <?= $label ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endforeach; ?>
                                </div>
                            </td>
                            <td class="px-5 py-5 text-center">
                                <span class="px-3 py-1 text-[10px] font-black rounded-lg uppercase shadow-sm
                                    <?= $p['status'] == 'approved' ? 'bg-green-100 text-green-700' : 
                                       ($p['status'] == 'rejected' ? 'bg-red-100 text-red-700' : 'bg-yellow-100 text-yellow-700') ?>">
                                    <?= $p['status'] ?>
                                </span>
                            </td>
                            <td class="px-5 py-5 text-right">
                                <div class="flex justify-end space-x-1.5">
                                    <button onclick="updateStatus(<?= $p['id'] ?>, 'approved')" class="bg-green-600 text-white p-2 rounded-xl hover:bg-green-700 active:scale-95 transition-all shadow-md shadow-green-100" title="Approve">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </button>
                                    <button onclick="updateStatus(<?= $p['id'] ?>, 'rejected')" class="bg-red-600 text-white p-2 rounded-xl hover:bg-red-700 active:scale-95 transition-all shadow-md shadow-red-100" title="Reject">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Pagination-like Info -->
            <div class="bg-gray-50 px-6 py-4 border-t border-gray-100 text-[10px] font-bold text-gray-400 uppercase tracking-widest flex justify-between items-center">
                <span>Total Applications: <?= count($permits) ?></span>
                <span class="text-blue-400">NSS College Digital Permit System &copy; <?= date('Y') ?></span>
            </div>
        </div>
    </div>

    <!-- CSRF Token for AJAX -->
    <input type="hidden" id="csrf_token" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>">

    <script>
        // Auto-submit filter form on input change
        document.addEventListener('DOMContentLoaded', function() {
            const filterForm = document.querySelector('form[action*="dashboard"]');
            const inputs = filterForm.querySelectorAll('input, select');
            
            inputs.forEach(input => {
                input.addEventListener('change', function() {
                    filterForm.submit();
                });
                
                // For text inputs, submit after user stops typing (debounce)
                if (input.type === 'text') {
                    let timeout;
                    input.addEventListener('input', function() {
                        clearTimeout(timeout);
                        timeout = setTimeout(() => {
                            filterForm.submit();
                        }, 800); // Wait 800ms after user stops typing
                    });
                }
            });
        });

        async function updateStatus(id, status) {
            if(!confirm(`Are you sure you want to ${status} this application?`)) return;

            const formData = new FormData();
            formData.append('id', id);
            formData.append('status', status);
            
            // Get CSRF token from hidden input (HttpOnly cookies cannot be read by JS)
            const csrfTokenName = '<?= csrf_token() ?>'; 
            const csrfTokenValue = document.getElementById('csrf_token').value;

            // Append CSRF token to form data as well, just in case
            formData.append(csrfTokenName, csrfTokenValue);

            try {
                const response = await fetch('<?= base_url('nssapprover/update') ?>', {
                    method: 'POST',
                    body: formData,
                    headers: { 
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfTokenValue
                    }
                });

                if (response.ok) {
                    window.location.reload();
                } else {
                    alert('Update failed. Permission denied or server error.');
                }
            } catch (error) {
                alert('Network error. Please check your connection.');
            }
        }
    </script>
</body>
</html>
