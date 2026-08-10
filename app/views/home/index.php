<?php $this->view('partials/head', ['title' => $title ?? 'Pendaftaran Anggota Baru']) ?>

<body class="min-h-screen flex flex-col bg-[<?= THEME_SURFACE ?>] font-['Inter']">
    <?php $this->view('partials/header') ?>

    <main class="flex-grow container mx-auto px-4 max-w-[1200px] py-8 md:py-12">
        <div class="max-w-3xl mx-auto">
            <!-- Header -->
            <div class="text-center mb-8 md:mb-12">
                <div class="inline-flex items-center gap-2 bg-[<?= THEME_PRIMARY_CONTAINER ?>] text-white px-4 py-1.5 rounded-full text-sm font-semibold mb-4">
                    <span class="material-symbols-outlined text-[18px]">groups</span>
                    <span>Komunitas Remaja Pustaka</span>
                </div>
                <h1 class="font-['Plus_Jakarta_Sans'] text-3xl md:text-4xl font-bold text-[<?= THEME_ON_SURFACE ?>] mb-3">
                    Pendaftaran Anggota Baru
                </h1>
                <p class="text-base md:text-lg text-[<?= THEME_ON_SURFACE_VARIANT ?>] max-w-lg mx-auto">
                    Bergabunglah dan jadilah bagian dari komunitas literasi yang inspiratif
                </p>
            </div>

            <!-- Form -->
            <div class="bg-white rounded-xl md:rounded-2xl border border-[<?= THEME_OUTLINE_VARIANT ?>] p-6 md:p-8 shadow-sm">
                <?php if (!empty($errors)): ?>
                    <div class="mb-6 bg-red-50 border border-[<?= THEME_ERROR ?>] text-[<?= THEME_ERROR ?>] rounded-lg p-4">
                        <div class="flex items-start gap-3">
                            <span class="material-symbols-outlined text-[<?= THEME_ERROR ?>]">error</span>
                            <div>
                                <p class="font-semibold text-sm">Mohon perbaiki kesalahan berikut:</p>
                                <ul class="list-disc list-inside text-sm mt-1">
                                    <?php foreach ($errors as $error): ?>
                                        <li><?= htmlspecialchars($error) ?></li>
                                    <?php endforeach ?>
                                </ul>
                            </div>
                        </div>
                    </div>
                <?php endif ?>

                <?php if (!empty($error)): ?>
                    <div class="mb-6 bg-red-50 border border-[<?= THEME_ERROR ?>] text-[<?= THEME_ERROR ?>] rounded-lg p-4">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined text-[<?= THEME_ERROR ?>]">error</span>
                            <p class="text-sm"><?= htmlspecialchars($error) ?></p>
                        </div>
                    </div>
                <?php endif ?>

                <form id="registrationForm" action="<?= BASE_URL ?>/pendaftaran/submit" method="POST" class="space-y-6" enctype="multipart/form-data" novalidate>
                    <!-- Nama Lengkap -->
                    <div>
                        <label for="nama_lengkap" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                            Nama Lengkap <span class="text-[<?= THEME_ERROR ?>]">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="nama_lengkap" 
                                name="nama_lengkap" 
                                value="<?= htmlspecialchars($old['nama_lengkap'] ?? '') ?>"
                                class="w-full h-11 px-4 pr-11 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>]"
                                placeholder="Masukkan nama lengkap Anda"
                                minlength="3"
                                maxlength="100"
                                required
                            >
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[<?= THEME_OUTLINE ?>] text-[20px]">person</span>
                        </div>
                        <div class="mt-1 text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>] flex justify-between">
                            <span id="nama_lengkap_error" class="text-[<?= THEME_ERROR ?>] hidden"></span>
                            <span id="nama_lengkap_counter" class="text-[<?= THEME_ON_SURFACE_VARIANT ?>]">0/100</span>
                        </div>
                    </div>

                    <!-- Grid 2 Kolom: Tempat Lahir & Tanggal Lahir -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <!-- Tempat Lahir -->
                        <div>
                            <label for="tempat_lahir" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                                Tempat Lahir <span class="text-[<?= THEME_ERROR ?>]">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="tempat_lahir" 
                                name="tempat_lahir" 
                                value="<?= htmlspecialchars($old['tempat_lahir'] ?? '') ?>"
                                class="w-full h-11 px-4 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>]"
                                placeholder="Contoh: Jakarta"
                                required
                            >
                        </div>

                        <!-- Tanggal Lahir -->
                        <div>
                            <label for="tanggal_lahir" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                                Tanggal Lahir <span class="text-[<?= THEME_ERROR ?>]">*</span>
                            </label>
                            <input 
                                type="date" 
                                id="tanggal_lahir" 
                                name="tanggal_lahir" 
                                value="<?= htmlspecialchars($old['tanggal_lahir'] ?? '') ?>"
                                class="w-full h-11 px-4 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>]"
                                required
                            >
                        </div>
                    </div>

                    <!-- Alamat Rumah -->
                    <div>
                        <label for="alamat_rumah" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                            Alamat Rumah <span class="text-[<?= THEME_ERROR ?>]">*</span>
                        </label>
                        <textarea 
                            id="alamat_rumah" 
                            name="alamat_rumah" 
                            rows="2" 
                            class="w-full px-4 py-3 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>] resize-y"
                            placeholder="Masukkan alamat lengkap rumah Anda"
                            required
                        ><?= htmlspecialchars($old['alamat_rumah'] ?? '') ?></textarea>
                        <div class="mt-1 text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>] flex justify-between">
                            <span id="alamat_error" class="text-[<?= THEME_ERROR ?>] hidden"></span>
                            <span id="alamat_counter" class="text-[<?= THEME_ON_SURFACE_VARIANT ?>]">0/500</span>
                        </div>
                    </div>

                    <!-- Kelas & NIS Grid -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
                        <!-- Kelas -->
                        <div>
                            <label for="kelas" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                                Kelas <span class="text-[<?= THEME_ERROR ?>]">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="kelas" 
                                name="kelas" 
                                value="<?= htmlspecialchars($old['kelas'] ?? '') ?>"
                                class="w-full h-11 px-4 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>]"
                                placeholder="Contoh: XI IPA 1"
                                minlength="2"
                                maxlength="20"
                                required
                            >
                        </div>

                        <!-- NIS -->
                        <div>
                            <label for="nis" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                                NIS (Nomor Induk Siswa) <span class="text-[<?= THEME_ERROR ?>]">*</span>
                            </label>
                            <input 
                                type="text" 
                                id="nis" 
                                name="nis" 
                                value="<?= htmlspecialchars($old['nis'] ?? '') ?>"
                                class="w-full h-11 px-4 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>]"
                                placeholder="Minimal 8 digit angka"
                                maxlength="20"
                                required
                                inputmode="numeric"
                            >
                        </div>
                    </div>

                    <!-- Nomor Telepon -->
                    <div>
                        <label for="nomor_telepon" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                            Nomor Telepon / WhatsApp <span class="text-[<?= THEME_ERROR ?>]">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="tel" 
                                id="nomor_telepon" 
                                name="nomor_telepon" 
                                value="<?= htmlspecialchars($old['nomor_telepon'] ?? '') ?>"
                                class="w-full h-11 px-4 pr-11 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>]"
                                placeholder="Contoh: 081234567890"
                                maxlength="15"
                                required
                                inputmode="numeric"
                            >
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[<?= THEME_OUTLINE ?>] text-[20px]">call</span>
                        </div>
                    </div>

                    <!-- Motivasi Masuk -->
                    <div>
                        <label for="motivasi_masuk" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                            Motivasi Masuk Anggota KRP <span class="text-[<?= THEME_ERROR ?>]">*</span>
                        </label>
                        <textarea 
                            id="motivasi_masuk" 
                            name="motivasi_masuk" 
                            rows="3" 
                            class="w-full px-4 py-3 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>] resize-y"
                            placeholder="Ceritakan motivasi Anda bergabung dengan Komunitas Remaja Pustaka..."
                            required
                        ><?= htmlspecialchars($old['motivasi_masuk'] ?? '') ?></textarea>
                        <div class="mt-1 text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>] flex justify-between">
                            <span id="motivasi_error" class="text-[<?= THEME_ERROR ?>] hidden"></span>
                            <span id="motivasi_counter" class="text-[<?= THEME_ON_SURFACE_VARIANT ?>]">0/500</span>
                        </div>
                    </div>

                    <!-- Latar Belakang Organisasi -->
                    <div>
                        <label for="latar_belakang_organisasi" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                            Latar Belakang Organisasi saat di SMP/MTS <span class="text-[<?= THEME_ERROR ?>]">*</span>
                        </label>
                        <textarea 
                            id="latar_belakang_organisasi" 
                            name="latar_belakang_organisasi" 
                            rows="2" 
                            class="w-full px-4 py-3 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>] resize-y"
                            placeholder="Tuliskan pengalaman organisasi Anda saat di SMP/MTS (jika ada)"
                            required
                        ><?= htmlspecialchars($old['latar_belakang_organisasi'] ?? '') ?></textarea>
                    </div>

                    <!-- Upload Foto Bukti Follow IG -->
                    <div>
                        <label for="foto_bukti_follow" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                            Foto Bukti Follow Instagram 
                            <a href="https://www.instagram.com/krp_penjelajah_kata_/" target="_blank" class="text-[<?= THEME_PRIMARY_CONTAINER ?>] hover:text-[<?= THEME_PRIMARY ?>] underline hover:no-underline transition-colors font-bold">
                                @krp_penjelajah_kata_
                            </a>
                            <span class="text-[<?= THEME_ERROR ?>]">*</span>
                        </label>
                        <div class="relative">
                            <input 
                                type="file" 
                                id="foto_bukti_follow" 
                                name="foto_bukti_follow" 
                                accept="image/*"
                                class="w-full h-11 px-4 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>] file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-[<?= THEME_PRIMARY_CONTAINER ?>] file:text-white hover:file:bg-[<?= THEME_PRIMARY ?>] file:cursor-pointer cursor-pointer"
                                required
                            >
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[<?= THEME_OUTLINE ?>] text-[20px] pointer-events-none">photo_camera</span>
                        </div>
                        <p class="mt-1 text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>]">
                            <span class="material-symbols-outlined text-[14px] align-middle">info</span>
                            Upload screenshot bukti follow 
                            <a href="https://www.instagram.com/krp_penjelajah_kata_/" target="_blank" class="text-[<?= THEME_PRIMARY_CONTAINER ?>] hover:text-[<?= THEME_PRIMARY ?>] underline hover:no-underline transition-colors font-medium">
                                @krp_penjelajah_kata_
                            </a>
                            (format JPG, PNG, WEBP, maks 2MB)
                        </p>
                    </div>

                    <!-- Terms -->
                    <div class="flex items-start gap-3 pt-2">
                        <input 
                            type="checkbox" 
                            id="terms" 
                            name="terms" 
                            class="mt-0.5 w-4 h-4 rounded border-[<?= THEME_OUTLINE_VARIANT ?>] text-[<?= THEME_PRIMARY_CONTAINER ?>] focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:ring-2"
                            required
                        >
                        <label for="terms" class="text-sm text-[<?= THEME_ON_SURFACE_VARIANT ?>]">
                            Saya setuju dengan ketentuan keanggotaan dan bersedia berkontribusi aktif dalam komunitas.
                        </label>
                    </div>
                    <div id="terms_error" class="text-xs text-[<?= THEME_ERROR ?>] hidden">Anda harus menyetujui ketentuan</div>

                    <!-- Submit -->
                    <button 
                        type="submit" 
                        class="w-full h-11 bg-[<?= THEME_PRIMARY_CONTAINER ?>] hover:bg-[<?= THEME_PRIMARY ?>] text-white font-semibold rounded-lg transition-all duration-200 hover:shadow-lg active:scale-[0.98] text-sm flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                        id="submitBtn"
                    >
                        <span>Kirim Pendaftaran</span>
                        <span class="material-symbols-outlined text-[18px]">send</span>
                    </button>
                </form>
            </div>
        </div>
    </main>

    <?php $this->view('partials/footer') ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.getElementById('registrationForm');
            const submitBtn = document.getElementById('submitBtn');

            // Update counter function
            function updateCounter(inputId, counterId, maxLength) {
                const input = document.getElementById(inputId);
                const counter = document.getElementById(counterId);
                
                if (input && counter) {
                    input.addEventListener('input', function() {
                        const len = this.value.length;
                        counter.textContent = len + '/' + maxLength;
                        
                        if (len > maxLength) {
                            counter.style.color = '#ba1a1a';
                        } else {
                            counter.style.color = '#3d4a3d';
                        }
                    });
                }
            }

            // Update counters
            updateCounter('nama_lengkap', 'nama_lengkap_counter', 100);
            updateCounter('alamat_rumah', 'alamat_counter', 500);
            updateCounter('motivasi_masuk', 'motivasi_counter', 500);

            // Hanya angka untuk NIS dan Telepon
            ['nis', 'nomor_telepon'].forEach(function(fieldId) {
                const input = document.getElementById(fieldId);
                if (input) {
                    input.addEventListener('keypress', function(e) {
                        const char = String.fromCharCode(e.which);
                        if (!/[0-9]/.test(char)) {
                            e.preventDefault();
                        }
                    });

                    input.addEventListener('paste', function(e) {
                        const paste = (e.clipboardData || window.clipboardData).getData('text');
                        if (!/^[0-9]+$/.test(paste)) {
                            e.preventDefault();
                        }
                    });
                }
            });

            // Terms validation
            const termsCheckbox = document.getElementById('terms');
            const termsError = document.getElementById('terms_error');

            if (termsCheckbox) {
                termsCheckbox.addEventListener('change', function() {
                    if (this.checked) {
                        termsError.classList.add('hidden');
                        this.classList.remove('border-[#ba1a1a]');
                    } else {
                        termsError.classList.remove('hidden');
                        this.classList.add('border-[#ba1a1a]');
                    }
                });
            }

            // File upload caching and memory object replacement to avoid ERR_UPLOAD_FILE_CHANGED on mobile browsers
            const fileInput = document.getElementById('foto_bukti_follow');
            let cachedFileBlob = null;
            let cachedFileName = '';
            let cachedFileType = '';
            let isReadingFile = false;

            if (fileInput) {
                fileInput.addEventListener('change', function() {
                    const file = this.files[0];
                    if (file) {
                        isReadingFile = true;
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            cachedFileBlob = new Blob([e.target.result], { type: file.type });
                            cachedFileName = file.name;
                            cachedFileType = file.type;
                            isReadingFile = false;
                        };
                        reader.onerror = function() {
                            cachedFileBlob = null;
                            cachedFileName = '';
                            cachedFileType = '';
                            isReadingFile = false;
                            alert('Gagal membaca file. Silakan coba pilih file lain.');
                        };
                        reader.readAsArrayBuffer(file);
                    } else {
                        cachedFileBlob = null;
                        cachedFileName = '';
                        cachedFileType = '';
                        isReadingFile = false;
                    }
                });
            }

            // Form submit validation
            form.addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent native form submission completely to avoid ERR_UPLOAD_FILE_CHANGED and platform submission quirks

                if (isReadingFile) {
                    alert('Sedang memproses file gambar, silakan tunggu sebentar...');
                    return;
                }

                let isValid = true;

                // Validasi semua field
                const fields = {
                    nama_lengkap: {
                        validator: (val) => val.trim().length >= 3 && val.trim().length <= 100,
                        error: 'Nama lengkap minimal 3 karakter'
                    },
                    tempat_lahir: {
                        validator: (val) => val.trim().length >= 2,
                        error: 'Tempat lahir wajib diisi'
                    },
                    tanggal_lahir: {
                        validator: (val) => val.trim().length > 0,
                        error: 'Tanggal lahir wajib diisi'
                    },
                    alamat_rumah: {
                        validator: (val) => val.trim().length >= 5,
                        error: 'Alamat minimal 5 karakter'
                    },
                    kelas: {
                        validator: (val) => val.trim().length >= 2,
                        error: 'Kelas wajib diisi'
                    },
                    nis: {
                        validator: (val) => {
                            const cleaned = val.replace(/\D/g, '');
                            return cleaned.length >= 8;
                        },
                        error: 'NIS harus 8 digit atau lebih'
                    },
                    nomor_telepon: {
                        validator: (val) => {
                            const cleaned = val.replace(/\D/g, '');
                            return cleaned.length >= 10 && cleaned.length <= 15;
                        },
                        error: 'Nomor telepon harus 10-15 digit'
                    },
                    motivasi_masuk: {
                        validator: (val) => val.trim().length >= 10,
                        error: 'Motivasi minimal 10 karakter'
                    },
                    latar_belakang_organisasi: {
                        validator: (val) => val.trim().length >= 2,
                        error: 'Latar belakang organisasi wajib diisi'
                    }
                };

                Object.keys(fields).forEach(function(fieldId) {
                    const input = document.getElementById(fieldId);
                    const errorEl = document.getElementById(fieldId + '_error');
                    if (input && errorEl) {
                        const isValidField = fields[fieldId].validator(input.value);
                        if (!isValidField && input.value.length > 0) {
                            isValid = false;
                            input.classList.add('border-[#ba1a1a]');
                            errorEl.textContent = fields[fieldId].error;
                            errorEl.classList.remove('hidden');
                        } else if (input.value.length === 0) {
                            isValid = false;
                            input.classList.add('border-[#ba1a1a]');
                            errorEl.textContent = 'Field ini wajib diisi';
                            errorEl.classList.remove('hidden');
                        } else {
                            input.classList.remove('border-[#ba1a1a]');
                            errorEl.classList.add('hidden');
                        }
                    }
                });

                // Validasi file upload
                if (fileInput && fileInput.files.length === 0 && !cachedFileBlob) {
                    isValid = false;
                    fileInput.classList.add('border-[#ba1a1a]');
                } else if (fileInput && (fileInput.files.length > 0 || cachedFileBlob)) {
                    // Gunakan metadata dari file yang dipilih atau cache jika ada
                    const file = fileInput.files[0];
                    const fileSize = file ? file.size : (cachedFileBlob ? cachedFileBlob.size : 0);
                    const fileMime = file ? file.type : (cachedFileBlob ? cachedFileBlob.type : '');
                    
                    const allowedTypes = ['image/jpeg', 'image/png', 'image/webp'];
                    const maxSize = 2 * 1024 * 1024; // 2MB
                    
                    if (!allowedTypes.includes(fileMime)) {
                        isValid = false;
                        fileInput.classList.add('border-[#ba1a1a]');
                        alert('File harus berupa gambar (JPG, PNG, WEBP)');
                    } else if (fileSize > maxSize) {
                        isValid = false;
                        fileInput.classList.add('border-[#ba1a1a]');
                        alert('Ukuran file maksimal 2MB');
                    } else {
                        fileInput.classList.remove('border-[#ba1a1a]');
                    }
                }

                // Validasi terms
                if (!termsCheckbox.checked) {
                    isValid = false;
                    termsError.classList.remove('hidden');
                    termsCheckbox.classList.add('border-[#ba1a1a]');
                }

                if (!isValid) {
                    const firstError = document.querySelector('.border-[#ba1a1a]');
                    if (firstError) {
                        firstError.focus();
                        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    }
                    return;
                }

                // Loading state
                submitBtn.disabled = true;
                submitBtn.innerHTML = `
                    <span class="flex items-center gap-2">
                        <svg class="animate-spin h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        Memproses...
                    </span>
                `;

                // Kirim data via fetch API (AJAX) untuk bypass error file di mobile
                const formData = new FormData(form);
                if (cachedFileBlob) {
                    formData.set('foto_bukti_follow', cachedFileBlob, cachedFileName);
                }

                fetch(form.action, {
                    method: 'POST',
                    body: formData
                })
                .then(function(response) {
                    if (response.ok) {
                        return response.text();
                    }
                    throw new Error('Gagal mengirim data ke server.');
                })
                .then(function(html) {
                    // Update URL browser ke target action
                    try {
                        window.history.pushState({}, '', form.action);
                    } catch (e) {
                        console.error('History pushState failed:', e);
                    }
                    // Tulis ulang seluruh isi dokumen dengan HTML respons dari server
                    document.open();
                    document.write(html);
                    document.close();
                })
                .catch(function(err) {
                    console.error(err);
                    alert('Terjadi kesalahan koneksi atau server error saat mengirim pendaftaran. Silakan coba lagi.');
                    // Kembalikan tombol ke keadaan semula
                    submitBtn.disabled = false;
                    submitBtn.innerHTML = `
                        <span>Kirim Pendaftaran</span>
                        <span class="material-symbols-outlined text-[18px]">send</span>
                    `;
                });
            });

            // Reset error on focus
            document.querySelectorAll('input, textarea').forEach(function(el) {
                el.addEventListener('focus', function() {
                    this.classList.remove('border-[#ba1a1a]');
                    this.classList.add('border-[<?= THEME_OUTLINE_VARIANT ?>]');
                    const errorEl = document.getElementById(this.id + '_error');
                    if (errorEl) {
                        errorEl.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</body>
</html>