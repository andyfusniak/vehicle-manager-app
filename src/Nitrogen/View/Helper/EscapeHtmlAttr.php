<?php
namespace Nitrogen\View\Helper;

class EscapeHtmlAttr extends AbstractHelper
{
    /**
     * Entity Map mapping Unicode codepoints to any available named HTML entities.
     *
     * While HTML supports far more named entities, the lowest common denominator
     * has become HTML5's XML Serialisation which is restricted to the those named
     * entities that XML supports. Using HTML entities would result in this error:
     *     XML Parsing Error: undefined entity
     *
     * @var array
     */
    protected static $htmlNamedEntityMap = [ 
        34 => 'quot',         // quotation mark
        38 => 'amp',          // ampersand
        60 => 'lt',           // less-than sign
        62 => 'gt',           // greater-than sign
    ];

    protected $htmlAttrMatcher;

    public function __construct()
    {
        $this->htmlAttrMatcher = [$this, 'htmlAttrMatcher'];
    }

    /**
     * Callback function for preg_replace_callback that applies HTML Attribute
     * escaping to all matches.
     *
     * @param array $matches
     * @return string
     */
    protected function htmlAttrMatcher($matches)
    {
        $chr = $matches[0];
        $ord = ord($chr);

        /**
         * The following replaces characters undefined in HTML with the
         * hex entity for the Unicode replacement character.
         */
        if (($ord <= 0x1f && $chr != "\t" && $chr != "\n" && $chr != "\r")
            || ($ord >= 0x7f && $ord <= 0x9f)
        ) {
            return '&#xFFFD;';
        }

        /**
         * Check if the current character to escape has a name entity we should
         * replace it with while grabbing the integer value of the character.
         */
        if (strlen($chr) > 1) {
            $chr = mb_convert_encoding($chr, 'UTF-16BE', 'UTF-8');
        }

        $hex = bin2hex($chr);
        $ord = hexdec($hex);
        if (isset(static::$htmlNamedEntityMap[$ord])) {
            return '&' . static::$htmlNamedEntityMap[$ord] . ';';
        }

        /**
         * Per OWASP recommendations, we'll use upper hex entities
         * for any other characters where a named entity does not exist.
         */
        if ($ord > 255) {
            return sprintf('&#x%04X;', $ord);
        }
        return sprintf('&#x%02X;', $ord);
    }

    public function __invoke($value)
    {
        if (($value === '') || ctype_digit($value)) {
            return $value;
        }

        return preg_replace_callback('/[^a-z0-9,\.\-_]/iSu', $this->htmlAttrMatcher, $value);
    }
}
