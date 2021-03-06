@extends('layouts.deck')

@section('title', 'Laravel 101')

@section('slides')
 <section>
    <a href="http://laravel.com">
      <img src="{{ url(asset('img/decks/laravel.png')) }}" alt="Laravel Logo">
    </a>
    <h2>Introducing Laravel</h2>
    <p>An Eloquent PHP Framework</p>
  </section>

  <section>
    <img src="{{ url(asset('img/avatar.jpg')) }}" style="width: 250px"  class="rounded-full" />
    <p>
      Ryan Durham
      <br />
      <a href="https://stagerightlabs.com">Stage Right Labs</a>
    </p>
    <p style="font-size: 80%;">
      <svg aria-hidden="true"  width="31" height="32" focusable="false" style="font-size:2em; vertical-align:middle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path fill="currentColor"
              d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
        </path>
      </svg>
      ryan at stagerightlabs dot com
    </p>
    <p style="font-size: 80%; margin-top:0">
      <svg aria-hidden="true" width="31" height="32" viewBox="0 0 496 512" focusable="false" style="font-size:2em; vertical-align:middle" role="img" xmlns="http://www.w3.org/2000/svg">
        <path
          d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 0.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-0.3 5.6 1.3 5.6 3.6zM134.8 392.9c0.7-2 3.6-3 6.2-2.3 3 0.9 4.9 3.2 4.3 5.2-0.6 2-3.6 3-6.2 2-3-0.6-5-2.9-4.3-4.9zM179 391.2c2.9-0.3 5.6 1 5.9 2.9 0.3 2-1.7 3.9-4.6 4.6-3 0.7-5.6-0.6-5.9-2.6-0.3-2.3 1.7-4.2 4.6-4.9zM244.8 8c138.7 0 251.2 105.3 251.2 244 0 110.9-67.8 205.8-167.8 239-12.7 2.3-17.3-5.6-17.3-12.1 0-8.2 0.3-49.9 0.3-83.6 0-23.5-7.8-38.5-17-46.4 55.9-6.3 114.8-14 114.8-110.5 0-27.4-9.8-41.2-25.8-58.9 2.6-6.5 11.1-33.2-2.6-67.9-20.9-6.6-69 27-69 27-20-5.6-41.5-8.5-62.8-8.5s-42.8 2.9-62.8 8.5c0 0-48.1-33.5-69-27-13.7 34.6-5.2 61.4-2.6 67.9-16 17.6-23.6 31.4-23.6 58.9 0 96.2 56.4 104.3 112.3 110.5-7.2 6.6-13.7 17.7-16 33.7-14.3 6.6-51 17.7-72.9-20.9-13.7-23.8-38.6-25.8-38.6-25.8-24.5-0.3-1.6 15.4-1.6 15.4 16.4 7.5 27.8 36.6 27.8 36.6 14.7 44.8 84.7 29.8 84.7 29.8 0 21 0.3 55.2 0.3 61.4 0 6.5-4.5 14.4-17.3 12.1-99.7-33.4-169.5-128.3-169.5-239.2 0-138.7 106.1-244 244.8-244zM97.2 352.9c1.3-1.3 3.6-0.6 5.2 1 1.7 1.9 2 4.2 0.7 5.2-1.3 1.3-3.6 0.6-5.2-1-1.7-1.9-2-4.2-0.7-5.2zM86.4 344.8c0.7-1 2.3-1.3 4.3-0.7 2 1 3 2.6 2.3 3.9-0.7 1.4-2.7 1.7-4.3 0.7-2-1-3-2.6-2.3-3.9zM118.8 380.4c1.3-1.6 4.3-1.3 6.5 1 2 1.9 2.6 4.9 1.3 6.2-1.3 1.6-4.2 1.3-6.5-1-2.3-1.9-2.9-4.9-1.3-6.2zM107.4 365.7c1.6-1.3 4.2-0.3 5.6 2 1.6 2.3 1.6 4.9 0 6.2-1.3 1-4 0-5.6-2.3-1.6-2.3-1.6-4.9 0-5.9z">
        </path>
      </svg>
      <a href="https://github.com/stagerightlabs">stagerightlabs</a>
    </p>
  </section>

  <section>
    <a href="http://laravel.com">
      <img src="{{ url(asset('img/decks/laravel.png')) }}" alt="Laravel">
    </a>
    <h2>Laravel</h2>

    <aside class="notes">
      <ul>
        <li>Modern PHP Framework</li>
        <li>CodeIgniter, CakePHP, Symfony, Zend, Yii</li>
      </ul>
    </aside>
  </section>

  <section>
    <h3>Isn't PHP a dead horse?</h3>
    <h3 class="fragment">Not at all!</h3>
  </section>

  <section>
    <h3>PHP 5.3+</h3>
    <ul>
      <li>Objects &amp; Abstract Classes</li>
      <li>Namespacing</li>
      <li>Closures</li>
      <li>Native JSON Support</li>
      <li>5.4: Traits</li>
    </ul>
  </section>

  <section>
    <h3>Why use a Framework?</h3>
    <ul class="fragment">
      <li>No need to reinvent the wheel</li>
      <li>Repetive tasks made easy</li>
      <li>Faster development</li>
      <li>Security</li>
      <li>Community support</li>
    </ul>
  </section>

  <section id="laravel-features">
    <h3>Laravel Features</h3>
    <ul>
      <li>Database Migrations &amp; Seeding</li>
      <li>Command Line Tools: <a href="http://laravel.com/docs/artisan">Artisan</a></li>
      <li>Environments</li>
      <li>ORM: <a href="http://laravel.com/docs/eloquent">Eloquent</a></li>
      <li>Templating: <a href="http://laravel.com/docs/templates">Blade</a></li>
      <li>Integrated Authentication</li>
      <li>Events / Observables</li>
      <li>Queue Support: Beanstalkd, Redis, etc</li>
      <li>Internationalization Support</li>
      <li>Dependency Injection &amp; Inversion of Control</li>
    </ul>

    <aside class="notes">
      <ul>
        <li>"Ruby has been offering those features for years!"</li>
        <li>Brings the best parts of Ruby and other languages into PHP.</li>
      </ul>
    </aside>
  </section>

  <section>
    <h3>Benefits</h3>
    <ul>
      <li>Ease of Use</li>
      <li class="fragment">Flexibility</li>
      <li class="fragment">Testability / TDD</li>
      <li class="fragment">Extendablity (via Composer and <a href="https://packagist.org/">packagist.org</a>)
      </li>
      <li class="fragment">Large Development Community</li>
      <li class="fragment">Personal Growth</li>
    </ul>

    <aside class="notes">
      <ul>
        <li>MVC is not strictly enforced.</li>
        <li>"Where should I put this?"</li>
        <li>Built with testing in mind</li>
        <li>As you advance in your development practices, Laravel advances with you.</li>
      </ul>
    </aside>
  </section>

  <section>
    <h3>Requirements</h3>
    <ul>
      <li>PHP 5.3.7 or higher</li>
      <li>MCrypt PHP Extension</li>
    </ul>

    <aside class="notes">
      <ul>
        <li>Namespaces</li>
        <li></li>
      </ul>
    </aside>
  </section>

  <section>
    <a href="http://getcomposer.com">
      <img src="{{ url(asset('img/decks/logo-composer-transparent.png')) }}" alt="Composer">
    </a>
    <h3>Composer</h3>
    <p>Package Management for PHP</p>
    <p><a href="http://getcomposer.org">http://getcomposer.org</a></p>
  </section>

  <section>
    <h3>Installation:</h3>
    <br />
    <pre><code class="sh" data-trim>
