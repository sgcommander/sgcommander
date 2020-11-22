<?php
	$contents = file_get_contents( 'log25112011' );
	$lines = explode( '|', $contents );
	unset( $contents );

	$db = new Mysqli( 'localhost', 'root', 'Az4d2_HX', 'log' );

	$sql = '
			INSERT INTO log (`idJugador`, `ip`, `method`, `referer`, `user_agent`, `time_request`, `type`, `inputs`)
			VALUES ( ?, INET_ATON(?), ?, ?, ?, FROM_UNIXTIME(?), ?, ?);	
	';

	$stmt = $db->prepare( $sql );
	
	$idjugador = 0;
	$ip = 0;
	$method = '';
	$referer = '';
	$user_agent = '';
	$time_request = 0;
	$type =0;
	$inputs = '';

	$stmt->bind_param( 'iisssiss', $idJugador, $ip, $method, $referer, $user_agent, $time_request, $type, $inputs ); 

	foreach( $lines AS $line )
	{
		$fields  = explode( ';', $line );
		$num_fields = sizeof($fields);

		$idJugador 	= $fields[0];
		$ip		= $fields[1];
		$method		= $fields[2];
		$referer	= $fields[3];

		//Si es un evento
		if ( 1 != $fields[$num_fields-2] )
		{
			$user_agent	= implode( ';' , array_slice($fields, 4, $num_fields-4-4) );
			$time_request	= $fields[ $num_fields-4]; 
			$inputs		= $fields[ $num_fields-2];
			$type		= 'request'; 
		}
		//Si no es un evento
		else
		{
			$user_agent	= implode( ';' , array_slice($fields, 4, $num_fields-4-3) );
			$time_request	= $fields[ $num_fields-3]; 
			$inputs		= $fields[ $num_fields-1]; 
			$type		= 'event'; 
		}

		$stmt->execute();
	}
?>
