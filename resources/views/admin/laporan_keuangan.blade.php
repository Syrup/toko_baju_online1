@extends('layouts.app')
@section('content')
<div class="container-fluid py-4">
	<div class="row mb-4">
		<div class="col-12 d-flex justify-content-between align-items-center">
			<div>
				<h1 class="mb-1" style="color: #333; font-weight: 700;">Laporan Keuangan</h1>
				<p class="text-muted">Ringkasan pendapatan dan laporan keuangan toko</p>
			</div>
			<form class="d-flex" method="GET" action="{{ request()->url() }}">
				<input type="date" name="start_date" class="form-control form-control-sm me-2" value="{{ old('start_date', $start_date ?? '') }}">
				<input type="date" name="end_date" class="form-control form-control-sm me-2" value="{{ old('end_date', $end_date ?? '') }}">
				<button class="btn btn-sm btn-primary me-2">Filter</button>
				<a href="{{ request()->fullUrlWithQuery(['export' => 'csv']) }}" class="btn btn-sm btn-outline-secondary">Export CSV</a>
			</form>
		</div>
	</div>

	<div class="row mb-4">
		<div class="col-md-6 col-lg-3 mb-3">
			<div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #f97316 0%, #ea580c 100%);">
				<div class="card-body text-white">
					<p class="card-text mb-2" style="opacity: 0.9;">Total Pendapatan</p>
					<h3 style="font-weight:700;">Rp {{ number_format($totalPendapatan ?? 0, 0, ',', '.') }}</h3>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-3 mb-3">
			<div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #06b6d4 0%, #0ea5e9 100%);">
				<div class="card-body text-white">
					<p class="card-text mb-2" style="opacity: 0.9;">Total Pesanan</p>
					<h3 style="font-weight:700;">{{ $totalPesanan ?? 0 }}</h3>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-3 mb-3">
			<div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #10b981 0%, #059669 100%);">
				<div class="card-body text-white">
					<p class="card-text mb-2" style="opacity: 0.9;">Total Produk</p>
					<h3 style="font-weight:700;">{{ $totalProduk ?? 0 }}</h3>
				</div>
			</div>
		</div>

		<div class="col-md-6 col-lg-3 mb-3">
			<div class="card border-0 shadow-sm h-100" style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);">
				<div class="card-body text-white">
					<p class="card-text mb-2" style="opacity: 0.9;">Total Pelanggan</p>
					<h3 style="font-weight:700;">{{ $totalPelanggan ?? 0 }}</h3>
				</div>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-lg-8 mb-3">
			<div class="card border-0 shadow-sm">
				<div class="card-header bg-white border-bottom" style="padding: 1.25rem;">
					<h5 class="mb-0" style="font-weight: 600; color: #333;"><i class="fas fa-receipt me-2" style="color: #f97316"></i>Pemesanan Terbaru</h5>
				</div>
				<div class="card-body p-0">
					@if($pesanan && count($pesanan) > 0)
						<div class="table-responsive">
							<table class="table table-hover mb-0">
								<thead class="table-light">
									<tr>
										<th>ID</th>
										<th>ID Konsumen</th>
										<th>Total Biaya</th>
										<th>Status</th>
										<th>Tanggal</th>
									</tr>
								</thead>
								<tbody>
									@foreach($pesanan as $p)
										<tr>
											<td>#{{ $p->id_pemesanan }}</td>
											<td>{{ $p->id_konsumen }}</td>
											<td>Rp {{ number_format($p->total_biaya ?? 0, 0, ',', '.') }}</td>
											<td>
												@php
													$statusClass = match($p->status) {
														'pending' => 'warning',
														'completed' => 'success',
														'cancelled' => 'danger',
														'processing' => 'info',
														default => 'secondary'
													};
													$statusLabel = match($p->status) {
														'pending' => 'Menunggu',
														'completed' => 'Selesai',
														'cancelled' => 'Dibatalkan',
														'processing' => 'Diproses',
														default => ucfirst($p->status)
													};
												@endphp
												<span class="badge bg-{{ $statusClass }}">{{ $statusLabel }}</span>
											</td>
											<td>{{ $p->tanggal ? \Carbon\Carbon::parse($p->tanggal)->format('d M Y') : '-' }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					@else
						<div class="p-5 text-center text-muted">Belum ada data pesanan</div>
					@endif
				</div>
			</div>
		</div>

		<div class="col-lg-4 mb-3">
			<div class="card border-0 shadow-sm">
				<div class="card-header bg-white border-bottom" style="padding: 1.25rem;">
					<h5 class="mb-0" style="font-weight: 600; color: #333;"><i class="fas fa-chart-line me-2" style="color: #06b6d4"></i>Pendapatan Per Bulan</h5>
				</div>
				<div class="card-body">
					<div style="height:220px;">
						<canvas id="pendapatanChart" style="max-height:220px; width:100%;"></canvas>
					</div>
					<hr />
					@if($pendapatanPerBulan && count($pendapatanPerBulan) > 0)
						<ul class="list-unstyled mb-0">
							@foreach($pendapatanPerBulan as $row)
								<li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;">
									<div class="d-flex justify-content-between">
										<div>{{ \Carbon\Carbon::createFromFormat('Y-m', $row->month)->translatedFormat('F Y') }}</div>
										<div>Rp {{ number_format($row->total ?? 0, 0, ',', '.') }}</div>
									</div>
								</li>
							@endforeach
						</ul>
					@else
						<div class="text-muted">Tidak ada data pendapatan</div>
					@endif
				</div>
			</div>
			<!-- Daily revenue card (inside same column) -->
			<div class="card border-0 shadow-sm mt-3">
				<div class="card-header bg-white border-bottom" style="padding: 1.25rem;">
					<h5 class="mb-0" style="font-weight: 600; color: #333;"><i class="fas fa-calendar-day me-2" style="color: #10b981"></i>Pendapatan Per Hari (7 hari)</h5>
				</div>
				<div class="card-body">
					<div style="height:180px;">
						<canvas id="pendapatanDailyChart" style="max-height:180px; width:100%;"></canvas>
					</div>
					<hr />
					@if(isset($pendapatanPerHari) && count($pendapatanPerHari) > 0)
						<ul class="list-unstyled mb-0">
							@foreach($pendapatanPerHari as $row)
								<li style="padding: 0.35rem 0; border-bottom: 1px solid #f1f5f9; font-size:0.95rem;">
									<div class="d-flex justify-content-between">
										<div>{{ \Carbon\Carbon::createFromFormat('Y-m-d', $row->day)->format('d M') }}</div>
										<div>Rp {{ number_format($row->total ?? 0, 0, ',', '.') }}</div>
									</div>
								</li>
							@endforeach
						</ul>
					@else
						<div class="text-muted">Tidak ada data harian</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
	(function(){
		const ctx = document.getElementById('pendapatanChart');
		if (!ctx) return;

		const labels = [
			@foreach($pendapatanPerBulan as $row)
				'{{ \Carbon\Carbon::createFromFormat('Y-m', $row->month)->translatedFormat('F Y') }}',
			@endforeach
		];

		const dataValues = [
			@foreach($pendapatanPerBulan as $row)
				{{ (float) $row->total }},
			@endforeach
		];

		new Chart(ctx.getContext('2d'), {
			type: 'line',
			data: {
				labels: labels,
				datasets: [{
					label: 'Pendapatan',
					data: dataValues,
					fill: true,
					backgroundColor: 'rgba(59,130,246,0.12)',
					borderColor: 'rgba(59,130,246,0.9)',
					tension: 0.3,
					pointRadius: 3,
				}]
			},
			options: {
				responsive: true,
				maintainAspectRatio: false,
				scales: {
					y: {
						beginAtZero: true,
						ticks: {
							callback: function(value) { return 'Rp ' + value.toLocaleString('id-ID'); }
						}
					}
				},
				plugins: {
					legend: { display: false }
				}
			}
		});
		// Daily chart
		const ctx2 = document.getElementById('pendapatanDailyChart');
		if (ctx2) {
			const labels2 = [
				@foreach($pendapatanPerHari as $row)
					'{{ \Carbon\Carbon::createFromFormat('Y-m-d', $row->day)->format('d M') }}',
				@endforeach
			];

			const dataValues2 = [
				@foreach($pendapatanPerHari as $row)
					{{ (float) $row->total }},
				@endforeach
			];

			new Chart(ctx2.getContext('2d'), {
				type: 'bar',
				data: {
					labels: labels2,
					datasets: [{
						label: 'Pendapatan Harian',
						data: dataValues2,
						backgroundColor: 'rgba(16,185,129,0.85)'
					}]
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					scales: {
						y: {
							beginAtZero: true,
							ticks: {
								callback: function(value) { return 'Rp ' + value.toLocaleString('id-ID'); }
							}
						}
					},
					plugins: { legend: { display: false } }
				}
			});
		}
	})();
</script>
@endpush
