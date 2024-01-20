@section('top_nav')
    <div class="navbar-header">
        <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse"
            aria-expanded="false"></a>
        <a href="javascript:void(0);" class="bars"></a>
        <a class="navbar-brand" href="javascript:void(0);" id="home-top">BASSED USER</a>
    </div>
    <div class="collapse navbar-collapse" id="navbar-collapse">
        <ul class="nav navbar-nav navbar-right">
            <div class="icon-button-demo" style="margin-top: 5px;">
                <form id="logout-form-root">
                    @csrf
                    <button type="submit" class="btn btn-primary m-t-15 waves-effect">
                        {{ __('Logout') }}
                    </button>
                </form>
                {{-- <button type="submit" class="btn btn-default btn-circle waves-effect waves-circle waves-float">
                    <i class="material-icons">input</i>
                </button> --}}
            </div>
        </ul>
    </div>
    <script type='text/javascript'>
        $('#home-top').click(function() {
            window.location.replace('{{ route('dashboard_bu') }}');
        });
        $('#logout-form-root').on('submit', function(event) {
            event.preventDefault();

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "{{ route('logout') }}",
                dataType: 'json',
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                },
                success: function() {
                    window.location.href = "{{ route('login') }}";
                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Logout successfull',
                        showConfirmButton: false,
                        timer: 5000
                    });
                }
            })
        })
    </script>
@endsection
