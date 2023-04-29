<?php

namespace CommandString\Utils;

/**
 * ColorUtils is a PHP class that provides a set of utility functions for working with colours.
 *
 */
class ColourUtility {
  
  /**
   * The function converts a hexadecimal colour code to its corresponding RGB values.
   * 
   * @param string hex The "hex" parameter is a string representing a hexadecimal colour code.
   * 
   * @return array an array containing the RGB values of a given hexadecimal colour code. The array
   * contains three elements, representing the red, green, and blue values respectively.
   */
  public static function hexToRgb(string $hex):array {
    $hex = str_replace("#", "", $hex);
    if(strlen($hex) == 3) {
      $r = hexdec(substr($hex,0,1).substr($hex,0,1));
      $g = hexdec(substr($hex,1,1).substr($hex,1,1));
      $b = hexdec(substr($hex,2,1).substr($hex,2,1));
    } else {
      $r = hexdec(substr($hex,0,2));
      $g = hexdec(substr($hex,2,2));
      $b = hexdec(substr($hex,4,2));
    }
    return array($r, $g, $b);
  }
  
  
  /**
   * The function converts RGB colour values to hexadecimal format with an optional prefix.
   * 
   * @param int r The red value of the RGB colour (an integer between 0 and 255).
   * @param int g The green value of the RGB colour (an integer between 0 and 255).
   * @param int b TThe blue value of the RGB colour (an integer between 0 and 255).
   * @param withPrefix A boolean parameter that determines whether the returned hex string should include
   * the "#" prefix or not. The default value is `true`.
   * 
   * @return string a string representing the hexadecimal value of the RGB colour passed as parameters.
   */
  public static function rgbToHex(int $r, int $g, int $b, $withPrefix = true):string {
    $r = dechex($r);
    $g = dechex($g);
    $b = dechex($b);

    $r = strlen($r) == 1 ? "0" . $r : $r;
    $g = strlen($g) == 1 ? "0" . $g : $g;
    $b = strlen($b) == 1 ? "0" . $b : $b;

    $hex = $r . $g . $b;

    if ($withPrefix) {
      $hex = "#" . $hex;
    }

    return $hex;
  }
  
  
  /**
   * This PHP function calculates the brightness of a given colour in RGB format.
   * 
   * @param string colour The input colour in hexadecimal format (e.g. "#FF0000" for red).
   * 
   * @return float|int the brightness value of a given colour in the range of 0 to 255, where 0 is the
   * darkest and 255 is the brightest. The brightness value is calculated using the formula for
   * relative luminance, which takes into account the human eye's sensitivity to different colours.
   */
  public static function getBrightness(string $colour, bool $round = false): float|int {
    $rgb = self::hexToRgb($colour);
    $luminance = (($rgb[0] * 299) + ($rgb[1] * 587) + ($rgb[2] * 114)) / 1000;
    return $round ? round($luminance) : $luminance;
  }
  
  
  /**
   * The function determines if a given colour is dark or not based on its brightness value.
   * 
   * @param string colour The colour parameter is a string representing a colour in any valid CSS format
   * (e.g. hex code, RGB, RGBA, HSL, HSLA).
   * 
   * @return bool A boolean value indicating whether the input colour is considered dark or not, based
   * on its brightness level.
   */
  public static function isDark(string $colour): bool {
    $brightness = self::getBrightness($colour);
    return ($brightness < 128);
  }

  /**
   * The function returns a contrasting color (either black or white) based on the darkness of the input
   * color.
   * 
   * @param string colour The parameter "colour" is a string representing a color in hexadecimal format
   * (e.g. "#FF0000" for red).
   * 
   * @return string a string value which is either "#FFFFFF" (white) or "#000000" (black) based on
   * whether the input color is dark or not.
   */
  public static function getContrastColour(string $colour): string {
    return self::isDark($colour) ? "#FFFFFF" : "#000000";
  }


  /**
   * This function returns the complementary color of a given color in RGB or hexadecimal format.
   * 
   * @param colour The input color in hexadecimal format (e.g. "#FF0000" for red).
   * @param hex The "hex" parameter is a boolean value that determines whether the function should
   * return the complementary color in hexadecimal format (if set to true) or as an array of RGB values
   * (if set to false).
   * 
   * @return the complementary color of the input color in either hexadecimal or RGB format, depending
   * on the value of the  parameter.
   */
  public static function getComplementaryColour($colour, $hex = true): string|array {
    $rgb = self::hexToRgb($colour);
    $r = 255 - $rgb[0];
    $g = 255 - $rgb[1];
    $b = 255 - $rgb[2];
    return $hex ? self::rgbToHex($r, $g, $b) : array($r, $g, $b);
  } 
}

?>
