<?php

return CMap::mergeArray(
	require(dirname(__FILE__).'/production.php'),
	array(
		'defaultController' => 'signup'
	)
);
