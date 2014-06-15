TinyMVC
=======

Very tiny PHP 5.3 MVC tool, not yet ready for live usage

ToDo:
- ~~remove class breadcrumb~~
- ~~add class string, add methods contains (for config::get)~~, isAlphanumeric, isEmail, etc.
- class db add table create, truncate, delete, use mysqli
- ~~config: add "app.db_env1.dbhost"~~
- class dir add methods create, delete, move, exists (for plugin::)
- class file add method getExtenion (for config::load), getSize, getDimension, lastEdit, exists
- ~~add class helper~~
- try to load a model via model class twice
- class plugin rename searchPlugins to getPlugins, call validate inside getPlugins, set exists to true, add method list and return valid plugins
- ~~use file::exists in router::listen~~
- add class log
- add class splittest
- add class form
- add class exception/error/warning
- ~~add set method for Config class~~
- add class validator
- ~~fix bug in class HTML, when HTML class used inside callback function of HTML class (reset private properties)~~
