<?php

namespace csip\admin\fields;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Exit if accessed directly
defined('WPINC') || die;


/**
 * Class containing fields for the Invoice post-type

 */
class Invoice
{

	/**
	 * Load all custom field metaboxes for the Invoice post-type
	 */
	public static function load()
	{
		self::fields_general();
		self::fields_items();
		self::fields_note();
	}


	/**
	 * Create general fields
	 */
	public static function fields_general()
	{
		Container::make('post_meta', __('General'))
			->where('post_type', '=', 'invoice')
			->add_fields(array(
				Field::make('text', 'inv_number', __('Invoice number'))
					->set_attribute('readOnly', true)
					->set_width(33)
					->set_classes('inv-number'),
				Field::make('select', 'inv_client', __('Client'))
					->set_options(\csip\admin\Helpers::get_clients())
					->set_width(33)
					->set_classes('inv-client'),
				Field::make('select', 'inv_status', __('Invoice Status'))
					->set_options(array(
						'' => __('-- Please Select'),
						'inv_outstanding' => 'Outstanding',
						'inv_paid' => 'Paid',
						'inv_partially_paid' => 'Partially Paid',
					))
					->set_width(33)
					->set_classes('inv-status'),
				Field::make('date', 'inv_date', __('Invoice Date'))
					->set_width(33)
					->set_classes('inv-date'),
				Field::make('text', 'inv_grace_period', __('Grace period in days'))
					->set_width(33)
					->set_attribute('data-number')
					->set_required(true)
					->set_classes('inv-grace-period'),
				Field::make('date', 'inv_due_date', __('Invoice Due Date'))
					->set_width(33)
					->set_classes('inv-due-date'),
			));
	}


	/**
	 * Create item repeater fields
	 */
	public static function fields_items()
	{
		$item_col_width = 10;
		Container::make('post_meta', __('Items list'))
			->where('post_type', '=', 'invoice')
			->add_fields(array(
				Field::make('complex', 'inv_items', __('Items'))
					->add_fields(array(
						Field::make('text', 'inv_item_title', __('Title'))
							->set_classes('inv-item-title'),
						Field::make('textarea', 'inv_item_description', __('Description'))
							->set_rows( 2 )
							->set_classes('inv-item-description'),
						Field::make('text', 'inv_item_quantity', __('Quantity'))
							// ->set_attribute( 'pattern', '[0-9]' )
							->set_attribute('min', 1)
							->set_attribute('data-item-quantity')
							->set_attribute('data-number')
							->set_width($item_col_width)
							->set_required(true)
							->set_classes('inv-item-quantity'),
						Field::make('text', 'inv_item_um', __('Unit'))
							->set_width($item_col_width)
							->set_classes('inv-item-um'),
						Field::make('text', 'inv_item_rate', __('Rate'))
							// ->set_attribute( 'pattern', '[0-9]' )
							->set_attribute('min', 1)
							->set_attribute('data-item-price')
							->set_attribute('data-number')
							->set_width($item_col_width)
							->set_required(true)
							->set_classes('inv-item-rate'),
						Field::make('text', 'inv_item_discount', __('Discount (%)'))
							// ->set_attribute( 'pattern', '[0-9]' )
							->set_attribute('min', 1)
							->set_attribute('max', 100)
							->set_default_value(0)
							->set_attribute('data-item-discount')
							->set_attribute('data-number')
							->set_width($item_col_width)
							->set_required(true)
							->set_classes('inv-item-discount'),
						Field::make('text', 'inv_item_amount', __('Amount'))
							->set_attribute('readOnly', true)
							->set_attribute('data-item-amount')
							->set_width($item_col_width)
							->set_classes('inv-item-amount'),
					))
					->set_classes('cf-invoice-items'),
			));
	}


	/**
	 * Create note fields
	 */
	public static function fields_note()
	{
		Container::make('post_meta', __('Note'))
			->where('post_type', '=', 'invoice')
			->add_fields(array(
				Field::make('textarea', 'inv_comment', __('Comment'))
					->set_classes('inv-comment'),
			));
	}
}