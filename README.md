# database-tool

数据库，列表，优化，修复小工具

## Installing

```shell
$ composer require hnndy/database-tool -vvv
```

## Usage

##1.获取数据库中的所有表
```php
$datas = app('databasetool')->getDatabaseTables();
```
返回结果
```php
[
    [statue] => success
    [message] => 获取成功！
    [results] => []
    [total] => 80KB
]
```
##2.优化选中的表
```php
$result = app('databasetool')->optimize(['dou_admin', 'dou_admin_log', 'dou_article']);
```
返回结果
```php
[
    [statue] => success
    [message] => 优化成功！
    [result] => []
]
```
###3.修复选中的表
```php
$result = app('databasetool')->repair(['dou_admin', 'dou_admin_log', 'dou_article']);
```
返回结果
```php
[
    [statue] => success
    [message] => 修复成功！
    [result] => []
]
```

## License

MIT