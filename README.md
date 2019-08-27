# LayoutTag

#### 介绍
与layoutit 配套使用 后端扩展包

#### 安装
```shell
composer require abo/layouttag

```

#### 迁移数据库
```shell
php artisan vendor:publish --tag layout-tags

php artisan make:migration create_tags_tables
```

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
