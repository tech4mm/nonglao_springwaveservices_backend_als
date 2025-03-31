# to make our banner image api work without 'storage/banner_image' like this -> we need to run this command on server
ln -s /var/www/html/nong_springwaveservices_backend_als/storage/app/public/banner_images /var/www/html/nong_springwaveservices_backend_als/public/banner_images

# logo change || update
under -> storage/app/public/images/logo.jpg (if there is no images folder create it)

# if there is no user profile pic in users table -> run this
php artisan migrate:rollback --step=1
php artisan migrate

<x-filament-widgets::widget>
    <x-filament::section>
        {{-- Widget content --}}
    </x-filament::section>
</x-filament-widgets::widget>
