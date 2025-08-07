<?php
require('fpdf/fpdf.php');
include 'db.php';

// ======= PENGATURAN JUDUL HALAMAN =======
$judul_halaman = "LAPORAN DATA SURAT PERJALANAN DINAS"; // bisa diganti sesuai kebutuhan
// ========================================

// Fungsi format tanggal Indonesia
function tanggal_indo($tanggal) {
    $bulan = [
        1 => 'Januari','Februari','Maret','April','Mei','Juni',
        'Juli','Agustus','September','Oktober','November','Desember'
    ];
    $pecah = explode('-', $tanggal);
    return (int)$pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
}

// Fungsi normalisasi encoding
function fix_encoding($text) {
    $text = str_replace(
        ["â€“", "â€”", "â€˜", "â€™", "â€œ", "â€�"],
        ["-", "-", "'", "'", '"', '"'],
        $text
    );
    return $text;
}

class PDF extends FPDF {
    function Row($data, $widths, $aligns){
        $nb = 0;
        for($i=0;$i<count($data);$i++){
            $nb = max($nb, $this->NbLines($widths[$i], $data[$i]));
        }
        $h = 6 * $nb;
        $this->CheckPageBreak($h);
        for($i=0;$i<count($data);$i++){
            $w = $widths[$i];
            $a = isset($aligns[$i]) ? $aligns[$i] : 'L';
            $x = $this->GetX();
            $y = $this->GetY();
            $this->Rect($x, $y, $w, $h);
            $this->MultiCell($w, 6, $data[$i], 0, $a);
            $this->SetXY($x + $w, $y);
        }
        $this->Ln($h);
    }

    function CheckPageBreak($h){
        if($this->GetY() + $h > $this->PageBreakTrigger){
            $this->AddPage($this->CurOrientation);
        }
    }

    function NbLines($w, $txt){
        $cw = &$this->CurrentFont['cw'];
        if($w==0)
            $w = $this->w - $this->rMargin - $this->x;
        $wmax = ($w - 2*$this->cMargin) * 1000 / $this->FontSize;
        $s = str_replace("\r",'',$txt);
        $nb = strlen($s);
        if($nb > 0 && $s[$nb-1] == "\n")
            $nb--;
        $sep = -1;
        $i = 0;
        $j = 0;
        $l = 0;
        $nl = 1;
        while($i < $nb){
            $c = $s[$i];
            if($c == "\n"){
                $i++;
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
                continue;
            }
            if($c == ' ')
                $sep = $i;
            $l += $cw[$c];
            if($l > $wmax){
                if($sep == -1){
                    if($i == $j)
                        $i++;
                } else {
                    $i = $sep + 1;
                }
                $sep = -1;
                $j = $i;
                $l = 0;
                $nl++;
            } else {
                $i++;
            }
        }
        return $nl;
    }
}

// Lebar & alignment kolom
$widths = [10,40,25,70,60,20,40,30,45];
$aligns = ['C','L','C','L','L','C','L','C','L'];

// Buat PDF
$pdf = new PDF('L','mm','Legal');
$pdf->AddPage();
$pdf->SetFont('Arial','B',14);
$pdf->Cell(0,10,$judul_halaman,0,1,'C'); // ← pakai variabel judul
$pdf->Ln(3);

// Header tabel
$pdf->SetFont('Arial','B',10);
$pdf->SetFillColor(0,0,0);
$pdf->SetTextColor(255,255,255);
$header = ['No','No Surat Tugas','Tanggal Surat','Uraian','Tujuan','No SPPD','Nama','Pangkat/Gol','Jabatan'];
for($i=0;$i<count($header);$i++){
    $pdf->Cell($widths[$i],8,$header[$i],1,0,'C',true);
}
$pdf->Ln();

$pdf->SetFont('Arial','',9);
$pdf->SetTextColor(0,0,0);

// Ambil data surat & petugas
$no = 1;
$qSurat = $conn->query("SELECT * FROM surat_tugas ORDER BY tanggal_surat DESC");

while($surat = $qSurat->fetch_assoc()){
    $qPetugas = $conn->query("SELECT * FROM sppd WHERE no_surat_tugas='".$surat['no_surat_tugas']."' ORDER BY no_sppd ASC");
    if($qPetugas->num_rows > 0){
        $first = true;
        while($p = $qPetugas->fetch_assoc()){
            $pdf->Row([
                $first ? $no : '',
                $first ? $surat['no_surat_tugas'] : '',
                $first ? tanggal_indo($surat['tanggal_surat']) : '',
                $first ? fix_encoding($surat['uraian']) : '',
                $first ? fix_encoding($surat['tujuan']) : '',
                $p['no_sppd'],
                $p['nama'],
                $p['pangkat_gol'],
                $p['jabatan']
            ], $widths, $aligns);
            $first = false;
        }
    } else {
        // Surat tanpa petugas
        $pdf->Row([
            $no,
            $surat['no_surat_tugas'],
            tanggal_indo($surat['tanggal_surat']),
            fix_encoding($surat['uraian']),
            fix_encoding($surat['tujuan']),
            '',
            '',
            '',
            ''
        ], $widths, $aligns);
    }
    $no++;
}

$pdf->Output();
?>
