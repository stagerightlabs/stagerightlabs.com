@extends('layouts.app')

@section('title', 'Resume')

@section('content')
  <x-page-header>Ryan C. Durham - Resume</x-page-header>
  <x-card heading="Summary" class="mb-8 text-xl">
    <p>
      Full stack developer with 10+ years experience in building and maintaining websites; 5 years experience with a large-scale enterprise application. Draws on a background in project management with a focus on communication. Enjoys staying current with industry trends and learning about new technologies.
    </p>
  </x-card>
  <x-card heading="Skills" class="mb-8">
    <dl class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-x-4 gap-y-8">
      <div class="sm:col-span-1">
        <dt class="text-lg leading-5 font-medium text-cool-gray-400">
          Server Side
        </dt>
        <dd class="mt-1 text-xl leading-5 text-cool-gray-300">
          PHP, Laravel, WordPress, Elixir
        </dd>
      </div>
      <div class="sm:col-span-1">
        <dt class="text-lg leading-5 font-medium text-cool-gray-400">
          Client Side
        </dt>
        <dd class="mt-1 text-xl leading-5 text-cool-gray-300">
          Javascript, Vue.js, CSS / Sass
        </dd>
      </div>
      <div class="sm:col-span-1">
        <dt class="text-lg leading-5 font-medium text-cool-gray-400">
          Databases
        </dt>
        <dd class="mt-1 text-xl leading-5 text-cool-gray-300">
          PostgreSQL, MySQL
        </dd>
      </div>
      <div class="sm:col-span-1">
        <dt class="text-lg leading-5 font-medium text-cool-gray-400">
          Operations
        </dt>
        <dd class="mt-1 text-xl leading-5 text-cool-gray-300">
          Docker, AWS
        </dd>
      </div>
    </dl>
  </x-card>
  <x-card heading="Experience" class="mb-8 text-xl">
    <p class="mb-4">
      <strong class="text-xl">Phylos</strong><br />
      Senior Engineer: 2019 – Present <br />
      Software Engineer: 2016 – 2019 <br />
      Contractor: 2014 - 2016
    </p>
    <ul class="mb-6 list-disc list-outside px-8">
      <li>Designed, built and currently maintains an enterprise scale PHP application that manages sales, LIMS laboratory workflows, delivery of customer results and financial reporting. Over 350,000 customer samples processed to date.</li>
      <li>Serves as a liaison between engineering, the wet lab and quality assurance.</li>
      <li>Implemented full-text search for a public facing strain database using PostgreSQL.</li>
      <li>Built an API for genotype data reporting in Elixir.</li>
      <li>Manages AWS infrastructure for deployments and hosting.</li>
      <li>Oversaw a production database conversion from MySQL to PostgreSQL.
    </ul>
    <p class="mb-4">
      <strong class="text-xl">Stage Right Labs, LLC</strong><br />
      Owner / Founder: 2014 - Present
    </p>
    <ul class="mb-6 list-disc list-outside px-8">
      <li>Provides consulting services for clients who lack technical backgrounds.</li>
      <li>Advises non-profits, artists and startups on best practices for the operation and maintenance of websites, domain names and email accounts.</li>
    </ul>
    <p class="mb-4">
      <strong class="text-xl">Freelance Web Developer</strong><br />
      2006 - 2014
    </p>
    <ul class="list-disc list-outside px-8">
      <li>Focused on using WordPress to translate client needs into web solutions.</li>
      <li>Handled 40+ clients with a variety of needs, including brand new websites and the care and maintenance of existing projects.</li>
    </ul>
  </x-card>
  <x-card heading="Education" class="mb-8 text-xl">
    <ul class="list-disc list-outside px-8">
      <li>
        Master of Fine Arts (MFA) in Stage Management - Yale School of Drama (2007)
      </li>
      <li>
        Bachelor of Arts (BA) in Drama / Minor in Computer Science - Vassar College (2004)
      </li>
    </ul>
  </x-card>
  <x-author />
@endsection
