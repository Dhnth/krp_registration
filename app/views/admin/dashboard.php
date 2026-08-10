<?php $this->view('partials/head', ['title' => $title ?? 'Dashboard Admin']) ?>

<body class="min-h-screen flex flex-col bg-[<?= THEME_SURFACE ?>] font-['Inter']">
    <!-- Admin Header -->
    <header class="bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>] border-b border-[<?= THEME_OUTLINE_VARIANT ?>] py-3 md:py-4 fixed top-0 left-0 right-0 z-50">
        <div class="container mx-auto px-4 max-w-[1200px]">
            <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                <div class="flex items-center gap-2 md:gap-3">
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-[<?= THEME_PRIMARY_CONTAINER ?>] rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-sm md:text-base">admin_panel_settings</span>
                    </div>
                    <div>
                        <h1 class="font-['Plus_Jakarta_Sans'] text-base md:text-xl font-bold text-[<?= THEME_ON_SURFACE ?>] leading-tight">
                            Dashboard Admin
                        </h1>
                        <p class="text-[10px] md:text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>]">
                            <span class="material-symbols-outlined text-[12px] align-middle">groups</span>
                            Total Pendaftar: <?= $total ?? 0 ?>
                        </p>
                    </div>
                </div>
                
                <div class="flex items-center gap-2 w-full sm:w-auto">
                    <a href="<?= BASE_URL ?>" class="text-[<?= THEME_ON_SURFACE_VARIANT ?>] hover:text-[<?= THEME_PRIMARY ?>] transition-colors text-sm font-medium px-3 py-1.5 border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg hover:border-[<?= THEME_PRIMARY_CONTAINER ?>] flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">home</span>
                        <span class="hidden xs:inline">Beranda</span>
                    </a>
                    <a href="<?= BASE_URL ?>/admin/logout" class="text-red-600 hover:text-red-700 transition-colors text-sm font-medium px-3 py-1.5 border border-red-200 rounded-lg hover:border-red-300 flex items-center gap-1.5">
                        <span class="material-symbols-outlined text-[18px]">logout</span>
                        <span class="hidden xs:inline">Keluar</span>
                    </a>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-grow container mx-auto px-4 max-w-[1200px] pt-20 pb-8 md:pt-24 md:pb-12">
        <!-- Alert Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="mb-4 bg-green-50 border border-green-500 text-green-700 rounded-lg p-3 md:p-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-green-500">check_circle</span>
                <p class="text-sm md:text-base"><?= $_SESSION['success'] ?></p>
                <?php unset($_SESSION['success']) ?>
            </div>
        <?php endif ?>

        <?php if (isset($_SESSION['error'])): ?>
            <div class="mb-4 bg-red-50 border border-[<?= THEME_ERROR ?>] text-[<?= THEME_ERROR ?>] rounded-lg p-3 md:p-4 flex items-center gap-2">
                <span class="material-symbols-outlined text-[<?= THEME_ERROR ?>]">error</span>
                <p class="text-sm md:text-base"><?= $_SESSION['error'] ?></p>
                <?php unset($_SESSION['error']) ?>
            </div>
        <?php endif ?>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 md:gap-4 mb-6 md:mb-8">
            <div class="bg-white rounded-xl border border-[<?= THEME_OUTLINE_VARIANT ?>] p-3 md:p-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>] font-medium">Total</p>
                        <p class="text-xl md:text-2xl font-bold text-[<?= THEME_ON_SURFACE ?>] font-['Plus_Jakarta_Sans']"><?= $total ?? 0 ?></p>
                    </div>
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-[<?= THEME_SURFACE_CONTAINER_HIGH ?>] rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-[<?= THEME_PRIMARY_CONTAINER ?>]">groups</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-[<?= THEME_OUTLINE_VARIANT ?>] p-3 md:p-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>] font-medium">Hari Ini</p>
                        <p class="text-xl md:text-2xl font-bold text-[<?= THEME_ON_SURFACE ?>] font-['Plus_Jakarta_Sans']"><?= $today ?? 0 ?></p>
                    </div>
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-green-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-[<?= THEME_PRIMARY_CONTAINER ?>]">today</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-[<?= THEME_OUTLINE_VARIANT ?>] p-3 md:p-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>] font-medium">Bulan Ini</p>
                        <p class="text-xl md:text-2xl font-bold text-[<?= THEME_ON_SURFACE ?>] font-['Plus_Jakarta_Sans']"><?= $month ?? 0 ?></p>
                    </div>
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-[<?= THEME_PRIMARY_CONTAINER ?>]">calendar_month</span>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-xl border border-[<?= THEME_OUTLINE_VARIANT ?>] p-3 md:p-4 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>] font-medium">Terakhir</p>
                        <p class="text-sm md:text-base font-semibold text-[<?= THEME_ON_SURFACE ?>] truncate max-w-[80px]">
                            <?php 
                                if (!empty($pendaftaran) && is_array($pendaftaran) && count($pendaftaran) > 0) {
                                    echo htmlspecialchars($pendaftaran[0]['nama_lengkap'] ?? '-');
                                } else {
                                    echo '-';
                                }
                            ?>
                        </p>
                    </div>
                    <div class="w-8 h-8 md:w-10 md:h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-[<?= THEME_PRIMARY_CONTAINER ?>]">person_add</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl border border-[<?= THEME_OUTLINE_VARIANT ?>] shadow-sm overflow-hidden">
            <!-- Table Header -->
            <div class="p-3 md:p-4 border-b border-[<?= THEME_OUTLINE_VARIANT ?>] bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>]">
                <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-3">
                    <h2 class="font-['Plus_Jakarta_Sans'] text-base md:text-lg font-semibold text-[<?= THEME_ON_SURFACE ?>] flex items-center gap-2">
                        <span class="material-symbols-outlined text-[<?= THEME_PRIMARY_CONTAINER ?>]">list</span>
                        Daftar Pendaftar
                    </h2>
                    <div class="flex items-center gap-2 w-full sm:w-auto">
                        <div class="relative flex-1 sm:flex-none">
                            <input 
                                type="text" 
                                id="searchInput"
                                placeholder="Cari nama, kelas, NIS..." 
                                class="w-full sm:w-56 h-9 px-3 pr-9 text-sm border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg focus:outline-none focus:ring-2 focus:ring-[<?= THEME_PRIMARY_CONTAINER ?>] focus:border-transparent bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>]"
                            >
                            <span class="material-symbols-outlined absolute right-3 top-1/2 -translate-y-1/2 text-[<?= THEME_ON_SURFACE_VARIANT ?>] text-[18px]">search</span>
                        </div>
                        
                        <div class="flex items-center gap-1.5">
                            <a href="<?= BASE_URL ?>/admin/exportExcel" class="px-3 py-1.5 bg-[<?= THEME_PRIMARY_CONTAINER ?>] hover:bg-[<?= THEME_PRIMARY ?>] text-white text-sm font-medium rounded-lg transition-colors flex items-center gap-1.5 shadow-sm hover:shadow">
                                <span class="material-symbols-outlined text-[18px]">table_chart</span>
                                <span class="hidden sm:inline">Export Excel</span>
                            </a>
                            <button onclick="window.location.reload()" class="p-1.5 text-[<?= THEME_ON_SURFACE_VARIANT ?>] hover:text-[<?= THEME_PRIMARY ?>] transition-colors border border-[<?= THEME_OUTLINE_VARIANT ?>] rounded-lg hover:border-[<?= THEME_PRIMARY_CONTAINER ?>]">
                                <span class="material-symbols-outlined text-[18px]">refresh</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Table Body -->
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>] border-b border-[<?= THEME_OUTLINE_VARIANT ?>]">
                        <tr>
                            <th class="px-3 md:px-4 py-2.5 md:py-3 text-left text-xs font-semibold text-[<?= THEME_ON_SURFACE_VARIANT ?>] uppercase tracking-wider">#</th>
                            <th class="px-3 md:px-4 py-2.5 md:py-3 text-left text-xs font-semibold text-[<?= THEME_ON_SURFACE_VARIANT ?>] uppercase tracking-wider">Foto</th>
                            <th class="px-3 md:px-4 py-2.5 md:py-3 text-left text-xs font-semibold text-[<?= THEME_ON_SURFACE_VARIANT ?>] uppercase tracking-wider">Nama</th>
                            <th class="px-3 md:px-4 py-2.5 md:py-3 text-left text-xs font-semibold text-[<?= THEME_ON_SURFACE_VARIANT ?>] uppercase tracking-wider hidden sm:table-cell">Tempat Lahir</th>
                            <th class="px-3 md:px-4 py-2.5 md:py-3 text-left text-xs font-semibold text-[<?= THEME_ON_SURFACE_VARIANT ?>] uppercase tracking-wider hidden md:table-cell">Tgl Lahir</th>
                            <th class="px-3 md:px-4 py-2.5 md:py-3 text-left text-xs font-semibold text-[<?= THEME_ON_SURFACE_VARIANT ?>] uppercase tracking-wider hidden lg:table-cell">Kelas</th>
                            <th class="px-3 md:px-4 py-2.5 md:py-3 text-left text-xs font-semibold text-[<?= THEME_ON_SURFACE_VARIANT ?>] uppercase tracking-wider hidden xl:table-cell">NIS</th>
                            <th class="px-3 md:px-4 py-2.5 md:py-3 text-left text-xs font-semibold text-[<?= THEME_ON_SURFACE_VARIANT ?>] uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody">
                        <?php if (empty($pendaftaran) || !is_array($pendaftaran) || count($pendaftaran) === 0): ?>
                            <tr>
                                <td colspan="8" class="px-3 md:px-4 py-12 md:py-16 text-center text-[<?= THEME_ON_SURFACE_VARIANT ?>]">
                                    <span class="material-symbols-outlined text-4xl md:text-5xl block mb-3 text-[<?= THEME_OUTLINE_VARIANT ?>]">inbox</span>
                                    <p class="text-sm font-medium">Belum ada data pendaftaran</p>
                                    <p class="text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>] mt-1">Data akan muncul setelah ada pendaftar baru</p>
                                </td>
                            </tr>
                        <?php else: ?>
                            <?php foreach ($pendaftaran as $index => $item): ?>
                                <tr class="border-b border-[<?= THEME_OUTLINE_VARIANT ?>] hover:bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>] transition-colors cursor-pointer group" onclick="openDetail(<?= $index ?>)">
                                    <td class="px-3 md:px-4 py-2.5 md:py-3 text-sm text-[<?= THEME_ON_SURFACE_VARIANT ?>]">
                                        <?= $index + 1 ?>
                                    </td>
                                    <td class="px-3 md:px-4 py-2.5 md:py-3">
                                        <?php if (!empty($item['foto_bukti_follow']) && file_exists($item['foto_bukti_follow'])): ?>
                                            <img src="<?= BASE_URL . '/' . $item['foto_bukti_follow'] ?>" alt="Foto" class="w-10 h-10 rounded-lg object-cover border border-[<?= THEME_OUTLINE_VARIANT ?>] group-hover:ring-2 group-hover:ring-[<?= THEME_PRIMARY_CONTAINER ?>] transition-all">
                                        <?php else: ?>
                                            <div class="w-10 h-10 rounded-lg bg-[<?= THEME_SURFACE_CONTAINER_HIGH ?>] flex items-center justify-center border border-[<?= THEME_OUTLINE_VARIANT ?>] group-hover:border-[<?= THEME_PRIMARY_CONTAINER ?>] transition-colors">
                                                <span class="material-symbols-outlined text-[<?= THEME_ON_SURFACE_VARIANT ?>] text-[20px]">photo_camera</span>
                                            </div>
                                        <?php endif ?>
                                    </td>
                                    <td class="px-3 md:px-4 py-2.5 md:py-3 text-sm font-medium text-[<?= THEME_ON_SURFACE ?>]">
                                        <?= htmlspecialchars($item['nama_lengkap'] ?? '') ?>
                                        <span class="block sm:hidden text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>] font-normal">
                                            <?= htmlspecialchars($item['kelas'] ?? '') ?>
                                        </span>
                                    </td>
                                    <td class="px-3 md:px-4 py-2.5 md:py-3 text-sm text-[<?= THEME_ON_SURFACE_VARIANT ?>] hidden sm:table-cell">
                                        <?= htmlspecialchars($item['tempat_lahir'] ?? '-') ?>
                                    </td>
                                    <td class="px-3 md:px-4 py-2.5 md:py-3 text-sm text-[<?= THEME_ON_SURFACE_VARIANT ?>] hidden md:table-cell">
                                        <?= isset($item['tanggal_lahir']) && $item['tanggal_lahir'] ? date('d/m/Y', strtotime($item['tanggal_lahir'])) : '-' ?>
                                    </td>
                                    <td class="px-3 md:px-4 py-2.5 md:py-3 text-sm text-[<?= THEME_ON_SURFACE_VARIANT ?>] hidden lg:table-cell">
                                        <?= htmlspecialchars($item['kelas'] ?? '') ?>
                                    </td>
                                    <td class="px-3 md:px-4 py-2.5 md:py-3 text-sm text-[<?= THEME_ON_SURFACE_VARIANT ?>] hidden xl:table-cell">
                                        <?= htmlspecialchars($item['nis'] ?? '') ?>
                                    </td>
                                    <td class="px-3 md:px-4 py-2.5 md:py-3">
                                        <form action="<?= BASE_URL ?>/admin/delete" method="POST" onsubmit="return confirm('Yakin ingin menghapus data ini?')" class="inline" onclick="event.stopPropagation();">
                                            <input type="hidden" name="id" value="<?= $item['id'] ?? '' ?>">
                                            <button type="submit" class="text-red-400 hover:text-red-600 transition-colors p-1 hover:bg-red-50 rounded-lg flex items-center gap-1">
                                                <span class="material-symbols-outlined text-[20px]">delete</span>
                                                <span class="sr-only">Hapus</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                        <?php endif ?>
                    </tbody>
                </table>
            </div>
            
            <!-- Table Footer -->
            <div class="px-3 md:px-4 py-2.5 md:py-3 border-t border-[<?= THEME_OUTLINE_VARIANT ?>] bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>] text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>] flex flex-col sm:flex-row justify-between items-center gap-2">
                <span class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[14px]">database</span>
                    Menampilkan <?= isset($pendaftaran) && is_array($pendaftaran) ? count($pendaftaran) : 0 ?> data
                </span>
                <span class="flex items-center gap-1.5">
                    <span class="material-symbols-outlined text-[14px]">schedule</span>
                    <?= date('d/m/Y H:i') ?>
                </span>
            </div>
        </div>
    </main>

    <!-- Modal Detail -->
    <div id="detailModal" class="fixed inset-0 z-[100] hidden bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 transition-all duration-300" onclick="closeModal(event)">
        <div class="bg-white rounded-2xl max-w-3xl w-full max-h-[92vh] overflow-hidden shadow-2xl transform transition-all duration-300 scale-95 opacity-0 modal-content" onclick="event.stopPropagation()">
            <!-- Modal Header -->
            <div class="sticky top-0 bg-gradient-to-r from-[<?= THEME_PRIMARY_CONTAINER ?>] to-[<?= THEME_PRIMARY ?>] px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white/20 rounded-lg flex items-center justify-center">
                        <span class="material-symbols-outlined text-white text-[24px]">person</span>
                    </div>
                    <div>
                        <h3 class="font-['Plus_Jakarta_Sans'] text-lg font-bold text-white">Detail Pendaftar</h3>
                        <p class="text-xs text-white/80" id="modalSubtitle">Informasi lengkap anggota</p>
                    </div>
                </div>
                <button onclick="closeModal()" class="p-1.5 hover:bg-white/20 rounded-lg transition-colors text-white/80 hover:text-white">
                    <span class="material-symbols-outlined text-[24px]">close</span>
                </button>
            </div>
            
            <!-- Modal Body -->
            <div class="p-6 overflow-y-auto max-h-[calc(92vh-80px)]" id="modalContent">
                <!-- Akan diisi oleh JavaScript -->
            </div>
        </div>
    </div>

    <style>
        #detailModal.show .modal-content {
            transform: scale(1);
            opacity: 1;
        }
        .modal-content {
            transition: all 0.3s ease-out;
        }
        .detail-item {
            padding: 12px 16px;
            border-radius: 8px;
            transition: background-color 0.2s;
        }
        .detail-item:hover {
            background-color: #f8f9ff;
        }
        .detail-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #6d7b6c;
            margin-bottom: 2px;
        }
        .detail-value {
            font-size: 15px;
            color: #0b1c30;
            word-break: break-word;
        }
        .detail-value a {
            color: #22c55e;
            text-decoration: underline;
            transition: color 0.2s;
        }
        .detail-value a:hover {
            color: #006e2f;
        }
        .foto-container {
            background: #f8f9ff;
            border-radius: 12px;
            padding: 16px;
            border: 1px solid #e2e8f0;
        }
        .foto-container img {
            max-height: 280px;
            border-radius: 8px;
        }
        .modal-scrollbar::-webkit-scrollbar {
            width: 6px;
        }
        .modal-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 3px;
        }
        .modal-scrollbar::-webkit-scrollbar-thumb {
            background: #22c55e;
            border-radius: 3px;
        }
        .modal-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #006e2f;
        }
    </style>

    <script>
        // Data pendaftaran dari PHP
        const pendaftaranData = <?= json_encode($pendaftaran ?? []) ?>;

        function openDetail(index) {
            const data = pendaftaranData[index];
            if (!data) return;

            const modal = document.getElementById('detailModal');
            const content = document.getElementById('modalContent');
            const subtitle = document.getElementById('modalSubtitle');

            // Update subtitle
            subtitle.textContent = data.nama_lengkap || 'Anggota';

            // Format tanggal
            const tglLahir = data.tanggal_lahir ? new Date(data.tanggal_lahir).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric'
            }) : '-';

            const tglDaftar = data.created_at ? new Date(data.created_at).toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            }) : '-';

            // Foto
            let fotoHtml = '';
            const fotoPath = data.foto_bukti_follow && data.foto_bukti_follow !== '' ? '<?= BASE_URL ?>/' + data.foto_bukti_follow : null;
            
            if (fotoPath) {
                fotoHtml = `
                    <div class="foto-container text-center">
                        <img src="${fotoPath}" alt="Foto Bukti Follow" class="mx-auto object-contain border border-[<?= THEME_OUTLINE_VARIANT ?>]">
                        <div class="mt-3 flex items-center justify-center gap-4">
                            <a href="${fotoPath}" target="_blank" class="text-sm text-[<?= THEME_PRIMARY_CONTAINER ?>] hover:text-[<?= THEME_PRIMARY ?>] transition-colors flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">open_in_new</span>
                                Buka Gambar
                            </a>
                            <span class="text-[<?= THEME_OUTLINE_VARIANT ?>]">|</span>
                            <button onclick="copyToClipboard('${fotoPath}')" class="text-sm text-[<?= THEME_PRIMARY_CONTAINER ?>] hover:text-[<?= THEME_PRIMARY ?>] transition-colors flex items-center gap-1">
                                <span class="material-symbols-outlined text-[16px]">content_copy</span>
                                Salin Link
                            </button>
                        </div>
                        <div class="mt-2 text-xs text-[<?= THEME_ON_SURFACE_VARIANT ?>] break-all bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>] p-2 rounded-lg">
                            <span class="font-medium">Link Foto:</span> ${fotoPath}
                        </div>
                    </div>
                `;
            } else {
                fotoHtml = `
                    <div class="foto-container text-center">
                        <div class="w-32 h-32 mx-auto bg-[<?= THEME_SURFACE_CONTAINER_HIGH ?>] rounded-lg flex items-center justify-center border border-[<?= THEME_OUTLINE_VARIANT ?>]">
                            <span class="material-symbols-outlined text-4xl text-[<?= THEME_ON_SURFACE_VARIANT ?>]">photo_camera</span>
                        </div>
                        <p class="mt-2 text-sm text-[<?= THEME_ON_SURFACE_VARIANT ?>]">Tidak ada foto</p>
                    </div>
                `;
            }

            content.innerHTML = `
                <div class="space-y-4">
                    <!-- Foto Section -->
                    <div>
                        <p class="detail-label">Foto Bukti Follow Instagram</p>
                        ${fotoHtml}
                    </div>

                    <!-- Informasi Pribadi -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                        <div class="detail-item">
                            <p class="detail-label">Nama Lengkap</p>
                            <p class="detail-value font-semibold">${escapeHtml(data.nama_lengkap || '-')}</p>
                        </div>
                        <div class="detail-item">
                            <p class="detail-label">Kelas</p>
                            <p class="detail-value">${escapeHtml(data.kelas || '-')}</p>
                        </div>
                        <div class="detail-item">
                            <p class="detail-label">Tempat Lahir</p>
                            <p class="detail-value">${escapeHtml(data.tempat_lahir || '-')}</p>
                        </div>
                        <div class="detail-item">
                            <p class="detail-label">Tanggal Lahir</p>
                            <p class="detail-value">${tglLahir}</p>
                        </div>
                        <div class="detail-item md:col-span-2">
                            <p class="detail-label">Alamat Rumah</p>
                            <p class="detail-value">${escapeHtml(data.alamat_rumah || '-')}</p>
                        </div>
                        <div class="detail-item">
                            <p class="detail-label">NIS</p>
                            <p class="detail-value font-mono">${escapeHtml(data.nis || '-')}</p>
                        </div>
                        <div class="detail-item">
                            <p class="detail-label">Nomor Telepon</p>
                            <p class="detail-value">${escapeHtml(data.nomor_telepon || '-')}</p>
                        </div>
                    </div>

                    <!-- Motivasi & Organisasi -->
                    <div class="grid grid-cols-1 gap-3">
                        <div class="detail-item">
                            <p class="detail-label">Motivasi Masuk KRP</p>
                            <p class="detail-value">${escapeHtml(data.motivasi_masuk || '-')}</p>
                        </div>
                        <div class="detail-item">
                            <p class="detail-label">Latar Belakang Organisasi</p>
                            <p class="detail-value">${escapeHtml(data.latar_belakang_organisasi || '-')}</p>
                        </div>
                    </div>

                    <!-- Tanggal Daftar -->
                    <div class="detail-item bg-[<?= THEME_SURFACE_CONTAINER_LOW ?>]">
                        <p class="detail-label">Tanggal Pendaftaran</p>
                        <p class="detail-value flex items-center gap-2">
                            <span class="material-symbols-outlined text-[18px] text-[<?= THEME_PRIMARY_CONTAINER ?>]">event</span>
                            ${tglDaftar}
                        </p>
                    </div>
                </div>
            `;

            // Tampilkan modal dengan animasi
            modal.classList.remove('hidden');
            modal.classList.add('show');
            document.body.style.overflow = 'hidden';
            
            // Trigger reflow untuk animasi
            setTimeout(() => {
                document.querySelector('.modal-content').classList.add('show');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('detailModal');
            modal.classList.remove('show');
            modal.classList.add('hidden');
            document.body.style.overflow = '';
            
            // Reset modal content
            setTimeout(() => {
                document.querySelector('.modal-content').classList.remove('show');
            }, 300);
        }

        // Close modal dengan klik di luar
        function closeModal(event) {
            if (event && event.target !== event.currentTarget) return;
            const modal = document.getElementById('detailModal');
            modal.classList.remove('show');
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.style.overflow = '';
            }, 300);
        }

        function copyToClipboard(text) {
            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(text).then(() => {
                    showToast('Link berhasil disalin!');
                }).catch(() => {
                    fallbackCopy(text);
                });
            } else {
                fallbackCopy(text);
            }
        }

        function fallbackCopy(text) {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.position = 'fixed';
            textarea.style.opacity = '0';
            document.body.appendChild(textarea);
            textarea.select();
            try {
                document.execCommand('copy');
                showToast('Link berhasil disalin!');
            } catch (err) {
                showToast('Gagal menyalin link');
            }
            document.body.removeChild(textarea);
        }

        function showToast(message) {
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-6 left-1/2 -translate-x-1/2 bg-[<?= THEME_ON_SURFACE ?>] text-white px-6 py-3 rounded-lg shadow-lg z-[200] text-sm font-medium flex items-center gap-2 animate-fade-in';
            toast.innerHTML = `
                <span class="material-symbols-outlined text-[20px] text-[<?= THEME_PRIMARY_CONTAINER ?>]">check_circle</span>
                ${message}
            `;
            document.body.appendChild(toast);
            
            setTimeout(() => {
                toast.style.opacity = '0';
                toast.style.transform = 'translateX(-50%) translateY(20px)';
                toast.style.transition = 'all 0.3s ease-out';
                setTimeout(() => {
                    document.body.removeChild(toast);
                }, 300);
            }, 2500);
        }

        // Tambahkan style untuk toast
        const style = document.createElement('style');
        style.textContent = `
            @keyframes fadeInUp {
                from {
                    opacity: 0;
                    transform: translateX(-50%) translateY(20px);
                }
                to {
                    opacity: 1;
                    transform: translateX(-50%) translateY(0);
                }
            }
            .animate-fade-in {
                animation: fadeInUp 0.3s ease-out forwards;
            }
        `;
        document.head.appendChild(style);

        function escapeHtml(text) {
            if (!text) return '-';
            const div = document.createElement('div');
            div.textContent = text;
            return div.innerHTML;
        }

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeModal();
            }
        });

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            if (searchInput) {
                searchInput.addEventListener('keyup', function() {
                    const searchText = this.value.toLowerCase();
                    const rows = document.querySelectorAll('#tableBody tr');
                    
                    rows.forEach(row => {
                        const text = row.textContent.toLowerCase();
                        row.style.display = text.includes(searchText) ? '' : 'none';
                    });
                });
            }
        });
    </script>

    <?php $this->view('partials/footer') ?>
</body>
</html>