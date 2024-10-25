@extends('layouts.deck')

@section('title', 'HTMX and Hypermedia')

@section('slides')
<section>
    <h1>HTMX and Hypermedia</h1>
    <p>Back to the Future</p>
</section>

{{-- Thank the sponsors --}}
<section>
  <h1>Thank you Sponsors!</h1>
  <ul>
    <li><a href="https://www.infobip.com/">infobip</a></li>
    <li><a href="https://www.phparch.com/">php[architect]</a></li>
    <li><a href="https://vehikl.com/">vehikl</a></li>
    <li><a href="https://www.foxy.io/">foxy.io</a></li>
    <li><a href="https://remotedevforce.com/">remote dev force</a></li>
  </ul>
</section>

{{-- Thank the organizers --}}
<section>
  <h1>Thank you organizers!</h1>
  <p>Alena and the whole crew</p>
</section>

<!-- About Me -->
<section>
  <img src="{{ url(asset('img/scusa.jpeg')) }}" style="width: 250px"  class="rounded-full" />
  <p>Ryan Durham</p>
  <p style="font-size: 80%;">
    Senior Engineer @ <a href="https://firebrandtech.com">Firebrand Technologies</a>
    <br />
    Owner @ <a href="https://stagerightlabs.com">Stage Right Labs</a>
  </p>
  <p style="font-size: 70%;">
    <svg aria-hidden="true" width="31" height="32" focusable="false"
          style="font-size:2em; vertical-align:middle" role="img" xmlns="http://www.w3.org/2000/svg"
          viewBox="0 0 512 512">
      <path fill="currentColor"
            d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
      </path>
    </svg>
    ryan at stagerightlabs dot com
  </p>
  <p style="font-size: 70%; margin-top:0">
    <svg aria-hidden="true" width="31" height="32" viewBox="0 0 496 512" focusable="false"
          style="font-size:2em; vertical-align:middle" role="img" xmlns="http://www.w3.org/2000/svg">
      <path
            d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 0.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-0.3 5.6 1.3 5.6 3.6zM134.8 392.9c0.7-2 3.6-3 6.2-2.3 3 0.9 4.9 3.2 4.3 5.2-0.6 2-3.6 3-6.2 2-3-0.6-5-2.9-4.3-4.9zM179 391.2c2.9-0.3 5.6 1 5.9 2.9 0.3 2-1.7 3.9-4.6 4.6-3 0.7-5.6-0.6-5.9-2.6-0.3-2.3 1.7-4.2 4.6-4.9zM244.8 8c138.7 0 251.2 105.3 251.2 244 0 110.9-67.8 205.8-167.8 239-12.7 2.3-17.3-5.6-17.3-12.1 0-8.2 0.3-49.9 0.3-83.6 0-23.5-7.8-38.5-17-46.4 55.9-6.3 114.8-14 114.8-110.5 0-27.4-9.8-41.2-25.8-58.9 2.6-6.5 11.1-33.2-2.6-67.9-20.9-6.6-69 27-69 27-20-5.6-41.5-8.5-62.8-8.5s-42.8 2.9-62.8 8.5c0 0-48.1-33.5-69-27-13.7 34.6-5.2 61.4-2.6 67.9-16 17.6-23.6 31.4-23.6 58.9 0 96.2 56.4 104.3 112.3 110.5-7.2 6.6-13.7 17.7-16 33.7-14.3 6.6-51 17.7-72.9-20.9-13.7-23.8-38.6-25.8-38.6-25.8-24.5-0.3-1.6 15.4-1.6 15.4 16.4 7.5 27.8 36.6 27.8 36.6 14.7 44.8 84.7 29.8 84.7 29.8 0 21 0.3 55.2 0.3 61.4 0 6.5-4.5 14.4-17.3 12.1-99.7-33.4-169.5-128.3-169.5-239.2 0-138.7 106.1-244 244.8-244zM97.2 352.9c1.3-1.3 3.6-0.6 5.2 1 1.7 1.9 2 4.2 0.7 5.2-1.3 1.3-3.6 0.6-5.2-1-1.7-1.9-2-4.2-0.7-5.2zM86.4 344.8c0.7-1 2.3-1.3 4.3-0.7 2 1 3 2.6 2.3 3.9-0.7 1.4-2.7 1.7-4.3 0.7-2-1-3-2.6-2.3-3.9zM118.8 380.4c1.3-1.6 4.3-1.3 6.5 1 2 1.9 2.6 4.9 1.3 6.2-1.3 1.6-4.2 1.3-6.5-1-2.3-1.9-2.9-4.9-1.3-6.2zM107.4 365.7c1.6-1.3 4.2-0.3 5.6 2 1.6 2.3 1.6 4.9 0 6.2-1.3 1-4 0-5.6-2.3-1.6-2.3-1.6-4.9 0-5.9z">
      </path>
    </svg>
    <a href="https://github.com/stagerightlabs">stagerightlabs</a>
  </p>
</section>

{{-- Form Method Spoofing --}}
<section>
  <pre><code class="html">&lt;input type="hidden" name="_method" value="DELETE"&gt;</code></pre>
</section>

{{-- Hypermedia --}}
<section>
  <h3>Hypertext and Hypermedia</h3>
  <p>A non-linear way of navigating information; the reader can link to wherever they want to go.</p>
  <p>The term was coined by Ted Nelson in 1965</p>
</section>

<section>
  <blockquote>
    Hypertexts: new forms of writing, appearing on computer screens, that will branch or perform at the reader’s command. A hypertext is a non-sequential piece of writing; only the computer display makes it practical.
  </blockquote>
  <p><a href="https://archive.org/details/SelectedPapers1977/page/n7/mode/2up">Ted Nelson</a></p>
