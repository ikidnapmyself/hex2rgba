<?php
namespace hex2rgba;

use Exception;

class hex2rgba
{
    /**
     * @var string $default
     */
    public $default = 'rgba(0,0,0,1.0)';

    /**
     * @var string $hex
     */
    public $hex     = '000000';

    /**
     * @var array $convert
     */
    public $convert  = array();

    /**
     * @param $code
     * @return string
     */
    public function sanitize($code)
    {
        if (substr($code, 0, 1) == '#')
        {
            $code = substr($code, 1);
        }

        $this->hex = $code;

        // Just for using the function stand-alone, not necessary in this project
        return $this->hex;
    }

    /**
     * Number format
     *
     * @param  int $opacity
     * @return float
     */
    public function number_format($opacity)
    {
        if(abs($opacity) > 1 || !is_numeric($opacity))
            $opacity = 1.0;

        return number_format((float) $opacity, 1, '.', '');
    }

    /**
     * Determinate hexadecimal code length to normalize
     *
     * @throws Exception
     */
    public function normalize()
    {
        if (strlen($this->hex) == 6)
        {
            $this->convert = array( $this->hex[0] . $this->hex[1], $this->hex[2] . $this->hex[3], $this->hex[4] . $this->hex[5] );
        } elseif (strlen($this->hex ) == 3)
        {
            $this->convert = array( $this->hex[0] . $this->hex[0], $this->hex[1] . $this->hex[1], $this->hex[2] . $this->hex[2] );
        } else {
            throw new Exception('Misformatted value: '.$this->hex);
        }
    }

    /**
     * Hexadecimal to rgba converter
     *
     * @param string $hex
     * @param int    $opacity
     * @return string
     *
     * @throws Exception
     */
    public function convert($hex = '', $opacity = 1)
    {
        if(!empty($hex) && is_string($hex))
        {
            $this->sanitize($hex);
        }

        $this->normalize();

        $rgb     = array_map('hexdec', $this->convert);
        $opacity = $this->number_format($opacity);
        $output  = 'rgba('.implode(',', $rgb).','.$opacity.')';

        return $output;
    }
}