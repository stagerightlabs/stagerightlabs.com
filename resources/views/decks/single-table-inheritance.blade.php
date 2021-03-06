@extends('layouts.deck')

@section('title', 'Single Table Inheritance')

@section('slides')
<section>
  <h1>Single Table Inheritance</h1>
</section>

<section>
  <img src="{{ url(asset('img/avatar.jpg')) }}" style="width: 250px" class="rounded-full" />
  <p>
    Ryan Durham
    <br />
    <a href="https://stagerightlabs.com">Stage Right Labs</a>
  </p>
  <p style="font-size: 80%;">
    <svg aria-hidden="true"  width="31" height="32" focusable="false" style="font-size:2em; vertical-align:middle" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
      <path fill="currentColor"
            d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
      </path>
    </svg>
    ryan at stagerightlabs dot com
  </p>
  <p style="font-size: 80%; margin-top:0">
    <svg aria-hidden="true" width="31" height="32" viewBox="0 0 496 512" focusable="false" style="font-size:2em; vertical-align:middle" role="img" xmlns="http://www.w3.org/2000/svg">
      <path
        d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 0.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-0.3 5.6 1.3 5.6 3.6zM134.8 392.9c0.7-2 3.6-3 6.2-2.3 3 0.9 4.9 3.2 4.3 5.2-0.6 2-3.6 3-6.2 2-3-0.6-5-2.9-4.3-4.9zM179 391.2c2.9-0.3 5.6 1 5.9 2.9 0.3 2-1.7 3.9-4.6 4.6-3 0.7-5.6-0.6-5.9-2.6-0.3-2.3 1.7-4.2 4.6-4.9zM244.8 8c138.7 0 251.2 105.3 251.2 244 0 110.9-67.8 205.8-167.8 239-12.7 2.3-17.3-5.6-17.3-12.1 0-8.2 0.3-49.9 0.3-83.6 0-23.5-7.8-38.5-17-46.4 55.9-6.3 114.8-14 114.8-110.5 0-27.4-9.8-41.2-25.8-58.9 2.6-6.5 11.1-33.2-2.6-67.9-20.9-6.6-69 27-69 27-20-5.6-41.5-8.5-62.8-8.5s-42.8 2.9-62.8 8.5c0 0-48.1-33.5-69-27-13.7 34.6-5.2 61.4-2.6 67.9-16 17.6-23.6 31.4-23.6 58.9 0 96.2 56.4 104.3 112.3 110.5-7.2 6.6-13.7 17.7-16 33.7-14.3 6.6-51 17.7-72.9-20.9-13.7-23.8-38.6-25.8-38.6-25.8-24.5-0.3-1.6 15.4-1.6 15.4 16.4 7.5 27.8 36.6 27.8 36.6 14.7 44.8 84.7 29.8 84.7 29.8 0 21 0.3 55.2 0.3 61.4 0 6.5-4.5 14.4-17.3 12.1-99.7-33.4-169.5-128.3-169.5-239.2 0-138.7 106.1-244 244.8-244zM97.2 352.9c1.3-1.3 3.6-0.6 5.2 1 1.7 1.9 2 4.2 0.7 5.2-1.3 1.3-3.6 0.6-5.2-1-1.7-1.9-2-4.2-0.7-5.2zM86.4 344.8c0.7-1 2.3-1.3 4.3-0.7 2 1 3 2.6 2.3 3.9-0.7 1.4-2.7 1.7-4.3 0.7-2-1-3-2.6-2.3-3.9zM118.8 380.4c1.3-1.6 4.3-1.3 6.5 1 2 1.9 2.6 4.9 1.3 6.2-1.3 1.6-4.2 1.3-6.5-1-2.3-1.9-2.9-4.9-1.3-6.2zM107.4 365.7c1.6-1.3 4.2-0.3 5.6 2 1.6 2.3 1.6 4.9 0 6.2-1.3 1-4 0-5.6-2.3-1.6-2.3-1.6-4.9 0-5.9z">
      </path>
    </svg>
    <a href="https://github.com/stagerightlabs">stagerightlabs</a>
  </p>
</section>

<section>
  <h1>What is Single Table Inheritance?</h1>
</section>

<section>
  <h2><strong>Single Table Inheritance</strong></h2>
  <p>
    <em>"Represents an inheritance hierarchy of classes as a <br />
    single table that has columns for all the fields <br />
    of the various classes."</em><br />
    - <a href="" target="_blank">Martin Fowler, Patterns of <br />
    Enterprise Application Architecture</a>
  </p>
</section>

<section>
  <h2><b>In Practice:</b></h2>
  <ul>
    <li>Using one database table to store multiple object types.</li>
    <li class="fragment">With <b>Data Mapper:</b> Not much of a mental leap.</li>
    <li class="fragment">With <b>Active Record:</b> A very radical and unusual idea.</li>
  </ul>
