<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Account ID
    |--------------------------------------------------------------------------
    */
    'cid' => ENV('EXPEDIA_CID'),

    /*
    |--------------------------------------------------------------------------
    | Access key to the API
    |--------------------------------------------------------------------------
    | Your EAN-issued access key to the API. Determines your access to live bookings,
    | your authentication method (IP or signature-based) and request quotas.
    |
    */
    'api_key' => ENV('EXPEDIA_API_KEY'),

    /*
    |--------------------------------------------------------------------------
    | Shared secret
    |--------------------------------------------------------------------------
    */
    'secret' => ENV('EXPEDIA_SECRET'),

    /*
    |--------------------------------------------------------------------------
    | Minor revision
    |--------------------------------------------------------------------------
    | Sets the minor revision used for processing requests and returning responses.
    |
    */
    'minor_rev' => ENV('EXPEDIA_MINOR_REV', 30),

    /*
    |--------------------------------------------------------------------------
    | Currency code
    |--------------------------------------------------------------------------
    | Returns data in other currencies where available.
    |
    */
    'currency_code' => ENV('EXPEDIA_CURRENCY_CODE', 'USD'),

    /*
    |--------------------------------------------------------------------------
    | Locale
    |--------------------------------------------------------------------------
    | Identifies your customer’s country and the nationality of the Point of Sale used for booking.
    |
    */
    'locale' => ENV('EXPEDIA_LOCALE', 'en_US'),

    /*
    |--------------------------------------------------------------------------
    | Log handler for import data.
    |--------------------------------------------------------------------------
    */
    'log_handler' => \Galiasay\Expedia\Logs\StreamHandler::class,

    /*
    |--------------------------------------------------------------------------
    | Expedia table prefix
    |--------------------------------------------------------------------------
    */
    'table_prefix' => 'expedia_',

    /*
    |--------------------------------------------------------------------------
    | Remote url to Expedia files
    |--------------------------------------------------------------------------
    */
    'remote_url_files' => 'http://www.ian.com/affiliatecenter/include/V2',

    /*
    |--------------------------------------------------------------------------
    | List files for import
    |--------------------------------------------------------------------------
    */
    'files' => [
        'ActivePropertyList',
        'AirportCoordinatesList',
        'AliasRegionList',
        'AreaAttractionsList',
        'AttributeList',
        'ChainList',
        'CityCoordinatesList',
        'CountryList',
        'DiningDescriptionList',
        'HotelImageList',
        'NeighborhoodCoordinatesList',
        'ParentRegionList',
        'PointsOfInterestCoordinatesList',
        'PolicyDescriptionList',
        'PropertyAttributeLink',
        'PropertyDescriptionList',
        'PropertyTypeList',
        'RecreationDescriptionList',
        'RegionCenterCoordinatesList',
        'RegionEANHotelIDMapping',
        'RoomTypeList',
        'SpaDescriptionList',
        'WhatToExpectList',
        'PropertyLocationList',
        'PropertyAmenitiesList',
        'PropertyRoomsList',
        'PropertyBusinessAmenitiesList',
        'PropertyNationalRatingsList',
        'PropertyFeesList',
        'PropertyMandatoryFeesList',
        'PropertyRenovationsList',
        'ActivePropertyBusinessModel',
    ]
];
