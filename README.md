# The Timer Field

###A "Timer" field counts "down to" or "up from" a provided date field.

The timer will show the days, hours, minute and seconds since, or until, a given date field. 

After installing this package, you'll see need to add one or more timer fields to a given view. 

To add the field to a view, you'll need to add settings like these to a view controller:

###To count up from (i.e. to show how long it's been since) the record was created, you set the 'field_start_from' property:
```
    array (
       'name' => 'countup', // you can provide any name you like
       'type' => 'timer',
       'field_start_from' => 'date_entered',
       'readonly' => true,
       'toolip' => 'Elapsed Time',
       ),
```
###To count down to (i.e. to show how long until) the due date, you set the 'field_start_to' property:
```

    array (
       'name' => 'countdown', // you can provide any name you like
       'type' => 'timer',
       'field_start_to' => 'date_due',
       'readonly' => true,
       'toolip' => 'Time until task is overdue',
       ),
```

Don't set both. If you do, 'start_field_from' will be used and you may see unexpected results.

The timer field will display the days, hours, minutes and seconds for the delta between now and the provided date field in this format:

**1d 02h 12m 09s**

The timer.js controller file will update this field's value every second.

We deliberately don't provide a list view template for this field because 20 or so timers on the same page is noisy and could impact UI performance.

