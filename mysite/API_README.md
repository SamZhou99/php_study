# CI4 JSON API 配置指南

## 📋 概述

本项目已配置为支持 JSON API 开发，包含以下特性：
- 统一的 JSON 响应格式
- 跨域请求支持 (CORS)
- RESTful API 路由设计
- 完整的 CRUD 操作示例

## 🏗️ 项目结构

```
app/Controllers/
├── ApiController.php          # API 控制器基类
└── Api/
    ├── TestController.php     # 测试 API
    └── UserController.php     # 用户 API 示例
```

## 🚀 快速开始

### 1. 启动开发服务器

```bash
php spark serve
```

服务器将在 `http://localhost:8080` 启动。

### 2. 测试 API

运行测试脚本：
```bash
php test_api.php
```

### 3. 手动测试 API 端点

#### 获取测试数据
```bash
curl -X GET "http://localhost:8080/api/v1/test" \
     -H "Accept: application/json"
```

#### 创建测试数据
```bash
curl -X POST "http://localhost:8080/api/v1/test" \
     -H "Content-Type: application/json" \
     -d '{"message": "Hello API"}'
```

#### 获取用户列表
```bash
curl -X GET "http://localhost:8080/api/v1/users" \
     -H "Accept: application/json"
```

#### 获取单个用户
```bash
curl -X GET "http://localhost:8080/api/v1/users/1" \
     -H "Accept: application/json"
```

#### 创建用户
```bash
curl -X POST "http://localhost:8080/api/v1/users" \
     -H "Content-Type: application/json" \
     -d '{"name": "张三", "email": "zhangsan@example.com"}'
```

#### 更新用户
```bash
curl -X PUT "http://localhost:8080/api/v1/users/1" \
     -H "Content-Type: application/json" \
     -d '{"name": "张三修改"}'
```

#### 删除用户
```bash
curl -X DELETE "http://localhost:8080/api/v1/users/1" \
     -H "Accept: application/json"
```

## 📝 API 响应格式

### 成功响应
```json
{
  "code": 200,
  "message": "操作成功",
  "data": { ... },
  "timestamp": 1640995200
}
```

### 错误响应
```json
{
  "code": 400,
  "message": "参数错误",
  "data": null,
  "timestamp": 1640995200
}
```

### 分页响应
```json
{
  "code": 200,
  "message": "获取成功",
  "data": {
    "list": [ ... ],
    "pagination": {
      "total": 100,
      "page": 1,
      "per_page": 10,
      "total_pages": 10
    }
  },
  "timestamp": 1640995200
}
```

## 🔧 配置说明

### 路由配置 (`app/Config/Routes.php`)
- API 路由使用 `/api/v1/` 前缀
- 支持 RESTful 设计模式

### CORS 配置 (`app/Config/Cors.php`)
- 已配置允许的源域名
- 支持跨域请求

### API 控制器基类 (`app/Controllers/ApiController.php`)
- 提供统一的响应方法
- 自动设置 JSON 内容类型

## 🛠️ 开发新 API

### 1. 创建新的 API 控制器
```php
<?php
namespace App\Controllers\Api;

use App\Controllers\ApiController;

class ProductController extends ApiController
{
    public function index()
    {
        // 获取产品列表
        $data = []; // 你的业务逻辑
        return $this->success($data);
    }

    public function create()
    {
        // 创建产品
        $data = $this->request->getJSON(true);
        // 处理数据...
        return $this->success($newProduct, '创建成功', 201);
    }
}
```

### 2. 添加路由
在 `app/Config/Routes.php` 中添加：
```php
$routes->get('products', 'Api\ProductController::index');
$routes->post('products', 'Api\ProductController::create');
```

### 3. 测试新 API
```bash
curl -X GET "http://localhost:8080/api/v1/products"
```

## 📚 最佳实践

1. **继承 ApiController**: 所有 API 控制器都应继承 `ApiController`
2. **统一响应格式**: 使用 `success()`, `error()`, `paginate()` 方法
3. **数据验证**: 在控制器中验证输入数据
4. **错误处理**: 使用 try-catch 处理异常
5. **文档**: 为每个 API 端点编写文档

## 🔍 故障排除

### API 返回 404
- 检查路由配置是否正确
- 确认控制器文件位置和命名空间

### CORS 错误
- 检查 `app/Config/Cors.php` 中的 `allowedOrigins` 配置
- 确认前端请求的 Origin 是否在允许列表中

### JSON 解析错误
- 确保请求的 Content-Type 为 `application/json`
- 检查 JSON 格式是否正确

## 📞 支持

如果遇到问题，请检查：
1. PHP 错误日志
2. CI4 框架日志 (`writable/logs/`)
3. 网络请求详情

---

🎉 现在你已经成功开启了 CI4 的 JSON API 开发之路！