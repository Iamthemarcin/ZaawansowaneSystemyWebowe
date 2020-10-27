<?php
	namespace Deployer;
	
	use Symfony\Component\Dotenv\Dotenv;
	
	require './vendor/autoload.php';
	require 'recipe/symfony4.php';
	
	$env = new Dotenv();
	$env->loadEnv(__DIR__ . '/.env');
	
	set('repository', 'git@bitbucket.org:effectivity/multitudo-sf.git');
	set('keep_releases', 10);
	set('default_timeout', 1200);
	set('bin/php', 'php74');
	
	task('deploy:vendors', function () {
		if (!commandExist('unzip')) {
			writeln('<comment>To speed up composer installation setup "unzip" command with PHP zip extension https://goo.gl/sxzFcD</comment>');
		}
		run('cd {{release_path}} && {{bin/php}} {{bin/composer}} {{composer_options}}');
	});
	
	set('composer_options', '{{composer_action}} --verbose --prefer-dist --no-progress --no-interaction --optimize-autoloader --no-suggest --ignore-platform-reqs');
	
	add('shared_files', [
		'.env',
    'public/uploads',
	]);
	
	add('shared_dirs', [
		'config/jwt'
	]);
	
	set('writable_dirs', [
		'var/cache'
	]);
	
	host('dev')
		->hostname('46.4.187.32')
		->port(22)
		->stage('prod')
		->set('deploy_path', '/var/www/multitudo-app.dev-effectivity.pl')
		->user('multitudo_app')
		->set('http_user', 'nginx')
		->forwardAgent()
	;
	
	after('deploy:failed', 'deploy:unlock');