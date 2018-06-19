---
title: Single Table Inheritance
date: 13:30 1/25/2015
layout: BlogPost
categories:
    - Laravel
    - Eloquent
    - PHP
highlight:
    theme: tomorrow
---

Single Table Inheritance is the practice of using one database table to track multiple types of resources. When designing web applications, more often than not you will use one database table for each type of resource you are managing: One table for users, one table for posts, one for widgets, etcetera. This isn't strictly true but it is a good rule of thumb, especially if you are using an Active Record ORM such as Eloquent. Single Table Inheritance turns this idea on its head - and while it does have certain advantages, it is not a common practice.

<!-- more -->

A few years ago I was working for a startup in the healthcare industry - their idea was to provide an easy way for customers to receive updated about their loved ones in extended care through summaries prepared in laymen's english by trained nurses. Clients would place an order and the company would acquire copies of the medical records in question and have staff nurses write summaries that would then be delivered to the client through the website.

The meat of the application was tracking record requests as they progressed through the various stages of preparation - aquisition from the hospitals, summarized by nurses, reviewed by supervisors and then finally released to clients for consumption. As you can imagine, each phase of a record request required different actions be available to the record object. Not only that, but the types of actions available on a record also depended on the role of the user - admins had to do certain things with records, nurses certain other things, and of course the customer also had a different set of actions they could take against a records. Knowing what stage a particular record request was in became very important, as you can imagine.

Initially we decided to tackle this by using a 'status' column on the record table. "New" for new records, "acquired" for records that had been delivered from medical institutions, 'summarized' for records that had been addressed by the staff nurses and 'approved' for records that had been approved for delivery to the customer. (It was a bit more complicated than that, but you get the idea.) This worked well for the most part, however anytime we needed to present options for actions that could be taken agains the record we wound up with a lot of code like this:

```php
<?php foreach($records as $record) ?>
    <tr>
        <td><?php echo $record->referenceId; ?></td>
        <td>
            <?php if ($record->status == 'new') ?>
                <a href="...">Cancel</a>
                <a href="...">Assign to Nurse</a>
            <?php endif; ?>
            <?php if ($record->status == 'acquired') ?>
                <a href="...">Prepare Summary</a>
                <a href="...">View PDFs</a>
            <?php endif; ?>
            <?php if ($record->status == 'summarized') ?>
                <a href="...">Review Summary</a>
                <a href="...">Approve</a>
                <a href="...">Reject</a>
            <?php endif; ?>
            <?php if ($record->status == 'approved') ?>
                <a href="...">View</a>
                <a href="...">Process Payment</a>
            <?php endif; ?>
        </td>
    </tr>
<?php endforeach; ?>
```

This is a simplification, but the basic idea remains the same: A lot of time and energy is being spent checking the status of the record, and this doesn't even account for user access control. More often than not we had situations where we were doing things like `if ($record->status == 'acquired' && $currentUser->inGroup('nurses'))` - it worked, but not that well and it was a bit of a mess. As it happens, this is a perfect scenario for the use of STI. What if, instead of checking for each possible type of action on a given record, we could instead ask the record itself what actions are available to it?

### The Basics

To implement STI, one column on the table is designated as the "discriminator" column. This column will be used to determine what type of entity should be returned for each row on the table. In our example, the 'status' column is the discriminator column. Properly configured, your ORM should return the appropriate type of object based on the value of that column. We can then set up child classes that have different methods available to them depending on what actions we want to make available to that type of object.

STI is ideal for situations where you are storing objects that are of very similar types - ideally sharing the need for all the other columns in that table. If you are working with STI and finding that you are adding columns just for the sake of certain types of entities, that is a red flag - there is probably a better way to organize your data. In our case, we are looking to return different types of record objects. Imagine however, that you have a table called "vehicles" and you are storing bicycles, cars and airplanes within it. It is likely that you would want a column that stored the maximum lifting weight allowed for each airplane, or the number of crew members needed to operate it - those columns would be of no use to the Bicyle objects. That is a situation where STI probably won't be very helpful.

### Single Table Inheritance in Eloquent

Eloquent is an implementation of the Active Record pattern, which places heavy emphasis on using one table for each type of resource you are working with. There is no support for STI out of the box, however we can implement it on our own by overwritting a few key methods in the `Illuminate\Database\Eloquent\Model` class.

