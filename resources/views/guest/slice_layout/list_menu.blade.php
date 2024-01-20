@section('list_menu')
    <ul class="list">
        <li>
            <a href="javascript:void(0);" id="home">
                <i class="material-icons">home</i>
                <span>Home</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" id="view-test">
                <i class="material-icons">assignment</i>
                <span>Logical Test</span>
            </a>
        </li>
        <li>
            <a href="javascript:void(0);" class="menu-toggle">
                <i class="material-icons">storage</i>
                <span>Master Data</span>
            </a>
            <ul class="ml-menu">
                <li>
                    <a href="javascript:void(0);" id="hobby">Hobby</a>
                </li>
                <li>
                    <a href="javascript:void(0);" id="create-member">Member</a>
                </li>
            </ul>
        </li>
    </ul>
    <script type='text/javascript'>
        $('#home').click(function() {
            window.location.replace('{{ route('dashboard_bu') }}');
        });

        $('#view-test').click(function() {
            window.location.replace('{{ route('view_test') }}');
        });

        $('#hobby').click(function() {
            window.location.replace('{{ route('view_add_hobby') }}');
        });

        $('#create-member').click(function() {
            window.location.replace('{{ route('view_add_member') }}');
        });
    </script>
@endsection
