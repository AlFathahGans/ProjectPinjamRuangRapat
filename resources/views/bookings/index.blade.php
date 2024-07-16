@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center mb-3">Data Bookings</h5>
                <button type="button" class="btn btn-success btn-sm" onclick="tambah_bookings();">
                    Tambah Data
                </button>
                <table id="table_bookings" class="table table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>User</th>
                            <th>Room</th>
                            <th>Status</th>
                            <th>Approval Status</th>
                            <th>Start Time</th>
                            <th>End Time</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="tambahbookings" tabindex="-1" role="dialog" aria-labelledby="tmk"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="tk">Tambah Data Bookings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="formtambahbookings"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary" form="prosestambahbookings">Simpan</button>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="editbookings" tabindex="-1" role="dialog" aria-labelledby="ek"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="ek">Edit Data Bookings</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="formeditbookings"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary" form="proseseditbookings">Update</button>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            function table_bookings() {

                var table_bookings = $('#table_bookings').DataTable({
                    responsive: true,
                    ordering: false,
                    processing: true,
                    serverSide: true,
                    pageLength: 5,
                    lengthMenu: [
                        [5, 10, 25, 50, 100, -1],
                        [5, 10, 25, 50, 100, "Semua"]
                    ],
                    order: [],
                    ajax: {
                        url: "{{ route('bookings.index') }}",
                        method: "GET",
                        data: {}
                    },
                    columnDefs: [{
                        targets: [-1],
                        orderable: false,
                    }],
                    columns: [{
                            data: null,
                            orderable: false,
                            searchable: false
                        },
                        {
                            data: 'user.name',
                            name: 'user.name'
                        },
                        {
                            data: 'room.name',
                            name: 'room.name'
                        },
                        {
                            data: 'status.name',
                            name: 'status.name'
                        },
                        {
                            data: 'approval_status.name',
                            name: 'approval_status.name'
                        },
                        {
                            data: 'start_time',
                            name: 'start_time'
                        },
                        {
                            data: 'end_time',
                            name: 'end_time'
                        },
                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },
                    ],
                    drawCallback: function(settings) {
                        var api = this.api();
                        var start = api.page.info().start;
                        api.column(0, {
                            page: 'current'
                        }).nodes().each(function(cell, i) {
                            cell.innerHTML = start + i + 1;
                        });
                    }
                });
            }

            table_bookings();

        });

        function tambah_bookings() {
            $.ajax({
                type: "GET",
                url: "{{ route('bookings.create') }}",
                data: {},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    swal.close();
                    $('#tambahbookings').modal('show');
                    $('#formtambahbookings').html(data);
                }
            });
        }

        function edit_bookings(id_bookings) {
            $.ajax({
                type: "GET",
                url: "/bookings/" + id_bookings + "/edit",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    swal.close();
                    $('#editbookings').modal('show');
                    $('#formeditbookings').html(data);
                }
            });
        }


        function hapus_bookings(id_bookings) {
            Swal.fire({
                title: 'Konfirmasi',
                text: 'Anda ingin menghapus?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Hapus',
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                cancelButtonText: 'Tidak',
                reverseButtons: true
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url: "/bookings/" + id_bookings, // Update URL here
                        method: "DELETE",
                        beforeSend: function() {
                            swal.fire({
                                title: 'Menunggu',
                                html: 'Memproses Data',
                                onOpen: () => {
                                    swal.showLoading()
                                }
                            })
                        },
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Data Dihapus',
                                text: 'Anda Berhasil Hapus Data',
                                timer: 1500,
                            });
                            $('#table_bookings').DataTable().ajax.reload(null, false)
                        }
                    })
                } else if (result.dismiss === swal.DismissReason.cancel) {
                    Swal.fire(
                        'Batal',
                        'Anda Membatalkan',
                        'error'
                    )
                }
            })
        }
    </script>
@endpush
