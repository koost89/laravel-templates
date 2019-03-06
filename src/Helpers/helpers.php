<?php

if (! function_exists('display')) {

	function display($data, $view_mode, $mergeData = []) {
		$bundle = strtolower(class_basename($data));
		$parameters = [
			'view_mode' => $view_mode,
			'data' => $data,
		];

		if ($bundle === 'collection' || $bundle === 'lengthawarepaginator') {
			return view('view.collection', $parameters, $mergeData);
		}
		else {
			$parameters['bundle'] = $bundle;
			return view('view.item', $parameters, $mergeData);
		}
	}

}
