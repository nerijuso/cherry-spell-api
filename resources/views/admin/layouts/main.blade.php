<!DOCTYPE html>
<html lang="en-US">
<head>
    @include('admin.layouts.parts.head')
</head>
<body class="d-flex flex-column theme-light">
<div class="page">
    @include('admin.layouts.parts.aside')
    @include('admin.layouts.parts.header')

    <div class="page-wrapper">
        @include('admin.layouts.parts.page_head')
        <div class="page-body">
            <div class="container-xl">
                <div id="kernel-messages">
                    @include('admin.layouts.parts.messages')
                </div>
                @yield('content')
            </div>
        </div>
        @include('admin.layouts.parts.footer')
    </div>

</div>


</body>
</html>
