<aside
    x-cloak
    x-show="$store.sidebar.isOpen"
    class="fi-sidebar bg-red-100 text-black"
>
    <div class="p-4 text-lg font-bold">
        ✅ CUSTOM SIDEBAR OVERRIDE WORKING
    </div>

    {{ $slot }}
</aside>
