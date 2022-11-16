if [ -f "/srv/app/artisan" ] ; then
    eval "$(/srv/app/artisan completion bash)"

    export PATH="/srv/app:$PATH"
fi