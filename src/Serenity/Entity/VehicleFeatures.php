<?php
namespace Serenity\Entity;

class VehicleFeatures
{
    const TWO_BERTH                = 'two-berth';
    const FOUR_BERTH               = 'four-berth';
    const SIX_BERTH                = 'six-berth';
    const FIXED_BED                = 'fixed-bed';
    const FIXED_ISLAND_BED         = 'fixed-island-bed';
    const U_SHAPED_LOUNGE          = 'u-shaped-lounge';
    const END_BATHROOM             = 'end-bathroom';
    const SEPARATE_SHOWER          = 'separate-shower';
    const THETFORD_TOILET          = 'thetford-toilet';
    const FRONT_LOUNGE             = 'front-lounge';
    const LED_LIGHTING             = 'led-lighting';
    const SOFT_LIGHTING            = 'soft-lighting';
    const ON_BOARD_WATER_TANK      = 'on-board-water-tank';
    const TRUMA_HEATING            = 'truma-heating';
    const ALDE_HEATING             = 'alde-eating';
    const DUAL_FUEL                = 'dual-fuel';
    const EXTRACTOR_FAN            = 'extractor-fan';
    const HEKI_SKYLIGHT            = 'heki-skylight';
    const CARBON_MONOXIDE_DETECTOR = 'carbon-monoxide-detector';
    const SMOKE_ALARM              = 'smoke-alarm';
    const PLEATED_BLINDS           = 'pleated-blinds';
    const FLYSCREENS               = 'flyscreens';
    const MICROWAVE                = 'microwave';
    const FULL_SIZED_OVEN_GRILL    = 'full-sized-over-grill';
    const MUSIC_SYSTEM             = 'music-system';
    const TELEVISION               = 'television';
    const TV_BRACKET               = 'tv-bracket';
    const ALLOY_WHEELS             = 'alloy-wheels';
    const MOTOR_MOVER              = 'motor-mover';
    const EXTERNAL_240V_SOCKET     = 'external-240v-socket';
    const SOLAR_PANEL              = 'solar-panel';
    const TV_AERIAL                = 'tv-aerial';
    const TV_POINT                 = 'tv-point';

    public static $titles = [
        self::TWO_BERTH                => '2 Berth',
        self::FOUR_BERTH               => '4 Berth',
        self::SIX_BERTH                => '6 Berth',
        self::FIXED_BED                => 'Fixed Bed',
        self::FIXED_ISLAND_BED         => 'Fixed Island Bed',
        self::U_SHAPED_LOUNGE          => 'U Shaped Lounge',
        self::END_BATHROOM             => 'End Bathroom',
        self::SEPARATE_SHOWER          => 'Separate Shower',
        self::THETFORD_TOILET          => 'Thetford Toilet',
        self::FRONT_LOUNGE             => 'Front Lounge',
        self::LED_LIGHTING             => 'LED Lighting',
        self::SOFT_LIGHTING            => 'Soft Lighting',
        self::ON_BOARD_WATER_TANK      => 'On Board Water Tank',
        self::TRUMA_HEATING            => 'Truma Heating',
        self::ALDE_HEATING             => 'Alde Heating',
        self::DUAL_FUEL                => 'Dual Fuel',
        self::EXTRACTOR_FAN            => 'Extractor Fan',
        self::HEKI_SKYLIGHT            => 'Heki Skylight',
        self::CARBON_MONOXIDE_DETECTOR => 'Carbon Monoxide Detector',
        self::SMOKE_ALARM              => 'Smoke Alarm',
        self::PLEATED_BLINDS           => 'Pleated Blinds',
        self::FLYSCREENS               => 'Flyscreens',
        self::MICROWAVE                => 'Microwave',
        self::FULL_SIZED_OVEN_GRILL    => 'Full Sized Oven/Grill',
        self::MUSIC_SYSTEM             => 'Music System',
        self::TELEVISION               => 'Television',
        self::TV_BRACKET               => 'TV Bracket',
        self::ALLOY_WHEELS             => 'Alloy Wheels',
        self::MOTOR_MOVER              => 'Motor Mover',
        self::EXTERNAL_240V_SOCKET     => 'External 240v Socket',
        self::SOLAR_PANEL              => 'Solar Panel',
        self::TV_AERIAL                => 'TV Aerial',
        self::TV_POINT                 => 'TV Point'
    ];
}
