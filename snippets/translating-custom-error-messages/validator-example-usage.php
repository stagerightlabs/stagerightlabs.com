<?php

abstract class AbstractLaravelValidator	implements ValidableInterface
{

    // ...

    /**
     * Validation passes or fails
     *
     * @return boolean
     */
    public function passes()
    {
        $validator = $this->validator->make($this->data, $this->rules, $this->messages);

        if ($validator->fails() )
        {
            $this->errors = $validator->messages();
            return false;
        }

        return true;
    }
}
