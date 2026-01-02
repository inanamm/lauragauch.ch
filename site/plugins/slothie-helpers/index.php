<?php

Kirby::plugin("SlothieStudio/slothie-helpers", []);

class SlothieHelpers
{
  public function HSLtoHSLA(string $hslColor, float $alpha = 1): string
  {
    // Trim the input color string
    $hslColor = trim($hslColor);

    // Regular expression to match HSL color format with spaces or commas
    $regex = '/^hsl\(\s*(\d+)\s*[,\s]\s*(\d+)%\s*[,\s]\s*(\d+)%\s*\)$/i';

    // Validate and extract components
    if (!preg_match($regex, $hslColor, $matches)) {
      throw new InvalidArgumentException("Invalid HSL color format.");
    }

    // Extract hue, saturation, and lightness from matches
    $hue = (int) $matches[1];
    $saturation = (int) $matches[2] . "%";
    $lightness = (int) $matches[3] . "%";

    // Validate ranges
    if ($hue < 0 || $hue > 360) {
      throw new InvalidArgumentException("Hue must be between 0 and 360.");
    }

    if ($alpha < 0 || $alpha > 1) {
      throw new InvalidArgumentException("Alpha must be between 0 and 1.");
    }

    // Return the formatted HSLA color string
    return "hsla($hue, $saturation, $lightness, $alpha)";
  }
}

function slothieHelpers(): SlothieHelpers
{
  return new SlothieHelpers();
}
