# JARL
Just Another Router and Loader

## What this does
Set up simple-yet-effective

* Request routing
* Error handling and logging
* Autoloading, supporting namespaced classes
* Secure data handling
  * XSS-sanitized inputs
  * Encrypted sessions

## What this does not do
Anything else.

## Use
1. Have a front-controller that does nothing but include bootstrap.php

## Best Practices
* Develop with error reporting at the default levels provided in the config file (-1)
* Monitor your logs
* Turn off `display_errors` in your config when deployed to public-facing environments
