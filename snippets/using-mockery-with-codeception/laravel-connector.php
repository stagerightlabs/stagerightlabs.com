// New class based on Codeception\Lib\Connector\Laravel4

class CustomLaravel4Connector {

    // Most everything remains the same...

    /**
     * @param Request $request
     * @return Response
     */
    protected function doRequest($request)
    {
        //$this->initialize();  -- Remove this line

        return $this->kernel->handle($request);
    }

    //  Don't change anything else

}
