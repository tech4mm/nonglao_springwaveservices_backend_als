<div class="grid grid-cols-1 md:grid-cols-4 gap-4">
    @foreach ([
        ['label' => 'Passport Expire', 'value' => 100],
        ['label' => 'Visa Expire', 'value' => 200],
        ['label' => 'Work Permit Expire', 'value' => 100],
        ['label' => '90 Days Report Expire', 'value' => 100],
    ] as $item)
        <div class="flex flex-col items-center justify-center bg-white dark:bg-gray-800 p-4 rounded shadow">
            <svg class="w-24 h-24" viewBox="0 0 36 36">
                <path
                    class="text-gray-200"
                    stroke-width="3.8"
                    fill="none"
                    stroke="currentColor"
                    d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <path
                    class="text-red-500"
                    stroke-width="3.8"
                    stroke-dasharray="{{ $item['value'] }}, 100"
                    stroke-linecap="round"
                    fill="none"
                    stroke="currentColor"
                    d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                />
                <text x="18" y="20.35" class="text-red-600 text-sm" text-anchor="middle" font-size="8">{{ $item['value'] }}</text>
            </svg>
            <div class="text-center mt-2 font-semibold text-sm text-gray-700 dark:text-white">
                {{ $item['label'] }}<br><span class="text-xs">Within 1 Month</span>
            </div>
        </div>
    @endforeach
</div>