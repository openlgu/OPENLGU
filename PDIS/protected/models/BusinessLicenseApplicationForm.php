<?php
class BusinessLicenseApplicationForm extends CFormModel
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
			array('
				name_of_authorized_representative,
				address_of_authorized_representative,
				project_nature_others,
				right_over_land_others,
				existing_land_uses_of_project_site_others,
				from_this_commission_a,
				from_this_commission_b,
				from_this_commission_c,
				with_order_a,
				with_order_b,
				with_order_c,
			', 'safe'),
			array('project_area_lot_area, project_area_building_or_improvement_area, project_tenure_temporary', 'numerical', 'integerOnly'=>false)
        );
    }
	public function attributeLabels()
	{
		return array(
		    'name_of_applicant'=>'Name of Applicant',
		    'name_of_corporation'=>'Name of Corporation',
		    'address_of_applicant'=>'Address of Applicant',
		    'address_of_corporation'=>'Address of Corporation',
		    'name_of_authorized_representative'=>'Name of Authorized Representative',
		    'address_of_authorized_representative'=>'Address of Authorized Representative',
			'project_type'=>'Project Type',
			'project_nature'=>'Project Nature',
			'project_nature_others'=>'(Specify)',
			'project_location'=>'Project Location',
			'project_area_lot_area'=>'Project Area (in square meters) Lot Area',
			'project_area_building_or_improvement_area'=>'Project Area (in square meters) Building/ Improvement Area',
			'right_over_land'=>'Right Over Land',
			'right_over_land_others'=>'(Specify)',
			'project_tenure'=>'Project Tenure',
			'project_tenure_temporary'=>'(Specify Years)',
			'existing_land_uses_of_project_site'=>'Existing Land Uses of Project Site',
			'existing_land_uses_of_project_site_others'=>'(Specify)',
			'project_cost_or_capitalization'=>'Project Cost/ Capitalization',
			'from_this_commission'=>'Is the subject applied for, the subject of written
		notice(s) from this Commission and/or Deputized Zoning
		Administrator to the effect of requiring for presentation
		of Locational Clearance/ Certificate of Zoning Compliance
		(LC/CZC) or to apply for LC/CZC?',
			'from_this_commission_a'=>'a)Name of HLURB Office or Zoning Administrator who issued the notice',
			'from_this_commission_b'=>'b)Date(s) filed',
			'from_this_commission_c'=>'c)Order/ request indicated in the Notice(s)',
			'with_order'=>'Is the project applied for the subject of aimilar application(s) with order
		from Offices of the Commission and/or Deputized Zoning Administrator?',
			'with_order_a'=>'a)Other HLURB Office(s) where similar application(s) was/were filed',
			'with_order_b'=>'b)Date(s) filed',
			'with_order_c'=>'c)Action(s) taken by office(s) mentioned in (a)',
			'preferred_mode_of_release_of_decision'=>'Preferred Mode Of Release of Decision'
		);
	}
}?>