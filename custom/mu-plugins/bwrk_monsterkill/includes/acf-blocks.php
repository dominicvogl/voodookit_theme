<?php

function bwrk_get_flexible_field_rows($rows)
{
    if (!is_array($rows))
        return;

    foreach ($rows as $module) {

        switch ($module["acf_fc_layout"]) {
            case 'flexField_column':
                bwrk_get_flexible_field_rows_flexFieldColumn($module);
                break;
            default:
                bwrk_get_flexible_field_rows_noRenderingDefinition($module['acf_fc_layout']);
                break;
        }
    }
}

function bwrk_get_flexible_field_rows_flexFieldColumn($module)
{
    $wrapperClasses = array();
    $rowClasses = array();

    if (!empty($module['css_class_wrapper'])) {
        $wrapperClasses[] = $module['css_class_wrapper'];
    }

    if (!empty($module['css_class_custom_wrapper'])) {
        $wrapperClasses[] = $module['css_class_custom_wrapper'];
    }

    $advancedOptions = $module['advanced_options_row'];
    $hiddenValue = $module['column_hidden'];
    $visibleValue = $module['column_visible'];

    if (is_array($advancedOptions) && in_array('col_visibility', $advancedOptions)) {

        if (!empty($hiddenValue)) {
            $hiddenClasses = implode(' ', $hiddenValue);
            $wrapperClasses[] = $hiddenClasses;
        }

        if (!empty($visibleValue)) {
            $visibleClasses = implode(' ', $visibleValue);
            $wrapperClasses[] = $visibleClasses;
        }
    }

    if (!empty($module['css_class_row'])) {
        $rowClasses[] = $module['css_class_row'];
    }

    $wrapperClasses = implode(' ', $wrapperClasses);
    $rowClasses = implode(' ', $rowClasses);

    echo '<div class="acf__module ' . $wrapperClasses . '">';
    echo '<div class="container">';
    echo '<div class="row ' . $rowClasses . '">';

    if (is_array($module['add_column'])) {

        foreach ($module['add_column'] as $column) {

            $addColumnClasses = array();
            $colTypes = array('normal', 'extraSmall', 'small', 'large');
            $advancedOptions = $column['advanced_options'];

            foreach ($colTypes as $colType) {
                if (!empty($column['add_column_' . $colType])) {

                    $tmpColumn = $column['add_column_' . $colType];

                    $addColumnClasses[] = $tmpColumn;
                }

                if (is_array($advancedOptions) && in_array('col_change', $advancedOptions)) {

                    if (!empty($column['push_pull_' . $colType])) {

                        $pushPullClasses = $column['push_pull_' . $colType] . $column['push_pull_value_' . $colType];

                        $addColumnClasses[] = $pushPullClasses;
                    }
                }
            }

            if (!empty($column['css_class_column'])) {
                $addColumnClasses[] = $column['css_class_column'];
            }

            if (is_array($advancedOptions) && in_array('col_visibility', $advancedOptions)) {

                if (!empty($column['column_hidden'])) {
                    $addColumnClasses[] = implode(' ', $column['column_hidden']);
                }

                if (!empty($column['column_visible'])) {
                    $addColumnClasses[] = implode(' ', $column['column_visible']);
                }
            }

            $addColumnClasses = implode(' ', $addColumnClasses);

            echo '<div class="' . $addColumnClasses . '">';

            foreach ($column['column_content'] as $columnContent) {
                bwrk_get_flexible_field_rows_renderContentElement($columnContent);
            }

            echo '</div>';
        }
    }

    echo '</div></div></div>';
}

function bwrk_get_flexible_field_rows_renderContentElement($contentElement)
{
    switch ($contentElement['acf_fc_layout']) {
        case 'flexField_Text':
            bwrk_get_flexible_field_rows_renderContentElementText($contentElement);
            break;
        default:
            bwrk_get_flexible_field_rows_noRenderingDefinition($contentElement['acf_fc_layout']);
            break;
    }
}

function bwrk_get_flexible_field_rows_renderContentElementText($contentElement)
{
    echo $contentElement['text'];
}

function bwrk_get_flexible_field_rows_noRenderingDefinition($type)
{
    echo '<div class="alert alert-danger">Element ' . $type . ' has no rendering Definition!</div>';
}