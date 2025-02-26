@extends('layouts1.template')
<script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
@section('content')
    <!-- resources/views/akun/edit-myblog.blade.php -->
    <form action="{{ route('artikel.update', $blog->idArtikel) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT') <!-- Gunakan method PUT untuk update -->
        <div class="row" style="margin-left: 15rem; margin-right: 13rem;">
            <!-- Input Judul -->
            <div class="col-md-12" style="margin-top: 3rem">
                <input class="input" type="text" name="judul" id="judul" placeholder="Judul"
                    value="{{ $blog->judul }}" required> <!-- Tampilkan judul yang sudah ada -->
                @error('judul')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Select Button (Dropdown) -->
            <div class="col-md-12" style="margin-top: 3rem">
                <select class="input" name="idKategori" required>
                    <option value="" disabled>Pilih Kategori</option>
                    @foreach ($kategori as $kat)
                        <option value="{{ $kat->idKategori }}"
                            {{ $blog->idKategori == $kat->idKategori ? 'selected' : '' }}>{{ $kat->kategori }}
                        </option>
                    @endforeach
                </select>
                @error('idKategori')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Gambar -->
            <div class="col-md-12" style="margin-top: 3rem">
                <label for="image" class="form-label">Gambar</label>
                <input type="file" name="gambar" id="img"
                    class="form-control @error('gambar') is-invalid @enderror" onchange="previewImage()">

                <!-- Tampilkan gambar yang sudah ada -->
                @if ($blog->gambar)
                    <img class="img-preview img-fluid mb-3 col-sm-7" src="{{ asset('/storage/' . $blog->gambar) }}"
                        alt="Preview Gambar">
                @else
                    <img class="img-preview img-fluid mb-3 col-sm-7" src="#" alt="Preview Gambar"
                        style="display: none;">
                @endif
                @error('gambar')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Deskripsi -->
            <div class="col-md-12" style="margin-top: 3rem">
                <label for="deskripsi">Deskripsi:</label>
                <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi">{{ $blog->deskripsi }}</textarea>
                <input type="hidden" name="deskripsi_validasi" id="deskripsi_validasi" required>
            </div>

            <!-- Submit Button -->
            <div class="col-md-12" style="margin-top: 3rem">
                <button type="submit" class="primary-button">Update</button>
            </div>
        </div>
    </form>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        // Fungsi untuk menampilkan preview gambar
        function previewImage() {
            const img = document.querySelector("#img");
            const imgPreview = document.querySelector(".img-preview");

            imgPreview.style.display = 'block';
            const reader = new FileReader();
            reader.readAsDataURL(img.files[0]);
            reader.onload = function(event) {
                imgPreview.src = event.target.result;
            }
        }
        document.addEventListener('DOMContentLoaded', function() {
            let editor;

            // Inisialisasi CKEditor
            ClassicEditor
                .create(document.querySelector('#deskripsi'), {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'underline', 'strikethrough', 'subscript', 'superscript', '|',
                            'fontSize', 'fontFamily', 'fontColor', 'fontBackgroundColor', '|',
                            'alignment', '|',
                            'numberedList', 'bulletedList', '|',
                            'outdent', 'indent', '|',
                            'link', 'blockQuote', 'insertTable', 'mediaEmbed', '|',
                            'undo', 'redo', '|',
                            'code', 'codeBlock', '|',
                            'horizontalLine', 'pageBreak', '|',
                            'specialCharacters', '|',
                            'sourceEditing', '|',
                            'MathType', 'ChemType'
                        ]
                    },
                    mathTypeParameters: {
                        serviceProviderProperties: {
                            URI: 'https://www.wiris.net/demo/plugins/app/WIRISplugins.js?viewer=image',
                            server: 'php'
                        }
                    },
                    height: 500,
                    entering: {
                        mode: 'div',
                        shiftEnterMode: 'br',
                    }
                })
                .then(instance => {
                    editor = instance;
                })
                .catch(error => {
                    console.error('Gagal menginisialisasi CKEditor:', error);
                });

            // Pastikan konten CKEditor disalin ke <textarea> sebelum form disubmit
            document.querySelector('form').addEventListener('submit', function(event) {
                if (editor) {
                    const hiddenInput = document.querySelector('#deskripsi_validasi');
                    hiddenInput.value = editor.getData();

                    if (!hiddenInput.value.trim()) {
                        event.preventDefault();
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: 'Deskripsi wajib diisi!',
                        });
                    }
                } else {
                    console.error('CKEditor belum diinisialisasi.');
                    event.preventDefault();
                }
            });
        });

        // Fungsi untuk menampilkan preview gambar
        function previewImage() {
            const img = document.querySelector("#img");
            const imgPreview = document.querySelector(".img-preview");

            imgPreview.style.display = 'block';
            const reader = new FileReader();
            reader.readAsDataURL(img.files[0]);
            reader.onload = function(event) {
                imgPreview.src = event.target.result;
            }
        }

        // Fungsi untuk menampilkan toast SweetAlert2
        document.addEventListener("DOMContentLoaded", function() {
            let successMessage = "{{ session('success') }}";
            let errorMessage = "{{ session('error') }}";

            if (successMessage) {
                Swal.fire({
                    icon: 'success',
                    title: 'Sukses!',
                    text: successMessage,
                    showConfirmButton: false,
                    timer: 3000
                });
            }

            if (errorMessage) {
                Swal.fire({
                    icon: 'error',
                    title: 'Gagal!',
                    text: errorMessage,
                    showConfirmButton: false,
                    timer: 3000
                });
            }
        });
    </script>
@endsection
