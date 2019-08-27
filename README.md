# LayoutTag

#### 介绍
与layoutit 配套使用 后端扩展包

#### 介绍
与layoutit 配套使用 后端扩展包

#### 安装
```shell
composer require abo/layouttag
php artisan vendor:publish --tag layout-tags
```

#### 迁移数据库
```shell
php artisan make:migration create_tags_tables
```

##### 使用实体
````php
<?php
...
use Abo\LayoutTag\V0\Taggable;
...
class Post extends Model
{
    use Taggable;
    ...
}
````

#### 参与贡献

1. Fork 本仓库
2. 新建 Feat_xxx 分支
3. 提交代码
4. 新建 Pull Request
