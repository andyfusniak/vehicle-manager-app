<?php
namespace Serenity\Service;

class SerenityParsedown extends \Parsedown
{
    protected function inlineImage($excerpt)
    {
        $image = parent::inlineImage($excerpt);
        $image['element']['attributes']['class'] = 'img-responsive';
        return $image;
    }

    protected function blockTable($line, array $block = null)
    {
        $table = parent::blockTable($line, $block);;
        $table['element']['attributes']['class'] = 'table';
        return $table;
    }
}
