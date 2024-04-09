<div class="card">
    <div class="card-body">
        <h3 class="card-title">New Registrations: Over the last month</h3>
        <div class="chart-lg"  style="height: 250px;">
            <livewire:livewire-line-chart
                key="{{ $dailyRegisteredUsers->reactiveKey() }}"
                :line-chart-model="$dailyRegisteredUsers"
            />
        </div>
    </div>
</div>
