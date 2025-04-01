# Templates

We are using Blade-like template engine instead of default PHP-way implemented in WP. Our template files has `*.blade.php` extension, that mean this file will be compiled.

## Directives

- `@header` instead of `wp_head()`
- `@footer` instead of `wp_footer()`

## Loops

Default loop:
```php 
@foreach($array as $key => $value) // foreach, for, while
    <p>Hello, {{ $value }}</p> // {{ $variable }} 
@endforeach // endforeach, endfor, endwhile
```

WP loop:
```php 
@loop("posts|paged:2") // set post type "posts" and set pagination per page 2.
    @title // output default wp title, instead of the_title().
    @field("date") // output custom field from content-type.
@empty // if nothing found.
    No posts yet. 
@endloop // end loop
```

## Structures

IF:
```php 
@if(true)
    Hello!
@endif
```

Else:
```php 
@if(true)
    Hello!
@else    
    Not hello :(
@endif
```

## Other

Comments
```
{{-- Hello, world --}}
```

Include other blade part
```php 
@include("hello") // templates/hello.blade.php
```