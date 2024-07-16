<form id="proseseditbookings" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row">
        <div class="col-12">
            <div class="card-body">
                <div class="mb-3">
                    <label for="user_id" class="form-label">User</label>
                    <select class="form-control" id="user_id" name="user_id" required=""></select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Room</label>
                    <select class="form-control" id="room_id" name="room_id" required=""></select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select class="form-control" id="status_id" name="status_id" required=""></select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Approval Status</label>
                    <select class="form-control" id="approval_status_id" name="approval_status_id" required=""></select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Start Time</label>
                    <input type="datetime-local" class="form-control" id="start_time" name="start_time" required="">
                </div>
                <div class="mb-3">
                    <label class="form-label">End Time</label>
                    <input type="datetime-local" class="form-control" id="end_time" name="end_time" required="">
                </div>
            </div>
        </div>
    </div>
</form>

<script type="text/javascript">
    $('#proseseditbookings').on('submit', function(e) {
        e.preventDefault();
        $.ajax({
            url: "{{ route('bookings.update', $booking->id) }}",
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
                $('#editbookings').modal('hide');
                $("#table_bookings").DataTable().ajax.reload(null, false);
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

    function loadSelectOptions() {
        $.ajax({
            url: '{{ route('users.index') }}',
            type: 'GET',
            success: function(data) {
                var users = data.data;
                $('#user_id').empty();
                $.each(users, function(index, user) {
                    $('#user_id').append('<option value="' + user.id + '">' + user.name +
                        '</option>');
                });
                $('#user_id').val("{{ $booking->user_id }}");
            }
        });

        $.ajax({
            url: '{{ route('rooms.index') }}',
            type: 'GET',
            success: function(data) {
                var rooms = data.data;
                $('#room_id').empty();
                $.each(rooms, function(index, room) {
                    $('#room_id').append('<option value="' + room.id + '">' + room.name +
                        '</option>');
                });
                $('#room_id').val("{{ $booking->room_id }}");
            }
        });

        $.ajax({
            url: '{{ route('status.index') }}',
            type: 'GET',
            success: function(data) {
                var status = data.data;
                $('#status_id').empty();
                $.each(status, function(index, status) {
                    $('#status_id').append('<option value="' + status.id + '">' + status.name +
                        '</option>');
                });
                $('#status_id').val("{{ $booking->status_id }}");
            }
        });

        $.ajax({
            url: '{{ route('approval_status.index') }}',
            type: 'GET',
            success: function(data) {
                var approval_status = data.data;
                $('#approval_status_id').empty();
                $.each(approval_status, function(index, approval_status) {
                    $('#approval_status_id').append('<option value="' + approval_status.id + '">' +
                        approval_status.name + '</option>');
                });
                $('#approval_status_id').val("{{ $booking->approval_status_id }}");
            }
        });

        $('#start_time').val("{{ $booking->start_time }}");
        $('#end_time').val("{{ $booking->end_time }}");
    }

    loadSelectOptions();
</script>
