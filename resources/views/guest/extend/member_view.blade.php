@extends('guest.base_template.master_tmpl')
@section('content_list')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header">
                <h2>
                    &nbsp;
                </h2>
                <ul class="header-dropdown m-r--5">
                    <li class="dropdown">
                        <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button"
                            aria-haspopup="true" aria-expanded="false">
                            <i class="material-icons">more_vert</i>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="body">
                <form name="form-input-member">
                    <label for="nama">Nama</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="nama" name="nama" class="form-control" placeholder="Nama">
                        </div>
                    </div>

                    <label for="email">Email</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="email" id="email" name="email" class="form-control" placeholder="Email">
                            <span class="error" id="is-exist"></span>
                        </div>
                    </div>
                    <label for="phone">No. Telepon</label>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" id="phone" name="phone" maxlength="13" minlength="12"
                                class="form-control" placeholder="Nomor Telepon">
                        </div>
                    </div>
                    <label for="hobby">Hobby</label>
                    <div class="form-group">
                        <div class="form-line">
                            <select class="form-control" name="hobby_1" id="hobby_1">
                                <option disable></option>
                            </select>
                        </div>
                    </div>
                    <br>
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect" onclick="addMember()">Simpan</button>
                </form>
            </div>
        </div>
    </div>

    <script type='text/javascript'>
        $(document).ready(function() {
            $('#email').on('input', function() {
                let email = $(this).val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "{{ route('cek_email_member') }}",
                    dataType: 'json',
                    cache: false,
                    type: 'GET',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        email: email

                    },
                    success: function(data) {
                        if (data.status === 'exists') {
                            $('#is-exist').html(data.status);
                        } else {
                            $('#is-exist').html(data.status);
                        }
                    }
                });

            });
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('get_hobby') }}",
                dataType: 'json',
                cache: false,
                type: 'GET',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(data) {

                    // $(data).each(function(i, data) {
                    //     console.log(data);
                    //     $("#hobby_1").append(
                    //         '<option value="' + data.id + '">' + data.hobby_name +
                    //         '</option>');
                    // });
                    if (true) {
                        $("#hobby_1").empty();
                        $("#hobby_1").append('<option disable></option>');
                        $(data).each(function(i, data) {
                            $("#hobby_1").append(
                                '<option value="' + data.id + '">' + data.hobby_name +
                                '</option>');
                        });
                    } else {
                        $("#hobby_1").empty();
                    }
                }
            });
        });

        function addMember() {
            $("form[name='form-input-member']").validate({
                rules: {
                    nama: "required",
                    email: {
                        required: true,
                        email: true
                    },
                    phone: {
                        required: true,
                        number: true,
                        minlength: 12,
                        maxlength: 13
                    },
                    hobby_1: "required"
                },
                messages: {
                    nama: "Nama required",
                    email: "Email required",
                    phone: "No Telepon required and please type number only",
                    hobby_1: "Hobby required"
                },
                submitHandler: function(form) {
                    let nama = $('#nama').val();
                    let email = $('#email').val();
                    let phone = $('#phone').val();
                    let hobby = $('#hobby_1').val();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('do_add_member') }}",
                        dataType: 'json',
                        cache: false,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            nama: nama,
                            email: email,
                            phone: phone,
                            hobby: hobby
                        },
                        success: function(data) {

                            if (data['code'] === 201) {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: data['msg'],
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                window.location.reload();
                            } else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: data['msg'],
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                window.location.reload();
                            }
                        }
                    });
                }
            });
        }
    </script>
@endsection
