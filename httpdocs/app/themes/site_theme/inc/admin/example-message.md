### I'm an example

You can create simple info boxes in the admin on any page you need.

Drop this into your inc/common.php file and check me out on the Dashboard.

```
ThemeHelper::addHelper('infoBox', 'Help Box', dirname(__FILE__) . "/admin/example-message.md", ['dashboard']);
```
