<form id="proseseditrooms" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="card-body">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name"
                        value="{{ $room->name }}" maxlength="50" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label>
                    <textarea id="description" name="description" required placeholder="Enter Description" class="form-control">{{ $room->description }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Available</label>
                    <select id="is_available" name="is_available" required class="form-control">
                        <option value="1" {{ $room->is_available ? 'selected' : '' }}>Yes</option>
                        <option value="0" {{ !$room->is_available ? 'selected' : '' }}>No</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $('#proseseditrooms').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('rooms.update', $room->id) }}",
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
                    text: "Update Sukses!",
                    timer: 1500,
                });
                $('#editrooms').modal('hide');
                $("#table_rooms").DataTable().ajax.reload(null, false);
            },
            error: function(xhr) {
                Swal.fire({
                    icon: "error",
                    title: "Gagal",
                    text: "Update Gagal!",
                });
            }
        });
        return false;
    });
</script>
