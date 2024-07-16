@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center mb-3">Data Rooms</h5>
                <button type="button" class="btn btn-success btn-sm" onclick="tambah_rooms();">
                    Tambah Data
                </button>
                <table id="table_rooms" class="table table-striped nowrap" style="width:100%">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Available</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="tambahrooms" tabindex="-1" role="dialog" aria-labelledby="tmk"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="tk">Tambah Data Rooms</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="formtambahrooms"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary" form="prosestambahrooms">Simpan</button>
                    <button type="button" class="btn btn-sm btn-danger" data-bs-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bs-example-modal-lg" id="editrooms" tabindex="-1" role="dialog" aria-labelledby="ek"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="ek">Edit Data Rooms</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="formeditrooms"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-sm btn-primary" form="proseseditrooms">Update</button>
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

            function table_rooms() {

                var table_rooms = $('#table_rooms').DataTable({
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
                        url: "{{ route('rooms.index') }}",
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
                            data: 'name'
                        },
                        {
                            data: 'description'
                        },
                        {
                            data: 'is_available'
                        },
                        {
                            data: 'action',
                            orderable: false,
                            searchable: false
                        }
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

            table_rooms();

        });

        function tambah_rooms() {
            $.ajax({
                type: "GET",
                url: "{{ route('rooms.create') }}",
                data: {},
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    swal.close();
                    $('#tambahrooms').modal('show');
                    $('#formtambahrooms').html(data);
                }
            });
        }

        function edit_rooms(id_rooms) {
            $.ajax({
                type: "GET",
                url: "/rooms/" + id_rooms + "/edit",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    swal.close();
                    $('#editrooms').modal('show');
                    $('#formeditrooms').html(data);
                }
            });
        }


        function hapus_rooms(id_rooms) {
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
                        url: "/rooms/" + id_rooms, // Update URL here
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
                            $('#table_rooms').DataTable().ajax.reload(null, false)
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
