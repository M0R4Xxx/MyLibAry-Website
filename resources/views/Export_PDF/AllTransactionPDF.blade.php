<!DOCTYPE html>
<html>
<head>
    <title>Laporan Peminjaman</title>
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

        .summary-item span, 
        .summary-item strong { 
            display: inline-block;
            vertical-align: middle; 
        }

        .summary-item span {
            font-size: 10px;
            color: #475569;
        }

        .summary-item strong { 
            font-size: 13px; 
            color: #0f172a;
            margin-left: 4px;
        }

        .dot { 
            display: table-cell;
            vertical-align: middle;
            color: #cbd5e1; 
            padding: 0 15px; 
            font-weight: normal;
            font-size: 16px;
            line-height: 10px; 
            text-align: center;
            transform: translateY(1px);
        }

        .text-center { text-align: center; }
        
        .status { font-weight: bold; text-transform: uppercase; font-size: 8px; padding: 2px 5px; border-radius: 3px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN TRANSAKSI PEMINJAMAN BUKU MyLibrAry</h2>
        <p>Periode: {{ $filterLabel }} | Tanggal Cetak: {{ $dateExport }}</p>
    </div>

    <div class="summary-text-container">
        <div class="summary-item">
            <span>TOTAL TRANSAKSI :</span> <strong>{{ $summary['total'] }}</strong>
        </div>
        <div class="dot">|</div>
        <div class="summary-item">
            <span>PENDING :</span> <strong>{{ $summary['pending'] }}</strong>
        </div>
        <div class="dot">|</div>
        <div class="summary-item">
            <span>BORROWED :</span> <strong>{{ $summary['borrowed'] }}</strong>
        </div>
        <div class="dot">|</div>
        <div class="summary-item">
            <span>RETURNED :</span> <strong>{{ $summary['returned'] }}</strong>
        </div>
        <div class="dot">|</div>
        <div class="summary-item">
            <span>REJECTED :</span> <strong>{{ $summary['rejected'] }}</strong>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th width="3%">No</th>
                <th>Judul Buku</th>
                <th>Peminjam</th>
                <th width="10%">Status</th>
                <th>Tgl Pinjam</th>
                <th>Jatuh Tempo</th>
                <th>Tgl Kembali</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $item)
            <tr>
                <td class="text-center">{{ $index + 1 }}</td>
                <td>
                    <strong>{{ $item->book->title ?? 'N/A' }}</strong><br>
                    <small style="color: #64748b;">{{ $item->book->author_name ?? 'Unknown' }}</small>
                </td>
                <td class="text-center">
                    {{ $item->user->username ?? 'User' }}<br>
                    <small style="color: #64748b;">({{ $item->user->role ?? 'N/A' }})</small>
                </td>
                <td class="text-center"><span class="status">{{ $item->status }}</span></td>
                <td class="text-center">{{ $item->loan_date ? \Carbon\Carbon::parse($item->loan_date)->format('M d, H:i') : '-' }}</td>
                <td class="text-center">{{ $item->due_date ? \Carbon\Carbon::parse($item->due_date)->format('M d, H:i') : '-' }}</td>
                <td class="text-center">{{ ($item->status === 'returned' && $item->return_date) ? \Carbon\Carbon::parse($item->return_date)->format('M d, H:i') : '-' }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center; padding: 20px;">Tidak ada data transaksi pada periode ini.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>