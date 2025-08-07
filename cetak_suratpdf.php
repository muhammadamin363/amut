<?php
require('fpdf/fpdf.php');
include 'db.php';

// Fungsi format tanggal Indonesia
function tanggal_indo($tanggal) {
    $bulan = [
        1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
        'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
    ];
    $pecah = explode('-', $tanggal);
    return (int)$pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
}

// Fungsi untuk mencegah karakter aneh
function clean_text($text) {
    return iconv('UTF-8', 'windows-1252//TRANSLIT', $text);
}

$no_surat_tugas = $_GET['no_surat_tugas'] ?? '';
if (!$no_surat_tugas) {
    die("Nomor Surat Tugas tidak ditemukan.");
}

// Ambil data surat
$surat = $conn->query("SELECT * FROM surat_tugas WHERE no_surat_tugas='$no_surat_tugas'")->fetch_assoc();
if (!$surat) {
    die("Data surat tidak ditemukan.");
}

// Ambil data petugas
$petugas = $conn->query("SELECT * FROM sppd WHERE no_surat_tugas='$no_surat_tugas' ORDER BY no_sppd ASC");

$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','',11);

// Logo
$pdf->Image('logo.png', 15, 10, 20);

// Header teks
$pdf->SetXY(30, 10); // Mulai tulis dari kanan logo
$pdf->SetFont('Arial','B',15);
$pdf->Cell(0,6,'PEMERINTAH KABUPATEN HULU SUNGAI UTARA',0,1,'C');

$pdf->SetX(30);
$pdf->Cell(0,6,'KECAMATAN AMUNTAI UTARA',0,1,'C');

$pdf->SetFont('Arial','',10);
$pdf->SetX(35);
$pdf->Cell(0,5,'Jln. Amuntai - Tanjung Km. 7,5 Desa Teluk Daun Telp. (0527) 69355 Kabupaten Hulu Sungai Utara',0,'C');
$pdf->SetX(90);
$pdf->Cell(0,5,' Provinsi Kalimantan Selatan',0,'C');
$pdf->SetX(30);
$pdf->Cell(0,5,'Email : kantorkecamatanamuntaiutara@gmail.com  Kode Pos 71471',0,1,'C');

// Garis pembatas
$pdf->Ln(2);
$pdf->SetLineWidth(1);
$pdf->Line(10, 40, 200, 40);
$pdf->SetLineWidth(0);
$pdf->Line(10, 41, 200, 41);
$pdf->Ln(8);

// ===== JUDUL =====
$pdf->SetFont('Arial','B',12);
$pdf->Cell(0,6,clean_text('LAPORAN HASIL PERJALANAN DINAS'),0,1,'C');
$pdf->Ln(8);

// ===== ISI SURAT =====
$pdf->SetFont('Arial','',11);
$pdf->Cell(60,7,'Berdasarkan Surat Perintah Perjalanan Dinas :',0,1);

$pdf->Cell(45,7,'Nomor',0,0);
$pdf->Cell(3,7,':',0,0);
$pdf->MultiCell(0,7,clean_text($surat['no_surat_tugas']));

$pdf->Cell(45,7,'Tanggal',0,0);
$pdf->Cell(3,7,':',0,0);
$pdf->MultiCell(0,7,clean_text(tanggal_indo($surat['tanggal_surat'])));

$pdf->Cell(45,7,'Tujuan',0,0);
$pdf->Cell(3,7,':',0,0);
$pdf->MultiCell(0,7,clean_text($surat['tujuan']));

$pdf->Cell(45,7,'Keperluan',0,0);
$pdf->Cell(3,7,':',0,0);
$pdf->MultiCell(0,7,clean_text($surat['uraian']));

$pdf->Cell(45,7,'Dengan Hasil',0,0);
$pdf->Cell(3,7,':',0,0);
$pdf->MultiCell(0,7,clean_text(
    'Telah Melaksanakan '.$surat['uraian'].
    ' Bertempat di '.$surat['tujuan'].
    ' Pada Tanggal '.tanggal_indo($surat['tanggal_surat'])
));

$pdf->Ln(15);

$names = [];
while($p = $petugas->fetch_assoc()){
    $nip = trim($p['nip']) ? "NIP. " . $p['nip'] : "";
    $names[] = $p['nama'] . ($nip ? "\n" . $nip : "");
}

$cellWidth = 95;
$startX = $pdf->GetX();
$startY = $pdf->GetY();

if (count($names) == 1) {
    // Hanya 1 petugas → posisikan tepat di bawah tanda tangan kanan
    $pdf->Cell($cellWidth, 6, '', 0, 0, 'C'); // kolom kiri kosong
    $pdf->MultiCell($cellWidth, 6, "Teluk Daun, ".tanggal_indo($surat['tanggal_surat'])."\nYang Melaporkan,", 0, 'C');
    $pdf->Ln(20);
    $pdf->Cell($cellWidth, 6, '', 0, 0, 'C'); // kolom kiri kosong
    $pdf->MultiCell($cellWidth, 6, $names[0], 0, 'C');
} else {
    // Lebih dari 1 petugas → tampilkan 2 kolom
    $pdf->MultiCell($cellWidth, 6, '', 0, 'C');
    $pdf->SetXY($startX + $cellWidth, $startY);
    $pdf->MultiCell($cellWidth, 6, "Teluk Daun, ".tanggal_indo($surat['tanggal_surat'])."\nYang Melaporkan,", 0, 'C');

    $pdf->Ln(20);
    $cols = 2;
    $rows = ceil(count($names)/$cols);
    for($r=0; $r<$rows; $r++){
        $y = $pdf->GetY();
        for($c=0; $c<$cols; $c++){
            $i = $r + $c*$rows;
            $pdf->SetXY($startX + ($c*$cellWidth), $y);
            if(isset($names[$i])){
                $pdf->MultiCell($cellWidth, 6, $names[$i], 0, 'C');
            }
        }
        $pdf->Ln(20);
    }
}


$pdf->Output();
?>