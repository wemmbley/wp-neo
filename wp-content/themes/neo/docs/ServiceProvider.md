# ServiceProvider

ServiceProvider is a pattern like Laravel, that registering services in our application (theme).

Now service provider can register:
- Custom content type
- New user role 

## Example 

```php 
<?php

namespace Neo\App\ServiceProviders;

use Neo\App\ContentStructure\ContentTypes\FilmContentType;
use Neo\Framework\ServiceProvider;

class ThemeServiceProvider extends ServiceProvider
{
    public function boot(): void {}

    public function register(): void
    {
        $this->registerCustomPostType(FilmContentType::class);
    }
}
```