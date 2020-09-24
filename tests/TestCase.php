<?php

namespace Tests;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Mix;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Testing\TestResponse;
use Livewire\Testing\TestableLivewire;
use PHPUnit\Framework\Assert;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp(): void
    {
        parent::setUp();

        // Swap out the Mix manifest implementation, so we don't need
        // to run the npm commands to generate a manifest file for
        // the assets in order to run tests that return views.
        $this->swap(Mix::class, function () {
            return '';
        });

        $this->registerCollectionAssertions();
        $this->registerLivewireAssertions();
    }

    /**
     * Register assertion macros on the collection class.
     *
     * @see \Illuminate\Database\Eloquent\Collection
     * @return void
     */
    protected function registerCollectionAssertions()
    {
        Collection::macro('assertContains', function ($value) {
            Assert::assertTrue(
                $this->contains($value),
                'Failed asserting that the collection contained the specified value.'
            );
        });

        Collection::macro('assertMissing', function ($value) {
            Assert::assertFalse(
                $this->contains($value),
                'Failed asserting that the collection does not contain the specified value.'
            );
        });

        Collection::macro('assertEquals', function ($items) {
            Assert::assertEquals(count($this), count($items));
            $this->zip($items)->each(function ($pair) {
                [$a, $b] = $pair;
                Assert::assertTrue($a->is($b));
            });
        });
    }

    /**
     * Register session assertion macros on the TestResponse class.
     *
     * @see \Illuminate\Testing\TestResponse
     * @return void
     */
    public function assertSessionHasAlert($key = null)
    {
        if (is_null($key)) {
            Assert::assertTrue(
                session()->has('alerts'),
                'Session is missing expected key [alerts].'
            );
        } else {
            $values = array_reduce(
                session()->get('alerts', []),
                function ($carry, $item) {
                    if (is_array($item) && isset($item['type'])) {
                        $carry[] = $item['type'];

                        return $carry;
                    }

                    return $carry;
                },
                []
            );

            Assert::assertContains(
                $key,
                $values,
                "Session is missing expected key [alerts.{$key}]"
            );
        }
    }

    /**
     * Register assertion methods on the TestableLivewire class.
     *
     * @see TestableLivewire
     * @return void
     */
    public function registerLivewireAssertions()
    {
        TestableLivewire::macro('assertHasAlertMessage', function ($key = null) {
            if (is_null($key)) {
                Assert::assertNotEmpty(
                    $this->messages,
                    'Expected to see alert messages but none are present.'
                );
            } else {
                $values = array_reduce(
                    $this->messages,
                    function ($carry, $item) {
                        if (is_array($item) && isset($item['type'])) {
                            $carry[] = $item['type'];

                            return $carry;
                        }

                        return $carry;
                    },
                    []
                );

                Assert::assertContains(
                    $key,
                    $values,
                    "Missing expected message type {$key}]"
                );
            }
        });
    }
}
