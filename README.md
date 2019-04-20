# password-manager-connection

Connect your PHP app to an external password manager.

## Installation

```
composer require particleflux/password-manager-connection
```

## Requirements

* minimum PHP 7.1

## Usage

```php
use particleflux\PMConnection\PassConnection;

// initialize the connection client
$connection = new PassConnection();

// get the password for the account 'facebook'
$password = $connection->getPassword('facebook');

// get the username for the account 'facebook'
$username = $connection->getUser('facebook');

// get a custom attribute for an account
$email = $connection->getAttribute('facebook', 'email');
```


### PassConnection

_PassConnection_ is a specific implementation to connect with [pass].

```php
$connection = new PassConnection([
    'prefix'        => 'social-media/',
    'userAttribute' => 'username',
]);
```

#### Configuration options

##### prefix 

A prefix applied to the pass entry name.

By default, this is empty, meaning that the _account_ given to the connection
methods is the complete account name. When having more complex or bigger
password databases though, it is common to group them by _subfolders_. These
subfolders can be auto-appended by using the prefix parameter.

For example, when setting _prefix_ to `social-media/`, the call to
`getPassword('facebook')` will actually get the password entry for
`social-media/facebook`.

##### userAttribute

The attribute to get the username.

To have additional data besides the password for an entry, it is common to have
specific attribute name prefixes. This options configures the attribute name
used for getting the username.

Taking this pass entry for example:

```
my-secret-password
username: my-username
```

This example, with the _userAttribute_ of `username`, will return _my-username_
in a call to `getUser()`.


[pass]: https://www.passwordstore.org/
