@extends('layouts1.template')

@section('content')
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <!-- post -->
                    @foreach ($artikel as $haha)
                        <div class="post post-row mb-4">
                            <!-- Gambar Artikel -->
                            <a class="post-img" href="{{ route('artikel.show', $haha->idArtikel) }}">
                                <img src="{{ asset('/storage/' . $haha->gambar) }}" alt=""
                                    style="width: 100%; height: 300px; object-fit: cover;">
                            </a>

                            <!-- Konten Artikel -->
                            <div class="post-body p-3">
                                <!-- Kategori -->
                                <div class="post-category mb-2">
                                    <span class="badge bg-secondary">{{ $haha->kategoris->kategori }}</span>
                                </div>

                                <!-- Judul -->
                                <h3 class="post-title mb-2">
                                    <a href="{{ route('artikel.show', $haha->idArtikel) }}"
                                        class="text-decoration-none text-dark">
                                        {{ $haha->judul }}
                                    </a>
                                </h3>

                                <!-- Meta Informasi -->
                                <ul class="post-meta list-inline mb-3">
                                    <li class="list-inline-item">
                                        <i class="fa fa-user"></i> <a href="#"
                                            class="text-decoration-none">{{ $haha->users->name }}</a>
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="fa fa-calendar"></i>
                                        {{ $haha->created_at ? $haha->created_at->format('d F Y') : 'No date available' }}
                                    </li>
                                </ul>

                                <!-- Deskripsi Singkat -->
                                <div class="post-description mb-3">
                                    @if (!empty($haha->deskripsi))
                                        @foreach (array_slice(explode("\n", $haha->deskripsi), 0, 1) as $paragraph)
                                            <div>
                                                {!! \Illuminate\Support\Str::words($paragraph, 50, '...') !!}
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="text-muted">Tidak ada deskripsi.</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <!-- /post -->

                    {{-- <div class="pagination justify-content-center" style="margin-left: 90rem">
                        {{ $artikel->links('pagination::bootstrap-4') }}
                    </div> --}}

                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- Sertakan SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Tangani klik tombol hapus
            document.querySelectorAll('.delete-btn').forEach(button => {
                button.addEventListener('click', function(event) {
                    event.preventDefault(); // Hentikan aksi default (mengikuti link)

                    const artikelId = this.getAttribute('data-id'); // Ambil ID artikel
                    const deleteUrl = this.getAttribute('href'); // Ambil URL penghapusan

                    // Tampilkan konfirmasi SweetAlert2
                    Swal.fire({
                        title: 'Apakah Anda yakin?',
                        text: "Anda tidak dapat mengembalikan data ini!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#3085d6',
                        confirmButtonText: 'Ya, hapus!',
                        cancelButtonText: 'Batal'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Jika dikonfirmasi, kirim request penghapusan
                            fetch(deleteUrl, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}', // Sertakan token CSRF
                                    'Content-Type': 'application/json'
                                }
                            }).then(response => {
                                if (response.ok) {
                                    // Redirect atau refresh halaman setelah penghapusan
                                    window.location.href =
                                        '{{ route('myblog') }}';
                                } else {
                                    Swal.fire('Gagal!',
                                        'Terjadi kesalahan saat menghapus artikel.',
                                        'error');
                                }
                            }).catch(error => {
                                Swal.fire('Gagal!',
                                    'Terjadi kesalahan saat menghapus artikel.',
                                    'error');
                            });
                        }
                    });
                });
            });
        });
    </script>
@endsection
