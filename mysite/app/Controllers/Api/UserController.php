<?php

namespace App\Controllers\Api;

use App\Controllers\ApiController;

/**
 * 用户 API 控制器
 * 演示完整的 CRUD 操作
 */
class UserController extends ApiController
{
    // 模拟用户数据存储
    private array $users = [
        1 => ['id' => 1, 'name' => '张三', 'email' => 'zhangsan@example.com', 'created_at' => '2024-01-01'],
        2 => ['id' => 2, 'name' => '李四', 'email' => 'lisi@example.com', 'created_at' => '2024-01-02'],
        3 => ['id' => 3, 'name' => '王五', 'email' => 'wangwu@example.com', 'created_at' => '2024-01-03'],
    ];

    /**
     * GET /api/v1/users
     * 获取用户列表（支持分页）
     */
    public function index()
    {
        $page = (int) $this->request->getGet('page') ?: 1;
        $perPage = (int) $this->request->getGet('per_page') ?: 10;

        $allUsers = array_values($this->users);
        $total = count($allUsers);

        // 简单的分页逻辑
        $offset = ($page - 1) * $perPage;
        $paginatedUsers = array_slice($allUsers, $offset, $perPage);

        return $this->paginate($paginatedUsers, $total, $page, $perPage, '获取用户列表成功');
    }

    /**
     * GET /api/v1/users/{id}
     * 获取单个用户详情
     */
    public function show($id = null)
    {
        if (!$id || !isset($this->users[$id])) {
            return $this->error('用户不存在', 404);
        }

        return $this->success($this->users[$id], '获取用户详情成功');
    }

    /**
     * POST /api/v1/users
     * 创建新用户
     */
    public function create()
    {
        $data = $this->request->getJSON(true);

        // 验证必填字段
        if (empty($data['name']) || empty($data['email'])) {
            return $this->error('姓名和邮箱为必填项', 400);
        }

        // 验证邮箱格式
        if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
            return $this->error('邮箱格式不正确', 400);
        }

        // 生成新用户 ID
        $newId = max(array_keys($this->users)) + 1;

        $newUser = [
            'id' => $newId,
            'name' => $data['name'],
            'email' => $data['email'],
            'created_at' => date('Y-m-d H:i:s')
        ];

        $this->users[$newId] = $newUser;

        return $this->success($newUser, '用户创建成功', 201);
    }

    /**
     * PUT /api/v1/users/{id}
     * 更新用户信息
     */
    public function update($id = null)
    {
        if (!$id || !isset($this->users[$id])) {
            return $this->error('用户不存在', 404);
        }

        $data = $this->request->getJSON(true);

        if (empty($data)) {
            return $this->error('更新数据不能为空', 400);
        }

        // 更新用户信息
        if (isset($data['name'])) {
            $this->users[$id]['name'] = $data['name'];
        }
        if (isset($data['email'])) {
            if (!filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                return $this->error('邮箱格式不正确', 400);
            }
            $this->users[$id]['email'] = $data['email'];
        }

        return $this->success($this->users[$id], '用户信息更新成功');
    }

    /**
     * DELETE /api/v1/users/{id}
     * 删除用户
     */
    public function delete($id = null)
    {
        if (!$id || !isset($this->users[$id])) {
            return $this->error('用户不存在', 404);
        }

        $deletedUser = $this->users[$id];
        unset($this->users[$id]);

        return $this->success($deletedUser, '用户删除成功');
    }
}