</section>

<section>
  <h1>What benefits can Single Table Inheritance provide?</h1>
  <p class="fragment">Let's look at an example.</p>
</section>

<section>
  <h2><b>Example Scenario</b></h2>
  <p>Imagine we are tracking medical records.</p>
  <ul>
    <li class="fragment">Customers create orders</li>
    <li class="fragment">Record retrieval request is sent</li>
    <li class="fragment">Nurses review records and create summaries</li>
    <li class="fragment">Reports are released to the client</li>
    <li class="fragment">Client credit card is billed</li>
  </ul>
  <p class="fragment"><br />The status of the record request dictates the type of actions that can be taken against it.</p>
</section>

<section>
  <pre><code class="php" data-trim>
&lt;?php foreach($records as $record) ?&gt;
&lt;tr&gt;
&lt;td&gt;&lt;?php echo $record-&gt;referenceNum; ?&gt;&lt;/td&gt;
&lt;td&gt;
&lt;?php if ($record-&gt;status == 'new') ?&gt;
  &lt;a href=&quot;...&quot;&gt;Cancel&lt;/a&gt;
  &lt;a href=&quot;...&quot;&gt;Assign to Nurse&lt;/a&gt;
&lt;?php endif; ?&gt;
&lt;?php if ($record-&gt;status == 'acquired') ?&gt;
  &lt;a href=&quot;...&quot;&gt;Prepare Summary&lt;/a&gt;
  &lt;a href=&quot;...&quot;&gt;View PDFs&lt;/a&gt;
&lt;?php endif; ?&gt;
&lt;?php if ($record-&gt;status == 'summarized') ?&gt;
  &lt;a href=&quot;...&quot;&gt;Review Summary&lt;/a&gt;
  &lt;a href=&quot;...&quot;&gt;Approve&lt;/a&gt;
  &lt;a href=&quot;...&quot;&gt;Reject&lt;/a&gt;
&lt;?php endif; ?&gt;
&lt;?php if ($record-&gt;status == 'approved') ?&gt;
  &lt;a href=&quot;...&quot;&gt;View&lt;/a&gt;
  &lt;a href=&quot;...&quot;&gt;Process Payment&lt;/a&gt;
&lt;?php endif; ?&gt
&lt;/td&gt;
&lt;/tr&gt;
&lt;?php endforeach; ?&gt;
  </code></pre>
</section>

<section>
    <p>This works, but the view code is very cluttered, and we are not even accounting for user access control.</p>
    <p>Is there a better way?</p>
    <p class="fragment">Single Table Inheritance is an excellent alternative.</p>
</section>

<section>
    <p>By implementing STI we can ask our entity objects to define their own allowable actions.</p>
</section>

<section>
  <h2><strong>For instance:</strong></h2>
  <pre><code class="php" data-trim>
public function getActions($userLevel)
{
return $this->actions[$userLevel];
}

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
],
]
// Additional User level entries ...
];
  </code></pre>
</section>

<section>
  <h2><strong>Updated Example</strong></h2>
  <pre><code class="php" data-trim>
&lt;?php foreach($records as $record) ?&gt;
&lt;tr&gt;
&lt;td&gt;
&lt;?php echo $record-&gt;referenceNum; ?&gt;
&lt;/td&gt;
&lt;td&gt;
&lt;?php echo $record-&gt;getActions('client'); ?&gt;
&lt;/td&gt;
&lt;/tr&gt;
&lt;?php endforeach; ?&gt;
  </code></pre>
</section>

<section>
  <h2><strong>Definitions:</strong></h2>
  <p class="fragment left"><b>Discriminator Column</b>: The table column used to determine the entity type.</p>
  <p class="fragment left"><b>Inheritance Map</b>: A way to associate discrimination values with php classes.</p>
</section>

<section>
  <h2><strong>Using STI with Eloquent</strong></h2>
</section>

<section>
  <h2><strong>Eloquent Model with STI</strong></h2>
  <pre><code class="php" data-trim>
// app/Epiphyte/Record.php
class Record extends Illuminate\Database\Eloquent\Model {

// Eloquent Configuration
protected $guarded = ['id'];
protected $fillable = ['name', 'description', 'status'];

// Single Table Inheritance Configuration
use SingleTableInheritanceTrait;
protected $table = 'records';
protected $morphClass = 'Epiphyte\Record';
protected $discriminatorColumn = 'status';
protected $inheritanceMap = [
  'new' => 'Epiphyte\Entities\Records\RecordNew',
  'requested' => 'Epiphyte\Entities\Records\RecordRequested',
  'retrieved' => 'Epiphyte\Entities\Records\RecordRetrieved',
  'complete' => 'Epiphyte\Entities\Records\RecordComplete'
];

// ...
}
  </code></pre>
