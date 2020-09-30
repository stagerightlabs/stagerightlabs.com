@extends('layouts.deck')

@section('title', 'A Gentle Introduction to Docker')

@section('slides')
<section>
  <h1>Docker</h1>
  <p>A Gentle Introduction</p>
</section>

<!-- "Works on my machine" -->
<section>
  <h1>A Common Problem:</h1>
  <p>"It works on my machine..."</p>
</section>

<section>
  <h1>Solutions</h1>
  <ul>
    <li>Vagrant: Virtual Machines</li>
    <li>Docker: Containers</li>
  </ul>
</section>

<section>
  <h1>Virtual Machines are Cumbersome</h1>
  <p>They use a lot of resources and tend to be very large.</p>
</section>

<!-- Why containers? -->
<section>
  <h1>Why use containers?</h1>
  <ul>
    <li>They run in isolated kernel processes.</li>
    <li>They have a small footprint.</li>
    <li>The stakes are very low.</li>
    <li>You can easily share them with your friends</li>
  </ul>
</section>

<!-- Meme picture -->
<section>
  <img src="{{ url(asset('img/decks/works_on_my_machine.jpg')) }}" title="It works on my machine" />
  <h6>https://www.reddit.com/r/ProgrammerHumor/comments/cw58z7/it_works_on_my_machine/</h6>
</section>

<!-- Basic Terminology -->
<section>
  <h1>Some Basic Terminology</h1>
  <ul>
    <li>Image</li>
    <li>Container</li>
    <li>Volume</li>
    <li>Registry</li>
  </ul>
</section>

<!-- What is an image? -->
<section>
  <h1>What is an image?</h1>
  <p>An image is an immutable bundle of "layers" that define a software system.</p>
  <p>Images are defined in Dockerfiles.</p>
</section>

<!-- What is a container? -->
<section>
  <h1>What is a container?</h1>
  <p>A container is an instance of an image that is running on a host machine.</p>
</section>

<!-- What is a volume? -->
<section>
  <h1>What is a volume?</h1>
  <p>A volume is a storage location that can be shared between docker containers and a host machine.</p>
</section>

<!-- What is a registry? -->
<section>
  <h1>What is a registry?</h1>
  <p>A registry is a library of public (or private) images that can be pulled down to a local host machine.</p>
</section>

<!-- Installation -->
<section>
  <h1>Installation</h1>
  <p>Docker is available for Windows, Mach and Linux:</p>
  <p><a href="https://docs.docker.com/install/">https://docs.docker.com/install/</a></p>
</section>

<!-- Dockerhub -->
<section>
  <h1>Docker Hub</h1>
  <p><a href="https://hub.docker.com">hub.docker.com</a> is the most popular image registry.</p>
  <p>You can find many open source projects hosting docker images on Docker Hub.</p>
</section>

<section>
  <p>There are many others: AWS, GitLab, Azure, etc. </p>
  <p>You can also host your own private registry <br />(using docker!)</p>
</section>

<!-- Example -->
<section>
  <h1>"Hello World"</h1>
<pre><code class="shell" data-trim>
docker run hello-world
</code></pre>
</section>

<!-- Docker CLI commands -->
<section>
  <h1>Docker Command: "run"</h1>
<pre><code class="shell" data-trim>
docker run {image-name}
</code></pre>
  <p>This creates a container from an image.</p>
</section>

<section>
  <p>The 'run' command has a lot of options.</p>
  <p><a href="https://docs.docker.com/engine/reference/commandline/run/">https://docs.docker.com/engine/reference/commandline/run/</a></p>
</section>

<section>
  <h1>Docker Command: "run"</h1>
<pre><code class="shell" data-trim>
docker run {image-name} {command?}
</code></pre>
  <p>You can optionally specify a command.</p>
</section>

<section>
  <h1>Docker Command: "run"</h1>
<pre><code class="shell" data-trim>
docker run -i {image-name} {command?}
</code></pre>
  <p>The '-i' flag stands for "interactive".  This will keep the container attached to your terminal session.</p>
</section>

<section>
  <h1>Docker Command: "run"</h1>
<pre><code class="shell" data-trim>
docker run -t {image-name} {command?}
</code></pre>
  <p>The '-t' flag stands for "pseudo TTY".  This will tell docker that you are connecting via a terminal session.</p>
</section>

<section>
  <h1>Docker Command: "run"</h1>
<pre><code class="shell" data-trim>
docker run -it {image-name} {command?}
</code></pre>
  <p>If you want to interact with a container and see the output it generates you will generally want to use these two flags together.</p>
