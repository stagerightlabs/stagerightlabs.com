@extends('layouts.app')

@section('title', 'Open Source Projects')

@section('content')
  <x-page-header>Open Source Projects</x-page-header>
  <div class="mb-8 grid grid-cols-1 md:grid-cols-2 gap-6">
    <x-card heading="Bloom">
      <p>An unofficial PHP SDK library for the <a href="https://developers.stellar.org/docs/">Stellar Horizon API</a>.</p>
      <p class="mt-1">My goal in creating this project was to see if I could reduce the number of required dependencies to the absolute minimum, and to experiment with an API that used only immutable objects.</p>
      <p class="inline-flex my-4 space-x-2">
        <img src="https://github.com/stagerightlabs/bloom/actions/workflows/tests.yml/badge.svg" alt="Tests" style="max-width: 100%;">
      </p>
      <p>
        <x-button.primary
          url="https://github.com/stagerightlabs/bloom"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/stagerightlabs/bloom"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
        >View on Packagist</x-button.secondary>
      </p>
    </x-card>
    <x-card heading="PHPXDR">
      <p>An implementation of the <a href="https://datatracker.ietf.org/doc/html/rfc4506.html">RFC 4506</a> External Data Representation standard.</p>
      <p class="mt-1">XDR is a communications format that allows independent systems to communicate with binary data instead of ascii text such as JSON.  This tool enables PHP applications to prepare and decode XDR messages.</p>
      <p class="inline-flex my-4 space-x-2">
        <img src="https://camo.githubusercontent.com/d0178110715bd7ec3314da14179e13ad3fd9ab68924a31861be858e541eb5a9a/68747470733a2f2f696d672e736869656c64732e696f2f7061636b61676973742f762f737461676572696768746c6162732f7068707864722e7376673f7374796c653d666c61742d737175617265" alt="Latest Version on Packagist" data-canonical-src="https://img.shields.io/packagist/v/stagerightlabs/phpxdr.svg?style=flat">
        <img src="https://camo.githubusercontent.com/f475ef2e12bbeeb147ab110a731f4fbcd245e1bdd178529af12120569b02bcac/68747470733a2f2f696d672e736869656c64732e696f2f7061636b61676973742f64742f737461676572696768746c6162732f7068707864722e7376673f7374796c653d666c61742d737175617265" alt="Total Downloads" data-canonical-src="https://img.shields.io/packagist/dt/stagerightlabs/phpxdr.svg?style=flat">
        <img src="https://github.com/stagerightlabs/phpxdr/actions/workflows/main.yml/badge.svg" alt="GitHub Actions">
      </p>
      <p>
        <x-button.primary
          url="https://github.com/stagerightlabs/phpxdr"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/stagerightlabs/phpxdr"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
        >View on Packagist</x-button.secondary>
      </p>
    </x-card>
    <x-card heading="Actions">
      <p>Action classes are a great strategy for encapsulating discrete units of business logic.  This package provides an opinionated foundation for implementing action classes in a PHP application.</p>
      <p class="inline-flex my-4 space-x-2">
        <img src="https://camo.githubusercontent.com/367bfdcb714539703b19aa050cf28a33f8da49b8ea19eb60f82bd98141f18250/68747470733a2f2f696d672e736869656c64732e696f2f7061636b61676973742f762f737461676572696768746c6162732f616374696f6e732e7376673f7374796c653d666c6174" alt="Latest Version on Packagist" data-canonical-src="https://img.shields.io/packagist/v/stagerightlabs/actions.svg?style=flat">
        <img src="https://camo.githubusercontent.com/f2baaf76fd5fb0b82444b89f46db77c2a1f1f6fa24ce7b097f78d608d84ff037/68747470733a2f2f696d672e736869656c64732e696f2f7061636b61676973742f64742f737461676572696768746c6162732f616374696f6e732e7376673f7374796c653d666c6174" alt="Total Downloads" data-canonical-src="https://img.shields.io/packagist/dt/stagerightlabs/actions.svg">
        <img src="https://github.com/stagerightlabs/actions/actions/workflows/ci.yml/badge.svg" alt="Tests" style="max-width: 100%;">
      </p>
      <p>
        <x-button.primary
          url="https://github.com/stagerightlabs/actions/"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/stagerightlabs/actions"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
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
          icon="heroicon-o-arrow-top-right-on-square"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/srlabs/centaur"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
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
          icon="heroicon-o-arrow-top-right-on-square"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/srlabs/eloquent-sti"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
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
          icon="heroicon-o-arrow-top-right-on-square"
        >View on GitHub</x-button.primary>
      </p>
    </x-card>
    <x-card heading="Parley">
      <p>Polymorphic messaging for Laravel Models.</p>
      <p class="inline-flex my-4 space-x-2">
        <img src="https://img.shields.io/packagist/dt/SRLabs/parley.svg" alt="Packagist Download Count">
        <img src="https://img.shields.io/packagist/v/SRLabs/parley.svg" alt="Latest Packagist Version">
        <img src="https://img.shields.io/packagist/l/SRLabs/parley.svg" alt="MIT License">
      </p>
      <p>
        <x-button.primary
          url="https://github.com/stagerightlabs/parley"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/srlabs/parley"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
        >View on Packagist</x-button.secondary>
      </p>
    </x-card>
    <x-card heading="Sentinel">
      <p>An opinionated implementation of the Cartalyst Sentry Authorization framework for Laravel Applications. Listed here for historical purposes; do not use this if you are staring a new application.</p>
      <p class="inline-flex my-4 space-x-2">
        <img src="https://img.shields.io/packagist/dt/rydurham/sentinel.svg" alt="Packagist Download Count">
        <img src="https://img.shields.io/packagist/v/rydurham/sentinel.svg" alt="Latest Packagist Version">
        <img src="https://img.shields.io/packagist/l/rydurham/sentinel.svg" alt="MIT License">
      </p>
      <p>
        <x-button.primary
          url="https://github.com/rydurham/Sentinel"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
        >View on GitHub</x-button.primary>
        <x-button.secondary
          url="https://packagist.org/packages/rydurham/sentinel"
          target="_blank"
          wrapper="my-4"
          icon="heroicon-o-arrow-top-right-on-square"
        >View on Packagist</x-button.secondary>
      </p>
    </x-card>
  </div>
@endsection
