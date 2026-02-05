@extends('layouts.app')

@section('content')
    <div style="max-width: 800px; margin: 0 auto; padding: 2rem 1rem;">
        <!-- Header -->
        <div class="mb-4">
            <h1 class="mb-1" style="color: #333; font-weight: 700; font-size: 2rem;">
                <i class="fas fa-edit me-2" style="color: #3b82f6;"></i>Edit Produk
            </h1>
            <p class="text-muted" style="margin: 0;">Perbarui informasi produk</p>
        </div>

        <!-- Form Card -->
        <div class="card border-0 shadow-sm" style="border-radius: 10px;">
            <div class="card-body p-4">
                <form action="{{ route('admin.produk.update', $tproduk->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Nama Produk -->
                    <div class="mb-4">
                        <label for="nama_produk" class="form-label" style="font-weight: 600; color: #333;">
                            <i class="fas fa-tag me-2" style="color: #3b82f6;"></i>Nama Produk
                        </label>
                        <input type="text" class="form-control @error('nama_produk') is-invalid @enderror" id="nama_produk"
                            name="nama_produk" placeholder="Masukkan nama produk"
                            value="{{ old('nama_produk', $tproduk->nama_produk) }}" required
                            style="padding: 0.75rem 1rem; border: 1px solid #e0e0e0; border-radius: 8px; transition: all 0.3s ease;">
                        @error('nama_produk')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label for="deskripsi" class="form-label" style="font-weight: 600; color: #333;">
                            <i class="fas fa-align-left me-2" style="color: #3b82f6;"></i>Deskripsi Produk
                        </label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi"
                            name="deskripsi" rows="5" placeholder="Tuliskan deskripsi lengkap tentang produk..." required
                            style="padding: 0.75rem 1rem; border: 1px solid #e0e0e0; border-radius: 8px; transition: all 0.3s ease;">{{ old('deskripsi', $tproduk->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Harga -->
                    <div class="mb-4">
                        <label for="harga" class="form-label" style="font-weight: 600; color: #333;">
                            <i class="fas fa-dollar-sign me-2" style="color: #3b82f6;"></i>Harga (Rp)
                        </label>
                        <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                            name="harga" placeholder="Contoh: 150000" value="{{ old('harga', $tproduk->harga) }}"
                            step="0.01" min="0" required
                            style="padding: 0.75rem 1rem; border: 1px solid #e0e0e0; border-radius: 8px; transition: all 0.3s ease;">
                        @error('harga')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Foto -->
                    <div class="mb-4">
                        <label for="foto" class="form-label" style="font-weight: 600; color: #333;">
                            <i class="fas fa-image me-2" style="color: #3b82f6;"></i>Foto Produk
                        </label>

                        <!-- Existing Image -->
                        @if($tproduk->foto)
                            <div class="mb-2">
                                <small class="text-muted d-block mb-1">Foto Saat Ini:</small>
                                <img src="{{ asset('storage/' . $tproduk->foto) }}" alt="Current Image" class="img-thumbnail"
                                    style="max-height: 150px;">
                            </div>
                        @endif

                        <div class="input-group">
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/*" onchange="previewImage(event)"
                                style="padding: 0.75rem 1rem; border: 1px solid #e0e0e0; border-radius: 8px; transition: all 0.3s ease;">
                        </div>
                        <small class="text-muted d-block mt-2">
                            <i class="fas fa-info-circle me-1"></i>Biarkan kosong jika tidak ingin mengubah foto.
                        </small>
                        @error('foto')
                            <div class="invalid-feedback d-block">{{ $message }}</div>
                        @enderror

                        <!-- Image Preview -->
                        <div id="preview-container" class="mt-3" style="display: none;">
                            <small class="text-muted d-block mb-1">Preview Foto Baru:</small>
                            <img id="preview-image" src="" alt="Preview"
                                style="max-width: 300px; max-height: 300px; border-radius: 8px; border: 1px solid #e0e0e0; padding: 5px;">
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="d-flex gap-3 justify-content-end mt-5">
                        <a href="{{ route('admin.produk.index') }}" class="btn btn-lg"
                            style="background-color: #f0f0f0; color: #333; font-weight: 600; border: none; padding: 0.75rem 2rem; border-radius: 8px; transition: all 0.3s ease;"
                            onmouseover="this.style.backgroundColor='#e0e0e0'; this.style.transform='translateY(-2px)';"
                            onmouseout="this.style.backgroundColor='#f0f0f0'; this.style.transform='translateY(0)';">
                            <i class="fas fa-arrow-left me-2"></i>Batal
                        </a>
                        <button type="submit" class="btn btn-lg"
                            style="background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: white; font-weight: 600; border: none; padding: 0.75rem 2rem; border-radius: 8px; box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3); transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 8px 20px rgba(59, 130, 246, 0.5)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 15px rgba(59, 130, 246, 0.3);'">
                            <i class="fas fa-save me-2"></i>Perbarui Produk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const preview = document.getElementById('preview-image');
            const container = document.getElementById('preview-container');

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    container.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                container.style.display = 'none';
            }
        }
    </script>
@endsection