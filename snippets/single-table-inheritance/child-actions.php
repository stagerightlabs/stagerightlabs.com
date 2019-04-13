class RecordNew extends Epiphyte\Record
{
    // ..

    protected $actions = [
        'client' => [
            [
                'name'    => 'edit',
                'action'  => 'ClientReportController@edit',
                'class'   => 'default'
            ],
            [
                'name'    => 'delete',
                'action'  => 'ClientReportController@delete',
                'class'   => 'danger'
            ]
        ]
    ];

    // ..
}