</section>

<section>
  <h2><strong>Child Entity Class</strong></h2>
  <pre><code class="php" data-trim>
// app/Epiphyte/Entities/Records/RecordNew.php
class RecordNew extends Epiphyte\Record {

/**
* Limit the query scope if we define a query against
* the base table using this class.
*/
public function newQuery($excludeDeleted = true)
{
  return parent::newQuery($excludeDeleted)
  ->where('status', '=', 'new');
}

// Remaining child entity methods go here...

}
    </code></pre>
</section>

<section>
  <h2><strong>STI in Eloquent - Data Mapping</strong></h2>
  <pre><code class="php" data-trim>
// Illuminate\Database\Eloquent\Model
public function mapData(array $attributes)
{
// Determine the entity type
$entityType = isset($attributes[$this->discriminatorColumn]) ?
$attributes[$this->discriminatorColumn] : null;

// Throw an exception if this entity type
// is not in the inheritance map
if (!array_key_exists($entityType, $this->inheritanceMap)) {
  throw new ModelNotFoundException();
}

// Get the appropriate class name from
// the inheritance map
$class = $this->inheritanceMap[$entityType];

// Return a new instance of the specified class
return new $class;
}
  </code></pre>
</section>

<section>
  <h2><strong>STI in Eloquent - Query Builder</strong></h2>
  <pre><code class="php">
// Illuminate\Database\Eloquent\Model
public function newFromBuilder($attributes = array())
{
// Create a new instance of the Entity Type Class
$m = $this->mapData((array)$attributes)
              ->newInstance(array(), true);

// Hydrate the new instance with the table data
$m->setRawAttributes((array)$attributes, true);

// Return the assembled object
return $m;
}
    </code></pre>
</section>

<section>
  <h2><strong>What have we gained?</strong></h2>
  <ul class="left">
    <li class="fragment">Eloquent will now automatically resolve entity types based on the discrimination value.</li>
    <li class="fragment">Collections will now contain a mix of entity types, dictated by the discrimination value.</li>
    <li class="fragment">Facade convenience, if you are in to that sort of thing: <code>RecordNew::all();</code></li>
  </ul>
</section>

<section>
  <h2><strong>Using STI with Doctrine</strong></h2>
</section>

<section>
  <p>The Data Mapper pattern lends itself more easily to Single Table Inheritance</p>
</section>

<section>
  <h2><strong>Doctrine Example</strong></h2>
  <pre><code class="php" data-trim>
/**
* @Entity
* @InheritanceType("SINGLE_TABLE")
* @DiscriminatorColumn(name="discr", type="string")
* @DiscriminatorMap({"person" = "Person", "employee" = "Employee"})
*/
class Person
{
// ...
}

/**
* @Entity
*/
class Employee extends Person
{
// ...
}
  </code></pre>
</section>

<section>
  <h2><strong>Some important considerations</strong></h2>
</section>

<section>
  <p>STI is ideal for situations where the child entities all make use of the same table column structure.</p>
</section>

<section>
  <p><strong>Good:</strong></p>
  <p>Inheriting <code>Ford</code>, <code>Toyota</code> and <code>Mercedes</code> types from an <code>automobiles</code> table.</p>
</section>

<section>
  <p><strong>Bad:</strong></p>
  <p>Inheriting <code>Car</code>, <code>Motorcyle</code> and <code>Airplane</code> types from a <code>vehicles</code> table.</p>
</section>

<section>
  <p>Adding table columns that will only be used by specific child entities is a warning sign.</p>
  <p>STI may not be a good choice in that case.</p>
</section>

<section>
  <p>Questions?</p>
</section>

<section>
  <h2><strong>Additional Resources</strong></h2>
  <ul class="left">
    <li><a href="https://github.com/SRLabs/eloquent-sti" target="_blank">Eloquent STI</a> Laravel Package</li>
    <li><a href="http://stagerightlabs.com/blog/single-table-inheritance" target="_blank">Blog post expanding on these slides</a> at stagerightlabs.com</li>
    <li><a href="http://snooptank.com/single-table-inheritance-with-eloquent-laravel-4/" target="_blank">Single Table Inheritance with Eloquent</a><br /> by Pallav Kaushish</li>
    <li><a href="http://blog.tatedavies.com/2011/09/13/setting-up-class-table-inheritance-with-doctrine-2-0" target="_blank">Setting up Class Table Inheritance with Doctrine</a> <br />by Chris Tate-Davies</li>
  </ul>
</section>

