@extends('layouts.app')

@section('content')
    <div style="max-width: 1200px; margin: 0 auto;">
        <!-- Header -->
        <div class="row mb-4 align-items-center">
            <div class="col-12 col-md-6">
                <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">Pelanggan</h1>
                <p class="text-muted" style="margin: 0;">Kelola data pelanggan toko Anda</p>
            </div>
            <div class="col-12 col-md-6 text-end">
                <a href="{{route('admin.pelanggan.create')}}" class="btn btn-primary btn-lg"
                    style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none; font-weight: 600; padding: 0.7rem 2rem; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); transition: all 0.3s ease;"
                    onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.5)';"
                    onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.3)';">
                    <i class="fas fa-plus me-2"></i>Tambah Pelanggan
                </a>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="row mb-4">
            <div class="col-12">
                <form method="GET" action="{{ route('admin.pelanggan.index') }}" class="d-flex gap-2">
                    <div class="flex-grow-1">
                        <input type="text" name="search" class="form-control form-control-lg"
                            placeholder="Cari pelanggan berdasarkan nama atau email..." value="{{ $search ?? '' }}"
                            style="border-color: #ddd; border-radius: 8px; box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05); transition: all 0.3s ease;"
                            onfocus="this.style.borderColor='#667eea'; this.style.boxShadow='0 2px 12px rgba(102, 126, 234, 0.3)';"
                            onblur="this.style.borderColor='#ddd'; this.style.boxShadow='0 2px 8px rgba(0, 0, 0, 0.05)';">
                    </div>
                    <button type="submit" class="btn btn-primary btn-lg"
                        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none; font-weight: 600; padding: 0.7rem 1.5rem; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3); transition: all 0.3s ease; white-space: nowrap;"
                        onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(102, 126, 234, 0.5)';"
                        onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(102, 126, 234, 0.3)';">
                        <i class="fas fa-search me-2"></i>Cari
                    </button>
                    @if($search)
                        <a href="{{ route('admin.pelanggan.index') }}" class="btn btn-outline-secondary btn-lg"
                            style="border-color: #ddd; color: #666; font-weight: 600; padding: 0.7rem 1.5rem; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='#f8f9fa';"
                            onmouseout="this.style.backgroundColor='transparent';">
                            <i class="fas fa-times me-2"></i>Reset
                        </a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Search Results Info -->
        @if($search)
            <div class="row mb-4">
                <div class="col-12">
                    <div class="alert alert-info d-flex align-items-center"
                        style="background: linear-gradient(135deg, rgba(102, 126, 234, 0.1) 0%, rgba(118, 75, 162, 0.1) 100%); border: 1px solid rgba(102, 126, 234, 0.3); border-radius: 8px;">
                        <i class="fas fa-search me-2" style="color: #667eea; font-size: 1.1rem;"></i>
                        <span style="color: #333;">
                            Hasil pencarian untuk <strong>"{{ $search }}"</strong>
                            <span style="color: #667eea; font-weight: 600;">({{ count($pelanggan) }} pelanggan ditemukan)</span>
                        </span>
                    </div>
                </div>
            </div>
        @endif

        @if($pelanggan && count($pelanggan) > 0)
            <!-- Customers Table -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0" style="background-color: white;">
                                <thead>
                                    <tr
                                        style="background: linear-gradient(135deg, #f8f9fa 0%, #f0f1f3 100%); border-bottom: 2px solid #ddd;">
                                        <th style="color: #333; font-weight: 600; padding: 1.2rem; border: none;">No.</th>
                                        <th style="color: #333; font-weight: 600; padding: 1.2rem; border: none;">Nama Pelanggan
                                        </th>
                                        <th style="color: #333; font-weight: 600; padding: 1.2rem; border: none;">Email</th>
                                        <th style="color: #333; font-weight: 600; padding: 1.2rem; border: none;">Nomor Telepon
                                        </th>
                                        <th style="color: #333; font-weight: 600; padding: 1.2rem; border: none;">Bergabung</th>
                                        <th
                                            style="color: #333; font-weight: 600; padding: 1.2rem; border: none; text-align: center;">
                                            Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($pelanggan as $index => $p)
                                        <tr style="border-bottom: 1px solid #eee; transition: all 0.3s ease;"
                                            onmouseover="this.style.backgroundColor='#f8f9fa';"
                                            onmouseout="this.style.backgroundColor='white';">
                                            <td style="color: #666; padding: 1.2rem; border: none;">{{ $index + 1 }}</td>
                                            <td style="color: #333; font-weight: 500; padding: 1.2rem; border: none;">
                                                <i class="fas fa-user-circle me-2" style="color: #667eea;"></i>
                                                {{ $p->name }}
                                            </td>
                                            <td style="color: #666; padding: 1.2rem; border: none;">
                                                <a href="mailto:{{ $p->email }}" style="color: #667eea; text-decoration: none;">
                                                    {{ $p->email }}
                                                </a>
                                            </td>
                                            <td style="color: #666; padding: 1.2rem; border: none;">
                                                {{ $p->detail->nomor_telepon ?? '-' }}
                                            </td>
                                            <td style="color: #666; padding: 1.2rem; border: none;">
                                                {{ $p->created_at ? $p->created_at->format('d M Y') : '-' }}
                                            </td>
                                            <td style="color: #666; padding: 1.2rem; border: none; text-align: center;">
                                                <div class="d-flex justify-content-center gap-2">
                                                    <a href="{{ route('admin.pelanggan.show', $p->id) }}"
                                                        class="btn btn-sm btn-outline-primary"
                                                        style="border-color: #667eea; color: #667eea; font-weight: 500; transition: all 0.3s ease; padding: 0.4rem 0.8rem;">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('admin.pelanggan.edit', $p->id) }}"
                                                        class="btn btn-sm btn-outline-warning"
                                                        style="border-color: #f59e0b; color: #f59e0b; font-weight: 500; transition: all 0.3s ease; padding: 0.4rem 0.8rem;">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <button type="button" class="btn btn-sm btn-outline-danger"
                                                        style="border-color: #ef4444; color: #ef4444; font-weight: 500; transition: all 0.3s ease; padding: 0.4rem 0.8rem;"
                                                        onclick="hapusPelanggan({{ $p->id }})">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty State -->
            <div class="row">
                <div class="col-12">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-5 text-center">
                            <i class="fas fa-users"
                                style="font-size: 3rem; color: #ddd; margin-bottom: 1rem; display: block;"></i>
                            <h5 style="color: #666; margin-bottom: 0.5rem;">Tidak Ada Pelanggan</h5>
                            <p class="text-muted">Belum ada data pelanggan. Mulai dengan menambahkan pelanggan baru.</p>
                            <a href="{{route('admin.pelanggan.create')}}" class="btn btn-primary mt-3"
                                style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border: none;">
                                <i class="fas fa-plus me-2"></i>Tambah Pelanggan Baru
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <!-- Modal Konfirmasi Hapus -->
    <div class="modal fade" id="modalHapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header"
                    style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); color: white; border: none;">
                    <h5 class="modal-title" style="font-weight: 600;">
                        <i class="fas fa-trash me-2"></i>Hapus Pelanggan
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body p-4">
                    <p style="color: #666; margin: 0;">
                        Apakah Anda yakin ingin menghapus pelanggan <strong id="namaPelangganHapus"></strong>?
                    </p>
                    <p style="color: #999; font-size: 0.9rem; margin-top: 0.5rem;">Tindakan ini tidak dapat dibatalkan.</p>
                </div>
                <div class="modal-footer border-top" style="padding: 1rem;">
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal"
                        style="border-color: #ddd;">Batal</button>
                    <form id="formHapus" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger"
                            style="background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%); border: none;">
                            <i class="fas fa-trash me-2"></i>Hapus Pelanggan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            border-radius: 12px;
            transition: all 0.3s ease;
        }

        .table tbody tr {
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(59, 130, 246, 0.4) !important;
        }

        .btn-outline-primary:hover {
            background-color: #667eea;
            color: white !important;
        }

        .btn-outline-warning:hover {
            background-color: #f59e0b;
            color: white !important;
        }

        .btn-outline-danger:hover {
            background-color: #ef4444;
            color: white !important;
        }

        .modal-content {
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }
    </style>

    <script>
        let idPelangganHapus = null;

        function hapusPelanggan(id) {
            // Dapatkan nama pelanggan dari tabel
            const row = event.target.closest('tr');
            const namaPelanggan = row.querySelector('td:nth-child(2)').innerText.trim();

            idPelangganHapus = id;
            document.getElementById('namaPelangganHapus').innerText = namaPelanggan;

            // Set action url
            const form = document.getElementById('formHapus');
            form.action = "{{ route('admin.pelanggan.destroy', ':id') }}".replace(':id', id);

            const modal = new bootstrap.Modal(document.getElementById('modalHapus'));
            modal.show();
        }
    </script>
@endsection