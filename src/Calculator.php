<?php
/**
 * Class file for the BMI calculator
 *
 * Calculates BMI based on input height & weight
 *
 * PHP version 5
 *
 * LICENSE: This source file is copyrighted and may only be used with the express permissions
 *          from the copyright owner.
 *
 * @category   Healthcare
 * @package    CM_BMI
 * @author     Toby Griffiths <toby@cubicmushroom.co.uk>
 * @copyright  2014 Cubic Mushroom Ltd.
 * @license    All rights reserved.  Permission for re-use for any purpose must explicitly be
 *             obtained from the copyright owner
 * @version    ##VERSION##
 * @since      ##SINCE##
 */

namespace CubicMushroom\BMI;

use PhpUnitsOfMeasure\PhysicalQuantity\Length;
use PhpUnitsOfMeasure\PhysicalQuantity\Mass;

/**
 * Calculated a person's BMI base on providede height and weight
 *
 * Height and weight can be providede as either meters and kilograms or feet/inches and st/lbs
 *
 * PHP version 5
 *
 * LICENSE: This source file is copyrighted and may only be used with the express permissions
 *          from the copyright owner.
 *
 * @category   Healthcare
 * @package    CM_BMI
 * @author     Toby Griffiths <toby@cubicmushroom.co.uk>
 * @copyright  2014 Cubic Mushroom Ltd.
 * @license    All rights reserved.  Permission for re-use for any purpose must explicitly be
 *             obtained from the copyright owner
 * @version    ##VERSION##
 * @since      ##SINCE##
 */
class Calculator
{

    /**
     * Height in meters
     *
     * @since ##SINCE##
     *
     * @var float
     */
    protected $height;

    /**
     * Weight in kgs
     *
     * @since ##SINCE##
     *
     * @var float
     */
    protected $weight;

    /**
     * Calculated BMI
     *
     * @var float
     */
    protected $BMI;


    /**
     * Sets the height to use for the calculation
     *
     * @since ##SINCE##
     *
     * @param $height
     *
     * @throws \InvalidArgumentException if $height is not numeric
     *
     * @return $this
     */
    public function heightInMeters( $height )
    {
        $this->setHeight( $height, 'm' );

        return $this;
    }

    /**
     * Sets the height to use for the calculation in feet and inches
     *
     * @since ##SINCE##
     *
     * @param int|float $ft Height in feet
     * @param int|float $in Height in inches
     *
     * @throws \InvalidArgumentException if $height is not in a valid format
     *
     * @return $this
     */
    public function heightInFtAndIn( $ft, $in )
    {
        $in = ( $ft * 12 ) + $in;

        $this->setHeight( $in, 'in' );

        return $this;
    }

    /**
     * Sets the weight in Kgs
     *
     * @since ##SINCE##
     *
     * @param int|float $kgs
     *
     * @return $this
     */
    public function weightInKgs( $kgs )
    {
        $this->setWeight( $kgs, 'kg' );

        return $this;
    }

    /**
     * Sets the weight in pounds
     *
     * @since ##SINCE##
     *
     * @param int|float $lbs Weight in pounds
     *
     * @return $this
     */
    public function weightInLbs( $lbs )
    {
        $this->setWeight( $lbs, 'lb' );

        return $this;
    }

    /**
     * Sets the weight in stone and pounds
     *
     * @since ##SINCE##
     *
     * @param int|float $st  Weight in stone
     * @param int|float $lbs Weight in pounds
     *
     * @return $this
     */
    public function weightInStAndLbs( $st, $lbs )
    {
        $lbs = ( $st * 14 ) + $lbs;

        $this->setWeight( $lbs, 'lb' );

        return $this;
    }


    /*****************************
     *                           *
     *   Calculator              *
     *                           *
     *****************************/

    /**
     * Updates the BMI base on the height & weight properties
     *
     * @since ##SINCE##
     *
     * @return $this
     */
    protected function updateBMI()
    {
        $height = $this->getHeight();
        $weight = $this->getWeight();

        if (empty( $weight ) || empty( $height )) {
            return $this;
        }

        $BMI = $weight / pow( $height, 2 );
        $this->setBMI( $BMI );

        return $this;
    }


    /******************************
     *                            *
     *   Getters, Setters, etc.   *
     *                            *
     ******************************/

    /**
     * Sets the BMI property
     *
     * @since ##SINCE##
     *
     * @param float $BMI
     *
     * @return $this
     */
    public function setBMI( $BMI )
    {
        $this->BMI = $BMI;

        return $this;
    }

    /**
     * Gets the BMI property
     *
     * @since ##SINCE##
     *
     * @return float
     */
    public function getBMI()
    {
        return $this->BMI;
    }

    /**
     * Sets the $height property
     *
     * @since ##SINCE##
     *
     * @param float|int $height
     * @param string    $unit   Unit the height is in
     *                          Default: 'm' (meters)
     *
     * @return $this
     */
    public function setHeight( $height, $unit = 'm' )
    {

        $height       = new Length( $height, $unit );
        $this->height = $height->toUnit( 'm' );

        $this->updateBMI();

        return $this;
    }

    /**
     * Gets the £height property
     *
     * @since ##SINCE##
     *
     * @return float
     */
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Sets the $weight property
     *
     * @since ##SINCE##
     *
     * @param float|int $weight
     * @param string    $unit   Unit the weight is in
     *                          Default: 'kg'
     *
     * @return $this
     */
    public function setWeight( $weight, $unit = 'kg' )
    {
        $weight       = new Mass( $weight, $unit );
        $this->weight = $weight->toUnit( 'kg' );

        $this->updateBMI();

        return $this;
    }

    /**
     * Gets the $weight property
     *
     * @since ##SINCE##
     *
     * @return float
     */
    public function getWeight()
    {
        return $this->weight;
    }
} 