<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use App\Models\tpemesanan;
use App\Models\tproduk;
use App\Models\tkonsumen;
use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
	public function index(Request $request)
	{
		$query = tpemesanan::query();

		// If the current user is a 'user', limit to their orders. Adjust mapping if needed.
		if (Auth::check() && Auth::user()->role === 'user') {
			$query->where('id_konsumen', Auth::id());
		}

		// Date filters
		$start = $request->input('start_date');
		$end = $request->input('end_date');
		if ($start) {
			$query->whereDate('created_at', '>=', $start);
		}
		if ($end) {
			$query->whereDate('created_at', '<=', $end);
		}

		$totalPendapatan = (clone $query)->sum('total_biaya') ?? 0;
		$totalPesanan = (clone $query)->count();
		$totalProduk = tproduk::count();
		$totalPelanggan = tkonsumen::count();

		$pesanan = (clone $query)->orderBy('created_at', 'desc')->limit(100)->get();

		// Prepare monthly pendapatan for last 6 months (include months with zero)
		$monthsToShow = 6;
		$months = [];
		for ($i = $monthsToShow - 1; $i >= 0; $i--) {
			$months[] = \Carbon\Carbon::now()->subMonths($i)->format('Y-m');
		}

		$grouped = (clone $query)
			->selectRaw("DATE_FORMAT(created_at, '%Y-%m') as month, SUM(total_biaya) as total")
			->groupBy('month')
			->orderBy('month', 'asc')
			->get()
			->keyBy('month')
			->map(function ($item) {
				return (float) $item->total;
			})->toArray();

		$pendapatanPerBulan = collect($months)->map(function ($m) use ($grouped) {
			return (object)[
				'month' => $m,
				'total' => $grouped[$m] ?? 0,
			];
		});

		// Prepare daily pendapatan for last 7 days
		$daysToShow = 7;
		$days = [];
		for ($i = $daysToShow - 1; $i >= 0; $i--) {
			$days[] = \Carbon\Carbon::now()->subDays($i)->format('Y-m-d');
		}

		$groupedDays = (clone $query)
			->selectRaw("DATE(created_at) as day, SUM(total_biaya) as total")
			->groupBy('day')
			->orderBy('day', 'asc')
			->get()
			->keyBy('day')
			->map(function ($item) {
				return (float) $item->total;
			})->toArray();

		$pendapatanPerHari = collect($days)->map(function ($d) use ($groupedDays) {
			return (object)[
				'day' => $d,
				'total' => $groupedDays[$d] ?? 0,
			];
		});

		// CSV export for the current filtered result
		if ($request->input('export') === 'csv') {
			$filename = 'laporan_keuangan_' . date('Ymd_His') . '.csv';
			$headers = [
				'Content-Type' => 'text/csv',
				'Content-Disposition' => "attachment; filename=\"{$filename}\"",
			];

			$columns = ['id_pemesanan', 'id_konsumen', 'total_biaya', 'status', 'tanggal', 'created_at'];

			$callback = function () use ($pesanan, $columns) {
				$file = fopen('php://output', 'w');
				fputcsv($file, $columns);
				foreach ($pesanan as $row) {
					$line = [];
					foreach ($columns as $col) {
						$line[] = $row->{$col} ?? '';
					}
					fputcsv($file, $line);
				}
				fclose($file);
			};

			return Response::stream($callback, 200, $headers);
		}

		return view('admin.laporan_keuangan', [
			'totalPendapatan' => $totalPendapatan,
			'totalPesanan' => $totalPesanan,
			'totalProduk' => $totalProduk,
			'totalPelanggan' => $totalPelanggan,
			'pendapatanPerBulan' => $pendapatanPerBulan,
			'pesanan' => $pesanan,
			'pendapatanPerHari' => $pendapatanPerHari,
			'start_date' => $start,
			'end_date' => $end,
		]);
	}
}

