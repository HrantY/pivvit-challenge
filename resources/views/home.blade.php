@extends('layouts.app')

@section('content')
<div id="app" class="container">
    <App></App>
</div>
@endsection
<script>
    window.accessToken = "{{ $access_token }}"
</script>