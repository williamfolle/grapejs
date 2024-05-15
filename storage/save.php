<?php
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$filename = 'page_1.txt';
$inputData = json_decode(file_get_contents("php://input"), true);

if (!is_array($inputData) || empty($inputData)) {
    http_response_code(400);
    echo json_encode(['error' => 'Invalid input data']);
    exit;
}

try {
    if (file_put_contents($filename, json_encode($inputData)) === FALSE) {
        throw new Exception('Failed to write to file');
    }
    echo json_encode(['status' => 'SUCCESS']);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['error' => $e->getMessage()]);
}