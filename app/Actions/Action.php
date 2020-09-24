<?php

namespace App\Actions;

interface Action
{
    /**
     * Execute the acton.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = []);
}