<section>
  <h2>Thank you!</h2>
  <p style="font-size: 80%;">
    <svg
      aria-hidden="true"
      width="31"
      height="32"
      focusable="false"
      style="font-size:2em; vertical-align:middle"
      role="img"
      xmlns="http://www.w3.org/2000/svg"
      viewBox="0 0 512 512"
    >
      <path fill="currentColor"
            d="M502.3 190.8c3.9-3.1 9.7-.2 9.7 4.7V400c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V195.6c0-5 5.7-7.8 9.7-4.7 22.4 17.4 52.1 39.5 154.1 113.6 21.1 15.4 56.7 47.8 92.2 47.6 35.7.3 72-32.8 92.3-47.6 102-74.1 131.6-96.3 154-113.7zM256 320c23.2.4 56.6-29.2 73.4-41.4 132.7-96.3 142.8-104.7 173.4-128.7 5.8-4.5 9.2-11.5 9.2-18.9v-19c0-26.5-21.5-48-48-48H48C21.5 64 0 85.5 0 112v19c0 7.4 3.4 14.3 9.2 18.9 30.6 23.9 40.7 32.4 173.4 128.7 16.8 12.2 50.2 41.8 73.4 41.4z">
      </path>
    </svg>
    ryan at stagerightlabs dot com
  </p>
  <p style="font-size: 80%; margin-top:0">
    <svg
      aria-hidden="true"
      width="31"
      height="32"
      viewBox="0 0 496 512"
      focusable="false"
      style="font-size:2em; vertical-align:middle"
      role="img" xmlns="http://www.w3.org/2000/svg"
    >
      <path fill="currentColor"
            d="M165.9 397.4c0 2-2.3 3.6-5.2 3.6-3.3 0.3-5.6-1.3-5.6-3.6 0-2 2.3-3.6 5.2-3.6 3-0.3 5.6 1.3 5.6 3.6zM134.8 392.9c0.7-2 3.6-3 6.2-2.3 3 0.9 4.9 3.2 4.3 5.2-0.6 2-3.6 3-6.2 2-3-0.6-5-2.9-4.3-4.9zM179 391.2c2.9-0.3 5.6 1 5.9 2.9 0.3 2-1.7 3.9-4.6 4.6-3 0.7-5.6-0.6-5.9-2.6-0.3-2.3 1.7-4.2 4.6-4.9zM244.8 8c138.7 0 251.2 105.3 251.2 244 0 110.9-67.8 205.8-167.8 239-12.7 2.3-17.3-5.6-17.3-12.1 0-8.2 0.3-49.9 0.3-83.6 0-23.5-7.8-38.5-17-46.4 55.9-6.3 114.8-14 114.8-110.5 0-27.4-9.8-41.2-25.8-58.9 2.6-6.5 11.1-33.2-2.6-67.9-20.9-6.6-69 27-69 27-20-5.6-41.5-8.5-62.8-8.5s-42.8 2.9-62.8 8.5c0 0-48.1-33.5-69-27-13.7 34.6-5.2 61.4-2.6 67.9-16 17.6-23.6 31.4-23.6 58.9 0 96.2 56.4 104.3 112.3 110.5-7.2 6.6-13.7 17.7-16 33.7-14.3 6.6-51 17.7-72.9-20.9-13.7-23.8-38.6-25.8-38.6-25.8-24.5-0.3-1.6 15.4-1.6 15.4 16.4 7.5 27.8 36.6 27.8 36.6 14.7 44.8 84.7 29.8 84.7 29.8 0 21 0.3 55.2 0.3 61.4 0 6.5-4.5 14.4-17.3 12.1-99.7-33.4-169.5-128.3-169.5-239.2 0-138.7 106.1-244 244.8-244zM97.2 352.9c1.3-1.3 3.6-0.6 5.2 1 1.7 1.9 2 4.2 0.7 5.2-1.3 1.3-3.6 0.6-5.2-1-1.7-1.9-2-4.2-0.7-5.2zM86.4 344.8c0.7-1 2.3-1.3 4.3-0.7 2 1 3 2.6 2.3 3.9-0.7 1.4-2.7 1.7-4.3 0.7-2-1-3-2.6-2.3-3.9zM118.8 380.4c1.3-1.6 4.3-1.3 6.5 1 2 1.9 2.6 4.9 1.3 6.2-1.3 1.6-4.2 1.3-6.5-1-2.3-1.9-2.9-4.9-1.3-6.2zM107.4 365.7c1.6-1.3 4.2-0.3 5.6 2 1.6 2.3 1.6 4.9 0 6.2-1.3 1-4 0-5.6-2.3-1.6-2.3-1.6-4.9 0-5.9z">
      </path>
    </svg>
    <a href="https://github.com/stagerightlabs">stagerightlabs</a>
  </p>
  <img src="../logo.png" alt="Stage Right Labs Logo" style="width: 200px" />
</section>
@endsection