$ curl -sS https://getcomposer.org/installer | php
$ sudo mv composer.phar /usr/local/bin/composer
    </code></pre>

  </section>

  <section>
    <h3>Creating a New Laravel Project</h3>
    <br />
    <pre><code class="sh" data-trim>
$ composer create-project laravel/laravel your-project-name
    </code></pre>
    <br />
    <ul>
      <li>Make <code>app/storage</code> directory writeable</li>
      <li>Edit <code>app/config</code> options: Database, Email, etc</li>
      <li>Make sure Apache's <code>mod_rewrite</code> is enabled </li>
      <li>Optional: Configure Apache Virtual Host Config</li>
    </ul>
  </section>

  <section>
    <h3>First Steps</h3>
  </section>

  <section>
    <h3>Routing</h3>
    <code>app/routes.php</code>
    <pre><code class="php" data-trim>
// Application Routes

Route::get('/login', function()
{
    return View::make('users.login');
});

// Resourceful Routes - Default CRUD Routes
Route::resource('groups', 'GroupController');


// Controller Routes - CRUD Routes + Anyting Else
Route::controller('users', 'UserController');
    </code></pre>

    <aside class="notes">
      <ul>
        <li>Are those static references?</li>
        <li>Facades</li>
        <li>Using a Closure</li>
      </ul>
    </aside>
  </section>

  <section>
    <h3>Views - Master Layout</h3>
    <p style="font-size:70%">app/views/layouts/master.blade.php</p>
    @verbatim
    <pre><code class="html" data-trim>
