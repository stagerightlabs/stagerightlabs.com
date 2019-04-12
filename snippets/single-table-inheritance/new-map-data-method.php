/**
 * Use the inheritance map to determine the appropriate object type for a given Eloquent object
 *
 * @param array $attributes
 * @return mixed
 */
public function mapData(array $attributes)
{
    // Determine the type of entity specified by the discriminator column
    $entityType = isset($attributes[$this->discriminatorColumn]) ? $attributes[$this->discriminatorColumn] : null;

    // Throw an exception if this entity type is not in the inheritance map
    if (!array_key_exists($entityType, $this->inheritanceMap)) {
        throw new ModelNotFoundException($this->inheritanceMap[$entityType]);
    }

    // Get the appropriate class name from the inheritance map
    $class = $this->inheritanceMap[$entityType];

    // Return a new instance of the specified class
    return new $class;
}
