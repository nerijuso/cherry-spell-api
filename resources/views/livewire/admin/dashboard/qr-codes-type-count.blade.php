<div class="card card-sm">
    <div class="card-body">
        <div class="row align-items-center">
            <div class="col-auto">
                            <span class="bg-facebook text-white avatar"><!-- Download SVG icon from http://tabler-icons.io/i/brand-facebook -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-scan" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#2c3e50" fill="none" stroke-linecap="round" stroke-linejoin="round">
                              <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                              <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                              <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                              <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                              <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                              <path d="M5 12l14 0" />
                            </svg>
                            </span>
            </div>
            <div class="col">
                <div class="font-weight-medium">
                    {{ $dynamic_qr_codes_scans_count }} Dynamic QR Codes
                </div>
                <div class="text-secondary">
                    {{ $static_qr_codes_scans_count }} Static QR Codes
                </div>
            </div>
        </div>
    </div>
</div>
