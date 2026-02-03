<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vehicle Permit Registration - NSS College Rajakumari</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #fffaf5; }
        .orange-gradient { background: linear-gradient(135deg, #f59e0b 0%, #ea580c 100%); }
        .form-shadow { box-shadow: 0 10px 50px -12px rgba(234, 88, 12, 0.15); }
        .input-focus:focus { outline: none; border-color: #f59e0b; box-shadow: 0 0 0 4px rgba(245, 158, 11, 0.1); }
        .input-error { border-color: #ef4444 !important; box-shadow: 0 0 0 4px rgba(239, 68, 68, 0.1) !important; }
        input::placeholder { color: #9ca3af; font-size: 0.875rem; }
        .file-uploaded { border-color: #10b981 !important; background-color: #ecfdf5 !important; }
    </style>
</head>
<body class="min-h-screen">
    <!-- Main Wrapper -->
    <div class="flex flex-col min-h-screen">
        
        <!-- Header Section - Slim Navbar Style -->
        <header class="orange-gradient text-white py-4 px-4 sm:px-10 relative z-20 shadow-lg">
            <div class="max-w-xl mx-auto flex items-center justify-center">
                <div class="flex items-center space-x-3 sm:space-x-4">
                     <h1 class="text-lg sm:text-3xl font-extrabold uppercase tracking-wide whitespace-nowrap">
                        NSS COLLEGE <span class="text-amber-200">RAJAKUMARI</span>
                    </h1>
                </div>
            </div>
        </header>

        <!-- Form Card -->
        <main class="flex-grow px-4 pb-12 pt-8">
            <!-- Subheading -->
            <h2 class="text-center text-xl sm:text-3xl font-bold text-slate-800 mb-8 uppercase tracking-wide">
                Application For Two Wheelers Permit
            </h2>
            
            <div class="max-w-6xl mx-auto bg-white rounded-[2rem] form-shadow overflow-hidden border border-orange-50/50">
                <form id="permitForm" class="p-6 sm:p-10 lg:p-12 space-y-12" novalidate>
                    <?= csrf_field() ?>
                    
                    <!-- Progress Hint for Mobile -->
                    <div class="sm:hidden flex items-center justify-between text-[10px] font-bold text-orange-400 uppercase tracking-widest mb-6 border-b border-orange-50 pb-2">
                        <span>Step: Complete All Sections</span>
                        <span class="text-red-500">* Required</span>
                    </div>

                    <!-- 1. Student Identity -->
                    <div class="space-y-6">
                        <div class="flex items-center space-x-3">
                            <div class="bg-orange-500 w-2 h-8 rounded-full"></div>
                            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Student Identity</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Full Name <span class="text-red-500">*</span></label>
                                <input type="text" name="student_name" id="student_name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 input-focus transition-all font-semibold text-slate-800" placeholder="Enter your full legal name">
                                <p class="hidden text-xs text-red-500 font-bold mt-1" id="error_student_name"></p>
                            </div>
                            
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Academic Year <span class="text-red-500">*</span></label>
                                <input type="text" name="course_year" id="course_year" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 input-focus transition-all font-semibold text-slate-800" placeholder="e.g. B.Com 1st Year">
                                <p class="hidden text-xs text-red-500 font-bold mt-1" id="error_course_year"></p>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Class Number <span class="text-red-500">*</span></label>
                                <input type="text" name="class_number" id="class_number" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 input-focus transition-all font-semibold text-slate-800" placeholder="e.g. 1, 10">
                                <p class="hidden text-xs text-red-500 font-bold mt-1" id="error_class_number"></p>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Mobile Contact <span class="text-red-500">*</span></label>
                                <input type="tel" name="student_contact" id="student_contact" maxlength="10" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 input-focus transition-all font-semibold text-slate-800" placeholder="10-digit mobile number">
                                <p class="hidden text-xs text-red-500 font-bold mt-1" id="error_student_contact"></p>
                            </div>

                            <div class="md:col-span-2 space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Residential Address <span class="text-red-500">*</span></label>
                                <textarea name="student_address" id="student_address" rows="3" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 input-focus transition-all font-semibold text-slate-800 resize-none" placeholder="Enter your complete home address"></textarea>
                                <p class="hidden text-xs text-red-500 font-bold mt-1" id="error_student_address"></p>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Parent Contact <span class="text-red-500">*</span></label>
                                <input type="tel" name="parent_contact" id="parent_contact" maxlength="10" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 input-focus transition-all font-semibold text-slate-800" placeholder="Emergency contact number">
                                <p class="hidden text-xs text-red-500 font-bold mt-1" id="error_parent_contact"></p>
                            </div>
                        </div>
                    </div>

                    <!-- 2. Vehicle Verification -->
                    <div class="space-y-6 pt-4 border-t border-slate-100">
                        <div class="flex items-center space-x-3">
                            <div class="bg-amber-400 w-2 h-8 rounded-full"></div>
                            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Vehicle & License</h2>
                        </div>
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-6 gap-y-5">
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Registration Number <span class="text-red-500">*</span></label>
                                <input type="text" name="vehicle_number" id="vehicle_number" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 input-focus transition-all font-bold text-orange-600 uppercase tracking-widest placeholder:tracking-normal" placeholder="KL-XX-XX-0000">
                                <p class="hidden text-xs text-red-500 font-bold mt-1" id="error_vehicle_number"></p>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">RC Owner Name <span class="text-red-500">*</span></label>
                                <input type="text" name="rc_owner_name" id="rc_owner_name" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 input-focus transition-all font-semibold text-slate-800" placeholder="Name as per RC book">
                                <p class="hidden text-xs text-red-500 font-bold mt-1" id="error_rc_owner_name"></p>
                            </div>

                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-500 uppercase tracking-wider ml-1">Driving License No. <span class="text-red-500">*</span></label>
                                <input type="text" name="license_number" id="license_number" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-5 input-focus transition-all font-bold text-slate-800 uppercase" placeholder="Enter DL Number">
                                <p class="hidden text-xs text-red-500 font-bold mt-1" id="error_license_number"></p>
                            </div>
                        </div>
                    </div>

                    <!-- 3. Mandatory Documents -->
                    <div class="space-y-6 pt-4 border-t border-slate-100">
                        <div class="flex items-center space-x-3">
                            <div class="bg-slate-900 w-2 h-8 rounded-full"></div>
                            <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Technical Documents</h2>
                        </div>
                        <p class="text-sm font-medium text-orange-500 bg-orange-50 px-4 py-2 rounded-xl inline-block">
                            Required: Clear photos of original documents
                        </p>
                        
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                            <!-- Helper for File Input -->
                            <?php 
                            $docs = [
                                'rc_file' => ['title' => 'RC Book', 'color' => 'bg-orange-500', 'ring' => 'ring-orange-50'],
                                'license_file' => ['title' => 'License', 'color' => 'bg-amber-500', 'ring' => 'ring-amber-50'],
                                'insurance_file' => ['title' => 'Insurance', 'color' => 'bg-orange-600', 'ring' => 'ring-orange-50'],
                                'pollution_file' => ['title' => 'Pollution', 'color' => 'bg-orange-400', 'ring' => 'ring-orange-50'],
                            ];
                            foreach($docs as $name => $meta): 
                            ?>
                            <div class="relative group cursor-pointer file-container" id="container_<?= $name ?>">
                                <input type="file" name="<?= $name ?>" id="<?= $name ?>" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="validateFile(this)">
                                <div class="h-32 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center space-y-2 group-hover:border-orange-400 transition-all group-hover:bg-orange-50/30 ui-box">
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] group-hover:text-orange-500"><?= $meta['title'] ?> *</span>
                                    <div class="<?= $meta['color'] ?> p-2 rounded-xl shadow-lg ring-4 <?= $meta['ring'] ?> group-hover:scale-110 transition-transform">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <!-- Tick Mark -->
                                    <div class="absolute top-2 right-2 hidden check-icon">
                                        <svg class="w-6 h-6 text-emerald-500 bg-white rounded-full p-1 shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </div>
                                <p class="hidden text-[10px] text-red-500 font-bold text-center mt-1" id="error_<?= $name ?>"></p>
                            </div>
                            <?php endforeach; ?>

                            <!-- Consent -->
                            <div class="relative group cursor-pointer sm:col-span-2 file-container" id="container_consent_file">
                                <input type="file" name="consent_file" id="consent_file" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="validateFile(this)">
                                <div class="h-32 bg-slate-50 border-2 border-dashed border-slate-200 rounded-2xl flex flex-col items-center justify-center space-y-2 group-hover:border-orange-400 transition-all group-hover:bg-orange-50/30 ui-box">
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] group-hover:text-orange-500">Owner Consent(If App. is not Owner)</span>
                                    <div class="bg-slate-800 p-2 rounded-xl shadow-lg ring-4 ring-slate-100 group-hover:scale-110 transition-transform">
                                        <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <div class="absolute top-2 right-2 hidden check-icon">
                                        <svg class="w-6 h-6 text-emerald-500 bg-white rounded-full p-1 shadow-sm" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Action -->
                    <div class="pt-10">
                        <button type="submit" id="submitBtn" class="w-full orange-gradient text-white py-4 rounded-2xl text-lg font-black uppercase tracking-wider shadow-xl shadow-orange-100 active:scale-[0.98] transition-all hover:brightness-110">
                            Submit Registration
                        </button>
                        <p id="msg" class="mt-6 text-center text-sm font-bold opacity-0 transition-opacity"></p>
                    </div>
                </form>
            </div>
        </main>

        <footer class="py-10 text-center text-slate-400">
            <p class="text-xs font-bold uppercase tracking-[0.3em]">NSS College Rajakumari &copy; 2025</p>
        </footer>
    </div>

    <script>
        // Validation Rules
        const rules = {
            student_name: { required: true, min: 3, msg: 'Full name is required (min 3 chars)' },
            course_year: { required: true, msg: 'Course & Year is required' },
            class_number: { required: true, msg: 'Class number is required' },
            student_contact: { required: true, pattern: /^\d{10}$/, msg: 'Enter a valid 10-digit mobile number' },
            student_address: { required: true, msg: 'Address is required' },
            parent_contact: { required: true, pattern: /^\d{10}$/, msg: 'Enter a valid 10-digit parent contact' },
            vehicle_number: { required: true, msg: 'Vehicle number is required' },
            rc_owner_name: { required: true, msg: 'RC Owner Name is required' },
            license_number: { required: true, msg: 'License Number is required' },
        };

        const fileFields = ['rc_file', 'license_file', 'insurance_file', 'pollution_file'];

        // Real-time Validation for Text Inputs
        Object.keys(rules).forEach(field => {
            const input = document.getElementById(field);
            if(input) {
                input.addEventListener('input', () => validateField(field));
                input.addEventListener('blur', () => validateField(field));
            }
        });

        function validateField(fieldName) {
            const input = document.getElementById(fieldName);
            const errEl = document.getElementById('error_' + fieldName);
            const rule = rules[fieldName];
            
            let isValid = true;
            let errMsg = '';

            if (rule.required && !input.value.trim()) {
                isValid = false;
                errMsg = rule.msg; // Default required message
            } else if (rule.min && input.value.trim().length < rule.min) {
                isValid = false;
                errMsg = `Must be at least ${rule.min} characters`;
            } else if (rule.pattern && !rule.pattern.test(input.value.trim())) {
                isValid = false;
                errMsg = rule.msg;
            }

            if (!isValid) {
                input.classList.add('input-error');
                errEl.textContent = errMsg;
                errEl.classList.remove('hidden');
            } else {
                input.classList.remove('input-error');
                errEl.classList.add('hidden');
            }
            return isValid;
        }

        function validateFile(input) {
            const container = document.getElementById('container_' + input.id);
            const errEl = document.getElementById('error_' + input.id);
            const uiBox = container.querySelector('.ui-box');
            const checkIcon = container.querySelector('.check-icon');

            if (input.files && input.files[0]) {
                // File selected
                uiBox.classList.add('file-uploaded', 'border-emerald-500');
                checkIcon.classList.remove('hidden');
                errEl.classList.add('hidden');
                return true;
            } else {
                // No file (or cleared)
                uiBox.classList.remove('file-uploaded', 'border-emerald-500');
                checkIcon.classList.add('hidden');
                
                // Only show error if it's a required field
                if (fileFields.includes(input.id)) {
                    errEl.textContent = 'Document required';
                    errEl.classList.remove('hidden');
                    return false;
                }
                return true;
            }
        }

        document.getElementById('permitForm').addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Validate All Fields
            let isFormValid = true;
            
            // 1. Text Fields
            Object.keys(rules).forEach(field => {
                if (!validateField(field)) isFormValid = false;
            });

            // 2. File Fields
            fileFields.forEach(field => {
                const input = document.getElementById(field);
                if (!validateFile(input)) isFormValid = false;
            });

            if (!isFormValid) {
                // Shake header or something to indicate error
                const msg = document.getElementById('msg');
                msg.className = 'mt-6 text-center text-sm font-bold text-red-500 opacity-100';
                msg.textContent = 'Please correct the errors highlighting in red before submitting.';
                return;
            }

            const btn = document.getElementById('submitBtn');
            const msg = document.getElementById('msg');
            const formData = new FormData(this);

            btn.disabled = true;
            btn.innerHTML = '<span class="animate-pulse">PROCESSING...</span>';
            msg.className = 'mt-6 text-center text-sm font-bold text-orange-500 opacity-100';
            msg.textContent = 'Uploading secure files, please wait...';

            try {
                const response = await fetch('<?= base_url('permit/submit') ?>', {
                    method: 'POST',
                    body: formData,
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                });

                const result = await response.json();

                if (response.ok) {
                    msg.className = 'mt-6 text-center text-sm font-bold text-emerald-600 opacity-100';
                    msg.innerHTML = `SUCCESS: ${result.message} <br><br> <a href="<?= base_url('permit/download/') ?>${result.id}" class="inline-flex items-center px-8 py-3 bg-emerald-600 text-white rounded-2xl font-black hover:bg-emerald-700 transition-all shadow-xl shadow-emerald-100 uppercase tracking-wider text-xs">Get Your PDF Now</a>`;
                    this.reset();
                    // Reset file styles
                    document.querySelectorAll('.file-container').forEach(c => {
                        c.querySelector('.ui-box').classList.remove('file-uploaded', 'border-emerald-500');
                        c.querySelector('.check-icon').classList.add('hidden');
                    });
                } else {
                    msg.className = 'mt-6 text-center text-sm font-bold text-red-500 opacity-100';
                    
                    if (result.errors) {
                        msg.textContent = 'Validation failed. Please check the fields below.';
                        // Map backend errors to fields
                        for (const [key, value] of Object.entries(result.errors)) {
                            const errEl = document.getElementById('error_' + key);
                            const input = document.getElementById(key);
                            if (errEl) {
                                errEl.textContent = value;
                                errEl.classList.remove('hidden');
                                if(input) input.classList.add('input-error');
                            } else {
                                // If error key doesn't match an element (e.g. 'global'), show it in the main message
                                msg.innerHTML += '<br><span class="text-xs">' + value + '</span>';
                            }
                        }
                    } else {
                        msg.textContent = result.message || 'Submission failed.';
                    }
                }
            } catch (error) {
                console.error(error);
                msg.className = 'mt-6 text-center text-sm font-bold text-red-500 opacity-100';
                msg.textContent = 'Server connection lost. Try again later.';
            } finally {
                btn.disabled = false;
                btn.innerHTML = 'Submit Registration';
            }
        });
    </script>
</body>
</html>
