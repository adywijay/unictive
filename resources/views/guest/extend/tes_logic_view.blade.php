@extends('guest.base_template.master_tmpl')
@section('content_list')
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card" style="border-radius: 5px;">
            <div class="header">
                <h2>
                    Looping Dynamics Input
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
                <form id="input-loop" name="input-loop">
                    <div class="row clearfix">
                        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-6">
                            <div class="form-group form-float">
                                <div class="form-line">
                                    <input type="number" id="total_loop" name="total_loop" class="form-control"
                                        placeholder="looping total">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <input type="checkbox" id="default" name="default" class="filled-in">
                            <label for="default">Default = 30</label>
                            <button type="submit" class="btn btn-primary btn-lg m-l-15 waves-effect"
                                onclick="runningLoop()">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" id="result">
        <div class="card" style="border-radius: 5px;">
            <div class="header">
                <h2>
                    Result
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
                <div id="list-result">

                </div>
            </div>
        </div>
    </div>

    <script type='text/javascript'>
        $(document).ready(function() {
            $('#result').hide();

            let checkbox = $('#default');

            checkbox.change(function() {
                if ($(this).is(":checked")) {
                    $('#total_loop').val(30);
                } else {
                    $('#total_loop').val('');
                }
            });
        });

        function runningLoop() {
            $("form[name='input-loop']").validate({
                rules: {
                    total_loop: "required"
                },
                messages: {
                    total_loop: "Please input loop total"
                },
                submitHandler: function(form) {
                    let total_loop = $('#total_loop').val();

                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "{{ route('runn_loop') }}",
                        dataType: 'json',
                        cache: false,
                        type: 'POST',
                        data: {
                            "_token": "{{ csrf_token() }}",
                            total_loop: total_loop
                        },
                        success: function(data) {

                            if (data.length <= 0) {
                                Swal.fire({
                                    position: "center",
                                    icon: "error",
                                    title: "Data not found",
                                    timer: 1500
                                });
                            }
                            $('#result').show();
                            $('#list-result').html(data.join(' ' + ' '));
                        }
                    });
                }
            });
        }
    </script>
@endsection
