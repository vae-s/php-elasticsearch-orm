# PHP ELASTICSEARCH ORM

## Install

```
composer require vae/php-elasticsearch-orm
```

## Support Elasticsearch Version
>more than 7.0


## Use

### PHP
```php
    //require elasticsearch config
    $config = require "elasticsearch.php";
    //instance
    $builder = Factory::builder($config);
```

### Laravel framework
Add the service provider config in `config/app.php`
```php
    'providers' => [
        Vae\PhpElasticsearchOrm\Laravel\ElasticsearchOrm\OrmProvider::class,
    ] 
```
Use in Code
```php
    $builder = app(\Vae\PhpElasticsearchOrm\Builder::class);
```
## Quickstart

### Create

```php
    $builder->index('index')->create(['key' => 'value']);
    //return collection
    $builder->index('index')->createCollection(['key' => 'value']);
```

### Update

```php
    $builder->index('index')->update(['key' => 'value']) : bool
```

### deleteById

```php
    $builder->index('index')->deleteById($id) : bool
```

### delete

```php
    $builder->index('index')->delete()
```

### Select

```php
    //select one
    $builder->index('index')->first();
    //select all
    $builder->index('index')->get();
    //select with paginate
    $builder->index('index')->paginate($page, $size) : Collection
    //select by id
    $builder->byId($id) : stdClass
    //select by id if failed throw error
    $builder->byIdOrFail($id) : stdClass
    //select chunk
    $builder->chunk(callback $callback, $limit = 2000, $scroll = '10m')
```

### Count

```php
    $builder->count() : int
```

### Condition

whereTerm
```php
    $builder->whereTerm('key', 'value');
```

whereLike（wildcard）
```php
    //value without add wildcard '*'
    $builder->whereLike('key', 'value');
```

match

```php
    $builder->whereMatch('key', 'value');
```

range

```php
    $builder->whereBetween('key', ['value1', 'value2']);
```

where in

```php
    $builder->whereIn('key', ['value1', 'value2', ...]);
```

nested

```php
    $builder->where(function(Builder $query){
        $query->whereTerm('key', 'value');
    });
```

### Where Support Operator

> ['='  => 'eq','>'  => 'gt','>=' => 'gte','<'  => 'lt','<=' => 'lte','!=' => 'ne',]

```php
    $builder->where('key', '=', 'value');
```

### More

see file `Vae\PhpElasticsearchOrm\Builder`

