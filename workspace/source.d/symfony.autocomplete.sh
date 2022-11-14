if [ -f "/srv/app/bin/console" ] ; then
    eval "$(/srv/app/bin/console completion bash)"

    alias console='bin/console'
fi