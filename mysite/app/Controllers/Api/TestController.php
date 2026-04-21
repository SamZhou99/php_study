<?php

namespace App\Controllers\Api;

use App\Controllers\ApiController;

/**
 * 测试 API 控制器
 * 用于验证 JSON API 配置是否正确
 */
class TestController extends ApiController
{
    /**
     * GET /api/v1/test
     * 获取测试数据
     */
    public function index()
    {
        $data = [
            'message' => 'CI4 JSON API 工作正常！',
            'version' => '1.0.0',
            'framework' => 'CodeIgniter 4',
            'php_version' => PHP_VERSION,
            'timestamp' => date('Y-m-d H:i:s')
        ];

        return $this->success($data, '获取成功');
    }

    /**
     * POST /api/v1/test
     * 创建测试数据
     */
    public function create()
    {
        // 获取 POST 数据
        $data = $this->request->getJSON(true);

        // 验证数据
        if (!$data) {
            return $this->error('请求数据不能为空', 400);
        }

        // 模拟数据处理
        $responseData = [
            'id' => rand(1000, 9999),
            'received_data' => $data,
            'created_at' => date('Y-m-d H:i:s')
        ];

        return $this->success($responseData, '创建成功', 201);
    }
}