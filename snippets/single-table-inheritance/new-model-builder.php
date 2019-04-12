/**
 * Create a new model instance requested by the builder.
 *
 * @param  array $attributes
 * @return \Illuminate\Database\Eloquent\Model
 */
public function newFromBuilder($attributes = array())
{
    // Create a new instance of the Entity Type Class
    $m = $this->mapData((array)$attributes)->newInstance(array(), true);

    // Hydrate the new instance with the table data
    $m->setRawAttributes((array)$attributes, true);

    // Return the assembled object
    return $m;
}
