<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Latihan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  </head>
  <body>
    <h1 class="text-center mb-4 mt-4">Data Pegawai</h1>

        <div class="container">
            <a href="/tambahpegawai" type="button" class="btn btn-success mb-3">Tambah Data</a>
                <div class="row g-3 align-items-center mb-3">
                  <div class="col-auto">
                    <form action="/pegawai" method="GET">
                        <input type="search" id="inputPassword6" name="search" class="form-control" aria-describedby="passwordHelpInline">
                    </form>
                </div>
                <div class="col-auto mb-3">
                    <a href="/exportpdf" type="button" class="btn btn-danger">Export PDF</a>
                </div>
                <div class="col-auto mb-3">
                    <a href="/exportexcel" type="button" class="btn btn-warning">Export Excel</a>
                </div>
                <div class="col-auto mb-3">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Import Data
                    </button>
                </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="/importexcel" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="modal-body">
                             <div class="form-group">
                                <input type="file" name="file" required>
                             </div>
                            </div>
                            <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save changes</button>
                            </div>
                        </div>
                    </form>
                        </div>
                    </div>
            <div class="row">
                {{-- @if ($message = Session::get('success'))
                <div class="alert alert-success" role="alert">
                    {{ $message }}
                  </div>
                @endif --}}
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                          <th scope="col">NO</th>
                          <th scope="col">FOTO</th>
                          <th scope="col">NAMA</th>
                          <th scope="col">JENIS KELAMIN</th>
                          <th scope="col">NOMOR TELPON</th>
                          <th scope="col">DIBUAT</th>
                          <th scope="col">AKSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $no = 1;
                        @endphp
                        @foreach ($data as $index => $row)
                        <tr>
                            <th scope="row">{{ $index + $data->firstItem() }}</th>
                            <td>
                                <img src="{{ asset('fotopegawai/' .$row->foto) }}" alt="" style="width: 40px">
                            </td>
                            <td>{{ $row->nama }}</td>
                            <td>{{ $row->jeniskelamin }}</td>
                            <td>0{{ $row->notelp }}</td>
                            <td>{{ $row->created_at->format('d-m-Y') }}</td>
                            <td>
                              <a href="/tampildata/{{ $row->id }}" class="btn btn-primary">Edit</a>
                              <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}" >Delete</a>
                            </td>
                          </tr>
                        @endforeach
                      </tbody>
                </table>
                {{ $data->links() }}
            </div>
        </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  </body>

<script>
  $('.delete').click( function(){
    var pegawaiid = $(this).attr('data-id');
    var nama = $(this).attr('data-nama');
    Swal.fire({
        title: "Kamu Yakin?",
        text: "Kamu Akan Menghapus Data Dengan Nama "+nama+"",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, Hapus!"
        }).then((result) => {
        if (result.isConfirmed) {
            window. location = "/delete/"+pegawaiid+""
            Swal.fire({
            title: "Deleted!",
            text: "Data Telah Terhapus.",
            icon: "success"
            });
        }
    });
  });
</script>

<script>
  @if (Session::has('success'))
    toastr.success("{{ Session::get('success') }}");
  @endif
</script>

</html>
