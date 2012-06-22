# [Composer](http://getcomposer.org) installer package for [Lithium PHP](http://lithify.me)

#### Shakeing up Composer!
There's been some movement towards centralizing Framework installers for composer. The primary project is called [baton](https://github.com/shama/baton) but there has been [some interest in the community](https://github.com/composer/composer/issues/820) that Composer adopt it as it's own.

If this happens then, obviously, this project will become irrelevant.

I support this request, you should too! Check out Baton, it's swell!

### Notice
> This may __look__ like a lithium library, however it is not.
>
> This is a composer installer package that installs composer packages of type `li3-libraries` to the proper place in lithium.
>
> This means you do not need to install it in your app, you just need to require it in the composer file of your li3 plugin.

***

## Set up your own li3 composer plugin
> I'm going to go ahead and assume, for now, that you know how to submit a package to [Packagist](http://packagist.org)
>
> If not don't worry, I'll outline briefly how to do that in a bit.

Create your `composer.json` installer file at the root of your plugin

~~~
LITHIUM_APP_PATH . "app/libraries/li3_myplugin/composer.json"
~~~

Make sure you require this package and ensure that the package type for your plugin is set to `li3-libraries`.

Here is an example `composer.json` file (based off of my [smarty plugin](http://www.github.com/joseym/li3_smarty))

~~~ json
{
	"name": "joseym/li3_smarty",
	"type": "li3-libraries",
	"description": "Smarty PHP plugin for Lithium PHP ... if you're into that sort of thing",
	"keywords": ["template engine", "smarty", "lithium"],
	"homepage": "https://github.com/joseym/li3_smarty",
	"license": "GNU General Public License",
	"authors": [
		{
			"name": "Josey Morton",
			"email": "me@joseymorton.com",
			"homepage": "https://github.com/joseym"
		},
		{
			"name": "Alex Denvir",
			"email": "coldfff@gmail.com",
			"homepage": "https://github.com/alexdenvir"
		}
	],

	"require": {
		"php": ">=5.3",
		"joseym/li3_installer": "master"
	}

}
~~~

The above should be pretty self explanatory, the primary things to notice are the `type` key and the `require` hash.

The smarty plugin requires this installer, therefore when you tell your app to require the smarty plugin Composer will automatically grab and install the `li3_installer` package if it doesn't already exist, otherwise it will just use it.

## Using composer and the installer

Here's an example apps `composer.json` file, it will install `li3_smarty`.

~~~ json
{
	"name": "lithium-dev",
	"version": "0.1.0",
	"config": {
		"vendor-dir": "libraries/_source"
	},
	"require": {
		"joseym/li3_smarty": "master"
	}
}
~~~

Ok, so first things first, the `config.vendor-dir` tells packages to install in the `libraries/_source` directory.

> I like to keep 3rd party things here (I like to keep my libraries directory "li3" friendly, only).
>
> Any non-lithium composer packages will now be installed in `libraries/_source`
>
> All li3-libraries packages will be installed in `libraries/li3_packagename` regardless of what is set in `config.vendor-dir`.
>
> _there is no law stating that this has to be the convention but it makes sense to me_

## Installing dependencies  with composer

In the root of your project (where composer is installed) run the following

~~~ bash
php composer.phar install
~~~

It should take a second to grab the dependancies but then you should see something like this:

~~~ bash
Installing dependencies
  - Package joseym/li3_installer (dev-master)
    Cloning 4f048b2888adbfbe8b8c8b5fdbf7f46ae2f95654

  - Package joseym/li3_smarty (dev-master)
    Cloning 9ab5b8e6b11e6d68f606e3882d4b4503821a1996
~~~

`li3_smarty` will now be in your `libraries` directory.

In `libraries` you will also see a directory with my vendor name `joseym`. Inside of `joseym` you will find the installer, `li3_installer`.

## Adding your plugin to packagist

Ok, so you have your plugin configured for composer (got composer.json in the root of the plugin), good!

In order to submit the package to packagist you need to follow these instructions:

1. [Register an account with packagist](http://packagist.org/register/)
2. Login and [Submit your package](http://packagist.org/packages/submit) - packages source control repositories, so in the case of li3_smarty I'm going to use my read-only git url.
3. Enter the url in the `Repository URL` field: `git://github.com/joseym/li3_smarty.git`

Packagist will then try to grab your repo and ensure that the `composer.json` file is valid.

You're good to go!

### Extras

In order to have your packagist repo automatically update whenever you push you'll want ot set up a github hook. 

This is easy, you enter your packagist username (if different from github) and the API Token they provide in githubs packagist hook form and check the active checkbox.

- New to Composer? [Read some docs](http://getcomposer.org/doc/)
- This effort was inspired by [an article](http://nitschinger.at/Playing-with-Composer-and-Lithium) by [Michael Nitschinger](https://twitter.com/#!/daschl)
- [I wrote an article explaining why, while Michael's efforts were good, some other problems occurred](http://tumblr.joseymorton.com/post/22289486722/package-management-and-lithium-php)

Have questions or having problems? [Submit an issue](https://github.com/joseym/li3_installer/issues)!

### Props!
I want to thank my super-awesome employeer, [Vitals](http://www.vitals.com), for sponsoring this (and [other](https://github.com/joseym)) Lithium library development efforts as well as [nwp](http://github.com/nwp) for not yelling when I want to work on some plugins, hell - even encouraging.

Its nice to work for people that understand the value of giving back to the community that offers so much to us.