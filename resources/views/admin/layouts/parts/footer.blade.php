
<footer class="footer footer-transparent d-print-none">
    <div class="container-xl">
        <div class="row text-center align-items-center flex-row-reverse">
            <div class="col-lg-auto ms-lg-auto">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">

                    </li>
                </ul>
            </div>
            <div class="col-12 col-lg-auto mt-3 mt-lg-0">
                <ul class="list-inline list-inline-dots mb-0">
                    <li class="list-inline-item">
                        Copyright © {{ date('Y') }} <a href="/">{{config('app.name')}}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</footer>

@vite(['resources/js/app.js'])

@stack('footer_additional_js')