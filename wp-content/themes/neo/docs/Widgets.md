# Widgets

By default, WordPress have some widgets, but we disabled it in `bootstrap.php`.

If you want to register custom widget, use our useful facade to do it:

```php 
DashboardWidget::register('neo_welcome_widget', 'Neo framework', 'Добро пожаловать в <b>NEO.</b>');
// 1 - widget id (should be unique)
// 2 - widget title
// 3 - widget html content
```