if [ -f "/srv/app/artisan" ] ; then
    eval "$(/srv/app/artisan completion bash)"

    alias artisan='php artisan'
fi