# Given When Then (GWT) Plugin for Pest

> A simple API allows you to structure your tests focused on the behaviour. Given-When-Then separation makes the test easier to understand at a glance.

### Install
```shell
composer require milroyfraser/pest-plugin-gwt --dev
```

### Usage
```php
use App\Exceptions\BlockedUserException;
use App\Models\User;
use function Pest\Gwt\scenario;
use function Pest\Laravel\assertDatabaseHas;

scenario('activate user')
    ->given(fn() => User::factory()->create())
    ->when(fn(User $user) => $user->activate())
    ->then(fn(User $user) => assertDatabaseHas('users', [
        'id' => $user->id,
        'activated' => true,
    ]));

scenario('activate blocked user')
    ->given(fn() => User::factory()->blocked()->create())
    ->when(fn(User $user) => $user->activate())
    ->throws(BlockedUserException::class);
```

[more examples](https://github.com/milroyfraser/pest-plugin-gwt/blob/master/tests/Example.php)


**Given** a state

Given method accepts a `Closure`. This is where we `Arrange` application state. The return values will become argument/s of the `when` closure.

**When** I do something

When method accepts a `Closure`. This is where we `Act` (perform) the operation. The return values will become argument/s of the `then` closure.

**Then** I expect an outcome

Then method accepts a `Closure`. This is where we `Assert` the outcome.

> If you want to start testing your application with Pest, visit the main **[Pest Repository](https://github.com/pestphp/pest)**.

- Explore the docs: **[pestphp.com/docs/plugins/creating-plugins »](https://pestphp.com/docs/plugins/creating-plugins)**
- Follow us on Twitter: **[@pestphp »](https://twitter.com/pestphp)**
- Join us on the Discord Server: **[discord.gg/bMAJv82 »](https://discord.gg/bMAJv82)**

Pest was created by **[Nuno Maduro](https://twitter.com/enunomaduro)** under the **[Sponsorware license](https://github.com/sponsorware/docs)**. It got open-sourced and is now licensed under the **[MIT license](https://opensource.org/licenses/MIT)**.
