<?php $this->view('partials/head', ['title' => $title ?? 'Pendaftaran Berhasil']) ?>

<body class="bg-[<?= THEME_SURFACE ?>] text-[<?= THEME_ON_SURFACE ?>] font-body-md">
    <?php $this->view('partials/header') ?>

    <main class="pt-xxl min-h-screen flex items-center justify-center px-gutter">
        <div class="max-w-md w-full text-center">
            <div class="w-24 h-24 mx-auto bg-green-100 rounded-full flex items-center justify-center mb-6">
                <span class="material-symbols-outlined text-5xl text-[<?= THEME_PRIMARY_CONTAINER ?>]">check_circle</span>
            </div>

            <h1 class="font-display-lg text-display-lg-mobile md:text-display-lg text-[<?= THEME_ON_SURFACE ?>] mb-3">
                Pendaftaran Berhasil!
            </h1>
            
            <p class="text-body-lg text-body-lg text-[<?= THEME_ON_SURFACE_VARIANT ?>] mb-6">
                Terima kasih <strong class="text-[<?= THEME_ON_SURFACE ?>]"><?= htmlspecialchars($nama ?? '') ?></strong> telah mendaftar di Komunitas Remaja Pustaka.
            </p>

            <div class="bg-[<?= THEME_SURFACE_CONTAINER_LOWEST ?>] rounded-xl border border-[#E2E8F0] p-8 text-left shadow-sm mb-6">
                <div class="flex items-start gap-3">
                    <span class="material-symbols-outlined text-[<?= THEME_PRIMARY_CONTAINER ?>]">info</span>
                    <div>
                        <h3 class="font-headline-sm text-headline-sm text-[<?= THEME_ON_SURFACE ?>] mb-1">
                            Langkah Selanjutnya
                        </h3>
                        <ul class="text-body-md text-body-md text-[<?= THEME_ON_SURFACE_VARIANT ?>] space-y-1.5">
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[<?= THEME_PRIMARY_CONTAINER ?>] text-sm">email</span>
                                <span>Cek email untuk informasi lebih lanjut</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[<?= THEME_PRIMARY_CONTAINER ?>] text-sm">event</span>
                                <span>Kami akan menghubungi Anda dalam 1x24 jam</span>
                            </li>
                            <li class="flex items-center gap-2">
                                <span class="material-symbols-outlined text-[<?= THEME_PRIMARY_CONTAINER ?>] text-sm">groups</span>
                                <span>Bergabunglah dengan grup komunitas</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <a href="<?= BASE_URL ?>" class="inline-block bg-[<?= THEME_PRIMARY_CONTAINER ?>] hover:bg-[<?= THEME_PRIMARY ?>] text-white font-semibold py-3 px-8 rounded-lg transition-all duration-200 transform hover:scale-[1.02] text-body-md">
                <span class="flex items-center gap-2">
                    <span class="material-symbols-outlined text-[18px]">home</span>
                    Kembali ke Beranda
                </span>
            </a>
        </div>
    </main>

    <?php $this->view('partials/footer') ?>
</body>
</html>