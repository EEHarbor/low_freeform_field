# Low Freeform Field

An [ExpressionEngine](http://expressionengine.com/) add-on that creates a custom field type to select any of the available [Freeform](http://www.solspace.com/software/detail/freeform/) fields. Includes [Low Variables](http://gotolow.com/addons/low-variables), [Matrix](http://pixelandtonic.com/matrix) and [Grid](http://ellislab.com/expressionengine/user-guide/modules/channel/grid.html) support.

## Requirements

- ExpressionEngine 1.6 with [FieldFrame 1.4.3](http://pixelandtonic.com/fieldframe) *or* ExpressionEngine 2.1+
- [Freeform 3+](http://www.solspace.com/software/detail/freeform/)

## Installation EE1

- Download and unzip
- Copy the ee1/fieldtypes/low_freeform_field folder to your system/extensions/fieldtypes directory
- Enable the field type in your field type settings
- For Low Variables support, enable the field type in the Low Variables extension settings, too

## Installation EE2

- Download and unzip
- Copy the ee2/low_freeform_field folder to your system/expressionengine/third_party directory
- Enable the field type under Add-Ons &rarr; Fieldtypes
- For Low Variables support, enable the field type in the Low Variables extension settings, too

## Example

    {exp:channel:entries channel="forms" url_title="my_form"}

      {exp:freeform:form collection="{title}" required="{form_fields search:field_required="=y" backspace="1"}{field_name}|{/form_fields}"}

        {form_fields}
          <div>
            <label for="row_{row_count}">
              {field_label}{if field_required == 'y'} <span class="required">*</span>{/if}
            </label>
            {if field_type == 'text'}
              <input type="text" class="{field_class}{if field_required == 'y'} required{/if}" name="{field_name}" id="row_{row_count}" />
            {if:elseif field_type == 'textarea'}
              <textarea name="{field_name}" id="row_{row_count}" class="{field_class}{if field_required == 'y'} required{/if}" rows="10" cols="40"></textarea>
            {/if}
          </div>
        {/form_fields}

      {/exp:freeform:form}

    {/exp:channel:entries}