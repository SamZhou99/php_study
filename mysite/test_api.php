<?php
/**
 * CI4 JSON API 测试脚本
 * 用于验证 API 配置是否正确
 */

// 测试配置
$baseUrl = 'http://localhost:8080';
$apiEndpoints = [
    'GET /api/v1/test' => '/api/v1/test',
    'POST /api/v1/test' => '/api/v1/test',
    'GET /api/v1/users' => '/api/v1/users',
    'GET /api/v1/users/1' => '/api/v1/users/1',
];

echo "🚀 CI4 JSON API 测试开始\n";
echo "================================\n\n";

// 测试 GET 请求
function testGet($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [$httpCode, $response];
}

// 测试 POST 请求
function testPost($url, $data) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, [
        'Accept: application/json',
        'Content-Type: application/json'
    ]);

    $response = curl_exec($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    return [$httpCode, $response];
}

// 执行测试
foreach ($apiEndpoints as $method => $endpoint) {
    $url = $baseUrl . $endpoint;
    echo "测试: $method\n";
    echo "URL: $url\n";

    if (strpos($method, 'GET') === 0) {
        [$code, $response] = testGet($url);
    } elseif (strpos($method, 'POST') === 0) {
        $testData = ['name' => '测试用户', 'email' => 'test@example.com'];
        [$code, $response] = testPost($url, $testData);
    }

    echo "状态码: $code\n";

    if ($code >= 200 && $code < 300) {
        $data = json_decode($response, true);
        if ($data && isset($data['code']) && $data['code'] == 200) {
            echo "✅ 成功\n";
        } else {
            echo "⚠️  响应格式异常\n";
        }
    } else {
        echo "❌ 失败\n";
    }

    echo "响应: " . substr($response, 0, 200) . "...\n\n";
}

echo "🎉 测试完成！\n";
echo "请检查上述结果，如果有失败请检查配置。\n";
?>