&lt;!DOCTYPE html&gt;
&lt;html lang=&quot;en&quot;&gt;
&lt;head&gt;
    &lt;title>
        @section('title')
    &lt;/title>
    &lt;link rel=&quot;stylesheet&quot; href=&quot;@{{ asset('css/bootstrap.min.css') }}&quot;&gt;
    &lt;link rel=&quot;stylesheet&quot; href=&quot;@{{ asset('css/bootstrap-theme.min.css') }}&quot;&gt;
&lt;/head&gt;
&lt;body&gt;
    &lt;div class="navbar navbar-inverse navbar-fixed-top">
      <!-- ... -->
    &lt;/div>
    <!-- Container -->
    &lt;div class="container">
        @yield('content')
    &lt;/div>
&lt;/body&gt;
&lt;/html&gt;
    </code></pre>
    @endverbatim
  </section>

  <section>
    <h3>Views - Basic Example</h3>
    <p style="font-size: 70%">app/views/users/login.blade.php</p>
    @verbatim
    <pre><code class="html" data-trim>
@extends('layouts.master')

@section('title', 'Log In')

@section('content')
&lt;div class=&quot;row&quot;&gt;
&lt;div class=&quot;col-md-4 col-md-offset-4&quot;&gt;
{{ Form::open(array('action' =&gt; 'UserController@login')) }}
  &lt;h2 class=&quot;form-signin-heading&quot;&gt;Sign In&lt;/h2&gt;
  {{ Form::text('email', null, array('class' =&gt; 'form-control', 'placeholder' =&gt; 'Email', 'autofocus')) }}
  {{ Form::password('password', array('class' =&gt; 'form-control', 'placeholder' =&gt; 'Password'))}}
  {{ Form::submit('Sign In', array('class' =&gt; 'btn btn-primary'))}}
{{ Form::close() }}
&lt;/div&gt;
&lt;/div&gt;
@stop
    </code></pre>
    @endverbatim
  </section>

  <section>
    <h3>Controllers</h3>
    <p style="font-size: 70%">app/controllers/UserController.php</p>
    <pre><code class="php" data-trim>
