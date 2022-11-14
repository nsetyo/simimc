if [ -f "/srv/app/vendor/bin/phpstan" ] ; then
    eval "$(/srv/app/vendor/bin/phpstan completion bash)"

    alias phpstan='vendor/bin/phpstan'
fi