<?php
namespace Serenity\Service;

class SerenityParsedown extends \Parsedown
{
    protected function inlineImage($excerpt)
    {
        $image = parent::inlineImage($excerpt);
        if ($image !== null) {
            $image['element']['attributes']['class'] = 'img-responsive';
        }
        return $image;
   }

    protected function blockTable($line, array $block = null)
    {
        $table = parent::blockTable($line, $block);
        if ($table !== null) {
            $table['element']['attributes']['class'] = 'table';
        }
        return $table;
    }
}
