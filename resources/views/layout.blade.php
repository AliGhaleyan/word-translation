<html>
<head>
    <title>B - @yield("title")</title>
    <link rel="stylesheet" href="{{ asset("css/bootstrap.css") }}">
    @yield("styles")
</head>
<body>

@include("include.header")


<div class="container mt-5">
    @yield("content-container")
</div>

@yield("content")

<script src="{{ asset("js/jquery-3.5.1.min.js") }}"></script>
<script src="{{ asset("js/bootstrap.js") }}"></script>

@yield("scripts")

</body>
</html>
