<?php
/**
 * @copyright   © Wellevate, All rights reserved.
 * @namespace   Wellevate
 * @module      App
 * @brief       Class to manage constants
 * @author      Dinesh Arumugam, Elamurugan Nallathambi
 * @email       dinesh.arumugam3@cognizant.com, Elamurugan.Nallathambi@cognizant.com
 * @date        11/16/19
 * @description Constants for Entire Wellevate App
 * @link        #MU-101
 */

namespace Wellevate\App\Helper;

class Constants
{
    /*
     * Patient Magento Customer Group ID
     */
    const PATIENT_CUSTOMER_GRP_ID = 4;

    /*
     * Practitioner Magento Customer Group ID
     */
    const PRACTITIONER_CUSTOMER_GRP_ID = 5;

    /*
     * Patient Magento Customer Group Name
     */
    const PATIENT_CUSTOMER_GRP_CODE = 'Patient';

    /*
     * Practitioner Magento Customer Group Name
     */
    const PRACTITIONER_CUSTOMER_GRP_CODE = 'Practitioner';

    /*
     * User can use the portal for 30 days without Account confirmation
     */
    const ALLOWED_DAYS_WITHOUT_ACCOUNT_CONFORMATION = 2592000;

    const DS = DIRECTORY_SEPARATOR;
    
    /**
     * Maximum profit percentage
     */
    const MAX_PROFIt = 0.45;
}
