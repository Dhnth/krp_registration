<?php
class PendaftaranController extends Controller {
    private $pendaftaranModel;

    public function __construct() {
        $this->pendaftaranModel = $this->model('PendaftaranModel');
    }

    public function index() {
        $data = [
            'title' => 'Form Pendaftaran Komunitas Remaja Pustaka',
            'error' => ''
        ];
        $this->view('home/index', $data);
    }

    public function submit() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->redirect('');
        }

        // Sanitasi input
        $nama = htmlspecialchars(trim($_POST['nama_lengkap'] ?? ''));
        $tempat_lahir = htmlspecialchars(trim($_POST['tempat_lahir'] ?? ''));
        $tanggal_lahir = htmlspecialchars(trim($_POST['tanggal_lahir'] ?? ''));
        $alamat = htmlspecialchars(trim($_POST['alamat_rumah'] ?? ''));
        $kelas = htmlspecialchars(trim($_POST['kelas'] ?? ''));
        $nis = htmlspecialchars(trim($_POST['nis'] ?? ''));
        $telepon = htmlspecialchars(trim($_POST['nomor_telepon'] ?? ''));
        $motivasi = htmlspecialchars(trim($_POST['motivasi_masuk'] ?? ''));
        $organisasi = htmlspecialchars(trim($_POST['latar_belakang_organisasi'] ?? ''));

        // Validasi
        $errors = [];
        
        if (empty($nama)) {
            $errors[] = 'Nama lengkap wajib diisi';
        } elseif (strlen($nama) < 3) {
            $errors[] = 'Nama lengkap minimal 3 karakter';
        }

        if (empty($tempat_lahir)) {
            $errors[] = 'Tempat lahir wajib diisi';
        }

        if (empty($tanggal_lahir)) {
            $errors[] = 'Tanggal lahir wajib diisi';
        }

        if (empty($alamat)) {
            $errors[] = 'Alamat rumah wajib diisi';
        } elseif (strlen($alamat) < 5) {
            $errors[] = 'Alamat rumah minimal 5 karakter';
        }

        if (empty($kelas)) {
            $errors[] = 'Kelas wajib diisi';
        }

        if (empty($nis)) {
            $errors[] = 'NIS wajib diisi';
        } elseif (!preg_match('/^[0-9]{8,}$/', $nis)) {
            $errors[] = 'NIS harus berupa angka minimal 8 digit';
        }

        if (empty($telepon)) {
            $errors[] = 'Nomor telepon wajib diisi';
        } elseif (!preg_match('/^[0-9]{10,15}$/', $telepon)) {
            $errors[] = 'Nomor telepon harus berupa angka 10-15 digit';
        }

        if (empty($motivasi)) {
            $errors[] = 'Motivasi masuk wajib diisi';
        } elseif (strlen($motivasi) < 10) {
            $errors[] = 'Motivasi masuk minimal 10 karakter';
        }

        if (empty($organisasi)) {
            $errors[] = 'Latar belakang organisasi wajib diisi';
        }

        // Upload file
        $foto_bukti = '';
        $uploadDir = 'public/uploads/';
        
        // Buat folder jika belum ada
        if (!is_dir($uploadDir)) {
            if (!mkdir($uploadDir, 0777, true)) {
                $errors[] = 'Gagal membuat folder upload';
            }
        }

        // Cek apakah folder bisa ditulis
        if (is_dir($uploadDir) && !is_writable($uploadDir)) {
            $errors[] = 'Folder upload tidak dapat ditulis. Silakan hubungi admin.';
        }

        if (empty($errors) && isset($_FILES['foto_bukti_follow']) && $_FILES['foto_bukti_follow']['error'] === 0) {
            $file = $_FILES['foto_bukti_follow'];
            $allowed = ['jpg', 'jpeg', 'png', 'webp'];
            $filename = $file['name'];
            $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            
            // Validasi file
            if (!in_array($ext, $allowed)) {
                $errors[] = 'File harus berupa gambar (JPG, JPEG, PNG, WEBP)';
            } elseif ($file['size'] > 2 * 1024 * 1024) {
                $errors[] = 'Ukuran file maksimal 2MB';
            } else {
                $newFilename = time() . '_' . uniqid() . '.' . $ext;
                $uploadPath = $uploadDir . $newFilename;
                
                if (move_uploaded_file($file['tmp_name'], $uploadPath)) {
                    $foto_bukti = $uploadPath;
                } else {
                    $errors[] = 'Gagal mengupload file. Error: ' . $file['error'];
                }
            }
        } elseif (empty($errors)) {
            $errors[] = 'Upload foto bukti follow Instagram wajib diisi';
        }

        // Cek NIS duplikat
        if (empty($errors)) {
            $existing = $this->pendaftaranModel->getByNis($nis);
            if ($existing) {
                $errors[] = 'NIS sudah terdaftar, silakan gunakan NIS lain';
            }
        }

        if (!empty($errors)) {
            $data = [
                'title' => 'Form Pendaftaran Komunitas Remaja Pustaka',
                'errors' => $errors,
                'old' => [
                    'nama_lengkap' => $nama,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat_rumah' => $alamat,
                    'kelas' => $kelas,
                    'nis' => $nis,
                    'nomor_telepon' => $telepon,
                    'motivasi_masuk' => $motivasi,
                    'latar_belakang_organisasi' => $organisasi
                ]
            ];
            $this->view('home/index', $data);
            return;
        }

        // Simpan data
        $data = [
            'nama_lengkap' => $nama,
            'tempat_lahir' => $tempat_lahir,
            'tanggal_lahir' => $tanggal_lahir,
            'alamat_rumah' => $alamat,
            'kelas' => $kelas,
            'nis' => $nis,
            'nomor_telepon' => $telepon,
            'motivasi_masuk' => $motivasi,
            'latar_belakang_organisasi' => $organisasi,
            'foto_bukti_follow' => $foto_bukti
        ];

        if ($this->pendaftaranModel->create($data)) {
            $this->view('home/success', [
                'title' => 'Pendaftaran Berhasil',
                'nama' => $nama
            ]);
        } else {
            $data = [
                'title' => 'Form Pendaftaran Komunitas Remaja Pustaka',
                'error' => 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.',
                'old' => [
                    'nama_lengkap' => $nama,
                    'tempat_lahir' => $tempat_lahir,
                    'tanggal_lahir' => $tanggal_lahir,
                    'alamat_rumah' => $alamat,
                    'kelas' => $kelas,
                    'nis' => $nis,
                    'nomor_telepon' => $telepon,
                    'motivasi_masuk' => $motivasi,
                    'latar_belakang_organisasi' => $organisasi
                ]
            ];
            $this->view('home/index', $data);
        }
    }
}