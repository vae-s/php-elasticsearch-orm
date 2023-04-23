# PHP ELASTICSEARCH ORM

## Install

```
composer require vae/php-elasticsearch-orm
```

## Support Elasticsearch Version

> more than 7.0

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

### Hyperf framework

Use in Code

OrmElasticsearchClientFactory

```php
    use \Vae\PhpElasticsearchOrm\Builder;
    use \Vae\PhpElasticsearchOrm\Query;
    use \Vae\PhpElasticsearchOrm\Grammar;
    class OrmElasticsearchClientFactory{
        public static function builder()
        {
            // 如果在协程环境下创建，则会自动使用协程版的 Handler，非协程环境下无改变
            $hyperfBuilder = ApplicationContext::getContainer()->get(ClientBuilderFactory::class)->create();
            $client = $hyperfBuilder->setHosts(['http://127.0.0.1:9200'])->build();
            return new Builder(new Query(new Grammar(), $client));
        }
    }
```

## Quickstart

### Create

```php
    $builder->index('index')->create(['key' => 'value']);
    //return collection
    $builder->index('index')->createCollection(['key' => 'value']);
```

### Batch Create

```php
    $builder->index('index')->batchCreate(
        [
            'key1' => 'v1',
            'key2' => 'v2',
        ],
        [
            'key3' => 'v3',
            'key4' => 'v4',
        ]       
    );
```

### Update

```php
    $builder->index('index')->update(['key' => 'value']) : bool
```

### Batch Update Or Update

```php
    $builder->index('index')->batchUpdateOrCreate(
        [
            'id' => '1', 
            'key1' => 'v1',
            'key2' => 'v2',
        ],
        [
            'id' => 2,
            'key3' => 'v3',
            'key4' => 'v4',
        ]       
    );
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

search nested data

```php
    $nestedKey = "nested_key";
    $key = "key";
    $builder->where("{$nestedKey}@{$key}", '=', 'value');
```

### Where Support Operator

> ['=' => 'eq','>'  => 'gt','>=' => 'gte','<'  => 'lt','<=' => 'lte','!=' => 'ne',]

```php
    $builder->where('key', '=', 'value');
```

### More

see file `Vae\PhpElasticsearchOrm\Builder`

