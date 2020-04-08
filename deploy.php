<?php
namespace Deployer;

require 'recipe/common.php';

// Project name
set('application', 'composer-demo-deployer');

// Project repository
set('repository', 'https://github.com/cperry24/composer-demo.git');

// [Optional] Allocate tty for git clone. Default value is false.
set('git_tty', true); 

// Shared files/dirs between deploys 
set('shared_files', [
    '.env',
    'web/sites/default/services.yml'
]);
set('shared_dirs', [
    'web/sites/default/files',
]);

// Writable dirs by web server 
set('writable_dirs', [
    'web/sites/default/files',
]);
// Set write to use chmod
set('writable_mode', 'chmod');
// Don't send stats
set('allow_anonymous_stats', false);

// Hosts
// May need to adjust this 
host('perrysdeve3.drupaltutor.dev')
    ->user('dev')
    ->port(22154)
    ->set('deploy_path', '~/{{application}}');    
    

// Tasks

desc('Deploy your project');
task('deploy', [
    'deploy:info',
    'deploy:prepare',
    'deploy:lock',
    'deploy:release',
    'deploy:update_code',
    'deploy:shared',
    'deploy:writable',
    'deploy:vendors',
    'deploy:clear_paths',
    'deploy:symlink',
    'deploy:unlock',
    'cleanup',
    'success'
]);

// [Optional] If deploy fails automatically unlock.
after('deploy:failed', 'deploy:unlock');
