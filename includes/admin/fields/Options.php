<?php

namespace csip\admin\fields;

use Carbon_Fields\Container;
use Carbon_Fields\Field;

// Exit if accessed directly
defined('WPINC') || die;


/**
 * Class containing fields for the Plugin options page.
 *
 */
class Options
{

	/**
	 * Load all custom field metaboxes for Plugin Options
	 */
	public static function load()
	{
		self::fields_company();
	}


	/**
	 * Create fields for Company details
	 */
	public static function fields_company()
	{
		Container::make('theme_options', __('Invoice Plugin', 'crb'))
			->add_tab(__('Branding'), array(
				Field::make('text', 'csip_company_name', __('Company Name'))
					->set_classes('csip-company-name'),
				Field::make('text', 'csip_company_web', __('Website'))
					->set_attribute('pattern', 'https?://.+')
					->set_classes('csip-company-web'),
				Field::make('image', 'csip_company_logo', __('Logo'))
					->set_help_text('An image of your company logo for the Invoice header.')
					->set_width(50)
					->set_classes('csip-company-logo'),
				Field::make('image', 'csip_company_signature', __('Signature'))
					->set_help_text('A .png image of your signature if you want to insert it into Invoices.')
					->set_width(50)
					->set_classes('csip-company-signature'),
			))
			->add_tab(__('Address'), array(
				Field::make('text', 'csip_company_address_1', __('Address 1'))
					->set_width(50)
					->set_classes('csip-company-address-1'),
				Field::make('text', 'csip_company_address_2', __('Address 2'))
					->set_width(50)
					->set_classes('csip-company-address-2'),
				Field::make('text', 'csip_company_city', __('City'))
					->set_width(50)
					->set_classes('csip-company-city'),
				Field::make('text', 'csip_company_zip', __('Zip Code'))
					->set_width(50)
					->set_classes('csip-company-zip'),
				Field::make('select', 'csip_company_country', __('Country'))
					->set_options(\csip\admin\Helpers::get_countries())
					->set_width(50)
					->set_classes('csip-company-country'),
				Field::make('select', 'csip_company_state', __('State'))
					->set_options(array(
						'1' => 1,
						'2' => 2,
						'3' => 3,
						'4' => 4,
						'5' => 5,
					))
					->set_width(50)
					->set_classes('csip-company-state'),
			))
			->add_tab(__('Legal'), array(
				Field::make('text', 'csip_company_id', __('Company ID'))
					->set_classes('csip-company-id'),
				Field::make('select', 'csip_company_vatreg', __('VAT registered'))
					->set_options(array(
						'0' => 'No',
						'1' => 'Yes',
					))
					->set_width(50)
					->set_classes('csip-company-vatreg'),
				Field::make('text', 'csip_company_vatid', __('VAT ID'))
					->set_width(50)
					->set_conditional_logic(array(
						array(
							'field' => 'csip_company_vatreg',
							'value' => '1',
						)
					))
					->set_classes('csip-company-vatid'),
			))
			->add_tab(__('Contact'), array(
				Field::make('text', 'csip_company_email', __('Email'))
					->set_attribute('pattern', '[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$')
					->set_classes('csip-company-email'),
				Field::make('text', 'csip_company_phone', __('Phone number'))
					->set_classes('csip-company-phone'),
			))
			->add_tab(__('Bank Details'), array(
				Field::make('complex', 'inv_items', __('Items'))
					->add_fields(array(
						Field::make('text', 'csip_company_bank_name', __('Bank Name'))
							->set_classes('csip-company-bank-name'),
						Field::make('text', 'csip_company_bank_address_1', __('Address 1'))
							->set_classes('csip-company-bank-address')
							->set_width( 50 ),
							Field::make('text', 'csip_company_bank_address_2', __('Address 2'))
							->set_classes('csip-company-bank-address')
							->set_width( 50 ),
						Field::make('text', 'csip_company_bank_city', __('City'))
							->set_classes('csip-company-bank-city')
							->set_width( 50 ),
						Field::make('select', 'csip_company_bank_country', __('Country'))
							->set_options(\csip\admin\Helpers::get_countries())
							->set_classes('csip-company-bank-country')
							->set_width( 50 ),
						Field::make('separator', 'csip_separator_2', __('UK Bank'))
							->set_width(33)
							->set_classes('csip-separator-2'),
						Field::make('text', 'csip_company_uk_an', __('Account Number'))
							->set_width(33)
							->set_classes('csip-company-uk-an'),
						Field::make('text', 'csip_company_uk_sc', __('Sort Code'))
							->set_width(33)
							->set_classes('csip-company-uk-sc'),
						Field::make('separator', 'csip_separator_3', __('USA/Canada Bank'))
							->set_width(33)
							->set_classes('csip-separator-3'),
						Field::make('text', 'csip_company_us_wn', __('Wire Transfer'))
							->set_width(33)
							->set_classes('csip-company-us-wn'),
						Field::make('text', 'csip_company_us_ach', __('ACH'))
							->set_width(33)
							->set_classes('csip-company-us-ach'),
						Field::make('separator', 'csip_separator_4', __('Other'))
							->set_width(33)
							->set_classes('csip-separator-4'),
						Field::make('text', 'csip_company_iban', __('IBAN'))
							->set_width(33)
							->set_classes('csip-company-iban'),
						Field::make('text', 'csip_company_swift', __('BIC/SWIFT'))
							->set_width(33)
							->set_classes('csip-company-swift'),
					))
			))
			->add_tab(__('Invoice Options'), array(
				Field::make('text', 'csip_company_nin', __('Next Invoice Number'))
					->set_help_text('This will be the next Invoice number, change this only if you need to reset it.')
					->set_classes('csip-company-nin'),
				Field::make('textarea', 'csip_company_tnc', __('Terms & Conditions'))
					->set_classes('csip-company-tna'),
				Field::make('textarea', 'csip_company_note', __('Note'))
					->set_classes('csip-company-dis'),
				Field::make('text', 'csip_company_ftext', __('Footer Text'))
					->set_classes('csip-company-ftext'),
			));
	}
}