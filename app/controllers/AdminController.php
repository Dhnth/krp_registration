<?php
class AdminController extends Controller {
    private $pendaftaranModel;

    public function __construct() {
        $this->pendaftaranModel = $this->model('PendaftaranModel');
    }

    public function index() {
        if ($this->isLoggedIn()) {
            $this->dashboard();
        } else {
            $this->login();
        }
    }

    public function login() {
        if ($this->isLoggedIn()) {
            $this->redirect('admin/dashboard');
            return;
        }

        $data = [
            'title' => 'Login Admin',
            'error' => ''
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';

            if ($username === ADMIN_USERNAME && $password === ADMIN_PASSWORD) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['admin_username'] = $username;
                $_SESSION['admin_login_time'] = time();
                $this->redirect('admin/dashboard');
                return;
            } else {
                $data['error'] = 'Username atau password salah!';
            }
        }
        
        $this->view('admin/login', $data);
    }

    public function dashboard() {
        if (!$this->isLoggedIn()) {
            $this->redirect('admin/login');
            return;
        }
        
        $pendaftaran = $this->pendaftaranModel->getAll();
        $total = $this->pendaftaranModel->countTotal();
        $today = $this->pendaftaranModel->countToday();
        $month = $this->pendaftaranModel->countThisMonth();

        $data = [
            'title' => 'Dashboard Admin',
            'pendaftaran' => $pendaftaran,
            'total' => $total,
            'today' => $today,
            'month' => $month
        ];

        $this->view('admin/dashboard', $data);
    }

    public function delete() {
        if (!$this->isLoggedIn()) {
            $this->redirect('admin/login');
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = (int)$_POST['id'];
            if ($this->pendaftaranModel->delete($id)) {
                $_SESSION['success'] = 'Data berhasil dihapus';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data';
            }
        }
        $this->redirect('admin/dashboard');
    }

    public function logout() {
        session_destroy();
        $this->redirect('admin/login');
    }

    // Export Excel menggunakan PhpSpreadsheet
    public function exportExcel() {
        if (!$this->isLoggedIn()) {
            $this->redirect('admin/login');
            return;
        }

        // Ambil semua data
        $data = $this->pendaftaranModel->getAll();

        // Buat Spreadsheet baru
        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set judul sheet
        $sheet->setTitle('Data Pendaftar');

        // Style untuk title
        $spreadsheet->getProperties()
            ->setCreator('Komunitas Remaja Pustaka')
            ->setLastModifiedBy('Komunitas Remaja Pustaka')
            ->setTitle('Data Pendaftar')
            ->setSubject('Data Pendaftar Komunitas Remaja Pustaka')
            ->setDescription('Data pendaftar komunitas remaja pustaka')
            ->setKeywords('pendaftaran komunitas remaja pustaka')
            ->setCategory('Data');

        // Title
        $sheet->setCellValue('A1', 'DATA PENDAFTAR KOMUNITAS REMAJA PUSTAKA');
        $sheet->mergeCells('A1:J1');
        $sheet->getStyle('A1')->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 18,
                'color' => ['rgb' => '006E2F']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ]
        ]);

        // Subtitle
        $sheet->setCellValue('A2', 'Tanggal Export: ' . date('d F Y H:i') . ' | Total: ' . count($data) . ' pendaftar');
        $sheet->mergeCells('A2:J2');
        $sheet->getStyle('A2')->applyFromArray([
            'font' => [
                'size' => 11,
                'color' => ['rgb' => '666666']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
            ]
        ]);

        // Header kolom (baris 4)
        $headers = [
            'No', 
            'Nama Lengkap', 
            'Tempat Lahir', 
            'Tanggal Lahir', 
            'Alamat Rumah',
            'Kelas', 
            'NIS', 
            'Nomor Telepon', 
            'Motivasi Masuk',
            'Latar Belakang Organisasi',
            'Link Foto',
            'Tanggal Daftar'
        ];
        $column = 'A';
        foreach ($headers as $header) {
            $sheet->setCellValue($column . '4', $header);
            $column++;
        }

        // Style header
        $headerStyle = [
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
                'size' => 11
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => '22C55E']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => '22C55E']
                ]
            ]
        ];
        $sheet->getStyle('A4:L4')->applyFromArray($headerStyle);

        // Isi data (mulai baris 5)
        $row = 5;
        $no = 1;
        foreach ($data as $item) {
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValue('B' . $row, $item['nama_lengkap'] ?? '');
            $sheet->setCellValue('C' . $row, $item['tempat_lahir'] ?? '');
            $sheet->setCellValue('D' . $row, isset($item['tanggal_lahir']) ? date('d/m/Y', strtotime($item['tanggal_lahir'])) : '');
            $sheet->setCellValue('E' . $row, $item['alamat_rumah'] ?? '');
            $sheet->setCellValue('F' . $row, $item['kelas'] ?? '');
            $sheet->setCellValue('G' . $row, $item['nis'] ?? '');
            $sheet->setCellValue('H' . $row, $item['nomor_telepon'] ?? '');
            $sheet->setCellValue('I' . $row, $item['motivasi_masuk'] ?? '');
            $sheet->setCellValue('J' . $row, $item['latar_belakang_organisasi'] ?? '');
            
            // Link Foto
            $fotoLink = '';
            if (!empty($item['foto_bukti_follow'])) {
                $fotoLink = BASE_URL . '/' . $item['foto_bukti_follow'];
            }
            $sheet->setCellValue('K' . $row, $fotoLink);
            
            $sheet->setCellValue('L' . $row, date('d/m/Y H:i', strtotime($item['created_at'])));
            $row++;
            $no++;
        }

        // Style data dengan warna bergantian
        $lastRow = $row - 1;
        for ($i = 5; $i <= $lastRow; $i++) {
            $rowColor = ($i % 2 == 0) ? 'F8F9FF' : 'FFFFFF';
            $sheet->getStyle('A' . $i . ':L' . $i)->applyFromArray([
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => $rowColor]
                ],
                'borders' => [
                    'allBorders' => [
                        'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        'color' => ['rgb' => 'D1D5DB']
                    ]
                ]
            ]);
            
            // Alignment untuk kolom tertentu
            $sheet->getStyle('A' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('D' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('G' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('H' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $sheet->getStyle('L' . $i)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            
            // Wrap text untuk kolom alasan dan organisasi
            $sheet->getStyle('I' . $i)->getAlignment()->setWrapText(true);
            $sheet->getStyle('J' . $i)->getAlignment()->setWrapText(true);
        }

        // Total row
        $totalRow = $lastRow + 1;
        $sheet->setCellValue('A' . $totalRow, 'TOTAL');
        $sheet->mergeCells('A' . $totalRow . ':K' . $totalRow);
        $sheet->setCellValue('L' . $totalRow, count($data));
        
        $sheet->getStyle('A' . $totalRow . ':L' . $totalRow)->applyFromArray([
            'font' => [
                'bold' => true,
                'size' => 12
            ],
            'fill' => [
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => ['rgb' => 'F0FDF4']
            ],
            'alignment' => [
                'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_RIGHT,
                'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
            ],
            'borders' => [
                'allBorders' => [
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => ['rgb' => 'D1D5DB']
                ]
            ]
        ]);
        $sheet->getStyle('L' . $totalRow)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

        // Auto size columns
        foreach (range('A', 'L') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Set row height
        $sheet->getRowDimension(1)->setRowHeight(30);
        $sheet->getRowDimension(4)->setRowHeight(25);

        // Footer
        $footerRow = $totalRow + 2;
        $sheet->setCellValue('A' . $footerRow, 'Dicetak pada: ' . date('d F Y H:i:s'));
        $sheet->mergeCells('A' . $footerRow . ':L' . $footerRow);
        $sheet->getStyle('A' . $footerRow)->applyFromArray([
            'font' => [
                'size' => 10,
                'color' => ['rgb' => '666666'],
                'italic' => true
            ]
        ]);

        $footerRow2 = $footerRow + 1;
        $sheet->setCellValue('A' . $footerRow2, 'Komunitas Remaja Pustaka - Sistem Pendaftaran Anggota');
        $sheet->mergeCells('A' . $footerRow2 . ':L' . $footerRow2);
        $sheet->getStyle('A' . $footerRow2)->applyFromArray([
            'font' => [
                'size' => 10,
                'color' => ['rgb' => '666666'],
                'italic' => true
            ]
        ]);

        // Set header untuk download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="data_pendaftar_' . date('Y-m-d') . '.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');
        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        // Save file
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}