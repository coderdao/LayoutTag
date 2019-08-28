# LayoutTag

#### 介绍
与layoutit 配套使用 后端扩展包

#### 安装
```shell
composer require abo/layouttag
php artisan vendor:publish --tag layout-tags
```

#### 迁移数据库
```shell
php artisan migrate
// php artisan migrate:rollback

🚫会导致删库删表,禁止使用 php artisan migrate:fresh
```
[laravel migrate 文档](https://learnku.com/docs/laravel/5.5/migrations/1329)

#### 怎么使用
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

##### 新建标签
```php
Tag::create(['name' => 'New tag']);
```
##### 关联标签
```php
$post = BlogPost::find(1);
$post->syncTags(['foo', 'bar', 4, 5, 6]);
```
##### 查询标签列表
```php
$post = BlogPost::find(1);
dd($post->tags);
```