</section>

<section>
  <h3>Examples</h3>
  <ul>
    <li>Mac Hypercard</li>
    <li>FileMaker</li>
    <li>Adobe Flash</li>
    <li>Project Xanadu</li>
  </ul>
  <p>Older than the web itself</p>
</section>

<section>
  <h3>The World Wide Web</h3>
  <p>The most popular example of hypermedia</p>
</section>

{{-- HTML --}}
<section>
  <p><strong>HTML:</strong> Hypertext Markup Language</p>
  <p><strong>HTTP:</strong> Hypertext Transfer Protocol</p>
</section>

<section>
  <h3>Key Components of HTML</h3>
  <ul>
    <li><code>&lt;a&gt;</code> Drives Interactivity</li>
    <li><code>&lt;form&gt;</code> Allows users to udpate the state of resources on the server</li>
  </ul>
</section>

<section>
  <h3>HTML is Incomplete</h3>
  <p>It could support more interactivity and richer experiences but it does not</p>
</section>

<section>
  <p>The desire for richer web experiences has popularized the JavaScript Single Page Application</p>
</section>

<section>
  <h3>JavaScript SPA</h3>
  <ul>
    <li>The main appeal is more interactive and immersive user experiences</li>
    <li>The downside is complexity</li>
  </ul>
</section>

<section>
  <h3>The complexity of JavaScript</h3>
  <ul>
    <li>Work must be done to translate a JSON response into HTML updates</li>
    <li>A change in the JSON response implies a change in the JS code and vice versa; they are tightly coupled</li>
    <li>It is likely that business logic will be duplicated between the client and the server</li>
    <li>Reinventing native browser functionality requires a lot of work</li>
  </ul>
</section>

<section>
  <h3>Advantages of Hypermedia</h3>
  <ul>
    <li>Simplicity</li>
    <li>Tolerance of change</li>
    <li>Endorsement of Native browser features</li>
  </ul>
</section>

{{-- HTML over the wire --}}
<section>
  <h3>HTML Over the Wire</h3>
  <p>This seems like a small change, <br/>but there are big implications</p>
</section>

<section>
  <h3>An example of a Hypermedia Response</h3>
  <pre><code>
    <div>
      <p>Seattle, WA <small>January, 2025</small></p>
      <p>Sold Out!</p>
    </div>
    <div>
      <p>Portland, OR <small>February, 2025</small></p>
      <p>Sold Out!</p>
    </div>
    <div>
      <p>San Francisco, CA <small>March, 2025</small></p>
      <a href="tickets">Buy Tickets</a>
    </div>
  </code></pre>
</section>

<section>
  <h3>HATEOS</h3>
  <p>Hypermedia as the Engine of Application State</p>
</section>

<section>
  <h3>Hypermedia is Less Complex</h3>
  <p>The client needs no knowledge of application state; <br />it just needs to render HTML</p>
</section>

{{-- REST --}}
<section>
  <h3>REST: REpresentational State Transfer</h3>
  <ul>
    <li>These days REST largely refers to a style of JSON API, but originally it was about an architecture for distributed hypermedia systems</li>
    <li>The term was coined by <a href="https://ics.uci.edu/~fielding/pubs/dissertation/rest_arch_style.htm">Roy Fielding in 2000</a></li>
    <li>The content of a response is an HTML representation of the requested resource</li>
    <li>HATEOS is a key component of REST architecture</li>
  </ul>
</section>

<section>
  <h3>Key Takeaway</h3>
  <p>Sending HTML over the wire unlocks a completely different way to think about building web applications</p>
</section>

<section>
  <h3>HTML is Incomplete</h3>
  <p>It could support more interactivity and richer experiences but it does not</p>
</section>

{{-- Form Method Spoofing --}}
<section>
  <h3>Form Method Spoofing</h3>
  <pre><code class="html">&lt;input type="hidden" name="_method" value="DELETE"&gt;</code></pre>
</section>

<section>
  <p>What if we could take advantage of <br/>the full possibilities of HTML?</p>
</section>

{{-- HTMX --}}
<section>
  <h3>HTMX</h3>
  <p>A small javascript library that aims to augment HTML just enough to enable richer UI experiences without letting go of the benefits of hypermedia.</p>
  <p><a href="https://htmx.org/">htmx.org</a></p>
</section>

<section>
  <h3>An example of an HTMX Interaction</h3>
  <pre><code>
    <button hx-get="/contacts/1" hx-target="#contact-ui">
      Fetch Contact
    </button>
  </code></pre>
</section>

<section>
  <p>We don't need to respond with full page content; <br />we cand send <i>fragments</i> instead.</p>
  <p>Many server side templating tools support fragments.</p>
</section>

<section>
  <h3>The HOWL Stack: <br>Hypermedia on Whatever Like</h3>
  <p>You can use any server side language that can interpret headers and render HTML; even JavaScript!</p>
</section>

<section>
  <h3>The Triptych Proposals</h3>
  <p>An effort to update the HTML spec:</p>
  <ul>
    <li>Support PUT, PATCH, and DELETE in HTML Forms</li>
    <li>Button HTTP Requests</li>
    <li>Partial Page Replacement</li>
  </ul>
  <p><a href="https://alexanderpetros.com/triptych/">https://alexanderpetros.com/triptych/</a></p>
</section>

<section>
  <p> Hypermedia is a great choice for many websites, but doesn't make sense for every application</p>
  <p>Even in those applications there may still be a place for Hypermedia</p>
</section>

<section>
  <h3>Further Reading</h3>
  <p><i>Hypermedia Systems: The revolutionary ideas that empowered the Web</i></p>
  <p><a href="hypermedia.systems">hypermedia.systems</a></p>
</section>

@endsection
