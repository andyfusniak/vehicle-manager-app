<?php
namespace Serenity\Entity;

class VehicleFeatures
{
    const APPLE  = 'apple';
    const ORANGE = 'orange';
    const BANANA = 'banana';
    const CAKE   = 'cake';
    const GRAPES = 'grapes';

    public static $titles = [
        self::APPLE  => 'Some Apples',
        self::ORANGE => 'Some Oranges',
        self::BANANA => 'Some Bananas',
        self::CAKE   => 'Yummy Cakes',
        self::GRAPES => 'Bunch of grapes'
    ];
}
