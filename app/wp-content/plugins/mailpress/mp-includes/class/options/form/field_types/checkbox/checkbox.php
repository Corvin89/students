<?php
class MP_Form_field_type_checkbox extends MP_form_field_type_
{
	var $id	= 'checkbox';
	var $order	= 40;
	var $file	= __FILE__;

	function submitted($field)
	{
		if (!isset($_POST[$this->prefix][$field->form_id][$field->id]))
		{
			$field->submitted['value'] = false;
			$field->submitted['text']  = __('not checked', MP_TXTDOM);
			return $field;
		}
		return parent::submitted($field);
	}

	function attributes_filter($no_reset)
	{
		if (!$no_reset) return;

		unset($this->field->settings['attributes']['checked']);
		if (isset($_POST[$this->prefix][$this->field->form_id][$this->field->id])) $this->field->settings['attributes']['checked'] = 'checked';

		$this->attributes_filter_css();
	}
}
new MP_Form_field_type_checkbox(__('Checkbox', MP_TXTDOM));