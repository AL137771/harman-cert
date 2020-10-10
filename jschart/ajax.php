<?php

header('Content-Type: application/json');

// Set up the ORM library
require_once('setup.php');

if (isset($_GET['start']) AND isset($_GET['end'])) {
	
	$start = $_GET['start'];
	$end = $_GET['end'];
	$data = array();

	// Select the results with Idiorm

	$results = ORM::for_table('certsq')
			->select_expr('idTrainer, fechaCreacion, fechaFinal, count(status) as status')
			->where_gte('fechaFinal', $start)
			->where_lte('fechaFinal', $end)
			->group_by('idTrainer')
			->find_array();
	// Build a new array with the data
	foreach ($results as $key => $value) {
		$data[$key]['label'] = $value['idTrainer'];
		$data[$key]['value'] = $value['status'];
	}

	echo json_encode($data);
}
