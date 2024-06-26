<?php
/**
 * CG Skillset module for Joomla! 4.x/5.x
 * @copyright   Copyright (C) 2024 ConseilGouz. All rights reserved.
 * @license     GNU General Public License version 3 or later; see LICENSE
 * From JD SkillSet 1.7
 */

namespace ConseilGouz\Module\CGSkillset\Field;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Form\Field\ListField;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Uri\Uri;

class CgthumbnailradioField extends ListField
{
    
    /**
     * The form field type.
     *
     * @var    string
     * @since  11.1
     */
    protected $type = 'cgthumbnailradio';
    
    /**
     * Name of the layout being used to render the field
     *
     * @var    string
     * @since  3.5
     */
    protected $layout = 'joomla.form.field.radio';
    
    /**
     * Method to get the radio button field input markup.
     *
     * @return  string  The field input markup.
     *
     * @since   11.1
     */
    protected function getInput()
    {
        
        $data    = $this->getLayoutData();
        $options = $this->getOptions();
        
        HTMLHelper;::_('script', 'system/html5fallback.js', array(
            'version' => 'auto',
            'relative' => true,
            'conditional' => 'lt IE 9'
        ));
        $format = '<input type="radio" id="%1$s" name="%2$s" value="%3$s" %4$s />';
        $alt    = preg_replace('/[^a-zA-Z0-9_\-]/', '_', $this->name);
        
        $html = '';
        $html .= '<fieldset id="' . $this->id . '" class="' . trim($this->class . ' radio') . '"' . ($this->disabled ? ' disabled' : '') . ($this->required ? ' required aria-required="true"' : '') . ($this->autofocus ? ' autofocus' : '') . '>';
        if (!empty($options)):
            foreach ($options as $i => $option):
                $checked     = ((string) $option->value === $this->value) ? 'checked="checked"' : '';
                $optionClass = !empty($option->class) ? 'class="' . $option->class . '"' : '';
                $disabled    = !empty($option->disable) || ($this->disabled && !$checked) ? 'disabled' : '';
            // Initialize some JavaScript option attributes.
                $onclick    = !empty($option->onclick) ? 'onclick="' . $option->onclick . '"' : '';
                $onchange   = !empty($option->onchange) ? 'onchange="' . $option->onchange . '"' : '';
                $oid        = $this->id . $i;
                $ovalue     = htmlspecialchars($option->value, ENT_COMPAT, 'UTF-8');
                $attributes = array_filter(array(
                    $checked,
                    $optionClass,
                    $disabled,
                    $onchange,
                    $onclick
                ));
                if ($this->required):
                    $attributes[] = 'required aria-required="true"';
                endif;
                $html .= sprintf($format, $oid, $this->name, $ovalue, implode(' ', $attributes));
				
				$label = explode('|',$option->text);
				
				
                $html .= '<label for="' . $oid . '" ' . $optionClass . '><img src="'.URI::root().$label[0].'" width="150" />'  . $label[1] . '</label>';
            endforeach;
        endif;
        $html .= '</fieldset>';
        return $html;
    }
    
    /**
     * Method to get the data to be passed to the layout for rendering.
     *
     * @return  array
     *
     * @since   3.5
     */
    protected function getLayoutData()
    {
        $data = parent::getLayoutData();
        
        $extraData = array(
            'options' => $this->getOptions(),
            'value' => (string) $this->value
        );
        
        return array_merge($data, $extraData);
    }
    
}