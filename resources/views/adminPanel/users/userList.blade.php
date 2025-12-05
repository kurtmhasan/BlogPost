@extends('adminPanel.layouts.admin')

@section('title', 'Kullanıcı Listesi')

@section('content')
    <div class="container mt-4">
        <h3>Kullanıcılar</h3>
        <table class="table table-bordered" id="users-table">
            <thead>
            <tr>
                <th>ID</th>
                <th>Ad</th>
                <th>role</th>
                <th>statü</th>
                <th>mail adres</th>
                <th>Oluşturulma</th>
                <th>İşlem</th>
            </tr>
            </thead>
        </table>
    </div>
@endsection


@push('scripts')
    <script>
        let table;
        $(function () {
            table = $('#users-table').DataTable({
                processing: true,
                serverSide: true,
                ajax: '{{ route('admin.list.user') }}',
                columns: [
                    { data: 'id', name: 'id' },
                    {
                        data: 'name',
                        name: 'name',
                        render:function (name,type,row){
                            let url = "{{route('admin.show.user', ':id')}}".replace(':id',row.id);
                            return `<a href="${url}" class="user-link">${name}</a>`;
                        }
                    },
                    { data: 'role', name: 'role' },
                    { data: 'is_active', name: 'is_active' },
                    { data: 'email', name: 'email' },
                    { data: 'created_at', name: 'created_at' },
                    { // action kolonu
                        data: 'id',
                        name: 'action',
                        orderable: false,
                        searchable: false,
                        render: function(id, type, row) {
                            let btnClass = row.is_active ? 'btn-danger' : 'btn-warning';
                            let btnText = row.is_active ? 'banla' : 'Banı kaldır';
                            return `<button class="btn btn-sm ${btnClass} ban" data-id="${id}">${btnText}</button>`;
                        }
                    }
                ]
            });
        });


        $(document).on('click','.ban', function (){
            let id = $(this).data('id');

            $.ajax({
                url:"{{route('admin.ban.user', ':id')}}".replace(':id', id),
                type: 'POST',
                data: { _token: "{{ csrf_token() }}" },
                success: function () {
                    console.log("ok");
                    table.ajax.reload(null, false);
                }
            });
        });
    </script>
@endpush




