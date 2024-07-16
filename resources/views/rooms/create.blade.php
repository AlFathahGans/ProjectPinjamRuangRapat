<form id="prosestambahrooms" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-12">
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                        value="" maxlength="50" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea id="description" name="description" required placeholder="Enter Description" class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Available</label>
                    <select id="is_available" name="is_available" required class="form-control">
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $('#prosestambahrooms').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('rooms.store') }}",
            method: "POST",
            data: new FormData(this),
            processData: false,
            contentType: false,
            async: true,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend: function() {
                Swal.fire({
                    title: "Menyimpan",
                    text: "Silahkan Tunggu, Proses Memakan Waktu",
                    onOpen: () => {
                        Swal.showLoading()
                    }
                });
            },
            success: function(response) {
                Swal.fire({
                    icon: "success",
                    title: "Berhasil",
                    text: "Tambah Sukses!",
                    timer: 1500,
                });
                $('#tambahrooms').modal('hide');
                $("#table_rooms").DataTable().ajax.reload(null, false);
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Tambah Gagal!",
                });
            }
        });
        return false;
    });
</script>