class UserController extends BaseController {

public function getIndex()
{
    return view('users.index')-&gt;with('users', User::all());
}

public function postLogin(Request $request)
{
    $email    = $request->input('email');
    $password = $request->input('password');

    if (Auth::attempt(['email' =&gt; $email, 'password' =&gt; $password]))
    {
        return redirect()->intended('dashboard');
    }

    return redirect('login');
}
}
    </code></pre>
  </section>

  <section>
    <h3>Downsides</h3>
    <ul>
      <li class="fragment">Not ideal for Shared Hosting Environments</li>
      <li class="fragment">Still Very New - Things Change Quickly</li>
      <li class="fragment">Documentation doesn't cover the entire codebase</li>
      <li class="fragment">Lack of contract work</li>
    </ul>
  </section>

  <section>
    <h3>Further Resources</h3>
    <ul>
      <li class="fragment"><a href="http://laravel.com/docs">Documentation</a></li>
      <li class="fragment"><a href="http://laracasts.com">Laracasts</a></li>
      <li class="fragment"><a href="http://laravel.io/forum">Laravel.io Forums</a></li>
      <li class="fragment"><a href="https://leanpub.com/codebright">Code Bright</a> by Dayle Rees</li>
      <li class="fragment"><a href="http://laravel.io/chat">IRC Forums</a></li>
      <li class="fragment"><a href="https://twitter.com/laravelphp">@laravelphp</a></li>
    </ul>

  </section>

  <section>
    <h3>Sentinel</h3>
    <br />
    Laravel Implementation of <a href="https://cartalyst.com/manual/sentry"><em>Sentry</em></a>
    Auth System
    <br /><br />
    <ul>
      <li><a
            href="http://www.ryandurham.com/projects/sentinel">ryandurham.com/projects/sentinel</a>
      </li>
      <li><a href="https://github.com/rydurham/sentinel">github.com/rydurham/sentinel</a></li>
    </ul>

  </section>

  <section>
    <h2>Thank you!</h2>
    <p style="font-size: 80%;">
      <svg
        aria-hidden="true"
        width="31"
        height="32"
        focusable="false"
        style="font-size:2em; vertical-align:middle"
        role="img"
        xmlns="http://www.w3.org/2000/svg"
        viewBox="0 0 512 512"
      >
        <path fill="currentColor"
              d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
        </path>
      </svg>
      ryan at stagerightlabs dot com
    </p>
    <p style="font-size: 80%; margin-top:0">
      <svg
        aria-hidden="true"
        width="31"
        height="32"
        viewBox="0 0 496 512"
        focusable="false"
        style="font-size:2em; vertical-align:middle"
        role="img" xmlns="http://www.w3.org/2000/svg"
      >
        <path fill="currentColor"
              d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 0.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-0.3 5.6 1.3 5.6 3.6zM134.8 392.9c0.7-2 3.6-3 6.2-2.3 3 0.9 4.9 3.2 4.3 5.2-0.6 2-3.6 3-6.2 2-3-0.6-5-2.9-4.3-4.9zM179 391.2c2.9-0.3 5.6 1 5.9 2.9 0.3 2-1.7 3.9-4.6 4.6-3 0.7-5.6-0.6-5.9-2.6-0.3-2.3 1.7-4.2 4.6-4.9zM244.8 8c138.7 0 251.2 105.3 251.2 244 0 110.9-67.8 205.8-167.8 239-12.7 2.3-17.3-5.6-17.3-12.1 0-8.2 0.3-49.9 0.3-83.6 0-23.5-7.8-38.5-17-46.4 55.9-6.3 114.8-14 114.8-110.5 0-27.4-9.8-41.2-25.8-58.9 2.6-6.5 11.1-33.2-2.6-67.9-20.9-6.6-69 27-69 27-20-5.6-41.5-8.5-62.8-8.5s-42.8 2.9-62.8 8.5c0 0-48.1-33.5-69-27-13.7 34.6-5.2 61.4-2.6 67.9-16 17.6-23.6 31.4-23.6 58.9 0 96.2 56.4 104.3 112.3 110.5-7.2 6.6-13.7 17.7-16 33.7-14.3 6.6-51 17.7-72.9-20.9-13.7-23.8-38.6-25.8-38.6-25.8-24.5-0.3-1.6 15.4-1.6 15.4 16.4 7.5 27.8 36.6 27.8 36.6 14.7 44.8 84.7 29.8 84.7 29.8 0 21 0.3 55.2 0.3 61.4 0 6.5-4.5 14.4-17.3 12.1-99.7-33.4-169.5-128.3-169.5-239.2 0-138.7 106.1-244 244.8-244zM97.2 352.9c1.3-1.3 3.6-0.6 5.2 1 1.7 1.9 2 4.2 0.7 5.2-1.3 1.3-3.6 0.6-5.2-1-1.7-1.9-2-4.2-0.7-5.2zM86.4 344.8c0.7-1 2.3-1.3 4.3-0.7 2 1 3 2.6 2.3 3.9-0.7 1.4-2.7 1.7-4.3 0.7-2-1-3-2.6-2.3-3.9zM118.8 380.4c1.3-1.6 4.3-1.3 6.5 1 2 1.9 2.6 4.9 1.3 6.2-1.3 1.6-4.2 1.3-6.5-1-2.3-1.9-2.9-4.9-1.3-6.2zM107.4 365.7c1.6-1.3 4.2-0.3 5.6 2 1.6 2.3 1.6 4.9 0 6.2-1.3 1-4 0-5.6-2.3-1.6-2.3-1.6-4.9 0-5.9z">
        </path>
      </svg>
      <a href="https://github.com/stagerightlabs">stagerightlabs</a>
    </p>
    <img src="../logo.png" alt="Stage Right Labs Logo" style="width: 200px" />
  </section>
@endsection
