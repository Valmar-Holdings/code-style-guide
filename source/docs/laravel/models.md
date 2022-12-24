---
title: Models
description: 
extends: _layouts.documentation
section: content
---
### Eager Loading

- Avoid eager loading relationships in the `protected $with = [];` variable.
- Try to explicitly load relationships at the point they are used.

### Organization

1. List `use` classes.
1. List the public, protected, and private properties, each group in alphabetical order.
1. List relationship methods.
1. List getter and setter methods.
1. List persistence methods.
1. List protected methods.
1. List private methods.

Persistence Methods

- Laravel models are the de-facto persistence repository, especially in eloquent.
- Do not use the generic eloquent CRUD methods `save()`, `update()`, `create()`, `delete()`, etc. outside of the model. Instead create descriptive methods that explain exactly what is happening. This decouples the business domain from the persistence domain of the app, as well as makes code so much more humanly readable. For instance: instead of `$user->save()` create a method that handles a specific situation, like `$agent->addListingInfo($listingInfo);` and then handle all the data parsing and assignment in the method, at the end of which `$this->save()` is called to persist the changes.

This pattern is not a Repository pattern, but instead an adaptation thereof for Laravel models. Laravel models already implement the repository patter in how they are build on top of Eloquent, so splitting out each model into multiple single-use-traits is an effort to maintain organization, while the other rules enforce the repository pattern of the model throughout the code-base.

The benefits of this guide go deep beneath the surface, and at first glance may not be apparent:

- centralized place of maintenance in the attribute and query traits.
- deep performance optimization via centralized caching in the traits. This automatically ensures that relationship references are cached as well, for example when looping over a relationship collection.
- reduced technical dept, as queries and custom attributes are all contained in known centralized traits. This makes maintenance much easier when fixing or optimizing queries, as it is no longer necessary to inspect your entire codebase.
- reduced visual dept in models, as the custom parts are separated out into traits, keeping the model itself lean and to the point.
- adoption of better patterns: separating and centralizing queries helps DRY up your code, as well as force you to think more about how each query works and discover areas it can be optimized, by pulling it out of context, and looking at it on its own, without being distracted by the domain logic surrounding it.

## Structure

- Model class should only contain properties and relationship methods.
- All attribute methods should be extracted to an Attributes trait.
- All query methods should be extracted to traits:

```txt
App
 |-Traits
 | |-Attributes
 | | \-Book
 | |
 | \-Queries
 |   \-Book
 |
 |-BaseModel
 \-Book
 ```

 ```php
<?php namespace App;

use Illuminate\Cache\TaggableStore;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Laravel\Scout\Searchable;

abstract class BaseModel extends Model
{
    use Searchable;

    public static function boot()
    {
        parent::boot();

        static::created(function () {
            self::flushCache();
        });

        static::deleted(function () {
            self::flushCache();
        });

        static::saved(function () {
            self::flushCache();
        });

        static::updated(function () {
            self::flushCache();
        });
    }

    public function cache(array $additionalTags = []) : View
    {
        if (cache()->getStore() instanceof TaggableStore) {
            $tags = array_push($additionalTags, str_slug(self::class));
            $cache = $cache->tags($tags);
        }

        return $cache;
    }

    public static function flushCache()
    {
        cache()->tags([str_slug(self::class)])
            ->flush();
    }
}
```

```php
<?php namespace App;

use App\Traits\Attributes\Contact as Attributes;
use App\Traits\Queries\Contact as Queries;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Contact extends BaseModel
{
    use Attributes;
    use Queries;

    protected $appends = [
        'searchKey',
        'searchUrl',
    ];
    protected $fillable = [
        'name',
        'title',
        'work_phone',
        'mobile_phone',
        'work_email',
        'private_email',
    ];

    public function contactTypes() : BelongsToMany
    {
        return $this->belongsToMany(ContactType::class);
    }
}
```

```php
<?php namespace App\Traits\Attributes;

trait Contact
{
    public function getGravatarAttribute() : string
    {
        $defaultAvatar = 'https://www.gravatar.com/avatar/?d=mm';
        $workAvatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->work_email))) . '?d=mm';
        $privateAvatar = 'https://www.gravatar.com/avatar/' . md5(strtolower(trim($this->private_email))) . '?d=mm';

        if (md5(file_get_contents($workAvatar)) !== md5(file_get_contents($defaultAvatar))) {
            return $workAvatar;
        }

        if (md5(file_get_contents($privateAvatar)) !== md5(file_get_contents($defaultAvatar))) {
            return $privateAvatar;
        }

        return $defaultAvatar;
    }

    public function getSearchKeyAttribute() : string
    {
        return $this->name;
    }

    public function getSearchUrlAttribute() : string
    {
        return route('contacts.show', $this->getKey());
    }
}
<?php namespace App\Traits\Queries;

use Illuminate\Support\Collection;

trait Contact
{
    public function getAll() : Collection
    {
        return cache()->tags([$this->classSlug])
            ->rememberForever("contact-{$this->id}-getAll", function () {
                return $this->orderBy('name')->get();
            });
    }

    public function getByTypes(array $types) : Collection
    {
        $key = implode('-', $types);

        return cache()->tags([$this->classSlug, 'contact-type'])
            ->rememberForever("contact-{$this->id}-getByTypes-{$key}", function () use ($types) {
                return $this->with(['contactTypes' => function ($query) use ($types) {
                        $query->whereIn('title', $types);
                    }])
                    ->orderBy('name')
                    ->get();
            });
    }
}
```

## Eloquent Queries

All Eloquent queries should be processed in dedicated methods within the queries trait of the model. The default getter methods provided by Eloquent should not be used anywhere outside of the model or its traits, with the exception of the following:

- find()
- findOrFail()

## Relationship Properties

Do not query relationship properties on models directly. Instead expose the relationship property as a dynamic property in the model itself. This allows you to provide a default if the relationship does not exist, as well as limits interdependence of models to only the models themselves, and not through your code. For example, instead of `$book->author->name`, create a model attribute called `authorName`, then call that as `$book->authorName` in your code:

```php
<?php namespace App;

use App\Traits\Attributes\Book as Attributes;

class Book extends Model
{
    use Attributes;
    
    public function author() : HasOne
    {
        return $this->hasOne(Author::class);
    }
}
<?php namespace App\Traits\Attributes;

trait Book
{
    public function getAuthorNameAttribute() : string
    {
        return $this->author->name ?? '';
    }
}
```

## Naming Conventions

### For Properties or Methods with Certain Return Types

- boolean props or methods that check if a certain condition is true should be named `has<Condition in past tense>`.

### For Query Methods

- methods returning a single instance should be prefixed with `find` followed by the name of the model instance it returns, for example `->findUserByName(string $name)`.
- methods returning a collection of instances should be prefixed with `get` followed by the name of the model instances is returns, for example `->getUsersByType(string $type)`.

## Caching

- Caching should only be done using tags named after the model, and any specific parameters that make that query unique. Cache tags should be flushed when the corresponding model gets updated, saved, or deleted, so that subsequent responses will incorporate the changes.
- All queries in the model&#39;s query trait should be cached, as well those in attribute methods that access the database directly, and not through an already cached model query.
- Cached queries should be cached forever by default. However, if they incorporate timestamps or other temporal conditions, a sensible timeout should be set, depending on their use-case, typically between 1 and 15 minutes.
