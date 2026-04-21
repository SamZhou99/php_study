<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use Psr\Log\LoggerInterface;

/**
 * API 控制器基类
 * 提供统一的 JSON API 响应格式
 */
abstract class ApiController extends Controller
{
    use ResponseTrait;

    /**
     * @return void
     */
    public function initController(RequestInterface $request, ResponseInterface $response, LoggerInterface $logger)
    {
        parent::initController($request, $response, $logger);

        // 设置 JSON 响应格式
        $this->response = $this->response->setContentType('application/json');
    }

    /**
     * 统一的成功响应格式
     */
    protected function success($data = null, string $message = '操作成功', int $code = 200)
    {
        return $this->respond([
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'timestamp' => time()
        ], $code);
    }

    /**
     * 统一的失败响应格式
     */
    protected function error(string $message = '操作失败', int $code = 400, $data = null)
    {
        return $this->respond([
            'code' => $code,
            'message' => $message,
            'data' => $data,
            'timestamp' => time()
        ], $code);
    }

    /**
     * 分页响应格式
     */
    protected function paginate($data, int $total, int $page, int $perPage, string $message = '获取成功')
    {
        return $this->respond([
            'code' => 200,
            'message' => $message,
            'data' => [
                'list' => $data,
                'pagination' => [
                    'total' => $total,
                    'page' => $page,
                    'per_page' => $perPage,
                    'total_pages' => ceil($total / $perPage)
                ]
            ],
            'timestamp' => time()
        ], 200);
    }
}