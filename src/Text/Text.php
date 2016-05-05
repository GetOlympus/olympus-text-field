<?php

namespace GetOlympus\Field;

use GetOlympus\Hera\Field\Controller\Field;
use GetOlympus\Hera\Translate\Controller\Translate;

/**
 * Builds Text field.
 *
 * @package Field
 * @subpackage Text
 * @author Achraf Chouk <achrafchouk@gmail.com>
 * @since 0.0.1
 *
 * @see https://olympus.readme.io/v1.0/docs/text-field
 *
 */

class Text extends Field
{
    /**
     * @var string
     */
    protected $faIcon = 'fa-text-width';

    /**
     * @var string
     */
    protected $template = 'text.html.twig';

    /**
     * Prepare HTML component.
     *
     * @param array $content
     * @param array $details
     *
     * @since 0.0.1
     */
    protected function getVars($content, $details = [])
    {
        // Build defaults
        $defaults = [
            'id' => '',
            'title' => Translate::t('text.title', [], 'textfield'),
            'default' => '',
            'description' => '',
            'options' => [
                'type' => 'text',
                'min' => '',
                'max' => '',
                'step' => '',
            ],

            // options
            'attrs' => '',
            'placeholder' => '',
            'maxlength' => '',

            // details
            'post' => 0,
            'prefix' => '',
            'template' => 'pages',
        ];

        // Build defaults data
        $vars = array_merge($defaults, $content);

        // Retrieve field value
        $vars['val'] = $this->getValue($details, $vars['default'], $content['id']);

        // Attributes
        $vars['attrs'] = 'size="30"';
        $vars['attrs'] .= !empty($vars['placeholder']) ? ' placeholder="'.$vars['placeholder'].'"' : '';
        $vars['attrs'] .= !empty($vars['maxlength']) ? ' maxlength="'.$vars['maxlength'].'"' : '';

        // Check type
        $type = 'text' !== $vars['options']['type'] ? $vars['options']['type'] : 'text';

        // Check options
        if ('number' == $type || 'range' == $type) {
            $vars['type'] = $type;

            // Special variables
            $vars['attrs'] .= !empty($vars['options']['min']) 
                ? ' min="'.$vars['options']['min'].'"' 
                : '';
            $vars['attrs'] .= !empty($vars['options']['max']) 
                ? ' max="'.$vars['options']['max'].'"' 
                : '';
            $vars['attrs'] .= !empty($vars['options']['step']) 
                ? ' step="'.$vars['options']['step'].'"' 
                : ' step="1"';
        }

        // Update vars
        $this->getField()->setVars($vars);
    }
}
