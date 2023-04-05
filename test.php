<?php
header('Content-Type: application/json');
require_once 'request.php';

$request = new Request();
$request->setURL('http://www.foo-bar.com/');
$request->setType('POST');
$request->setHeaders(array('foo: bar'));
$request->setData(json_encode(array('foo' => 'bar')));
$request->setOptions(array(CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1));
echo json_encode($request->getResponse(), JSON_PRETTY_PRINT);
?>