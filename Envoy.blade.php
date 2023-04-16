@servers(['serverOne' => 'forge@91.107.202.197', 'serverTwo' => 'forge@91.107.216.168'])

@setup
    $repository = 'git@github.com:WanalyticsHQ/wanalytics.git';
    $path = '/home/forge/wanalytics.io';
    $branch = 'main';

    $date = ( new DateTime )->format('YmdHis');

    $releases = $path . '/releases';
    $release = $releases . '/' . $date;

    $current = $path . '/current';
    $env = $path . '/.env';
    $storage = $path . '/storage';

    function logMessage($message) {
        return "echo '\033[32m" .$message. "\033[0m';\n";
    }
@endsetup

@story('deploy')
    close-new-release
    install-composer-dependencies
    migration
    npm
    activate-new-release
    cache
    horizon
    clean-old-releases
@endstory

@task('close-new-release', ['on' => ['serverOne', 'serverTwo']])
    git clone {{ $repository }} --branch={{ $branch }} --depth=1 -q {{ $release }}
    {{ logMessage("Repository cloned ✅") }}

    ln -nfs {{ $env }} {{ $release }}/.env
    {{ logMessage("Env file linked: [$env] symlinked to [$release]/.env ✅") }}

    rm -rf {{ $release }}/storage
    ln -nfs {{ $storage }} {{ $release }}/storage
    {{ logMessage("Storage linked: [$storage] symlinked to [$release/storage] ✅") }}
@endtask

@task('migration', ['on' => ['serverOne']])
    cd {{ $release }}
    php artisan migrate --force
    {{ logMessage("Migration ✅") }}
@endtask

@task('npm', ['on' => ['serverOne', 'serverTwo']])
    cd {{ $release }}
    npm install
    npm run build
    {{ logMessage("Npm ✅") }}
@endtask

@task('cache', ['on' => ['serverOne', 'serverTwo']])
    cd {{ $release }}
    php artisan config:cache
    php artisan route:cache
    {{ logMessage("Cache ✅") }}
@endtask

@task('horizon', ['on' => ['serverOne', 'serverTwo']])
    cd {{ $release }}
    php artisan horizon:terminate
    {{ logMessage("Horizon ✅") }}
@endtask

@task('install-composer-dependencies', ['on' => ['serverOne', 'serverTwo']])
    cd {{ $release }}
    composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader
    {{ logMessage("Composer ✅") }}
@endtask

@task('activate-new-release', ['on' => ['serverOne', 'serverTwo']])
    cd {{ $release }}
    ln -nfs {{ $release }} {{ $current }}
    {{ logMessage("Deployment [$release] symlinked to [$current] ✅") }}

    sudo -S service php8.2-fpm reload
    {{ logMessage("PHP-FPM restarted ✅") }}
@endtask

@task('clean-old-releases')
    # Delete all but the 5 most recent releases
    {{ logMessage("Cleaning old releases") }}
    cd {{ $releases }}
    ls -dt {{ $releases }}/* | tail -n +6 | xargs -d "\n" rm -rf;
@endtask

@task('rollback')
    cd {{ $releases }}
    ln -nfs {{ $releases }}/$(find . -maxdepth 1 -name "20*" | sort  | tail -n 2 | head -n1) {{ $current }}
    echo "Rolled back to $(find . -maxdepth 1 -name "20*" | sort  | tail -n 2 | head -n1)"
@endtask

@success
    @slack('https://hooks.slack.com/services/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', '#development', 'wAnalytics has deployed successfully 🚀')
@endsuccess
