<div class="card">
    <div class="card-body">
        <h3 class="card-title">New QR Scans: Over the last month</h3>
        <div class="chart-lg"  style="height: 250px;">
            <livewire:livewire-line-chart
                key="{{ $dataModel->reactiveKey() }}"
                :line-chart-model="$dataModel"
            />
        </div>
    </div>
</div>
