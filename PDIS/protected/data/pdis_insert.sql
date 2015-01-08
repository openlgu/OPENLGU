--services

INSERT INTO `tbl_service` VALUES (
	'Site Zoning Classification',
	'Issuance of Certificate of Site Zoning Classification',
	'Monday to Friday (8:00 am - 5:00 pm)',
	'Land Owners'
);
INSERT INTO `tbl_service` VALUES (
	'Zoning/Locational Clearance',
	'Issuance of Zoning/ Locational Clearance for Business Permits',
	'Monday to Friday (8:00 am - 5:00 pm)',
	'Prospective Business Establishment Owners'
);
INSERT INTO `tbl_service` VALUES (
	'Information Extension Service',
	'Information Extension Service',
	'Monday to Friday (8:00 am - 5:00 pm)',
	'National Government Agencies/ Barangays/ Civil Society Organizations/ Students'
);
INSERT INTO `tbl_service` VALUES (
	'Preparation of Plans and Programs of Work',
	'Preparation of Plans and Programs of Work',
	'Monday to Friday (8:00 am - 5:00 pm)',
	'Barangay and other Municipal Offices'
);

--service requirements

INSERT INTO `tbl_service_requirements` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Site Zoning Classification'),
	'Letter-request addressed to the MPDC/Deputized Zoning Coordinator',
	0,
	0
);
INSERT INTO `tbl_service_requirements` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Site Zoning Classification'),
	'Lot Plan with vicinity map drawn to scale signed by a Geodetic Engineer',
	1,
	0
);
INSERT INTO `tbl_service_requirements` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Site Zoning Classification'),
	'Transfer Certificate of Title (TCT) of Deed of Sale',
	2,
	0
);
INSERT INTO `tbl_service_requirements` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Site Zoning Classification'),
	'Real Property Tax Declaration',
	3,
	0
);
INSERT INTO `tbl_service_requirements` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Site Zoning Classification'),
	'Certificate of Real Property Tax payment',
	4,
	0
);
INSERT INTO `tbl_service_requirements` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Site Zoning Classification'),
	"Special Power Attorney and land owner's authorized representative, if any",
	5,
	0
);
INSERT INTO `tbl_service_requirements` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Zoning/Locational Clearance'),
	'Business License Application/ Assesment Form',
	0,
	0
);
INSERT INTO `tbl_service_requirements` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Preparation of Plans and Programs of Work'),
	'Request letter indicating the service needed',
	0,
	0
);
INSERT INTO `tbl_service_requirements` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Information Extension Service'),
	'Request letter',
	0,
	1
);

--service fees

INSERT INTO `tbl_service_fees` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Site Zoning Classification'),
	'Certification Fee of 50.00 for less than 2,500 sq.m or P0.02 for more than 2,500 sq.m',
	0
);
INSERT INTO `tbl_service_fees` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Zoning/Locational Clearance'),
	'Zoning Clearance Fee - based on HLURB revised schedule of fees,
	HLURB Administrative Order No. 02, series of 2004, May 17',
	0
);
INSERT INTO `tbl_service_fees` VALUES (
	(SELECT service FROM `tbl_service` WHERE service='Zoning/Locational Clearance'),
	'Locational Clearance Fee - based on Municipal Ordinance No. 2009 -
	enancted December 14, 2009',
	0
);

--service forms

INSERT INTO `tbl_service_forms` VALUES (
	(SELECT service from tbl_service where service='Zoning/Locational Clearance'),
	'Business Application Form',
	'Bisuness Application Form',
	'.pdf',
	''
);