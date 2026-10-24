@if(Session::has('dcat-admin-toastr'))
    @php
        $toastr  = Session::get('dcat-admin-toastr');
        $type    = $toastr->get('type')[0] ?? 'success';
        $type    = in_array($type, ['success', 'error', 'info', 'warning'], true) ? $type : 'success';
        $message = $toastr->get('message')[0] ?? '';
        $options = admin_javascript_json($toastr->get('options', []));
    @endphp
    <script>$(function () { toastr.{{ $type }}(@json($message), null, {!! $options !!}); })</script>
@endif