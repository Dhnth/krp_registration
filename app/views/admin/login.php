<?php $this->view('partials/head', ['title' => $title ?? 'Login Admin']) ?>

<body class="min-h-screen flex flex-col bg-[<?= THEME_SURFACE ?>] font-['Inter']">
    <div class="flex-grow flex items-center justify-center px-4 py-8 md:py-12">
        <div class="w-full max-w-sm">
            <!-- Logo -->
            <div class="text-center mb-8">
                <div class="w-16 h-16 md:w-20 md:h-20 mx-auto bg-[<?= THEME_PRIMARY_CONTAINER ?>] rounded-2xl flex items-center justify-center mb-4 shadow-lg">
                    <span class="material-symbols-outlined text-white text-3xl md:text-4xl">admin_panel_settings</span>
                </div>
                <h1 class="font-['Plus_Jakarta_Sans'] text-xl md:text-2xl font-bold text-[<?= THEME_ON_SURFACE ?>]">
                    Admin Panel
                </h1>
                <p class="text-sm text-[<?= THEME_ON_SURFACE_VARIANT ?>]">
                    Masuk untuk mengelola pendaftaran
                </p>
            </div>

            <!-- Login Form -->
            <div class="bg-white rounded-xl md:rounded-2xl border border-[<?= THEME_OUTLINE_VARIANT ?>] p-6 md:p-8 shadow-sm">
                <?php if (!empty($error)): ?>
                    <div class="mb-4 bg-red-50 border border-[<?= THEME_ERROR ?>] text-[<?= THEME_ERROR ?>] rounded-lg p-3">
                        <div class="flex items-center gap-2">
                            <span class="material-symbols-outlined text-[<?= THEME_ERROR ?>] text-[20px]">error</span>
                            <p class="text-sm"><?= htmlspecialchars($error) ?></p>
                        </div>
                    </div>
                <?php endif ?>

                <form action="<?= BASE_URL ?>/admin/login" method="POST" class="space-y-5">
                    <!-- Username -->
                    <div>
                        <label for="username" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                            Username
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="username" 
                                name="username" 
                                class="w-full h-11 px-4 pr-11 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>]"
                                placeholder="Masukkan username"
                                required
                                value="dhanis"
                                autocomplete="username"
                            >
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[<?= THEME_OUTLINE ?>] text-[20px]">person</span>
                        </div>
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-semibold text-[<?= THEME_ON_SURFACE ?>] mb-1.5">
                            Password
                        </label>
                        <div class="relative">
                            <input 
                                type="password" 
                                id="password" 
                                name="password" 
                                class="w-full h-11 px-4 pr-11 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent transition-all text-sm bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>]"
                                placeholder="Masukkan password"
                                required
                                autocomplete="current-password"
                            >
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[<?= THEME_OUTLINE ?>] text-[20px]">lock</span>
                        </div>
                    </div>

                    <!-- Submit -->
                    <button 
                        type="submit" 
                        class="w-full h-11 bg-[<?= THEME_PRIMARY_CONTAINER ?>] hover:bg-[<?= THEME_PRIMARY ?>] text-white font-semibold rounded-lg transition-all duration-200 hover:shadow-lg active:scale-[0.98] text-sm flex items-center justify-center gap-2"
                    >
                        <span>Masuk</span>
                        <span class="material-symbols-outlined text-[18px]">login</span>
                    </button>
                </form>

                <div class="mt-4 text-center text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>]">
                    <span class="material-symbols-outlined text-[14px] align-middle">info</span>
                    Akses terbatas untuk admin komunitas
                </div>
            </div>
        </div>
    </div>

    <?php $this->view('partials/footer') ?>
</body>
</html>