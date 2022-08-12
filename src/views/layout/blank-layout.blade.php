<!DOCTYPE html>
<html lang="en">

<head>
    @include('starterkit::partials.head')
    @stack('css')
</head>
<body class="ms-Fabric">
    {{$slot}}
    @include('starterkit::partials.script')
    @stack('js')
</body>

</html>
