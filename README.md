Typical Wordpress Theme
======================

### Requirements

- [Node.js](http://nodejs.org/download/)
- [Bower](http://bower.io/)

### Uses

- [GruntJS](http://gruntjs.com/) for building Sass styles and uglifying javascript files
- [Bourbon](http://bourbon.io/) mixin library for Sass

Installation
------------

```bash
$ npm install && bower install
```

Developing
------------

livereload is run on port 35729 (see functions.php)

Watch the change of .scss files and build the .css

```bash
$ grunt watch
```

Any vendor package installed with bower must be declared in gruntfile.js

Build it
------------

Build the project to minify assets

```bash
$ grunt build
```