</section>

<section>
  <h1>Docker Command: "run"</h1>
<pre><code class="shell" data-trim>
docker run --rm {image-name} {command?}
</code></pre>
  <p>The '--rm' option will automatically remove the container when the command finishes. <br />   (Note the two dashes.)</p>
</section>

<section>
  <h1>Docker Command: "run"</h1>
<pre><code class="shell" data-trim>
docker run -v /host/path:/container/path {image-name} {command?}
</code></pre>
  <p>The '-v' option will mount a local folder into the container.</p>
</section>

<!-- Putting it all together. -->
<section>
  <h1>Example Usage</h1>
<pre><code class="shell" data-trim>
// .bash-aliases
carbon() {
docker run -it --rm -v $(pwd):/src node:carbon /bin/sh -c "cd /src; ${*:-sh}"
}

alias carbon=carbon
</code></pre>
</section>

<section>
  <p>This is a handy tool, but there is one problem: File Ownership.</p>
</section>

<section>
  <p>Solution: Let's build an image!</p>
</section>

<!-- What is a Dockerfile? -->
<section>
  <h1>Dockerfiles</h1>
  <p>A <span style="font-family: monospace;">Dockerfile</span> is used to describe an image.</p>
  <p>Each line of the docker file represents one "layer" of the image.</p>
</section>

<!-- Dockerfile: Inheritance -->
<section>
  <h1>An Example Dockerfile</h1>
<pre class="docker"><code># ~/project/Dockerfile
FROM postgres:9.6

LABEL maintainer="Ryan Durham"

# Copy psqlrc config to the postgres home directory
COPY --chown=postgres:postgres .psqlrc /var/lib/postgresql/

# Install VIM
RUN apt update && apt install vim -y

WORKDIR /var/lib/postgresql

ENV PATH "$PATH:/var/lib/postgresql"
</code></pre>
</section>

<!-- Build and Tag the image -->
<section>
  <h1>Docker Command: "build"</h1>
<pre><code class="shell" data-trim>
docker build .
</code></pre>
  <p>Here we are creating an image from a Dockerfile. <br />The "." indicates that we want to use the Dockerfile in the current directory.</p>
</section>

<section>
  <h1>Docker Command: "build"</h1>
<pre><code class="shell" data-trim>
docker build -f /path/to/Dockerfile
</code></pre>
  <p>We can use the '-f' flag to specify a Dockerfile in a different directory.</p>
</section>

<section>
  <h1>Docker Command: "build"</h1>
<pre><code class="shell" data-trim>
docker build . -t my-image:latest
</code></pre>
  <p>The '-t' option lets us tag the image with a name and a version. This is the name we will use when referencing the image with the "run" command.</p>
</section>

<!-- Demo: Build an image -->
<section>
  <h1>Demo: Build a Custom Image</h1>
</section>

<!-- List all running containers -->
<section>
  <h1>Helpful Tips</h1>
  <ul>
    <li>
      docker container ls
    </li>
    <li>
      docker image ls
    </li>
    <li>
      docker ps
    </li>
    <li>
      docker system prune
    </li>
  </ul>
</section>

<!-- This is just the tip of the iceberg -->
<section>
  <p>Docker is a very powerful tool - this is just the tip of the iceberg.</p>
</section>

<!-- documentation links -->
<section>
  <h1>Documentation Links</h1>
  <p>The docker docs are great but they can be a bit overwhelming.</p>
  <ul>
    <li><a href="https://docs.docker.com/install/">Installation</a></li>
    <li><a href="https://docs.docker.com/get-started/">Getting Started</a></li>
    <li><a href="https://docs.docker.com/engine/reference/commandline/run/">Run</a></li>
    <li><a href="https://docs.docker.com/engine/reference/commandline/build/">Build</a></li>
  </ul>
</section>

<!-- additional resources -->
<section>
  <h2><strong>Additional Resources</strong></h2>
  <ul class="left">
    <li>
      <a href="https://www.freecodecamp.org/news/a-beginner-friendly-introduction-to-containers-vms-and-docker-79a9e3e119b/">A Beginner Friendly Guide</a>
    </li>
    <li>
      <a href="https://medium.com/swlh/what-exactly-is-docker-1dd62e1fde38">What Exactly Is Docker?</a>
    </li>
    <li>
      <a href="https://docker-curriculum.com/">Docker Curriculum</a>
    </li>
  </ul>
</section>

<section>
  <p>Questions?</p>
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
</section>
@endsection
