<?php
class BLAForm extends CFormModel
{
    public $name_of_applicant;
    public $name_of_corporation;
    public $address_of_applicant;
    public $address_of_corporation;
    public $name_of_authorized_representative;
    public $address_of_authorized_representative;
    public $project_type;
    public $project_nature;
    public $project_nature_others;
    public $project_location;
    public $project_area_lot_area;
    public $project_area_building_or_improvement_area;
    public $right_over_land;
    public $right_over_land_others;
    public $project_tenure;
    public $project_tenure_temporary;
    public $existing_land_uses_of_project_site;
    public $existing_land_uses_of_project_site_others;
    public $project_cost_or_capitalization;
    public $from_this_commission;
    public $from_this_commission_a;
    public $from_this_commission_b;
    public $from_this_commission_c;
    public $with_order;
    public $with_order_a;
    public $with_order_b;
    public $with_order_c;
    public $preferred_mode_of_release_of_decision;
	
	public $projectNature = array(
		'New Development'=>'New Development',
		'Improvement'=>'Improvement',
		'Others'=>'Others'
	);
	public $rightOverLand = array(
		'Owner'=>'Owner',
		'Lessee'=>'Lessee',
		'Others'=>'Others'
	);
	public $projectTenure = array(
		'Permanent'=>'Permanent',
		'Temporary'=>'Temporary'
	);
	public $existingLandUsesOfProjectSite = array(
		'Residential'=>'Residential',
		'Institutional'=>'Institutional',
		'Industrial'=>'Industrial',
		'Commercial'=>'Commercial',
		'Vacant Idle'=>'Vacant Idle',
		'Agricultural'=>'Agricultural',
		'Tenated'=>'Tenated',
		'Non-Tenated'=>'Non-Tenated',
		'Others'=>'Others',
	);
	public $fromThisCommission = array(
		'Yes'=>'Yes',
		'No'=>'No',
	);
	public $withOrder = array(
		'Yes'=>'Yes',
		'No'=>'No',
	);
	public $preferredModeOfReleaseOfDecision = array(
		'Pick-up by Applicant'=>'Pick-up by Applicant',
		'Pick-up by Authorized Representative'=>'Pick-up by Authorized Representative',
		'By Mail, addressed to Applicant'=>'By Mail, addressed to Applicant',
		'By Mail, addressed to Authorized Representative'=>'By Mail, addressed to Authorized Representative',
	);
 
    public function rules()
    {
        return array(
            array('
				name_of_applicant,
				name_of_corporation,
				address_of_applicant,
				address_of_corporation,
				project_type,
				project_nature,
				project_location,
				project_area_lot_area,
				project_area_building_or_improvement_area,
				right_over_land,
				project_tenure,
				existing_land_uses_of_project_site,
				project_cost_or_capitalization,
				from_this_commission,
				with_order,
				preferred_mode_of_release_of_decision
			', 'required'),
			array('project_area_lot_area, project_area_building_or_improvement_area', 'numerical', 'integerOnly'=>false)
        );
    }
	public function attributeLabels()
	{
		return array(
			'project_nature_others'=>'(Specify)',
			'project_area_lot_area'=>'Project Area',
			'project_area_building_or_improvement_area'=>'',
			'right_over_land_others'=>'(Specify)',
			'project_tenure_temporary'=>'(Specify Years)',
			'existing_land_uses_of_project_site_others'=>'(Specify)',
			'project_cost_or_capitalization'=>'Project Cost/ Capitalization',
			'from_this_commission'=>'',
			'from_this_commission_a'=>'',
			'from_this_commission_b'=>'',
			'from_this_commission_c'=>'',
			'with_order'=>'',
			'with_order_a'=>'',
			'with_order_b'=>'',
			'with_order_c'=>'',
		);
	}
}?>