One of the most important methods in an Eloquent Model object is the `newFromBuilder` function. This method is responsible for instantiating the object in question and using the data from the database to populate the object's member data. This function us called any time you make an eloquent call that returns either a single object or a collection of objects. Modifying this function will be our first step - here is our new version:

```php
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
```

Instead of creating a new intance of the model object (via `$instance = $this->newInstance(array(), true);`) we are instead passing the attributes through to a new function called `mapData` which is responsible for resolving the STI entity type and instantiating it, as such:

```php
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
```

Lets step through this function line by line: First we check to make sure that a `$this->discriminatorColumn` value exists. If it does, we find the value of that column in the attributes array containing the row data from the database. This is our `$entityType`.

We are using an `$inheritanceMap` as an array that maps discriminator values to entity classes. We now need to make sure that the entity class defined by the discriminator column actually exists - if it doesn't then we throw an exception.

After that, we grab the class name for this `$entityType` from the `$inheritanceMap` array and return an new instance of that class back to the `newFromBuilder` function, which then populates the entity with the data from the database.

We now need to configure our Eloquent Model object appropriately:

```php
// app/Epiphyte/Widget.php
class Widget extends Illuminate\Database\Eloquent\Model {

    /*****************************************************************************
     *  Eloquent Configuration
     *****************************************************************************/

    protected $guarded = ['id'];
    protected $fillable = ['name', 'description', 'status'];

    /*****************************************************************************
     * Single Table Inheritance Configuration
     *****************************************************************************/

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
```

This is where we select the discrimination column and set up the inheritance map. Our intention is to have the child entity classes inherit from this Eloquent model. If we don't explictly set the `$table` and `$morphClass` here, the relationships we establish on the base model will not work properly with the child entities.

There are some additional modifications that need to be made to allow Eloquent to play nicely with the new object types - if you want more information about those techniques I recommend you read [this article](http://snooptank.com/single-table-inheritance-with-eloquent-laravel-4/) by Pallav Kaushish - he does a great job of explaining the mechanics of the additional changes needed.

If you want to jump in the deep-end and get started with STI in Eloquent right away, I have a package that provides a trait with everything you need. Add the trait to your Eloquent Model objects, along with the additional configuration settings, and you are good to go. More information about that package [can be found here](http://stagerightlabs.com/projects/eloquent-sti).

### Single Table Inheritance in Doctrine

Those of you are used to working with Data Mappers, such as Doctrine, will find that Single Table Inheritance is not much of a mental leap from what you are used to. The [Doctrine documentation for Table Inheritance](http://doctrine-orm.readthedocs.org/en/latest/reference/inheritance-mapping.html) has a lot of great information - it is very easy to get up and running with STI in very little time. It can be as simple as doing something like this, which I have taken directly from the docs:

```php
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
```

### Getting back to our example

We can now create different classes that represent each possible status type for our medical record requests. Now, instead of checking different status levels within our views do display action links, we can instead ask our entity objects to tell us what actions are available to them. Imagine we were to add something like this to our base model:

```php
public function getActions($userLevel)
{
    return $this->actions[$userLevel];
}
```

and then in our child entities we were to add member arrays that specify the allowable actions for an object with that status?

```php
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
```

We can set up some convenience functions behind the scenes that convert the action array entries into html button links, and then in our views we can convert our old messy code to something like this:

```php
<?php foreach($records as $record) ?>
<tr>
    <td>
        <?php echo $record->referenceNum; ?>
    </td>
    <td>
        <?php echo $record->getActions('client'); ?>
    </td>
</tr>
<?php endforeach; ?>
```

Much more simple, don't you think?

### Additional Resources

- [Single Table Inheritance with Eloquent (Laravel 4)](http://snooptank.com/single-table-inheritance-with-eloquent-laravel-4/) by Pallav Kaushish - this article was a huge inspiration for me, and a lot of the code I mention here comes from him.
- [Single Table Inheritance In Laravel 4](http://www.colorfultyping.com/single-table-inheritance-in-laravel-4/) by Mark Smith
- [Eloquent Single Table Inheritance](http://laravel.io/forum/02-17-2014-eloquent-single-table-inheritance) by Shawn McCool
- [Setting up Class Table Inheritance with Doctrine 2.0](http://blog.tatedavies.com/2011/09/13/setting-up-class-table-inheritance-with-doctrine-2-0/) by Chris Tate-Davies
