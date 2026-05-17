<!DOCTYPE html>
<html>
<head>
    <title>Laporan Denda</title>
    <style>
        body { font-family: sans-serif; font-size: 11px; color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f8fafc; font-weight: bold; text-transform: uppercase; color: #475569; text-align: center; }
        
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #e2e8f0; padding-bottom: 10px; }
        .header h2 { margin-bottom: 5px; color: #1e293b; text-transform: uppercase; }
        
        .summary-text-container { 
            display: table; 
            margin: 0 auto 15px auto; 
            padding: 5px 20px; 
            background-color: #f8fafc; 
            border: 1px solid #e2e8f0;
            border-radius: 4px;
        }

        .summary-item { 
            display: table-cell; 
            vertical-align: middle; 
            white-space: nowrap;
            padding: 5px 0;
            line-height: 10px; 
        }

        .summary-item span, .summary-item strong { display: inline-block; vertical-align: middle; }
        .summary-item span { font-size: 10px; color: #475569; }
        .summary-item strong { font-size: 13px; color: #0f172a; margin-left: 4px; }

        .dot { 
            display: table-cell; vertical-align: middle; color: #cbd5e1; 
            padding: 0 15px; font-weight: normal; font-size: 16px;
            line-height: 10px; text-align: center; transform: translateY(1px);
        }

        .text-center { text-align: center; }
        .status { font-weight: bold; text-transform: uppercase; font-size: 8px; padding: 2px 5px; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN DENDA TRANSAKSI PEMINJAMAN BUKU MyLibrAry</h2>
        <p>Periode: {{ $filterLabel }} | Tanggal Cetak: {{ $dateExport }}</p>
    </div>

    <div class="summary-text-container">
        <div class="summary-item">
            <span>TOTAL DENDA TERKUMPUL :</span> <strong>Rp {{ number_format($totalOutstanding, 0, ',', '.') }}</strong>
        </div>
        <div class="dot">|</div>
        <div class="summary-item">
            <span>PAY OFF :</span> <strong>{{ $summary['payoff'] }}</strong>
        </div>
        <div class="dot">|</div>
        <div class="summary-item">
            <span>UNPAID :</span> <strong>{{ $summary['unpaid'] }}</strong>
        </div>
        <div class="dot">|</div>
        <div class="summary-item">
            <span>TOTAL TRANSAKSI DENDA :</span> <strong>{{ $summary['total'] }}</strong>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th>Judul Buku</th>
                <th>Peminjam</th>
                <th width="10%">Status Denda</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tgl Kembali</th>
                <th>Total Denda</th>
            </tr>
        </thead>
        <tbody>
            @forelse($fineReports as $index => $fine)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $fine->book->title ?? 'Judul Tidak Ada' }}</strong><br>
                    <small style="color: #64748b;">{{ $fine->book->author_name ?? 'Unknown Author' }}</small>
                </td>
                <td class="text-center">
                    {{ $fine->user->username ?? $fine->user->name ?? 'User' }}<br>
                    <small style="color: #64748b;">({{ $fine->user->role ?? 'N/A' }})</small>
                </td>
                <td class="text-center">
                    <span class="status">{{ $fine->payment_status }}</span>
                </td>
                <td class="text-center">{{ $fine->loan_date ? \Carbon\Carbon::parse($fine->loan_date)->format('M d, H:i') : '-' }}</td>
                <td class="text-center">{{ $fine->due_date ? \Carbon\Carbon::parse($fine->due_date)->format('M d, H:i') : '-' }}</td>
                <td class="text-center">
                    @if($fine->status === 'returned' || $fine->return_date)
                        {{ \Carbon\Carbon::parse($fine->return_date)->format('M d, H:i') }}
                    @else
                        -
                    @endif
                </td>
                <td class="text-center">
                    <strong>Rp {{ number_format($fine->calculated_fine, 0, ',', '.') }}</strong>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" style="text-align: center; padding: 20px;">Tidak ada data denda pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>