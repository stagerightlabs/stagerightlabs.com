class Widget extends Illuminate\Database\Eloquent\Model
{
    // Eloquent Configuration
    protected $guarded = ['id'];
    protected $fillable = ['name', 'description', 'status'];

    // Single Table Inheritance Configuration
    use SingleTableInheritanceTrait;
    protected $table = 'widgets';
    protected $morphClass = 'Epiphyte\Widget';
    protected $discriminatorColumn = 'status';
    protected $inheritanceMap = [
        'new' => 'Epiphyte\Entities\Widgets\NewWidget',
        'processed' => 'Epiphyte\Entities\Widgets\ProcessedWidget'
        'complete' => 'Epiphyte\Entities\Widgets\CompleteWidget'
    ];

    // ...
}
