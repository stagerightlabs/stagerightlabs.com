use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

//...

public function report(Exception $exception)
{
    if ($exception instanceof NotFoundHttpException && $request = request()) {
        Bugsnag::notifyError('404', 'Page Not Found', function ($report) use ($request) {
            $report->setSeverity('info');
            $report->setMetaData([
                'url' => $request->url()
            ]);
        });
    }

    parent::report($exception);
}
