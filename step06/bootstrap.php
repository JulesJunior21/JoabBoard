<?php
	use Doctrine\ORM\Tools\Setup;
	use Doctrine\ORM\EntityManager;

	require_once "vendor/autoload.php";

    
	$isDevMode = true;
	$config = Setup::createAnnotationMetadataConfiguration(array(__DIR__."/src"), $isDevMode, null, null, false);


	$conn = array(
        'host' => '127.0.0.1',
		'driver' => 'pdo_mysql',
		'user' => 'niry',
		'password' => 'Avotiana5',
		'dbname' =>'job_advertisements'
	);
	
	 $entityManager = EntityManager::create($conn, $config);
?>