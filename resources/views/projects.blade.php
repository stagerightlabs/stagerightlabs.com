@extends('layouts.app')

@section('title', 'Open Source Projects')

@section('content')
  <x-page-header>Open Source Projects</x-page-header>
  <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <x-card heading="Centaur">
      <p>An opinionated implementation of the Cartalyst Sentinel Authorization framework for Laravel Applications.</p>
      <p class="inline-flex my-4 space-x-2">
        <img src="https://img.shields.io/travis/stagerightlabs/Centaur.svg" alt="Travis Build Status">
        <img src="https://img.shields.io/packagist/dt/SRLabs/Centaur.svg" alt="Packagist Download Count">
        <img src="https://img.shields.io/packagist/v/SRLabs/Centaur.svg" alt="Latest Packagist Version">
        <img src="https://img.shields.io/packagist/l/SRLabs/Centaur.svg" alt="MIT License">
      </p>
      <p>
        <x-button.primary
          url="https://github.com/stagerightlabs/Centaur"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-external-link"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/srlabs/centaur"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-external-link"
        >View on Packagist</x-button.secondary>
      </p>
    </x-card>
    <x-card heading="Eloquent Single Table Inheritance">
      <p>A tool for implementing Single Table Inheritance in Laravel Applications.</p>
      <p class="inline-flex my-4 space-x-2">
        <img src="https://img.shields.io/packagist/dt/SRLabs/eloquent-sti.svg" alt="Packagist Download Count">
        <img src="https://img.shields.io/packagist/v/SRLabs/eloquent-sti.svg" alt="Latest Packagist Version">
        <img src="https://img.shields.io/packagist/l/SRLabs/eloquent-sti.svg" alt="MIT License">
      </p>
      <p>
        <x-button.primary
          url="https://github.com/stagerightlabs/eloquent-sti"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-external-link"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/srlabs/eloquent-sti"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-external-link"
        >View on Packagist</x-button.secondary>
      </p>
    </x-card>
    <x-card heading="Matomo/Piwik for October CMS">
      <p>A plugin for October CMS that provides Piwik Analytics tracking code.</p>
      <p>
        <x-button.primary
          url="https://github.com/stagerightlabs/piwik-plugin"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-external-link"
        >View on GitHub</x-button.primary>
      </p>
    </x-card>
    <x-card heading="Parley">
      <p>Polymorphic messaging for Laravel Models.</p>
      <p class="inline-flex my-4 space-x-2">
        <img src="https://img.shields.io/travis/stagerightlabs/parley.svg" alt="Travis Build Status">
        <img src="https://img.shields.io/packagist/dt/SRLabs/parley.svg" alt="Packagist Download Count">
        <img src="https://img.shields.io/packagist/v/SRLabs/parley.svg" alt="Latest Packagist Version">
        <img src="https://img.shields.io/packagist/l/SRLabs/parley.svg" alt="MIT License">
      </p>
      <p>
        <x-button.primary
          url="https://github.com/stagerightlabs/parley"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-external-link"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/srlabs/parley"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-external-link"
        >View on Packagist</x-button.secondary>
      </p>
    </x-card>
    <x-card heading="Sentinel">
      <p>An opinionated implementation of the Cartalyst Sentry Authorization framework for Laravel Applications. Listed here for historical purposes; do not use this if you are staring a new application.</p>
      <p class="inline-flex my-4 space-x-2">
        <img src="https://img.shields.io/travis/rydurham/sentinel.svg" alt="Travis Build Status">
        <img src="https://img.shields.io/packagist/dt/rydurham/sentinel.svg" alt="Packagist Download Count">
        <img src="https://img.shields.io/packagist/v/rydurham/sentinel.svg" alt="Latest Packagist Version">
        <img src="https://img.shields.io/packagist/l/rydurham/sentinel.svg" alt="MIT License">
      </p>
      <p>
        <x-button.primary
          url="https://github.com/rydurham/Sentinel"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-external-link"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/rydurham/sentinel"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-external-link"
        >View on Packagist</x-button.secondary>
      </p>
    </x-card>
  </div>
@endsection
