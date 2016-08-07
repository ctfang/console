<?php
$arr = $argv;

$input = new stdClass;

$input->all     = implode(' ', $arr)."\n";

$input->command = $arr['1'];

unset($arr[0]);
unset($arr[1]);

$input->parameter = array_values( $arr );

$model = Route::make($input->command,$input->parameter);
return $model->boot( $input );

