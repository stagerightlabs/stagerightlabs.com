@extends('layouts.app')

@section('title', 'Open Source Projects')

@section('content')
  <x-page-header>Open Source Projects</x-page-header>
  <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <x-card heading="Actions">
      <p>Action classes are a great strategy for encapsulating discrete units of business logic.  This package provides an opinionated foundation for implementing action classes in a PHP application.</p>
      <p class="inline-flex my-4 space-x-2">
        <img src="https://github.com/stagerightlabs/actions/workflows/CI/badge.svg" alt="Build Status">
        <img
          src="https://camo.githubusercontent.com/cf6ca8477ab9073106003ffd15ee3f205945ef9d9d20156de9b98a6b49740a44/68747470733a2f2f706f7365722e707567782e6f72672f737461676572696768746c6162732f616374696f6e732f76657273696f6e"
          alt="Latest Packagist Version"
          data-canonical-src="https://poser.pugx.org/stagerightlabs/actions/version"
        >
        <img
          src="https://camo.githubusercontent.com/ce54674cd4ae163db6a2957efe4cc5fc777678de97067cc419b02283c1bf948b/68747470733a2f2f706f7365722e707567782e6f72672f737461676572696768746c6162732f616374696f6e732f6c6963656e7365"
          alt="License"
          data-canonical-src="https://poser.pugx.org/stagerightlabs/actions/license"
        >
      </p>
      <p>
        <x-button.primary
          url="https://github.com/stagerightlabs/actions/"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-external-link"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/stagerightlabs/actions"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-external-link"
        >View on Packagist</x-button.secondary>
      </p>
    </x-card>
    <x-card heading="Centaur">
      <p>An opinionated implementation of the Cartalyst Sentinel Authorization framework for Laravel Applications.</p>
      <p class="inline-flex my-4 space-x-2">
        <img src="https://github.com/stagerightlabs/Centaur/workflows/CI/badge.svg" alt="Build Status">
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
      <p>A plugin for October CMS that provies support for a Matomo analytics tracking code.</p>
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
