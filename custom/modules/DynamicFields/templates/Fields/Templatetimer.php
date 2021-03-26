<?php
if (!defined('sugarEntry') || !sugarEntry) die('Not A Valid Entry Point');

require_once 'modules/DynamicFields/templates/Fields/TemplateField.php';

/**
 * Class Templatetimerfield
 *
 * The timer field will display the time counting down to, or counting up from, a given date field on the bean.
 *
 * The value for this field type is not stored in the DB, it's only displayed in the UI. The field's javascript
 * controller will populate this field and update it every second.
 *
 * To add the field to a view, you'll need to add settings like these to the view controller
 *
 *    // to count up from (i.e. to show how long it's been since the given date) you set the 'field_start_from' property:
 *    array (
 *       'name' => 'countup', // you can provide any name you like
 *       'type' => 'timer',
 *       'field_start_from' => 'date_entered',
 *       'readonly' => true,
 *       'toolip' => 'Elapsed Time',
 *       ),
 *
 *    // to count down to (i.e. to show how long until the given date comes to pass) you set the 'field_start_to' property::
 *    array (
 *       'name' => 'countdown', // you can provide any name you like
 *       'type' => 'timer',
 *       'field_start_to' => 'date_due',
 *       'readonly' => true,
 *       'toolip' => 'Time until task is overdue',
 *       ),
 *
 *
 * The output will be in the format of:
 * 10d 02h 12m 09s
 */
class Templatetimerfield extends TemplateField
{
    var $type = 'varchar';
    var $supports_unified_search = false;

    /**
     * Define the tooltip
     *
     * References:      get_field_def function below
     *
     * @returns field_type
     */
    function __construct()
    {
        $this->vardef_map['ext1'] = 'tooltip';
        $this->vardef_map['tooltip'] = 'ext1';
    }

    //BEGIN BACKWARD COMPATIBILITY
    // AS 7.x does not have EditViews and DetailViews anymore these are here
    // for any modules in backwards compatibility mode.

    function get_xtpl_edit()
    {
        $name = $this->name;
        $returnXTPL = array();

        if (!empty($this->help)) {
            $returnXTPL[strtoupper($this->name . '_help')] = translate($this->help, $this->bean->module_dir);
        }

        if (isset($this->bean->$name)) {
            $returnXTPL[$this->name] = $this->bean->$name;
        } else {
            if (empty($this->bean->id)) {
                $returnXTPL[$this->name] = $this->default_value;
            }
        }
        return $returnXTPL;
    }

    function get_xtpl_search()
    {
        if (!empty($_REQUEST[$this->name])) {
            return $_REQUEST[$this->name];
        }
    }

    function get_xtpl_detail()
    {
        $name = $this->name;
        if (isset($this->bean->$name)) {
            return $this->bean->$name;
        }
        return '';
    }

    //END BACKWARD COMPATIBILITY

    /**
     * Function:        get_field_def
     * Description:        Get the field definition attributes that are required for the Highlightfield Field
     *                      the primary reason this function is here is to set the dbType to 'varchar',
     *                      otherwise 'Highlightfield' would be used by default.
     * References:      __construct function above
     *
     * @return            Field Definition
     */
    function get_field_def()
    {
        $def = parent::get_field_def();

        // this field is not stored in the DB.
        $def['source'] = 'non-db';
        $def['dbType'] = '';

        //set our field as custom type
        $def['custom_type'] = 'varchar';

        // map the extension fields for adding a tooltip.
        $def['tooltip'] = !empty($this->tooltip) ? $this->tooltip : $this->ext1;

        return $def;
    }
}
