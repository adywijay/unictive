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
                <form name="form-input-hobby">
                    @csrf
                    <div class="row clearfix">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="text" id="hobby_name" name="hobby_name" class="form-control"
                                        placeholder="Nama Hobby">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect"
                                onclick="addHobby()">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type='text/javascript'>
        function addHobby() {
            $("form[name='form-input-hobby']").validate({
                rules: {
                    hobby_name: "required"
                },
                messages: {
                    hobby_name: "Please input hobby"
                },
                submitHandler: function(form) {
                    let hobby_name = $('#hobby_name').val();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('do_add_hobby') }}",
                        dataType: 'json',
                        cache: false,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            hobby_name: hobby_name
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
